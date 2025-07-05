<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category', 'tags'])->where('is_approved', true);
        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $categoryId = $request->category;
            $categoryIds = [$categoryId];
            // Alt kategorileri recursive olarak bul
            $getChildren = function($parentId) use (&$getChildren) {
                $children = \App\Models\Category::where('parent_id', $parentId)->pluck('id')->toArray();
                $all = $children;
                foreach ($children as $childId) {
                    $all = array_merge($all, $getChildren($childId));
                }
                return $all;
            };
            $categoryIds = array_merge($categoryIds, $getChildren($categoryId));
            $query->whereIn('category_id', $categoryIds);
        }
        $posts = $query->orderByDesc('created_at')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
        $post = new \App\Models\Post($validated);
        $post->user_id = auth()->id();
        $post->slug = \Str::slug($validated['title']) . '-' . uniqid();
        $post->is_approved = false;
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }
        $post->save();
        $post->tags()->sync($validated['tags'] ?? []);
        return redirect()->route('dashboard')->with('success', 'Blog yazısı oluşturuldu!');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Post $post)
    {
        $post->load(['user', 'category', 'tags']);
        // Get nested comments
        $comments = \App\Models\Comment::getRootComments($post->id);
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Post $post)
    {
        $this->authorize('update', $post);
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);
        $post->fill($validated);
        $post->is_approved = false;
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }
        $post->save();
        $post->tags()->sync($validated['tags'] ?? []);
        if ($request->has('admin')) {
            return redirect()->route('filament.admin.pages.post-comment-management')->with('success', 'Blog yazısı güncellendi!');
        }
        return redirect()->route('dashboard')->with('success', 'Blog yazısı güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        if (request()->has('admin')) {
            return redirect()->route('filament.admin.pages.post-comment-management')->with('success', 'Blog yazısı silindi!');
        }
        return redirect()->back()->with('success', 'Blog yazısı silindi!');
    }

    /**
     * Display a listing of the authenticated user's posts for the dashboard.
     */
    public function myPosts(Request $request)
    {
        $query = Post::with(['category', 'tags'])->where('user_id', auth()->id())->where('is_approved', true);
        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $categoryId = $request->category;
            $categoryIds = [$categoryId];
            // Alt kategorileri recursive olarak bul
            $getChildren = function($parentId) use (&$getChildren) {
                $children = \App\Models\Category::where('parent_id', $parentId)->pluck('id')->toArray();
                $all = $children;
                foreach ($children as $childId) {
                    $all = array_merge($all, $getChildren($childId));
                }
                return $all;
            };
            $categoryIds = array_merge($categoryIds, $getChildren($categoryId));
            $query->whereIn('category_id', $categoryIds);
        }
        // Diğer filtreler için buraya ekleme yapılabilir
        $posts = $query->orderByDesc('created_at')->paginate(10);
        return view('dashboard', compact('posts'));
    }

    public function approve(\App\Models\Post $post)
    {
        $post->is_approved = true;
        $post->save();
        return redirect()->back()->with('success', 'Post onaylandı!');
    }

    public function reject(Post $post)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }
        if ($post->is_approved) {
            return redirect()->back()->with('error', 'Onaylanmış post silinemez.');
        }
        $post->delete();
        return redirect()->back()->with('success', 'Post reddedildi ve silindi!');
    }
}

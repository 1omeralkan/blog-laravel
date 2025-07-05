<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, \App\Models\Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Check depth limit (max 3 levels)
        if (isset($validated['parent_id']) && $validated['parent_id']) {
            $parent = Comment::find($validated['parent_id']);
            if ($parent && $parent->depth >= 2) {
                return redirect()->back()->withErrors(['content' => 'Maksimum yanıt seviyesine ulaştınız.']);
            }
        }

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
            'is_approved' => false,
        ]);

        // Calculate depth
        $comment->calculateDepth();
        $comment->save();

        return redirect()->route('posts.show', $post->slug)->with('success', 'Yorum eklendi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }
        return response()->json([
            'content' => $comment->content,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $comment->content = $validated['content'];
        $comment->is_approved = false; // Güncellenince tekrar onay gereksin
        $comment->save();
        return redirect()->back()->with('success', 'Yorum güncellendi, tekrar onay bekliyor!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // Sadece yorumu yazan kullanıcı veya admin silebilsin
        if (!(auth()->id() === $comment->user_id || (auth()->check() && auth()->user()->isAdmin()))) {
            abort(403);
        }
        $comment->delete();
        if (request()->has('admin')) {
            return redirect()->route('filament.admin.pages.post-comment-management')->with('success', 'Yorum silindi!');
        }
        return redirect()->back()->with('success', 'Yorum silindi!');
    }

    public function approve(\App\Models\Comment $comment)
    {
        $comment->is_approved = true;
        $comment->save();
        return redirect()->back()->with('success', 'Yorum onaylandı!');
    }

    public function reject(Comment $comment)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403);
        }
        if ($comment->is_approved) {
            return redirect()->back()->with('error', 'Onaylanmış yorum silinemez.');
        }
        $comment->delete();
        return redirect()->back()->with('success', 'Yorum reddedildi ve silindi!');
    }
}

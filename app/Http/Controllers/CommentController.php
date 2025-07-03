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
        ]);
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'is_approved' => false,
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        //
    }

    public function approve(\App\Models\Comment $comment)
    {
        $comment->is_approved = true;
        $comment->save();
        return redirect()->back()->with('success', 'Yorum onaylandı!');
    }
}

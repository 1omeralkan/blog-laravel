<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'is_approved',
        'parent_id',
        'depth',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    // Nested comments relationships
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function allReplies()
    {
        return $this->replies()->with('allReplies');
    }

    // Get root comments (no parent)
    public static function getRootComments($postId)
    {
        return self::where('post_id', $postId)
            ->whereNull('parent_id')
            ->where('is_approved', true)
            ->with(['user', 'replies.user', 'replies.replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Calculate depth when creating reply
    public function calculateDepth()
    {
        if ($this->parent_id) {
            $parent = Comment::find($this->parent_id);
            $this->depth = $parent ? $parent->depth + 1 : 0;
        } else {
            $this->depth = 0;
        }
    }
}

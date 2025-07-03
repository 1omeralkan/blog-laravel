<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Post;
use App\Models\Comment;

class PostCommentManagement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Post/Yorum Yönetimi';
    protected static ?string $slug = 'post-comment-management';
    protected static string $view = 'filament.pages.post-comment-management';
    protected static ?string $title = '';


    public $recentPosts = [];
    public $recentComments = [];
    public $unapprovedPosts = [];
    public $unapprovedComments = [];

    public function mount()
    {
        $this->recentPosts = Post::latest()->take(5)->with('user')->get();
        $this->recentComments = Comment::latest()->take(5)->with(['user', 'post'])->get();
        $this->unapprovedPosts = Post::where('is_approved', false)->with('user')->latest()->take(10)->get();
        $this->unapprovedComments = Comment::where('is_approved', false)->with(['user', 'post'])->latest()->take(10)->get();
    }
} 
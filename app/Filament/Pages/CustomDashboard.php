<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class CustomDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $slug = 'dashboard';
    protected static string $view = 'filament.pages.custom-dashboard';
    protected static ?string $title = '';

    public $postCount;
    public $categoryCount;
    public $commentCount;
    public $userCount;
    public $recentPosts = [];
    public $recentComments = [];
    public $recentUsers = [];
    public $pendingPostCount = 0;
    public $pendingCommentCount = 0;

    public function mount()
    {
        $this->postCount = Post::count();
        $this->categoryCount = Category::count();
        $this->commentCount = Comment::count();
        $this->userCount = User::count();
        $this->recentPosts = Post::latest()->take(5)->with('user')->get();
        $this->recentComments = Comment::latest()->take(5)->with(['user', 'post'])->get();
        $this->recentUsers = User::latest()->take(5)->get();
        $this->pendingPostCount = Post::where('is_approved', false)->count();
        $this->pendingCommentCount = Comment::where('is_approved', false)->count();
    }
} 
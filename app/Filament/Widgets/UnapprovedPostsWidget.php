<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Post;

class UnapprovedPostsWidget extends Widget
{
    protected static string $view = 'filament.widgets.unapproved-posts-widget';

    public function getViewData(): array
    {
        return [
            'posts' => Post::where('is_approved', false)->with('user')->latest()->take(10)->get(),
        ];
    }
} 
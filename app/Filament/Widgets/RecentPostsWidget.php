<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Post;

class RecentPostsWidget extends Widget
{
    protected static string $view = 'filament.widgets.recent-posts-widget';

    public function getViewData(): array
    {
        return [
            'posts' => Post::latest()->take(5)->with('user')->get(),
        ];
    }
} 
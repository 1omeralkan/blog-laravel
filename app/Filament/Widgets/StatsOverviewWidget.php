<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class StatsOverviewWidget extends Widget
{
    protected static string $view = 'filament.widgets.stats-overview-widget';

    public function getViewData(): array
    {
        return [
            'postCount' => Post::count(),
            'categoryCount' => Category::count(),
            'commentCount' => Comment::count(),
            'userCount' => User::count(),
        ];
    }
} 
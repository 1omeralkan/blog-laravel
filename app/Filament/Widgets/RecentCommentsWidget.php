<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Comment;

class RecentCommentsWidget extends Widget
{
    protected static string $view = 'filament.widgets.recent-comments-widget';

    public function getViewData(): array
    {
        return [
            'comments' => Comment::latest()->take(5)->with(['user', 'post'])->get(),
        ];
    }
} 
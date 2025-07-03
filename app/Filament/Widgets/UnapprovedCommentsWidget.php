<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Comment;

class UnapprovedCommentsWidget extends Widget
{
    protected static string $view = 'filament.widgets.unapproved-comments-widget';

    public function getViewData(): array
    {
        return [
            'comments' => Comment::where('is_approved', false)->with(['user', 'post'])->latest()->take(10)->get(),
        ];
    }
} 
<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\User;

class UserManagement extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Kullanıcı Yönetimi';
    protected static ?string $slug = 'user-management';
    protected static string $view = 'filament.pages.user-management';
    protected static ?string $title = '';

    public $users = [];
    public $search = '';

    public function mount()
    {
        $this->users = User::query()
            ->when(request('search'), function($query) {
                $search = request('search');
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->orderByDesc('created_at')
            ->get();
        $this->search = request('search', '');
    }
} 
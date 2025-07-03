<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Kullanıcı sadece kendi postunu güncelleyebilir veya admin ise tüm postları düzenleyebilir.
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->role_id == 0;
    }

    /**
     * Kullanıcı sadece kendi postunu silebilir veya admin ise silebilir.
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->role_id == 0;
    }
} 
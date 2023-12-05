<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function create(User $user): bool
    {
        return $user->role === 'ADMIN';
    }

    public function view(User $user): bool
    {
        return $user->role === 'ADMIN';
    }

    public function manage(User $user): bool
    {
        return $user->role === 'ADMIN';
    }
}
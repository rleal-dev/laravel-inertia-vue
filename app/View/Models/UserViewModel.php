<?php

namespace App\View\Models;

use App\Models\Role;
use App\Models\User;
use Spatie\ViewModels\ViewModel;

class UserViewModel extends ViewModel
{
    public function __construct(private User $user)
    {
    }

    public function user()
    {
        return [
            ...$this->user->only('id', 'name', 'email', 'avatar_url'),
            'roles' => $this->user->roles->pluck('id')->toArray(),
        ];
    }

    public function roles()
    {
        return Role::all();
    }
}

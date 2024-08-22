<?php

namespace App\Queries\User;

use App\Models\User;

class GetUserList
{
    public function handle()
    {
        return User::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar_url' => $user->avatar_url,
                'created_at' => $user->created_at->toDateTimeString(),
            ]);
    }
}

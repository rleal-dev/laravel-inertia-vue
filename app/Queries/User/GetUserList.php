<?php

namespace App\Queries\User;

use App\Models\User;

class GetUserList
{
    public function handle()
    {
        return User::query()
            ->with('roles')
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when(request('status'), function ($query, $status) {
                if ($status === 'all') {
                    $query->withTrashed();
                }

                if ($status === 'trashed') {
                    $query->onlyTrashed();
                }
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar_url' => $user->avatar_url,
                'status' => $user->status,
                'roles' => $user->roles->pluck('name'),
                'created_at' => $user->created_at->toDateTimeString(),
            ]);
    }
}

<?php

namespace App\Queries\Role;

use App\Models\Role;

class GetRoleList
{
    public function handle()
    {
        return Role::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'created_at' => $role->created_at->toDateTimeString(),
            ]);
    }
}

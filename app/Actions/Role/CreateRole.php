<?php

namespace App\Actions\Role;

use App\Models\Role;

class CreateRole
{
    public function handle(array $data): Role
    {
        $role = Role::create($data);

        return $role;
    }
}

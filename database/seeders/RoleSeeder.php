<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([
            [
                'name' => 'admin',
            ],
        ]);

        $roles->each(fn ($role) => Role::create($role));
    }
}

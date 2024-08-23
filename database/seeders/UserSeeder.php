<?php

namespace Database\Seeders;

use App\Models\{Role, User};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Rogerio Leal',
                'email' => 'rleal.dev@gmail.com',
                'password' => '11111111',
                'email_verified_at' => now()->toDateTimeString(),
            ],
        ]);

        $role = Role::first();

        $users->each(function ($user) use ($role) {
            $newUser = User::create($user);
            $newUser->roles()->attach($role->id);
        });
    }
}

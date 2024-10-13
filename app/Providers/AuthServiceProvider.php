<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerUserAccessToGates();
    }

    protected function registerUserAccessToGates()
    {
        foreach (Permission::pluck('name') as $permission) {
            Gate::define($permission, fn ($user) => $user->roles()->whereHas(
                'permissions', fn ($q) => $q->where('name', $permission))->exists()
            );
        }
    }
}

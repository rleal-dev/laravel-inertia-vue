<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     */
    public function share(Request $request): array
    {
        $langFile = lang_path(app()->getLocale() . '/messages.php');

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $this->getUser($request),
                'can' => $this->getPermissions($request),
            ],
            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],
            'language' => app()->getLocale(),
            'translations' => File::exists($langFile) ? require $langFile : [],
        ];
    }

    private function getUser(Request $request)
    {
        return $request->user()?->only('id', 'name', 'email', 'avatar_url');
    }
    
    private function getPermissions(Request $request)
    {
        return $request->user()?->loadMissing('roles.permissions')
            ->roles
            ->pluck('permissions')
            ->flatten()
            ->unique('name')
            ->mapWithKeys(fn ($permission) => [
                $permission['name'] => $request->user()->can($permission['name'])
            ])
            ->all();
    }
}

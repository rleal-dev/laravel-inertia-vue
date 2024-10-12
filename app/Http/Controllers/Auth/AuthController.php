<?php

namespace App\Http\Controllers\Auth;

use App\Actions\AuthToken\CreateAuthToken;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\{RedirectResponse, Request};
use Inertia\Response;

class AuthController
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return inertia('Auth/Login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        (new CreateAuthToken())->handle($request->user());

        // $request->user()->last_login_at = now()->toDateTimeString();
        // $request->user()->save();

        return redirect()->intended(route('verify.token', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('index');
    }
}

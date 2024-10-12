<?php

namespace App\Http\Controllers\Auth;

use App\Actions\AuthToken\CreateAuthToken;
use App\Models\AuthToken;
use Illuminate\Http\{RedirectResponse, Request};
use Inertia\Response;

class VerifyTokenController
{
    /**
     * Display the verification token view.
     */
    public function create(): Response
    {
        return inertia('Auth/VerifyToken', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming verification token request.
     */
    public function store(Request $request): RedirectResponse
    {
        $authToken = AuthToken::query()
            ->whereUserId($request->user()->id)
            ->whereToken($request->token)
            ->first();

        if (! $authToken) {
            return back()->with('status', 'Token Incorreto!');
        }

        $authToken->update(['verified_at' => now()]);

        $request->user()->last_login_at = now();
        $request->user()->save();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Handle an incoming verification token request.
     */
    public function resend(Request $request): RedirectResponse
    {
        (new CreateAuthToken())->handle($request->user());

        return redirect()->intended(route('verify.token', absolute: false));
    }
}

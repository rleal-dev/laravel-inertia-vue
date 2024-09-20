<?php

namespace App\Http\Controllers\Auth;

use Inertia\Response;
use App\Models\AuthToken;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\{RedirectResponse, Request};

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
    public function store(Request $request)
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
}

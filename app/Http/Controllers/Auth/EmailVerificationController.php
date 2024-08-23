<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class EmailVerificationController
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute: false))
            : inertia('Auth/VerifyEmail', ['status' => session('status')]);
    }
}

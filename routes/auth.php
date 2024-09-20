<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [Auth\RegisterController::class, 'create'])->name('register');
    Route::post('register', [Auth\RegisterController::class, 'store']);

    Route::get('/', [Auth\AuthController::class, 'create'])->name('index');
    Route::get('login', [Auth\AuthController::class, 'create'])->name('login');
    Route::post('login', [Auth\AuthController::class, 'store']);

    Route::get('forgot-password', [Auth\ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [Auth\ForgotPasswordController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [Auth\ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [Auth\ResetPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', Auth\EmailVerificationController::class)->name('verification.notice');

    Route::get('verify-token', [Auth\VerifyTokenController::class, 'create'])->name('verify.token');
    Route::post('verify-token', [Auth\VerifyTokenController::class, 'store'])->name('check.token');

    Route::get('verify-email/{id}/{hash}', Auth\VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [Auth\EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [Auth\ConfirmPasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [Auth\ConfirmPasswordController::class, 'store']);

    Route::put('password', [Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [Auth\AuthController::class, 'destroy'])->name('logout');
});

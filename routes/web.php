<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/language/{language}', function ($language) {
    session()->put('locale', $language);

    return redirect()->back();
})->name('language');

Route::middleware(['auth', 'verified', 'check-user'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit')->middleware('password.confirm');
    Route::patch('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Admin\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'users' => Admin\UserController::class,
        'roles' => Admin\RoleController::class,
    ]);
});

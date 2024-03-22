<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
// Landing Page
// -----------------------------------------------------------------------------
Route::get('/', IndexController::class)->middleware('guest')->name('home');

Route::get('/logout', Auth\LogoutController::class)->name('logout');

// -----------------------------------------------------------------------------
// Google authentication routes
// -----------------------------------------------------------------------------
Route::get('/auth/google', Auth\Google\RedirectController::class)->name('auth.google');
Route::get('/auth/google/callback', Auth\Google\CallbackController::class)->name('auth.google.callback');

// -----------------------------------------------------------------------------
// Authenticated Routes
// -----------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PlatformController::class, 'dashboard'])->name('dashboard');
});

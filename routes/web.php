<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
// Landing Page
// -----------------------------------------------------------------------------
Route::get('/', IndexController::class)->middleware('guest')->name('index');

// -----------------------------------------------------------------------------
// Google authentication routes
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// Authenticated Routes
// -----------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PlatformController::class, 'dashboard'])->name('dashboard');
});

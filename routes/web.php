<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;

// Saat pertama kali masuk, arahkan ke halaman register
Route::get('/', function () {
    return redirect()->route('register');
});

// === Google Login ===
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// === Register ===
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// === Login ===
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// === Logout ===
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// === Dashboard User ===
Route::get('/dashboard-user', function () {
    return view('dashboard.user');
})->name('dashboard.user');

// === Dashboard Admin ===
Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
})->name('dashboard.admin');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('register');
});

// Halaman Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard untuk User
Route::get('/dashboard-user', function () {
    return view('dashboard.user');
})->name('dashboard.user');

// Dashboard untuk Admin
Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
})->name('dashboard.admin');

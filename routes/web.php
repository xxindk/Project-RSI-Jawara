<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// =================== DEFAULT ROUTE ===================
Route::get('/', function () {
    return redirect()->route('register');
});

// =================== AUTH ROUTES ===================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =================== DASHBOARD ROUTES ===================

// Dashboard User → dikendalikan oleh DashboardController
Route::get('/dashboard-user', [DashboardController::class, 'index'])->name('dashboard.user');

// Dashboard Admin → langsung menampilkan view admin
Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
})->name('dashboard.admin');
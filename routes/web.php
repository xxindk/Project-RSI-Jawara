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


Route::get('/', function () {
    return redirect()->route('reflection');
});

Route::get('/reflection', function () {
    return view('reflection');
})->name('reflection');

Route::get('/reflection-list', function () {
    return view('reflection-list');
})->name('reflection.list');

Route::get('/reflection', [ReflectionController::class, 'index'])
    ->name('reflection');

Route::get('/reflection', [ReflectionController::class, 'index'])->name('reflection');
Route::post('/reflection', [ReflectionController::class, 'store'])->name('reflection.store');
Route::get('/reflection-list', [ReflectionController::class, 'list'])->name('reflection.list');
Route::get('/reflection/{id}/edit', [ReflectionController::class, 'edit'])->name('reflection.edit');
Route::put('/reflection/{id}', [ReflectionController::class, 'update'])->name('reflection.update');
Route::delete('/reflection/{id}', [ReflectionController::class, 'destroy'])->name('reflection.destroy');

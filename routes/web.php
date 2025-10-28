<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard-user', function () {
    return view('dashboard.user');
});

Route::get('/admin/materi-index', [MateriController::class, 'index'])->name('materi.index');

Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
Route::get('/materi/tambah', [MateriController::class, 'create'])->name('materi.create');
Route::post('/materi/simpan', [MateriController::class, 'store'])->name('materi.store');
Route::get('/materi/edit/{id}', [MateriController::class, 'edit'])->name('materi.edit');
Route::post('/materi/update/{id}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/materi/hapus/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');


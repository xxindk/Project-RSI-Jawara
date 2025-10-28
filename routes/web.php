<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReflectionController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;


Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard-user', function () {
    return view('dashboard.user');
});
Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
});
Route::resource('flashcards', FlashcardController::class);

Route::get('/admin/flashcards', [FlashcardController::class, 'index'])->name('flashcards.index'); 
Route::get('/flashcard', [FlashcardController::class, 'index'])->name('flashcard.index');
Route::post('/flashcard', [FlashcardController::class, 'store'])->name('flashcard.store');
Route::put('/flashcard/{flashcard}', [FlashcardController::class, 'update'])->name('flashcard.update');
Route::delete('/flashcard/{flashcard}', [FlashcardController::class, 'destroy'])->name('flashcard.destroy');
Route::get('/flashcard-user', [FlashcardController::class, 'showForUser'])->name('flashcard.user');
Route::get('/', function () {
    return redirect()->route('reflection');
});


Route::get('/reflection', function () {
    return view('reflection');
})->name('reflection');

Route::get('/reflection-list', function () {
    return view('reflection-list');
})->name('reflection.list');

Route::get('/reflection', [ReflectionController::class, 'index'])->name('reflection');
Route::post('/reflection', [ReflectionController::class, 'store'])->name('reflection.store');


Route::get('/reflection-list', [ReflectionController::class, 'list'])->name('reflection.list');
Route::get('/reflection/{id}/edit', [ReflectionController::class, 'edit'])->name('reflection.edit');


Route::get('/admin/materi-index', [MateriController::class, 'index'])->name('materi.index');

Route::get('/reflection', [ReflectionController::class, 'index'])->name('reflection');
Route::post('/reflection', [ReflectionController::class, 'store'])->name('reflection.store');
Route::get('/reflection-list', [ReflectionController::class, 'list'])->name('reflection.list');
Route::get('/reflection/{id}/edit', [ReflectionController::class, 'edit'])->name('reflection.edit');
Route::put('/reflection/{id}', [ReflectionController::class, 'update'])->name('reflection.update');
Route::delete('/reflection/{id}', [ReflectionController::class, 'destroy'])->name('reflection.destroy');
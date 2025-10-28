<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;


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

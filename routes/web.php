<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReflectionController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard-user', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('user.dashboard');
Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])
    ->name('profile');


Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
});
Route::resource('flashcards', FlashcardController::class);

Route::resource('flashcards', FlashcardController::class);

Route::get('/flashcard/modul/{modulId}', [App\Http\Controllers\FlashcardController::class, 'showByModule'])
    ->name('flashcard.showByModule');

Route::get('/admin/flashcards', [FlashcardController::class, 'index'])->name('flashcards.index'); 
Route::get('/flashcard', [FlashcardController::class, 'index'])->name('flashcard.index');
Route::post('/flashcard', [FlashcardController::class, 'store'])->name('flashcard.store');
Route::put('/flashcard/{flashcard}', [FlashcardController::class, 'update'])->name('flashcard.update');
Route::delete('/flashcard/{flashcard}', [FlashcardController::class, 'destroy'])->name('flashcard.destroy');
Route::get('/flashcard-user', [FlashcardController::class, 'showForUser'])->name('flashcard.user');

Route::get('/admin/game', [GameController::class, 'index'])->name('game.index');       // admin list kartu
Route::post('/admin/game', [GameController::class, 'store'])->name('game.store');      // tambah kartu
Route::put('/admin/game/{id}', [GameController::class, 'update'])->name('game.update');// edit kartu
Route::delete('/admin/game/{id}', [GameController::class, 'destroy'])->name('game.destroy'); // hapus kartu

// ===== USER =====
// Semua kartu (user)
Route::get('/game', [GameController::class, 'showForUser'])->name('game.user.all');

// Kartu per modul (user)
Route::get('/game/modul/{modulId}', [GameController::class, 'showByModule'])->name('game.showByModule');


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


Route::get('/reflection', [ReflectionController::class, 'index'])->name('reflection');
Route::post('/reflection', [ReflectionController::class, 'store'])->name('reflection.store');
Route::get('/reflection-list', [ReflectionController::class, 'list'])->name('reflection.list');
Route::get('/reflection/{id}/edit', [ReflectionController::class, 'edit'])->name('reflection.edit');
Route::put('/reflection/{id}', [ReflectionController::class, 'update'])->name('reflection.update');
Route::delete('/reflection/{id}', [ReflectionController::class, 'destroy'])->name('reflection.destroy');

Route::get('/dashboard-admin', function () {
    return view('dashboard.admin');
});
Route::get('/admin/materi-index', [MateriController::class, 'index'])->name('materi.index');

Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
Route::get('/materi/tambah', [MateriController::class, 'create'])->name('materi.create');
Route::post('/materi/simpan', [MateriController::class, 'store'])->name('materi.store');
Route::get('/materi/edit/{id}', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('/materi/update/{id}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/materi/hapus/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');

Route::get('/user/materi/{id}', [MateriController::class, 'showUserMateri'])->name('user.materi');
// Route::get('/user/flashcard/{id}', [FlashcardController::class, 'showForUser'])->name('user.flashcard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('/admin/kuis', [KuisController::class,'index'])->name('kuis.index');
    Route::get('/admin/kuis/create', [KuisController::class,'create'])->name('kuis.create');
    Route::post('/admin/kuis', [KuisController::class,'store'])->name('kuis.store');
    Route::get('/admin/kuis/{id}/edit', [KuisController::class,'edit'])->name('kuis.edit');
    Route::put('/admin/kuis/{id}', [KuisController::class,'update'])->name('kuis.update');
    Route::delete('/admin/kuis/{id}', [KuisController::class,'destroy'])->name('kuis.destroy');


    Route::get('/kuis/start/{id_modul}', [KuisController::class,'start'])->name('kuis.start'); // inisialisasi quiz (acakan)
    Route::get('/kuis/play/{id_modul}', [KuisController::class,'play'])->name('kuis.play'); // tampil pertanyaan sekarang
    Route::post('/kuis/answer/{id_modul}', [KuisController::class,'answer'])->name('kuis.answer'); // submit jawaban
    Route::get('/kuis/hasil/{id_hasil}', [KuisController::class,'hasil'])->name('kuis.hasil'); // lihat hasil
    Route::get('/kuis/retry/{id_modul}', [KuisController::class,'retry'])->name('kuis.retry'); // coba lagi


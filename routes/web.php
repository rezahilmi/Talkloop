<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\UserController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/login', [UserController::class, 'showLogin'])->name('show.login');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'showRegister'])->name('show.register');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profil', [UserController::class, 'showProfil'])->name('profil');
    Route::put('/profil', [UserController::class, 'updateProfil'])->name('update.profil');
    Route::get('/forum', [ForumController::class, 'index'])->name('forum');
    Route::get('/kategori', [ForumController::class, 'showKategori'])->name('show.kategori');
    Route::post('/kategori', [ForumController::class, 'storeKategori'])->name('store.kategori');
    Route::put('/kategori/{id}', [ForumController::class, 'updateKategori'])->name('update.kategori');
    Route::delete('/kategori/{id}', [ForumController::class, 'destroyKategori'])->name('destroy.kategori');
    Route::post('/pertanyaan', [ForumController::class, 'storePertanyaan'])->name('store.pertanyaan');
    Route::get('/pertanyaan/{id}', [ForumController::class, 'show'])->name('pertanyaan');
    Route::delete('/pertanyaan/{id}', [ForumController::class, 'destroyPertanyaan'])->name('destroy.pertanyaan');
    Route::put('/pertanyaan/{id}', [ForumController::class, 'updatePertanyaan'])->name('update.pertanyaan');
    Route::post('/jawaban/{id}', [ForumController::class, 'storeJawaban'])->name('store.jawaban');
    Route::delete('/jawaban/{id}', [ForumController::class, 'destroyJawaban'])->name('destroy.jawaban');
    Route::put('/jawaban/{id}', [ForumController::class, 'updateJawaban'])->name('update.jawaban');
});

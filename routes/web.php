<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home');
});

Route::get('/jadwal-rapat', function () {
    return view('front.jadwal'); // akan membuka resources/views/jadwal-rapat.blade.php
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ⬇️ Tambahkan route ke halaman admin
Route::get('/back/home-admin', function () {
    return view('back.home-admin');
})->middleware(['auth'])->name('home-admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

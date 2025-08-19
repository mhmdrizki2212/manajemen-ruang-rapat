<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RuangUserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect('/admin')
            : redirect('/user');
    }
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| Dashboard (Default Breeze)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect(Auth::user()->role === 'admin' ? '/admin' : '/user');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Protected Routes Based on Role
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

    Route::resource('users', UserController::class);
    Route::resource('ruangs', RuangController::class);
    Route::resource('jadwals', JadwalController::class);

    Route::get('/get-ruangs/{gedungId}', [JadwalController::class, 'getRuangs']);
    // routes/web.php
    Route::get('/get-ruang/{gedung_id}', function($gedung_id) {
        $ruang = App\Models\Ruang::where('gedung_id', $gedung_id)->get();
        return response()->json($ruang);
    });
    // web.php
        Route::get('/get-lantai/{gedung_id}', [RuangController::class, 'getLantai']);
        Route::get('/get-ruang/{gedung_id}/{lantai}', [RuangController::class, 'getRuang']);
        Route::get('/ruangs/{id}/history', [\App\Http\Controllers\HistoryController::class, 'index'])
            ->name('ruangs.history');



});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', function () {
        return view('front.home');
    })->name('user.home');

    // Route tambahan khusus user
    Route::get('/user/jadwal', function () {
        return view('front.jadwal');
    })->name('user.jadwal');

    Route::get('/ruang/zona1', [RuangUserController::class, 'zona1'])->name('ruang.zona1');
    Route::get('/ruang/field', [RuangUserController::class, 'field'])->name('ruang.field');


});



/*
|--------------------------------------------------------------------------
| User Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Login/Register)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

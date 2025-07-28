<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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
    Route::get('/admin', function () {
        return view('back.home-admin');
    })->name('admin.home');

    Route::resource('users', UserController::class);



});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', function () {
        return view('front.home');
    })->name('user.home');

    // Route tambahan khusus user
    Route::get('/user/jadwal', function () {
        return view('front.jadwal');
    })->name('user.jadwal');
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

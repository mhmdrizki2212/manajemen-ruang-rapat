<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RuangUserController;
use App\Http\Controllers\JadwalUserController;


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
    Route::resource('jadwals', JadwalController::class)->except(['show']);
    Route::get('/check-jadwal', [JadwalController::class, 'checkJadwal']);

    Route::get('/get-ruangs/{gedungId}', [JadwalController::class, 'getRuangs']);
    Route::get('/get-ruang/{gedung_id}', function($gedung_id) {
        $ruang = App\Models\Ruang::where('gedung_id', $gedung_id)->get();
        return response()->json($ruang);
    });
    
    Route::get('/get-lantai/{gedung_id}', [RuangController::class, 'getLantai']);
    Route::get('/get-ruang/{gedung_id}/{lantai}', [RuangController::class, 'getRuang']);
    
    Route::get('/ruangs/{id}/history', [\App\Http\Controllers\HistoryController::class, 'index'])
        ->name('ruangs.history');

    Route::post('/jadwals/check', [App\Http\Controllers\JadwalController::class, 'checkJadwal'])
        ->name('jadwals.check');

    // ✅ Tambahan khusus request user
    Route::get('/jadwals/requests', [App\Http\Controllers\JadwalController::class, 'requestList'])
        ->name('jadwals.request');
   Route::post('/jadwals/{id}/approve', [JadwalController::class, 'approve'])->name('jadwals.approve');
    Route::post('/jadwals/{id}/reject', [JadwalController::class, 'reject'])->name('jadwals.reject');

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
Route::post('/ruang/store', [RuangUserController::class, 'store'])->name('ruang.store');


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

<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InputAspirasiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// route login siswa
Route::get('/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'loginProses'])->name('loginProses');

Route::middleware('auth:siswa')->group(function () {
    Route::post('/logout', [AuthManualController::class, 'logout'])->name('logout');
    Route::resource('input-aspirasi', InputAspirasiController::class)
        ->except(['edit', 'update']);
});

// ===== ADMIN ROUTES =====
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    });

    Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'registerProses'])->name('register.proses');

    Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'loginProses'])->name('loginProses');
    Route::delete(
        '/aspirasi/{inputAspirasi}',
        [InputAspirasiController::class, 'destroy']
    )->name('aspirasi.destroy');

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', function () {
            $totalPengaduan = \App\Models\InputAspirasi::count();
            $pengaduanProses = \App\Models\Aspirasi::where('status', 'Proses')->count();
            $pengaduanSelesai = \App\Models\Aspirasi::where('status', 'Selesai')->count();
            $pengaduanTerbaru = \App\Models\InputAspirasi::with(['siswa', 'category', 'aspirasi'])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('admin.dashboard', compact('totalPengaduan', 'pengaduanProses', 'pengaduanSelesai', 'pengaduanTerbaru'));
        })->name('dashboard');

        Route::get('/aspirasi', [InputAspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/{id}/edit-status', [InputAspirasiController::class, 'editStatus'])->name('aspirasi.editStatus');
        Route::put('/aspirasi/{id}/update-status', [InputAspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
        Route::resource('category', CategoryController::class);
        Route::resource('siswa', SiswaController::class);
    });
});

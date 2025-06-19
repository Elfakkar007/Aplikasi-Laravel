<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
    
    // Kendaraan (CRUD hanya untuk admin)
    Route::resource('kendaraan', KendaraanController::class);

    // Pemesanan (Admin lihat semua data pemesanan di sini)
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');

    // Fitur approval pemesanan
    Route::patch('/pemesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pemesanan.approve');
    Route::patch('/pemesanan/{id}/reject', [PemesananController::class, 'reject'])->name('pemesanan.reject');

    // Create/Store/Delete Pemesanan (oleh user)
    Route::resource('pemesanan', PemesananController::class)->except(['index']);

    // Aktivitas dan Export
    Route::get('/export', [AdminController::class, 'export'])->name('export');
    Route::get('/aktivitas', [AdminController::class, 'aktivitas'])->name('admin.aktivitas');
    Route::delete('/aktivitas/delete', [AdminController::class, 'deleteAll'])->name('aktivitas.delete');

    // Grafik
    Route::get('/grafik', [AdminController::class, 'grafik'])->name('admin.grafik');
});

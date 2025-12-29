<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriInventarisController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('pengajuan', PengajuanController::class);
    Route::get('pengajuan-peminjaman', [PengajuanController::class, 'peminjaman'])->name('pengajuan.peminjaman');
    Route::get('pengajuan-penyewaan', [PengajuanController::class, 'penyewaan'])->name('pengajuan.penyewaan');
    Route::get('pengajuan/{action}/cancel/{id}', [PengajuanController::class, 'cancel'])->name('pengajuan.cancel');
    Route::get('pengajuan/{action}/approve/{id}', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::get('pengajuan/{action}/reject/{id}', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
    Route::get('pengajuan/{action}/selesai/{id}', [PengajuanController::class, 'selesai'])->name('pengajuan.selesai');
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::resource('daftar-inventaris', InventarisController::class);
    });

    // Profile Management Routes
    Route::get('profile', [HomeController::class, 'profile'])->name('profile.edit');
    Route::put('profile', [HomeController::class, 'updateProfile'])->name('profile.update');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('manage-user', UserController::class);
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::resource('kategori-inventaris', KategoriInventarisController::class);
    });
    // Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
    // });
});

// Organisasi Routes
Route::middleware(['auth', 'organisasi'])->group(function () {
    // Route::prefix('inventaris')->name('inventaris.')->group(function () {
    //     Route::resource('daftar-inventaris', InventarisController::class);
    // });
});

// Organisasi Routes
Route::middleware(['auth', 'umum'])->group(function () {
    // Route::prefix('inventaris')->name('inventaris.')->group(function () {
    //     Route::resource('daftar-inventaris', InventarisController::class);
    // });
});

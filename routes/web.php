<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriInventarisController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::resource('daftar-inventaris', InventarisController::class);
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('manage-user', UserController::class);
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::resource('kategori-inventaris', KategoriInventarisController::class);
        // Route::resource('daftar-inventaris', InventarisController::class);
    });
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
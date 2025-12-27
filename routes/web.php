<?php

use App\Http\Controllers\KategoriInventarisController;
use App\Http\Controllers\InventarisController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Inventaris
Route::middleware(['auth'])->group(function () {
    Route::prefix('inventaris')->name('inventaris.')->group(function () {
        Route::resource('kategori-inventaris', KategoriInventarisController::class);
        Route::resource('daftar-inventaris', InventarisController::class);
    });
});

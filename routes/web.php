<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPitaController;
use App\Http\Controllers\PitaController;
use App\Http\Controllers\RestorasiController;
use App\Http\Controllers\RestorasiDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Kategori pita (master / kategori)
Route::resource('kategori', KategoriPitaController::class)
    ->parameters(['kategori' => 'kategoriPita'])
    ->except('show');

// Data utama: pita analog, dengan pilihan jamak kerusakan
Route::resource('pita', PitaController::class)
    ->parameters(['pita' => 'pita']);

// Data utama: proyek restorasi, dengan pilihan jamak peralatan
Route::resource('restorasi', RestorasiController::class);
Route::patch('restorasi/{restorasi}/status', [RestorasiController::class, 'updateStatus'])
    ->name('restorasi.status');

// Detail (tahapan) restorasi: CRUD bersarang
Route::prefix('restorasi/{restorasi}/detail')->name('restorasi.detail.')->group(function () {
    Route::post('/', [RestorasiDetailController::class, 'store'])->name('store');
    Route::put('{detail}', [RestorasiDetailController::class, 'update'])->name('update');
    Route::delete('{detail}', [RestorasiDetailController::class, 'destroy'])->name('destroy');
});

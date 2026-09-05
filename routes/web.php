<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterKelasController;

Route::middleware(['auth'])->group(function () {
    Route::get('/home', fn() => view('home'))->name('home');

    // Role: akun Kelas
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/beranda', [KelasController::class, 'beranda'])->name('beranda');
        Route::get('/scan', [KelasController::class, 'scan'])->name('scan');
        Route::get('/profile', [KelasController::class, 'profile'])->name('profile');
    });

    // Role: admin — kelola data master kelas
    Route::resource('admin/kelas', MasterKelasController::class)->names('admin.kelas');
});

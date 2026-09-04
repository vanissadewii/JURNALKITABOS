<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

     // Route untuk sisi siswa/akun kelas
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/beranda', [SiswaController::class, 'beranda'])->name('beranda');
        Route::get('/scan', [SiswaController::class, 'scan'])->name('scan');
        Route::get('/riwayat', [SiswaController::class, 'riwayat'])->name('riwayat');
        Route::get('/akun', [SiswaController::class, 'akun'])->name('akun');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterKelasController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/preview-beranda', function () {
    $kelas = (object) ['nama_kelas' => 'XI RPL 2'];
    return view('kelas.beranda', compact('kelas'));
});

// SEMENTARA - buat kamu ngerjain & ngecek tampilan tanpa nunggu login jadi
Route::prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/beranda', [KelasController::class, 'beranda'])->name('beranda');
    Route::get('/scan', [KelasController::class, 'scan'])->name('scan');
    Route::get('/verifikasiguru', function () {
        return view('kelas.verifikasiguru');})->name('verifikasiguru');
    Route::get('/verifikasisukses', function () {
        return view('kelas.verifikasisukses'); })->name('verifikasisukses');
    Route::get('/kirim-jurnal', [KelasController::class, 'kirimJurnal'])->name('kirim-jurnal');
    Route::get('/profile', [KelasController::class, 'profile'])->name('profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', fn() => view('home'))->name('home');
    Route::resource('admin/kelas', MasterKelasController::class)->names('admin.kelas');
});
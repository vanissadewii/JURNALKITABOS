<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterKelasController;
use Illuminate\Support\Facades\Route;

// Route ke profil-guru
Route::get('/profil-guru', function () {
    return view('guru.profil_guru');
});

// Route ke editprofil-guru
Route::get('/editprofil-guru', function () {
    return view('guru.editprofil_guru');
});

// Saat buka localhost langsung tampilkan halaman Login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Route ke Dashboard Guru
Route::get('/dashboard-guru', function () {
    return view('guru.dashboard_guru');
});

// Route ke Mulai Sesi
Route::get('/mulai-sesi', function () {
    return view('guru.mulai_sesi');
});

// Preview beranda kelas
Route::get('/preview-beranda', function () {
    $kelas = (object) ['nama_kelas' => 'XI RPL 2'];

    return view('kelas.beranda', compact('kelas'));
});

// SEMENTARA - buat ngerjain & ngecek tampilan kelas
Route::prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/beranda', [KelasController::class, 'beranda'])->name('beranda');

    Route::get('/scan', [KelasController::class, 'scan'])->name('scan');

    Route::get('/verifikasiguru', function () {
        return view('kelas.verifikasiguru');
    })->name('verifikasiguru');

    Route::get('/verifikasisukses', function () {
        return view('kelas.verifikasisukses');
    })->name('verifikasisukses');

    Route::get('/kirim-jurnal', [KelasController::class, 'kirimJurnal'])->name('kirim-jurnal');

    Route::get('/profile', [KelasController::class, 'profile'])->name('profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', fn () => view('home'))->name('home');

    Route::resource('admin/kelas', MasterKelasController::class)
        ->names('admin.kelas');
});

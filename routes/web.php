<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterKelasController;
use Illuminate\Support\Facades\Route;

// Halaman Pertama / Login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
});

// Fitur & Tampilan Guru
Route::get('/dashboard-guru', function () {
    return view('guru.dashboard_guru');
});

Route::get('/form-jurnal', function () {
    return view('guru.form_jurnal');
});

Route::get('/riwayat-jurnal', function () {
    return view('guru.riwayat_jurnal');
});

Route::get('/tampilkan-qr-guru', function () {
    return view('guru.tampilkan_qr_guru');
});

Route::get('/guru-scan-qr', function () {
    return view('guru.guru_scan_qr');
});

Route::get('/sesi-terverifikasi', function () {
    return view('guru.sesi_terverifikasi');
});

Route::get('/selesai-mengajar', function () {
    return view('guru.selesai_mengajar');
});

Route::get('/profil-guru', function () {
    return view('guru.profil_guru');
});

Route::get('/edit-profil', function () {
    return view('guru.edit_profil');
});

// Fitur & Preview Tampilan Kelas / Siswa
Route::get('/preview-beranda', function () {
    $kelas = (object) ['nama_kelas' => 'XI RPL 2'];

    return view('kelas.beranda', compact('kelas'));
});

Route::prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/beranda', [KelasController::class, 'beranda'])
        ->name('beranda');

    Route::get('/scan', [KelasController::class, 'scan'])
        ->name('scan');

    Route::get('/verifikasiguru', function () {
        return view('kelas.verifikasiguru');
    })->name('verifikasiguru');

    Route::get('/verifikasisukses', function () {
        return view('kelas.verifikasisukses');
    })->name('verifikasisukses');

    Route::view('/kirim-jurnal', 'kelas.kirim-jurnal')
        ->name('kirim-jurnal');

    Route::get('/profile', [KelasController::class, 'profile'])
        ->name('profile');
});

// Admin & Auth Group
Route::middleware(['auth'])->group(function () {
    Route::get('/home', fn () => view('home'))->name('home');

    Route::resource('admin/kelas', MasterKelasController::class)
        ->names('admin.kelas');
});

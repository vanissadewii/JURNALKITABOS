<?php

use App\Http\Controllers\DispenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MasterKelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route ke profil-guru
Route::get('/profil-guru', function () {
    return view('guru.profil_guru');
});

// Route ke editprofil-guru
Route::get('/editprofil_guru', function () {
    return view('guru.editprofil_guru');
});

Route::get('/guru-scan', function () {
    return view('guru.guru_scan_qr');
});

Route::get('/', function () {
    return redirect('/login');
});

// Route untuk Dashboard Admin
Route::get('/dashboard-admin', function () {
    return view('admin.dashboard_admin');
});

// Route untuk Dashboard/Beranda Kelas
Route::get('/dashboard-kelas', function () {
    return view('kelas.beranda');
});

// Route ke Dashboard Guru
Route::get('/dashboard-guru', function () {
    return view('guru.dashboard_guru');
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

    Route::view('/kirim-jurnal', 'kelas.kirim-jurnal')
        ->name('kirim-jurnal');

    Route::get('/profile', [KelasController::class, 'profile'])->name('profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $role_user = Auth::user()->role;

        if ($role_user == 'admin') {
            return view('admin.dashboard_admin');
        } elseif ($role_user == 'guru') {
            return view('guru.dashboard_guru');
        } elseif ($role_user == 'guru_piket') {
            return view('guru-piket.berandaguru');
        } elseif ($role_user == 'kelas') {
            return view('kelas.beranda');
        } else {
            return redirect('/');
        }
    })->name('home');
});

Route::resource('admin/kelas', MasterKelasController::class)
    ->names('admin.kelas');

Route::resource('admin/siswa', SiswaController::class)
    ->names('admin.siswa');

Route::resource('admin/user', UserController::class)
    ->names('admin.user');

Route::post('admin/siswa/import', [SiswaController::class, 'import'])->name('admin.siswa.import');

// Route Tampilkan QR Guru
Route::get('/tampilkan-qr-guru', function () {
    return view('guru.tampilkan_qr_guru');
});

Route::get('/sesi-verifikasi-guru', function () {
    return view('guru.sesi_terverifikasi');
});

Route::get('/form-jurnal', function () {
    return view('guru.form_jurnal');
});

Route::get('/riwayat-jurnal', function () {
    return view('guru.riwayat_jurnal');
});

Route::get('/detail-jurnal', function () {
    return view('guru.detail_jurnal');
});

Route::middleware(['auth'])->group(function () {

    // Route untuk Dashboard Guru Piket
    Route::get('/dashboard-guru-piket', function () {
        return view('guru-piket.berandaguru');
    })->name('dashboard-guru-piket');

    Route::get('/dispen', [DispenController::class, 'index'])->name('dispen.index');
    Route::post('/dispen', [DispenController::class, 'store'])->name('dispen.store');
    Route::get('/dispen/cari-siswa', [DispenController::class, 'cariSiswa'])->name('dispen.cari-siswa');
    Route::get('/dispen/opsi-jam', [DispenController::class, 'opsiJam'])->name('dispen.opsi-jam');
});

Route::get('/dispen/approval/{token}', [DispenController::class, 'halamanApproval'])->name('dispen.approval');
Route::post('/dispen/approval/{token}/setuju', [DispenController::class, 'setujui'])->name('dispen.approval.setuju');
Route::post('/dispen/approval/{token}/tolak', [DispenController::class, 'tolak'])->name('dispen.approval.tolak');

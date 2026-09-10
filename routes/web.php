<?php

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

// Route untuk Dashboard Guru Piket (Nanti kalau filenya sudah ada)
Route::get('/dashboard-guru_piket', function () {
    return view('piket.dashboard_guru_piket');
});

// Route untuk Dashboard/Beranda Kelas
Route::get('/dashboard-kelas', function () {
    return view('kelas.beranda');
});

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
    Route::get('/home', function () {
        $role_user = Auth::user()->role;

        if ($role_user == 'admin') {
            return view('admin.dashboard_admin');
        } elseif ($role_user == 'guru') {
            return view('guru.dashboard_guru');
        } elseif ($role_user == 'guru_piket') {
            return view('piket.dashboard_guru_piket');
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

Route::get('/selesai-mengajar', function () {
    return view('guru.selesai_mengajar');
});

Route::get('/form-jurnal', function () {
    return view('guru.form_jurnal');
});

Route::get('/riwayat-jurnal', function () {
    return view('guru.riwayat_jurnal');
});

pembaruan
Route::get('/detail-jurnal', function () {
    return view('guru.detail_jurnal');
});

Route::get('/guru-piket', function () {
    return view('guru-piket.berandaguru');
});
 develop

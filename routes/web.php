<?php

use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\JamPelajaranController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MasterKelasController;
use App\Http\Controllers\ProfilGuruController;
use App\Http\Controllers\QrSesiController;
use App\Http\Controllers\RiwayatJurnalController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Redirect setelah login, sesuai role
Route::get('/home', function () {
    return match (Auth::user()->role) {
        'admin' => view('admin.tambah_admin'),
        'guru' => app(GuruDashboardController::class)->index(),
        'kelas' => redirect()->route('kelas.beranda'),
        default => redirect('/'),
    };
})->name('home');

// ====================== ADMIN ======================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', fn () => view('admin.dashboard_admin'));
    Route::get('/admin/tambah', fn () => view('admin.tambah_admin'))->name('admin.tambah');

    Route::resource('admin/kelas', MasterKelasController::class)->names('admin.kelas');
    Route::resource('admin/siswa', SiswaController::class)->names('admin.siswa');
    Route::resource('admin/user', UserController::class)->names('admin.user');
    Route::post('admin/siswa/import', [SiswaController::class, 'import'])->name('admin.siswa.import');

    Route::get('admin/jadwal/get-jam', [JadwalPelajaranController::class, 'getJamByKelasHari'])->name('jadwal.get-jam');
    Route::resource('admin/jadwal', JadwalPelajaranController::class)->names('jadwal');
    Route::post('admin/jadwal/import', [JadwalPelajaranController::class, 'import'])->name('jadwal.import');

    Route::resource('admin/mapel', MapelController::class)->names('mapel');
    Route::resource('admin/semester', SemesterController::class)->names('semester');
    Route::post('/admin/semester/{id}/activate', [SemesterController::class, 'activate'])->name('semester.activate');
    Route::resource('admin/jam-pelajaran', JamPelajaranController::class)->names('jam-pelajaran');
    Route::post('admin/jam-pelajaran/generate', [JamPelajaranController::class, 'generate'])->name('jam-pelajaran.generate');
    Route::post('admin/jam-pelajaran/bulk-update', [JamPelajaranController::class, 'bulkUpdate'])->name('jam-pelajaran.bulk-update');
    Route::post('admin/jam-pelajaran/{id}/hapus', [JamPelajaranController::class, 'destroy'])->name('jam-pelajaran.hapus');
    Route::post('admin/jam-pelajaran/bulk-delete', [JamPelajaranController::class, 'bulkDestroy'])->name('jam-pelajaran.bulk-delete');
});

// ====================== GURU ======================
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard-guru', [GuruDashboardController::class, 'index'])->name('dashboard-guru');

    Route::get('/profil-guru', [ProfilGuruController::class, 'show'])->name('profil-guru');
    Route::get('/editprofil_guru', [ProfilGuruController::class, 'edit'])->name('profil-guru.edit');
    Route::post('/profil-guru', [ProfilGuruController::class, 'update'])->name('profil-guru.update');

    Route::get('/form-jurnal', [JurnalController::class, 'create'])->name('jurnal.create');
    Route::post('/form-jurnal', [JurnalController::class, 'store'])->name('jurnal.store');
    Route::get('/detail-jurnal/{jurnal}', [RiwayatJurnalController::class, 'show'])->name('jurnal.detail');
    Route::get('/riwayat-jurnal', [RiwayatJurnalController::class, 'index'])->name('riwayat-jurnal');

    Route::get('/guru-scan', fn () => view('guru.guru_scan_qr'))->name('guru.scan');
    Route::post('/guru/scan-kelas', [QrSesiController::class, 'guruScanKelas'])->name('guru.scan-kelas');
    Route::get('/guru/scan/status', [QrSesiController::class, 'guruStatus'])->name('guru.scan-status');
    Route::get('/guru/verifikasi-sukses/{jurnal}', [JurnalController::class, 'verifikasiSukses'])->name('guru.verifikasisukses');
});

// ====================== KELAS / SISWA ======================
Route::middleware(['auth', 'role:kelas'])->prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/beranda', [KelasController::class, 'beranda'])->name('beranda');
    Route::get('/scan', [KelasController::class, 'scan'])->name('scan');
    Route::get('/scan/status', [QrSesiController::class, 'kelasStatus'])->name('scan.status');
    Route::get('/profile', [KelasController::class, 'profile'])->name('profile');

    Route::get('/verifikasisukses/{qrSesi}', [KelasController::class, 'verifikasiSukses'])->name('verifikasisukses');
    Route::get('/kirim-jurnal', [KelasController::class, 'kirimJurnal'])->name('kirim-jurnal');
    Route::post('/kirim-jurnal', [KelasController::class, 'kirimJurnalStore'])->name('kirim-jurnal.store');

    Route::post('/qr/kelas/scan-guru', [QrSesiController::class, 'scanGuruQr'])->name('qr.scan-guru');
});

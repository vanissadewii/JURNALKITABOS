<?php

use App\Http\Controllers\DispenController;
use App\Http\Controllers\PiketRekapController;
use App\Http\Controllers\RiwayatJurnalController;
use App\Http\Controllers\ProfilGuruController;
use App\Http\Controllers\UploadTugasController;
use App\Http\Controllers\SuratSiswaController;
use App\Http\Controllers\AdminJadwalPiketController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMonitoringController;
use App\Http\Controllers\AdminRekapController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\JamPelajaranController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\PengaturanJurnalSusulanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MasterKelasController;
use App\Http\Controllers\QrSesiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Models\PengaturanJurnalSusulan;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Support\Waktu;
use Illuminate\Support\Facades\Route;

// Profil guru menggunakan kolom no_telepon yang sama seperti panel admin.
Route::middleware(['auth', 'role:guru,guru_piket'])->group(function () {
    Route::get('/profil-guru', [ProfilGuruController::class, 'show'])->name('profil-guru');
    Route::post('/profil-guru', [ProfilGuruController::class, 'update'])->name('profil-guru.update');
});

Route::middleware(['auth', 'role:guru,guru_piket'])->group(function () {
    Route::get('/guru-scan/{jurnal}', [QrSesiController::class, 'scanKelas'])
        ->name('guru.scan-kelas');
    Route::post('/guru-scan/{jurnal}', [QrSesiController::class, 'prosesScanKelas'])
        ->name('guru.scan-kelas.process');
});

Route::get('/', function () {
    return redirect('/login');
});

// Dashboard / Beranda Admin
Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// Menu Admin - Frontend
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // MENU ADMIN
    Route::get('/jurnal', [JurnalController::class, 'adminIndex'])->name('jurnal');
    Route::get('/aturan-jurnal-susulan', [PengaturanJurnalSusulanController::class, 'edit'])->name('aturan-jurnal-susulan.edit');
    Route::put('/aturan-jurnal-susulan', [PengaturanJurnalSusulanController::class, 'update'])->name('aturan-jurnal-susulan.update');
    Route::get('/kehadiran-guru', [AdminMonitoringController::class, 'kehadiran'])->name('kehadiran');
    Route::get('/verifikasi', [AdminMonitoringController::class, 'verifikasi'])->name('verifikasi');
    Route::get('/rekap/export', [AdminRekapController::class, 'export'])->name('rekap.export');
    Route::get('/rekap', [AdminRekapController::class, 'index'])->name('rekap');
    Route::get('/tambah', fn () => redirect()->route('admin.tambah.admin'))->name('tambah');

    Route::get('/tambah/admin', [AdminAccountController::class, 'index'])->name('tambah.admin');
    Route::post('/tambah/admin', [AdminAccountController::class, 'store'])->name('tambah.admin.store');
    Route::delete('/tambah/admin/{user}', [AdminAccountController::class, 'destroy'])->name('tambah.admin.destroy');


    Route::get('/tambah/piket', [AdminJadwalPiketController::class, 'index'])
        ->name('tambah.piket');
    Route::post('/tambah/piket/waka', [AdminJadwalPiketController::class, 'storeWaka'])
        ->name('tambah.piket.waka');
    Route::post('/tambah/piket/simpan', [AdminJadwalPiketController::class, 'store'])
        ->name('tambah.piket.store');
    Route::post('/tambah/piket/import', [AdminJadwalPiketController::class, 'import'])
        ->name('tambah.piket.import');


    Route::get('/tambah/siswa', fn () => redirect()->route('admin.siswa.index'))
        ->name('tambah.siswa');
    Route::get('/tambah/jadwal', fn () => redirect()->route('jadwal.index'))
        ->name('tambah.jadwal');
    Route::get('/tambah/jam', fn () => redirect()->route('jam-pelajaran.index'))
        ->name('tambah.jam');
    Route::get('/tambah/mapel', fn () => redirect()->route('mapel.index'))
        ->name('tambah.mapel');
    Route::get('/tambah/kelas', fn () => redirect()->route('admin.kelas.index'))
        ->name('tambah.kelas');
    Route::get('/tambah/semester', fn () => redirect()->route('semester.index'))
        ->name('tambah.semester');
    Route::get('/tambah/user', fn () => redirect()->route('admin.user.index'))
        ->name('tambah.user');
    Route::get('/profil', fn () => redirect()->route('admin.dashboard'))->name('profil');
    Route::post('/profil', [AdminProfileController::class, 'update'])->name('profil.update');
    Route::get('/guru', fn () => redirect()->route('admin.user.index'))
        ->name('guru');
    Route::get('/sesi', fn () => redirect()->route('admin.jurnal'))
        ->name('sesi');
});

// ============================================================
// ROUTE KELAS
// ============================================================

// Route untuk Dashboard/Beranda Kelas
Route::get('/dashboard-kelas', fn () => redirect()->route('kelas.beranda'))
    ->middleware(['auth']);

// Route ke Dashboard Guru
Route::get('/dashboard-guru', [\App\Http\Controllers\GuruDashboardController::class, 'index'])
    ->middleware(['auth', 'role:guru,guru_piket'])->name('dashboard-guru');

// Beranda memakai kelas yang benar-benar terhubung ke akun login.
Route::get('/kelas/beranda', [KelasController::class, 'beranda'])
    ->middleware(['auth', 'role:kelas'])
    ->name('kelas.beranda');

// Halaman operasional lainnya tetap khusus akun kelas.
Route::middleware(['auth', 'role:kelas'])->prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/scan', [KelasController::class, 'scan'])->name('scan');

    Route::get('/verifikasiguru', [QrSesiController::class, 'halamanVerifikasiGuru'])->name('verifikasiguru');

    Route::get('/kirim-jurnal', [KelasController::class, 'kirimJurnal'])
        ->name('kirim-jurnal');
    Route::post('/kirim-jurnal', [KelasController::class, 'kirimJurnalStore'])
        ->name('kirim-jurnal.store');

    Route::get('/profile', [KelasController::class, 'profile'])->name('profile');
    Route::put('/profile', [KelasController::class, 'updateProfile'])->name('profile.update');
});


// ============================================================
// HOME BERDASARKAN ROLE
// ============================================================

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $role_user = Auth::user()->role;

        // ADMIN → BERANDA ADMIN BARU
        if ($role_user == 'admin') {
            return redirect()->route('admin.dashboard');

        // GURU
        } elseif ($role_user == 'guru') {
            return redirect()->route('dashboard-guru');

        // GURU PIKET (akun lama)
        } elseif ($role_user == 'guru_piket') {
            return redirect()->route('dashboard-guru-piket');

        // KELAS
        } elseif ($role_user == 'kelas') {
            return redirect()->route('kelas.beranda');

        } else {
            return redirect('/');
        }
    })->name('home');
});


// ============================================================
// ROUTE ADMIN - BACKEND
// ============================================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('admin/kelas', MasterKelasController::class)
        ->names('admin.kelas');

    Route::resource('admin/siswa', SiswaController::class)
        ->names('admin.siswa');

    Route::resource('admin/user', UserController::class)
        ->names('admin.user');

    Route::post('admin/user/import', [UserController::class, 'import'])->name('admin.user.import');

    Route::post(
        'admin/siswa/import',
        [SiswaController::class, 'import']
    )->name('admin.siswa.import');


    Route::get(
        'admin/jadwal/get-jam',
        [JadwalPelajaranController::class, 'getJamByKelasHari']
    )->name('jadwal.get-jam');

    Route::delete(
        'admin/jadwal/hapus-grup',
        [JadwalPelajaranController::class, 'destroyGroup']
    )->name('jadwal.destroy-group');

    Route::resource('admin/jadwal', JadwalPelajaranController::class)
        ->names('jadwal');


    Route::post('admin/mapel/import', [MapelController::class, 'import'])
        ->name('mapel.import');

    Route::resource('admin/mapel', MapelController::class)
        ->names('mapel');

    Route::resource('admin/semester', SemesterController::class)
        ->names('semester');

    Route::patch('admin/semester/{id}/activate', [SemesterController::class, 'activate'])
        ->name('semester.activate');

    Route::resource('admin/jam-pelajaran', JamPelajaranController::class)
        ->names('jam-pelajaran');


    Route::post(
        'admin/jam-pelajaran/generate',
        [JamPelajaranController::class, 'generate']
    )->name('jam-pelajaran.generate');

    Route::patch('admin/jam-pelajaran/pengaturan/kegiatan', [JamPelajaranController::class, 'updateKegiatan'])
        ->name('jam-pelajaran.kegiatan.update');

    Route::post(
        'admin/jadwal/import',
        [JadwalPelajaranController::class, 'import']
    )->name('jadwal.import');
});


// ============================================================
// ROUTE JAM PELAJARAN
// ============================================================

// ============================================================
// ROUTE QR GURU
// ============================================================

// Route Tampilkan QR Guru
Route::middleware(['auth', 'role:guru,guru_piket'])->group(function () {

    Route::get(
        '/qr/guru/{jurnal}',
        [QrSesiController::class, 'tampilkanQrGuru']
    )->name('qr.tampilkan-guru');

    Route::get(
        '/qr/guru/{jurnal}/status',
        [QrSesiController::class, 'cekStatusGuru']
    )->name('qr.status-guru');
});


// ============================================================
// ROUTE QR KELAS
// ============================================================

Route::middleware(['auth', 'role:kelas'])->group(function () {

    Route::get('/qr/kelas/status', [QrSesiController::class, 'kelasStatus'])
        ->name('qr.status-kelas');

    Route::post(
        '/qr/kelas/scan-guru',
        [QrSesiController::class, 'scanGuruQr']
    )->name('qr.scan-guru');
});


// ============================================================
// ROUTE SESI VERIFIKASI GURU
// ============================================================

Route::get('/sesi-verifikasi-guru', function () {
    return view('guru.sesi_terverifikasi');
});


// ============================================================
// ROUTE JURNAL GURU
// ============================================================

Route::middleware(['auth', 'role:guru,guru_piket'])->group(function () {

    Route::get(
        '/form-jurnal',
        [JurnalController::class, 'create']
    )->name('jurnal.create');

    Route::post(
        '/form-jurnal',
        [JurnalController::class, 'store']
    )->name('jurnal.store');
});


// ============================================================
// RIWAYAT & DETAIL JURNAL
// ============================================================

Route::get('/riwayat-jurnal', [RiwayatJurnalController::class, 'index'])->middleware(['auth', 'role:guru,guru_piket'])->name('riwayat-jurnal');
Route::get('/detail-jurnal/{jurnal}', [RiwayatJurnalController::class, 'show'])->middleware(['auth', 'role:guru,guru_piket'])->name('riwayat-jurnal.detail');


// ============================================================
// ROUTE GURU PIKET & DISPEN
// ============================================================

Route::middleware(['auth'])->group(function () {

    // Dashboard Guru Piket
    Route::get('/dashboard-guru-piket', [GuruPiketController::class, 'beranda'])
        ->middleware(['role:guru,guru_piket', 'piket.aktif'])->name('dashboard-guru-piket');

    Route::prefix('piket')->name('piket.')->middleware(['role:guru,guru_piket', 'piket.aktif'])->group(function () {
        Route::get('/jurnal-mengajar', [JurnalController::class, 'piketIndex'])->name('jurnal');

        Route::post('/jurnal-mengajar/{jurnal}/approve', [JurnalController::class, 'approve'])->name('jurnal.approve');

        Route::post('/jurnal-mengajar/{jurnal}/tolak', [JurnalController::class, 'reject'])->name('jurnal.reject');

        Route::get('/dispensasi-siswa', [DispenController::class, 'index'])
            ->name('dispen');

        Route::get('/input-surat', [SuratSiswaController::class, 'index'])->name('input-surat');
        Route::post('/input-surat', [SuratSiswaController::class, 'store'])->name('input-surat.store');

        Route::get('/upload-tugas', [UploadTugasController::class, 'create'])
            ->name('upload-tugas');
        Route::post('/upload-tugas', [UploadTugasController::class, 'store'])
            ->name('upload-tugas.store');

    });

    // Rekap hanya baca, sehingga bisa dibuka di luar jam piket.
    Route::prefix('piket')->name('piket.')->middleware(['role:guru,guru_piket', 'piket.aktif'])->group(function () {
        Route::get('/rekap', [PiketRekapController::class, 'index'])->name('rekap');
        Route::get('/rekap/export', [PiketRekapController::class, 'export'])->name('rekap.export');
    });


    Route::get(
        '/dispen',
        [DispenController::class, 'index']
    )->middleware(['role:guru,guru_piket', 'piket.aktif'])->name('dispen.index');

    Route::post(
        '/dispen',
        [DispenController::class, 'store']
    )->middleware(['role:guru,guru_piket', 'piket.aktif'])->name('dispen.store');

    Route::get(
        '/dispen/cari-siswa',
        [DispenController::class, 'cariSiswa']
    )->middleware(['role:guru,guru_piket', 'piket.aktif'])->name('dispen.cari-siswa');

    Route::get(
        '/dispen/opsi-jam',
        [DispenController::class, 'opsiJam']
    )->middleware(['role:guru,guru_piket', 'piket.aktif'])->name('dispen.opsi-jam');
});


// ============================================================
// APPROVAL DISPEN
// ============================================================

Route::get(
    '/dispen/approval/{token}',
    [DispenController::class, 'halamanApproval']
)->name('dispen.approval');

Route::post(
    '/dispen/approval/{token}/setuju',
    [DispenController::class, 'setujui']
)->name('dispen.approval.setuju');

Route::post(
    '/dispen/approval/{token}/tolak',
    [DispenController::class, 'tolak']
)->name('dispen.approval.tolak');

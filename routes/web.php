<?php

use App\Http\Controllers\DispenController;
use App\Http\Controllers\JadwalPelajaranController;
use App\Http\Controllers\JamPelajaranController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MasterKelasController;
use App\Http\Controllers\QrSesiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route ke profil-guru
Route::middleware(['auth', 'role:guru,guru_piket'])->group(function () {
    Route::get('/profil-guru', function () {
        $user = Auth::user();

        return view('guru.profil_guru', compact('user'));
    });

    Route::post('/profil-guru', function (Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'mapel' => ['required', 'string', 'max:100'],
            'password_lama' => ['nullable', 'string'],
            'password_baru' => ['nullable', 'string', 'min:8'],
        ]);

        $user = $request->user();
        if (! empty($validated['password_baru'])) {
            if (empty($validated['password_lama']) || ! Hash::check($validated['password_lama'], $user->password)) {
                return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.'])->withInput();
            }

            $user->password = Hash::make($validated['password_baru']);
        }

        $user->name = $validated['name'];
        $user->no_telepon = $validated['no_telepon'] ?? null;
        $user->mapel = $validated['mapel'];

        $user->save();

        return redirect('/profil-guru')->with('success', 'Profil berhasil diperbarui.');
    });
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
Route::get('/dashboard-admin', function () {
    return view('admin.dashboard_admin');
})->name('admin.dashboard');

// Menu Admin - Frontend
Route::prefix('admin')->name('admin.')->group(function () {

    // MENU ADMIN
    Route::view('/jurnal', 'admin.jurnal')->name('jurnal');
    Route::view('/verifikasi', 'admin.verifikasi')->name('verifikasi');
    Route::view('/rekap', 'admin.rekap')->name('rekap');
    Route::view('/tambah', 'admin.tambah_admin')->name('tambah');

    Route::view(
        '/tambah/admin',
        'admin.tambah_admin'
    )->name('tambah.admin');


    Route::view(
        '/tambah/piket',
        'admin.admin-guru-piket'
    )->name('tambah.piket');


    Route::view(
        '/tambah/siswa',
        'admin.tambah_siswa'
    )->name('tambah.siswa');


});

// ============================================================
// ROUTE KELAS
// ============================================================

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


// ============================================================
// HOME BERDASARKAN ROLE
// ============================================================

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $role_user = Auth::user()->role;

        // ADMIN → BERANDA ADMIN BARU
        if ($role_user == 'admin') {
            return view('admin.dashboard_admin');

        // GURU
        } elseif ($role_user == 'guru') {
            return view('guru.dashboard_guru');

        // GURU PIKET
        } elseif ($role_user == 'guru_piket') {
            return view('guru.piket');

        // KELAS
        } elseif ($role_user == 'kelas') {
            return view('kelas.beranda');

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

    Route::post(
        'admin/siswa/import',
        [SiswaController::class, 'import']
    )->name('admin.siswa.import');


    Route::get(
        'admin/jadwal/get-jam',
        [JadwalPelajaranController::class, 'getJamByKelasHari']
    )->name('jadwal.get-jam');

    Route::resource('admin/jadwal', JadwalPelajaranController::class)
        ->names('jadwal');


    Route::resource('admin/mapel', MapelController::class)
        ->names('mapel');

    Route::resource('admin/semester', SemesterController::class)
        ->names('semester');

    Route::resource('admin/jam-pelajaran', JamPelajaranController::class)
        ->names('jam-pelajaran');


    Route::post(
        'admin/jam-pelajaran/generate',
        [JamPelajaranController::class, 'generate']
    )->name('jam-pelajaran.generate');

    Route::post(
        'admin/jadwal/import',
        [JadwalPelajaranController::class, 'import']
    )->name('jadwal.import');
});


// ============================================================
// ROUTE JAM PELAJARAN
// ============================================================

Route::resource('admin/jam-pelajaran', JamPelajaranController::class)
    ->names('jam-pelajaran');


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

Route::middleware(['auth'])->group(function () {

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

Route::get('/riwayat-jurnal', function () {
    return view('guru.riwayat_jurnal');
});

Route::get('/detail-jurnal', function () {
    return view('guru.detail_jurnal');
});


// ============================================================
// ROUTE GURU PIKET & DISPEN
// ============================================================

Route::middleware(['auth'])->group(function () {

    // Dashboard Guru Piket
    Route::get('/dashboard-guru-piket', function () {
        return view('guru.piket');
    })->name('dashboard-guru-piket');

    Route::prefix('piket')->name('piket.')->group(function () {
        Route::view('/jurnal-mengajar', 'guru.jurnal-mengajar')
            ->name('jurnal');

        Route::post('/jurnal-mengajar/{jurnal}/approve', [JurnalController::class, 'approve'])
            ->name('jurnal.approve');

        Route::post('/jurnal-mengajar/{jurnal}/tolak', [JurnalController::class, 'reject'])
            ->name('jurnal.reject');

        Route::get('/dispensasi-siswa', [DispenController::class, 'index'])
            ->name('dispen');

        Route::view('/upload-tugas', 'guru.upload-tugas')
            ->name('upload-tugas');
    });


    Route::get(
        '/dispen',
        [DispenController::class, 'index']
    )->name('dispen.index');

    Route::post(
        '/dispen',
        [DispenController::class, 'store']
    )->name('dispen.store');

    Route::get(
        '/dispen/cari-siswa',
        [DispenController::class, 'cariSiswa']
    )->name('dispen.cari-siswa');

    Route::get(
        '/dispen/opsi-jam',
        [DispenController::class, 'opsiJam']
    )->name('dispen.opsi-jam');
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
<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\QrSesi;
use Illuminate\Support\Str;

class JurnalController extends Controller
{
    public function create(): View
{
    $user = Auth::user();
    $sekarang = now();
    $hari = 'Senin';
    $jamSekarang = '07:10:00';

    $jadwalAktif = JadwalPelajaran::where('id_guru', $user->id)
        ->whereHas('jamPelajaran', function ($q) use ($hari, $jamSekarang) {
            $q->where('hari', $hari)
              ->where('jam_mulai', '<=', $jamSekarang)
              ->where('jam_selesai', '>=', $jamSekarang);
        })
        ->with(['kelas', 'jamPelajaran', 'mapel'])
        ->first();

    $daftarSiswa = collect();

    if ($jadwalAktif) {
        $daftarSiswa = Siswa::where('id_kelas', $jadwalAktif->id_kelas)
            ->orderBy('nama')
            ->get();
    }

    return view('guru.form_jurnal', compact('jadwalAktif', 'daftarSiswa'));
}

    public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'id_jadwal'    => 'required|exists:jadwal_pelajaran,id_jadwal',
        'materi'       => 'required|string',
        'keterangan'   => 'nullable|string',
        'jumlah_hadir' => 'nullable|integer|min:0',
    ]);

    $jadwal = JadwalPelajaran::where('id_jadwal', $validated['id_jadwal'])
        ->where('id_guru', Auth::id())
        ->firstOrFail();

    $jurnal = Jurnal::create([
        'id_jadwal'    => $jadwal->id_jadwal,
        'tanggal'      => now()->toDateString(),
        'materi'       => $validated['materi'],
        'keterangan'   => $validated['keterangan'] ?? null,
        'jumlah_hadir' => $validated['jumlah_hadir'] ?? null,
        'waktu_submit' => now(),
    ]);

    QrSesi::create([
        'id_jadwal'      => $jadwal->id_jadwal,
        'id_jurnal'      => $jurnal->id_jurnal,
        'tipe'           => 'guru',
        'kode_qr'        => (string) Str::uuid(),
        'waktu_generate' => now(),
        'waktu_expired'  => now()->addMinutes(5),
        'status'         => 'aktif',
    ]);

    return redirect()->route('qr.tampilkan-guru', $jurnal->id_jurnal);
}
}

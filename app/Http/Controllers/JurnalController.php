<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\Siswa;
use App\Services\VerifikasiSesiService;
use App\Support\Waktu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JurnalController extends Controller
{
    public function create(Request $request, VerifikasiSesiService $sesi): View|RedirectResponse
    {
        $guru = Auth::user();

        $jadwalAktif = $request->query('jadwal')
            ? JadwalPelajaran::with(['kelas', 'mapel', 'jamPelajaran'])
                ->where('id_guru', $guru->id)
                ->where('id_jadwal', (int) $request->query('jadwal'))
                ->first()
            : $sesi->jadwalBerlangsung(idGuru: (int) $guru->id);

        if (! $jadwalAktif) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Tidak ada sesi mengajar yang sedang berlangsung.');
        }

        if (! $sesi->masihBerjalan($jadwalAktif)) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Sesi pelajaran ini sudah selesai, jurnal tidak bisa diisi lagi.');
        }

        $jurnal = $sesi->jurnalSesi($jadwalAktif); // draft yang sudah pernah diisi (kalau ada)

        if ($jurnal && $jurnal->status_verifikasi === 'terverifikasi') {
            return redirect()->route('guru.verifikasisukses', $jurnal);
        }

        if ($jurnal) {
            return redirect()->route('guru.scan')
                ->with('info', 'Jurnal sudah terkirim, tinggal verifikasi kehadiran lewat scan QR kelas.');
        }

        $daftarSiswa = Siswa::where('id_kelas', $jadwalAktif->id_kelas)->orderBy('nama')->get();
        $rentang = $sesi->rentang($jadwalAktif);

        return view('guru.form_jurnal', compact('jadwalAktif', 'daftarSiswa', 'rentang'));
    }

    public function store(Request $request, VerifikasiSesiService $sesi): RedirectResponse
    {
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal_pelajaran,id_jadwal',
            'materi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'jumlah_hadir' => 'nullable|integer|min:0',
            'siswa_absen' => 'nullable|array',
            'siswa_absen.*.nama' => 'required_with:siswa_absen|string',
            'siswa_absen.*.status' => 'required_with:siswa_absen|in:Sakit,Izin,Alpha',
        ]);

        $jadwal = JadwalPelajaran::where('id_jadwal', $validated['id_jadwal'])
            ->where('id_guru', Auth::id())
            ->firstOrFail();

        if (! $sesi->masihBerjalan($jadwal)) {
            return redirect()->route('dashboard-guru')
                ->with('error', 'Sesi pelajaran ini sudah selesai, jurnal tidak bisa dikirim lagi.');
        }

        if ($sesi->jurnalSesi($jadwal)) {
            return redirect()->route('guru.scan')
                ->with('info', 'Jurnal sesi ini sudah terkirim, tinggal verifikasi.');
        }

        $keterangan = $validated['catatan'] ?? '';
        if (! empty($validated['siswa_absen'])) {
            $daftarAbsen = collect((array) $validated['siswa_absen'])
                ->map(fn ($s) => "{$s['nama']} ({$s['status']})")
                ->implode(', ');
            $keterangan = trim($keterangan."\nTidak hadir: ".$daftarAbsen);
        }

        $jurnal = Jurnal::create([
            'id_jadwal' => $jadwal->id_jadwal,
            'tanggal' => Waktu::sekarang()->toDateString(),
            'status_kehadiran_guru' => 'hadir',
            'status_verifikasi' => 'belum_verifikasi',
            'materi' => $validated['materi'] ?? null,
            'keterangan' => $keterangan ?: null,
            'jumlah_hadir' => $validated['jumlah_hadir'] ?? null,
            'waktu_submit' => Waktu::sekarang(),
        ]);
        foreach ($validated['siswa_absen'] ?? [] as $s) {
            $jurnal->absenSiswa()->create(['nama' => $s['nama'], 'status' => $s['status']]);
        }

        return redirect()->route('guru.scan')
            ->with('success', 'Jurnal terkirim. Verifikasi kehadiran dengan scan QR kelas sekarang.');
    }

    public function verifikasiSukses(Request $request, Jurnal $jurnal): View
    {
        $jurnal->load('jadwal.kelas', 'jadwal.mapel');

        abort_if((int) $jurnal->jadwal->id_guru !== (int) $request->user()->id, 403);

        return view('guru.verifikasisukses', compact('jurnal'));
    }
}

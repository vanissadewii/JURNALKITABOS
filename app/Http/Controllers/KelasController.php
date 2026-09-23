<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\PengirimanJurnalKelas;
use App\Models\QrSesi;
use App\Services\SesiKelasService;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelasController extends Controller
{
    /** Satu tempat untuk waktu "sekarang" (gampang dipalsukan saat tes). */
    private function sekarang(): CarbonInterface
    {
        return Carbon::parse('2026-09-21 08:00');
        // UNTUK TES (hari Sabtu/Minggu): ganti return di atas dengan baris ini, kembalikan setelah selesai
        // return Carbon::parse('2026-09-21 16:00');
    }

    public function beranda(Request $request, SesiKelasService $service): View
    {
        $kelas = $request->user()->kelas;

        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $sekarang = $this->sekarang();
        $sesi = $service->sesiHariIni($kelas, $sekarang);

        $jurnalHariIni = Jurnal::with(['absenSiswa', 'dispensasi.siswa'])
            ->whereIn('id_jadwal', $sesi->pluck('ids')->flatten()->all())
            ->whereDate('tanggal', $sekarang->toDateString())
            ->get();

        $sesi = $sesi->map(function ($s) use ($jurnalHariIni) {
            $s->jurnal = $jurnalHariIni->whereIn('id_jadwal', $s->ids)->last();

            return $s;
        });

        $sesiAktif = $sesi->where('status', '!=', 'Selesai')->values();
        $sesiSelesai = $sesi->where('status', 'Selesai')->values();

        return view('kelas.beranda', compact('kelas', 'sesiAktif', 'sesiSelesai'));
    }

    public function scan(): View
    {
        return view('kelas.scan');
    }

    public function verifikasiSukses(Request $request, QrSesi $qrSesi): View
    {
        // hanya akun yang memindai QR ini yang boleh melihat halaman sukses
        abort_if((int) $qrSesi->dipindai_oleh !== (int) $request->user()->id, 403);

        $qrSesi->load('jadwal.guru', 'jadwal.mapel', 'jadwal.kelas');

        return view('kelas.verifikasisukses', compact('qrSesi'));
    }

    public function kirimJurnal(Request $request, SesiKelasService $service): View
    {
        $kelas = $request->user()->kelas;

        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $sekarang = $this->sekarang();
        $sesi = $service->sesiHariIni($kelas, $sekarang);

        // semua jurnal hari ini untuk jadwal-jadwal di sesi tersebut
        $jurnalHariIni = Jurnal::with('absenSiswa')
            ->whereIn('id_jadwal', $sesi->pluck('ids')->flatten()->all())
            ->whereDate('tanggal', $sekarang->toDateString())
            ->orderBy('id_jurnal')
            ->get();

        $rekap = $sesi->map(function ($s) use ($jurnalHariIni) {
            $s->jurnal = $jurnalHariIni->whereIn('id_jadwal', $s->ids)->last(); // yang terbaru

            return $s;
        });

        $semuaSelesai = $sesi->isNotEmpty() && $sesi->every(fn ($s) => $s->status === 'Selesai');

        $pengiriman = PengirimanJurnalKelas::where('id_kelas', $kelas->id_kelas)
            ->whereDate('tanggal', $sekarang->toDateString())
            ->first();

        return view('kelas.kirim-jurnal', compact('kelas', 'rekap', 'semuaSelesai', 'pengiriman'));
    }

    public function kirimJurnalStore(Request $request, SesiKelasService $service): RedirectResponse
    {
        $kelas = $request->user()->kelas;

        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $sekarang = $this->sekarang();
        $sesi = $service->sesiHariIni($kelas, $sekarang);

        if ($sesi->isEmpty() || $sesi->contains(fn ($s) => $s->status !== 'Selesai')) {
            return back()->with('error', 'Masih ada sesi yang belum selesai.');
        }

        PengirimanJurnalKelas::firstOrCreate(
            ['id_kelas' => $kelas->id_kelas, 'tanggal' => $sekarang->toDateString()],
            ['dikirim_oleh' => $request->user()->id, 'dikirim_at' => now()],
        );

        return redirect()->route('kelas.kirim-jurnal')->with('success', 'Jurnal hari ini berhasil dikirim.');
    }

    public function profile(): View
    {
        return view('kelas.profile');
    }
}

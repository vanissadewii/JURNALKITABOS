<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
<<<<<<< HEAD
use App\Models\PengirimanJurnalKelas;
use App\Models\QrSesi;
=======
use App\Models\Dispen;
use App\Models\PengirimanJurnalKelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
>>>>>>> putri/tampilan-admin
use App\Services\SesiKelasService;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    /** Satu tempat untuk waktu "sekarang" (gampang dipalsukan saat tes). */
    private function sekarang(): CarbonInterface
    {
<<<<<<< HEAD
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
=======
        return Carbon::now();
>>>>>>> putri/tampilan-admin
    }

    public function beranda(Request $request, SesiKelasService $service): View
    {
        $kelas = $request->user()->kelas;

        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $sekarang = $this->sekarang();
        $sesi = $service->sesiHariIni($kelas, $sekarang);
        $tugasPiket = DB::table('upload_tugas')->where('id_kelas', $kelas->id_kelas)
            ->whereDate('tanggal', $sekarang->toDateString())->latest('id_upload_tugas')->get();

        $dispensasiDisetujui = Dispen::with('siswa')
            ->where('id_kelas', $kelas->id_kelas)
            ->whereDate('tanggal', $sekarang->toDateString())
            ->where('status', 'disetujui')
            ->orderBy('jam_ke_mulai')
            ->get();

        $jurnalHariIni = Jurnal::with(['absenSiswa', 'dispensasi.siswa'])
            ->whereIn('id_jadwal', $sesi->pluck('ids')->flatten()->all())
            ->whereDate('tanggal', $sekarang->toDateString())
            ->where('status_verifikasi', 'terverifikasi')
            ->get();

        $sesi = $sesi->map(function ($s) use ($jurnalHariIni) {
            $s->jurnal = $jurnalHariIni->whereIn('id_jadwal', $s->ids)->last();

            return $s;
        });

        $sesiAktif = $sesi->where('status', '!=', 'Selesai')->values();
        $sesiSelesai = $sesi->where('status', 'Selesai')->values();

        return view('kelas.beranda', compact('kelas', 'sesiAktif', 'sesiSelesai', 'dispensasiDisetujui', 'tugasPiket'));
    }

<<<<<<< HEAD
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
=======
    public function scan(Request $request): View
>>>>>>> putri/tampilan-admin
    {
        return view('kelas.scan', [
            'kelas' => $request->user()->kelas,
            'qrImage' => null,
        ]);
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
            ->where('status_verifikasi', 'terverifikasi')
            ->orderBy('id_jurnal')
            ->get();

        $rekap = $sesi->map(function ($s) use ($jurnalHariIni) {
            $s->jurnal = $jurnalHariIni->whereIn('id_jadwal', $s->ids)->last(); // yang terbaru

            return $s;
        });

        $semuaSelesai = $rekap->isNotEmpty() && $rekap->every(fn ($s) => $s->status === 'Selesai' && $s->jurnal?->status_verifikasi === 'terverifikasi');

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

        $idJadwal = $sesi->pluck('ids')->flatten()->all();
        $terverifikasi = Jurnal::whereIn('id_jadwal', $idJadwal)
            ->whereDate('tanggal', $sekarang->toDateString())
            ->where('status_verifikasi', 'terverifikasi')->pluck('id_jadwal')->unique()->all();
        $siapDikirim = $sesi->isNotEmpty() && $sesi->every(fn ($item) =>
            $item->status === 'Selesai' && collect($item->ids)->diff($terverifikasi)->isEmpty()
        );
        if (! $siapDikirim) {
            return back()->with('error', 'Semua sesi harus selesai dan terverifikasi sebelum jurnal dikirim.');
        }

        PengirimanJurnalKelas::firstOrCreate(
            ['id_kelas' => $kelas->id_kelas, 'tanggal' => $sekarang->toDateString()],
            ['dikirim_oleh' => $request->user()->id, 'dikirim_at' => now()],
        );

        return redirect()->route('kelas.kirim-jurnal')->with('success', 'Jurnal hari ini berhasil dikirim.');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_if(! $user->id_kelas, 404, 'Akun ini belum terhubung ke kelas.');
        $siswaDalamKelas = fn () => Rule::exists('siswa', 'id_siswa')->where('id_kelas', $user->id_kelas);
        $validated = $request->validate([
            'id_ketua_kelas' => ['nullable', 'integer', $siswaDalamKelas()],
            'id_sekretaris_1' => ['nullable', 'integer', $siswaDalamKelas()],
            'id_sekretaris_2' => ['nullable', 'integer', $siswaDalamKelas()],
        ]);
        $terpilih = array_filter(array_values($validated), fn ($id) => $id !== null && $id !== '');
        if (count($terpilih) !== count(array_unique($terpilih))) {
            return back()->withInput()->withErrors(['pengurus' => 'Pilih siswa yang berbeda untuk setiap jabatan.']);
        }

        $validated += ['nama_ketua_kelas' => null, 'nama_sekretaris' => null, 'nama_sekretaris_2' => null];
        $user->update($validated);

        return redirect()->route('kelas.profile')->with('success', 'Pengurus kelas berhasil disimpan.');
    }

    public function profile(Request $request): View
    {
        $kelas = $request->user()->kelas;
        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $siswa = Siswa::where('id_kelas', $kelas->id_kelas)->orderBy('nama')->get(['id_siswa', 'nama', 'no_absen']);
        $jumlahSiswa = $siswa->count();
        $adminPhone = config('jurnal.admin_phone');

        return view('kelas.profile', [
            'kelas' => $kelas,
            'user' => $request->user(),
            'jumlahSiswa' => $jumlahSiswa,
            'siswa' => $siswa,
            'adminPhone' => $adminPhone,
        ]);
    }
}

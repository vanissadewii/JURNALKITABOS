<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\PengirimanJurnalKelas;
use App\Models\Siswa;
use App\Services\SesiKelasService;
use App\Support\Waktu;
use Carbon\CarbonInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class KelasController extends Controller
{
    /** Satu tempat untuk waktu "sekarang" (gampang dipalsukan saat tes). */
    private function sekarang(): CarbonInterface
    {
        return Waktu::sekarang();
    }

    public function beranda(Request $request, SesiKelasService $service): View
    {
        $kelas = $request->user()->kelas;

        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $sekarang = $this->sekarang();
        $sesi = $service->sesiHariIni($kelas, $sekarang);
        $tugasPiket = DB::table('upload_tugas')->where('id_kelas', $kelas->id_kelas)
            ->whereDate('tanggal', $sekarang->toDateString())->latest('id_upload_tugas')->get();

        $jurnalHariIni = Jurnal::with(['absenSiswa', 'dispensasi.siswa', 'dispensasi.waka', 'dispensasi.guruPiket'])
            ->whereIn('id_jadwal', $sesi->pluck('ids')->flatten()->all())
            ->whereDate('tanggal', $sekarang->toDateString())
            ->where('status_verifikasi', 'terverifikasi')
            ->get();

        $sesi = $sesi->map(function ($s) use ($jurnalHariIni, $tugasPiket) {
            $s->jurnal = $jurnalHariIni->whereIn('id_jadwal', $s->ids)->last();
            $s->tugas = $tugasPiket->first(fn ($tugas) => $tugas->id_jadwal && in_array((int) $tugas->id_jadwal, $s->ids));

            return $s;
        });

        $sesiAktif = $sesi->where('status', '!=', 'Selesai')->values();
        $sesiSelesai = $sesi->where('status', 'Selesai')->values();

        return view('kelas.beranda', compact('kelas', 'sesiAktif', 'sesiSelesai', 'tugasPiket'));
    }

    public function scan(Request $request): View
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
            ->whereNotNull('waktu_submit')
            ->where('status_verifikasi', 'terverifikasi')
            ->orderBy('id_jurnal')
            ->get();
        $tugasHariIni = DB::table('upload_tugas')->where('id_kelas', $kelas->id_kelas)
            ->whereDate('tanggal', $sekarang->toDateString())
            ->orderByDesc('created_at')
            ->get();

        $rekap = $sesi->map(function ($s) use ($jurnalHariIni, $tugasHariIni) {
            $s->jurnal = $jurnalHariIni->whereIn('id_jadwal', $s->ids)->last();
            $s->tugas = $tugasHariIni->first(fn ($tugas) => $tugas->id_jadwal && in_array((int) $tugas->id_jadwal, $s->ids));

            return $s;
        });
        $totalSiswa = Siswa::where('id_kelas', $kelas->id_kelas)->count();

        $pengiriman = PengirimanJurnalKelas::where('id_kelas', $kelas->id_kelas)
            ->whereDate('tanggal', $sekarang->toDateString())
            ->first();
        $bisaKirim = $rekap->isNotEmpty() && (! $pengiriman || $pengiriman->status === 'ditolak');

        return view('kelas.kirim-jurnal', compact('kelas', 'rekap', 'bisaKirim', 'pengiriman', 'totalSiswa'));
    }

    public function kirimJurnalStore(Request $request, SesiKelasService $service): RedirectResponse
    {
        $kelas = $request->user()->kelas;

        abort_if(! $kelas, 404, 'Akun ini belum terhubung ke kelas.');

        $sekarang = $this->sekarang();
        $sesi = $service->sesiHariIni($kelas, $sekarang);

        if ($sesi->isEmpty()) {
            return back()->with('error', 'Tidak ada sesi pelajaran hari ini untuk dikirim.');
        }

        $pengiriman = PengirimanJurnalKelas::firstOrNew([
            'id_kelas' => $kelas->id_kelas,
            'tanggal' => $sekarang->toDateString(),
        ]);
        if ($pengiriman->exists && $pengiriman->status !== 'ditolak') {
            return back()->with('error', 'Rekap jurnal hari ini sudah dikirim dan sedang menunggu atau sudah selesai diperiksa.');
        }

        $pengiriman->fill([
            'dikirim_oleh' => $request->user()->id,
            'dikirim_at' => now(),
            'status' => 'menunggu',
            'alasan_tolak' => null,
            'id_diperiksa_oleh' => null,
            'diperiksa_at' => null,
        ])->save();

        return redirect()->route('kelas.kirim-jurnal')->with('success', 'Rekap jurnal hari ini berhasil dikirim untuk diperiksa guru piket.');
    }

    public function unduhTugas(Request $request, int $id): Response
    {
        $tugas = DB::table('upload_tugas')->where('id_upload_tugas', $id)
            ->where('id_kelas', $request->user()->id_kelas)
            ->first();
        abort_if(! $tugas || ! $tugas->file_path, 404);
        abort_unless(Storage::disk('public')->exists($tugas->file_path), 404, 'Lampiran tidak ditemukan.');

        return Storage::disk('public')->response($tugas->file_path);
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

<?php

namespace App\Http\Controllers;

use App\Models\Dispen;
use App\Models\JadwalPelajaran;
use App\Models\JadwalPiketBulanan;
use App\Models\Jurnal;
use App\Support\Waktu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminMonitoringController extends Controller
{
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    public function kehadiran(Request $request): View
    {
        $data = $request->validate(['tanggal' => ['nullable', 'date_format:Y-m-d']]);
        $tanggal = Carbon::parse($data['tanggal'] ?? Waktu::sekarang()->toDateString());
        $hari = self::NAMA_HARI[$tanggal->dayOfWeekIso];

        $jadwal = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->whereHas('jamPelajaran', fn ($q) => $q->where('hari', $hari)
                ->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
            ->get()
            ->filter(fn ($item) => $item->jamPelajaran && $item->kelas && $item->guru)
            ->sortBy(fn ($item) => $item->jamPelajaran->jam_mulai)
            ->values();
        $jurnal = Jurnal::with('absenSiswa')->whereDate('tanggal', $tanggal->toDateString())->get()->groupBy('id_jadwal');
        $barisKehadiran = $jadwal->map(function ($item) use ($jurnal) {
            $item->jurnalHariIni = $jurnal->get($item->id_jadwal)?->sortByDesc('id_jurnal')->first();
            $status = strtolower((string) $item->jurnalHariIni?->status_kehadiran_guru);
            $item->statusTampilan = $status === 'tidak_hadir' ? 'tidak-hadir' : ($status ?: 'belum');
            return $item;
        });
        $ringkasan = ['semua' => $barisKehadiran->count(), 'hadir' => 0, 'izin' => 0, 'sakit' => 0, 'tidak-hadir' => 0, 'belum' => 0];
        foreach ($barisKehadiran as $item) {
            $key = $item->statusTampilan;
            if (array_key_exists($key, $ringkasan)) $ringkasan[$key]++;
        }

        return view('admin.kehadiran-guru', compact('tanggal', 'barisKehadiran', 'ringkasan'));
    }

    public function verifikasi(Request $request): View
    {
        $data = $request->validate(['tanggal' => ['nullable', 'date_format:Y-m-d']]);
        $tanggal = $data['tanggal'] ?? Waktu::sekarang()->toDateString();
        $waktu = Waktu::sekarang();
        $piketHariIni = JadwalPiketBulanan::with(['guru', 'waka'])
            ->whereDate('tanggal', $tanggal)->orderByRaw("FIELD(sesi, 'pagi', 'siang', 'waka')")->orderBy('urutan')->get()
            ->map(function ($item) use ($waktu, $tanggal) {
                $mulai = substr((string) $item->jam_mulai, 0, 5);
                $selesai = substr((string) $item->jam_selesai, 0, 5);
                $jamSekarang = $waktu->format('H:i');
                $item->statusTampilan = $tanggal !== $waktu->toDateString()
                    ? 'Terjadwal'
                    : ($item->sesi === 'waka'
                        ? 'Bertugas'
                        : ($jamSekarang < $mulai ? 'Belum mulai' : ($jamSekarang <= $selesai ? 'Bertugas' : 'Selesai')));
                return $item;
            });
        $dispensasi = Dispen::with(['siswa', 'kelas', 'guruPiket'])
            ->whereDate('tanggal', $tanggal)->orderBy('created_at')->get();
        $tingkat = ['10' => 'X', '11' => 'XI', '12' => 'XII'];

        return view('admin.verifikasi', compact('tanggal', 'piketHariIni', 'dispensasi', 'tingkat'));
    }
}

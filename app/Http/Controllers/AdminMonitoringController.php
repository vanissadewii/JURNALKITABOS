<?php

namespace App\Http\Controllers;

use App\Models\Dispen;
use App\Exports\KehadiranGuruExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\JadwalPelajaran;
use App\Models\JadwalPiketBulanan;
use App\Models\JamPelajaran;
use App\Models\Jurnal;
use App\Support\Waktu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
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
            ->values();
        $jadwal = $this->terapkanJamMaju($jadwal, $hari)->sortBy(fn ($item) => $item->jamPelajaran->jam_mulai)->values();
        $jurnal = Jurnal::with('absenSiswa')->whereDate('tanggal', $tanggal->toDateString())->get()->groupBy('id_jadwal');
        $tugas = DB::table('upload_tugas')->whereDate('tanggal', $tanggal->toDateString())->get()->keyBy('id_jadwal');
        $barisKehadiran = $jadwal->map(function ($item) use ($jurnal, $tugas, $tanggal) {
            $item->jurnalHariIni = $jurnal->get($item->id_jadwal)?->sortByDesc('id_jurnal')->first();
            $item->tugasPiketHariIni = $tugas->get($item->id_jadwal);
            $item->statusTampilan = $this->statusKehadiranTampilan($item, $item->jurnalHariIni, $item->tugasPiketHariIni, $tanggal);
            return $item;
        });
        $ringkasan = ['semua' => $barisKehadiran->count(), 'hadir' => 0, 'izin' => 0, 'sakit' => 0, 'tidak-hadir' => 0, 'belum' => 0];
        foreach ($barisKehadiran as $item) {
            $key = $item->statusTampilan;
            if (array_key_exists($key, $ringkasan)) $ringkasan[$key]++;
        }

        return view('admin.kehadiran-guru', compact('tanggal', 'barisKehadiran', 'ringkasan'));
    }

    public function exportKehadiran(Request $request): BinaryFileResponse
    {
        $data = $request->validate(['tanggal' => ['nullable', 'date_format:Y-m-d']]);
        $tanggal = Carbon::parse($data['tanggal'] ?? Waktu::sekarang()->toDateString());
        $hari = self::NAMA_HARI[$tanggal->dayOfWeekIso];
        $jadwal = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->whereHas('jamPelajaran', fn ($q) => $q->where('hari', $hari)->whereHas('semester', fn ($sem) => $sem->where('status', 'aktif')))
            ->get()->filter(fn ($item) => $item->jamPelajaran && $item->kelas && $item->guru)->values();
        $jadwal = $this->terapkanJamMaju($jadwal, $hari)->sortBy(fn ($item) => $item->jamPelajaran->jam_mulai)->values();
        $jurnals = Jurnal::whereDate('tanggal', $tanggal->toDateString())->whereNotNull('waktu_submit')->latest('id_jurnal')->get()->groupBy('id_jadwal');
        $tugas = DB::table('upload_tugas')->whereDate('tanggal', $tanggal->toDateString())->get()->keyBy('id_jadwal');
        $rows = $jadwal->map(function ($item) use ($jurnals, $tugas, $tanggal) {
            $jurnal = $jurnals->get($item->id_jadwal)?->first();
            $status = $this->statusKehadiranTampilan($item, $jurnal, $tugas->get($item->id_jadwal), $tanggal);
            $labelStatus = match ($status) {
                'hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'tidak-hadir' => 'Tidak Hadir', default => 'Belum ada jurnal',
            };
            return [$item->guru->name, $item->mapel->nama_mapel ?? '', $labelStatus, $jurnal?->materi ?: $jurnal?->keterangan ?: '', $item->kelas->nama_kelas, $item->jamPelajaran->jam_ke, substr($item->jamPelajaran->jam_mulai,0,5).'-'.substr($item->jamPelajaran->jam_selesai,0,5)];
        })->all();
        return Excel::download(new KehadiranGuruExport($rows), 'kehadiran-guru-'.$tanggal->format('Y-m-d').'.xlsx');
    }

    /** Terapkan slot jam sebelumnya saat kegiatan hari tersebut ditiadakan. */
    private function terapkanJamMaju(Collection $jadwal, string $hari): Collection
    {
        if (! (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $hari)->value('kegiatan_ditiadakan')) {
            return $jadwal;
        }

        $semesterIds = $jadwal->pluck('jamPelajaran.id_semester')->filter()->unique()->values();
        $slotPerHari = JamPelajaran::whereIn('id_semester', $semesterIds)
            ->where('hari', $hari)->get()
            ->groupBy(fn ($slot) => $slot->id_semester.'|'.$slot->tingkat.'|'.$slot->jam_ke);

        return $jadwal->map(function ($item) use ($slotPerHari) {
            $jamAsli = $item->jamPelajaran;
            if ((int) $jamAsli->jam_ke <= 1) {
                return $item;
            }

            $slotSebelumnya = $slotPerHari->get($jamAsli->id_semester.'|'.$jamAsli->tingkat.'|'.((int) $jamAsli->jam_ke - 1))?->first();
            if ($slotSebelumnya) {
                $jamTampilan = clone $jamAsli;
                $jamTampilan->jam_ke = $slotSebelumnya->jam_ke;
                $jamTampilan->jam_mulai = $slotSebelumnya->jam_mulai;
                $jamTampilan->jam_selesai = $slotSebelumnya->jam_selesai;
                $item->setRelation('jamPelajaran', $jamTampilan);
            }

            return $item;
        });
    }

    private function statusKehadiranTampilan(JadwalPelajaran $jadwal, ?Jurnal $jurnal, ?object $tugas, Carbon $tanggal): string
    {
        $statusTugas = strtolower((string) $tugas?->status_guru);
        if (in_array($statusTugas, ['izin', 'sakit'], true)) {
            return $statusTugas;
        }

        $statusJurnal = strtolower((string) $jurnal?->status_kehadiran_guru);
        if (in_array($statusJurnal, ['hadir', 'izin', 'sakit', 'tidak_hadir'], true)) {
            return $statusJurnal === 'tidak_hadir' ? 'tidak-hadir' : $statusJurnal;
        }

        $sekarang = Waktu::sekarang();
        if ($tanggal->toDateString() < $sekarang->toDateString()) {
            return 'tidak-hadir';
        }
        if ($tanggal->toDateString() === $sekarang->toDateString()) {
            $mulai = substr((string) $jadwal->jamPelajaran->jam_mulai, 0, 8);
            $selesai = substr((string) $jadwal->jamPelajaran->jam_selesai, 0, 8);
            $akhirSesi = Carbon::parse($tanggal->toDateString().' '.$selesai, $sekarang->timezone);
            if ($selesai <= $mulai) {
                $akhirSesi->addDay();
            }
            if ($sekarang->greaterThanOrEqualTo($akhirSesi)) {
                return 'tidak-hadir';
            }
        }

        return 'belum';
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

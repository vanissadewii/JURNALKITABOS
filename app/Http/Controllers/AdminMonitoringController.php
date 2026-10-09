<?php

namespace App\Http\Controllers;

use App\Exports\KehadiranGuruExport;
use App\Models\Dispen;
use App\Models\JadwalPelajaran;
use App\Models\JadwalPiketBulanan;
use App\Models\JamPelajaran;
use App\Models\Jurnal;
use App\Support\KegiatanTanggal;
use App\Support\Waktu;
use App\Support\PulangCepat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminMonitoringController extends Controller
{
    private const NAMA_HARI = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    public function kehadiran(Request $request): View
    {
        $data = $request->validate(['hari' => ['nullable', 'in:Senin,Selasa,Rabu,Kamis,Jumat'], 'guru' => ['nullable', 'string', 'max:255'], 'tanggal' => ['nullable', 'date_format:Y-m-d']]);
        $tanggal = Carbon::parse($data['tanggal'] ?? Waktu::sekarang()->toDateString());
        $hari = $data['hari'] ?? (self::NAMA_HARI[$tanggal->dayOfWeekIso] ?? 'Senin');
        $namaKegiatan = (self::NAMA_HARI[$tanggal->dayOfWeekIso] ?? null) === $hari ? KegiatanTanggal::nama($tanggal) : null;

        $jadwalSemua = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->whereHas('jamPelajaran', fn ($q) => $q->whereIn('hari', ['Senin','Selasa','Rabu','Kamis','Jumat'])->whereHas('semester', fn ($s) => $s->where('status', 'aktif')))
            ->get()->filter(fn ($item) => $item->jamPelajaran && $item->kelas && $item->guru)->values();
        $namaGuru = $jadwalSemua->pluck('guru.name')->filter()->unique()->sort()->values();
        $jadwalSemua = $jadwalSemua->filter(fn ($item) => $item->jamPelajaran->hari === $hari && (empty($data['guru']) || mb_stripos($item->guru->name, $data['guru']) !== false));
        $totalJamGuru = $jadwalSemua->groupBy(fn ($item) => $item->guru->id)->map(fn ($items) => $items->count());
        $mapelGuru = $jadwalSemua->groupBy(fn ($item) => $item->guru->id)->map(fn ($items) => $items->pluck('mapel.nama_mapel')->filter()->unique()->values());

        $jadwal = $jadwalSemua;
        if ($namaKegiatan) {
            $jadwal = collect();
        }
        $jadwal = $this->terapkanJamMaju($jadwal, $hari)->sortBy(fn ($item) => $item->jamPelajaran->jam_mulai)->values();
        $jurnal = Jurnal::with('absenSiswa')->whereDate('tanggal', $tanggal->toDateString())
            ->whereNotNull('waktu_submit')->where('status_verifikasi', 'terverifikasi')
            ->orderByDesc('id_jurnal')->get()->groupBy('id_jadwal');
        $tugasQuery = DB::table('upload_tugas')->whereDate('tanggal', $tanggal->toDateString())->whereNotNull('id_jadwal')->orderByDesc('created_at');
        if (Schema::hasColumn('upload_tugas', 'status_review')) {
            $tugasQuery->where('status_review', 'disetujui');
        }
        $tugas = $tugasQuery->get()->unique('id_jadwal')->keyBy('id_jadwal');
        $barisKehadiran = $jadwal->map(function ($item) use ($jurnal, $tugas, $tanggal) {
            $item->jurnalHariIni = $jurnal->get($item->id_jadwal)?->sortByDesc('id_jurnal')->first();
            $item->tugasPiketHariIni = $tugas->get($item->id_jadwal);
            $item->statusTampilan = $this->statusKehadiranTampilan($item, $item->jurnalHariIni, $item->tugasPiketHariIni, $tanggal);

            return $item;
        });
        $ringkasan = ['semua' => $barisKehadiran->count(), 'hadir' => 0, 'izin' => 0, 'sakit' => 0, 'tidak-hadir' => 0, 'pulang-cepat' => 0, 'belum' => 0];
        foreach ($barisKehadiran as $item) {
            $key = $item->statusTampilan;
            if (array_key_exists($key, $ringkasan)) {
                $ringkasan[$key]++;
            }
        }

        $hariPilihan = $hari;
        return view('admin.kehadiran-guru', compact('tanggal', 'hari', 'hariPilihan', 'namaGuru', 'totalJamGuru', 'mapelGuru', 'barisKehadiran', 'ringkasan', 'namaKegiatan'));
    }

    public function exportKehadiran(Request $request): BinaryFileResponse
    {
        $data = $request->validate(['tanggal' => ['nullable', 'date_format:Y-m-d']]);
        $tanggal = Carbon::parse($data['tanggal'] ?? Waktu::sekarang()->toDateString());
        $hari = self::NAMA_HARI[$tanggal->dayOfWeekIso];
        $namaKegiatan = KegiatanTanggal::nama($tanggal);
        $jadwal = JadwalPelajaran::with(['kelas', 'mapel', 'guru', 'jamPelajaran'])
            ->whereHas('jamPelajaran', fn ($q) => $q->where('hari', $hari)->whereHas('semester', fn ($sem) => $sem->where('status', 'aktif')))
            ->get()->filter(fn ($item) => $item->jamPelajaran && $item->kelas && $item->guru)->values();
        if ($namaKegiatan) {
            $jadwal = collect();
        }
        $jadwal = $this->terapkanJamMaju($jadwal, $hari)->sortBy(fn ($item) => $item->jamPelajaran->jam_mulai)->values();
        $jurnals = Jurnal::whereDate('tanggal', $tanggal->toDateString())->whereNotNull('waktu_submit')
            ->where('status_verifikasi', 'terverifikasi')->latest('id_jurnal')->get()->groupBy('id_jadwal');
        $tugasQuery = DB::table('upload_tugas')->whereDate('tanggal', $tanggal->toDateString())->whereNotNull('id_jadwal')->orderByDesc('created_at');
        if (Schema::hasColumn('upload_tugas', 'status_review')) {
            $tugasQuery->where('status_review', 'disetujui');
        }
        $tugas = $tugasQuery->get()->unique('id_jadwal')->keyBy('id_jadwal');
        $rows = $jadwal->map(function ($item) use ($jurnals, $tugas, $tanggal) {
            $jurnal = $jurnals->get($item->id_jadwal)?->first();
            $status = $this->statusKehadiranTampilan($item, $jurnal, $tugas->get($item->id_jadwal), $tanggal);
            $labelStatus = match ($status) {
                'hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'tidak-hadir' => 'Tidak Hadir', 'pulang-cepat' => 'Pulang Cepat', default => 'Belum ada jurnal',
            };

            return [$item->guru->name, $item->mapel->nama_mapel ?? '', $labelStatus, $jurnal?->materi ?: $jurnal?->keterangan ?: '', $item->kelas->nama_kelas, $item->jamPelajaran->jam_ke, substr($item->jamPelajaran->jam_mulai, 0, 5).'-'.substr($item->jamPelajaran->jam_selesai, 0, 5)];
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
        $hariJadwal = $jadwal->jamPelajaran?->hari;
        if ($hariJadwal && PulangCepat::berlaku($hariJadwal, (int) $jadwal->jamPelajaran->jam_ke)) {
            return 'pulang-cepat';
        }
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
            ->whereDate('tanggal', $tanggal)->whereNotNull('id_waka_piket')->orderByDesc('created_at')->orderByDesc('id_dispen')->get()
            ->unique(fn (Dispen $item) => mb_strtolower(trim(($item->siswa?->nama ?? '').'|'.($item->kelas?->id_kelas ?? ''))))->values();
        $suratSiswa = DB::table('surat_siswa as ss')
            ->join('siswa as s', 's.id_siswa', '=', 'ss.id_siswa')
            ->join('kelas as k', 'k.id_kelas', '=', 'ss.id_kelas')
            ->leftJoin('users as u', 'u.id', '=', 'ss.id_guru_piket')
            ->whereDate('ss.tanggal', $tanggal)->orderByDesc('ss.updated_at')->orderByDesc('ss.id')
            ->get(['ss.tanggal', 'ss.status', 's.nama as nama_siswa', 'ss.id_kelas', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru_piket'])
            ->unique(fn ($item) => mb_strtolower(trim($item->nama_siswa.'|'.$item->id_kelas)))->values();
        $tingkat = ['10' => 'X', '11' => 'XI', '12' => 'XII'];

        return view('admin.verifikasi', compact('tanggal', 'piketHariIni', 'dispensasi', 'suratSiswa', 'tingkat'));
    }
}

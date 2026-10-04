<?php

namespace App\Http\Controllers;

use App\Exports\PiketRekapExport;
use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Support\Waktu;
use App\Support\KegiatanTanggal;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PiketRekapController extends Controller
{
    private const JENIS = ['jurnal', 'dispen', 'surat', 'tugas'];

    public function index(Request $request): View
    {
        [$mulai, $sampai, $jenis] = $this->filters($request);
        $rows = $this->rows($mulai, $sampai);
        $counts = collect(self::JENIS)->mapWithKeys(fn ($key) => [$key => count(array_filter($rows, fn ($row) => $row[1] === $this->label($key)))]);
        $visible = $jenis === 'semua' ? $rows : array_values(array_filter($rows, fn ($row) => $row[1] === $this->label($jenis)));

        return view('guru.rekap-piket', [
            'rows' => $visible,
            'counts' => $counts,
            'jenis' => $jenis,
            'mulai' => $mulai,
            'sampai' => $sampai,
            'jumlahSemua' => count($rows),
        ]);
    }

    public function export(Request $request): BinaryFileResponse
    {
        [$mulai, $sampai, $jenis] = $this->filters($request);
        $rows = $this->rows($mulai, $sampai);
        if ($jenis !== 'semua') {
            $rows = array_values(array_filter($rows, fn ($row) => $row[1] === $this->label($jenis)));
        }

        $nama = 'rekap-piket-'.$jenis.'-'.$mulai.'-sampai-'.$sampai.'.xlsx';

        return Excel::download(new PiketRekapExport($rows), $nama);
    }

    /** @return array{string, string, string} */
    private function filters(Request $request): array
    {
        $data = $request->validate([
            'mulai' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:mulai'],
            'jenis' => ['nullable', 'in:semua,jurnal,dispen,surat,tugas'],
        ], [
            'mulai.date' => 'Tanggal awal tidak valid. Pilih tanggal yang benar.',
            'sampai.date' => 'Tanggal akhir tidak valid. Pilih tanggal yang benar.',
            'sampai.after_or_equal' => 'Tanggal sampai harus sama dengan atau setelah tanggal mulai.',
            'jenis.in' => 'Jenis rekap tidak valid.',
        ]);
        $hariIni = Waktu::sekarang()->toDateString();
        $mulai = Carbon::parse($data['mulai'] ?? Waktu::sekarang()->startOfMonth())->toDateString();
        $sampai = Carbon::parse($data['sampai'] ?? $hariIni)->toDateString();

        return [$mulai, $sampai, $data['jenis'] ?? 'semua'];
    }

    /** @return array<int, array<int, string|null>> */
    private function rows(string $mulai, string $sampai): array
    {
        $result = [];

        array_push($result, ...$this->rowsKehadiranGuru($mulai, $sampai));

        $dispen = DB::table('dispens as d')->join('siswa as s', 's.id_siswa', '=', 'd.id_siswa')
            ->join('kelas as k', 'k.id_kelas', '=', 'd.id_kelas')->leftJoin('users as u', 'u.id', '=', 'd.id_guru_piket')
            ->leftJoin('waka as w', 'w.id', '=', 'd.id_waka')
            ->whereBetween('d.tanggal', [$mulai, $sampai])->orderByDesc('d.updated_at')->orderByDesc('d.id_dispen')
            ->get(['d.tanggal', 'd.created_at', 's.nama as siswa', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 'w.nama as nama_waka', 'd.nomor_surat', 'd.jam_ke_mulai', 'd.jam_ke_selesai', 'd.alasan', 'd.status'])
            ->unique(fn ($item) => mb_strtolower(trim($item->siswa).'|'.$item->tingkat.'|'.$item->jurusan.'|'.$item->rombel.'|'.$item->tanggal));
        foreach ($dispen as $item) {
            $rentang = $item->jam_ke_selesai ? 'Jam ke-'.$item->jam_ke_mulai.' s/d '.$item->jam_ke_selesai : 'Jam ke-'.$item->jam_ke_mulai.' s/d selesai';
            $hariDispen = ucfirst(Carbon::parse($item->tanggal)->locale('id')->dayName);
            $guruMengajar = JadwalPelajaran::with('guru')
                ->where('id_kelas', function ($query) use ($item) {
                    $query->select('id_kelas')->from('kelas')
                        ->where('tingkat', $item->tingkat)
                        ->where('jurusan', $item->jurusan)
                        ->where('rombel', $item->rombel);
                })
                ->whereHas('jamPelajaran', fn ($query) => $query
                    ->where('hari', $hariDispen)
                    ->whereBetween('jam_ke', [(int) $item->jam_ke_mulai, (int) ($item->jam_ke_selesai ?? 13)]))
                ->get()
                ->pluck('guru.name')->filter()->unique()->implode(', ');
            $result[] = [Carbon::parse($item->tanggal)->format('d/m/Y'), 'Dispensasi Siswa', $this->kelas($item), $item->siswa, $item->guru,
                null, trim($item->nomor_surat.' | '.$rentang.' | '.$item->alasan), ucfirst($item->status), $guruMengajar ?: null, $item->guru, $item->nama_waka];
        }

        $surat = DB::table('surat_siswa as ss')->join('siswa as s', 's.id_siswa', '=', 'ss.id_siswa')
            ->join('kelas as k', 'k.id_kelas', '=', 'ss.id_kelas')->leftJoin('users as u', 'u.id', '=', 'ss.id_guru_piket')
            ->whereBetween('ss.tanggal', [$mulai, $sampai])->orderByDesc('ss.updated_at')->orderByDesc('ss.id')
            ->get(['ss.tanggal', 'ss.updated_at', 's.nama as siswa', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 'ss.status'])
            ->unique(fn ($item) => mb_strtolower(trim($item->siswa).'|'.$item->tingkat.'|'.$item->jurusan.'|'.$item->rombel.'|'.$item->tanggal));
        foreach ($surat as $item) {
            $result[] = [Carbon::parse($item->tanggal)->format('d/m/Y'), 'Input Surat', $this->kelas($item), $item->siswa, $item->guru, null, 'Surat/status siswa', $item->status, null, $item->guru, null];
        }

        $tugas = DB::table('upload_tugas as t')->join('kelas as k', 'k.id_kelas', '=', 't.id_kelas')
            ->leftJoin('users as u', 'u.id', '=', 't.id_guru_piket')
            ->leftJoin('jadwal_pelajaran as jp', 'jp.id_jadwal', '=', 't.id_jadwal')
            ->leftJoin('users as pengajar', 'pengajar.id', '=', 'jp.id_guru')
            ->whereBetween('t.created_at', [$mulai.' 00:00:00', $sampai.' 23:59:59'])->orderBy('t.created_at')
            ->get(['t.created_at', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 'pengajar.name as nama_pengajar', 't.mapel', 't.status_guru', 't.alasan_izin', 't.tugas']);
        foreach ($tugas as $item) {
            $result[] = [Carbon::parse($item->created_at)->format('d/m/Y'), 'Upload Tugas', $this->kelas($item), null, $item->guru,
                $item->mapel, trim(implode(' | ', array_filter(['Status guru: '.$item->status_guru, $item->alasan_izin ? 'Alasan izin: '.$item->alasan_izin : null, 'Tugas: '.$item->tugas]))), $item->status_guru, $item->nama_pengajar, $item->guru, null];
        }

        usort($result, fn ($a, $b) => [Carbon::createFromFormat('d/m/Y', $a[0])->format('Y-m-d'), $a[1], $a[2]] <=> [Carbon::createFromFormat('d/m/Y', $b[0])->format('Y-m-d'), $b[1], $b[2]]);

        return $result;
    }

    /** @return array<int, array<int, string|null>> */
    private function rowsKehadiranGuru(string $mulai, string $sampai): array
    {
        $jurnals = DB::table('jurnal as j')
            ->join('jadwal_pelajaran as jp', 'jp.id_jadwal', '=', 'j.id_jadwal')
            ->join('kelas as k', 'k.id_kelas', '=', 'jp.id_kelas')
            ->leftJoin('users as u', 'u.id', '=', 'jp.id_guru')
            ->leftJoin('mapel as m', 'm.id_mapel', '=', 'jp.id_mapel')
            ->leftJoin('jam_pelajaran as jam', 'jam.id_jam', '=', 'jp.id_jam')
            ->whereBetween('j.tanggal', [$mulai, $sampai])
            ->whereNotNull('j.waktu_submit')
            ->orderByDesc('j.waktu_submit')->orderByDesc('j.id_jurnal')
            ->get([
                'j.id_jurnal', 'j.id_jadwal', 'j.tanggal', 'j.status_verifikasi', 'j.status_kehadiran_guru',
                'j.materi', 'j.keterangan', 'j.jumlah_hadir', 'jp.id_guru', 'jp.id_kelas', 'jp.id_mapel',
                'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru',
                'm.nama_mapel', 'jam.jam_ke', 'jam.jam_mulai', 'jam.jam_selesai',
            ])
            ->unique(fn ($jurnal) => $jurnal->id_guru.'|'.$jurnal->id_kelas.'|'.$jurnal->id_mapel.'|'.$jurnal->tanggal.'|'.$jurnal->jam_ke)
            ->values();

        $result = [];
        foreach ($jurnals as $jurnal) {
            if (KegiatanTanggal::jadwalDitiadakan((string) $jurnal->tanggal)) {
                continue;
            }

            $jamKe = (int) ($jurnal->jam_ke ?? 0);
            $jamMulai = $jurnal->jam_mulai;
            $jamSelesai = $jurnal->jam_selesai;
            $hari = Carbon::parse($jurnal->tanggal)->locale('id')->dayName;
            $namaHari = ucfirst($hari);
            if (in_array($namaHari, ['Senin', 'Jumat'], true)
                && (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $namaHari)->value('kegiatan_ditiadakan')
                && $jamKe > 1) {
                $slotSebelumnya = DB::table('jam_pelajaran')
                    ->where('id_semester', function ($query) use ($jurnal) {
                        $query->select('id_semester')->from('jam_pelajaran')->where('id_jam', function ($subQuery) use ($jurnal) {
                            $subQuery->select('id_jam')->from('jadwal_pelajaran')->where('id_jadwal', $jurnal->id_jadwal);
                        });
                    })
                    ->where('tingkat', $jurnal->tingkat)
                    ->where('hari', $namaHari)
                    ->where('jam_ke', $jamKe - 1)
                    ->first();
                if ($slotSebelumnya) {
                    $jamKe = (int) $slotSebelumnya->jam_ke;
                    $jamMulai = $slotSebelumnya->jam_mulai;
                    $jamSelesai = $slotSebelumnya->jam_selesai;
                }
            }

            $statusJurnal = strtolower((string) $jurnal->status_kehadiran_guru);
            $status = match ($statusJurnal) {
                'hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'tidak_hadir' => 'Tidak Hadir',
                default => $jurnal->status_verifikasi === 'terverifikasi' ? 'Hadir' : 'Menunggu verifikasi',
            };
            $keterangan = trim(implode(' | ', array_filter([
                'Jam ke-'.$jamKe,
                $jurnal->materi,
                $jurnal->keterangan,
                $jurnal->jumlah_hadir !== null ? 'Hadir '.$jurnal->jumlah_hadir.' siswa' : null,
            ])));
            $tingkat = match ((int) $jurnal->tingkat) { 10 => 'X', 11 => 'XI', 12 => 'XII', default => (string) $jurnal->tingkat };
            $kelas = trim($tingkat.' '.$jurnal->jurusan.' '.$jurnal->rombel);
            $jam = $jamMulai && $jamSelesai ? substr((string) $jamMulai, 0, 5).'-'.substr((string) $jamSelesai, 0, 5) : 'Jam ke-'.$jamKe;

            $result[] = [
                Carbon::parse($jurnal->tanggal)->format('d/m/Y'), 'Jurnal Mengajar', $kelas, null,
                $jurnal->guru, $jurnal->nama_mapel,
                trim($keterangan.' | '.$jam),
                $status, $jurnal->guru, $jurnal->guru, null,
            ];
        }

        return $result;
    }

    private function terapkanJamMaju($jadwal, string $hari)
    {
        if (! in_array($hari, ['Senin', 'Jumat'], true)
            || ! (bool) DB::table('pengaturan_kegiatan_harian')->where('hari', $hari)->value('kegiatan_ditiadakan')) {
            return $jadwal;
        }

        $semesterIds = $jadwal->pluck('jamPelajaran.id_semester')->filter()->unique()->values();
        $slotPerHari = JamPelajaran::whereIn('id_semester', $semesterIds)->where('hari', $hari)->get()
            ->groupBy(fn ($slot) => $slot->id_semester.'|'.$slot->tingkat.'|'.$slot->jam_ke);

        return $jadwal->map(function ($item) use ($slotPerHari) {
            $jamAsli = $item->jamPelajaran;
            if ((int) $jamAsli->jam_ke > 1) {
                $slotSebelumnya = $slotPerHari->get($jamAsli->id_semester.'|'.$jamAsli->tingkat.'|'.((int) $jamAsli->jam_ke - 1))?->first();
                if ($slotSebelumnya) {
                    $jamTampilan = clone $jamAsli;
                    $jamTampilan->jam_ke = $slotSebelumnya->jam_ke;
                    $jamTampilan->jam_mulai = $slotSebelumnya->jam_mulai;
                    $jamTampilan->jam_selesai = $slotSebelumnya->jam_selesai;
                    $item->setRelation('jamPelajaran', $jamTampilan);
                }
            }

            return $item;
        })->sortBy(fn ($item) => $item->jamPelajaran->jam_mulai)->values();
    }

    private function kelas(object $item): string
    {
        $tingkat = match ((int) $item->tingkat) {
            10 => 'X', 11 => 'XI', 12 => 'XII', default => (string) $item->tingkat
        };

        return trim($tingkat.' '.$item->jurusan.' '.$item->rombel);
    }

    private function label(string $jenis): string
    {
        return match ($jenis) {
            'jurnal' => 'Jurnal Mengajar',
            'dispen' => 'Dispensasi Siswa',
            'surat' => 'Input Surat',
            'tugas' => 'Upload Tugas',
            default => '',
        };
    }
}

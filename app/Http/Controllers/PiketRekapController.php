<?php

namespace App\Http\Controllers;

use App\Exports\PiketRekapExport;
use Carbon\Carbon;
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
        ]);
        $mulai = Carbon::parse($data['mulai'] ?? now()->startOfMonth())->toDateString();
        $sampai = Carbon::parse($data['sampai'] ?? now())->toDateString();

        return [$mulai, $sampai, $data['jenis'] ?? 'semua'];
    }

    /** @return array<int, array<int, string|null>> */
    private function rows(string $mulai, string $sampai): array
    {
        $result = [];

        $jurnal = DB::table('jurnal as j')
            ->join('jadwal_pelajaran as jp', 'jp.id_jadwal', '=', 'j.id_jadwal')
            ->join('jam_pelajaran as jam', 'jam.id_jam', '=', 'jp.id_jam')
            ->join('kelas as k', 'k.id_kelas', '=', 'jp.id_kelas')
            ->join('mapel as m', 'm.id_mapel', '=', 'jp.id_mapel')
            ->join('users as u', 'u.id', '=', 'jp.id_guru')
            ->whereNotNull('j.waktu_submit')
            ->whereBetween('j.tanggal', [$mulai, $sampai])
            ->orderBy('j.tanggal')->orderBy('k.tingkat')->orderBy('k.jurusan')->orderBy('k.rombel')->orderBy('jam.jam_ke')
            ->get(['j.tanggal', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 'm.nama_mapel', 'jam.jam_ke', 'j.materi', 'j.keterangan', 'j.jumlah_hadir', 'j.status_verifikasi', 'j.status_kehadiran_guru']);
        foreach ($jurnal as $item) {
            $result[] = [$item->tanggal, 'Jurnal Mengajar', $this->kelas($item), null, $item->guru, $item->nama_mapel,
                trim(implode(' | ', array_filter(['Jam ke-'.$item->jam_ke, $item->materi, $item->keterangan, $item->jumlah_hadir !== null ? 'Hadir '.$item->jumlah_hadir.' siswa' : null, $item->status_kehadiran_guru === 'tidak_hadir' ? 'Guru Tidak Hadir' : null]))),
                $item->status_kehadiran_guru === 'tidak_hadir' ? 'Guru Tidak Hadir' : ($item->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : 'Belum diverifikasi')];
        }

        $dispen = DB::table('dispens as d')->join('siswa as s', 's.id_siswa', '=', 'd.id_siswa')
            ->join('kelas as k', 'k.id_kelas', '=', 'd.id_kelas')->leftJoin('users as u', 'u.id', '=', 'd.id_guru_piket')
            ->whereBetween('d.tanggal', [$mulai, $sampai])->orderBy('d.tanggal')->orderBy('s.nama')
            ->get(['d.tanggal', 's.nama as siswa', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 'd.nomor_surat', 'd.jam_ke_mulai', 'd.jam_ke_selesai', 'd.alasan', 'd.status']);
        foreach ($dispen as $item) {
            $rentang = $item->jam_ke_selesai ? 'Jam ke-'.$item->jam_ke_mulai.' s/d '.$item->jam_ke_selesai : 'Jam ke-'.$item->jam_ke_mulai.' s/d selesai';
            $result[] = [$item->tanggal, 'Dispensasi Siswa', $this->kelas($item), $item->siswa, $item->guru,
                null, trim($item->nomor_surat.' | '.$rentang.' | '.$item->alasan), ucfirst($item->status)];
        }

        $surat = DB::table('surat_siswa as ss')->join('siswa as s', 's.id_siswa', '=', 'ss.id_siswa')
            ->join('kelas as k', 'k.id_kelas', '=', 'ss.id_kelas')->leftJoin('users as u', 'u.id', '=', 'ss.id_guru_piket')
            ->whereBetween('ss.tanggal', [$mulai, $sampai])->orderBy('ss.tanggal')->orderBy('s.nama')
            ->get(['ss.tanggal', 's.nama as siswa', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 'ss.status']);
        foreach ($surat as $item) {
            $result[] = [$item->tanggal, 'Input Surat', $this->kelas($item), $item->siswa, $item->guru, null, 'Surat/status siswa', $item->status];
        }

        $tugas = DB::table('upload_tugas as t')->join('kelas as k', 'k.id_kelas', '=', 't.id_kelas')
            ->leftJoin('users as u', 'u.id', '=', 't.id_guru_piket')
            ->whereBetween('t.created_at', [$mulai.' 00:00:00', $sampai.' 23:59:59'])->orderBy('t.created_at')
            ->get(['t.created_at', 'k.tingkat', 'k.jurusan', 'k.rombel', 'u.name as guru', 't.mapel', 't.status_guru', 't.alasan_izin', 't.tugas']);
        foreach ($tugas as $item) {
            $result[] = [Carbon::parse($item->created_at)->toDateString(), 'Upload Tugas', $this->kelas($item), null, $item->guru,
                $item->mapel, trim(implode(' | ', array_filter([$item->status_guru, $item->alasan_izin, $item->tugas]))), $item->status_guru];
        }

        usort($result, fn ($a, $b) => [$a[0], $a[1], $a[2]] <=> [$b[0], $b[1], $b[2]]);

        return $result;
    }

    private function kelas(object $item): string
    {
        $tingkat = match ((int) $item->tingkat) { 10 => 'X', 11 => 'XI', 12 => 'XII', default => (string) $item->tingkat };

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

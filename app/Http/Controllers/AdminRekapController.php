<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Kelas;
use App\Support\Waktu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AdminRekapController extends Controller
{
    private function data(Request $request): array
    {
        $tanggalHariIni = Waktu::sekarang()->toDateString();
        $filters = $request->validate([
            'dari' => ['nullable', 'date_format:Y-m-d'],
            'sampai' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:dari'],
            'id_kelas' => ['nullable', 'integer', 'exists:kelas,id_kelas'],
        ]);
        $dari = $filters['dari'] ?? $tanggalHariIni;
        $sampai = $filters['sampai'] ?? $dari;
        $query = Jurnal::with(['jadwal.kelas', 'jadwal.guru', 'jadwal.mapel', 'jadwal.jamPelajaran'])
            ->whereNotNull('waktu_submit')->whereBetween('tanggal', [$dari, $sampai])
            ->when(! empty($filters['id_kelas']), fn ($q) => $q->whereHas('jadwal', fn ($j) => $j->where('id_kelas', $filters['id_kelas'])))
            ->orderBy('tanggal')->orderBy('id_jurnal');
        $jurnals = $query->get();
        $byClass = $jurnals->filter(fn ($j) => $j->jadwal?->kelas)->groupBy(fn ($j) => $j->jadwal->id_kelas)->map(function (Collection $items) {
            return (object) [
                'kelas' => $items->first()->jadwal->kelas,
                'jumlah' => $items->count(),
                'dicek' => $items->whereIn('status_piket', ['disetujui', 'ditolak'])->count(),
                'belum' => $items->where('status_piket', 'menunggu')->count(),
                'tidak_hadir' => $items->where('status_kehadiran_guru', 'tidak_hadir')->count(),
            ];
        })->values();
        $byTeacher = $jurnals->filter(fn ($j) => $j->jadwal?->guru)->groupBy(fn ($j) => $j->jadwal->id_guru)->map(function (Collection $items) {
            return (object) [
                'guru' => $items->first()->jadwal->guru,
                'hadir' => $items->where('status_kehadiran_guru', 'hadir')->count(),
                'izin' => $items->where('status_kehadiran_guru', 'izin')->count(),
                'sakit' => $items->where('status_kehadiran_guru', 'sakit')->count(),
                'tidak_hadir' => $items->where('status_kehadiran_guru', 'tidak_hadir')->count(),
                'jumlah' => $items->count(),
            ];
        })->sortBy(fn ($row) => $row->guru->name)->values();
        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        return compact('filters', 'dari', 'sampai', 'jurnals', 'byClass', 'byTeacher', 'kelas');
    }

    public function index(Request $request): View
    {
        return view('admin.rekap', $this->data($request));
    }

    public function export(Request $request): Response
    {
        $data = $this->data($request);
        $lines = [['Tanggal', 'Kelas', 'Guru', 'Mata Pelajaran', 'Jam ke', 'Materi', 'Jumlah Hadir', 'Kehadiran Guru', 'Status Piket', 'Alasan Penolakan']];
        foreach ($data['jurnals'] as $jurnal) {
            $lines[] = [
                $jurnal->tanggal?->format('Y-m-d') ?? '', $jurnal->jadwal?->kelas?->nama_kelas ?? '',
                $jurnal->jadwal?->guru?->name ?? '', $jurnal->jadwal?->mapel?->nama_mapel ?? '',
                $jurnal->jadwal?->jamPelajaran?->jam_ke ?? '', $jurnal->materi ?? '', $jurnal->jumlah_hadir ?? '',
                $jurnal->status_kehadiran_guru ?? '', $jurnal->status_piket ?? '', $jurnal->alasan_tolak ?? '',
            ];
        }
        $csv = implode("\r\n", array_map(fn ($row) => implode(',', array_map(fn ($cell) => '"'.str_replace('"', '""', (string) $cell).'"', $row)), $lines));
        return response("\xEF\xBB\xBF".$csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="rekap-jurnal-'.$data['dari'].'-'.$data['sampai'].'.csv"',
        ]);
    }
}

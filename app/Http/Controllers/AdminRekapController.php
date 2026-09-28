<?php

namespace App\Http\Controllers;

use App\Exports\AdminRekapExport;
use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\User;
use App\Support\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
        $dari = $filters['dari'] ?? Waktu::sekarang()->startOfMonth()->toDateString();
        $sampai = $filters['sampai'] ?? $tanggalHariIni;
        if ($sampai < $dari && empty($filters['sampai'])) {
            $sampai = $dari;
        }
        $query = Jurnal::with(['jadwal.kelas', 'jadwal.guru', 'jadwal.mapel', 'jadwal.jamPelajaran'])
            ->whereBetween('tanggal', [$dari, $sampai])
            ->when(! empty($filters['id_kelas']), fn ($q) => $q->whereHas('jadwal', fn ($j) => $j->where('id_kelas', $filters['id_kelas'])))
            ->orderBy('tanggal')->orderBy('id_jurnal');
        $jurnals = $query->get();

        $jumlahTidakHadirPerJadwalTanggal = collect();
        $tidakHadirPerGuru = collect();
        $jurnalsTerkirim = $jurnals->filter(fn ($jurnal) => $jurnal->waktu_submit !== null);
        $jadwalIds = $jurnalsTerkirim->pluck('id_jadwal')->unique();
        $idGuruPerJadwal = JadwalPelajaran::whereIn('id_jadwal', $jadwalIds)->pluck('id_guru', 'id_jadwal');
        $tidakHadirPerGuru = $jurnalsTerkirim
            ->filter(fn ($jurnal) => $jurnal->status_kehadiran_guru === 'tidak_hadir')
            ->countBy(fn ($jurnal) => (int) $idGuruPerJadwal->get($jurnal->id_jadwal));
        $jumlahTidakHadirPerJadwalTanggal = $jurnalsTerkirim
            ->filter(fn ($jurnal) => $jurnal->status_kehadiran_guru === 'tidak_hadir')
            ->values();
        $byClass = $jurnals->filter(fn ($j) => $j->jadwal?->kelas)->groupBy(fn ($j) => $j->jadwal->id_kelas)->map(function (Collection $items) {
            return (object) [
                'kelas' => $items->first()->jadwal->kelas,
                'jumlah' => $items->count(),
                'dicek' => $items->whereIn('status_piket', ['disetujui', 'ditolak'])->count(),
                'belum' => $items->where('status_piket', 'menunggu')->count(),
                'tidak_hadir' => $items->where('status_kehadiran_guru', 'tidak_hadir')->count(),
            ];
        })->values();
        $byTeacher = User::whereIn('role', ['guru', 'wali_kelas'])->get()->keyBy('id')->map(function ($guru) use ($jurnals, $tidakHadirPerGuru) {
            $items = $jurnals->filter(fn ($j) => (int) $j->jadwal?->id_guru === (int) $guru->id);

            return (object) [
                'guru' => $guru,
                'hadir' => $items->where('status_kehadiran_guru', 'hadir')->count(),
                'izin' => $items->where('status_kehadiran_guru', 'izin')->count(),
                'sakit' => $items->where('status_kehadiran_guru', 'sakit')->count(),
                'tidak_hadir' => (int) $tidakHadirPerGuru->get($guru->id, 0),
                'jumlah' => $items->count() + (int) $tidakHadirPerGuru->get($guru->id, 0),
            ];
        })->sortBy(fn ($row) => $row->guru->name)->values();
        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();

        return compact('filters', 'dari', 'sampai', 'jurnals', 'byClass', 'byTeacher', 'kelas', 'jumlahTidakHadirPerJadwalTanggal');
    }

    public function index(Request $request): View
    {
        return view('admin.rekap', $this->data($request));
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->data($request);
        $rows = $data['jurnals']->map(fn ($jurnal) => [
            $jurnal->tanggal?->format('d/m/Y') ?? '', $jurnal->jadwal?->kelas?->nama_kelas ?? '',
            $jurnal->jadwal?->guru?->name ?? '', $jurnal->jadwal?->mapel?->nama_mapel ?? '',
            $jurnal->jadwal?->jamPelajaran?->jam_ke ?? '', $jurnal->materi ?? '', $jurnal->jumlah_hadir ?? '',
            $jurnal->status_kehadiran_guru ?? '', $jurnal->status_piket ?? '', $jurnal->alasan_tolak ?? '',
        ])->all();

        return Excel::download(new AdminRekapExport($rows), 'rekap-jurnal-'.$data['dari'].'-'.$data['sampai'].'.xlsx');
    }
}

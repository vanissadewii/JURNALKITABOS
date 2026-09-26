<?php

namespace App\Http\Controllers;

use App\Imports\JadwalPelajaranImport;
use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPelajaranController extends Controller
{
    public function index(): View
    {
        $urutanHari = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];

        $jadwal = JadwalPelajaran::with(['kelas', 'jamPelajaran', 'guru', 'mapel'])
            ->whereHas('jamPelajaran.semester', fn ($q) => $q->where('status', 'aktif'))
            ->get()
            ->sortBy([
                fn ($a, $b) => (int) ($a->kelas->tingkat ?? 99) <=> (int) ($b->kelas->tingkat ?? 99),
                fn ($a, $b) => strnatcasecmp($a->kelas->jurusan ?? '', $b->kelas->jurusan ?? ''),
                fn ($a, $b) => (int) ($a->kelas->rombel ?? 0) <=> (int) ($b->kelas->rombel ?? 0),
                fn ($a, $b) => $urutanHari[$a->jamPelajaran->hari] <=> $urutanHari[$b->jamPelajaran->hari],
                fn ($a, $b) => $a->jamPelajaran->jam_ke <=> $b->jamPelajaran->jam_ke,
            ])
            ->values();

        // gabungkan jam berurutan (kelas, hari, guru, mapel sama) jadi satu baris
        $jadwalGrup = collect();

        foreach ($jadwal as $row) {
            $jam = $row->jamPelajaran;
            $last = $jadwalGrup->last();

            if (
                $last
                && $last->id_kelas == $row->id_kelas
                && $last->hari === $jam->hari
                && $last->id_guru == $row->id_guru
                && $last->id_mapel == $row->id_mapel
                && $last->jam_ke_sampai + 1 === (int) $jam->jam_ke
            ) {
                $last->jam_ke_sampai = (int) $jam->jam_ke;
                $last->jam_selesai = substr($jam->jam_selesai, 0, 5);
                $last->jadwal_ids[] = $row->id_jadwal;
            } else {
                $jadwalGrup->push((object) [
                    'id_kelas' => $row->id_kelas,
                    'id_guru' => $row->id_guru,
                    'id_mapel' => $row->id_mapel,
                    'jadwal_ids' => [$row->id_jadwal],
                    'kelas' => $row->kelas->nama_kelas ?? '-',
                    'hari' => $jam->hari,
                    'jam_ke_mulai' => (int) $jam->jam_ke,
                    'jam_ke_sampai' => (int) $jam->jam_ke,
                    'jam_mulai' => substr($jam->jam_mulai, 0, 5),
                    'jam_selesai' => substr($jam->jam_selesai, 0, 5),
                    'guru' => $row->guru->name ?? '-',
                    'mapel' => $row->mapel->nama_mapel ?? '-',
                ]);
            }
        }

        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $guru = User::where('role', 'guru')->orderBy('name')->get();
        $mapel = Mapel::orderBy('nama_mapel')->get();

        return view('admin.tambah_jadwal', compact('jadwalGrup', 'kelas', 'guru', 'mapel'));
    }

    public function destroyGroup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['required', 'integer', 'distinct', 'exists:jadwal_pelajaran,id_jadwal'],
        ]);

        $jumlah = JadwalPelajaran::whereIn('id_jadwal', $validated['ids'])->delete();

        return redirect()->route('jadwal.index')->with('success', "{$jumlah} sesi jadwal berhasil dihapus.");
    }

    public function create(): View
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $guru = User::where('role', 'guru')->orderBy('name')->get();
        $mapel = Mapel::orderBy('nama_mapel')->get();

        return view('admin.tambah_jadwal', compact('kelas', 'guru', 'mapel'));
    }

    // dipanggil AJAX setelah kelas dipilih, buat nampilin jam yang sesuai tingkat+hari kelas itu
    public function getJamByKelasHari(Request $request): JsonResponse
    {
        /** @var Kelas $kelas */
        $kelas = Kelas::findOrFail($request->id_kelas);
        if (in_array($request->hari, ['Sabtu', 'Minggu'], true) && ! $this->kelasUjiWeekend($kelas)) {
            return response()->json([]);
        }

        $jamPelajaran = JamPelajaran::where('tingkat', $kelas->tingkat)
            ->where('hari', $request->hari)
            ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->orderBy('jam_ke')
            ->get();

        return response()->json($jamPelajaran);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'jam_dari' => 'required|exists:jam_pelajaran,id_jam',
            'jam_sampai' => 'required|exists:jam_pelajaran,id_jam',
            'id_guru' => 'required|exists:users,id',
            'id_mapel' => 'required|exists:mapel,id_mapel',
        ]);

        $kelas = Kelas::findOrFail($validated['id_kelas']);
        $dari = JamPelajaran::findOrFail($validated['jam_dari']);
        $sampai = JamPelajaran::findOrFail($validated['jam_sampai']);

        if ($dari->hari !== $sampai->hari || (int) $dari->tingkat !== (int) $kelas->tingkat) {
            return back()->withErrors('Jam yang dipilih tidak sesuai dengan kelas atau hari.')->withInput();
        }
        if (in_array($dari->hari, ['Sabtu', 'Minggu'], true) && ! $this->kelasUjiWeekend($kelas)) {
            return back()->withErrors('Jadwal akhir pekan untuk uji coba hanya tersedia pada kelas XI RPL 2.')->withInput();
        }

        if ($sampai->jam_ke < $dari->jam_ke) {
            return back()->withErrors('"Sampai jam ke" tidak boleh lebih kecil dari "Dari jam ke".')->withInput();
        }

        $jamList = JamPelajaran::where('id_semester', $dari->id_semester)
            ->where('tingkat', $dari->tingkat)
            ->where('hari', $dari->hari)
            ->whereBetween('jam_ke', [$dari->jam_ke, $sampai->jam_ke])
            ->orderBy('jam_ke')
            ->get();

        $sudahAda = JadwalPelajaran::where('id_kelas', $kelas->id_kelas)
            ->whereIn('id_jam', $jamList->pluck('id_jam'))
            ->exists();

        if ($sudahAda) {
            return back()->withErrors('Sebagian jam pada rentang itu sudah punya jadwal untuk kelas ini.')->withInput();
        }

        foreach ($jamList as $jam) {
            JadwalPelajaran::create([
                'id_kelas' => $kelas->id_kelas,
                'id_jam' => $jam->id_jam,
                'id_guru' => $validated['id_guru'],
                'id_mapel' => $validated['id_mapel'],
            ]);
        }

        return redirect()->back()->with('success', "Jadwal berhasil ditambahkan untuk {$jamList->count()} jam pelajaran.");
    }

    private function kelasUjiWeekend(Kelas $kelas): bool
    {
        return (int) $kelas->tingkat === 11
            && strtoupper(trim($kelas->jurusan)) === 'RPL'
            && (int) $kelas->rombel === 2;
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls,csv']);

        $import = new JadwalPelajaranImport;
        Excel::import($import, $request->file('file_excel'));

        $gagalValidasi = $import->failures();
        $tidakCocok = $import->getTidakCocok();

        if ($gagalValidasi->isNotEmpty() || ! empty($tidakCocok)) {
            $pesan = [];

            if ($gagalValidasi->isNotEmpty()) {
                $pesan[] = $gagalValidasi->count().' baris gagal validasi (kolom kosong/format salah).';
            }

            if (! empty($tidakCocok)) {
                $pesan[] = count($tidakCocok).' baris tidak cocok dengan data master: '.implode(' | ', $tidakCocok);
            }

            return redirect()->back()->with('warning', implode(' ', $pesan));
        }

        return redirect()->back()->with('success', 'Jadwal berhasil diimport.');
    }
}

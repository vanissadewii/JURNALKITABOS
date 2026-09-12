<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\JamPelajaran;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JadwalPelajaranImport;

class JadwalPelajaranController extends Controller
{
    public function index(): View
{
    $jadwal = JadwalPelajaran::with(['kelas', 'jamPelajaran', 'guru', 'mapel'])->get();
    $kelas  = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
    $guru   = User::where('role', 'guru')->orderBy('name')->get();
    $mapel  = Mapel::orderBy('nama_mapel')->get();

    return view('admin.tambah_jadwal', compact('jadwal', 'kelas', 'guru', 'mapel'));
}

public function create(): View
{
    $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
    $guru  = User::where('role', 'guru')->orderBy('name')->get();
    $mapel = Mapel::orderBy('nama_mapel')->get();

    return view('admin.tambah_jadwal', compact('kelas', 'guru', 'mapel'));
}

    // dipanggil AJAX setelah kelas dipilih, buat nampilin jam yang sesuai tingkat+hari kelas itu
    public function getJamByKelasHari(Request $request)
    {

        $kelas = Kelas::findOrFail($request->id_kelas);

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
            'id_jam'   => 'required|exists:jam_pelajaran,id_jam',
            'id_guru'  => 'required|exists:users,id',
            'id_mapel' => 'required|exists:mapel,id_mapel',
        ]);

        JadwalPelajaran::create($validated);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function import(Request $request): RedirectResponse
{
    $request->validate(['file_excel' => 'required|mimes:xlsx,xls,csv']);

    $import = new JadwalPelajaranImport;
    Excel::import($import, $request->file('file_excel'));

    $gagalValidasi = $import->failures();
    $tidakCocok    = $import->getTidakCocok();

    if ($gagalValidasi->isNotEmpty() || !empty($tidakCocok)) {
        $pesan = [];

        if ($gagalValidasi->isNotEmpty()) {
            $pesan[] = $gagalValidasi->count() . ' baris gagal validasi (kolom kosong/format salah).';
        }

        if (!empty($tidakCocok)) {
            $pesan[] = count($tidakCocok) . ' baris tidak cocok dengan data master: ' . implode(' | ', $tidakCocok);
        }

        return redirect()->back()->with('warning', implode(' ', $pesan));
    }

    return redirect()->back()->with('success', 'Jadwal berhasil diimport.');
}
}
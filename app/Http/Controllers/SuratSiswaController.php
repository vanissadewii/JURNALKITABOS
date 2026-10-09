<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SuratSiswaController extends Controller
{
    public function index(Request $request): View
    {
        $tanggal = $request->query('tanggal', today()->toDateString());
        validator(['tanggal' => $tanggal], ['tanggal' => 'date_format:Y-m-d'])->validate();
        $kelasList = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get();
        $siswaList = Siswa::with('kelas')->orderBy('nama')->get();

        $suratColumns = Schema::getColumnListing('surat_siswa');
        $riwayatQuery = DB::table('surat_siswa')->join('siswa', 'siswa.id_siswa', '=', 'surat_siswa.id_siswa')
                ->join('kelas', 'kelas.id_kelas', '=', 'surat_siswa.id_kelas')->whereDate('surat_siswa.tanggal', $tanggal)
                ->orderByDesc('surat_siswa.created_at');
        $riwayat = $riwayatQuery->get([
            'siswa.nama', 'kelas.tingkat', 'kelas.jurusan', 'kelas.rombel',
            'surat_siswa.status', 'surat_siswa.id_kelas',
            ...collect(['jenis_surat', 'file_path', 'keterangan'])->map(fn ($column) => in_array($column, $suratColumns, true)
                ? "surat_siswa.{$column}"
                : DB::raw("null as {$column}"))->all(),
        ]);

        return view('guru.input-surat', [
            'siswaList' => $siswaList,
            'kelasList' => $kelasList,
            'kelasSearchOptions' => $kelasList->map(fn ($kelas) => [
                'id' => $kelas->id_kelas,
                'label' => $kelas->tingkat.' '.$kelas->jurusan.' · Rombel '.$kelas->rombel,
            ])->values(),
            'siswaSearchOptions' => $siswaList->map(fn ($siswa) => [
                'id' => $siswa->id_siswa,
                'nama' => $siswa->nama,
                'kelas' => $siswa->id_kelas,
                'kelasLabel' => $siswa->kelas ? $siswa->kelas->tingkat.' '.$siswa->kelas->jurusan.' · Rombel '.$siswa->kelas->rombel : 'Kelas tidak tersedia',
            ])->values(),
            'tanggal' => $tanggal,
            'riwayat' => $riwayat,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_siswa' => 'nullable|exists:siswa,id_siswa',
            'id_siswa_list' => 'nullable|array|min:1',
            'id_siswa_list.*' => 'required|integer|distinct|exists:siswa,id_siswa',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'status' => 'nullable|in:Sakit,Izin',
            'tanggal' => 'required|date_format:Y-m-d',
            'tanggal_sampai' => 'nullable|date_format:Y-m-d|after_or_equal:tanggal',
            'jenis_surat' => 'required|in:izin,terlambat',
            'keterangan' => 'nullable|string|max:1000',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'id_siswa.required' => 'Pilih nama siswa terlebih dahulu.',
            'id_siswa_list.min' => 'Pilih nama siswa terlebih dahulu.',
            'id_siswa.exists' => 'Nama siswa tidak ditemukan.',
            'id_kelas.required' => 'Pilih kelas terlebih dahulu.',
            'id_kelas.exists' => 'Kelas tidak ditemukan.',
            'status.required' => 'Pilih status sakit atau izin.',
            'status.in' => 'Status hanya dapat berupa Sakit atau Izin.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date_format' => 'Format tanggal tidak valid.',
        ]);
        $ids = collect($data['id_siswa_list'] ?? [$data['id_siswa'] ?? null])->filter()->unique()->values();
        abort_if($ids->isEmpty(), 422, 'Pilih nama siswa terlebih dahulu.');
        $siswaList = Siswa::whereIn('id_siswa', $ids)->get();
        abort_if($siswaList->count() !== $ids->count() || $siswaList->contains(fn ($siswa) => (int) $siswa->id_kelas !== (int) $data['id_kelas']), 422, 'Kelas siswa tidak sesuai.');
        $tanggalSampai = $data['tanggal_sampai'] ?? $data['tanggal'];
        $filePath = $request->hasFile('file') ? $request->file('file')->store('surat-siswa', 'public') : null;
        $suratColumns = Schema::getColumnListing('surat_siswa');

        DB::transaction(function () use ($data, $siswaList, $request, $tanggalSampai, $filePath, $suratColumns) {
            foreach ($siswaList as $siswa) {
                $akhir = $data['jenis_surat'] === 'terlambat' ? $data['tanggal'] : $tanggalSampai;
                for ($tanggal = $data['tanggal']; $tanggal <= $akhir; $tanggal = date('Y-m-d', strtotime($tanggal.' +1 day'))) {
                    $attributes = [
                        'id_kelas' => $siswa->id_kelas,
                        'status' => $data['jenis_surat'] === 'terlambat' ? 'Terlambat' : ($data['status'] ?? 'Izin'),
                        'id_guru_piket' => $request->user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    foreach ([
                        'jenis_surat' => $data['jenis_surat'],
                        'tanggal_sampai' => $tanggalSampai,
                        'file_path' => $filePath,
                        'keterangan' => $data['keterangan'] ?? null,
                    ] as $column => $value) {
                        if (in_array($column, $suratColumns, true)) {
                            $attributes[$column] = $value;
                        }
                    }

                    DB::table('surat_siswa')->updateOrInsert(
                        ['id_siswa' => $siswa->id_siswa, 'tanggal' => $tanggal],
                        $attributes
                    );
                }
            }
        });

        return redirect()->route('piket.input-surat', ['tanggal' => $data['tanggal']])->with('success', 'Surat siswa tersimpan dan otomatis muncul di jurnal pada tanggal yang dipilih.');
    }
}

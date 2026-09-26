<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UploadTugasController extends Controller
{
    public function create(): View
    {
        return view('guru.upload-tugas', [
            'kelasList' => Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get(),
            'mapelList' => Mapel::orderBy('nama_mapel')->pluck('nama_mapel'),
            'kelasOptions' => Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get()->map(
                fn ($kelas) => (match ((int) $kelas->tingkat) { 10 => 'X', 11 => 'XI', 12 => 'XII', default => $kelas->tingkat })
                    .' '.$kelas->jurusan.' '.$kelas->rombel
            )->values(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:izin,sakit'],
            'alasan_izin' => ['nullable', 'string', 'max:2000'],
            'kelas' => ['required', 'string', 'max:100'],
            'mapel' => ['required', 'string', 'exists:mapel,nama_mapel'],
            'tugas' => ['required', 'string', 'max:10000'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip', 'max:20480'],
        ]);

        if ($data['status'] === 'izin' && blank($data['alasan_izin'])) {
            return back()->withErrors(['alasan_izin' => 'Alasan izin wajib diisi.'])->withInput();
        }

        $match = preg_match('/^(XII|XI|X)\s+(.+?)\s+(\d+)$/i', trim($data['kelas']), $parts);
        abort_unless($match, 422, 'Kelas tidak valid.');
        $tingkat = ['X' => 10, 'XI' => 11, 'XII' => 12][strtoupper($parts[1])];
        $kelas = Kelas::where('tingkat', $tingkat)
            ->where('jurusan', strtoupper(trim($parts[2])))
            ->where('rombel', (int) $parts[3])
            ->firstOrFail();

        $filePath = $request->hasFile('file') ? $request->file('file')->store('tugas-piket', 'public') : null;
        DB::table('upload_tugas')->insert([
            'id_kelas' => $kelas->id_kelas,
            'tanggal' => today()->toDateString(),
            'file_path' => $filePath,
            'mapel' => $data['mapel'],
            'status_guru' => ucfirst($data['status']),
            'alasan_izin' => $data['status'] === 'izin' ? $data['alasan_izin'] : null,
            'tugas' => $data['tugas'],
            'id_guru_piket' => $request->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('piket.upload-tugas')->with('success', 'Tugas berhasil disimpan.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SuratSiswaController extends Controller
{
    public function index(Request $request): View
    {
        $tanggal = $request->query('tanggal', today()->toDateString());
        validator(['tanggal' => $tanggal], ['tanggal' => 'date_format:Y-m-d'])->validate();
        return view('guru.input-surat', [
            'siswaList' => Siswa::with('kelas')->orderBy('nama')->get(),
            'kelasList' => Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('rombel')->get(),
            'tanggal' => $tanggal,
            'riwayat' => DB::table('surat_siswa')->join('siswa', 'siswa.id_siswa', '=', 'surat_siswa.id_siswa')
                ->join('kelas', 'kelas.id_kelas', '=', 'surat_siswa.id_kelas')->whereDate('surat_siswa.tanggal', $tanggal)
                ->orderByDesc('surat_siswa.created_at')->get(['siswa.nama', 'kelas.tingkat', 'kelas.jurusan', 'kelas.rombel', 'surat_siswa.status', 'surat_siswa.id_kelas']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'status' => 'required|in:Sakit,Izin',
            'tanggal' => 'required|date_format:Y-m-d',
        ]);
        $siswa = Siswa::findOrFail($data['id_siswa']);
        abort_if((int) $siswa->id_kelas !== (int) $data['id_kelas'], 422, 'Kelas siswa tidak sesuai.');

        DB::table('surat_siswa')->updateOrInsert(
            ['id_siswa' => $siswa->id_siswa, 'tanggal' => $data['tanggal']],
            ['id_kelas' => $siswa->id_kelas, 'status' => $data['status'], 'id_guru_piket' => $request->user()->id,
                'created_at' => now(), 'updated_at' => now()]
        );

        return redirect()->route('piket.input-surat', ['tanggal' => $data['tanggal']])->with('success', 'Status siswa tersimpan dan otomatis muncul di jurnal pada tanggal yang dipilih.');
    }
}

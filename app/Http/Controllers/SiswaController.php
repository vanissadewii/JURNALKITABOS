<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(): View
    {
        $siswas = Siswa::with('kelas')->get();
        $kelases = Kelas::all();

        return view('admin.tambah_siswa', compact('siswas', 'kelases'));
    }

    public function create(): View
    {
        $siswas = Siswa::with('kelas')->get();
        $kelases = Kelas::all();

        return view('admin.tambah_siswa', compact('siswas', 'kelases'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nisn' => ['required', 'string', 'max:20', 'unique:siswa,nisn'],
            'nama' => ['required', 'string', 'max:100'],
            'id_kelas' => ['required', 'exists:kelas,id_kelas'],
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file_excel' => ['required', 'mimes:xlsx,xls,csv'],
        ]);

        $import = new SiswaImport;
        Excel::import($import, $request->file('file_excel'));

        $failures = $import->failures();
        if ($failures->count() > 0) {
            $pesan = $failures->map(function ($failure) {
                return "Baris {$failure->row()}: ".implode(', ', $failure->errors());
            })->implode(' | ');

            return redirect()->route('admin.siswa.index')->with('error', "Sebagian data gagal diimport: {$pesan}");

        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diimport!');

    }
}

<?php

namespace App\Http\Controllers;

use App\Imports\MapelImport;
use App\Models\Mapel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class MapelController extends Controller
{
    public function index(): View
    {
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('admin.tambah_mapel', compact('mapels'));
    }

    public function create(): View
    {
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('admin.tambah_mapel', compact('mapels'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $mapel = Mapel::findOrFail($id);
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mapel,nama_mapel,'.$mapel->id_mapel.',id_mapel',
            'kode_mapel' => 'nullable|string|max:20|unique:mapel,kode_mapel,'.$mapel->id_mapel.',id_mapel',
        ]);

        $mapel->update($validated);

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $mapel = Mapel::findOrFail($id);

        if ($mapel->jadwalPelajaran()->exists()) {
            return redirect()->route('mapel.index')->with('warning', "Mapel {$mapel->nama_mapel} masih digunakan pada jadwal dan tidak dapat dihapus.");
        }

        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file_mapel' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        $import = new MapelImport;
        Excel::import($import, $request->file('file_mapel'));

        $gagal = $import->failures();
        if ($gagal->isNotEmpty()) {
            return redirect()->route('mapel.index')->with('warning', $gagal->count().' baris dilewati karena data kosong, duplikat, atau format kolom tidak sesuai. Data valid tetap berhasil dimasukkan.');
        }

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diunggah.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mapel,nama_mapel',
            'kode_mapel' => 'nullable|string|max:20|unique:mapel,kode_mapel',
        ]);

        Mapel::create($validated);

        return redirect()->route('mapel.index')->with('success', 'Mapel berhasil ditambahkan.');
    }
}

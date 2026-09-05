<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterKelasController extends Controller
{
    /**
     * Tampilkan daftar semua kelas.
     */
    public function index(): View
    {
        $kelas = Kelas::all();

        return view('master-kelas.index', compact('kelas'));
    }

    /**
     * Simpan kelas baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:20',
            'tingkat' => 'required|in:10,11,12',
        ]);

        Kelas::create($validated);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Update data kelas di database.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:20',
            'tingkat' => 'required|in:10,11,12',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validated);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Hapus kelas dari database.
     */
    public function destroy(string $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}

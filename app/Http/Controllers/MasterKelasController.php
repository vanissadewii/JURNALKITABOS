<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class MasterKelasController extends Controller
{
    /**
     * Tampilkan daftar semua kelas.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('master-kelas.index', compact('kelas'));
    }

    /**
     * Tampilkan form tambah kelas baru.
     */
    public function create()
    {
        return view('master-kelas.create');
    }

    /**
     * Simpan kelas baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:20',
            'tingkat'    => 'required|in:10,11,12',
        ]);

        Kelas::create($validated);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail 1 kelas (opsional, jarang dipakai kalau cuma CRUD sederhana).
     */
    public function show(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('master-kelas.show', compact('kelas'));
    }

    /**
     * Tampilkan form edit kelas.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('master-kelas.edit', compact('kelas'));
    }

    /**
     * Update data kelas di database.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:20',
            'tingkat'    => 'required|in:10,11,12',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validated);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Hapus kelas dari database.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
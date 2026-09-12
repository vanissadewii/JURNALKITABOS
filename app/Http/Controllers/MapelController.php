<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MapelController extends Controller
{
    public function index(): View
{
    $mapels = Mapel::orderBy('nama_mapel')->get();
    return view('admin.tambah_mapel', compact('mapels'));
}

public function create(): View
{
    return view('admin.tambah_mapel');
}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mapel,nama_mapel',
            'kode_mapel' => 'nullable|string|max:20|unique:mapel,kode_mapel',
        ]);

        Mapel::create($validated);

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan.');
    }
}
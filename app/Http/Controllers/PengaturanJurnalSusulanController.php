<?php

namespace App\Http\Controllers;

use App\Models\PengaturanJurnalSusulan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaturanJurnalSusulanController extends Controller
{
    public function edit(Request $request): View
    {
        $guruList = User::whereIn('role', ['guru', 'guru_piket'])->orderBy('name')->get();
        $idGuru = $request->query('id_guru');
        $guruDipilih = $idGuru ? $guruList->firstWhere('id', (int) $idGuru) : null;
        $pengaturan = $guruDipilih ? PengaturanJurnalSusulan::forGuru((int) $guruDipilih->id) : null;

        return view('admin.pengaturan_jurnal_susulan', compact('guruList', 'guruDipilih', 'pengaturan'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_guru' => ['required', 'exists:users,id'],
            'aktif' => ['required', 'boolean'],
        ]);

        PengaturanJurnalSusulan::updateOrCreate(
            ['id_guru' => $validated['id_guru']],
            ['aktif' => $request->boolean('aktif')],
        );

        return redirect()->route('admin.aturan-jurnal-susulan.edit', ['id_guru' => $validated['id_guru']])
            ->with('success', $request->boolean('aktif')
                ? 'Izin jurnal kemarin diaktifkan untuk guru yang dipilih.'
                : 'Izin jurnal kemarin dinonaktifkan untuk guru yang dipilih.');
    }
}

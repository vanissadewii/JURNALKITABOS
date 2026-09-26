<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfilGuruController extends Controller
{
    public function show(): View
    {
        /** @var User $guru */
        $guru = Auth::user();

        // mapel diambil dari jadwal yang diampu guru ini
        $mapel = Mapel::whereIn(
            'id_mapel',
            JadwalPelajaran::where('id_guru', $guru->id)->select('id_mapel')
        )
            ->orderBy('nama_mapel')
            ->pluck('nama_mapel');

<<<<<<< HEAD
        return view('guru.profil_guru', compact('guru', 'mapel'));
=======
        $user = $guru;
        $adminPhone = config('jurnal.admin_phone');

        return view('guru.profil_guru', compact('user', 'mapel', 'adminPhone'));
>>>>>>> putri/tampilan-admin
    }

    public function edit(): View
    {
        return view('guru.editprofil_guru', ['guru' => Auth::user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var User $guru */
        $guru = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'password_lama' => 'nullable|required_with:password_baru|current_password',
            'password_baru' => 'nullable|string|min:8|confirmed',
        ]);

        $guru->update([
            'name' => $validated['name'],
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        // password hanya diganti kalau kolom password baru diisi (model sudah otomatis meng-hash)
        if (! empty($validated['password_baru'])) {
            $guru->update(['password' => $validated['password_baru']]);
        }

        return redirect()->route('profil-guru')->with('success', 'Profil berhasil diperbarui.');
    }
}

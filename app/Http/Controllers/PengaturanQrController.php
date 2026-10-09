<?php

namespace App\Http\Controllers;

use App\Models\PengaturanQr;
use App\Models\PengaturanJurnalSusulan;
use App\Models\User;
use Illuminate\Http\Request;

class PengaturanQrController extends Controller
{
    public function edit(Request $request)
    {
        $guruList = User::whereIn('role', ['guru', 'guru_piket', 'wali_kelas'])->orderBy('name')->get();
        $idGuru = $request->query('id_guru');
        $guruDipilih = $idGuru ? $guruList->firstWhere('id', (int) $idGuru) : null;
        $pengaturanSusulan = $guruDipilih ? PengaturanJurnalSusulan::forGuru((int) $guruDipilih->id) : null;

        return view('admin.aturan-qr', [
            'masaQrDetik' => PengaturanQr::query()->value('masa_qr_detik') ?? PengaturanQr::durasi(),
            'guruList' => $guruList, 'guruDipilih' => $guruDipilih, 'pengaturanSusulan' => $pengaturanSusulan,
        ]);
    }

    public function update(Request $request)
    {
        if ($request->has('id_guru')) {
            $data = $request->validate(['id_guru' => ['required', 'exists:users,id'], 'aktif' => ['required', 'boolean']]);
            PengaturanJurnalSusulan::updateOrCreate(['id_guru' => $data['id_guru']], ['aktif' => $request->boolean('aktif')]);

            return redirect()->route('admin.aturan-qr.edit', ['id_guru' => $data['id_guru']])->with('success', 'Pengaturan jurnal susulan berhasil disimpan.');
        }

        $data = $request->validate([
            'masa_qr_detik' => ['required', 'integer', 'min:5', 'max:120'],
        ]);

        PengaturanQr::query()->firstOrCreate([], ['masa_qr_detik' => 10])
            ->update($data);

        return redirect()->route('admin.aturan-qr.edit')->with('success', 'Pengaturan durasi QR berhasil disimpan.');
    }
}

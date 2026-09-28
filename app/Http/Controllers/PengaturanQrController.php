<?php

namespace App\Http\Controllers;

use App\Models\PengaturanQr;
use Illuminate\Http\Request;

class PengaturanQrController extends Controller
{
    public function edit()
    {
        return view('admin.aturan-qr', [
            'masaQrDetik' => PengaturanQr::query()->value('masa_qr_detik') ?? PengaturanQr::durasi(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'masa_qr_detik' => ['required', 'integer', 'min:5', 'max:120'],
        ]);

        PengaturanQr::query()->firstOrCreate([], ['masa_qr_detik' => 10])
            ->update($data);

        return redirect()->route('admin.aturan-qr.edit')->with('success', 'Pengaturan durasi QR berhasil disimpan.');
    }
}

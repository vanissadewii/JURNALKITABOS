<?php

namespace App\Http\Controllers;

use App\Models\Kelas;

class KelasController extends Controller
{
    public function beranda()
    {
        $kelas = Kelas::where('nama_kelas', 'XI RPL 2')->first();

        return view('kelas.beranda', compact('kelas'));
    }

    public function scan()
    {
        return view('kelas.scan');
    }

    public function kirimJurnal()
    {
        return view('kelas.kirim-jurnal');
    }

    public function profile()
    {
        return view('kelas.profile');
    }
}

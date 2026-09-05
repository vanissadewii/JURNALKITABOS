<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\View\View;

class KelasController extends Controller
{
    public function beranda(): View
    {
        $kelas = Kelas::where('nama_kelas', 'XI RPL 2')->first();

        return view('kelas.beranda', compact('kelas'));
    }

    public function scan(): View
    {
        return view('kelas.scan');
    }

    public function profile(): View
    {
        return view('kelas.profile');
    }
}

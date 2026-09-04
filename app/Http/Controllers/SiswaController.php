<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function beranda() { return view('siswa.beranda'); }
    public function scan() { return view('siswa.scan'); }
    public function riwayat() { 
    // nanti: cek ulang jam >= 15 di sini juga, jangan cuma di view
    return view('siswa.riwayat'); 
    }
    public function akun() { return view('siswa.akun'); }
}

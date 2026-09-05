<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function beranda() { return view('kelas.beranda'); }
    public function scan() { return view('kelas.scan'); }
    public function profile() { return view('kelas.profile'); }
}

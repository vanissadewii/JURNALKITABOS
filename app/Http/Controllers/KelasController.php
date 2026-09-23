<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KelasController extends Controller
{
    public function beranda(): View
    {
    $kelas = Kelas::first();

    return view('kelas.beranda', compact('kelas'));
    }

    public function scan(): View
    {
        $kelas = Auth::user()?->kelas;
        $qrImage = null;

        if ($kelas) {
            $qrImage = (new SvgWriter)->write(
                new QrCode('kelas:'.$kelas->id_kelas)
            )->getDataUri();
        }

        return view('kelas.scan', compact('kelas', 'qrImage'));
    }

    public function profile(): View
    {
        return view('kelas.profile');
    }
}

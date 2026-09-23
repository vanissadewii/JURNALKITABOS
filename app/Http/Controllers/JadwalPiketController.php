<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use Carbon\Carbon;
use Illuminate\View\View;

class JadwalPiketController extends Controller
{
    /** @var array<int, string> */
    private array $namaHari = [
        1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat',
    ];

    /** Halaman publik untuk Waka: tidak perlu login. */
    public function publik(): View
    {
        $sekarang = now();
        $hari = $this->namaHari[$sekarang->dayOfWeekIso] ?? null;

        $jadwal = $hari
            ? JadwalPiket::with('guru')
                ->where('hari', $hari)
                ->orderBy('sesi')
                ->get()
                ->map(fn ($j) => [
                    'guru' => $j->guru->name,
                    'sesi' => $j->sesi,
                    'jam_mulai' => $j->jam_mulai,
                    'jam_selesai' => $j->jam_selesai,
                    'status' => $this->statusSesi($sekarang, $j->jam_mulai, $j->jam_selesai),
                ])
            : collect();

        return view('guru-piket.jadwal-publik', [
            'hari' => $hari,
            'tanggal' => $sekarang,
            'jadwal' => $jadwal,
        ]);
    }

    private function statusSesi(Carbon $sekarang, string $mulai, string $selesai): string
    {
        $jamSekarang = $sekarang->format('H:i:s');

        return match (true) {
            $jamSekarang < $mulai => 'Menunggu',
            $jamSekarang > $selesai => 'Selesai',
            default => 'Aktif',
        };
    }
}
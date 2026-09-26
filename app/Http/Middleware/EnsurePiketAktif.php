<?php

namespace App\Http\Middleware;

use App\Models\JadwalPiketBulanan;
use App\Support\Waktu;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePiketAktif
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $waktu = Waktu::sekarang();
        $piket = JadwalPiketBulanan::query()
            ->whereDate('tanggal', $waktu->toDateString())
            ->where('id_guru', $user->id)
            ->whereIn('sesi', ['pagi', 'siang'])
            ->where(function ($q) use ($waktu) {
                $q->where(function ($jam) use ($waktu) {
                    $jam->where('jam_mulai', '<=', $waktu->format('H:i:s'))
                        ->where('jam_selesai', '>=', $waktu->format('H:i:s'));
                })->orWhere(function ($jam) {
                    $jam->where('jam_mulai', '00:00:00')->where('jam_selesai', '00:00:00');
                });
            })
            ->exists();

        abort_unless($piket, 403, 'Menu ini hanya dapat digunakan saat Anda bertugas piket.');

        return $next($request);
    }
}

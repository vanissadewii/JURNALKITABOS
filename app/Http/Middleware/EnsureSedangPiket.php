<?php

namespace App\Http\Middleware;

use App\Models\JadwalPiket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSedangPiket
{
    public function handle(Request $request, Closure $next): Response
    {
        $idGuru = Auth::id();

        if (! $idGuru || ! JadwalPiket::sedangPiket((int) $idGuru)) {
            abort(403, 'Anda hanya bisa mengakses halaman ini saat sedang jadwal piket.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * Dipakai lewat middleware alias 'role', contoh:
     *   Route::middleware(['auth', 'role:admin'])->group(...)
     *   Route::middleware(['auth', 'role:admin,guru_piket'])->group(...)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        if (! in_array($user->role, $roles, true)) {
            // Akun wali kelas yang membuka halaman guru/admin di luar menu yang
            // diizinkan selalu diarahkan ke rekap, bukan berhenti di halaman 403.
            if ($user->role === 'wali_kelas' && $request->routeIs('piket.rekap', 'piket.rekap.export') === false) {
                return redirect()->route('piket.rekap');
            }

            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\QrSesi;
use App\Models\User;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QrSesiController extends Controller
{
    public function scanKelas(Jurnal $jurnal): View
    {
        abort_if($jurnal->jadwal->id_guru !== Auth::id(), 403);

        return view('guru.guru_scan_qr', compact('jurnal'));
    }

    public function prosesScanKelas(Request $request, Jurnal $jurnal): JsonResponse
    {
        $request->validate(['kode_kelas' => 'required|string']);
        abort_if($jurnal->jadwal->id_guru !== Auth::id(), 403);

        if (! str_starts_with($request->kode_kelas, 'kelas:')) {
            return response()->json(['success' => false, 'message' => 'QR kelas tidak dikenali.'], 422);
        }

        $idKelas = (int) str_replace('kelas:', '', $request->kode_kelas);
        if ($idKelas !== (int) $jurnal->jadwal->id_kelas) {
            return response()->json(['success' => false, 'message' => 'QR ini bukan untuk kelas pada jadwal jurnal.'], 403);
        }

        return response()->json([
            'success' => true,
            'redirect' => route('qr.tampilkan-guru', $jurnal->id_jurnal),
        ]);
    }

    // GURU: tampilkan QR untuk jurnal tertentu
    public function tampilkanQrGuru(Jurnal $jurnal): View
    {
        $jadwal = $jurnal->jadwal;
        abort_if($jadwal->id_guru !== Auth::id(), 403);

        $qrSesi = QrSesi::where('id_jurnal', $jurnal->id_jurnal)
            ->where('tipe', 'guru')
            ->latest('id_qr')
            ->firstOrFail();

        $qrCode = new QrCode($qrSesi->kode_qr);
        $writer = new SvgWriter;
        $qrImage = $writer->write($qrCode)->getDataUri();

        return view('guru.tampilkan_qr_guru', compact('jurnal', 'qrSesi', 'qrImage'));
    }

    // GURU: AJAX polling, cek apakah kelas sudah scan
    // KELAS: submit hasil scan kamera (kode_qr yang terbaca)
    public function scanGuruQr(Request $request): JsonResponse
    {
        $request->validate(['kode_qr' => 'required|string']);

        $qrSesi = QrSesi::where('kode_qr', $request->kode_qr)
            ->where('tipe', 'guru')
            ->first();

        if (! $qrSesi) {
            return response()->json(['success' => false, 'message' => 'QR tidak dikenali.'], 404);
        }

        if ($qrSesi->sudahExpired()) {
            return response()->json(['success' => false, 'message' => 'QR sudah kedaluwarsa.'], 410);
        }

        if ($qrSesi->sudahDipindai()) {
            return response()->json(['success' => false, 'message' => 'QR ini sudah pernah dipindai.'], 409);
        }

        // Pastikan yang scan adalah akun kelas yang sesuai kelasnya
        $idKelasQr = $qrSesi->jadwal->id_kelas;

        /** @var User $user */
        $user = Auth::user();

        if ($user->id_kelas !== $idKelasQr) {
            return response()->json(['success' => false, 'message' => 'QR ini bukan untuk kelas Anda.'], 403);
        }

        $qrSesi->update([
            'dipindai_at' => now(),
            'dipindai_oleh' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Verifikasi berhasil.']);
    }

    public function cekStatusGuru(Jurnal $jurnal): JsonResponse
    {
        abort_if($jurnal->jadwal->id_guru !== Auth::id(), 403);

        $qrSesi = QrSesi::where('id_jurnal', $jurnal->id_jurnal)
            ->where('tipe', 'guru')
            ->latest('id_qr')
            ->firstOrFail();

        return response()->json([
            'scanned' => $qrSesi->sudahDipindai(),
            'expired' => $qrSesi->sudahExpired(),
        ]);
    }
}

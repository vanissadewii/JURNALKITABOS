<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Jurnal;
use App\Models\QrSesi;
use App\Services\VerifikasiSesiService;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class QrSesiController extends Controller
{
    private const MASA_QR_DETIK = 60;          // QR sesi berlaku satu menit

    private const SISA_MINIMAL_DETIK = 15;     // sisa umur kurang dari ini: dibuatkan QR baru

    private const BATAS_SALING_SCAN_MENIT = 1; // kelas harus scan balik dalam satu menit

    public function __construct(private VerifikasiSesiService $sesi) {}

    public function scanKelas(Jurnal $jurnal): View
    {
        $jurnal->load('jadwal');
        abort_unless((int) $jurnal->jadwal->id_guru === (int) Auth::id(), 403);
        abort_if($jurnal->status_verifikasi === 'terverifikasi', 404);

        return view('guru.guru_scan_qr', compact('jurnal'));
    }

    public function prosesScanKelas(Request $request, Jurnal $jurnal): JsonResponse
    {
        $request->validate(['kode_qr' => 'required|string']);
        $jurnal->load('jadwal');
        abort_unless((int) $jurnal->jadwal->id_guru === (int) Auth::id(), 403);

        $qr = QrSesi::where('kode_qr', $request->kode_qr)
            ->where('tipe', 'kelas')
            ->first();

        if (! $qr || (int) $qr->id_jadwal !== (int) $jurnal->id_jadwal) {
            return $this->gagal('QR ini bukan untuk sesi jurnal Anda.', 403);
        }

        if ($qr->sudahExpired() || $qr->status !== 'aktif') {
            return $this->gagal('QR kelas sudah kedaluwarsa. Minta kelas menampilkan QR yang baru.', 410);
        }

        if ($qr->sudahDipindai()) {
            return $this->gagal('QR kelas ini sudah pernah dipindai.', 409);
        }

        if (! app()->isLocal() && ! $this->sesi->masihBerjalan($jurnal->jadwal)) {
            return $this->gagal('Sesi mengajar ini sudah selesai atau belum dimulai.', 422);
        }

        $jurnalSesi = $this->sesi->jurnalSesi($jurnal->jadwal);
        if (! $jurnalSesi || (int) $jurnalSesi->id_jurnal !== (int) $jurnal->id_jurnal) {
            return $this->gagal('Jurnal untuk sesi ini belum tersimpan. Simpan jurnal terlebih dahulu.', 422);
        }

        $qr->update([
            'dipindai_at' => now(),
            'dipindai_oleh' => Auth::id(),
            'id_jurnal' => $jurnal->id_jurnal,
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route('qr.tampilkan-guru', $jurnal),
        ]);
    }

    public function tampilkanQrGuru(Jurnal $jurnal): View
    {
        $jurnal->load('jadwal.kelas', 'jadwal.mapel');
        abort_unless((int) $jurnal->jadwal->id_guru === (int) Auth::id(), 403);

        $qrSesi = $this->qrAktif($jurnal->jadwal, 'guru');
        $qrImage = (new SvgWriter)->write(new QrCode($qrSesi->kode_qr))->getDataUri();

        if (! $jadwal) {
            return $this->pesan('Tidak ada sesi pelajaran yang sedang berlangsung.');
        }

        $jurnal = $this->sesi->jurnalSesi($jadwal);

        if ($jurnal && $jurnal->status_verifikasi === 'terverifikasi') {
            return $this->pesan('Kehadiran guru pada sesi ini sudah terverifikasi.');
        }

        if ($this->guruSudahScan($jadwal)) {
            return response()->json(['tahap' => 'scan']);
        }

        return $this->tampilQr($this->qrAktif($jadwal, 'kelas'));
    }

    public function cekStatusGuru(Jurnal $jurnal): JsonResponse
    {
        abort_unless((int) $jurnal->jadwal()->value('id_guru') === (int) Auth::id(), 403);

        $terverifikasi = $jurnal->status_verifikasi === 'terverifikasi';

        if ($terverifikasi) {
            session()->flash('success', 'Guru dan perwakilan kelas berhasil saling scan. Jurnal sudah tercatat di riwayat.');
        }

        return response()->json(['verified' => $terverifikasi]);
    }

    // ================= KELAS =================

    /** Halaman pemindai kelas hanya dibuka setelah guru memindai QR kelas. */
    public function halamanVerifikasiGuru(): View|RedirectResponse
    {
        $idKelas = (int) Auth::user()->id_kelas;
        abort_if(! $idKelas, 404, 'Akun ini belum terhubung ke kelas.');

        $jadwal = $this->sesi->jadwalBerlangsung(idKelas: $idKelas);
        if (! $jadwal && app()->isLocal()) {
            $jurnalDemo = Jurnal::with('jadwal.kelas', 'jadwal.mapel', 'jadwal.guru', 'jadwal.jamPelajaran')
                ->whereDate('tanggal', \App\Support\Waktu::sekarang()->toDateString())
                ->where('status_verifikasi', 'belum_verifikasi')
                ->whereHas('jadwal', fn ($q) => $q->where('id_kelas', $idKelas))
                ->latest('id_jurnal')
                ->first();
            $jadwal = $jurnalDemo?->jadwal;
        }

        if (! $jadwal || ! $this->guruSudahScan($jadwal)) {
            return redirect()->route('kelas.scan')->with('error', 'Guru perlu memindai QR kelas terlebih dahulu.');
        }

        $jurnal = $this->sesi->jurnalSesi($jadwal);
        if (! $jurnal) {
            return redirect()->route('kelas.scan')->with('error', 'Jurnal sesi ini belum tersedia.');
        }

        $rentang = $this->sesi->rentang($jadwal);
        $jamMulai = $rentang->first()?->jamPelajaran?->jam_mulai;
        $jamSelesai = $rentang->last()?->jamPelajaran?->jam_selesai;

        return view('kelas.verifikasiguru', compact('jadwal', 'jurnal', 'rentang', 'jamMulai', 'jamSelesai'));
    }

    /** Ditanya terus oleh halaman scan kelas: tampilkan QR, atau pemindai, atau pesan. */
    public function kelasStatus(): JsonResponse
    {
        $idKelas = Auth::user()->id_kelas;

        if (! $idKelas) {
            return $this->pesan('Akun ini belum terhubung ke kelas.');
        }

        $jadwal = $this->sesi->jadwalBerlangsung(idKelas: (int) $idKelas);

        // Mode demo lokal: kelas tetap bisa menampilkan QR untuk jurnal yang baru dikirim,
        // walaupun jadwal dummy bukan pada hari/jam saat ini.
        if (! $jadwal && app()->isLocal()) {
            $jurnalDemo = Jurnal::with('jadwal.kelas', 'jadwal.mapel')
                ->whereDate('tanggal', \App\Support\Waktu::sekarang()->toDateString())
                ->where('status_verifikasi', 'belum_verifikasi')
                ->whereHas('jadwal', fn ($q) => $q->where('id_kelas', $idKelas))
                ->latest('id_jurnal')
                ->first();
            $jadwal = $jurnalDemo?->jadwal;
        }

        if (! $jadwal) {
            return $this->pesan('Tidak ada sesi pelajaran yang sedang berlangsung.');
        }

        $jurnal = $this->sesi->jurnalSesi($jadwal);

        if ($jurnal && $jurnal->status_verifikasi === 'terverifikasi') {
            return $this->pesan('Kehadiran guru pada sesi ini sudah terverifikasi.');
        }

        if ($this->guruSudahScan($jadwal)) {
            return response()->json(['tahap' => 'scan', 'sesi' => $this->detailSesi($jadwal)]);
        }

        return $this->tampilQr($this->qrAktif($jadwal, 'kelas'), $jadwal);
    }

    /** Kelas memindai QR guru. Jurnal harus sudah diisi & dikirim guru lebih dulu. */
    public function scanGuruQr(Request $request): JsonResponse
    {
        $request->validate(['kode_qr' => 'required|string']);

        $user = Auth::user();

        if (! $user->id_kelas) {
            return $this->gagal('Akun ini belum terhubung ke kelas.', 403);
        }

        $qr = QrSesi::with('jadwal')
            ->where('kode_qr', $request->kode_qr)
            ->where('tipe', 'guru')
            ->first();

        if (! $qr) {
            return $this->gagal('QR tidak dikenali.', 404);
        }

        if ($qr->sudahExpired()) {
            return $this->gagal('QR guru sudah kedaluwarsa. Tunggu QR yang baru muncul di layar guru.', 410);
        }

        if ($qr->sudahDipindai()) {
            return $this->gagal('QR ini sudah pernah dipindai.', 409);
        }

        if ((int) $user->id_kelas !== (int) $qr->jadwal->id_kelas) {
            return $this->gagal('QR ini bukan untuk kelas Anda.', 403);
        }

        $berlangsung = $this->sesi->jadwalBerlangsung(idKelas: (int) $user->id_kelas);
        if (! $berlangsung && app()->isLocal() && $this->sesi->jurnalSesi($qr->jadwal)) {
            $berlangsung = $qr->jadwal;
        }

        if (! $berlangsung || (int) $berlangsung->id_guru !== (int) $qr->jadwal->id_guru) {
            return $this->gagal('Sesi pelajaran ini sudah selesai atau belum dimulai.', 422);
        }

        if (! $this->guruSudahScan($berlangsung)) {
            return $this->gagal('Guru belum memindai QR kelas. Minta guru memindai QR di layar kelas lebih dulu.', 422);
        }

        $jurnal = $this->sesi->jurnalSesi($berlangsung);

        if (! $jurnal) {
            return $this->gagal('Guru belum mengisi dan mengirim jurnal untuk sesi ini.', 422);
        }

        DB::transaction(function () use ($berlangsung, $qr, $jurnal, $user) {
            $jurnal->update(['status_verifikasi' => 'terverifikasi']);

            $qr->update([
                'dipindai_at' => now(),
                'dipindai_oleh' => $user->id,
                'id_jurnal' => $jurnal->id_jurnal,
            ]);

            // scan guru terhadap QR kelas sudah terpakai
            QrSesi::where('tipe', 'kelas')
                ->where('dipindai_oleh', $berlangsung->id_guru)
                ->where('status', 'aktif')
                ->whereHas('jadwal', fn ($q) => $q
                    ->where('id_kelas', $berlangsung->id_kelas)
                    ->where('id_mapel', $berlangsung->id_mapel))
                ->update(['status' => 'expired']);
        });

        session()->flash('notif_sukses', 'Verifikasi berhasil! Kehadiran guru tercatat.');

        return response()->json([
            'success' => true,
            'redirect' => route('kelas.beranda'), // ⚠️ cek: ini nama route dashboard kelas kamu?
        ]);
    }

    // ================= GURU =================

    /** Ditanya terus oleh halaman scan guru. */
    public function guruStatus(): JsonResponse
    {
        $jadwal = $this->sesi->jadwalBerlangsung(idGuru: (int) Auth::id());

        if (! $jadwal) {
            return $this->pesan('Anda tidak memiliki sesi mengajar yang sedang berlangsung.');
        }

        $jurnal = $this->sesi->jurnalSesi($jadwal);

        if (! $jurnal) {
            return response()->json([
                'tahap' => 'selesai',
                'redirect' => route('jurnal.create', ['jadwal' => $jadwal->id_jadwal]),
            ]);
        }

        if ($jurnal->status_verifikasi === 'terverifikasi') {
            session()->flash('notif_sukses', 'Verifikasi berhasil! Sesi mengajar tercatat.');

            return response()->json([
                'tahap' => 'selesai',
                'redirect' => route('dashboard-guru'),
            ]);
        }

        if ($this->guruSudahScan($jadwal)) {
            return $this->tampilQr($this->qrAktif($jadwal, 'guru'));
        }

        return response()->json(['tahap' => 'scan']);
    }

    /** Guru memindai QR kelas (langkah pertama proses verifikasi). */
    public function guruScanKelas(Request $request): JsonResponse
    {
        $request->validate(['kode_qr' => 'required|string']);

        $qr = QrSesi::with('jadwal')
            ->where('kode_qr', $request->kode_qr)
            ->where('tipe', 'kelas')
            ->first();

        if (! $qr) {
            return $this->gagal('QR tidak dikenali.', 404);
        }

        if ($qr->sudahExpired()) {
            return $this->gagal('QR kelas sudah kedaluwarsa. Tunggu QR yang baru muncul di layar kelas.', 410);
        }

        if ($qr->sudahDipindai()) {
            return $this->gagal('QR ini sudah pernah dipindai.', 409);
        }

        $berlangsung = $this->sesi->jadwalBerlangsung(
            idKelas: (int) $qr->jadwal->id_kelas,
            idGuru: (int) Auth::id(),
        );

        if (! $berlangsung) {
            return $this->gagal('Anda tidak memiliki sesi di kelas ini pada jam ini.', 403);
        }

        if (! $this->sesi->jurnalSesi($berlangsung)) {
            return $this->gagal('Isi dan kirim jurnal terlebih dahulu sebelum verifikasi.', 422);
        }

        $qr->update(['dipindai_at' => now(), 'dipindai_oleh' => Auth::id()]);

        return response()->json(['success' => true]);
    }

    // ================= BANTUAN =================

    private function guruSudahScan(JadwalPelajaran $jadwal): bool
    {
        return QrSesi::where('tipe', 'kelas')
            ->where('status', 'aktif')
            ->where('dipindai_oleh', $jadwal->id_guru)
            ->where('dipindai_at', '>=', now()->subMinutes(self::BATAS_SALING_SCAN_MENIT))
            ->whereHas('jadwal', fn ($q) => $q
                ->where('id_kelas', $jadwal->id_kelas)
                ->where('id_mapel', $jadwal->id_mapel))
            ->exists();
    }

    /** QR yang masih cukup lama umurnya dipakai ulang; kalau tidak, dibuat baru. */
    private function qrAktif(JadwalPelajaran $jadwal, string $tipe): QrSesi
    {
        $qr = QrSesi::where('id_jadwal', $jadwal->id_jadwal)
            ->where('tipe', $tipe)
            ->whereNull('dipindai_at')
            ->where('waktu_expired', '>', now()->addSeconds(self::SISA_MINIMAL_DETIK))
            ->latest('id_qr')
            ->first();

        if ($qr) {
            return $qr;
        }

        QrSesi::whereNull('dipindai_at')->where('waktu_expired', '<', now()->subHour())->delete();

        return QrSesi::create([
            'id_jadwal' => $jadwal->id_jadwal,
            'tipe' => $tipe,
            'kode_qr' => (string) Str::uuid(),
            'waktu_generate' => now(),
            'waktu_expired' => now()->addSeconds(self::MASA_QR_DETIK),
            'status' => 'aktif',
        ]);
    }

    private function tampilQr(QrSesi $qr, ?JadwalPelajaran $jadwal = null): JsonResponse
    {
        $gambar = (new SvgWriter)->write(new QrCode($qr->kode_qr))->getDataUri();

        return response()->json([
            'tahap' => 'tampil_qr',
            'qr' => $gambar,
            'kode' => app()->isLocal() ? $qr->kode_qr : null,
            'sesi' => $jadwal ? $this->detailSesi($jadwal) : null,
        ]);
    }

    private function detailSesi(JadwalPelajaran $jadwal): array
    {
        $jadwal->loadMissing(['kelas', 'mapel', 'guru', 'jamPelajaran']);
        $rentang = $this->sesi->rentang($jadwal);
        $mulai = $rentang->first()?->jamPelajaran?->jam_mulai;
        $selesai = $rentang->last()?->jamPelajaran?->jam_selesai;

        return [
            'guru' => $jadwal->guru?->name ?? '—',
            'mapel' => $jadwal->mapel?->nama_mapel ?? '—',
            'kelas' => $jadwal->kelas?->nama_kelas ?? '—',
            'jam' => $mulai && $selesai ? substr($mulai, 0, 5).' – '.substr($selesai, 0, 5) : '—',
            'status' => 'Sesi Aktif',
        ];
    }

    private function pesan(string $teks): JsonResponse
    {
        return response()->json(['tahap' => 'pesan', 'pesan' => $teks]);
    }

    private function gagal(string $teks, int $status): JsonResponse
    {
        return response()->json(['success' => false, 'message' => $teks], $status);
    }
}

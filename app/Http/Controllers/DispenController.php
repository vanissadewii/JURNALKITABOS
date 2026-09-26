<?php

namespace App\Http\Controllers;

use App\Models\Dispen;
use App\Models\DispenJurnal;
use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DispenController extends Controller
{
    /** @var array<int, string> */
    private array $namaHari = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu',
    ];

    public function index(): View
    {
        $riwayat = Dispen::with(['siswa', 'kelas', 'guruPiket'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('guru.dispensasi-siswa', compact('riwayat'));
    }

    public function cariSiswa(Request $request): JsonResponse
    {
        $q = $request->query('q', '');

        $siswa = Siswa::with('kelas')
            ->where('nama', 'like', "%{$q}%")
            ->orWhere('nisn', 'like', "%{$q}%")
            ->limit(10)
            ->get()
            ->map(function ($s) {
                return [
                    'id_siswa' => $s->id_siswa,
                    'nama' => $s->nama,
                    'nisn' => $s->nisn,
                    'id_kelas' => $s->id_kelas,
                    'label_kelas' => $s->kelas
                        ? "{$s->kelas->tingkat} {$s->kelas->jurusan} {$s->kelas->rombel}"
                        : '-',
                ];
            });

        return response()->json($siswa);
    }

    public function opsiJam(Request $request): JsonResponse
    {
        $kelas = Kelas::findOrFail((int) $request->query('id_kelas'));
        $tanggal = Carbon::parse($request->query('tanggal'));

        $isoWeekday = $tanggal->dayOfWeekIso;
        $hari = $this->namaHari[$isoWeekday] ?? null;

        if (! $hari) {
            return response()->json([
                'hari' => null,
                'jam' => [],
                'pesan' => 'Tanggal yang dipilih jatuh di akhir pekan (tidak ada jadwal pelajaran).',
            ]);
        }

        $jamList = JamPelajaran::where('tingkat', $kelas->tingkat)
            ->where('hari', $hari)
            ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->orderBy('jam_ke')
            ->get(['id_jam', 'jam_ke', 'jam_mulai', 'jam_selesai']);

        return response()->json([
            'hari' => $hari,
            'jam' => $jamList,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'tanggal' => 'required|date',
            'jam_ke_mulai' => 'required|integer|between:1,13',
            'jam_ke_selesai' => 'required|integer|between:1,13|gte:jam_ke_mulai',
            'alasan' => 'required|string|max:500',
        ]);

        $kelas = Kelas::findOrFail($validated['id_kelas']);
        $siswa = Siswa::findOrFail($validated['id_siswa']);
        abort_if((int) $siswa->id_kelas !== (int) $kelas->id_kelas, 422, 'Kelas siswa tidak sesuai.');
        $hari = $this->namaHari[Carbon::parse($validated['tanggal'])->dayOfWeekIso] ?? null;
        abort_if(! $hari, 422, 'Dispensasi hanya dapat diajukan pada hari sekolah.');
        $jamTersedia = JamPelajaran::where('tingkat', $kelas->tingkat)
            ->where('hari', $hari)
            ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->whereIn('jam_ke', [$validated['jam_ke_mulai'], $validated['jam_ke_selesai']])
            ->pluck('jam_ke');
        abort_unless($jamTersedia->contains((int) $validated['jam_ke_mulai']) && $jamTersedia->contains((int) $validated['jam_ke_selesai']), 422, 'Rentang jam tidak sesuai dengan jadwal kelas.');

        $dispen = Dispen::create([
            ...$validated,
            'nomor_surat' => $this->generateNomorSurat(),
            'id_guru_piket' => auth()->id(),
            'status' => 'menunggu',
            'token_approval' => Str::random(40),
        ]);

        return redirect()
            ->route('dispen.index')
            ->with('success', "Surat dispen {$dispen->nomor_surat} berhasil dibuat.")
            ->with('link_wa', $this->linkWaWaka($dispen));
    }

    private function linkWaWaka(Dispen $dispen): ?string
    {
        $nomor = config('jurnal.admin_phone', '087782599520');
        $nomor = (string) preg_replace('/\D/', '', $nomor);
        $nomor = str_starts_with($nomor, '0') ? '62'.substr($nomor, 1) : $nomor;

        $dispen->loadMissing('siswa');

        $linkApproval = request()->getSchemeAndHttpHost()
            .route('dispen.approval', $dispen->token_approval, false);
        $namaWaka = config('waka.nama');

        $pesan = "Yth. {$namaWaka},\n\n"
            ."Ada surat dispen {$dispen->nomor_surat} untuk {$dispen->siswa->nama} yang menunggu persetujuan Anda.\n\n"
            ."Buka: {$linkApproval}";

        return 'https://wa.me/'.$nomor.'?text='.urlencode($pesan);
    }

    public function halamanApproval(string $token): View
    {
        $dispen = Dispen::with(['siswa', 'kelas', 'guruPiket'])
            ->where('token_approval', $token)
            ->firstOrFail();

        // Link berisi token acak unik yang dikirim langsung ke Waka; token hanya berlaku sekali.
        $alasanTidakBisa = $dispen->status !== 'menunggu' ? 'sudah_diproses' : null;

        return view('guru-piket.dispen-approval', [
            'dispen' => $dispen,
            'bisaApprove' => $alasanTidakBisa === null,
            'alasanTidakBisa' => $alasanTidakBisa,
        ]);
    }

    public function setujui(string $token): RedirectResponse
    {
        $dispen = Dispen::where('token_approval', $token)->where('status', 'menunggu')->firstOrFail();

        // Otorisasi berasal dari token persetujuan sekali pakai yang hanya dikirim ke Waka.
        $dispen->update(['status' => 'disetujui', 'disetujui_at' => now()]);

        $this->salurkanKeJurnal($dispen);

        return back()->with('success', 'Dispen disetujui dan otomatis tercatat di jurnal guru terkait.');
    }

    public function tolak(string $token): RedirectResponse
    {
        $dispen = Dispen::where('token_approval', $token)->where('status', 'menunggu')->firstOrFail();

        $dispen->update(['status' => 'ditolak']);

        return back()->with('success', 'Dispen ditolak.');
    }

    private function tolakJikaTakBerhak(Dispen $dispen): ?RedirectResponse
    {
        $user = auth()->user();

        if (! $user) {
            return back()->with('error', 'Anda harus login sebagai guru piket terlebih dahulu.');
        }

        if ($user->id === $dispen->id_guru_piket) {
            return back()->with('error', 'Tidak bisa memproses pengajuan yang Anda buat sendiri. Minta guru piket lain.');
        }

        if (! $user->sedangPiket()) {
            return back()->with('error', 'Hanya guru yang sedang bertugas piket saat ini yang bisa memproses surat ini.');
        }

        return null;
    }

    private function salurkanKeJurnal(Dispen $dispen): void
    {
        $tanggal = Carbon::parse($dispen->tanggal);
        $isoWeekday = $tanggal->dayOfWeekIso;
        $hari = $this->namaHari[$isoWeekday] ?? null;

        if (! $hari) {
            return;
        }

        $jamHariItu = JamPelajaran::where('tingkat', $dispen->kelas->tingkat)
            ->where('hari', $hari)
            ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->orderBy('jam_ke')
            ->get(['id_jam', 'jam_ke']);

        $semuaJam = $jamHariItu->pluck('jam_ke');

        $jamMulai = $dispen->jam_ke_mulai;
        $jamSelesai = $dispen->jam_ke_selesai ?? $semuaJam->max();

        $idJamTerdampak = $jamHariItu
            ->whereBetween('jam_ke', [$jamMulai, $jamSelesai])
            ->pluck('id_jam');

        if ($idJamTerdampak->isEmpty()) {
            return;
        }

        $jamTerdampak = $semuaJam->filter(
            fn ($jamKe) => $jamKe >= $jamMulai && $jamKe <= $jamSelesai
        );

        if ($jamTerdampak->isEmpty()) {
            return;
        }

        $idJamTerdampak = JamPelajaran::where('tingkat', $dispen->kelas->tingkat)
            ->where('hari', $hari)
            ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->whereIn('jam_ke', $jamTerdampak)
            ->pluck('id_jam');

        $jadwalTerdampak = JadwalPelajaran::where('id_kelas', $dispen->id_kelas)
            ->whereIn('id_jam', $idJamTerdampak)
            ->get();

        $keterangan = "Dispen: {$dispen->siswa->nama} ({$dispen->alasan})";

        foreach ($jadwalTerdampak as $jadwal) {
            $jurnal = Jurnal::firstOrNew([
                'id_jadwal' => $jadwal->id_jadwal,
                'tanggal' => $dispen->tanggal,
            ]);

            if ($jurnal->exists && ! empty($jurnal->keterangan)) {
                $jurnal->keterangan = $jurnal->keterangan." | {$keterangan}";
            } else {
                $jurnal->keterangan = $keterangan;
            }

            $jurnal->save();

            $absensi = $jurnal->absenSiswa()->where('id_siswa', $dispen->id_siswa)->first();
            if ($absensi) {
                $absensi->update(['nama' => $dispen->siswa->nama, 'status' => 'Dispen']);
            } else {
                $jurnal->absenSiswa()->create(['id_siswa' => $dispen->id_siswa, 'nama' => $dispen->siswa->nama, 'status' => 'Dispen']);
            }

            DispenJurnal::updateOrCreate(
                ['id_dispen' => $dispen->id_dispen, 'id_jadwal' => $jadwal->id_jadwal],
                ['id_jurnal' => $jurnal->id_jurnal]
            );
        }
    }

    private function generateNomorSurat(): string
    {
        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $now = now();
        $urutan = Dispen::whereYear('created_at', $now->year)->count() + 1;
        $nomor = str_pad((string) $urutan, 3, '0', STR_PAD_LEFT);

        return "DSP/{$nomor}/{$bulanRomawi[$now->month]}/{$now->year}";
    }
}

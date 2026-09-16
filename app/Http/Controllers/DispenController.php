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
    ];

    public function index(): View
    {
        $riwayat = Dispen::with(['siswa', 'kelas', 'guruPiket'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('guru-piket.dispen', compact('riwayat'));
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
            'jam_ke_mulai' => 'required|integer|min:1',
            'jam_ke_selesai' => 'nullable|integer|min:1|gte:jam_ke_mulai',
            'alasan' => 'required|string|max:500',
        ]);

        $dispen = Dispen::create([
            ...$validated,
            'nomor_surat' => $this->generateNomorSurat(),
            'id_guru_piket' => auth()->id(),
            'status' => 'menunggu',
            'token_approval' => Str::random(40),
        ]);

        // TODO: kirim link approval ke waka di sini

        return redirect()
            ->route('dispen.index')
            ->with('success', "Surat dispen {$dispen->nomor_surat} berhasil dibuat dan menunggu persetujuan Waka.");
    }

    public function halamanApproval(string $token): View
    {
        $dispen = Dispen::with(['siswa', 'kelas', 'guruPiket'])
            ->where('token_approval', $token)
            ->firstOrFail();

        return view('guru-piket.dispen-approval', compact('dispen'));
    }

    public function setujui(string $token): RedirectResponse
    {
        $dispen = Dispen::where('token_approval', $token)
            ->where('status', 'menunggu')
            ->firstOrFail();

        $dispen->update([
            'status' => 'disetujui',
            'disetujui_at' => now(),
        ]);

        $this->salurkanKeJurnal($dispen);

        return back()->with('success', 'Dispen disetujui dan otomatis tercatat di jurnal guru terkait.');
    }

    public function tolak(string $token): RedirectResponse
    {
        $dispen = Dispen::where('token_approval', $token)
            ->where('status', 'menunggu')
            ->firstOrFail();

        $dispen->update(['status' => 'ditolak']);

        return back()->with('success', 'Dispen ditolak.');
    }

    private function salurkanKeJurnal(Dispen $dispen): void
    {
        $tanggal = Carbon::parse($dispen->tanggal);
        $isoWeekday = $tanggal->dayOfWeekIso;
        $hari = $this->namaHari[$isoWeekday] ?? null;

        if (! $hari) {
            return;
        }

        $semuaJam = JamPelajaran::where('tingkat', $dispen->kelas->tingkat)
            ->where('hari', $hari)
            ->orderBy('jam_ke')
            ->pluck('jam_ke');

        $jamMulai = $dispen->jam_ke_mulai;
        $jamSelesai = $dispen->jam_ke_selesai ?? $semuaJam->max();

        $jamTerdampak = $semuaJam->filter(
            fn ($jamKe) => $jamKe >= $jamMulai && $jamKe <= $jamSelesai
        );

        if ($jamTerdampak->isEmpty()) {
            return;
        }

        $idJamTerdampak = JamPelajaran::where('tingkat', $dispen->kelas->tingkat)
            ->where('hari', $hari)
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

            DispenJurnal::updateOrCreate(
                ['id_dispen' => $dispen->id_dispen, 'id_jadwal' => $jadwal->id_jadwal],
                ['id_jurnal' => $jurnal->id_jurnal]
            );
        }
    }

    private function generateNomorSurat(): string
    {
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];

        $now = now();
        $urutan = Dispen::whereYear('created_at', $now->year)->count() + 1;
        $nomor = str_pad((string) $urutan, 3, '0', STR_PAD_LEFT);

        return "DSP/{$nomor}/{$bulanRomawi[$now->month]}/{$now->year}";
    }
}

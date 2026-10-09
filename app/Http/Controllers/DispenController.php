<?php

namespace App\Http\Controllers;

use App\Models\Dispen;
use App\Models\DispenJurnal;
use App\Models\JadwalPelajaran;
use App\Models\JamPelajaran;
use App\Models\Jurnal;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Support\KegiatanTanggal;
use App\Support\WakaPiket;
use App\Support\Waktu;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

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
        $riwayat = Dispen::with(['siswa', 'kelas', 'guruPiket', 'waka'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('guru.dispensasi-siswa', [
            'riwayat' => $riwayat,
            'waka' => WakaPiket::bertugas(Waktu::sekarang()->toDateString()),
        ]);
    }

    public function cariSiswa(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));

        if (mb_strlen($q) < 1) {
            return response()->json([]);
        }

        $siswa = Siswa::with('kelas')
            ->where(function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%")
                    ->orWhere('nisn', 'like', "%{$q}%");
            })
            ->orderBy('nama')
            ->limit(15)
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

        if (KegiatanTanggal::jadwalDitiadakan($tanggal)) {
            return response()->json(['hari' => $hari, 'jam' => [], 'pesan' => 'Tidak ada jadwal pelajaran karena kegiatan sekolah: '.KegiatanTanggal::nama($tanggal).'.']);
        }

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
            ->whereBetween('jam_ke', [1, 13])
            ->orderBy('jam_ke')
            ->get(['id_jam', 'jam_ke', 'jam_mulai', 'jam_selesai']);

        if ($tanggal->isSameDay(Waktu::sekarang())) {
            $sekarang = Waktu::sekarang();
            $jamList = $jamList->filter(function ($jam) use ($tanggal, $sekarang) {
                $mulai = Carbon::parse($tanggal->toDateString().' '.$jam->jam_mulai, $sekarang->timezone);
                $selesai = Carbon::parse($tanggal->toDateString().' '.$jam->jam_selesai, $sekarang->timezone);
                if ($selesai->lessThanOrEqualTo($mulai)) {
                    $selesai->addDay();
                }

                return $selesai->greaterThan($sekarang);
            })->values();
        }

        return response()->json([
            'hari' => $hari,
            'jam' => $jamList,
        ]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'id_siswa' => 'nullable|exists:siswa,id_siswa',
            'id_siswa_list' => 'nullable|array|min:1',
            'id_siswa_list.*' => 'required|integer|distinct|exists:siswa,id_siswa',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'id_kelas_list' => 'nullable|array|min:1',
            'id_kelas_list.*' => 'required|integer|distinct|exists:kelas,id_kelas',
            'tanggal' => 'required|date',
            'jam_ke_mulai' => 'required|integer|between:1,13',
            'jam_ke_selesai' => 'required|integer|between:1,13|gte:jam_ke_mulai',
            'alasan' => 'required|string|max:500',
        ]);

        $idSiswa = collect($validated['id_siswa_list'] ?? (isset($validated['id_siswa']) ? [$validated['id_siswa']] : []))->map(fn ($id) => (int) $id)->unique()->values();
        abort_if($idSiswa->isEmpty(), 422, 'Pilih minimal satu siswa.');
        $siswaTerpilih = Siswa::whereIn('id_siswa', $idSiswa)->get();
        $kelasIds = collect($validated['id_kelas_list'] ?? (isset($validated['id_kelas']) ? [$validated['id_kelas']] : []))->flatMap(fn ($id) => str_contains((string) $id, ',') ? explode(',', (string) $id) : [$id])->map(fn ($id) => (int) $id)->unique();
        $kelasSiswa = $siswaTerpilih->pluck('id_kelas')->map(fn ($id) => (int) $id)->unique();
        abort_if($kelasIds->isEmpty() || $kelasSiswa->diff($kelasIds)->isNotEmpty(), 422, 'Semua siswa harus berasal dari kelas yang dipilih.');
        abort_if($siswaTerpilih->count() !== $idSiswa->count() || $siswaTerpilih->contains(fn ($siswa) => ! $kelasIds->contains((int) $siswa->id_kelas)), 422, 'Semua siswa harus berasal dari kelas yang dipilih.');
        $tanggalDispen = Carbon::parse($validated['tanggal']);
        $hari = $this->namaHari[$tanggalDispen->dayOfWeekIso] ?? null;
        abort_if(KegiatanTanggal::jadwalDitiadakan($tanggalDispen), 422, 'Tidak ada jadwal pelajaran pada tanggal kegiatan sekolah: '.KegiatanTanggal::nama($tanggalDispen).'.');
        abort_if(! $hari, 422, 'Dispensasi hanya dapat diajukan pada hari sekolah.');
        $tingkatTerpilih = Kelas::whereIn('id_kelas', $kelasIds)->pluck('tingkat')->unique();
        $jamTersedia = JamPelajaran::whereIn('tingkat', $tingkatTerpilih)
            ->where('hari', $hari)
            ->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))
            ->whereIn('jam_ke', [$validated['jam_ke_mulai'], $validated['jam_ke_selesai']])
            ->pluck('jam_ke');
        abort_unless($jamTersedia->contains((int) $validated['jam_ke_mulai']) && $jamTersedia->contains((int) $validated['jam_ke_selesai']), 422, 'Rentang jam tidak sesuai dengan jadwal kelas.');

        foreach ($kelasIds as $kelasId) {
            $tingkat = Kelas::find($kelasId)?->tingkat;
            $jamKelas = JamPelajaran::where('tingkat', $tingkat)->where('hari', $hari)->whereHas('semester', fn ($q) => $q->where('status', 'aktif'))->whereIn('jam_ke', [$validated['jam_ke_mulai'], $validated['jam_ke_selesai']])->pluck('jam_ke');
            abort_unless($jamKelas->contains((int) $validated['jam_ke_mulai']) && $jamKelas->contains((int) $validated['jam_ke_selesai']), 422, 'Rentang jam tidak tersedia pada semua kelas yang dipilih.');
        }

        // Kiriman baru hanya dibuat jika Waka tujuan memiliki nomor WhatsApp valid.
        $waka = WakaPiket::bertugas(Carbon::parse($validated['tanggal'])->toDateString());
        if (! $waka) {
            $pesan = 'Pengajuan belum disimpan karena Waka yang bertugas atau nomor WhatsApp-nya belum tersedia.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $pesan], 422);
            }

            return back()->withInput()->withErrors(['waka' => $pesan]);
        }

        $dispenList = DB::transaction(function () use ($idSiswa, $siswaTerpilih, $validated, $waka) {
            $suratDibuat = collect();
            foreach ($idSiswa as $id) {
                $siswa = $siswaTerpilih->firstWhere('id_siswa', $id);
                $suratDibuat->push(Dispen::create([
                    ...collect($validated)->except(['id_siswa', 'id_siswa_list', 'id_kelas_list'])->all(),
                    'id_siswa' => $id,
                    'id_kelas' => $siswa->id_kelas,
                    'id_waka_piket' => $waka->id,
                    'nomor_surat' => $this->generateNomorSurat(),
                    'id_guru_piket' => auth()->id(),
                    'id_waka' => $waka->id,
                    'status' => 'menunggu',
                    'token_approval' => Str::random(40),
                ]));
            }

            return $suratDibuat;
        });

        $dispen = $dispenList->last();
        $dispenList->each(fn (Dispen $surat) => $surat->loadMissing(['siswa', 'kelas', 'guruPiket', 'waka']));
        $dispen->loadMissing(['siswa', 'kelas', 'guruPiket', 'waka']);

        $redirect = redirect()
            ->route('dispen.index')
            ->with('success', $idSiswa->count() === 1 ? "Surat dispen {$dispen->nomor_surat} berhasil dibuat." : "{$idSiswa->count()} surat dispen berhasil dibuat untuk ".$kelasIds->count()." kelas.")
            ->with('waka_dituju', $waka?->nama)
            ->with('nomor_waka', $waka?->nomorTampilan());

        $linkWa = $this->linkWaWaka($dispenList);
        $pesanBerhasil = $idSiswa->count() === 1
            ? "Surat dispen {$dispen->nomor_surat} berhasil dibuat."
            : "{$idSiswa->count()} surat dispen berhasil dibuat untuk ".$kelasIds->count()." kelas.";

        if ($linkWa) {
            if ($request->expectsJson()) {
                session()->flash('success', $pesanBerhasil);

                return response()->json([
                    'success' => true,
                    'link_wa' => $linkWa,
                    'redirect' => route('dispen.index', [], false),
                ]);
            }

            return $redirect;
        }

        $pesanPeringatan = $waka
            ? "Nomor WhatsApp Waka {$waka->nama} belum diisi admin, jadi persetujuan belum bisa dikirim otomatis."
            : 'Jadwal Waka pada tanggal tersebut belum tersedia, jadi persetujuan belum bisa dikirim otomatis.';

        if ($request->expectsJson()) {
            session()->flash('success', $pesanBerhasil);
            session()->flash('warning', $pesanPeringatan);
            session()->flash('link_approval', $this->tautanPersetujuanList($dispenList));

            return response()->json([
                'success' => true,
                'warning' => $pesanPeringatan,
                'link_approval' => $this->tautanPersetujuanList($dispenList),
                'redirect' => route('dispen.index', [], false),
            ]);
        }

        return $redirect
            ->with('link_approval', $this->tautanPersetujuanList($dispenList))
            ->with('warning', $pesanPeringatan);
    }

    /** Tautan persetujuan lengkap (absolut) agar bisa langsung diklik di WhatsApp. */
    private function linkApproval(Dispen $dispen): string
    {
        $path = route('dispen.approval', ['token' => $dispen->token_approval], false);
        $baseUrl = rtrim((string) config('jurnal.dispen_public_url'), '/');

        return $baseUrl.$path;
    }

    private function linkWaWaka(Collection $dispenList): ?string
    {
        $dispen = $dispenList->first();
        $dispen->loadMissing(['waka', 'guruPiket']);

        $nomor = $dispen->waka?->nomorWa();

        if (! $nomor || ! $dispen->waka->nomorValid()) {
            return null;
        }

        $barisSiswa = $dispenList->map(function (Dispen $surat) {
            $surat->loadMissing(['siswa', 'kelas']);
            $kelas = $surat->kelas
                ? "{$surat->kelas->tingkat} {$surat->kelas->jurusan} {$surat->kelas->rombel}"
                : '-';

            return "- {$surat->siswa?->nama} · {$kelas} · No. surat {$surat->nomor_surat}";
        })->implode("\n");
        $tautanPersetujuan = $dispenList->map(function (Dispen $surat) {
            $surat->loadMissing(['siswa', 'kelas']);
            $kelas = $surat->kelas
                ? "{$surat->kelas->tingkat} {$surat->kelas->jurusan} {$surat->kelas->rombel}"
                : '-';

            return "- {$surat->siswa?->nama} ({$kelas}):\n".$this->linkApproval($surat);
        })->implode("\n");

        $pesan = "Halo Waka {$dispen->waka->nama}!\n"
            ."Saya {$dispen->guruPiket?->name} dari guru piket. Mohon tinjau pengajuan dispensasi berikut.\n\n"
            ."Daftar siswa dan kelas:\n{$barisSiswa}\n"
            ."Tanggal: {$dispen->tanggal->format('d/m/Y')}\n"
            ."{$dispen->labelJam()}\n"
            .'Alasan: '.$dispen->alasan."\n"
            ."Pengaju: {$dispen->guruPiket?->name}\n\n"
            ."Tautan persetujuan (buka tanpa login; satu tautan untuk tiap siswa):\n"
            .$tautanPersetujuan;

        return 'https://wa.me/'.$nomor.'?text='.urlencode($pesan);
    }

    private function tautanPersetujuanList(Collection $dispenList): string
    {
        return $dispenList->map(function (Dispen $surat) {
            $surat->loadMissing(['siswa', 'kelas']);
            $kelas = $surat->kelas
                ? "{$surat->kelas->tingkat} {$surat->kelas->jurusan} {$surat->kelas->rombel}"
                : '-';

            return "{$surat->siswa?->nama} ({$kelas}) — {$this->linkApproval($surat)}";
        })->implode("\n");
    }

    /**
     * Halaman persetujuan Waka. Dibuka lewat tautan bertoken pada pesan
     * WhatsApp, sehingga Waka tidak perlu login dan card langsung muncul.
     */
    public function halamanApproval(string $token): View
    {
        $dispen = Dispen::with(['siswa', 'kelas', 'guruPiket', 'waka'])
            ->where('token_approval', $token)
            ->firstOrFail();

        // Token acak unik hanya berlaku sekali; setelah diproses tombol hilang.
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
        $dispen->update(['status' => 'disetujui', 'disetujui_at' => Waktu::sekarang()]);

        $peringatan = null;

        try {
            $this->salurkanKeJurnal($dispen);
        } catch (Throwable $e) {
            Log::error('Gagal menyalurkan dispen ke jurnal: '.$e->getMessage(), ['id_dispen' => $dispen->id_dispen]);
            $peringatan = 'Dispen disetujui, tetapi pencatatan otomatis ke jurnal gagal. Silakan hubungi admin.';
        }

        $redirect = back()->with('success', 'Dispen disetujui dan otomatis tercatat di jurnal guru terkait.');

        return $peringatan ? $redirect->with('warning', $peringatan) : $redirect;
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

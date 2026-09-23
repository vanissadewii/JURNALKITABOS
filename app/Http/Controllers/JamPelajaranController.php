<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JamPelajaranController extends Controller
{
    public function index(): View
    {
        $semesterAktif = Semester::where('status', 'aktif')->first();

        $jamPelajaran = $semesterAktif
            ? JamPelajaran::with('semester')
            ->where('id_semester', $semesterAktif->id_semester)
            ->orderBy('tingkat')
            ->orderBy('hari')
            ->orderBy('jam_ke')
            ->get()
            : collect();

        $urutanHari = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5];

        $jamGrup = $jamPelajaran
            ->groupBy(fn($j) => "{$j->tingkat}|{$j->jam_ke}|{$j->jam_mulai}|{$j->jam_selesai}")
            ->map(function ($items) use ($urutanHari) {
                $first = $items->first();
                $nomor = $items->pluck('hari')->map(fn($h) => $urutanHari[$h])->sort()->values();

                $berurutan = $nomor->count() > 1
                    && $nomor->last() - $nomor->first() === $nomor->count() - 1;
                $namaHari = $nomor->map(fn($n) => array_search($n, $urutanHari));

                return (object) [
                    'semester' => $first->semester,
                    'tingkat' => $first->tingkat,
                    'jam_ke' => $first->jam_ke,
                    'jam_mulai' => substr($first->jam_mulai, 0, 5),
                    'jam_selesai' => substr($first->jam_selesai, 0, 5),
                    'hari' => $berurutan
                        ? $namaHari->first() . ' - ' . $namaHari->last()
                        : $namaHari->implode(', '),
                    'urutan' => $nomor->first(),
                ];
            })
            ->sortBy([['tingkat', 'asc'], ['urutan', 'asc'], ['jam_ke', 'asc']])
            ->values();

        return view('admin.tambah_jam_pelajaran', compact('jamPelajaran', 'jamGrup', 'semesterAktif'));
    }

    public function create(): View
    {
        $semesterAktif = Semester::where('status', 'aktif')->first();

        return view('admin.tambah_jam_pelajaran', compact('semesterAktif'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'kelompok_hari' => 'required|in:senin_kamis,jumat,senin_jumat',
            'jam_ke' => 'required|integer|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $semesterAktif = Semester::where('status', 'aktif')->firstOrFail();

        foreach ($this->daftarHari($validated['kelompok_hari']) as $hari) {
            JamPelajaran::updateOrCreate(
                [
                    'id_semester' => $semesterAktif->id_semester,
                    'tingkat' => $validated['tingkat'],
                    'hari' => $hari,
                    'jam_ke' => $validated['jam_ke'],
                ],
                [
                    'jam_mulai' => $validated['jam_mulai'],
                    'jam_selesai' => $validated['jam_selesai'],
                ]
            );
        }

        return redirect()->back()->with('success', 'Jam pelajaran berhasil ditambahkan.');
    }

    public function generate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'kelompok_hari' => 'required|in:senin_kamis,jumat,senin_jumat',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi_menit' => 'required|integer|min:1',
            'jumlah_jam' => 'required|integer|min:1',
            'jam_ke_mulai' => 'required|integer|min:1',
        ]);

        $semesterAktif = Semester::where('status', 'aktif')->firstOrFail();

        $durasiMenit = (int) $validated['durasi_menit'];
        $jumlahJam = (int) $validated['jumlah_jam'];
        $jamKeMulai = (int) $validated['jam_ke_mulai'];

        foreach ($this->daftarHari($validated['kelompok_hari']) as $hari) {
            $waktu = Carbon::createFromFormat('H:i', $validated['jam_mulai']);

            for ($i = 0; $i < $jumlahJam; $i++) {
                $mulai = $waktu->copy();
                $selesai = $waktu->copy()->addMinutes($durasiMenit);

                JamPelajaran::updateOrCreate(
                    [
                        'id_semester' => $semesterAktif->id_semester,
                        'tingkat' => $validated['tingkat'],
                        'hari' => $hari,
                        'jam_ke' => $jamKeMulai + $i,
                    ],
                    [
                        'jam_mulai' => $mulai->format('H:i'),
                        'jam_selesai' => $selesai->format('H:i'),
                    ]
                );

                $waktu = $selesai;
            }
        }

        return redirect()->back()->with('success', 'Jam pelajaran berhasil digenerate.');
    }

    /** @return array<int, string> */
    private function daftarHari(string $kelompok): array
    {
        return match ($kelompok) {
            'senin_kamis' => ['Senin', 'Selasa', 'Rabu', 'Kamis'],
            'jumat' => ['Jumat'],
            'senin_jumat' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            default => throw new \InvalidArgumentException("Kelompok hari tidak dikenal: {$kelompok}"),
        };
    }

    public function edit(int $id): View
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        return view('admin.edit_jam_pelajaran', compact('jamPelajaran'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $jamPelajaran = JamPelajaran::findOrFail($id);

        $validated = $request->validate([
            'tingkat' => 'required|in:10,11,12',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam_ke' => 'required|integer|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jamPelajaran->update($validated);

        return redirect()->route('jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        JamPelajaran::findOrFail($id)->delete();

        return redirect()->route('jam-pelajaran.index')->with('success', 'Jam pelajaran berhasil dihapus.');
    }

    public function bulkUpdate(Request $request): RedirectResponse
    {
        $ids = $request->input('pilih', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada baris yang dipilih untuk disimpan.');
        }

        $rows = $request->input('rows', []);
        $diperbarui = 0;

        foreach ($ids as $id) {
            if (! isset($rows[(int)$id])) {
                continue;
            }

            $validator = validator($rows[$id], [
                'tingkat' => 'required|in:10,11,12',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
                'jam_ke' => 'required|integer|min:1',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            ]);

            if ($validator->fails()) {
                continue;
            }

            $jam = JamPelajaran::find((int)$id);

            if ($jam) {
                $jam->update($validator->validated());
                $diperbarui++;
            }
        }

        return redirect()->route('jam-pelajaran.index')->with('success', "{$diperbarui} jam pelajaran berhasil diperbarui.");
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $ids = $request->input('pilih', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada baris yang dipilih untuk dihapus.');
        }

        $keyName = (new JamPelajaran)->getKeyName();

        $jumlah = JamPelajaran::whereIn($keyName, $ids)->delete();

        return redirect()->route('jam-pelajaran.index')->with('success', "{$jumlah} jam pelajaran berhasil dihapus.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JamPelajaranController extends Controller
{
    public function index(): View
    {
        $jamPelajaran = JamPelajaran::with('semester')
            ->orderBy('tingkat')
            ->orderBy('hari')
            ->orderBy('jam_ke')
            ->get();

        $semesterAktif = Semester::where('status', 'aktif')->first();

        return view('admin.tambah_jam_pelajaran', compact('jamPelajaran', 'semesterAktif'));
    }

    public function create(): View
    {
        $semesterAktif = Semester::where('status', 'aktif')->first();

        return view('admin.tambah_jam_pelajaran', compact('semesterAktif'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_semester' => 'required|exists:semester,id_semester',
            'tingkat' => 'required|in:10,11,12',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam_ke' => 'required|integer|min:1',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JamPelajaran::create($validated);

        return redirect()->back()->with('success', 'Jam pelajaran berhasil ditambahkan.');
    }

    public function generate(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'id_semester'   => 'required|exists:semester,id_semester',
        'tingkat'       => 'required|in:10,11,12',
        'hari'          => 'required|array',
        'hari.*'        => 'in:Senin,Selasa,Rabu,Kamis,Jumat',
        'jam_mulai'     => 'required|date_format:H:i',
        'durasi_menit'  => 'required|integer|min:1',
        'jumlah_jam'    => 'required|integer|min:1',
        'jam_ke_mulai'  => 'required|integer|min:1',
    ]);

    $durasiMenit = (int) $validated['durasi_menit'];
    $jumlahJam   = (int) $validated['jumlah_jam'];
    $jamKeMulai  = (int) $validated['jam_ke_mulai'];

    foreach ($validated['hari'] as $hari) {
        $waktu = \Carbon\Carbon::createFromFormat('H:i', $validated['jam_mulai']);

        for ($i = 0; $i < $jumlahJam; $i++) {
            $jamKe = $jamKeMulai + $i;
            $mulai = $waktu->copy();
            $selesai = $waktu->copy()->addMinutes($durasiMenit);

            JamPelajaran::updateOrCreate(
                [
                    'id_semester' => $validated['id_semester'],
                    'tingkat'     => $validated['tingkat'],
                    'hari'        => $hari,
                    'jam_ke'      => $jamKe,
                ],
                [
                    'jam_mulai'   => $mulai->format('H:i'),
                    'jam_selesai' => $selesai->format('H:i'),
                ]
            );

            $waktu = $selesai;
        }
    }

    return redirect()->back()->with('success', 'Jam pelajaran berhasil digenerate.');
}
}
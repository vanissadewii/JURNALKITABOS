<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MasterKelasController extends Controller
{
    public function index(): View
    {
        $kelases = Kelas::all();

        return view('admin.tambah_kelas', compact('kelases'));
    }

    public function create(): View
    {
        $kelases = Kelas::all();

        return view('admin.tambah_kelas', compact('kelases'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tingkat' => ['required', 'integer', Rule::in([10, 11, 12])],
            'jurusan' => ['required', 'string', 'max:50'],
            'rombel' => [
                'required', 'integer', 'min:1',
                Rule::unique('kelas')->where(function ($query) use ($request) {
                    return $query->where('tingkat', $request->tingkat)
                        ->where('jurusan', $request->jurusan);
                }),
            ],
        ]);

        Kelas::create([
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }
}

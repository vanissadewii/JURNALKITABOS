<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SemesterController extends Controller
{
    public function index(): View
    {
        $semesters = Semester::orderBy('tanggal_mulai', 'desc')->get();
        return view('admin.tambah_semester', compact('semesters'));
    }

    public function create(): View
    {
        return view('admin.tambah_semester');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        Semester::where('status', 'aktif')->update(['status' => 'nonaktif']);

        $validated['status'] = 'aktif';
        Semester::create($validated);

        return redirect()->back()->with('success', 'Semester berhasil ditambahkan dan diaktifkan.');
    }
}
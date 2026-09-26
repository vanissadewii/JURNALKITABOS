<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

<<<<<<< HEAD
=======
    public function update(Request $request, int $id): RedirectResponse
    {
        $semester = Semester::findOrFail($id);
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:50'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after:tanggal_mulai'],
        ]);

        $semester->update($validated);

        return redirect()->route('semester.index')->with('success', 'Semester berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $semester = Semester::findOrFail($id);

        if ($semester->status === 'aktif') {
            return redirect()->route('semester.index')->with('error', 'Semester aktif tidak dapat dihapus. Aktifkan semester lain terlebih dahulu.');
        }

        if ($semester->jamPelajaran()->exists()) {
            return redirect()->route('semester.index')->with('error', 'Semester tidak dapat dihapus karena masih memiliki data jam pelajaran.');
        }

        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Semester berhasil dihapus.');
    }

>>>>>>> putri/tampilan-admin
    public function activate($id): RedirectResponse
    {
        Semester::where('status', 'aktif')->update(['status' => 'nonaktif']);

        $semester = Semester::findOrFail($id);
        $semester->update(['status' => 'aktif']);

        return redirect()->back()->with('success', 'Semester berhasil diaktifkan.');
    }
}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>html,#semesterTableViewport{scrollbar-width:none}html::-webkit-scrollbar,#semesterTableViewport::-webkit-scrollbar{display:none}</style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')
    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div><p class="text-xs font-medium text-[#D7B899]">Atur tahun ajaran dan semester</p><h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Semester</h1></div>
                <button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button>
            </div>
        </header>
        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            <div><h2 class="font-['Poppins'] text-xl font-bold">Kelola Semester</h2><p class="mt-1 text-sm text-[#7A6A60]">Semester aktif akan digunakan pada pengaturan Jam Pelajaran.</p></div>
            @if (session('success'))<div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>@endif
            @if (session('error'))<div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm font-semibold text-[#C62828]">{{ session('error') }}</div>@endif
            @if ($errors->any())<div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]"><p class="font-semibold">Periksa kembali data semester:</p><ul class="mt-2 list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6"><h3 class="font-['Poppins'] text-base font-bold">Informasi Semester</h3><p class="mt-1 text-xs leading-5 text-[#7A6A60]">Isi nama semester beserta periode mulai dan selesainya.</p></div>
                <form method="POST" action="{{ route('semester.store') }}" class="p-5 sm:p-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Nama Semester</span><input name="nama" value="{{ old('nama') }}" maxlength="50" placeholder="Contoh: Semester 1 2026/2027" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label>
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tanggal Mulai</span><input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label>
                        <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tanggal Selesai</span><input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label>
                    </div>
                    <div class="mt-6 flex justify-end border-t border-[#E5D8CC] pt-4"><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Semester</button></div>
                </form>
            </article>
            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6"><div><h3 class="font-['Poppins'] text-base font-bold">Daftar Semester</h3><p class="mt-1 text-xs text-[#7A6A60]">Pilih semester aktif yang digunakan pada Jam Pelajaran.</p></div><span class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">{{ $semesters->count() }} Semester</span></div>
                <div id="semesterTableViewport" class="overflow-x-auto"><table class="w-full min-w-[720px] border-collapse text-left text-sm">
                    <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]"><tr><th class="border-b border-r border-[#E5D8CC] px-4 py-3">No</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Semester</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Mulai</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Selesai</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Status</th><th class="border-b border-[#E5D8CC] px-4 py-3 text-center">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($semesters as $i => $semester)
                            <tr class="hover:bg-[#FFFCF9]"><td class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[#7A6A60]">{{ $i + 1 }}</td><td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-semibold">{{ $semester->nama }}</td><td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ \Illuminate\Support\Carbon::parse($semester->tanggal_mulai)->format('d/m/Y') }}</td><td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ \Illuminate\Support\Carbon::parse($semester->tanggal_selesai)->format('d/m/Y') }}</td><td class="border-b border-r border-[#E5D8CC] px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $semester->status === 'aktif' ? 'bg-[#E8F5E9] text-[#2E7D32]' : 'bg-[#F5EFE8] text-[#7A6A60]' }}">{{ ucfirst($semester->status) }}</span></td><td class="border-b border-[#E5D8CC] px-4 py-3 text-center"><div class="flex flex-wrap items-center justify-center gap-2">@if($semester->status !== 'aktif')<form method="POST" action="{{ route('semester.activate', $semester->id_semester) }}" onsubmit="return confirm('Aktifkan {{ addslashes($semester->nama) }}? Semester aktif saat ini akan diganti.')">@csrf @method('PATCH')<button type="submit" class="rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Jadikan Aktif</button></form>@else<span class="text-xs font-semibold text-[#2E7D32]">Sedang digunakan</span>@endif<button type="button" onclick="bukaEditSemester(this)" data-id="{{ $semester->id_semester }}" data-nama="{{ $semester->nama }}" data-mulai="{{ $semester->tanggal_mulai }}" data-selesai="{{ $semester->tanggal_selesai }}" class="rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Edit</button><form method="POST" action="{{ route('semester.destroy', $semester->id_semester) }}" onsubmit="return confirm('Hapus semester {{ addslashes($semester->nama) }}?')">@csrf @method('DELETE')<button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">Hapus</button></form></div></td></tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada semester. Tambahkan melalui form di atas.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
            </article>
        </section>
    </main>
    <div id="editSemesterModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/45 p-4" onclick="if(event.target===this) tutupEditSemester()">
        <section class="w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4"><div><h2 class="font-['Poppins'] text-lg font-bold">Edit Semester</h2><p class="mt-1 text-xs text-[#7A6A60]">Perbarui nama dan periode semester.</p></div><button type="button" onclick="tutupEditSemester()" class="rounded-lg px-3 py-2 text-lg text-[#7A6A60] hover:bg-[#F5EFE8]" aria-label="Tutup">×</button></div>
            <form id="editSemesterForm" method="POST" class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">@csrf @method('PUT')
                <label class="flex flex-col gap-2 sm:col-span-2"><span class="text-sm font-semibold">Nama Semester</span><input id="editSemesterNama" name="nama" maxlength="50" required class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tanggal Mulai</span><input id="editSemesterMulai" type="date" name="tanggal_mulai" required class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tanggal Selesai</span><input id="editSemesterSelesai" type="date" name="tanggal_selesai" required class="h-11 rounded-lg border border-[#D8C9BC] px-3.5 text-sm"></label>
                <div class="flex justify-end gap-2 border-t border-[#E5D8CC] pt-4 sm:col-span-2"><button type="button" onclick="tutupEditSemester()" class="rounded-lg border border-[#D8C9BC] px-4 py-2.5 text-sm font-semibold text-[#5C4033]">Batal</button><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white">Simpan Perubahan</button></div>
            </form>
        </section>
    </div>
    <script>function bukaEditSemester(button){const modal=document.getElementById('editSemesterModal');document.getElementById('editSemesterForm').action='{{ url('/admin/semester') }}/'+button.dataset.id;document.getElementById('editSemesterNama').value=button.dataset.nama;document.getElementById('editSemesterMulai').value=button.dataset.mulai;document.getElementById('editSemesterSelesai').value=button.dataset.selesai;modal.classList.remove('hidden');modal.classList.add('flex');document.body.classList.add('overflow-hidden')}function tutupEditSemester(){const modal=document.getElementById('editSemesterModal');modal.classList.add('hidden');modal.classList.remove('flex');document.body.classList.remove('overflow-hidden')}function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden')}function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden')}</script>
</body>
</html>

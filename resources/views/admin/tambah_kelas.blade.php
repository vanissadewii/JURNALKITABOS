<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        html, #kelasTableViewport { scrollbar-width: none; }
        html::-webkit-scrollbar, #kelasTableViewport::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')

    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium text-[#D7B899]">Pengaturan Data Kelas</p>
                    <h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">{{ isset($editKelas) && $editKelas ? 'Edit Kelas' : 'Tambah Kelas' }}</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button>
            </div>
        </header>

        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            <div>
                <h2 class="font-['Poppins'] text-xl font-bold">{{ isset($editKelas) && $editKelas ? 'Edit Data Kelas' : 'Kelola Data Kelas' }}</h2>
            </div>

            @if (session('success'))
                <div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>
            @endif
            @if (session('warning'))
                <div class="rounded-xl border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">{{ session('warning') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">
                    <p class="font-semibold">Periksa kembali data kelas:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                    <h3 class="font-['Poppins'] text-base font-bold">{{ isset($editKelas) && $editKelas ? 'Edit Kelas' : 'Informasi Kelas' }}</h3>
                    <p class="mt-1 text-xs leading-5 text-[#7A6A60]">Pilih tingkat, isi jurusan, dan tentukan nomor rombel.</p>
                </div>
                <form action="{{ isset($editKelas) && $editKelas ? route('admin.kelas.update', $editKelas->id_kelas) : route('admin.kelas.store') }}" method="POST" class="p-5 sm:p-6">
                    @csrf
                    @if (isset($editKelas) && $editKelas) @method('PUT') @endif
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">Tingkat Kelas</span>
                            <select id="tingkat" name="tingkat" required class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                                <option value="">Pilih tingkat</option>
                                <option value="10" @selected(old('tingkat', $editKelas->tingkat ?? '') == 10)>X</option>
                                <option value="11" @selected(old('tingkat', $editKelas->tingkat ?? '') == 11)>XI</option>
                                <option value="12" @selected(old('tingkat', $editKelas->tingkat ?? '') == 12)>XII</option>
                            </select>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">Jurusan</span>
                            <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan', $editKelas->jurusan ?? '') }}" maxlength="50" placeholder="Contoh: RPL" required class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">Rombel</span>
                            <input type="number" id="rombel" name="rombel" value="{{ old('rombel', $editKelas->rombel ?? '') }}" min="1" placeholder="Contoh: 2" required class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                    </div>
                    <div class="mt-6 flex justify-end border-t border-[#E5D8CC] pt-4">
                        <button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">{{ isset($editKelas) && $editKelas ? 'Simpan Perubahan' : 'Simpan Kelas' }}</button>
                    </div>
                </form>
            </article>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold">Hasil Input Kelas</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">Daftar kelas yang sudah tersimpan di sistem.</p>
                    </div>
                    <span class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">{{ $kelases->count() }} Kelas</span>
                </div>
                <div class="border-b border-[#E5D8CC] p-4 sm:p-5">
                    <label class="block w-full sm:max-w-sm">
                        <span class="sr-only">Cari kelas</span>
                        <input id="cariKelas" type="search" oninput="filterKelas()" placeholder="Cari tingkat, jurusan, atau rombel..." class="h-10 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]">
                    </label>
                </div>
                <div id="kelasTableViewport" class="overflow-x-auto">
                    <table class="w-full min-w-[620px] border-collapse text-left text-sm">
                        <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]">
                            <tr><th class="border-b border-r border-[#E5D8CC] px-4 py-3">No</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Tingkat</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Jurusan</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Rombel</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Nama Kelas</th><th class="border-b border-[#E5D8CC] px-4 py-3 text-center">Aksi</th></tr>
                        </thead>
                        <tbody>
                            @forelse ($kelases as $i => $kelas)
                                @php($namaTingkat = ['10' => 'X', '11' => 'XI', '12' => 'XII'][$kelas->tingkat] ?? $kelas->tingkat)
                                <tr class="kelas-row hover:bg-[#FFFCF9]" data-cari="{{ strtolower('tingkat '.$namaTingkat.' jurusan '.$kelas->jurusan.' rombel '.$kelas->rombel.' nama kelas '.$kelas->nama_kelas) }}">
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[#7A6A60]">{{ $i + 1 }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $namaTingkat }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-medium">{{ $kelas->jurusan }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $kelas->rombel }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-semibold">{{ $kelas->nama_kelas }}</td>
                                    <td class="border-b border-[#E5D8CC] px-4 py-3 text-center">
                                        <div class="flex flex-wrap justify-center gap-2">
                                            <button type="button" onclick="openEditKelas(this)" data-id="{{ $kelas->id_kelas }}" data-tingkat="{{ $kelas->tingkat }}" data-jurusan="{{ $kelas->jurusan }}" data-rombel="{{ $kelas->rombel }}" data-nama="{{ $kelas->nama_kelas }}" class="rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Edit</button>
                                            <form method="POST" action="{{ route('admin.kelas.destroy', $kelas->id_kelas) }}" onsubmit="return confirm('Hapus kelas {{ $kelas->nama_kelas }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg border border-[#F0B8B8] px-3 py-1.5 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada kelas. Tambahkan melalui form di atas.</td></tr>
                            @endforelse
                            <tr id="kelasTidakDitemukan" class="hidden"><td colspan="6" class="px-4 py-8 text-center text-sm text-[#7A6A60]">Kelas tidak ditemukan.</td></tr>
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </main>

    <div id="editKelasModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4" onclick="if(event.target===this)closeEditKelas()">
        <section role="dialog" aria-modal="true" aria-labelledby="editKelasTitle" class="w-full max-w-xl overflow-hidden rounded-xl border border-[#E5D8CC] bg-white shadow-xl">
            <div class="flex items-start justify-between border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                <div><h2 id="editKelasTitle" class="font-['Poppins'] text-base font-bold">Edit Data Kelas</h2><p id="editNamaKelas" class="mt-1 text-xs text-[#7A6A60]"></p></div>
                <button type="button" onclick="closeEditKelas()" class="rounded-lg px-2 py-1 text-lg text-[#7A6A60] hover:bg-[#F5EFE8]" aria-label="Tutup">&times;</button>
            </div>
            <form id="editKelasForm" method="POST" class="p-5 sm:p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Tingkat Kelas</span><select id="editTingkat" name="tingkat" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3 text-sm outline-none focus:border-[#5C4033]"><option value="10">X</option><option value="11">XI</option><option value="12">XII</option></select></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Jurusan</span><input id="editJurusan" name="jurusan" maxlength="50" required class="h-11 rounded-lg border border-[#D8C9BC] px-3 text-sm outline-none focus:border-[#5C4033]"></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Rombel</span><input id="editRombel" type="number" name="rombel" min="1" required class="h-11 rounded-lg border border-[#D8C9BC] px-3 text-sm outline-none focus:border-[#5C4033]"></label>
                </div>
                <div class="mt-6 flex justify-end gap-2 border-t border-[#E5D8CC] pt-4"><button type="button" onclick="closeEditKelas()" class="rounded-lg border border-[#D8C9BC] px-4 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Batal</button><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Perubahan</button></div>
            </form>
        </section>
    </div>

    <script>
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden');}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden');}
        function openEditKelas(button){
            const modal=document.getElementById('editKelasModal');
            document.getElementById('editKelasForm').action='{{ url('/admin/kelas') }}/'+button.dataset.id;
            document.getElementById('editTingkat').value=button.dataset.tingkat;
            document.getElementById('editJurusan').value=button.dataset.jurusan;
            document.getElementById('editRombel').value=button.dataset.rombel;
            document.getElementById('editNamaKelas').textContent=button.dataset.nama;
            modal.classList.remove('hidden');modal.classList.add('flex');document.getElementById('editTingkat').focus();
        }
        function closeEditKelas(){const modal=document.getElementById('editKelasModal');modal.classList.add('hidden');modal.classList.remove('flex');}
        document.addEventListener('keydown',event=>{if(event.key==='Escape')closeEditKelas();});
        function filterKelas(){
            const query=document.getElementById('cariKelas').value.trim().toLowerCase();
            const rows=Array.from(document.querySelectorAll('.kelas-row'));
            let visible=0;
            rows.forEach(row=>{const match=window.matchesAllSearchTerms(query,row.dataset.cari,row.textContent,'tingkat '+row.cells[1]?.textContent,'jurusan '+row.cells[2]?.textContent,'rombel '+row.cells[3]?.textContent);row.classList.toggle('hidden',!match);if(match)visible++;});
            document.getElementById('kelasTidakDitemukan').classList.toggle('hidden',rows.length===0||visible>0);
        }
    </script>
    @include('shared.preserve_search_scroll')
</body>
</html>

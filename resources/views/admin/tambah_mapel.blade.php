<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Pelajaran - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        html, #mapelTableViewport { scrollbar-width: none; }
        html::-webkit-scrollbar, #mapelTableViewport::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')

    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium text-[#D7B899]">Pengaturan Mata Pelajaran</p>
                    <h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Mata Pelajaran</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka menu">☰</button>
            </div>
        </header>

        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            <div>
                <h2 class="font-['Poppins'] text-xl font-bold">Kelola Mata Pelajaran</h2>
            </div>

            @if (session('success'))
                <div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>
            @endif
            @if (session('warning'))
                <div class="rounded-xl border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">{{ session('warning') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">
                    <p class="font-semibold">Periksa kembali data yang dimasukkan:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-2">
                <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                    <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                        <h3 class="font-['Poppins'] text-base font-bold">Tambah Mapel</h3>
                        <p class="mt-1 text-xs leading-5 text-[#7A6A60]">Isi nama mata pelajaran dan kode jika tersedia.</p>
                    </div>
                    <form method="POST" action="{{ route('mapel.store') }}" class="flex flex-col gap-4 p-5 sm:p-6">
                        @csrf
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">Nama Mata Pelajaran</span>
                            <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}" maxlength="100" required placeholder="Contoh: Matematika" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">Kode Mapel <span class="font-normal text-[#A08978]">(opsional)</span></span>
                            <input type="text" name="kode_mapel" value="{{ old('kode_mapel') }}" maxlength="20" placeholder="Contoh: MTK" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                        </label>
                        <div class="flex justify-end border-t border-[#E5D8CC] pt-4">
                            <button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Mapel</button>
                        </div>
                    </form>
                </article>

                <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                    <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                        <h3 class="font-['Poppins'] text-base font-bold">Upload File Mapel</h3>
                        <p class="mt-1 text-xs leading-5 text-[#7A6A60]">Unggah file .xlsx, .xls, atau .csv dengan kolom nama_mapel dan kode_mapel.</p>
                    </div>
                    <form method="POST" action="{{ route('mapel.import') }}" enctype="multipart/form-data" class="flex flex-col gap-4 p-5 sm:p-6">
                        @csrf
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-semibold">File Excel / CSV</span>
                            <input type="file" name="file_mapel" accept=".xlsx,.xls,.csv" required class="block w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] text-sm file:mr-4 file:border-0 file:bg-[#5C4033] file:px-4 file:py-2.5 file:font-semibold file:text-white">
                        </label>
                        <div class="rounded-lg bg-[#F5EFE8] px-3.5 py-3 text-xs leading-5 text-[#7A6A60]">
                            <p class="font-semibold text-[#5C4033]">Format kolom file:</p>
                            <p>Baris pertama: <code class="font-semibold">nama_mapel,kode_mapel</code></p>
                            <p>Kode boleh dikosongkan. Baris nama atau kode yang duplikat akan dilewati.</p>
                        </div>
                        <div class="flex justify-end border-t border-[#E5D8CC] pt-4">
                            <button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Upload Mapel</button>
                        </div>
                    </form>
                </article>
            </div>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold">Hasil Input Mata Pelajaran</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">Daftar mapel yang sudah tersimpan.</p>
                    </div>
                    <span class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">{{ $mapels->count() }} Mapel</span>
                </div>
                <div class="border-b border-[#E5D8CC] p-4 sm:p-5">
                    <label class="relative block w-full sm:max-w-sm">
                        <span class="sr-only">Cari mata pelajaran</span>
                        <input id="cariMapel" type="search" oninput="filterMapel()" placeholder="Cari nama atau kode mapel..." class="h-10 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]">
                    </label>
                </div>
                <div id="mapelTableViewport" class="overflow-x-auto">
                    <table class="w-full min-w-[560px] border-collapse text-left text-sm">
                        <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]"><tr><th class="border-b border-r border-[#E5D8CC] px-4 py-3">No</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Nama Mata Pelajaran</th><th class="border-b border-r border-[#E5D8CC] px-4 py-3">Kode</th><th class="border-b border-[#E5D8CC] px-4 py-3">Aksi</th></tr></thead>
                        <tbody id="mapelTableBody">
                            @forelse ($mapels as $i => $mapel)
                                <tr class="mapel-row hover:bg-[#FFFCF9]" data-cari="{{ strtolower('mata pelajaran '.$mapel->nama_mapel.' kode '.($mapel->kode_mapel ?? '')) }}">
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[#7A6A60]">{{ $i + 1 }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-medium">{{ $mapel->nama_mapel }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $mapel->kode_mapel ?: '-' }}</td>
                                    <td class="border-b border-[#E5D8CC] px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <button type="button" onclick="openEditMapel(this)" data-id="{{ $mapel->id_mapel }}" data-nama="{{ $mapel->nama_mapel }}" data-kode="{{ $mapel->kode_mapel }}" class="rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Edit</button>
                                            <form method="POST" action="{{ route('mapel.destroy', $mapel->id_mapel) }}" onsubmit="return confirm('Hapus mata pelajaran {{ $mapel->nama_mapel }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg border border-[#F0B8B8] px-3 py-1.5 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada mata pelajaran. Tambahkan melalui form atau upload file.</td></tr>
                            @endforelse
                            <tr id="mapelTidakDitemukan" class="hidden"><td colspan="4" class="px-4 py-8 text-center text-sm text-[#7A6A60]">Mata pelajaran tidak ditemukan.</td></tr>
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </main>
    <div id="editMapelModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/45 p-4" onclick="if(event.target===this)closeEditMapel()">
        <section role="dialog" aria-modal="true" aria-labelledby="editMapelTitle" class="w-full max-w-xl overflow-hidden rounded-xl border border-[#E5D8CC] bg-white shadow-xl">
            <div class="flex items-start justify-between border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                <div><h2 id="editMapelTitle" class="font-['Poppins'] text-base font-bold">Edit Mata Pelajaran</h2><p class="mt-1 text-xs text-[#7A6A60]">Perbarui nama atau kode mata pelajaran.</p></div>
                <button type="button" onclick="closeEditMapel()" class="rounded-lg px-2 py-1 text-lg text-[#7A6A60] hover:bg-[#F5EFE8]" aria-label="Tutup">&times;</button>
            </div>
            <form id="editMapelForm" method="POST" class="flex flex-col gap-4 p-5 sm:p-6">
                @csrf
                @method('PUT')
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Nama Mata Pelajaran</span><input id="editNamaMapel" type="text" name="nama_mapel" maxlength="100" required class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label>
                <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Kode Mapel <span class="font-normal text-[#A08978]">(opsional)</span></span><input id="editKodeMapel" type="text" name="kode_mapel" maxlength="20" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10"></label>
                <div class="mt-2 flex justify-end gap-2 border-t border-[#E5D8CC] pt-4"><button type="button" onclick="closeEditMapel()" class="rounded-lg border border-[#D8C9BC] px-4 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Batal</button><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Perubahan</button></div>
            </form>
        </section>
    </div>
    <script>
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden');}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden');}
        function openEditMapel(button){
            const modal=document.getElementById('editMapelModal');
            document.getElementById('editMapelForm').action='{{ url('/admin/mapel') }}/'+button.dataset.id;
            document.getElementById('editNamaMapel').value=button.dataset.nama;
            document.getElementById('editKodeMapel').value=button.dataset.kode||'';
            modal.classList.remove('hidden');modal.classList.add('flex');document.getElementById('editNamaMapel').focus();
        }
        function closeEditMapel(){const modal=document.getElementById('editMapelModal');modal.classList.add('hidden');modal.classList.remove('flex');}
        document.addEventListener('keydown',event=>{if(event.key==='Escape')closeEditMapel();});
        function filterMapel(){
            const query=document.getElementById('cariMapel').value.trim().toLowerCase();
            const rows=Array.from(document.querySelectorAll('.mapel-row'));
            let visible=0;
            rows.forEach(row=>{const match=window.matchesAllSearchTerms(query,row.dataset.cari,row.textContent);row.classList.toggle('hidden',!match);if(match)visible++;});
            document.getElementById('mapelTidakDitemukan').classList.toggle('hidden',rows.length===0||visible>0);
        }
    </script>
    @include('shared.preserve_search_scroll')
</body>
</html>

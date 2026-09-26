<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')

    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium text-[#D7B899]">Pengaturan Data Siswa</p>
                    <h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Data Siswa</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button>
            </div>
        </header>

        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">
            <div>
                <h2 class="font-['Poppins'] text-xl font-bold">Daftar Siswa</h2>
            </div>

            @if (session('success'))
                <div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-xl border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3 text-sm text-[#C62828]">
                    <p class="font-semibold">Periksa kembali data yang dimasukkan:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold">Impor Siswa dari File</h3>
                        <p class="mt-1 text-xs leading-5 text-[#7A6A60]">Gunakan file Excel atau CSV dengan kolom: <span class="font-semibold">nama, tingkat, jurusan, rombel</span>. Kolom <span class="font-semibold">no_absen</span> opsional; nomor akan dibuat otomatis bila kosong.</p>
                    </div>
                    <span class="w-fit shrink-0 rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">XLSX · XLS · CSV</span>
                </div>
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3 p-5 sm:flex-row sm:items-end sm:p-6">
                    @csrf
                    <label class="flex min-w-0 flex-1 flex-col gap-2">
                        <span class="text-sm font-semibold">Pilih file siswa</span>
                        <input id="fileExcel" type="file" name="file_excel" accept=".xlsx,.xls,.csv" required class="w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] text-sm file:mr-4 file:border-0 file:bg-[#F5EFE8] file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-[#5C4033] hover:file:bg-[#EDE2D8]">
                    </label>
                    <button type="submit" class="h-11 shrink-0 rounded-lg bg-[#5C4033] px-5 text-sm font-semibold text-white hover:bg-[#452F26]">Impor Data</button>
                </form>
            </article>

            <details class="group overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-3 px-5 py-4 sm:px-6">
                    <span><span class="block font-['Poppins'] text-sm font-bold">Tambah siswa secara manual</span><span class="mt-1 block text-xs text-[#7A6A60]">Nomor absen akan diisi otomatis bila dikosongkan.</span></span>
                    <span class="rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] group-open:hidden">Buka form</span>
                    <span class="hidden rounded-lg border border-[#D8C9BC] px-3 py-1.5 text-xs font-semibold text-[#5C4033] group-open:inline">Tutup</span>
                </summary>
                <form action="{{ route('admin.siswa.store') }}" method="POST" id="formTambahSiswa" class="grid grid-cols-1 gap-4 border-t border-[#E5D8CC] bg-[#FFFCF9] p-5 sm:grid-cols-2 lg:grid-cols-3 sm:p-6">
                    @csrf
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Nama siswa</span><input type="text" name="nama" value="{{ old('nama') }}" maxlength="100" required placeholder="Nama lengkap" class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]"></label>
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Nomor absen <span class="font-normal text-[#7A6A60]">(opsional)</span></span><input type="number" name="no_absen" value="{{ old('no_absen') }}" min="1" placeholder="Otomatis" class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]"></label>
                    @php($kelasTerpilih = $kelases->firstWhere('id_kelas', old('id_kelas')))
                    <label class="flex flex-col gap-2"><span class="text-sm font-semibold">Kelas</span><input type="search" id="cariKelasSiswa" list="daftarKelasSiswa" value="{{ old('nama_kelas', $kelasTerpilih?->nama_kelas) }}" required autocomplete="off" placeholder="Ketik untuk mencari kelas..." class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]"><datalist id="daftarKelasSiswa">@foreach ($kelases as $kelas)<option value="{{ $kelas->nama_kelas }}" data-id="{{ $kelas->id_kelas }}"></option>@endforeach</datalist><input type="hidden" name="id_kelas" id="idKelasSiswa" value="{{ old('id_kelas') }}"></label>
                    <div class="sm:col-span-2 lg:col-span-3 flex justify-end"><button type="submit" class="rounded-lg border border-[#5C4033] px-5 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Simpan Siswa</button></div>
                </form>
            </details>

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="flex flex-col justify-between gap-3 border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
                    <div>
                        <h3 class="font-['Poppins'] text-base font-bold">Data Siswa</h3>
                        <p class="mt-1 text-xs text-[#7A6A60]">{{ number_format($siswas->total()) }} siswa ditemukan</p>
                    </div>
                    <a href="{{ route('admin.kelas.index') }}" class="w-fit rounded-lg border border-[#D8C9BC] px-3.5 py-2 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Kelola kelas</a>
                </div>

                <form method="GET" action="{{ route('admin.siswa.index') }}" class="grid grid-cols-1 gap-3 border-b border-[#E5D8CC] p-4 sm:grid-cols-2 sm:p-5 lg:grid-cols-[minmax(220px,1fr)_170px_150px_auto_auto]">
                    <label class="relative block">
                        <span class="sr-only">Cari siswa</span>
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama atau nomor absen..." class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 pr-10 text-sm outline-none focus:border-[#5C4033]">
                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-[#A08978]">⌕</span>
                    </label>
                    <label>
                        <span class="sr-only">Pilih tingkat</span>
                        <select name="tingkat" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]">
                            <option value="">Semua tingkat</option>
                            <option value="10" @selected(request('tingkat') == '10')>Kelas X</option>
                            <option value="11" @selected(request('tingkat') == '11')>Kelas XI</option>
                            <option value="12" @selected(request('tingkat') == '12')>Kelas XII</option>
                        </select>
                    </label>
                    <label>
                        <span class="sr-only">Pilih rombel</span>
                        <select name="rombel" class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]">
                            <option value="">Semua rombel</option>
                            @foreach ([1, 2, 3, 4] as $rombel)
                                <option value="{{ $rombel }}" @selected(request('rombel') == (string) $rombel)>Rombel {{ $rombel }}</option>
                            @endforeach
                        </select>
                    </label>
                    <button type="submit" class="h-11 rounded-lg bg-[#5C4033] px-5 text-sm font-semibold text-white hover:bg-[#452F26]">Cari</button>
                    @if (request()->hasAny(['q', 'tingkat', 'rombel']))
                        <a href="{{ route('admin.siswa.index') }}" class="flex h-11 items-center justify-center rounded-lg border border-[#D8C9BC] px-4 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Reset</a>
                    @endif
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px] border-collapse text-left text-sm">
                        <thead class="bg-[#F5EFE8] text-[11px] uppercase tracking-wider text-[#7A6A60]">
                            <tr>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3">No. Absen</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3">Nama Siswa</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3">Nama Kelas</th>
                                <th class="border-b border-[#E5D8CC] px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                                <tr class="hover:bg-[#FFFCF9]">
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-semibold">{{ $siswa->no_absen ?? '—' }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-medium">{{ $siswa->nama }}</td>
                                    <td class="border-b border-r border-[#E5D8CC] px-4 py-3"><span class="rounded-full bg-[#F5EFE8] px-2.5 py-1 text-xs font-semibold text-[#5C4033]">{{ $siswa->kelas?->nama_kelas ?? 'Kelas belum tersedia' }}</span></td>
                                    <td class="border-b border-[#E5D8CC] px-4 py-3 text-center"><form method="POST" action="{{ route('admin.siswa.destroy', $siswa->id_siswa) }}" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">@csrf @method('DELETE')<button type="submit" class="rounded-lg border border-[#F0B8B8] px-3 py-1.5 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button></form></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-12 text-center"><p class="font-semibold">Belum ada siswa yang cocok.</p><p class="mt-1 text-xs text-[#7A6A60]">Coba ubah filter kelas atau kata pencarian.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($siswas->hasPages())
                    <div class="border-t border-[#E5D8CC] px-4 py-4 sm:px-6">{{ $siswas->links() }}</div>
                @endif
            </article>
        </section>
    </main>

    <script>
        const cariKelasSiswa = document.getElementById('cariKelasSiswa');
        const idKelasSiswa = document.getElementById('idKelasSiswa');
        const opsiKelasSiswa = [...document.querySelectorAll('#daftarKelasSiswa option')];
        function sinkronkanKelasSiswa() {
            const opsi = opsiKelasSiswa.find(item => item.value.trim().toLocaleLowerCase() === cariKelasSiswa.value.trim().toLocaleLowerCase());
            idKelasSiswa.value = opsi?.dataset.id ?? '';
            cariKelasSiswa.setCustomValidity(opsi || !cariKelasSiswa.value ? '' : 'Pilih kelas dari daftar yang tersedia.');
        }
        cariKelasSiswa.addEventListener('input', sinkronkanKelasSiswa);
        document.querySelector('#formTambahSiswa')?.addEventListener('submit', sinkronkanKelasSiswa);
        sinkronkanKelasSiswa();
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden');}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden');}
    </script>
    @include('shared.preserve_search_scroll')
</body>
</html>

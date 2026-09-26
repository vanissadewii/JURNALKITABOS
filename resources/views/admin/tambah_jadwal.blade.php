<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Jadwal Pelajaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>
        html, #sidebar nav, #daftarJadwal { scrollbar-width: none; }
        html::-webkit-scrollbar, #sidebar nav::-webkit-scrollbar, #daftarJadwal::-webkit-scrollbar { display: none; }
    </style>
</head>


<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">


    {{-- OVERLAY SIDEBAR MOBILE --}}
    <div
        id="sidebarOverlay"
        class="fixed inset-0 z-40 hidden bg-black/40 md:hidden"
        onclick="closeSidebar()"
    ></div>


    {{-- SIDEBAR --}}
    @include('admin.partials.tambah_sidebar')


    {{-- MAIN --}}
    <main class="min-h-screen md:ml-[280px]">


        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-[#D7B899]">
                        Menu Tambah
                    </p>

                    <h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">
                        Jadwal Pelajaran
                    </h1>

                </div>


                {{-- TOMBOL MOBILE --}}
                <button
                    type="button"
                    onclick="openSidebar()"
                    class="flex h-10 w-10 items-center justify-center rounded-lg text-2xl text-white hover:bg-white/10 md:hidden"
                    aria-label="Buka menu"
                >
                    ☰
                </button>

            </div>

        </header>



        {{-- =====================================================
            CONTENT
        ====================================================== --}}
        <section class="flex flex-col gap-5 p-4 sm:p-6 md:p-7">


            {{-- JUDUL --}}
            <div>
                <h2 class="mt-1 font-['Poppins'] text-xl font-bold text-[#3E3028]">
                    Kelola Jadwal Pelajaran
                </h2>
            </div>



            {{-- =====================================================
                PESAN SUCCESS
            ====================================================== --}}
            @if (session('success'))

                <div class="rounded-lg border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">

                    {{ session('success') }}

                </div>

            @endif



            {{-- =====================================================
                PESAN WARNING
            ====================================================== --}}
            @if (session('warning'))

                <div class="rounded-lg border border-[#F3D6A0] bg-[#FFF8E7] px-4 py-3 text-sm text-[#A16207]">

                    {{ session('warning') }}

                </div>

            @endif



            {{-- =====================================================
                ERROR VALIDASI
            ====================================================== --}}
            @if ($errors->any())

                <div class="rounded-lg border border-[#F0B8B8] bg-[#FFEBEE] px-4 py-3">

                    <p class="text-sm font-semibold text-[#C62828]">
                        Ada data yang perlu diperbaiki:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-[#C62828]">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- =====================================================
                IMPORT EXCEL
            ====================================================== --}}
            <div class="rounded-lg border border-[#E5D8CC] bg-white p-5 sm:p-6">

                <div class="mb-5 border-b border-[#E5D8CC] pb-4">

                    <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">
                        Import Jadwal
                    </h3>

                    <p class="mt-1 text-xs text-[#7A6A60]">
                        Masukkan jadwal dari file Excel atau CSV.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('jadwal.import') }}"
                    enctype="multipart/form-data"
                    class="flex flex-col gap-4"
                >

                    @csrf


                    <div>

                        <label
                            for="file_excel"
                            class="mb-2 block text-sm font-semibold text-[#3E3028]"
                        >
                            File Jadwal
                        </label>

                        <input
                            type="file"
                            name="file_excel"
                            id="file_excel"
                            accept=".xlsx,.xls,.csv"
                            required
                            class="block w-full rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] text-sm text-[#3E3028]
                                   file:mr-4 file:border-0 file:bg-[#5C4033] file:px-4 file:py-2.5
                                   file:text-sm file:font-semibold file:text-white
                                   hover:file:bg-[#452F26]"
                        >

                        <p class="mt-2 text-xs text-[#A08978]">
                            Format yang didukung: .xlsx, .xls, dan .csv
                        </p>

                    </div>


                    <div class="flex justify-end border-t border-[#E5D8CC] pt-4">

                        <button
                            type="submit"
                            class="rounded-lg bg-[#5C4033] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#452F26]"
                        >
                            Import Excel
                        </button>

                    </div>

                </form>

            </div>



            {{-- FORM TAMBAH JADWAL --}}
            @php
                $kelasLama = ($kelas ?? collect())->firstWhere('id_kelas', old('id_kelas'));
                $guruLama = ($guru ?? collect())->firstWhere('id', old('id_guru'));
                $mapelLama = ($mapel ?? collect())->firstWhere('id_mapel', old('id_mapel'));
            @endphp
            <details class="group overflow-hidden rounded-lg border border-[#E5D8CC] bg-white" @if($errors->any() && old('id_kelas')) open @endif>
                <summary class="flex cursor-pointer list-none items-center justify-between gap-3 bg-[#FFFCF9] px-5 py-4 sm:px-6">
                    <span><span class="block font-['Poppins'] text-base font-bold text-[#3E3028]">Tambah Jadwal Pelajaran</span><span class="mt-1 block text-xs text-[#7A6A60]">Pilih kelas, guru, mapel, hari, dan rentang jam mengajar.</span></span>
                    <span class="rounded-lg bg-[#5C4033] px-3.5 py-2 text-xs font-semibold text-white group-open:hidden">Buka form</span>
                    <span class="hidden rounded-lg border border-[#D8C9BC] px-3.5 py-2 text-xs font-semibold text-[#5C4033] group-open:inline">Tutup</span>
                </summary>
                <div class="border-t border-[#E5D8CC] p-5 sm:p-6">
                    <form method="POST" action="{{ route('jadwal.store') }}" class="flex flex-col gap-5" id="formTambahJadwal">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-semibold text-[#3E3028]">Kelas</span>
                                <input type="search" id="cariKelasJadwal" list="daftarKelasJadwal" value="{{ $kelasLama?->nama_kelas }}" autocomplete="off" required placeholder="Ketik nama kelas..." class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]">
                                <datalist id="daftarKelasJadwal">@foreach($kelas ?? [] as $k)<option value="{{ $k->nama_kelas }}" data-id="{{ $k->id_kelas }}" data-tingkat="{{ $k->tingkat }}" data-jurusan="{{ strtoupper($k->jurusan) }}" data-rombel="{{ $k->rombel }}"></option>@endforeach</datalist>
                                <input type="hidden" name="id_kelas" id="id_kelas" value="{{ old('id_kelas') }}">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-semibold text-[#3E3028]">Hari</span>
                                <select name="hari" id="hari" required class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]">
                                    <option value="">-- Pilih Hari --</option>
                                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $namaHari)<option value="{{ $namaHari }}" @selected(old('hari')===$namaHari)>{{ $namaHari }}</option>@endforeach
                                    <option value="Sabtu" data-weekend disabled hidden @selected(old('hari')==='Sabtu')>Sabtu · uji XI RPL 2</option>
                                    <option value="Minggu" data-weekend disabled hidden @selected(old('hari')==='Minggu')>Minggu · uji XI RPL 2</option>
                                </select>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-semibold text-[#3E3028]">Jam mulai</span>
                                <select name="jam_dari" id="jam_dari" data-old="{{ old('jam_dari') }}" required disabled class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none disabled:opacity-60"><option value="">Pilih kelas dan hari dahulu</option></select>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-semibold text-[#3E3028]">Jam berakhir</span>
                                <select name="jam_sampai" id="jam_sampai" data-old="{{ old('jam_sampai') }}" required disabled class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none disabled:opacity-60"><option value="">Pilih kelas dan hari dahulu</option></select>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-semibold text-[#3E3028]">Guru</span>
                                <input type="search" id="cariGuruJadwal" list="daftarGuruJadwal" value="{{ $guruLama?->name }}" autocomplete="off" required placeholder="Ketik nama guru..." class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]">
                                <datalist id="daftarGuruJadwal">@foreach($guru ?? [] as $g)<option value="{{ $g->name }}" data-id="{{ $g->id }}"></option>@endforeach</datalist>
                                <input type="hidden" name="id_guru" id="id_guru" value="{{ old('id_guru') }}">
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-semibold text-[#3E3028]">Mata Pelajaran</span>
                                <input type="search" id="cariMapelJadwal" list="daftarMapelJadwal" value="{{ $mapelLama?->nama_mapel }}" autocomplete="off" required placeholder="Ketik nama mata pelajaran..." class="h-11 rounded-lg border border-[#D8C9BC] bg-[#FFFCF9] px-3.5 text-sm outline-none focus:border-[#5C4033]">
                                <datalist id="daftarMapelJadwal">@foreach($mapel ?? [] as $m)<option value="{{ $m->nama_mapel }}" data-id="{{ $m->id_mapel }}"></option>@endforeach</datalist>
                                <input type="hidden" name="id_mapel" id="id_mapel" value="{{ old('id_mapel') }}">
                            </label>
                        </div>
                        <div class="flex justify-end border-t border-[#E5D8CC] pt-4"><button type="submit" class="rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#452F26]">Simpan Jadwal</button></div>
                    </form>
                </div>
            </details>


            {{-- DAFTAR JADWAL PELAJARAN --}}
            <div class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-5 py-4 sm:px-6">
                    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                        <div>
                            <h3 class="font-['Poppins'] text-base font-bold text-[#3E3028]">Daftar Jadwal Pelajaran</h3>
                            <p class="mt-1 text-xs leading-5 text-[#7A6A60]">Cari jadwal atau pilih tingkat kelas untuk memfilter daftar.</p>
                        </div>
                        <span id="jadwalCount" class="w-fit rounded-md bg-[#F5EFE8] px-2.5 py-1 text-[11px] font-bold text-[#5C4033]">{{ count($jadwalGrup ?? []) }} Jadwal</span>
                    </div>

                    <div class="mt-4 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                        <label class="relative block w-full lg:max-w-sm">
                            <span class="sr-only">Cari jadwal</span>
                            <input id="cariJadwal" type="search" oninput="filterJadwal()" placeholder="Cari kelas, guru, mapel, atau hari..." class="h-11 w-full rounded-lg border border-[#D8C9BC] bg-white px-3.5 pr-10 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                            <svg class="absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#A08978]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6"/><path d="m16 16 4 4"/></svg>
                        </label>
                        <div class="flex flex-wrap gap-2" role="group" aria-label="Filter tingkat kelas">
                            <button type="button" data-filter-tingkat="semua" onclick="setFilterTingkat('semua', this)" class="filter-tingkat rounded-lg bg-[#5C4033] px-4 py-2.5 text-sm font-semibold text-white">Semua</button>
                            <button type="button" data-filter-tingkat="X" onclick="setFilterTingkat('X', this)" class="filter-tingkat rounded-lg border border-[#E5D8CC] px-4 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">X</button>
                            <button type="button" data-filter-tingkat="XI" onclick="setFilterTingkat('XI', this)" class="filter-tingkat rounded-lg border border-[#E5D8CC] px-4 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">XI</button>
                            <button type="button" data-filter-tingkat="XII" onclick="setFilterTingkat('XII', this)" class="filter-tingkat rounded-lg border border-[#E5D8CC] px-4 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">XII</button>
                        </div>
                    </div>
                </div>

                <div id="daftarJadwal" class="overflow-x-auto">
                    <table class="w-full min-w-[980px] border-collapse text-left text-sm">
                        <thead class="bg-[#F5EFE8]">
                            <tr>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">No</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Hari</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Kelas</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Jam Ke-</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Waktu</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Guru</th>
                                <th class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Mata Pelajaran</th>
                                <th class="border-b border-[#E5D8CC] px-4 py-3 text-[11px] font-bold uppercase tracking-wider text-[#7A6A60]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                            @forelse (($jadwalGrup ?? collect())->groupBy('id_kelas') as $idKelas => $jadwalKelas)
                                @php($jadwalPertama = $jadwalKelas->first())
                                <tr class="jadwal-class-group" data-kelas-group="{{ $idKelas }}" data-tingkat="{{ explode(' ', trim($jadwalPertama->kelas))[0] }}">
                                    <td colspan="8" class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-4 py-2.5">
                                        <button type="button" aria-expanded="false" onclick="toggleJadwalKelas('{{ $idKelas }}', this)" class="flex w-full items-center justify-between gap-3 rounded-lg px-2 py-2 text-left hover:bg-[#F5EFE8]">
                                            <span><span class="font-['Poppins'] text-sm font-bold text-[#3E3028]">{{ $jadwalPertama->kelas }}</span><span class="ml-2 text-xs text-[#7A6A60]">{{ $jadwalKelas->count() }} jadwal · termasuk akhir pekan untuk XI RPL 2</span></span>
                                            <span class="flex items-center gap-2 text-xs font-semibold text-[#5C4033]"><span data-label-buka> Buka jadwal</span><svg class="h-4 w-4 transition-transform" data-panah-kelas viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 7.5 5 5 5-5"/></svg></span>
                                        </button>
                                    </td>
                                </tr>
                                @foreach ($jadwalKelas as $i => $j)
                                    <tr class="jadwal-row hidden transition hover:bg-[#FFFCF9]" data-grup-kelas="{{ $idKelas }}" data-tingkat="{{ explode(' ', trim($j->kelas))[0] }}" data-cari="{{ strtolower('kelas '.$j->kelas.' hari '.$j->hari.' jam '.$j->jam_ke_mulai.' '.$j->jam_ke_sampai.' guru '.$j->guru.' mata pelajaran '.$j->mapel) }}">
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 text-[#7A6A60]">{{ $i + 1 }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $j->hari }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 font-semibold text-[#3E3028]">{{ $j->kelas }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 whitespace-nowrap">Jam {{ $j->jam_ke_mulai }}@if ($j->jam_ke_sampai !== $j->jam_ke_mulai)–{{ $j->jam_ke_sampai }}@endif</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3 whitespace-nowrap">{{ $j->jam_mulai }}–{{ $j->jam_selesai }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $j->guru }}</td>
                                        <td class="border-b border-r border-[#E5D8CC] px-4 py-3">{{ $j->mapel }}</td>
                                        <td class="border-b border-[#E5D8CC] px-4 py-3">
                                            <form method="POST" action="{{ route('jadwal.destroy-group') }}" onsubmit="return confirm('Hapus jadwal {{ $j->kelas }} hari {{ $j->hari }} untuk jam yang ditampilkan?')">
                                                @csrf
                                                @method('DELETE')
                                                @foreach ($j->jadwal_ids as $jadwalId)
                                                    <input type="hidden" name="ids[]" value="{{ $jadwalId }}">
                                                @endforeach
                                                <button type="submit" class="rounded-lg border border-[#F0B8B8] px-3 py-1.5 text-xs font-semibold text-[#C62828] hover:bg-[#FFEBEE]">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr><td colspan="8" class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada jadwal.</td></tr>
                            @endforelse
                            <tr id="jadwalTidakDitemukan" class="hidden"><td colspan="8" class="px-4 py-10 text-center"><p class="text-sm font-semibold text-[#3E3028]">Jadwal tidak ditemukan</p><p class="mt-1 text-xs text-[#7A6A60]">Coba kata pencarian atau tingkat kelas lain.</p></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

    </main>



    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}
    <script>

        /*
        |--------------------------------------------------------------------------
        | SIDEBAR MOBILE
        |--------------------------------------------------------------------------
        */

        function openSidebar() {

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar) {
                sidebar.classList.remove('-translate-x-full');
            }

            if (overlay) {
                overlay.classList.remove('hidden');
            }

        }


        function closeSidebar() {

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar) {
                sidebar.classList.add('-translate-x-full');
            }

            if (overlay) {
                overlay.classList.add('hidden');
            }

        }



        let filterTingkatAktif = 'semua';

        function setFilterTingkat(tingkat, button) {
            filterTingkatAktif = tingkat;
            document.querySelectorAll('.filter-tingkat').forEach((item) => {
                item.classList.remove('bg-[#5C4033]', 'text-white');
                item.classList.add('border', 'border-[#E5D8CC]', 'text-[#5C4033]');
            });
            button.classList.remove('border', 'border-[#E5D8CC]', 'text-[#5C4033]');
            button.classList.add('bg-[#5C4033]', 'text-white');
            filterJadwal();
        }

        function toggleJadwalKelas(id, button) {
            const buka = button.getAttribute('aria-expanded') !== 'true';
            button.setAttribute('aria-expanded', buka ? 'true' : 'false');
            button.querySelector('[data-label-buka]').textContent = buka ? 'Tutup jadwal' : 'Buka jadwal';
            button.querySelector('[data-panah-kelas]').classList.toggle('rotate-180', buka);
            document.querySelectorAll(`.jadwal-row[data-grup-kelas="${id}"]`).forEach(row => {
                const cocokFilter = !row.dataset.cocok || row.dataset.cocok === '1';
                row.classList.toggle('hidden', !buka || !cocokFilter);
            });
        }

        function filterJadwal() {
            const kata = document.getElementById('cariJadwal').value.trim().toLowerCase();
            const rows = Array.from(document.querySelectorAll('.jadwal-row'));
            const groups = Array.from(document.querySelectorAll('.jadwal-class-group'));
            const hitungPerGrup = new Map();
            let visible = 0;

            rows.forEach(row => {
                const matchTingkat = filterTingkatAktif === 'semua' || row.dataset.tingkat === filterTingkatAktif;
                const matchKata = window.matchesAllSearchTerms(kata, row.dataset.cari, row.textContent, 'tingkat ' + row.dataset.tingkat);
                const cocok = matchTingkat && matchKata;
                row.dataset.cocok = cocok ? '1' : '0';
                if (cocok) {
                    visible++;
                    hitungPerGrup.set(row.dataset.grupKelas, (hitungPerGrup.get(row.dataset.grupKelas) || 0) + 1);
                }
            });

            const sedangMencari = kata !== '' || filterTingkatAktif !== 'semua';
            groups.forEach(group => {
                const jumlahCocok = hitungPerGrup.get(group.dataset.kelasGroup) || 0;
                const button = group.querySelector('button');
                const buka = sedangMencari && jumlahCocok > 0;
                group.classList.toggle('hidden', jumlahCocok === 0);
                if (buka) {
                    button.setAttribute('aria-expanded', 'true');
                    button.querySelector('[data-label-buka]').textContent = 'Tutup jadwal';
                    button.querySelector('[data-panah-kelas]').classList.add('rotate-180');
                }
                rows.filter(row => row.dataset.grupKelas === group.dataset.kelasGroup).forEach(row => {
                    const grupTerbuka = button.getAttribute('aria-expanded') === 'true';
                    row.classList.toggle('hidden', !(row.dataset.cocok === '1' && grupTerbuka));
                });
            });

            document.getElementById('jadwalCount').textContent = `${visible} Jadwal`;
            document.getElementById('jadwalTidakDitemukan').classList.toggle('hidden', rows.length === 0 || visible > 0);
        }

        function bindSearchableId(inputId, listId, hiddenId, onSelect = null) {
            const input = document.getElementById(inputId);
            const hidden = document.getElementById(hiddenId);
            const options = [...document.querySelectorAll(`#${listId} option`)];
            const sync = () => {
                const match = options.find(option => option.value.trim().toLocaleLowerCase() === input.value.trim().toLocaleLowerCase());
                hidden.value = match?.dataset.id ?? '';
                input.setCustomValidity(input.value && !match ? 'Pilih pilihan dari daftar yang tersedia.' : '');
                if (match && onSelect) onSelect();
            };
            input.addEventListener('input', sync);
            input.addEventListener('change', sync);
            sync();
        }

        function aturHariWeekendJadwal() {
            const idKelas = document.getElementById('id_kelas').value;
            const optionKelas = [...document.querySelectorAll('#daftarKelasJadwal option')].find(option => option.dataset.id === idKelas);
            const bolehWeekend = optionKelas?.dataset.tingkat === '11' && optionKelas?.dataset.jurusan === 'RPL' && optionKelas?.dataset.rombel === '2';
            const hari = document.getElementById('hari');
            hari.querySelectorAll('[data-weekend]').forEach(option => {
                option.hidden = !bolehWeekend;
                option.disabled = !bolehWeekend;
                if (!bolehWeekend && option.selected) hari.value = '';
            });
        }
        bindSearchableId('cariKelasJadwal', 'daftarKelasJadwal', 'id_kelas', () => { aturHariWeekendJadwal(); updateJam(); });
        bindSearchableId('cariGuruJadwal', 'daftarGuruJadwal', 'id_guru');
        bindSearchableId('cariMapelJadwal', 'daftarMapelJadwal', 'id_mapel');
        document.getElementById('hari').addEventListener('change', updateJam);
        aturHariWeekendJadwal();

        async function updateJam() {
            const idKelas = document.getElementById('id_kelas').value;
            const hari = document.getElementById('hari').value;
            const dari = document.getElementById('jam_dari');
            const sampai = document.getElementById('jam_sampai');
            const controls = [dari, sampai];
            controls.forEach(select => {
                select.disabled = true;
                select.innerHTML = '<option value="">Memuat jam pelajaran...</option>';
            });
            if (!idKelas || !hari) {
                controls.forEach(select => select.innerHTML = '<option value="">Pilih kelas dan hari dahulu</option>');
                return;
            }

            try {
                const response = await fetch(`{{ route('jadwal.get-jam') }}?id_kelas=${encodeURIComponent(idKelas)}&hari=${encodeURIComponent(hari)}`);
                if (!response.ok) throw new Error('Gagal mengambil jam pelajaran.');
                const jamList = await response.json();
                controls.forEach(select => select.innerHTML = '<option value="">Pilih jam</option>');
                if (!jamList.length) {
                    controls.forEach(select => select.innerHTML = '<option value="">Tidak ada jam untuk hari ini</option>');
                    return;
                }
                jamList.forEach(jam => {
                    const label = `Jam ${jam.jam_ke} (${String(jam.jam_mulai).slice(0,5)}–${String(jam.jam_selesai).slice(0,5)})`;
                    controls.forEach(select => {
                        const option = document.createElement('option');
                        option.value = jam.id_jam;
                        option.textContent = label;
                        select.appendChild(option);
                    });
                });
                controls.forEach(select => select.disabled = false);
                if (dari.dataset.old) dari.value = dari.dataset.old;
                if (sampai.dataset.old) sampai.value = sampai.dataset.old;
                dari.dataset.old = '';
                sampai.dataset.old = '';
            } catch (error) {
                console.error(error);
                controls.forEach(select => select.innerHTML = '<option value="">Gagal memuat jam</option>');
            }
        }

    </script>


    @include('shared.preserve_search_scroll')
</body>

</html>
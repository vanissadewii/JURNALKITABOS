<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Mengajar - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black/40 z-40 hidden pointer-events-none md:hidden"
         onclick="closeSidebar()"></div>

    <aside id="sidebar"
           class="fixed top-0 left-0 z-50 h-full w-[280px] bg-white border-r border-[#E5D8CC] transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col">
        <div class="px-5 pt-6 pb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-[#5C4033] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-['Poppins'] font-bold text-[15px] text-[#5C4033] leading-tight">JURNAL GURU</h1>
                    <p class="text-[11px] text-[#A08978] mt-0.5">Admin Sekolah</p>
                </div>
            </div>
        </div>
        <div class="mx-5 border-t border-[#E5D8CC]"></div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 flex flex-col">

            <p class="px-3.5 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                Menu Utama
            </p>


            <div class="flex flex-col gap-0.5">

                {{-- BERANDA --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                    Beranda

                </button>


                {{-- KEHADIRAN GURU --}}
                <a
                    href="{{ route('admin.kehadiran') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.kehadiran') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>

                    Kehadiran Guru

                </a>


                {{-- JURNAL --}}
                <a
                    href="{{ route('admin.jurnal') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.jurnal') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>

                    Jurnal

                </a>


                {{-- LIHAT VERIFIKASI --}}
                <a
                    href="{{ route('admin.verifikasi') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.verifikasi') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>

                    Lihat Verifikasi

                </a>


                {{-- REKAP --}}
                <a
                    href="{{ route('admin.rekap') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.rekap') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >

                    <svg
                        class="w-[18px] h-[18px] shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M16 13H8"/>
                        <path d="M16 17H8"/>
                        <path d="M10 9H8"/>
                    </svg>

                    Rekap

                </a>


                {{-- ================================================= --}}
                {{-- TAMBAH --}}
                {{-- ================================================= --}}

                <p class="px-3.5 mt-4 mb-2 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">PENGATURAN</p>

                <details class="mt-1 group">

                    {{-- TOMBOL TAMBAH --}}
                    <summary
                        class="list-none cursor-pointer w-full flex items-center justify-between gap-3
                               px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.tambah.*', 'jadwal.*', 'jam-pelajaran.*', 'mapel.*', 'admin.kelas.*', 'semester.*', 'admin.siswa.*', 'admin.user.*') ? 'bg-[#5C4033] font-semibold text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }} transition"
                    >

                        <span class="flex items-center gap-3">

                            <svg
                                class="w-[18px] h-[18px] shrink-0"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path d="M12 5v14M5 12h14"/>
                            </svg>

                            <span>
                                Tambah
                            </span>

                        </span>


                        <svg
                            class="w-4 h-4 text-[#7A6A60] transition-transform duration-200
                                   group-open:rotate-180"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="M6 9l6 6 6-6"/>
                        </svg>

                    </summary>


                    {{-- SUBMENU TAMBAH --}}
                    <div class="mt-1 ml-3 pl-3 border-l border-[#E5D8CC] flex flex-col gap-0.5">

                        {{-- ADMIN --}}
                        <a
                            href="{{ route('admin.tambah.admin') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.admin') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Admin
                        </a>


                        {{-- JADWAL --}}
                        <a
                            href="{{ route('admin.tambah.jadwal') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jadwal', 'jadwal.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jadwal
                        </a>


                        {{-- JAM PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.jam') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jam', 'jam-pelajaran.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jam Pelajaran
                        </a>


                        {{-- MATA PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.mapel') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.mapel', 'mapel.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Mata Pelajaran
                        </a>


                        {{-- KELAS --}}
                        <a
                            href="{{ route('admin.tambah.kelas') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.kelas', 'admin.kelas.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Kelas
                        </a>


                        {{-- SEMESTER --}}
                        <a
                            href="{{ route('admin.tambah.semester') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.semester', 'semester.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Semester
                        </a>


                        {{-- PIKET --}}
                        <a
                            href="{{ route('admin.tambah.piket') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.piket') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Piket
                        </a>


                        {{-- SISWA --}}
                        <a
                            href="{{ route('admin.tambah.siswa') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.siswa', 'admin.siswa.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Siswa
                        </a>


                        {{-- USER --}}
                        <a
                            href="{{ route('admin.tambah.user') }}"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.user', 'admin.user.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            User
                        </a>

                    </div>

                </details>

            </div>

        </nav>

        <div class="border-t border-[#E5D8CC] px-4 py-4">
            <button type="button" onclick="openAdminProfileModal()"  class="flex items-center gap-3 px-1.5 mb-3 rounded-lg hover:bg-[#F5EFE8] py-1.5">
                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">
                    <span class="text-xs font-bold text-[#5C4033]">{{ auth()->user()->initials() }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-[#3E3028] truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-[#A08978]">Administrator</p>
                </div>
            </button>
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold text-[#C62828] hover:bg-[#FFEBEE] text-left">Logout</button>
            </form>
        </div>
    </aside>

    <div class="md:ml-[280px] min-h-screen">
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[#D7B899] text-xs font-medium">Pantau jurnal dari akun kelas</p>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">Jurnal Mengajar</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">
            <section class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] p-4 sm:p-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="font-['Poppins'] text-sm font-bold">Jurnal Kelas Disetujui</h2>
                            <p class="mt-1 text-xs text-[#7A6A60]">Hanya rekap yang sudah dikirim akun kelas dan disetujui guru piket ditampilkan di sini.</p>
                        </div>
                        <input id="cariJurnalAdmin" oninput="filterJurnalAdmin()" type="search" placeholder="Cari nama kelas..." class="w-full rounded-lg border border-[#D8C9BC] px-3 py-2.5 text-sm sm:max-w-xs">
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2" role="group" aria-label="Pilih tingkat kelas">
                        <button type="button" onclick="pilihTingkatJurnal('semua', this)" class="filter-tingkat-jurnal rounded-lg bg-[#5C4033] px-4 py-2 text-xs font-semibold text-white">Semua</button>
                        @foreach (['10' => 'X', '11' => 'XI', '12' => 'XII'] as $angkaTingkat => $labelTingkat)
                            <button type="button" onclick="pilihTingkatJurnal('{{ $labelTingkat }}', this)" class="filter-tingkat-jurnal rounded-lg border border-[#D8C9BC] bg-white px-4 py-2 text-xs font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Kelas {{ $labelTingkat }}</button>
                        @endforeach
                    </div>
                </div>
                <div id="daftarKelasJurnalAdmin" class="flex flex-col gap-2 p-3 sm:p-4">
                    @forelse($pengirimanPerKelas as $kirimanKelas)
                        @php
                            $kelasJurnal = $kirimanKelas->first()->kelas;
                            $tingkatKelas = ['10' => 'X', '11' => 'XI', '12' => 'XII'][(string) ($kelasJurnal?->tingkat ?? '')] ?? (string) ($kelasJurnal?->tingkat ?? '—');
                            $namaKelasJurnal = $kelasJurnal?->nama_kelas ?? 'Kelas tidak diketahui';
                        @endphp
                        <details class="kelas-jurnal-admin group overflow-hidden rounded-xl border border-[#E5D8CC] bg-white" data-tingkat="{{ $tingkatKelas }}" data-search="{{ strtolower($namaKelasJurnal) }}">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-3 bg-[#FFFCF9] px-4 py-3.5 hover:bg-[#F5EFE8] [&::-webkit-details-marker]:hidden">
                                <span class="flex min-w-0 items-center gap-3">
                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#F5EFE8] font-['Poppins'] text-xs font-bold text-[#5C4033]">{{ $tingkatKelas }}</span>
                                    <span class="min-w-0"><span class="block truncate font-['Poppins'] text-sm font-bold text-[#3E3028]">{{ $namaKelasJurnal }}</span><span class="mt-0.5 block text-xs text-[#7A6A60]">{{ $kirimanKelas->count() }} kiriman disetujui</span></span>
                                </span>
                                <svg class="h-5 w-5 shrink-0 text-[#7A6A60] transition-transform group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
                            </summary>
                            <div class="flex flex-col gap-3 border-t border-[#E5D8CC] p-3 sm:p-4">
                                @foreach($kirimanKelas->sortByDesc('tanggal') as $kiriman)
                                    <details class="overflow-hidden rounded-lg border border-[#E5D8CC]" {{ $loop->first ? 'open' : '' }}>
                                        <summary class="flex cursor-pointer list-none flex-wrap items-center justify-between gap-2 bg-[#FFFCF9] px-4 py-3 hover:bg-[#F5EFE8] [&::-webkit-details-marker]:hidden">
                                            <span class="font-semibold text-sm text-[#3E3028]">Rekap {{ $kiriman->tanggal?->translatedFormat('l, d F Y') }}</span>
                                            <span class="text-xs text-[#7A6A60]">Dikirim {{ $kiriman->dikirim_at?->format('H:i') ?? '—' }} · Disetujui {{ $kiriman->diperiksa_at?->format('H:i') ?? '—' }} oleh {{ $kiriman->pemeriksa?->name ?? 'guru piket' }}</span>
                                        </summary>
                                        <div class="overflow-x-auto border-t border-[#E5D8CC]">
                                            <table class="min-w-[1180px] w-full border-collapse text-left text-sm">
                                                <thead class="text-center uppercase text-[#5C4033]">
                                                    <tr class="bg-[#F5EFE8] text-xs font-bold">
                                                        <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Jam ke-</th><th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Nama Pengajar</th><th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Mata Pelajaran</th><th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Hadir</th><th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Tidak Hadir<br><span class="normal-case font-normal">(Tugas)</span></th><th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Materi</th><th class="border border-[#E5D8CC] px-3 py-3" colspan="6">Keadaan Siswa</th>
                                                    </tr>
                                                    <tr class="bg-[#F5EFE8] text-xs font-semibold"><th class="border border-[#E5D8CC] px-3 py-3">Jumlah Hadir</th><th class="border border-[#E5D8CC] px-3 py-3 text-left">Nama Siswa</th><th class="border border-[#E5D8CC] px-3 py-3">S</th><th class="border border-[#E5D8CC] px-3 py-3">I</th><th class="border border-[#E5D8CC] px-3 py-3">A</th><th class="border border-[#E5D8CC] px-3 py-3">D</th></tr>
                                                </thead>
                                                <tbody class="text-sm">
                                                    @forelse($kiriman->rekap as $sesi)
                                                        @php
                                                            $jurnalSesi = $sesi->jurnal;
                                                            $tugasSesi = $sesi->tugas;
                                                            $guruHadir = $jurnalSesi?->status_kehadiran_guru === 'hadir' && $jurnalSesi?->status_verifikasi === 'terverifikasi';
                                                            $guruTidakHadir = $tugasSesi !== null || $jurnalSesi?->status_kehadiran_guru === 'tidak_hadir';
                                                            $absensiSiswa = $jurnalSesi?->absenSiswa ?? collect();
                                                            $barisSiswa = max(1, $absensiSiswa->count());
                                                            $jumlahHadir = $jurnalSesi?->jumlah_hadir ?? ($tugasSesi ? '—' : max(0, $sesi->jumlah_siswa - $absensiSiswa->count()));
                                                        @endphp
                                                        @for($baris = 0; $baris < $barisSiswa; $baris++)
                                                            @php($absen = $absensiSiswa->values()->get($baris))
                                                            <tr class="align-top">
                                                                @if($baris === 0)
                                                                    <td rowspan="{{ $barisSiswa }}" class="whitespace-nowrap border border-[#E5D8CC] px-3 py-3 text-center">{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif</td>
                                                                    <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3">{{ $sesi->guru }}</td>
                                                                    <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3">{{ $sesi->mapel }}</td>
                                                                    <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3 text-center font-bold {{ $guruHadir ? 'text-green-700' : ($guruTidakHadir ? 'text-red-700' : 'text-amber-700') }}">{{ $guruHadir ? '✓' : ($guruTidakHadir ? '✕' : 'Menunggu scan') }}</td>
                                                                    <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3 text-center font-bold {{ $tugasSesi ? 'text-green-700' : 'text-red-700' }}">{{ $tugasSesi ? '✓' : '—' }}@if($tugasSesi)<span class="block text-[10px] font-medium">{{ $tugasSesi->status_guru }}</span>@endif</td>
                                                                    <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3">{{ $tugasSesi->materi ?? $jurnalSesi?->materi ?? '—' }}@if($tugasSesi)<p class="mt-1 whitespace-pre-line text-xs text-[#7A6A60]">Tugas: {{ $tugasSesi->tugas }}</p>@endif</td>
                                                                    <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3 text-center">{{ $jumlahHadir }}</td>
                                                                @endif
                                                                <td class="border border-[#E5D8CC] px-3 py-3">{{ $absen?->nama ?? '—' }}</td>
                                                                @foreach(['Sakit' => 'S', 'Izin' => 'I', 'Alpha' => 'A', 'Dispen' => 'D'] as $namaStatus => $kodeStatus)
                                                                    <td class="border border-[#E5D8CC] px-3 py-3 text-center text-lg">{{ $absen?->status === $namaStatus ? '✓' : '' }}</td>
                                                                @endforeach
                                                            </tr>
                                                        @endfor
                                                    @empty
                                                        <tr><td colspan="12" class="border border-[#E5D8CC] px-4 py-8 text-center text-sm text-[#7A6A60]">Tidak ada sesi terjadwal pada tanggal kiriman.</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </details>
                                @endforeach
                            </div>
                        </details>
                    @empty
                        <div class="px-4 py-10 text-center text-sm text-[#7A6A60]">Belum ada kiriman jurnal kelas yang disetujui guru piket.</div>
                    @endforelse
                    <p id="hasilFilterJurnalAdmin" class="hidden px-4 py-8 text-center text-sm text-[#7A6A60]">Tidak ada kelas yang cocok dengan pencarian.</p>
                </div>
            </section>
            <script>
                let tingkatJurnalAktif = 'semua';
                function filterJurnalAdmin() {
                    const q = document.getElementById('cariJurnalAdmin').value.trim().toLowerCase();
                    let jumlahTampil = 0;
                    document.querySelectorAll('.kelas-jurnal-admin').forEach(kartu => {
                        const cocokTingkat = tingkatJurnalAktif === 'semua' || kartu.dataset.tingkat === tingkatJurnalAktif;
                        const cocokCari = window.matchesAllSearchTerms(q, kartu.dataset.search);
                        kartu.classList.toggle('hidden', !(cocokTingkat && cocokCari));
                        if (cocokTingkat && cocokCari) jumlahTampil++;
                    });
                    document.getElementById('hasilFilterJurnalAdmin')?.classList.toggle('hidden', jumlahTampil > 0 || !document.querySelector('.kelas-jurnal-admin'));
                }
                function pilihTingkatJurnal(tingkat, tombol) {
                    tingkatJurnalAktif = tingkat;
                    document.querySelectorAll('.filter-tingkat-jurnal').forEach(item => {
                        item.classList.remove('bg-[#5C4033]', 'text-white');
                        item.classList.add('border', 'border-[#D8C9BC]', 'bg-white', 'text-[#5C4033]');
                    });
                    tombol.classList.remove('border', 'border-[#D8C9BC]', 'bg-white', 'text-[#5C4033]');
                    tombol.classList.add('bg-[#5C4033]', 'text-white');
                    filterJurnalAdmin();
                }
            </script>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            const overlay = document.getElementById('sidebarOverlay');
            overlay.classList.remove('hidden', 'pointer-events-none');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            const overlay = document.getElementById('sidebarOverlay');
            overlay.classList.add('hidden', 'pointer-events-none');
        }

        function filterJurnal() {
            const q = document.getElementById('cariKelas').value.toLowerCase().trim();
            const status = document.getElementById('filterStatus').value;
            document.querySelectorAll('.jurnal-row').forEach(function (row) {
                const cocokKelas = window.matchesAllSearchTerms(q, 'kelas ' + row.dataset.kelas, 'status ' + row.dataset.status, row.textContent);
                const cocokStatus = status === 'semua' || row.dataset.status === status;
                row.style.display = cocokKelas && cocokStatus ? '' : 'none';
            });
        }
        function filterKelas() { filterJurnal(); }

    </script>
    @include('admin.partials.admin_profile_modal')
    @include('shared.preserve_search_scroll')
</body>
</html>
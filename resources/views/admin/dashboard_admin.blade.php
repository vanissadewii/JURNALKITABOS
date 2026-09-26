<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    @vite('resources/css/app.css')
    <style>html { scrollbar-width: none; } html::-webkit-scrollbar { display: none; }</style>
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    {{-- SIDEBAR OVERLAY --}}
    <div
        id="sidebarOverlay"
        class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"
        onclick="closeSidebar()"
    ></div>


    {{-- SIDEBAR --}}
    <aside
        id="sidebar"
        class="fixed top-0 left-0 z-50 h-full w-[280px] bg-white border-r border-[#E5D8CC]
               transform -translate-x-full md:translate-x-0
               transition-transform duration-300 flex flex-col"
    >

        {{-- LOGO --}}
        <div class="px-5 pt-6 pb-5">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-[#5C4033] flex items-center justify-center shrink-0">

                    <svg
                        class="w-5 h-5 text-white"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>

                </div>

                <div>

                    <h1 class="font-['Poppins'] font-bold text-[15px] text-[#5C4033] leading-tight">
                        JURNAL GURU
                    </h1>

                    <p class="text-[11px] text-[#A08978] mt-0.5">
                        Admin Sekolah
                    </p>

                </div>

            </div>

        </div>


        {{-- DIVIDER --}}
        <div class="mx-5 border-t border-[#E5D8CC]"></div>


        {{-- MENU --}}
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
                    href="{{ route('admin.jurnal') }}"
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


                <a
                    href="{{ route('admin.aturan-jurnal-susulan.edit') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.aturan-jurnal-susulan.*') ? 'font-semibold bg-[#5C4033] text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                >
                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3v18M3 12h18"/><circle cx="12" cy="12" r="9"/></svg>
                    Aturan Jurnal Susulan
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

                @php
                    $tambahAktif = request()->routeIs('admin.tambah.*', 'jadwal.*', 'jam-pelajaran.*', 'mapel.*', 'admin.kelas.*', 'semester.*', 'admin.siswa.*', 'admin.user.*');
                @endphp
                <details id="tambahMenu" class="mt-1 group">

                    {{-- TOMBOL TAMBAH --}}
                    <summary
                        class="list-none cursor-pointer w-full flex items-center justify-between gap-3
                               px-3.5 py-2.5 rounded-lg text-sm {{ $tambahAktif ? 'bg-[#5C4033] font-semibold text-white' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }} transition"
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
                            class="w-4 h-4 {{ $tambahAktif ? 'text-white' : 'text-[#7A6A60]' }} transition-transform duration-200
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
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.admin') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Admin
                        </a>


                        {{-- JADWAL --}}
                        <a
                            href="{{ route('admin.tambah.jadwal') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jadwal', 'jadwal.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jadwal
                        </a>


                        {{-- JAM PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.jam') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.jam', 'jam-pelajaran.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Jam Pelajaran
                        </a>


                        {{-- MATA PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.mapel') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.mapel', 'mapel.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Mata Pelajaran
                        </a>


                        {{-- KELAS --}}
                        <a
                            href="{{ route('admin.tambah.kelas') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.kelas', 'admin.kelas.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Kelas
                        </a>


                        {{-- SEMESTER --}}
                        <a
                            href="{{ route('admin.tambah.semester') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.semester', 'semester.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Semester
                        </a>


                        {{-- PIKET --}}
                        <a
                            href="{{ route('admin.tambah.piket') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.piket') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Piket
                        </a>


                        {{-- SISWA --}}
                        <a
                            href="{{ route('admin.tambah.siswa') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.siswa', 'admin.siswa.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            Siswa
                        </a>


                        {{-- USER --}}
                        <a
                            href="{{ route('admin.tambah.user') }}"
                            onclick="closeTambahMenu()"
                            class="block px-3 py-2 rounded-lg text-[13px] {{ request()->routeIs('admin.tambah.user', 'admin.user.*') ? 'bg-[#F5EFE8] font-semibold text-[#5C4033]' : 'text-[#3E3028] hover:bg-[#F5EFE8]' }}"
                        >
                            User
                        </a>

                    </div>

                </details>

            </div>

        </nav>


        {{-- PROFILE --}}
        <div class="border-t border-[#E5D8CC] px-4 py-4">

            <button type="button" onclick="openAdminProfileModal()"
                
                class="flex items-center gap-3 px-1.5 mb-3 rounded-lg
                       hover:bg-[#F5EFE8] py-1.5 transition"
            >

                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">

                    <span class="text-xs font-bold text-[#5C4033]">{{ auth()->user()->initials() }}</span>

                </div>


                <div class="min-w-0">

                    <p class="text-sm font-semibold text-[#3E3028] truncate">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-[11px] text-[#A08978]">
                        Administrator
                    </p>

                </div>

            </button>


            <button
                type="button"
                onclick="openLogoutModal()"
                class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                       text-sm font-semibold text-[#C62828]
                       hover:bg-[#FFEBEE] text-left"
            >
                Logout
            </button>

        </div>

    </aside>



    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="md:ml-[280px] min-h-screen">


        {{-- HEADER --}}
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[#D7B899] text-xs font-medium">
                        Selamat Datang,
                    </p>

                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">
                        {{ auth()->user()->name }}
                    </h1>

                </div>


                {{-- MOBILE MENU --}}
                <button
                    type="button"
                    onclick="openSidebar()"
                    class="md:hidden w-10 h-10 flex items-center justify-center
                           rounded-lg hover:bg-white/10"
                >

                    <svg
                        class="w-6 h-6 text-white"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                </button>

            </div>


            <div class="flex items-center gap-2 mt-3">

                <span class="text-white text-[13px] font-medium">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>

            </div>

        </div>



        {{-- CONTENT --}}
        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-5">
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
                <a href="{{ route('admin.user.index', ['role' => 'guru']) }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#5C4033] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#5C4033]/10 text-[#5C4033]">G</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Guru</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahGuru }}</p></div>
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#2E7D32] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#2E7D32]/10 text-[#2E7D32]">S</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Siswa</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahSiswa }}</p></div>
                </a>
                <a href="{{ route('admin.kelas.index') }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#1565C0] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#1565C0]/10 text-[#1565C0]">K</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Kelas</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahKelas }}</p></div>
                </a>
                <a href="{{ route('admin.jurnal') }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#F57F17] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#F57F17]/10 text-[#F57F17]">J</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Jurnal</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahJurnal }}</p></div>
                </a>
            </div>

            <a href="{{ route('admin.jurnal') }}" class="flex items-center justify-between gap-3 rounded-xl border border-[#F5D08A] bg-white p-3.5 transition hover:border-[#F57F17] hover:shadow-md">
                <div><p class="text-[13px] font-semibold text-[#3E3028]">{{ $menungguVerifikasi }} jurnal menunggu verifikasi hari ini</p><p class="mt-0.5 text-[11px] text-[#7A6A60]">Buka daftar jurnal guru</p></div>
                <span class="text-[#7A6A60]">→</span>
            </a>

            <section>
                <h2 class="mb-2.5 font-['Poppins'] text-[13px] font-bold uppercase">Ringkasan Jurnal Guru Hari Ini</h2>
                <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
                    @foreach ([['Hadir','hadir','#2E7D32'],['Izin','izin','#1565C0'],['Sakit','sakit','#F57F17'],['Tidak Hadir','tidak_hadir','#C62828']] as [$label,$key,$warna])
                        <a href="{{ route('admin.jurnal') }}" class="rounded-xl border border-[#E5D8CC] border-l-4 bg-white p-3.5 hover:shadow-md" style="border-left-color: {{ $warna }}">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">{{ $label }}</p>
                            <p class="mt-1 font-['Poppins'] text-xl font-extrabold" style="color: {{ $warna }}">{{ $ringkasanKehadiran[$key] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>

            <section>
                <div class="mb-2.5 flex items-center justify-between"><h2 class="font-['Poppins'] text-[13px] font-bold uppercase">Jadwal Mengajar Hari Ini · {{ $hariIni }}</h2></div>
                <div class="mb-3 flex gap-2">
                    @foreach (['X','XI','XII'] as $tingkat)
                        <button type="button" onclick="filterTingkat('{{ $tingkat }}', this)" data-tingkat-btn="{{ $tingkat }}" class="tingkat-tab-btn rounded-full border border-[#D8C9BC] bg-white px-4 py-1.5 text-xs font-semibold text-[#5C4033] transition">Kelas {{ $tingkat }}</button>
                    @endforeach
                </div>
                <div class="flex flex-col gap-2.5">
                    @foreach (['X', 'XI', 'XII'] as $tingkatKosong)
                        @if (($kelasPerTingkat->get($tingkatKosong) ?? collect())->isEmpty())
                            <div data-tingkat-empty="{{ $tingkatKosong }}" class="hidden rounded-xl border border-dashed border-[#D8C9BC] bg-white p-6 text-center text-sm text-[#7A6A60]">Belum ada data kelas tingkat {{ $tingkatKosong }}.</div>
                        @endif
                    @endforeach
                    @foreach ($kelasPerTingkat as $tingkat => $daftarKelas)
                        @foreach ($daftarKelas as $kelas)
                            @php($daftarJadwal = $jadwalPerKelas->get($kelas->id_kelas, collect()))
                            <div data-tingkat="{{ $tingkat }}" class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                                <button type="button" onclick="toggleJadwal('kelas-{{ $kelas->id_kelas }}')" class="flex w-full items-center justify-between p-3.5 text-left transition hover:bg-[#F5EFE8]">
                                    <div><p class="font-['Poppins'] text-[15px] font-bold">{{ $kelas->nama_kelas }}</p><p class="mt-0.5 text-[12px] text-[#7A6A60]">{{ $daftarJadwal->count() }} jadwal hari ini</p></div>
                                    <div class="flex items-center gap-2"><span class="rounded-md bg-[#E8F5E9] px-2.5 py-1 text-[11px] font-bold text-[#2E7D32]">{{ $daftarJadwal->count() }} jadwal</span><svg id="icon-kelas-{{ $kelas->id_kelas }}" class="h-4 w-4 text-[#7A6A60] transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                                </button>
                                <div id="kelas-{{ $kelas->id_kelas }}" class="hidden border-t border-[#E5D8CC] p-3.5">
                                    @forelse ($daftarJadwal as $jadwal)
                                        @php($jurnal = $jadwal->jurnalHariIni)
                                        @php($status = $jurnal?->status_kehadiran_guru)
                                        <article class="mb-2.5 rounded-lg border border-[#E5D8CC] p-3 last:mb-0">
                                            <div class="flex flex-wrap justify-between gap-3"><div><p class="text-[13px] font-semibold">{{ $jadwal->mapel->nama_mapel ?? 'Mata pelajaran belum diatur' }}</p><p class="mt-1 text-[11px] text-[#7A6A60]">{{ $jadwal->guru->name ?? 'Guru belum diatur' }} · {{ substr($jadwal->jamPelajaran->jam_mulai,0,5) }}–{{ substr($jadwal->jamPelajaran->jam_selesai,0,5) }} (jam ke-{{ $jadwal->jamPelajaran->jam_ke }})</p></div>
                                                @if ($status === 'tidak_hadir')<span class="h-fit rounded-md bg-[#FFEBEE] px-2 py-1 text-[10px] font-bold text-[#C62828]">Tidak hadir</span>
                                                @elseif ($jurnal)<span class="h-fit rounded-md bg-[#E8F5E9] px-2 py-1 text-[10px] font-bold text-[#2E7D32]">Jurnal dikirim</span>
                                                @else<span class="h-fit rounded-md bg-[#FFFDE7] px-2 py-1 text-[10px] font-bold text-[#F57F17]">Belum ada jurnal</span>@endif
                                            </div>
                                            @if ($jurnal && $status !== 'tidak_hadir')<p class="mt-2 text-[11px] text-[#7A6A60]">Verifikasi jurnal: {{ $jurnal->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : 'Menunggu verifikasi' }}</p>@endif
                                        </article>
                                    @empty
                                        <p class="rounded-lg bg-[#F5EFE8] p-3 text-xs text-[#7A6A60]">Belum ada jadwal untuk kelas ini hari ini.</p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    @if ($kelasList->isEmpty())<p class="rounded-xl border border-dashed border-[#D8C9BC] bg-white p-6 text-center text-sm text-[#7A6A60]">Belum ada data kelas. Tambahkan kelas melalui menu admin.</p>@endif
                </div>
            </section>
        </div>
    </div>

    {{-- LOGOUT CONFIRMATION --}}
    <div
        id="logoutModal"
        class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 px-4"
        onclick="closeLogoutModal(event)"
    >
        <div
            class="w-full max-w-sm rounded-xl bg-white p-5 shadow-xl"
            role="dialog"
            aria-modal="true"
            aria-labelledby="logoutModalTitle"
            onclick="event.stopPropagation()"
        >
            <h2 id="logoutModalTitle" class="font-['Poppins'] text-lg font-bold text-[#3E3028]">
                Yakin ingin logout?
            </h2>

            <p class="mt-2 text-sm text-[#7A6A60]">
                Anda akan keluar dari akun admin.
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button
                    type="button"
                    onclick="closeLogoutModal()"
                    class="rounded-lg px-4 py-2 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]"
                >
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-lg bg-[#C62828] px-4 py-2 text-sm font-semibold text-white hover:bg-[#A51F1F]"
                    >
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>


    {{-- JAVASCRIPT --}}
    <script>

        function openLogoutModal() {

            const modal = document.getElementById('logoutModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }


        function closeLogoutModal(event) {

            if (event && event.target !== event.currentTarget) {
                return;
            }

            const modal = document.getElementById('logoutModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');

        }

        function openSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .remove('-translate-x-full');

            document
                .getElementById('sidebarOverlay')
                .classList
                .remove('hidden');

        }


        function closeSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .add('-translate-x-full');

            document
                .getElementById('sidebarOverlay')
                .classList
                .add('hidden');

        }

        function toggleJadwal(id) {

            const content = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            content.classList.toggle('hidden');

            if (content.classList.contains('hidden')) {

                icon.classList.remove('rotate-180');

            } else {

                icon.classList.add('rotate-180');

            }

        }

        function closeTambahMenu() {
            const menu = document.getElementById('tambahMenu');
            if (menu) {
                menu.open = false;
            }
        }

        function filterTingkat(tingkat, btn) {

            // tampilkan/sembunyikan kartu kelas sesuai tingkat yang dipilih
            document.querySelectorAll('[data-tingkat]').forEach(function (card) {
                card.classList.toggle('hidden', card.dataset.tingkat !== tingkat);
            });

            // tampilkan pesan "belum ada jadwal" jika tingkat kosong
            document.querySelectorAll('[data-tingkat-empty]').forEach(function (empty) {
                empty.classList.toggle('hidden', empty.dataset.tingkatEmpty !== tingkat);
            });

            // update style tombol tab aktif
            document.querySelectorAll('.tingkat-tab-btn').forEach(function (tab) {
                const aktif = tab === btn;
                tab.classList.toggle('bg-[#5C4033]', aktif);
                tab.classList.toggle('text-white', aktif);
                tab.classList.toggle('bg-white', !aktif);
                tab.classList.toggle('border', !aktif);
                tab.classList.toggle('border-[#D8C9BC]', !aktif);
                tab.classList.toggle('text-[#5C4033]', !aktif);
            });

        }

        document.addEventListener('DOMContentLoaded', function () {
            const tabAwal = document.querySelector('[data-tingkat-btn="X"]');
            if (tabAwal) {
                filterTingkat('X', tabAwal);
            }
        });

    </script>

    @include('admin.partials.admin_profile_modal')
</body>

</html>
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
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm font-semibold
                           bg-[#5C4033] text-white"
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

                </a>


                {{-- KEHADIRAN GURU --}}
                <a
                    href="{{ route('jadwal.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                           text-[#3E3028] hover:bg-[#F5EFE8]"
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
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                           text-[#3E3028] hover:bg-[#F5EFE8]"
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
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                           text-[#3E3028] hover:bg-[#F5EFE8]"
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
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                           text-[#3E3028] hover:bg-[#F5EFE8]"
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

                <details class="mt-1 group">

                    {{-- TOMBOL TAMBAH --}}
                    <summary
                        class="list-none cursor-pointer w-full flex items-center justify-between gap-3
                               px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028]
                               hover:bg-[#F5EFE8] transition"
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
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Admin
                        </a>


                        {{-- JADWAL --}}
                        <a
                            href="{{ route('admin.tambah.jadwal') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Jadwal
                        </a>


                        {{-- JAM PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.jam') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Jam Pelajaran
                        </a>


                        {{-- MATA PELAJARAN --}}
                        <a
                            href="{{ route('admin.tambah.mapel') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Mata Pelajaran
                        </a>


                        {{-- KELAS --}}
                        <a
                            href="{{ route('admin.tambah.kelas') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Kelas
                        </a>


                        {{-- SEMESTER --}}
                        <a
                            href="{{ route('admin.tambah.semester') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Semester
                        </a>


                        {{-- PIKET --}}
                        <a
                            href="{{ route('admin.tambah.piket') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Piket
                        </a>


                        {{-- SISWA --}}
                        <a
                            href="{{ route('admin.tambah.siswa') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            Siswa
                        </a>


                        {{-- USER --}}
                        <a
                            href="{{ route('admin.tambah.user') }}"
                            class="block px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8] transition"
                        >
                            User
                        </a>

                    </div>

                </details>

            </div>

        </nav>


        {{-- PROFILE --}}
        <div class="border-t border-[#E5D8CC] px-4 py-4">

            <a
                href="{{ route('admin.profil') }}"
                class="flex items-center gap-3 px-1.5 mb-3 rounded-lg
                       hover:bg-[#F5EFE8] py-1.5 transition"
            >

                <div class="w-8 h-8 rounded-full bg-[#E8DFD6] flex items-center justify-center shrink-0">

                    <span class="text-xs font-bold text-[#5C4033]">
                        AT
                    </span>

                </div>


                <div class="min-w-0">

                    <p class="text-sm font-semibold text-[#3E3028] truncate">
                        Admin Testing
                    </p>

                    <p class="text-[11px] text-[#A08978]">
                        Administrator
                    </p>

                </div>

            </a>


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
        <div class="bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[#D7B899] text-xs font-medium">
                        Selamat Datang,
                    </p>

                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">
                        Admin Testing
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
        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">


            {{-- STATISTIK --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5">


                {{-- GURU --}}
                <a href="{{ route('admin.user.create') }}" class="bg-white rounded-lg p-3.5 border border-[#E5D8CC] hover:border-[#5C4033] hover:shadow-sm transition">

                    <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">
                        Total Guru
                    </p>

                    <p class="font-['Poppins'] font-extrabold text-[22px] mt-1">
                        24
                    </p>

                </a>


                {{-- SISWA --}}
                <a href="{{ route('admin.siswa.create') }}" class="bg-white rounded-lg p-3.5 border border-[#E5D8CC] hover:border-[#5C4033] hover:shadow-sm transition">

                    <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">
                        Total Siswa
                    </p>

                    <p class="font-['Poppins'] font-extrabold text-[22px] mt-1">
                        720
                    </p>

                </a>


                {{-- KELAS --}}
                <a href="{{ route('admin.kelas.create') }}" class="bg-white rounded-lg p-3.5 border border-[#E5D8CC] hover:border-[#5C4033] hover:shadow-sm transition">

                    <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">
                        Total Kelas
                    </p>

                    <p class="font-['Poppins'] font-extrabold text-[22px] mt-1">
                        24
                    </p>

                </a>


                {{-- JURNAL --}}
                <a href="{{ route('admin.jurnal') }}" class="bg-white rounded-lg p-3.5 border border-[#E5D8CC] hover:border-[#5C4033] hover:shadow-sm transition">

                    <p class="text-[11px] font-semibold text-[#7A6A60] uppercase">
                        Total Jurnal
                    </p>

                    <p class="font-['Poppins'] font-extrabold text-[22px] mt-1">
                        156
                    </p>

                </a>

            </div>



            {{-- NOTIFIKASI VERIFIKASI --}}
            <a
                href="{{ route('admin.verifikasi') }}"
                class="flex items-center justify-between gap-3 bg-[#FFFDE7]
                       border border-[#F5D563] rounded-lg px-4 py-3.5
                       hover:bg-[#FFF9C4] transition"
            >

                <div class="flex items-center gap-3">

                    <div class="w-9 h-9 rounded-lg bg-[#F57F17]/15
                                flex items-center justify-center shrink-0">

                        <svg
                            class="w-[18px] h-[18px] text-[#F57F17]"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>

                    </div>


                    <div>

                        <p class="text-[13px] font-semibold text-[#3E3028]">
                            3 jurnal menunggu verifikasi
                        </p>

                        <p class="text-[11px] text-[#7A6A60] mt-0.5">
                            Cek dan verifikasi sebelum jam pulang
                        </p>

                    </div>

                </div>


                <svg
                    class="w-4 h-4 text-[#7A6A60] shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path d="M9 18l6-6-6-6"/>
                </svg>

            </a>

            {{-- GURU TIDAK HADIR --}}
            <div class="bg-white border border-[#E5D8CC] border-l-4
                        border-l-[#C62828] rounded-lg p-4">

                <div class="flex items-center justify-between mb-2.5">

                    <h2 class="font-['Poppins'] font-bold text-[13px]
                               uppercase text-[#C62828]">
                        Guru Tidak Hadir Hari Ini
                    </h2>

                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-md
                                 bg-[#FFEBEE] text-[#C62828]">
                        1 Guru
                    </span>

                </div>


                <div class="flex justify-between items-start gap-3">

                    <div>

                        <p class="text-[14px] font-semibold text-[#3E3028]">
                            Zainul Arifin, S.Pd.
                        </p>

                        <p class="text-[12px] text-[#7A6A60] mt-0.5">
                            PJOK • XI RPL 2 • 07:40 – 09:40 (Jam ke-2 s/d 4)
                        </p>

                    </div>


                    <a href="{{ route('admin.rekap') }}"
                    class="text-[11px] font-semibold text-[#5C4033] whitespace-nowrap hover:underline">
                    Lihat detail
                    </a>

                </div>

            </div>



            {{-- JADWAL MENGAJAR HARI INI --}}
            <div>

                <h2 class="font-['Poppins'] font-bold text-[13px] uppercase mb-2.5">
                    Jadwal Mengajar Hari Ini
                </h2>


                <div class="flex flex-col gap-2.5">


                    {{-- XI RPL 1 --}}
                    <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">

                        <button
                            type="button"
                            onclick="toggleJadwal('kelas-xi-rpl-1')"
                            class="w-full p-3.5 flex items-center justify-between
                                   text-left hover:bg-[#F5EFE8] transition"
                        >

                            <div>

                                <p class="font-['Poppins'] font-bold text-[15px]">
                                    XI RPL 1
                                </p>

                                <p class="text-[12px] text-[#7A6A60] mt-0.5">
                                    3 sesi mengajar hari ini
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="text-[11px] font-bold px-2.5 py-1
                                             rounded-md bg-[#E8F5E9] text-[#2E7D32]">
                                    3 Sesi
                                </span>

                                <svg
                                    id="icon-kelas-xi-rpl-1"
                                    class="w-4 h-4 text-[#7A6A60] transition-transform duration-200"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>

                            </div>

                        </button>


                        <div
                            id="kelas-xi-rpl-1"
                            class="hidden border-t border-[#E5D8CC]"
                        >

                            <div class="p-3.5 flex flex-col gap-2.5">

                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                Matematika
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Budi Santoso • 07:00 – 08:30
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#E8F5E9] text-[#2E7D32]">
                                            Terverifikasi
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                Bahasa Indonesia
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Siti Aminah • 08:30 – 10:00
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#FFFDE7] text-[#F57F17]">
                                            Menunggu
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: -
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                PPLG
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Andi Wijaya • 10:15 – 11:45
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#E8F5E9] text-[#2E7D32]">
                                            Terverifikasi
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Budi
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- XI RPL 2 --}}
                    <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">

                        <button
                            type="button"
                            onclick="toggleJadwal('kelas-xi-rpl-2')"
                            class="w-full p-3.5 flex items-center justify-between
                                   text-left hover:bg-[#F5EFE8] transition"
                        >

                            <div>

                                <p class="font-['Poppins'] font-bold text-[15px]">
                                    XI RPL 2
                                </p>

                                <p class="text-[12px] text-[#7A6A60] mt-0.5">
                                    4 sesi mengajar hari ini
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="text-[11px] font-bold px-2.5 py-1
                                             rounded-md bg-[#E8F5E9] text-[#2E7D32]">
                                    4 Sesi
                                </span>

                                <svg
                                    id="icon-kelas-xi-rpl-2"
                                    class="w-4 h-4 text-[#7A6A60] transition-transform duration-200"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>

                            </div>

                        </button>


                        <div
                            id="kelas-xi-rpl-2"
                            class="hidden border-t border-[#E5D8CC]"
                        >

                            <div class="p-3.5 flex flex-col gap-2.5">

                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                Matematika
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Budi Santoso • 07:00 – 08:30
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#E8F5E9] text-[#2E7D32]">
                                            Terverifikasi
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                Bahasa Indonesia
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Siti Aminah • 08:30 – 10:00
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#FFFDE7] text-[#F57F17]">
                                            Menunggu
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: -
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                PJOK
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Zainul Arifin • 10:15 – 11:45
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#FFEBEE] text-[#C62828]">
                                            Tidak Hadir
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <div class="flex justify-between gap-3">

                                        <div>

                                            <p class="font-semibold text-[13px]">
                                                PPLG
                                            </p>

                                            <p class="text-[11px] text-[#7A6A60] mt-1">
                                                Andi Wijaya • 12:30 – 14:00
                                            </p>

                                        </div>

                                        <span class="h-fit text-[10px] font-bold
                                                     px-2 py-1 rounded-md
                                                     bg-[#E8F5E9] text-[#2E7D32]">
                                            Terverifikasi
                                        </span>

                                    </div>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Budi
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- X RPL 1 --}}
                    <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">

                        <button
                            type="button"
                            onclick="toggleJadwal('kelas-x-rpl-1')"
                            class="w-full p-3.5 flex items-center justify-between
                                   text-left hover:bg-[#F5EFE8] transition"
                        >

                            <div>

                                <p class="font-['Poppins'] font-bold text-[15px]">
                                    X RPL 1
                                </p>

                                <p class="text-[12px] text-[#7A6A60] mt-0.5">
                                    5 sesi mengajar hari ini
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="text-[11px] font-bold px-2.5 py-1
                                             rounded-md bg-[#E8F5E9] text-[#2E7D32]">
                                    5 Sesi
                                </span>

                                <svg
                                    id="icon-kelas-x-rpl-1"
                                    class="w-4 h-4 text-[#7A6A60] transition-transform duration-200"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>

                            </div>

                        </button>


                        <div
                            id="kelas-x-rpl-1"
                            class="hidden border-t border-[#E5D8CC]"
                        >

                            <div class="p-3.5 flex flex-col gap-2.5">

                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        Matematika
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Budi Santoso • 07:00 – 08:00
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        Bahasa Indonesia
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Siti Aminah • 08:00 – 09:00
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        PPLG
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Andi Wijaya • 09:15 – 10:15
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Budi
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        Bahasa Inggris
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Siti Aminah • 10:15 – 11:15
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Budi
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        PJOK
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Zainul Arifin • 11:15 – 12:15
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- X RPL 2 --}}
                    <div class="bg-white border border-[#E5D8CC] rounded-lg overflow-hidden">

                        <button
                            type="button"
                            onclick="toggleJadwal('kelas-x-rpl-2')"
                            class="w-full p-3.5 flex items-center justify-between
                                   text-left hover:bg-[#F5EFE8] transition"
                        >

                            <div>

                                <p class="font-['Poppins'] font-bold text-[15px]">
                                    X RPL 2
                                </p>

                                <p class="text-[12px] text-[#7A6A60] mt-0.5">
                                    4 sesi mengajar hari ini
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="text-[11px] font-bold px-2.5 py-1
                                             rounded-md bg-[#E8F5E9] text-[#2E7D32]">
                                    4 Sesi
                                </span>

                                <svg
                                    id="icon-kelas-x-rpl-2"
                                    class="w-4 h-4 text-[#7A6A60] transition-transform duration-200"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>

                            </div>

                        </button>


                        <div
                            id="kelas-x-rpl-2"
                            class="hidden border-t border-[#E5D8CC]"
                        >

                            <div class="p-3.5 flex flex-col gap-2.5">

                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        Matematika
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Budi Santoso • 07:00 – 08:00
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        Bahasa Indonesia
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Siti Aminah • 08:00 – 09:00
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Budi
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        PPLG
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Andi Wijaya • 09:15 – 10:15
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Ahmad
                                    </p>

                                </div>


                                <div class="border border-[#E5D8CC] rounded-lg p-3">

                                    <p class="font-semibold text-[13px]">
                                        PJOK
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-1">
                                        Zainul Arifin • 10:15 – 11:15
                                    </p>

                                    <p class="text-[11px] text-[#7A6A60] mt-2">
                                        Guru piket: Budi
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

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

                <form method="POST" action="{{ route('logout') }}">
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

    </script>

</body>

</html>
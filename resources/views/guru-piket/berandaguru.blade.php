<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Guru Piket</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        figtree: ['Figtree', 'sans-serif']
                    },
                    colors: {
                        cream: '#F8F5F1',
                        brown: '#3F2924',
                        brownText: '#4A342E',
                        green: '#258A3E',
                        greenLight: '#E8F5E9'
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Figtree', sans-serif;
        }

        body {
            margin: 0;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .menu-active {
            background: #258A3E;
            color: white !important;
        }

        .menu-active svg {
            color: white !important;
        }
    </style>
</head>

<body class="bg-[#F8F5F1] text-[#3F2924]">

<div class="flex min-h-screen">

    <!-- ===================================================== -->
    <!-- SIDEBAR -->
    <!-- ===================================================== -->

    <aside class="fixed left-0 top-0 z-40 h-screen w-[180px] bg-[#3F2924] text-white">

        <!-- Logo -->
        <div class="flex h-[78px] items-center gap-3 border-b border-white/10 px-5">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#238B3A]">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 text-white"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 12v5c3 2 11 2 14 0v-5"/>
                </svg>
            </div>

            <div class="leading-tight">
                <p class="text-[9px] font-medium uppercase tracking-wide text-white/80">
                    NUSA PORTAL
                </p>

                <p class="mt-0.5 text-[11px] font-bold text-white">
                    SMA N 1 Nusantara
                </p>
            </div>

        </div>


        <!-- Menu -->
        <nav class="px-4 py-5">

            <button
                onclick="showPage('dashboard', this)"
                class="menu-item menu-active flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium transition hover:bg-[#258A3E]"
            >

                <!-- Home -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 10.5L12 3l9 7.5"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 9.5V21h14V9.5"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 21v-6h6v6"/>
                </svg>

                Dashboard
            </button>


            <button
                onclick="showPage('jadwal', this)"
                class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-white/75 transition hover:bg-[#258A3E] hover:text-white"
            >

                <!-- Calendar -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="17" rx="2"/>
                    <path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>

                Jadwal Piket
            </button>


            <button
                onclick="showPage('absensi', this)"
                class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-white/75 transition hover:bg-[#258A3E] hover:text-white"
            >

                <!-- Users -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M22 21v-2a4 4 0 00-3-3.87"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16 3.13a4 4 0 010 7.75"/>
                </svg>

                Absensi Siswa
            </button>


            <button
                onclick="showPage('guru', this)"
                class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-white/75 transition hover:bg-[#258A3E] hover:text-white"
            >

                <!-- User -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <circle cx="12" cy="8" r="4"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 21a8 8 0 0116 0"/>
                </svg>

                Data Guru
            </button>


            <button
                onclick="showPage('laporan', this)"
                class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-white/75 transition hover:bg-[#258A3E] hover:text-white"
            >

                <!-- Document -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14 2v6h6"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8 13h8M8 17h5"/>
                </svg>

                Laporan
            </button>


            <button
                onclick="showPage('pengaturan', this)"
                class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-white/75 transition hover:bg-[#258A3E] hover:text-white"
            >

                <!-- Settings -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <circle cx="12" cy="12" r="3"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M19.4 15a1.7 1.7 0 000-6l-1.1-.6.1-1.3-1.7-1-1.1.7a8 8 0 00-2.1-.9L13.2 4h-2.4l-.3 1.9a8 8 0 00-2.1.9l-1.1-.7-1.7 1 .1 1.3L4.6 9a1.7 1.7 0 000 6l1.1.6-.1 1.3 1.7 1 1.1-.7c.7.4 1.4.7 2.1.9l.3 1.9h2.4l.3-1.9a8 8 0 002.1-.9l1.1.7 1.7-1-.1-1.3 1.1-.6z"/>
                </svg>

                Pengaturan
            </button>

        </nav>


        <!-- Logout -->
        <div class="absolute bottom-0 left-0 right-0 border-t border-white/10 p-4">

            <button class="flex w-full items-center gap-3 px-3 py-2 text-[11px] text-white/70 hover:text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10 17l5-5-5-5"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 12H3"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M21 19V5a2 2 0 00-2-2h-5"/>
                </svg>

                Keluar Sesi

            </button>

        </div>

    </aside>


    <!-- ===================================================== -->
    <!-- MAIN -->
    <!-- ===================================================== -->

    <main class="ml-[180px] min-h-screen flex-1">

        <!-- TOP HEADER -->
        <header class="flex h-[78px] items-center justify-between border-b border-[#E9E2DC] bg-white px-5">

            <div>
                <h1
                    id="pageTitle"
                    class="text-[14px] font-bold text-[#3F2924]"
                >
                    Dashboard Guru Piket
                </h1>
            </div>


            <div class="flex items-center gap-5">

                <!-- Date -->
                <div class="hidden text-right sm:block">

                    <p class="text-[10px] text-[#795548]">
                        Selasa, 9 September 2026 • 07:45 WIB
                    </p>

                </div>


                <!-- Notification -->
                <div class="relative">

                    <button class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FAF8F5]">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4 text-[#5D4037]"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M13.7 21a2 2 0 01-3.4 0"/>
                        </svg>

                    </button>

                    <span class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#D32F2F] text-[8px] font-bold text-white">
                        3
                    </span>

                </div>


                <!-- Profile -->
                <div class="flex items-center gap-2">

                    <div class="hidden text-right sm:block">

                        <p class="text-[10px] font-bold text-[#3F2924]">
                            Ibu Sari Dewi, S.Pd.
                        </p>

                        <p class="text-[8px] text-[#795548]">
                            Guru Piket
                        </p>

                    </div>

                    <div class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-[#E8F5E9]">

                        <span class="text-[10px] font-bold text-[#258A3E]">
                            SD
                        </span>

                    </div>

                </div>

            </div>

        </header>


        <!-- ================================================= -->
        <!-- PAGE CONTENT -->
        <!-- ================================================= -->

        <div class="p-5">


            <!-- ================= DASHBOARD ================= -->

            <section id="dashboard" class="page">

                <!-- Welcome -->
                <div class="mb-4">

                    <h2 class="text-[18px] font-bold text-[#3F2924]">
                        Selamat Datang, Guru Piket!
                    </h2>

                    <p class="mt-1 text-[10px] text-[#795548]">
                        Berikut ringkasan aktivitas hari ini di SMA Negeri 1 Nusantara.
                    </p>

                </div>


                <!-- ================= STAT CARD ================= -->

                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-4">

                    <!-- Hadir -->
                    <div class="rounded-lg border-l-[3px] border-[#258A3E] bg-white p-3 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-[9px] text-[#795548]">
                                    Siswa Hadir
                                </p>

                                <h3 class="mt-2 text-[22px] font-bold text-[#3F2924]">
                                    342
                                </h3>

                                <p class="text-[8px] text-[#8D7B74]">
                                    dari 380 siswa
                                </p>

                            </div>

                            <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E8F5E9]">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-3.5 w-3.5 text-[#258A3E]"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M17 11l2 2 4-4"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    <!-- Terlambat -->
                    <div class="rounded-lg border-l-[3px] border-[#F57C00] bg-white p-3 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-[9px] text-[#795548]">
                                    Siswa Terlambat
                                </p>

                                <h3 class="mt-2 text-[22px] font-bold text-[#3F2924]">
                                    12
                                </h3>

                                <p class="text-[8px] text-[#8D7B74]">
                                    hari ini
                                </p>

                            </div>

                            <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#FFF3E0]">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-3.5 w-3.5 text-[#F57C00]"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 7v5l3 2"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    <!-- Tidak Hadir -->
                    <div class="rounded-lg border-l-[3px] border-[#E53935] bg-white p-3 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-[9px] text-[#795548]">
                                    Siswa Tidak Hadir
                                </p>

                                <h3 class="mt-2 text-[22px] font-bold text-[#3F2924]">
                                    26
                                </h3>

                                <p class="text-[8px] text-[#8D7B74]">
                                    8 izin, 10 sakit, 8 alpa
                                </p>

                            </div>

                            <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#FFEBEE]">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-3.5 w-3.5 text-[#E53935]"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M8 8l8 8M16 8l-8 8"/>
                                </svg>

                            </div>

                        </div>

                    </div>


                    <!-- Guru Piket -->
                    <div class="rounded-lg border-l-[3px] border-[#1976D2] bg-white p-3 shadow-sm">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-[9px] text-[#795548]">
                                    Guru Piket
                                </p>

                                <h3 class="mt-2 text-[22px] font-bold text-[#3F2924]">
                                    4
                                </h3>

                                <p class="text-[8px] text-[#8D7B74]">
                                    bertugas hari ini
                                </p>

                            </div>

                            <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E3F2FD]">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-3.5 w-3.5 text-[#1976D2]"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <circle cx="12" cy="7" r="4"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M5 21a7 7 0 0114 0"/>
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ================= LOWER CARDS ================= -->

                <div class="mt-4 grid grid-cols-1 gap-4 xl:grid-cols-[1.45fr_1fr]">


                    <!-- JADWAL -->
                    <div class="rounded-lg bg-white p-4 shadow-sm">

                        <div class="mb-3 flex items-center justify-between">

                            <div>

                                <h3 class="text-[12px] font-bold text-[#3F2924]">
                                    Jadwal Piket Hari Ini
                                </h3>

                            </div>

                            <button
                                onclick="showPage('jadwal')"
                                class="text-[9px] font-semibold text-[#258A3E] hover:underline"
                            >
                                Selengkapnya →
                            </button>

                        </div>


                        <div class="space-y-1.5">


                            <!-- Jadwal 1 -->
                            <div class="flex items-center justify-between rounded-lg border border-[#F0EBE7] px-3 py-2">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E8F5E9] text-[9px] font-bold text-[#258A3E]">
                                        S
                                    </div>

                                    <div>

                                        <p class="text-[9px] font-semibold text-[#3F2924]">
                                            Ibu Sari Dewi, S.Pd.
                                        </p>

                                        <p class="text-[8px] text-[#8D7B74]">
                                            Sesi 1
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span class="text-[8px] text-[#5D4037]">
                                        06:30 – 08:00
                                    </span>

                                    <span class="rounded-full bg-[#E8F5E9] px-2 py-1 text-[7px] font-semibold text-[#258A3E]">
                                        Aktif
                                    </span>

                                </div>

                            </div>


                            <!-- Jadwal 2 -->
                            <div class="flex items-center justify-between rounded-lg border border-[#F0EBE7] px-3 py-2">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E8F5E9] text-[9px] font-bold text-[#258A3E]">
                                        A
                                    </div>

                                    <div>

                                        <p class="text-[9px] font-semibold text-[#3F2924]">
                                            Bpk. Ahmad Fauzi, M.Pd.
                                        </p>

                                        <p class="text-[8px] text-[#8D7B74]">
                                            Sesi 2
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span class="text-[8px] text-[#5D4037]">
                                        08:00 – 10:00
                                    </span>

                                    <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] font-semibold text-[#F57C00]">
                                        Menunggu
                                    </span>

                                </div>

                            </div>


                            <!-- Jadwal 3 -->
                            <div class="flex items-center justify-between rounded-lg border border-[#F0EBE7] px-3 py-2">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E8F5E9] text-[9px] font-bold text-[#258A3E]">
                                        R
                                    </div>

                                    <div>

                                        <p class="text-[9px] font-semibold text-[#3F2924]">
                                            Ibu Ratna Sari, S.Pd.
                                        </p>

                                        <p class="text-[8px] text-[#8D7B74]">
                                            Sesi 3
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span class="text-[8px] text-[#5D4037]">
                                        10:00 – 12:00
                                    </span>

                                    <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] font-semibold text-[#F57C00]">
                                        Menunggu
                                    </span>

                                </div>

                            </div>


                            <!-- Jadwal 4 -->
                            <div class="flex items-center justify-between rounded-lg border border-[#F0EBE7] px-3 py-2">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-7 w-7 items-center justify-center rounded-full bg-[#E8F5E9] text-[9px] font-bold text-[#258A3E]">
                                        D
                                    </div>

                                    <div>

                                        <p class="text-[9px] font-semibold text-[#3F2924]">
                                            Bpk. Dedi Kurniawan, S.Pd.
                                        </p>

                                        <p class="text-[8px] text-[#8D7B74]">
                                            Sesi 4
                                        </p>

                                    </div>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span class="text-[8px] text-[#5D4037]">
                                        12:00 – 14:00
                                    </span>

                                    <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] font-semibold text-[#F57C00]">
                                        Menunggu
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- AKTIVITAS -->
                    <div class="rounded-lg bg-white p-4 shadow-sm">

                        <h3 class="mb-4 text-[12px] font-bold text-[#3F2924]">
                            Aktivitas Terbaru
                        </h3>


                        <div class="relative pl-4">

                            <div class="absolute left-[4px] top-1 bottom-2 w-px bg-[#D7E8DA]"></div>


                            <!-- Aktivitas 1 -->
                            <div class="relative mb-4">

                                <span class="absolute -left-[14px] top-1 h-2 w-2 rounded-full bg-[#258A3E]"></span>

                                <p class="text-[8px] font-bold text-[#258A3E]">
                                    07:42 WIB
                                </p>

                                <p class="mt-1 text-[8px] text-[#5D4037]">
                                    Ibu Sari mencatat 5 siswa terlambat
                                </p>

                            </div>


                            <!-- Aktivitas 2 -->
                            <div class="relative mb-4">

                                <span class="absolute -left-[14px] top-1 h-2 w-2 rounded-full bg-[#258A3E]"></span>

                                <p class="text-[8px] font-bold text-[#258A3E]">
                                    07:30 WIB
                                </p>

                                <p class="mt-1 text-[8px] text-[#5D4037]">
                                    Ibu Sari memulai piket pagi
                                </p>

                            </div>


                            <!-- Aktivitas 3 -->
                            <div class="relative mb-4">

                                <span class="absolute -left-[14px] top-1 h-2 w-2 rounded-full bg-[#258A3E]"></span>

                                <p class="text-[8px] font-bold text-[#258A3E]">
                                    07:15 WIB
                                </p>

                                <p class="mt-1 text-[8px] text-[#5D4037]">
                                    Sistem mencatat kehadiran 320 siswa
                                </p>

                            </div>


                            <!-- Aktivitas 4 -->
                            <div class="relative">

                                <span class="absolute -left-[14px] top-1 h-2 w-2 rounded-full bg-[#258A3E]"></span>

                                <p class="text-[8px] font-bold text-[#258A3E]">
                                    06:30 WIB
                                </p>

                                <p class="mt-1 text-[8px] text-[#5D4037]">
                                    Jadwal piket hari ini dimulai
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ================= ABSENSI TERBARU ================= -->

                <div class="mt-4 rounded-lg bg-white p-4 shadow-sm">

                    <div class="mb-3 flex items-center justify-between">

                        <h3 class="text-[12px] font-bold text-[#3F2924]">
                            Absensi Siswa Terbaru
                        </h3>

                        <button class="rounded-md bg-[#FAF8F5] px-3 py-1.5 text-[8px] text-[#5D4037]">
                            Urutkan: Terbaru
                            <span class="ml-1">▼</span>
                        </button>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[650px] border-collapse">

                            <thead>

                                <tr class="bg-[#FAF8F5] text-left">

                                    <th class="rounded-l-md px-3 py-2 text-[8px] font-semibold text-[#795548]">
                                        No.
                                    </th>

                                    <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">
                                        Nama Siswa
                                    </th>

                                    <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">
                                        Kelas
                                    </th>

                                    <th class="px-3 py-2 text-[8px] font-semibold text-[#795548]">
                                        Jam Masuk
                                    </th>

                                    <th class="rounded-r-md px-3 py-2 text-[8px] font-semibold text-[#795548]">
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                <!-- Siswa 1 -->
                                <tr class="border-b border-[#F1ECE8]">

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        1
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] font-medium text-[#3F2924]">
                                        Andi Pratama
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        XII IPA 1
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        06:45
                                    </td>

                                    <td class="px-3 py-2.5">

                                        <span class="rounded-full bg-[#E8F5E9] px-2 py-1 text-[7px] font-semibold text-[#258A3E]">
                                            Hadir
                                        </span>

                                    </td>

                                </tr>


                                <!-- Siswa 2 -->
                                <tr class="border-b border-[#F1ECE8]">

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        2
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] font-medium text-[#3F2924]">
                                        Budi Santoso
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        XII IPS 2
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        06:50
                                    </td>

                                    <td class="px-3 py-2.5">

                                        <span class="rounded-full bg-[#E8F5E9] px-2 py-1 text-[7px] font-semibold text-[#258A3E]">
                                            Hadir
                                        </span>

                                    </td>

                                </tr>


                                <!-- Siswa 3 -->
                                <tr class="border-b border-[#F1ECE8]">

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        3
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] font-medium text-[#3F2924]">
                                        Citra Dewi
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        XII IPA 3
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        07:15
                                    </td>

                                    <td class="px-3 py-2.5">

                                        <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] font-semibold text-[#F57C00]">
                                            Terlambat
                                        </span>

                                    </td>

                                </tr>


                                <!-- Siswa 4 -->
                                <tr class="border-b border-[#F1ECE8]">

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        4
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] font-medium text-[#3F2924]">
                                        Dian Permata
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        XII IPS 1
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        07:20
                                    </td>

                                    <td class="px-3 py-2.5">

                                        <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] font-semibold text-[#F57C00]">
                                            Terlambat
                                        </span>

                                    </td>

                                </tr>


                                <!-- Siswa 5 -->
                                <tr>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        5
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] font-medium text-[#3F2924]">
                                        Eka Putri
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        XII IPA 1
                                    </td>

                                    <td class="px-3 py-2.5 text-[8px] text-[#5D4037]">
                                        —
                                    </td>

                                    <td class="px-3 py-2.5">

                                        <span class="rounded-full bg-[#FFEBEE] px-2 py-1 text-[7px] font-semibold text-[#E53935]">
                                            Tidak Hadir
                                        </span>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>


                    <div class="mt-3 flex items-center justify-between">

                        <p class="text-[8px] text-[#8D7B74]">
                            Menampilkan 5 siswa terakhir yang dicatat
                        </p>

                        <button
                            onclick="showPage('absensi')"
                            class="rounded-md bg-[#E8F5E9] px-3 py-2 text-[8px] font-semibold text-[#258A3E]"
                        >
                            Lihat Semua Siswa →
                        </button>

                    </div>

                </div>

            </section>


            <!-- ================= JADWAL ================= -->

            <section id="jadwal" class="page hidden">

                <h2 class="text-[18px] font-bold">
                    Jadwal Piket
                </h2>

                <p class="mt-1 text-[10px] text-[#795548]">
                    Daftar jadwal guru piket.
                </p>

                <div class="mt-5 rounded-lg bg-white p-5 shadow-sm">

                    <h3 class="text-[13px] font-bold">
                        Jadwal Piket Hari Ini
                    </h3>

                    <div class="mt-4 space-y-3">

                        <div class="flex items-center justify-between rounded-lg border p-4">
                            <div>
                                <p class="text-[11px] font-semibold">
                                    Ibu Sari Dewi, S.Pd.
                                </p>
                                <p class="text-[9px] text-gray-500">
                                    Sesi 1
                                </p>
                            </div>

                            <span class="text-[9px]">
                                06:30 – 08:00
                            </span>

                            <span class="rounded-full bg-[#E8F5E9] px-3 py-1 text-[8px] text-[#258A3E]">
                                Aktif
                            </span>
                        </div>


                        <div class="flex items-center justify-between rounded-lg border p-4">
                            <div>
                                <p class="text-[11px] font-semibold">
                                    Bpk. Ahmad Fauzi, M.Pd.
                                </p>
                                <p class="text-[9px] text-gray-500">
                                    Sesi 2
                                </p>
                            </div>

                            <span class="text-[9px]">
                                08:00 – 10:00
                            </span>

                            <span class="rounded-full bg-[#FFF3E0] px-3 py-1 text-[8px] text-[#F57C00]">
                                Menunggu
                            </span>
                        </div>


                        <div class="flex items-center justify-between rounded-lg border p-4">
                            <div>
                                <p class="text-[11px] font-semibold">
                                    Ibu Ratna Sari, S.Pd.
                                </p>
                                <p class="text-[9px] text-gray-500">
                                    Sesi 3
                                </p>
                            </div>

                            <span class="text-[9px]">
                                10:00 – 12:00
                            </span>

                            <span class="rounded-full bg-[#FFF3E0] px-3 py-1 text-[8px] text-[#F57C00]">
                                Menunggu
                            </span>
                        </div>


                        <div class="flex items-center justify-between rounded-lg border p-4">
                            <div>
                                <p class="text-[11px] font-semibold">
                                    Bpk. Dedi Kurniawan, S.Pd.
                                </p>
                                <p class="text-[9px] text-gray-500">
                                    Sesi 4
                                </p>
                            </div>

                            <span class="text-[9px]">
                                12:00 – 14:00
                            </span>

                            <span class="rounded-full bg-[#FFF3E0] px-3 py-1 text-[8px] text-[#F57C00]">
                                Menunggu
                            </span>
                        </div>

                    </div>

                </div>

            </section>


            <!-- ================= ABSENSI ================= -->

            <section id="absensi" class="page hidden">

                <h2 class="text-[18px] font-bold">
                    Absensi Siswa
                </h2>

                <p class="mt-1 text-[10px] text-[#795548]">
                    Data kehadiran siswa hari ini.
                </p>


                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-3">

                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-[10px] text-gray-500">Hadir</p>
                        <p class="mt-2 text-3xl font-bold text-[#258A3E]">342</p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-[10px] text-gray-500">Terlambat</p>
                        <p class="mt-2 text-3xl font-bold text-[#F57C00]">12</p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-[10px] text-gray-500">Tidak Hadir</p>
                        <p class="mt-2 text-3xl font-bold text-[#E53935]">26</p>
                    </div>

                </div>


                <div class="mt-5 rounded-lg bg-white p-5 shadow-sm">

                    <h3 class="text-[13px] font-bold">
                        Data Absensi
                    </h3>

                    <div class="mt-4 overflow-x-auto">

                        <table class="w-full min-w-[600px] text-left">

                            <thead class="bg-[#FAF8F5]">

                                <tr>
                                    <th class="p-3 text-[9px]">No</th>
                                    <th class="p-3 text-[9px]">Nama Siswa</th>
                                    <th class="p-3 text-[9px]">Kelas</th>
                                    <th class="p-3 text-[9px]">Jam</th>
                                    <th class="p-3 text-[9px]">Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                <tr class="border-b">
                                    <td class="p-3 text-[9px]">1</td>
                                    <td class="p-3 text-[9px]">Andi Pratama</td>
                                    <td class="p-3 text-[9px]">XII IPA 1</td>
                                    <td class="p-3 text-[9px]">06:45</td>
                                    <td class="p-3">
                                        <span class="rounded-full bg-[#E8F5E9] px-2 py-1 text-[7px] text-[#258A3E]">
                                            Hadir
                                        </span>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <td class="p-3 text-[9px]">2</td>
                                    <td class="p-3 text-[9px]">Budi Santoso</td>
                                    <td class="p-3 text-[9px]">XII IPS 2</td>
                                    <td class="p-3 text-[9px]">06:50</td>
                                    <td class="p-3">
                                        <span class="rounded-full bg-[#E8F5E9] px-2 py-1 text-[7px] text-[#258A3E]">
                                            Hadir
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3 text-[9px]">3</td>
                                    <td class="p-3 text-[9px]">Citra Dewi</td>
                                    <td class="p-3 text-[9px]">XII IPA 3</td>
                                    <td class="p-3 text-[9px]">07:15</td>
                                    <td class="p-3">
                                        <span class="rounded-full bg-[#FFF3E0] px-2 py-1 text-[7px] text-[#F57C00]">
                                            Terlambat
                                        </span>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </section>

<!-- ================= DATA GURU ================= -->

<section id="guru" class="page hidden">

    <!-- Judul -->
    <div class="mb-5">

        <h2 class="text-[18px] font-bold text-[#3F2924]">
            Data Guru
        </h2>

        <p class="mt-1 text-[10px] text-[#795548]">
            Daftar guru yang bertugas sebagai guru piket dan guru yang sedang izin atau sakit.
        </p>

    </div>


    <!-- ================================================= -->
    <!-- RINGKASAN GURU -->
    <!-- ================================================= -->

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <!-- Total Guru -->
        <div class="rounded-lg bg-white p-4 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-[9px] text-[#795548]">
                        Total Guru
                    </p>

                    <p class="mt-2 text-2xl font-bold text-[#3F2924]">
                        12
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5EFE8]">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4 text-[#3F2924]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <circle cx="9" cy="7" r="4"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3 21a6 6 0 0112 0"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16 11a4 4 0 013 3.87"/>

                    </svg>

                </div>

            </div>

        </div>


        <!-- Guru Hadir -->
        <div class="rounded-lg bg-white p-4 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-[9px] text-[#795548]">
                        Guru Hadir
                    </p>

                    <p class="mt-2 text-2xl font-bold text-[#3F2924]">
                        10
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#F5EFE8]">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4 text-[#3F2924]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

            </div>

        </div>


        <!-- Guru Izin -->
        <div class="rounded-lg bg-white p-4 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-[9px] text-[#795548]">
                        Guru Izin
                    </p>

                    <p class="mt-2 text-2xl font-bold text-[#F57C00]">
                        1
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FFF3E0]">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4 text-[#F57C00]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 7v5l3 2"/>

                    </svg>

                </div>

            </div>

        </div>


        <!-- Guru Sakit -->
        <div class="rounded-lg bg-white p-4 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-[9px] text-[#795548]">
                        Guru Sakit
                    </p>

                    <p class="mt-2 text-2xl font-bold text-[#E53935]">
                        1
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FFEBEE]">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4 text-[#E53935]"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 9v4"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 17h.01"/>
                        <circle cx="12" cy="12" r="9"/>

                    </svg>

                </div>

            </div>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- GURU YANG BERTUGAS -->
    <!-- ================================================= -->

    <div class="mt-5 rounded-lg bg-white p-5 shadow-sm">

        <div class="mb-4">

            <h3 class="text-[13px] font-bold text-[#3F2924]">
                Guru yang Bertugas
            </h3>

            <p class="mt-1 text-[9px] text-[#795548]">
                Daftar guru yang hadir dan bertugas sebagai guru piket.
            </p>

        </div>


        <!-- Responsive Card -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">


            <!-- Guru 1 -->
            <div class="rounded-lg border border-[#F0EBE7] p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#F5EFE8] text-[11px] font-bold text-[#3F2924]">
                        SD
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-[10px] font-bold text-[#3F2924]">
                            Ibu Sari Dewi, S.Pd.
                        </p>

                        <p class="mt-1 text-[8px] text-[#795548]">
                            Guru Piket
                        </p>

                    </div>

                </div>

                <div class="mt-3 flex items-center justify-between">

                    <span class="text-[8px] text-[#795548]">
                        Sesi 1
                    </span>

                    <span class="rounded-full bg-[#F5EFE8] px-2 py-1 text-[7px] font-semibold text-[#3F2924]">
                        Hadir
                    </span>

                </div>

            </div>


            <!-- Guru 2 -->
            <div class="rounded-lg border border-[#F0EBE7] p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#E3F2FD] text-[11px] font-bold text-[#1976D2]">
                        AF
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-[10px] font-bold text-[#3F2924]">
                            Bpk. Ahmad Fauzi, M.Pd.
                        </p>

                        <p class="mt-1 text-[8px] text-[#795548]">
                            Guru Piket
                        </p>

                    </div>

                </div>

                <div class="mt-3 flex items-center justify-between">

                    <span class="text-[8px] text-[#795548]">
                        Sesi 2
                    </span>

                    <span class="rounded-full bg-[#F5EFE8] px-2 py-1 text-[7px] font-semibold text-[#3F2924]">
                        Hadir
                    </span>

                </div>

            </div>


            <!-- Guru 3 -->
            <div class="rounded-lg border border-[#F0EBE7] p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#E3F2FD] text-[11px] font-bold text-[#1976D2]">
                        AW
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-[10px] font-bold text-[#3F2924]">
                            Bpk. Andi Wijaya
                        </p>

                        <p class="mt-1 text-[8px] text-[#795548]">
                            Guru Pengganti
                        </p>

                    </div>

                </div>

                <div class="mt-3 flex items-center justify-between">

                    <span class="text-[8px] text-[#795548]">
                        Sesi 3
                    </span>

                    <span class="rounded-full bg-[#F5EFE8] px-2 py-1 text-[7px] font-semibold text-[#3F2924]">
                        Bertugas
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- GURU IZIN / SAKIT -->
    <!-- ================================================= -->

    <div class="mt-5 rounded-lg bg-white p-5 shadow-sm">

        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h3 class="text-[13px] font-bold text-[#3F2924]">
                    Guru Izin / Sakit
                </h3>

                <p class="mt-1 text-[9px] text-[#795548]">
                    Daftar guru yang tidak dapat bertugas hari ini.
                </p>

            </div>


            <div class="flex gap-2">

                <span class="rounded-full bg-[#FFF3E0] px-3 py-1.5 text-[7px] font-semibold text-[#F57C00]">
                    1 Izin
                </span>

                <span class="rounded-full bg-[#FFEBEE] px-3 py-1.5 text-[7px] font-semibold text-[#E53935]">
                    1 Sakit
                </span>

            </div>

        </div>


        <!-- Tabel dibuat bisa scroll di HP -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[650px] border-collapse">

                <thead>

                    <tr class="bg-[#FAF8F5] text-left">

                        <th class="rounded-l-md px-3 py-2.5 text-[8px] font-semibold text-[#795548]">
                            Nama Guru
                        </th>

                        <th class="px-3 py-2.5 text-[8px] font-semibold text-[#795548]">
                            Status
                        </th>

                        <th class="px-3 py-2.5 text-[8px] font-semibold text-[#795548]">
                            Alasan
                        </th>

                        <th class="px-3 py-2.5 text-[8px] font-semibold text-[#795548]">
                            Guru Pengganti
                        </th>

                        <th class="rounded-r-md px-3 py-2.5 text-[8px] font-semibold text-[#795548]">
                            Keterangan
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <!-- Guru Izin -->

                    <tr class="border-b border-[#F1ECE8]">

                        <td class="px-3 py-3">

                            <p class="text-[8px] font-semibold text-[#3F2924]">
                                Ibu Ratna Sari, S.Pd.
                            </p>

                            <p class="mt-1 text-[7px] text-[#8D7B74]">
                                Guru Piket
                            </p>

                        </td>


                        <td class="px-3 py-3">

                            <span class="rounded-full bg-[#FFF3E0] px-2.5 py-1 text-[7px] font-semibold text-[#F57C00]">
                                Izin
                            </span>

                        </td>


                        <td class="px-3 py-3 text-[8px] text-[#5D4037]">
                            Keperluan keluarga
                        </td>


                        <td class="px-3 py-3 text-[8px] text-[#5D4037]">
                            Bpk. Andi Wijaya
                        </td>


                        <td class="px-3 py-3 text-[8px] text-[#795548]">
                            Digantikan
                        </td>

                    </tr>


                    <!-- Guru Sakit -->

                    <tr>

                        <td class="px-3 py-3">

                            <p class="text-[8px] font-semibold text-[#3F2924]">
                                Bpk. Dedi Kurniawan, S.Pd.
                            </p>

                            <p class="mt-1 text-[7px] text-[#8D7B74]">
                                Guru Piket
                            </p>

                        </td>


                        <td class="px-3 py-3">

                            <span class="rounded-full bg-[#FFEBEE] px-2.5 py-1 text-[7px] font-semibold text-[#E53935]">
                                Sakit
                            </span>

                        </td>


                        <td class="px-3 py-3 text-[8px] text-[#5D4037]">
                            Kondisi kurang sehat
                        </td>


                        <td class="px-3 py-3 text-[8px] text-[#5D4037]">
                            Ibu Lina Marlina
                        </td>


                        <td class="px-3 py-3 text-[8px] text-[#795548]">
                            Digantikan
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        <!-- Informasi -->
        <div class="mt-4 rounded-md bg-[#FAF8F5] p-3">

            <div class="flex items-start gap-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="mt-0.5 h-4 w-4 shrink-0 text-[#795548]"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <circle cx="12" cy="12" r="9"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 11v5"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 8h.01"/>

                </svg>

                <p class="text-[8px] leading-4 text-[#795548]">
                    Guru yang berstatus izin atau sakit akan digantikan oleh guru pengganti
                    agar kegiatan piket tetap berjalan.
                </p>

            </div>

        </div>

    </div>

</section>

            <!-- ================= LAPORAN ================= -->

            <section id="laporan" class="page hidden">

                <h2 class="text-[18px] font-bold">
                    Laporan
                </h2>

                <p class="mt-1 text-[10px] text-[#795548]">
                    Rekapitulasi kegiatan guru piket dan absensi siswa.
                </p>


                <div class="mt-5 rounded-lg bg-white p-5 shadow-sm">

                    <div class="grid grid-cols-1 gap-3 md:grid-cols-3">

                        <div>
                            <label class="text-[9px] font-medium">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                value="2026-09-09"
                                class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[9px] outline-none focus:border-[#258A3E]"
                            >
                        </div>


                        <div>
                            <label class="text-[9px] font-medium">
                                Kelas
                            </label>

                            <select class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[9px] outline-none focus:border-[#258A3E]">

                                <option>Semua Kelas</option>
                                <option>XII IPA 1</option>
                                <option>XII IPA 2</option>
                                <option>XII IPS 1</option>

                            </select>

                        </div>


                        <div class="flex items-end">

                            <button class="w-full rounded-md bg-[#258A3E] px-4 py-2 text-[9px] font-semibold text-white hover:bg-[#1F7434]">
                                Tampilkan Laporan
                            </button>

                        </div>

                    </div>

                </div>


                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">

                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-[9px] text-gray-500">
                            Total Hadir
                        </p>
                        <p class="mt-2 text-2xl font-bold text-[#258A3E]">
                            342
                        </p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-[9px] text-gray-500">
                            Total Terlambat
                        </p>
                        <p class="mt-2 text-2xl font-bold text-[#F57C00]">
                            12
                        </p>
                    </div>

                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-[9px] text-gray-500">
                            Total Tidak Hadir
                        </p>
                        <p class="mt-2 text-2xl font-bold text-[#E53935]">
                            26
                        </p>
                    </div>

                </div>

            </section>


            <!-- ================= PENGATURAN ================= -->

            <section id="pengaturan" class="page hidden">

                <h2 class="text-[18px] font-bold">
                    Pengaturan
                </h2>

                <p class="mt-1 text-[10px] text-[#795548]">
                    Atur informasi dan preferensi sistem guru piket.
                </p>


                <div class="mt-5 grid grid-cols-1 gap-4 xl:grid-cols-2">


                    <!-- Profil -->
                    <div class="rounded-lg bg-white p-5 shadow-sm">

                        <h3 class="text-[13px] font-bold">
                            Profil Guru
                        </h3>

                        <p class="mt-1 text-[9px] text-gray-500">
                            Informasi akun guru piket.
                        </p>


                        <div class="mt-5">

                            <label class="text-[9px] font-medium">
                                Nama
                            </label>

                            <input
                                type="text"
                                value="Ibu Sari Dewi, S.Pd."
                                class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[9px] outline-none focus:border-[#258A3E]"
                            >

                        </div>


                        <div class="mt-3">

                            <label class="text-[9px] font-medium">
                                Email
                            </label>

                            <input
                                type="email"
                                value="sari@example.com"
                                class="mt-1 w-full rounded-md border border-[#E4DDD8] px-3 py-2 text-[9px] outline-none focus:border-[#258A3E]"
                            >

                        </div>


                        <button class="mt-4 rounded-md bg-[#258A3E] px-4 py-2 text-[9px] font-semibold text-white">
                            Simpan Perubahan
                        </button>

                    </div>


                    <!-- Sistem -->
                    <div class="rounded-lg bg-white p-5 shadow-sm">

                        <h3 class="text-[13px] font-bold">
                            Pengaturan Sistem
                        </h3>

                        <p class="mt-1 text-[9px] text-gray-500">
                            Pengaturan tampilan dan notifikasi.
                        </p>


                        <div class="mt-5 flex items-center justify-between">

                            <div>

                                <p class="text-[10px] font-semibold">
                                    Notifikasi
                                </p>

                                <p class="text-[8px] text-gray-500">
                                    Terima pemberitahuan aktivitas
                                </p>

                            </div>

                            <button
                                onclick="toggleSwitch(this)"
                                class="switch relative h-5 w-9 rounded-full bg-[#258A3E]"
                            >

                                <span class="absolute right-1 top-1 h-3 w-3 rounded-full bg-white transition"></span>

                            </button>

                        </div>


                        <div class="mt-5 flex items-center justify-between">

                            <div>

                                <p class="text-[10px] font-semibold">
                                    Pengingat Jadwal
                                </p>

                                <p class="text-[8px] text-gray-500">
                                    Ingatkan sebelum jadwal piket
                                </p>

                            </div>

                            <button
                                onclick="toggleSwitch(this)"
                                class="switch relative h-5 w-9 rounded-full bg-[#258A3E]"
                            >

                                <span class="absolute right-1 top-1 h-3 w-3 rounded-full bg-white transition"></span>

                            </button>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>

</div>


<!-- ===================================================== -->
<!-- JAVASCRIPT -->
<!-- ===================================================== -->

<script>

    function showPage(pageId, button = null) {

        // Ambil semua halaman
        const pages = document.querySelectorAll('.page');

        // Sembunyikan semua halaman
        pages.forEach(page => {
            page.classList.add('hidden');
        });

        // Tampilkan halaman yang dipilih
        const selectedPage = document.getElementById(pageId);

        if (selectedPage) {
            selectedPage.classList.remove('hidden');
        }


        // Hilangkan menu aktif dari semua menu
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {

            item.classList.remove('menu-active');

            item.classList.add('text-white/75');

        });


        // Jika menu diklik
        if (button) {

            button.classList.add('menu-active');

            button.classList.remove('text-white/75');

        }


        // Judul halaman
        const titles = {

            dashboard: 'Dashboard Guru Piket',

            jadwal: 'Jadwal Piket',

            absensi: 'Absensi Siswa',

            guru: 'Data Guru',

            laporan: 'Laporan',

            pengaturan: 'Pengaturan'

        };


        const pageTitle = document.getElementById('pageTitle');

        if (pageTitle) {

            pageTitle.textContent = titles[pageId];

        }

    }


    function toggleSwitch(button) {

        const circle = button.querySelector('span');

        if (button.classList.contains('bg-[#258A3E]')) {

            button.classList.remove('bg-[#258A3E]');

            button.classList.add('bg-gray-300');

            circle.classList.remove('right-1');

            circle.classList.add('left-1');

        } else {

            button.classList.remove('bg-gray-300');

            button.classList.add('bg-[#258A3E]');

            circle.classList.remove('left-1');

            circle.classList.add('right-1');

        }

    }


    // Dashboard tampil pertama kali
    document.addEventListener('DOMContentLoaded', function () {

        const dashboard = document.getElementById('dashboard');

        dashboard.classList.remove('hidden');

    });

</script>

</body>
</html>
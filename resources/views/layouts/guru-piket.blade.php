<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Guru Piket')</title>

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
            background: #F5EFE8;
            color: #3F2924 !important;
        }

        .menu-active svg {
            color: #3F2924 !important;
        }
    </style>

    @yield('head')
</head>

<body class="bg-[#F8F5F1] text-[#3F2924]">

    <div class="flex min-h-screen">

        <!-- ===================================================== -->
        <!-- SIDEBAR -->
        <!-- ===================================================== -->

        <aside class="fixed left-0 top-0 z-40 h-screen w-[180px] bg-white text-[#3F2924] border-r border-[#EFE8E2]">

            <!-- Logo -->
            <div class="flex h-[78px] items-center gap-3 border-b border-[#EFE8E2] px-5">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#238B3A]">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12v5c3 2 11 2 14 0v-5" />
                    </svg>
                </div>

                <div class="leading-tight">
                    <p class="text-[9px] font-medium uppercase tracking-wide text-[#8D7B74]">
                        NUSA PORTAL
                    </p>

                    <p class="mt-0.5 text-[11px] font-bold text-[#3F2924]">
                        SMA N 1 Nusantara
                    </p>
                </div>

            </div>


            <!-- Menu -->
            <nav class="px-4 py-5">

                <a href="{{ route('home') }}"
                    class="menu-item {{ request()->routeIs('home') ? 'menu-active' : 'text-[#8D7B74]' }} flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- Home -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 10.5L12 3l9 7.5" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 9.5V21h14V9.5" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 21v-6h6v6" />
                    </svg>

                    Dashboard
                </a>


                <button
                    onclick="showPage('jadwal', this)"
                    class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-[#8D7B74] transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- Calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <rect x="3" y="4" width="18" height="17" rx="2" />
                        <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>

                    Jadwal Piket
                </button>


                <button
                    onclick="showPage('absensi', this)"
                    class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-[#8D7B74] transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- Users -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 21v-2a4 4 0 00-3-3.87" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 3.13a4 4 0 010 7.75" />
                    </svg>

                    Absensi Siswa
                </button>



                <a href="{{ route('dispen.index') }}"
                    class="menu-item {{ request()->routeIs('dispen.*') ? 'menu-active' : 'text-[#8D7B74]' }} mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- Send / Surat -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 2L11 13" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M22 2l-7 20-4-9-9-4 20-7z" />
                    </svg>

                    Dispen
                </a>


                <button
                    onclick="gotoPage('guru', this)"
                    class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-[#8D7B74] transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- User -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <circle cx="12" cy="8" r="4" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 21a8 8 0 0116 0" />
                    </svg>

                    Data Guru
                </button>


                <button
                    onclick="gotoPage('laporan', this)"
                    class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-[#8D7B74] transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- Document -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14 2v6h6" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 13h8M8 17h5" />
                    </svg>

                    Laporan
                </button>


                <button
                    onclick="gotoPage('pengaturan', this)"
                    class="menu-item mt-2 flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-[11px] font-medium text-[#8D7B74] transition hover:bg-[#F5EFE8] hover:text-[#3F2924]">

                    <!-- Settings -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <circle cx="12" cy="12" r="3" />
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.4 15a1.7 1.7 0 000-6l-1.1-.6.1-1.3-1.7-1-1.1.7a8 8 0 00-2.1-.9L13.2 4h-2.4l-.3 1.9a8 8 0 00-2.1.9l-1.1-.7-1.7 1 .1 1.3L4.6 9a1.7 1.7 0 000 6l1.1.6-.1 1.3 1.7 1 1.1-.7c.7.4 1.4.7 2.1.9l.3 1.9h2.4l.3-1.9a8 8 0 002.1-.9l1.1.7 1.7-1-.1-1.3 1.1-.6z" />
                    </svg>

                    Pengaturan
                </button>

            </nav>


            <!-- Logout -->
            <div class="absolute bottom-0 left-0 right-0 border-t border-[#EFE8E2] p-4">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 text-[11px] text-[#8D7B74] hover:text-[#3F2924]">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10 17l5-5-5-5" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12H3" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 19V5a2 2 0 00-2-2h-5" />
                        </svg>

                        Keluar Sesi

                    </button>
                </form>
            </div>

        </aside>


        <!-- ===================================================== -->
        <!-- MAIN -->
        <!-- ===================================================== -->

        <main class="ml-[180px] min-h-screen flex-1">

            <!-- TOP HEADER -->
            <header class="flex h-[78px] items-center justify-between border-b border-[#2F1F1B] bg-[#3F2924] px-5">

                <div>
                    <h1
                        id="pageTitle"
                        class="text-[14px] font-bold text-white">
                        @yield('title', 'Dashboard Guru Piket')
                    </h1>
                </div>


                <div class="flex items-center gap-5">

                    <!-- Date -->
                    <div class="hidden text-right sm:block">

                        <p class="text-[10px] text-white/70">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }} • {{ now()->format('H:i') }} WIB
                        </p>

                    </div>


                    <!-- Notification -->
                    <div class="relative">

                        <button class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 8a6 6 0 00-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" />
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.7 21a2 2 0 01-3.4 0" />
                            </svg>

                        </button>

                        <span class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-[#D32F2F] text-[8px] font-bold text-white">
                            3
                        </span>

                    </div>


                    <!-- Profile -->
                    <div class="flex items-center gap-2">

                        <div class="hidden text-right sm:block">

                            <p class="text-[10px] font-bold text-white">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-[8px] text-white/70">
                                Guru Piket
                            </p>

                        </div>

                        <div class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-[#E8F5E9]">

                            <span class="text-[10px] font-bold text-[#258A3E]">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </span>

                        </div>

                    </div>

                </div>

            </header>


            <!-- ================================================= -->
            <!-- PAGE CONTENT -->
            <!-- ================================================= -->

            <div class="p-5">
                @yield('content')
            </div>

        </main>

    </div>


    <!-- ===================================================== -->
    <!-- JAVASCRIPT BERSAMA (tab switching dashboard) -->
    <!-- ===================================================== -->

    <script>
        function showPage(pageId, button = null) {

            const pages = document.querySelectorAll('.page');
            pages.forEach(page => page.classList.add('hidden'));

            const selectedPage = document.getElementById(pageId);
            if (selectedPage) {
                selectedPage.classList.remove('hidden');
            }

            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.classList.remove('menu-active');
                item.classList.add('text-[#8D7B74]');
            });

            if (button) {
                button.classList.add('menu-active');
                button.classList.remove('text-[#8D7B74]');
            }

            const titles = {
                dashboard: 'Dashboard Guru Piket',
                jadwal: 'Jadwal Piket',
                absensi: 'Absensi Siswa',
                guru: 'Data Guru',
                laporan: 'Laporan',
                pengaturan: 'Pengaturan'
            };

            const pageTitle = document.getElementById('pageTitle');
            if (pageTitle && titles[pageId]) {
                pageTitle.textContent = titles[pageId];
            }
        }

        // Menu yang "pintar": kalau section-nya ADA di halaman ini, switch tab biasa.
        // Kalau TIDAK ADA (misal lagi di halaman Dispen), pindah ke dashboard dulu.
        function gotoPage(pageId, button) {
            const targetExists = document.getElementById(pageId);

            if (targetExists) {
                showPage(pageId, button);
            } else {
                window.location.href = "{{ route('dashboard-guru-piket') }}?tab=" + pageId;
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

        document.addEventListener('DOMContentLoaded', function() {
            const dashboard = document.getElementById('dashboard');
            if (!dashboard) return; // bukan di halaman dashboard, lewati logic tab

            dashboard.classList.remove('hidden');

            // Cek apakah URL bawa parameter ?tab=xxx (dari navigasi balik menu lain)
            const params = new URLSearchParams(window.location.search);
            const tab = params.get('tab');

            if (tab && document.getElementById(tab)) {
                const button = document.querySelector(`[data-page="${tab}"]`);
                showPage(tab, button);
            }
        });
    </script>

    @yield('scripts')

</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekap Jurnal</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full min-h-screen bg-[#F5EFE8] text-[#3E3028]">

    <div class="w-full min-h-screen flex flex-col">

        <!-- HEADER -->
        <header class="w-full h-12 px-4 flex items-center justify-between border-b border-[#E5D8CC]">

            <div class="w-8 h-8"></div>

            <h1 class="text-base font-semibold text-center">
                Rekap Jurnal
            </h1>

            <div class="w-8 h-8"></div>

        </header>


        <!-- CONTENT -->
        <main class="flex-1 w-full p-4 flex flex-col gap-4">


            <!-- =========================
                 FILTER
            ========================== -->

            <section class="w-full p-3 bg-white border border-[#E5D8CC] rounded-lg flex flex-col gap-2.5">

                <h2 class="text-[13px] leading-4 font-semibold">
                    Filter Tanggal & Kelas
                </h2>

                <div class="w-full flex gap-2">

                    <!-- TANGGAL -->
                    <div class="flex-1 h-8 px-2.5 bg-[#F5EFE8] rounded-md flex items-center">

                        <span class="text-[11px] text-[#7A6A60]">
                            01-07-2026
                        </span>

                    </div>


                    <!-- KELAS -->
                    <div class="flex-1 h-8 px-2.5 bg-[#F5EFE8] rounded-md flex items-center">

                        <span class="text-[11px] text-[#7A6A60]">
                            Semua Kelas
                        </span>

                    </div>

                </div>

            </section>


            <!-- =========================
                 STATISTIK
            ========================== -->

            <section class="w-full flex gap-2">


                <!-- TOTAL -->
                <div class="flex-1 h-[61px] p-2.5 bg-white border border-[#E5D8CC] rounded-lg flex flex-col items-center justify-center gap-1">

                    <span class="text-[11px] font-semibold text-[#7A6A60]">
                        Total
                    </span>

                    <span class="text-xl leading-6 font-extrabold text-[#3E3028]">
                        12
                    </span>

                </div>


                <!-- VALID -->
                <div class="flex-1 h-[61px] p-2.5 bg-[#E8F5E9] border border-[#E5D8CC] rounded-lg flex flex-col items-center justify-center gap-1">

                    <span class="text-[11px] font-semibold text-[#7A6A60]">
                        Valid
                    </span>

                    <span class="text-xl leading-6 font-extrabold text-[#2E7D32]">
                        10
                    </span>

                </div>


                <!-- PENDING -->
                <div class="flex-1 h-[61px] p-2.5 bg-[#FFFDE7] border border-[#E5D8CC] rounded-lg flex flex-col items-center justify-center gap-1">

                    <span class="text-[11px] font-semibold text-[#7A6A60]">
                        Pending
                    </span>

                    <span class="text-xl leading-6 font-extrabold text-[#F57F17]">
                        1
                    </span>

                </div>


                <!-- BATAL -->
                <div class="flex-1 h-[61px] p-2.5 bg-[#FFEBEE] border border-[#E5D8CC] rounded-lg flex flex-col items-center justify-center gap-1">

                    <span class="text-[11px] font-semibold text-[#7A6A60]">
                        Batal
                    </span>

                    <span class="text-xl leading-6 font-extrabold text-[#C62828]">
                        1
                    </span>

                </div>

            </section>


            <!-- =========================
                 TABEL JURNAL
            ========================== -->

            <section class="w-full bg-white border border-[#E5D8CC] rounded-lg p-3 overflow-x-auto">

                <div class="min-w-[600px]">

                    <!-- HEADER TABEL -->
                    <div class="grid grid-cols-[80px_1fr_50px_70px] gap-2 pb-1.5 border-b border-[#E5D8CC]">

                        <span class="text-[11px] font-bold text-[#7A6A60]">
                            Kelas
                        </span>

                        <span class="text-[11px] font-bold text-[#7A6A60]">
                            Mapel
                        </span>

                        <span class="text-[11px] font-bold text-[#7A6A60] text-center">
                            Jam
                        </span>

                        <span class="text-[11px] font-bold text-[#7A6A60] text-right">
                            Status
                        </span>

                    </div>


                    <!-- DATA 1 -->
                    <div class="grid grid-cols-[80px_1fr_50px_70px] gap-2 items-center py-1">

                        <span class="text-xs font-semibold">
                            X RPL 1
                        </span>

                        <span class="text-xs text-[#7A6A60]">
                            Matematika
                        </span>

                        <span class="text-xs text-center">
                            4 JP
                        </span>

                        <div class="flex justify-end">

                            <span class="px-1.5 py-0.5 bg-[#E8F5E9] rounded text-[9px] font-bold text-[#2E7D32]">
                                Valid
                            </span>

                        </div>

                    </div>


                    <!-- DATA 2 -->
                    <div class="grid grid-cols-[80px_1fr_50px_70px] gap-2 items-center py-1">

                        <span class="text-xs font-semibold">
                            X RPL 2
                        </span>

                        <span class="text-xs text-[#7A6A60]">
                            Matematika
                        </span>

                        <span class="text-xs text-center">
                            4 JP
                        </span>

                        <div class="flex justify-end">

                            <span class="px-1.5 py-0.5 bg-[#E8F5E9] rounded text-[9px] font-bold text-[#2E7D32]">
                                Valid
                            </span>

                        </div>

                    </div>


                    <!-- DATA 3 -->
                    <div class="grid grid-cols-[80px_1fr_50px_70px] gap-2 items-center py-1">

                        <span class="text-xs font-semibold">
                            XI RPL 1
                        </span>

                        <span class="text-xs text-[#7A6A60]">
                            Matematika
                        </span>

                        <span class="text-xs text-center">
                            2 JP
                        </span>

                        <div class="flex justify-end">

                            <span class="px-1.5 py-0.5 bg-[#FFFDE7] rounded text-[9px] font-bold text-[#F57F17]">
                                Pending
                            </span>

                        </div>

                    </div>


                    <!-- DATA 4 -->
                    <div class="grid grid-cols-[80px_1fr_50px_70px] gap-2 items-center py-1">

                        <span class="text-xs font-semibold">
                            XII RPL 2
                        </span>

                        <span class="text-xs text-[#7A6A60]">
                            Matematika
                        </span>

                        <span class="text-xs text-center">
                            2 JP
                        </span>

                        <div class="flex justify-end">

                            <span class="px-1.5 py-0.5 bg-[#FFEBEE] rounded text-[9px] font-bold text-[#C62828]">
                                Batal
                            </span>

                        </div>

                    </div>

                </div>

            </section>

        </main>


        <!-- =========================
             NAVIGASI BAWAH
        ========================== -->

        <nav
            class="w-full h-16 px-0 py-2
                   bg-white border-t border-[#E5D8CC]
                   flex justify-around items-center
                   shrink-0"
        >


            <!-- =========================
                 DASHBOARD
            ========================== -->

            <a
                href="/dashboard-guru"
                class="flex-1 h-full flex flex-col
                       items-center justify-center
                       gap-1 no-underline
                       text-[#9A8A80]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M3 10.5L12 3l9 7.5"></path>

                        <path d="M5 9.5V21h14V9.5"></path>

                        <path d="M9 21v-6h6v6"></path>

                    </svg>

                </div>

                <span class="text-[11px]">
                    Dashboard
                </span>

            </a>


            <!-- =========================
                 JURNALIS
            ========================== -->

            <a
                href="/mulai-sesi"
                class="flex-1 h-full flex flex-col
                       items-center justify-center
                       gap-1 no-underline
                       text-[#9A8A80]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="6"
                            y="3"
                            width="12"
                            height="18"
                            rx="1.5"
                        ></rect>

                        <path d="M10 3v18"></path>

                    </svg>

                </div>

                <span class="text-[11px]">
                    Jurnalis
                </span>

            </a>


            <!-- =========================
                 REKAP AKTIF
            ========================== -->

            <a
                href="/rekap-jurnal"
                class="flex-1 h-full flex flex-col
                       items-center justify-center
                       gap-1 no-underline
                       text-[#8B6F61]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <!-- Kotak kalender -->
                        <rect
                            x="4"
                            y="5"
                            width="16"
                            height="15"
                            rx="1.5"
                        ></rect>

                        <!-- Garis atas -->
                        <path d="M4 9h16"></path>

                        <!-- Kait kalender -->
                        <path d="M8 3v4"></path>

                        <path d="M16 3v4"></path>

                    </svg>

                </div>

                <span class="text-[11px]">
                    Rekap
                </span>

            </a>


            <!-- =========================
                 PROFIL
            ========================== -->

            <a
                href="/profil-guru"
                class="flex-1 h-full flex flex-col
                       items-center justify-center
                       gap-1 no-underline
                       text-[#9A8A80]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <circle
                            cx="12"
                            cy="8"
                            r="3"
                        ></circle>

                        <path
                            d="M5 21c0-3.5 3-6 7-6s7 2.5 7 6"
                        ></path>

                    </svg>

                </div>

                <span class="text-[11px]">
                    Profil
                </span>

            </a>

        </nav>

    </div>

</body>
</html>
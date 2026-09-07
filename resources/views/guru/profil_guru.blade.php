<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full min-h-screen bg-[#F5EFE8] text-[#3E3028]">

    <div class="w-full min-h-screen flex flex-col">

        <!-- HEADER -->
        <header class="w-full h-12 px-4 flex items-center justify-between border-b border-[#E5D8CC]">

            <div class="w-8 h-8"></div>

            <h1 class="text-base font-bold">
                Profil Saya
            </h1>

            <div class="w-8 h-8"></div>

        </header>


        <!-- CONTENT -->
        <main class="flex-1 w-full px-6 py-6 flex flex-col items-center gap-6">

            <!-- PROFIL -->
            <section class="w-full flex flex-col items-center gap-3">

                <!-- AVATAR -->
                <div class="w-20 h-20 rounded-full bg-[#D7B899] flex items-center justify-center text-[28px]">
                    ♙
                </div>

                <!-- NAMA -->
                <div class="flex flex-col items-center">
                    <h2 class="text-lg font-bold text-center">
                        Budi Santoso, S.Pd.
                    </h2>
                </div>

            </section>


            <!-- DATA GURU -->
            <section class="w-full p-4 bg-white border border-[#E5D8CC] rounded-[10px]">

                <!-- NIP -->
                <div class="min-h-4 flex justify-between items-center gap-2.5 text-[11px]">

                    <span class="text-[#7A6A60]">
                        NIP
                    </span>

                    <span class="text-[#3E3028] font-semibold text-right max-w-[65%] break-words">
                        198501012010011001
                    </span>

                </div>


                <!-- GARIS -->
                <div class="h-px bg-[#E5D8CC] my-3"></div>


                <!-- NO HP -->
                <div class="min-h-4 flex justify-between items-center gap-2.5 text-[11px]">

                    <span class="text-[#7A6A60]">
                        No. Handphone
                    </span>

                    <span class="text-[#3E3028] font-semibold text-right max-w-[65%] break-words">
                        081234560001
                    </span>

                </div>


                <!-- GARIS -->
                <div class="h-px bg-[#E5D8CC] my-3"></div>


                <!-- UNIT KERJA -->
                <div class="min-h-4 flex justify-between items-center gap-2.5 text-[11px]">

                    <span class="text-[#7A6A60]">
                        Unit Kerja
                    </span>

                    <span class="text-[#3E3028] font-semibold text-right max-w-[65%] break-words">
                        SMK Negeri 1 Jakarta
                    </span>

                </div>


                <!-- GARIS -->
                <div class="h-px bg-[#E5D8CC] my-3"></div>


                <!-- MATA PELAJARAN -->
                <div class="min-h-4 flex justify-between items-center gap-2.5 text-[11px]">

                    <span class="text-[#7A6A60]">
                        Mata Pelajaran
                    </span>

                    <span class="text-[#3E3028] font-semibold text-right max-w-[65%] break-words">
                        Matematika
                    </span>

                </div>

            </section>


            <!-- TOMBOL -->
            <section class="w-full flex flex-col gap-2.5">

                <!-- EDIT PROFIL -->
                <a
                    href="/editprofil-guru"
                    class="w-full h-[45px] rounded-lg bg-[#5C4033] text-white
                           flex items-center justify-center text-sm font-semibold cursor-pointer"
                >
                    Edit Profil
                </a>


                <!-- LOG OUT -->
                <a
                    href="/"
                    class="w-full h-[45px] rounded-lg bg-[#5C4033] text-white
                           flex items-center justify-center text-sm font-semibold cursor-pointer"
                >
                    Log Out
                </a>

            </section>

        </main>


        <!-- NAVIGASI BAWAH -->
        <nav class="w-full h-16 px-0 py-2 bg-white border-t border-[#E5D8CC] flex justify-around items-center shrink-0">

            <!-- DASHBOARD -->
            <a
                href="/dashboard-guru"
                class="flex-1 flex flex-col items-center gap-1 text-[11px] text-[#7A6A60]"
            >
                <div class="text-lg h-5">
                    ⌂
                </div>

                <span>
                    Dashboard
                </span>
            </a>


            <!-- JURNAL -->
            <a
                href="/mulai-sesi"
                class="flex-1 h-full flex flex-col items-center justify-center
                       gap-1 no-underline text-[#9A8A80]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect
                            x="5"
                            y="3"
                            width="14"
                            height="18"
                            rx="2"
                        ></rect>

                        <path d="M9 3v18"></path>
                    </svg>

                </div>

                <span class="text-[13px]">
                    Jurnal
                </span>

            </a>


            <!-- REKAP -->
            <a
                href="/rekap-jurnal"
                class="flex-1 flex flex-col items-center gap-1
                       text-[11px] text-[#7A6A60] no-underline"
            >

                <div class="text-lg h-5">
                    ▤
                </div>

                <span>
                    Rekap
                </span>

            </a>


            <!-- PROFIL -->
            <a
                href="/profil-guru"
                class="flex-1 h-full flex flex-col items-center justify-center
                       gap-1 no-underline text-[#5C4033] font-semibold"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
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

                <span class="text-[13px]">
                    Profil
                </span>

            </a>

        </nav>

    </div>

</body>
</html>
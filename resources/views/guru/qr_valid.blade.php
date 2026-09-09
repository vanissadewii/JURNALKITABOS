<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Sukses</title>

    <!-- Tailwind tanpa Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F5EFE8]">

    <div class="min-h-screen w-full bg-[#F5EFE8] flex flex-col justify-between">

        <!-- BAGIAN ATAS -->
        <div class="w-full">

            <!-- HEADER -->
            <header class="h-12 w-full px-4 flex items-center justify-between border-b border-[#E5D8CC]">

                <div class="w-8 h-8"></div>

                <h1 class="text-[16px] leading-6 font-semibold text-[#3E3028] text-center">
                    Verifikasi Sukses
                </h1>

                <div class="w-8 h-8"></div>

            </header>


            <!-- CONTENT -->
            <main class="w-full px-6 py-6 flex flex-col items-center gap-8">

                <!-- BAGIAN SUKSES -->
                <section class="w-full flex flex-col items-center gap-4">

                    <!-- Lingkaran centang -->
                    <div class="w-20 h-20 rounded-full bg-[#E8F5E9] flex items-center justify-center">

                        <div class="relative w-10 h-10">

                            <span class="
                                absolute
                                w-3.5
                                h-6
                                border-r-[3px]
                                border-b-[3px]
                                border-[#2E7D32]
                                rotate-45
                                left-[11px]
                                top-1
                            "></span>

                        </div>

                    </div>


                    <!-- Judul -->
                    <h2 class="
                        text-[22px]
                        leading-[33px]
                        font-bold
                        text-[#2E7D32]
                        text-center
                    ">
                        ✓ QR Kelas Valid
                    </h2>


                    <!-- Keterangan -->
                    <p class="
                        w-[260px]
                        text-[13px]
                        leading-4
                        font-normal
                        text-[#7A6A60]
                        text-center
                    ">
                        Lokasi terkonfirmasi berada di kelas X RPL 1.
                    </p>

                </section>


                <!-- CARD INFORMASI -->
                <section class="
                    w-full
                    bg-white
                    border
                    border-[#E5D8CC]
                    rounded-[10px]
                    p-4
                    flex
                    flex-col
                    gap-3
                ">

                    <!-- Kelas -->
                    <div class="w-full flex justify-between items-start">

                        <span class="text-[13px] leading-4 text-[#7A6A60]">
                            Kelas
                        </span>

                        <span class="text-[13px] leading-4 font-semibold text-[#3E3028]">
                            X RPL 1
                        </span>

                    </div>


                    <div class="w-full h-px bg-[#E5D8CC]"></div>


                    <!-- Sesi Pembelajaran -->
                    <div class="w-full flex justify-between items-start">

                        <span class="text-[13px] leading-4 text-[#7A6A60]">
                            Sesi Pembelajaran
                        </span>

                        <span class="text-[13px] leading-4 font-semibold text-[#3E3028]">
                            Matematika
                        </span>

                    </div>


                    <div class="w-full h-px bg-[#E5D8CC]"></div>


                    <!-- Jam Pembelajaran -->
                    <div class="w-full flex justify-between items-start">

                        <span class="text-[13px] leading-4 text-[#7A6A60]">
                            Jam Pembelajaran
                        </span>

                        <span class="text-[13px] leading-4 font-semibold text-[#3E3028]">
                            Ke-1
                        </span>

                    </div>


                    <div class="w-full h-px bg-[#E5D8CC]"></div>


                    <!-- Waktu Masuk -->
                    <div class="w-full flex justify-between items-start">

                        <span class="text-[13px] leading-4 text-[#7A6A60]">
                            Waktu Masuk
                        </span>

                        <span class="text-[13px] leading-4 font-semibold text-[#2E7D32]">
                            07:03 WIB
                        </span>

                    </div>

                </section>

            </main>

        </div>


        <!-- TOMBOL LANJUTKAN -->
        <div class="w-full p-5">

            <a
                href="/dashboard-guru"
                class="
                    w-full
                    h-11
                    px-4
                    bg-[#5C4033]
                    rounded-lg
                    flex
                    items-center
                    justify-center
                    text-white
                    text-[14px]
                    leading-[21px]
                    font-semibold
                    no-underline
                "
            >
                Lanjutkan
            </a>

        </div>

    </div>

</body>
</html>
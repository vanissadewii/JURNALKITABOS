<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dispensasi Siswa - Piket</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {

                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    },

                    colors: {
                        brand: {
                            50: '#F9F6F0',
                            100: '#EFE6DD',
                            200: '#E2C7B0',
                            300: '#D7B899',
                            600: '#7A6A60',
                            700: '#6D5C52',
                            800: '#5C4033',
                            900: '#3E2B22',
                        }
                    }
                }
            }
        }
    </script>

    <style>

        html {
            scrollbar-width: none;
        }

        html::-webkit-scrollbar {
            display: none;
        }

        .guru-sidebar-nav a {
            gap: .75rem !important;
            padding: .625rem .75rem !important;
            border-radius: .5rem !important;
            font-size: 1rem !important;
            color: #7A6A60 !important;
        }

        .guru-sidebar-nav a svg {
            color: #7A6A60 !important;
        }

        .guru-sidebar-nav a.bg-\[\#F5EFE8\] {
            color: #5C4033 !important;
        }

        .guru-sidebar-nav a.bg-\[\#F5EFE8\] svg {
            color: #3E3028 !important;
        }

        .guru-sidebar > div:first-child {
            padding: 1.5rem 1rem !important;
            gap: 2rem !important;
        }

    </style>

</head>


<body class="bg-[#F9F6F0] font-sans min-h-screen flex text-[#3E3028]">


    <!-- ========================================================= -->
    <!-- SIDEBAR -->
    <!-- ========================================================= -->

    <aside
        class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC]
               min-h-screen flex flex-col justify-between shrink-0
               fixed left-0 top-0 bottom-0 z-40 hidden md:flex"
    >

        <div class="py-6 px-4 flex flex-col gap-8">


            <!-- LOGO -->

            <div class="flex flex-col gap-0.5">

                <h2
                    class="font-poppins font-extrabold text-xl
                           text-[#3E3028] tracking-tight"
                >
                    JURNAL GURU
                </h2>

                <span class="text-md font-medium text-[#7A6A60]">
                    Akun Guru
                </span>

            </div>


            <!-- NAVIGASI -->

            <nav class="guru-sidebar-nav flex flex-col gap-1">


                <!-- BERANDA -->

                <a
                    href="{{ url('/dashboard-guru') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8]
                           hover:text-[#5C4033]
                           transition-all"
                >

                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    </svg>

                    <span>Beranda</span>

                </a>


                <!-- ISI JURNAL -->

                <a
                    href="{{ route('jurnal.create') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8]
                           hover:text-[#5C4033]
                           transition-all"
                >

                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                        <path d="M7 3v14"/>
                    </svg>

                    <span>Isi Jurnal</span>

                </a>


                <!-- RIWAYAT JURNAL -->

                <a
                    href="{{ url('/riwayat-jurnal') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8]
                           hover:text-[#5C4033]
                           transition-all"
                >

                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
                    </svg>

                    <span>Riwayat Jurnal</span>

                </a>


                <!-- ================================================= -->
                <!-- PIKET -->
                <!-- ================================================= -->

                <details
                    class="group"
                    open
                >

                    <summary
                        class="flex items-center justify-between gap-3
                               px-3 py-2.5 rounded-lg
                               font-poppins font-bold text-md
                               text-[#5C4033]
                               bg-[#F5EFE8]
                               cursor-pointer
                               select-none"
                    >

                        <span class="flex items-center gap-3">

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
                                <path d="M7 10l2 2 4-4"/>
                            </svg>

                            Piket

                        </span>


                        <svg
                            class="w-4 h-4 text-[#7A6A60]
                                   transition-transform shrink-0"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M5 7l5 5 5-5"/>
                        </svg>

                    </summary>


                    <div
                        class="ml-7 mt-1 space-y-1
                               border-l border-[#E5D8CC]
                               pl-3"
                    >

                        <!-- JURNAL GURU -->

                        <a
                            href="{{ route('piket.jurnal') }}"
                            class="block rounded-md px-3 py-2
                                   text-xs text-[#7A6A60]
                                   hover:bg-[#F5EFE8]"
                        >
                            Jurnal Guru
                        </a>


                        <!-- DISPEN AKTIF -->

                        <a
                            href="{{ route('dispen') }}"
                            class="block rounded-md px-3 py-2
                                   text-xs font-semibold
                                   bg-[#F5EFE8]
                                   text-[#5C4033]"
                        >
                            Dispen
                        </a>


                        <!-- UPLOAD TUGAS -->

                        <a
                            href="{{ route('piket.upload-tugas') }}"
                            class="block rounded-md px-3 py-2
                                   text-xs text-[#7A6A60]
                                   hover:bg-[#F5EFE8]"
                        >
                            Upload Tugas
                        </a>

                    </div>

                </details>


                <!-- PROFIL -->

                <a
                    href="{{ url('/profil-guru') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8]
                           hover:text-[#5C4033]
                           transition-all"
                >

                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 20 20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
                        <circle cx="10" cy="6.5" r="3.5"/>
                    </svg>

                    <span>Profil</span>

                </a>

            </nav>

        </div>

    </aside>


    <!-- ========================================================= -->
    <!-- MAIN -->
    <!-- ========================================================= -->

    <div
        class="flex-1
               md:ml-64
               flex flex-col
               min-h-screen
               pb-24 md:pb-8
               w-full min-w-0"
    >


        <!-- ===================================================== -->
        <!-- HEADER -->
        <!-- ===================================================== -->

        <header
            class="sticky top-0 z-30
                   w-full
                   bg-[#5C4033]
                   shadow-md
                   px-6 md:px-10
                   py-6
                   flex flex-col
                   justify-between
                   items-start
                   gap-3"
        >

            <div class="flex flex-col gap-1">


                <!-- KEMBALI -->

                <a
                    href="{{ route('dashboard-guru-piket') }}"
                    class="text-xs font-semibold
                           text-[#D7B899]
                           hover:text-white
                           flex items-center
                           gap-1 mb-1"
                >

                    <svg
                        class="w-3.5 h-3.5"
                        viewBox="0 0 20 20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="M12 15l-5-5 5-5"/>
                    </svg>

                    Kembali ke Piket

                </a>


                <!-- JUDUL -->

                <h1
                    class="font-poppins
                           text-2xl sm:text-3xl
                           font-bold
                           text-white
                           tracking-tight"
                >
                    Dispensasi Siswa
                </h1>


                <span
                    class="text-xs sm:text-sm
                           text-[#D7B899]"
                >
                    Ajukan surat dispensasi siswa kepada Waka.
                </span>

            </div>

        </header>


        <!-- ===================================================== -->
        <!-- CONTENT -->
        <!-- ===================================================== -->

        <main
            class="w-full
                   px-6 md:px-10
                   py-8
                   flex flex-col
                   gap-6
                   flex-1"
        >


            <!-- ================================================= -->
            <!-- INFO -->
            <!-- ================================================= -->

            <div
                class="bg-[#F9F6F0]
                       border border-[#E2C7B0]
                       rounded-2xl
                       px-5 py-4"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="w-9 h-9
                               rounded-lg
                               bg-[#E2C7B0]
                               flex items-center
                               justify-center
                               shrink-0"
                    >

                        <svg
                            class="w-5 h-5 text-[#5C4033]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                            <path d="M10.3 3.7L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L13.7 3.7a2 2 0 00-3.4 0z"/>
                        </svg>

                    </div>


                    <div>

                        <p
                            class="text-sm
                                   font-semibold
                                   text-[#5C4033]"
                        >
                            Pengajuan dispensasi
                        </p>

                        <p
                            class="text-xs
                                   text-[#7A6A60]
                                   mt-1
                                   leading-relaxed"
                        >
                            Setelah diajukan, surat akan diteruskan
                            kepada Waka yang sedang dijadwalkan oleh Admin.
                        </p>

                    </div>

                </div>

            </div>


            <!-- ================================================= -->
            <!-- FORM -->
            <!-- ================================================= -->

            <form
                method="POST"
                action="#"
                class="bg-white
                       border border-[#EFE6DD]
                       rounded-2xl
                       p-5 md:p-7
                       flex flex-col
                       gap-6"
            >

                @csrf


                <!-- JUDUL FORM -->

                <div>

                    <h2
                        class="font-poppins
                               font-bold
                               text-lg
                               text-[#3E3028]"
                    >
                        Form Dispensasi Siswa
                    </h2>

                    <p
                        class="text-sm
                               text-[#7A6A60]
                               mt-1"
                    >
                        Lengkapi data siswa dan alasan dispensasi.
                    </p>

                </div>


                <!-- ================================================= -->
                <!-- NO SURAT -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        No. Surat
                    </label>


                    <div class="relative">

                        <input
                            type="text"
                            value="DSP/001/IX/2026"
                            readonly
                            class="w-full
                                   h-11
                                   px-3
                                   pr-24
                                   bg-[#F5F2EE]
                                   border border-[#E5D8CC]
                                   rounded-xl
                                   text-sm
                                   text-[#7A6A60]
                                   cursor-not-allowed"
                        >


                        <span
                            class="absolute
                                   right-3
                                   top-1/2
                                   -translate-y-1/2
                                   text-[10px]
                                   font-semibold
                                   text-[#9E8E83]"
                        >
                            OTOMATIS
                        </span>

                    </div>


                    <span
                        class="text-xs
                               text-[#9E8E83]"
                    >
                        Nomor surat akan dibuat otomatis oleh sistem.
                    </span>

                </div>


                <!-- ================================================= -->
                <!-- NAMA SISWA -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="nama_siswa"
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        Nama Siswa
                    </label>


                    <input
                        type="text"
                        id="nama_siswa"
                        name="nama_siswa"
                        placeholder="Masukkan nama siswa..."
                        autocomplete="off"
                        required
                        class="w-full
                               h-11
                               px-3
                               bg-white
                               border border-[#E5D8CC]
                               rounded-xl
                               text-sm
                               text-[#3E3028]
                               placeholder:text-[#B3A39A]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#D7B899]"
                    >

                </div>


                <!-- ================================================= -->
                <!-- KELAS -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="kelasSearch"
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        Kelas
                    </label>


                    <div class="relative">

                        <svg
                            class="absolute
                                   left-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-[#9E8E83]"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle cx="8.5" cy="8.5" r="5"/>
                            <path d="M12.5 12.5L17 17"/>
                        </svg>


                        <input
                            type="text"
                            id="kelasSearch"
                            placeholder="Cari kelas..."
                            autocomplete="off"
                            required
                            class="w-full
                                   h-11
                                   pl-10
                                   pr-3
                                   bg-white
                                   border border-[#E5D8CC]
                                   rounded-xl
                                   text-sm
                                   text-[#3E3028]
                                   placeholder:text-[#B3A39A]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#D7B899]"
                            oninput="cariKelas()"
                        >

                    </div>


                    <div
                        id="hasilKelas"
                        class="border
                               border-[#E5D8CC]
                               rounded-xl
                               overflow-hidden
                               bg-white"
                    >

                        <button
                            type="button"
                            onclick="pilihKelas('X RPL 2')"
                            class="w-full
                                   text-left
                                   px-4 py-3
                                   text-sm
                                   text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b
                                   border-[#EFE6DD]"
                        >
                            X RPL 2
                        </button>


                        <button
                            type="button"
                            onclick="pilihKelas('XI RPL 2')"
                            class="w-full
                                   text-left
                                   px-4 py-3
                                   text-sm
                                   text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b
                                   border-[#EFE6DD]"
                        >
                            XI RPL 2
                        </button>


                        <button
                            type="button"
                            onclick="pilihKelas('XII RPL 1')"
                            class="w-full
                                   text-left
                                   px-4 py-3
                                   text-sm
                                   text-[#3E3028]
                                   hover:bg-[#F9F6F0]"
                        >
                            XII RPL 1
                        </button>

                    </div>


                    <input
                        type="hidden"
                        name="kelas"
                        id="kelas"
                    >

                </div>


                <!-- ================================================= -->
                <!-- TANGGAL -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        Tanggal
                    </label>


                    <input
                        type="date"
                        name="tanggal"
                        value="{{ date('Y-m-d') }}"
                        readonly
                        class="w-full
                               h-11
                               px-3
                               bg-[#F5F2EE]
                               border border-[#E5D8CC]
                               rounded-xl
                               text-sm
                               text-[#7A6A60]
                               cursor-not-allowed"
                    >


                    <span
                        class="text-xs
                               text-[#9E8E83]"
                    >
                        Tanggal mengikuti tanggal pengajuan.
                    </span>

                </div>


                <!-- ================================================= -->
                <!-- JAM -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="jamSearch"
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        Jam
                    </label>


                    <div class="relative">

                        <svg
                            class="absolute
                                   left-3
                                   top-1/2
                                   -translate-y-1/2
                                   w-4 h-4
                                   text-[#9E8E83]"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle cx="10" cy="10" r="7"/>
                            <path d="M10 6v4l2.5 2"/>
                        </svg>


                        <input
                            type="text"
                            id="jamSearch"
                            placeholder="Cari jam pelajaran..."
                            autocomplete="off"
                            required
                            class="w-full
                                   h-11
                                   pl-10
                                   pr-3
                                   bg-white
                                   border border-[#E5D8CC]
                                   rounded-xl
                                   text-sm
                                   text-[#3E3028]
                                   placeholder:text-[#B3A39A]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#D7B899]"
                            oninput="cariJam()"
                        >

                    </div>


                    <div
                        id="hasilJam"
                        class="border
                               border-[#E5D8CC]
                               rounded-xl
                               overflow-hidden
                               bg-white"
                    >

                        <button
                            type="button"
                            onclick="pilihJam('Jam ke-1 • 07:00 - 07:45')"
                            class="w-full
                                   text-left
                                   px-4 py-3
                                   text-sm
                                   text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b
                                   border-[#EFE6DD]"
                        >

                            <span class="font-semibold">
                                Jam ke-1
                            </span>

                            <span class="text-[#7A6A60]">
                                • 07:00 - 07:45
                            </span>

                        </button>


                        <button
                            type="button"
                            onclick="pilihJam('Jam ke-2 • 07:45 - 08:30')"
                            class="w-full
                                   text-left
                                   px-4 py-3
                                   text-sm
                                   text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b
                                   border-[#EFE6DD]"
                        >

                            <span class="font-semibold">
                                Jam ke-2
                            </span>

                            <span class="text-[#7A6A60]">
                                • 07:45 - 08:30
                            </span>

                        </button>


                        <button
                            type="button"
                            onclick="pilihJam('Jam ke-3 • 08:30 - 09:15')"
                            class="w-full
                                   text-left
                                   px-4 py-3
                                   text-sm
                                   text-[#3E3028]
                                   hover:bg-[#F9F6F0]"
                        >

                            <span class="font-semibold">
                                Jam ke-3
                            </span>

                            <span class="text-[#7A6A60]">
                                • 08:30 - 09:15
                            </span>

                        </button>

                    </div>


                    <input
                        type="hidden"
                        name="jam"
                        id="jam"
                    >

                </div>


                <!-- ================================================= -->
                <!-- ALASAN -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="alasan"
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        Alasan
                    </label>


                    <textarea
                        id="alasan"
                        name="alasan"
                        rows="5"
                        required
                        placeholder="Contoh: Mengikuti lomba tingkat provinsi..."
                        class="w-full
                               px-3 py-3
                               bg-white
                               border border-[#E5D8CC]
                               rounded-xl
                               text-sm
                               text-[#3E3028]
                               placeholder:text-[#B3A39A]
                               resize-none
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#D7B899]"
                    ></textarea>


                    <span
                        class="text-xs
                               text-[#9E8E83]"
                    >
                        Jelaskan alasan siswa membutuhkan dispensasi.
                    </span>

                </div>


                <!-- ================================================= -->
                <!-- DIAJUKAN OLEH -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        class="text-sm
                               font-semibold
                               text-[#3E3028]"
                    >
                        Diajukan oleh
                    </label>


                    <div
                        class="w-full
                               min-h-[44px]
                               px-3
                               flex items-center
                               bg-[#F5F2EE]
                               border border-[#E5D8CC]
                               rounded-xl
                               text-sm
                               text-[#7A6A60]"
                    >

                        {{ auth()->user()->name ?? 'Akun Guru' }}

                    </div>


                    <span
                        class="text-xs
                               text-[#9E8E83]"
                    >
                        Nama diambil otomatis dari akun yang sedang login.
                    </span>

                </div>


                <!-- ================================================= -->
                <!-- WAKA -->
                <!-- ================================================= -->

                <div
                    class="bg-[#F9F6F0]
                           border border-[#E5D8CC]
                           rounded-xl
                           px-4 py-3"
                >

                    <div class="flex items-start gap-3">

                        <svg
                            class="w-5 h-5
                                   text-[#7A6A60]
                                   mt-0.5
                                   shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>
                        </svg>


                        <div>

                            <p
                                class="text-sm
                                       font-semibold
                                       text-[#3E3028]"
                            >
                                Persetujuan Waka
                            </p>


                            <p
                                class="text-xs
                                       text-[#7A6A60]
                                       mt-1
                                       leading-relaxed"
                            >
                                Setelah diajukan, sistem akan mencari
                                Waka berdasarkan jadwal yang telah
                                ditentukan oleh Admin.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- ================================================= -->
                <!-- BUTTON -->
                <!-- ================================================= -->

                <div
                    class="flex flex-col-reverse
                           sm:flex-row
                           sm:justify-end
                           gap-3
                           pt-2
                           border-t border-[#EFE6DD]"
                >


                    <!-- BATAL -->

                    <a
                        href="{{ route('dashboard-guru-piket') }}"
                        class="h-11
                               px-5
                               rounded-xl
                               border border-[#E5D8CC]
                               bg-white
                               text-[#7A6A60]
                               text-sm
                               font-semibold
                               flex items-center
                               justify-center
                               hover:bg-[#F9F6F0]
                               transition"
                    >
                        Batal
                    </a>


                    <!-- AJUKAN -->

                    <button
                        type="submit"
                        class="h-11
                               px-5
                               rounded-xl
                               bg-[#5C4033]
                               hover:bg-[#3E2B22]
                               text-white
                               text-sm
                               font-semibold
                               flex items-center
                               justify-center
                               gap-2
                               transition"
                    >

                        <svg
                            class="w-4 h-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M22 2L11 13"/>
                            <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                        </svg>

                        Ajukan Dispensasi

                    </button>

                </div>

            </form>

        </main>

    </div>


    <!-- ========================================================= -->
    <!-- MOBILE NAV -->
    <!-- ========================================================= -->

    <nav
        class="md:hidden
               fixed bottom-0
               left-0 right-0
               bg-white
               border-t border-[#EFE6DD]
               py-3.5 px-6
               z-50
               shadow-[0_-4px_25px_rgba(0,0,0,0.06)]"
    >

        <div class="flex justify-between items-center">


            <!-- BERANDA -->

            <a
                href="{{ url('/dashboard-guru') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium
                       text-[#9E8E83]
                       hover:text-[#5C4033]
                       transition-colors"
            >

                <svg
                    class="w-5 h-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                </svg>

                <span>Beranda</span>

            </a>


            <!-- ISI JURNAL -->

            <a
                href="{{ route('jurnal.create') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium
                       text-[#9E8E83]
                       hover:text-[#5C4033]
                       transition-colors"
            >

                <svg
                    class="w-5 h-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
                    <path d="M7 3v14"/>
                </svg>

                <span>Isi Jurnal</span>

            </a>


            <!-- RIWAYAT -->

            <a
                href="{{ url('/riwayat-jurnal') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium
                       text-[#9E8E83]
                       hover:text-[#5C4033]
                       transition-colors"
            >

                <svg
                    class="w-5 h-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
                </svg>

                <span>Riwayat</span>

            </a>


            <!-- PIKET -->

            <a
                href="{{ route('dashboard-guru-piket') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-bold
                       text-[#5C4033]"
            >

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.2"
                >
                    <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
                    <path d="M7 10l2 2 4-4"/>
                </svg>

                <span>Piket</span>

            </a>


            <!-- PROFIL -->

            <a
                href="{{ url('/profil-guru') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium
                       text-[#9E8E83]
                       hover:text-[#5C4033]
                       transition-colors"
            >

                <svg
                    class="w-5 h-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
                    <circle cx="10" cy="6.5" r="3.5"/>
                </svg>

                <span>Profil</span>

            </a>

        </div>

    </nav>


    <!-- ========================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ========================================================= -->

    <script>


        /* =======================================================
           DATA KELAS SEMENTARA
           NANTI DIAMBIL DARI DATABASE ADMIN
           ======================================================= */

        const daftarKelas = [
            'X RPL 2',
            'XI RPL 2',
            'XII RPL 1'
        ];


        /* =======================================================
           DATA JAM SEMENTARA
           NANTI DIAMBIL DARI DATABASE ADMIN
           ======================================================= */

        const daftarJam = [
            'Jam ke-1 • 07:00 - 07:45',
            'Jam ke-2 • 07:45 - 08:30',
            'Jam ke-3 • 08:30 - 09:15'
        ];


        /* =======================================================
           CARI KELAS
           ======================================================= */

        function cariKelas() {

            const keyword =
                document
                    .getElementById('kelasSearch')
                    .value
                    .toLowerCase()
                    .trim();


            const hasil =
                document.getElementById('hasilKelas');


            const filtered =
                daftarKelas.filter(kelas =>
                    kelas.toLowerCase().includes(keyword)
                );


            hasil.innerHTML = '';


            filtered.forEach((kelas, index) => {

                hasil.innerHTML += `

                    <button
                        type="button"
                        onclick="pilihKelas('${kelas}')"
                        class="w-full
                               text-left
                               px-4 py-3
                               text-sm
                               text-[#3E3028]
                               hover:bg-[#F9F6F0]
                               ${
                                   index < filtered.length - 1
                                       ? 'border-b border-[#EFE6DD]'
                                       : ''
                               }"
                    >

                        ${kelas}

                    </button>

                `;

            });


            if (filtered.length === 0) {

                hasil.innerHTML = `

                    <div
                        class="px-4 py-3
                               text-sm
                               text-[#9E8E83]"
                    >
                        Kelas tidak ditemukan.
                    </div>

                `;

            }

        }


        /* =======================================================
           PILIH KELAS
           ======================================================= */

        function pilihKelas(kelas) {

            document
                .getElementById('kelasSearch')
                .value = kelas;


            document
                .getElementById('kelas')
                .value = kelas;


            document
                .getElementById('hasilKelas')
                .innerHTML = '';

        }


        /* =======================================================
           CARI JAM
           ======================================================= */

        function cariJam() {

            const keyword =
                document
                    .getElementById('jamSearch')
                    .value
                    .toLowerCase()
                    .trim();


            const hasil =
                document.getElementById('hasilJam');


            const filtered =
                daftarJam.filter(jam =>
                    jam.toLowerCase().includes(keyword)
                );


            hasil.innerHTML = '';


            filtered.forEach((jam, index) => {

                hasil.innerHTML += `

                    <button
                        type="button"
                        onclick="pilihJam('${jam}')"
                        class="w-full
                               text-left
                               px-4 py-3
                               text-sm
                               text-[#3E3028]
                               hover:bg-[#F9F6F0]
                               ${
                                   index < filtered.length - 1
                                       ? 'border-b border-[#EFE6DD]'
                                       : ''
                               }"
                    >

                        ${jam}

                    </button>

                `;

            });


            if (filtered.length === 0) {

                hasil.innerHTML = `

                    <div
                        class="px-4 py-3
                               text-sm
                               text-[#9E8E83]"
                    >
                        Jam pelajaran tidak ditemukan.
                    </div>

                `;

            }

        }


        /* =======================================================
           PILIH JAM
           ======================================================= */

        function pilihJam(jam) {

            document
                .getElementById('jamSearch')
                .value = jam;


            document
                .getElementById('jam')
                .value = jam;


            document
                .getElementById('hasilJam')
                .innerHTML = '';

        }

    </script>

</body>

</html>
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

                    </summary>

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
                    @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
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
            <!-- FORM -->
            <!-- ================================================= -->

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('link_wa'))
                <a href="{{ session('link_wa') }}" target="_blank" rel="noopener" class="mb-4 inline-flex min-h-11 items-center justify-center rounded-xl bg-green-700 px-5 py-3 font-semibold text-white">Kirim tautan persetujuan ke Admin via WhatsApp</a>
            @endif
            @if($errors->any())<div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>@endif
            <form
                method="POST"
                action="{{ route('dispen.store') }}"
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


                @if(session('success'))
                    <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
                @endif
                @if(session('link_wa'))
                    <a href="{{ session('link_wa') }}" target="_blank" rel="noopener" class="flex min-h-12 items-center justify-center gap-2 rounded-xl bg-green-700 px-4 py-3 text-center font-semibold text-white hover:bg-green-800">Kirim tautan persetujuan ke 0877 8259 9520 via WhatsApp</a>
                @endif
                @if($errors->any())
                    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
                @endif

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
                            value="Nomor dibuat otomatis saat disimpan"
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
                        placeholder="Ketik nama atau NISN siswa..."
                        oninput="cariSiswa()"
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
                    <div id="hasilSiswa" class="hidden max-h-56 overflow-y-auto rounded-xl border border-[#E5D8CC] bg-white shadow-sm"></div>
                    <input type="hidden" name="id_siswa" id="id_siswa">

                </div>


                <!-- ================================================= -->
                <!-- KELAS SISWA TERPILIH -->
                <div class="flex flex-col gap-2">
                    <label for="kelasSearch" class="text-sm font-semibold text-[#3E3028]">Kelas Tujuan</label>
                    <input type="text" id="kelasSearch" placeholder="Pilih siswa terlebih dahulu" readonly class="w-full h-11 px-3 bg-[#F5F2EE] border border-[#E5D8CC] rounded-xl text-sm text-[#7A6A60]">
                    <input type="hidden" name="id_kelas" id="id_kelas">
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
                <!-- RENTANG JAM -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex flex-col gap-2 text-sm font-semibold text-[#3E3028]">Jam Mulai
                        <select name="jam_ke_mulai" id="jam_ke_mulai" required disabled class="h-11 rounded-xl border border-[#E5D8CC] bg-white px-3 text-sm font-normal"><option value="">Pilih siswa dahulu</option></select>
                    </label>
                    <label class="flex flex-col gap-2 text-sm font-semibold text-[#3E3028]">Jam Selesai
                        <select name="jam_ke_selesai" id="jam_ke_selesai" required disabled class="h-11 rounded-xl border border-[#E5D8CC] bg-white px-3 text-sm font-normal"><option value="">Pilih jam mulai dahulu</option></select>
                    </label>
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
                        @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
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
                @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
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


    <script>


        let timerCariSiswa;
        let daftarJam = [];

        function cariSiswa() {
            clearTimeout(timerCariSiswa);
            const q = document.getElementById('nama_siswa').value.trim();
            const hasil = document.getElementById('hasilSiswa');
            document.getElementById('id_siswa').value = '';
            document.getElementById('id_kelas').value = '';
            document.getElementById('kelasSearch').value = '';
            resetJam('Pilih siswa dahulu');
            if (q.length < 2) { hasil.innerHTML = ''; hasil.classList.add('hidden'); return; }
            timerCariSiswa = setTimeout(async () => {
                const response = await fetch(`/dispen/cari-siswa?q=${encodeURIComponent(q)}`, {headers:{'Accept':'application/json'}});
                const siswa = await response.json();
                hasil.innerHTML = '';
                hasil.classList.remove('hidden');
                if (!siswa.length) { hasil.innerHTML = '<p class="px-4 py-3 text-sm text-[#8C7B70]">Siswa tidak ditemukan.</p>'; return; }
                siswa.forEach(item => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'block w-full border-b border-[#EFE6DD] px-4 py-3 text-left text-sm hover:bg-[#F9F6F0]';
                    button.textContent = `${item.nama} · ${item.label_kelas} · NISN ${item.nisn || '-'}`;
                    button.addEventListener('click', () => pilihSiswa(item));
                    hasil.appendChild(button);
                });
            }, 250);
        }

        function pilihSiswa(item) {
            document.getElementById('nama_siswa').value = item.nama;
            document.getElementById('id_siswa').value = item.id_siswa;
            document.getElementById('id_kelas').value = item.id_kelas;
            document.getElementById('kelasSearch').value = item.label_kelas;
            document.getElementById('hasilSiswa').classList.add('hidden');
            muatJam();
        }

        function resetJam(teks) {
            const mulai = document.getElementById('jam_ke_mulai');
            const selesai = document.getElementById('jam_ke_selesai');
            mulai.innerHTML = `<option value="">${teks}</option>`;
            selesai.innerHTML = '<option value="">Pilih jam mulai dahulu</option>';
            mulai.disabled = true; selesai.disabled = true;
        }

        async function muatJam() {
            const idKelas = document.getElementById('id_kelas').value;
            const tanggal = document.querySelector('[name="tanggal"]').value;
            resetJam('Memuat jam...');
            const response = await fetch(`/dispen/opsi-jam?id_kelas=${encodeURIComponent(idKelas)}&tanggal=${encodeURIComponent(tanggal)}`, {headers:{'Accept':'application/json'}});
            const data = await response.json();
            daftarJam = data.jam || [];
            const mulai = document.getElementById('jam_ke_mulai');
            mulai.innerHTML = '<option value="">Pilih jam mulai</option>';
            daftarJam.forEach(item => mulai.add(new Option(`Jam ke-${item.jam_ke} · ${item.jam_mulai.slice(0,5)}–${item.jam_selesai.slice(0,5)}`, item.jam_ke)));
            mulai.disabled = daftarJam.length === 0;
            document.getElementById('jam_ke_selesai').innerHTML = '<option value="">Pilih jam mulai dahulu</option>';
        }

        document.getElementById('jam_ke_mulai').addEventListener('change', event => {
            const awal = Number(event.target.value);
            const selesai = document.getElementById('jam_ke_selesai');
            selesai.innerHTML = '<option value="">Pilih jam selesai</option>';
            daftarJam.filter(item => Number(item.jam_ke) >= awal).forEach(item => selesai.add(new Option(`Jam ke-${item.jam_ke} · ${item.jam_mulai.slice(0,5)}–${item.jam_selesai.slice(0,5)}`, item.jam_ke)));
            selesai.disabled = !awal;
        });

    </script>

    @include('shared.preserve_search_scroll')
</body>

</html>
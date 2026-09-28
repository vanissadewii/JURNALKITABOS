<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upload Tugas - Piket</title>

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

<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

    <!-- ========================================================= -->
    <!-- SIDEBAR -->
    <!-- ========================================================= -->

    <aside
        class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC]
               min-h-screen flex flex-col justify-between shrink-0
               fixed left-0 top-0 bottom-0 z-40 hidden md:flex"
    >

        <div class="py-6 px-4 flex flex-col gap-8">

            <!-- BRAND -->
            <div class="flex flex-col gap-0.5">

                <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">
                    JURNAL GURU
                </h2>

                <span class="text-md font-medium text-[#7A6A60]">
                    Akun Guru
                </span>

            </div>


            <!-- NAVIGATION -->
            <nav class="guru-sidebar-nav flex flex-col gap-1">

                <!-- Beranda -->
                <a
                    href="{{ url('/dashboard-guru') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8] hover:text-[#5C4033]
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


                <!-- Isi Jurnal -->
                <a
                    href="{{ route('jurnal.create') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8] hover:text-[#5C4033]
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


                <!-- Riwayat -->
                <a
                    href="{{ url('/riwayat-jurnal') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8] hover:text-[#5C4033]
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
                    {{ request()->routeIs('piket.*', 'dashboard-guru-piket') ? 'open' : '' }}
                >

                    <summary
                        class="flex items-center justify-between gap-3
                               px-3 py-2.5 rounded-lg
                               font-poppins font-bold text-md
                               text-[#5C4033] bg-[#F5EFE8]
                               cursor-pointer select-none"
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


                <!-- ================================================= -->
                <!-- PROFIL -->
                <!-- ================================================= -->

                <a
                    href="{{ url('/profil-guru') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                           font-medium text-md text-[#7A6A60]
                           hover:bg-[#F5EFE8] hover:text-[#5C4033]
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
    <!-- MAIN CONTENT -->
    <!-- ========================================================= -->

    <div
        class="flex-1 md:ml-64 flex flex-col min-h-screen
               pb-24 md:pb-8 w-full min-w-0"
    >

        <!-- ===================================================== -->
        <!-- HEADER -->
        <!-- ===================================================== -->

        <header
            class="sticky top-0 z-30 w-full
                   bg-[#5C4033] shadow-md
                   px-6 md:px-10 py-6
                   flex flex-col md:flex-row
                   justify-between items-start md:items-center gap-3"
        >

            <div class="flex flex-col gap-1">

                <!-- KEMBALI -->
                <a
                    @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
                    class="text-xs font-semibold text-[#D7B899]
                           hover:text-white flex items-center gap-1 mb-1"
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


                <h1
                    class="font-poppins text-2xl sm:text-3xl
                           font-bold text-white tracking-tight"
                >
                    Upload Tugas
                </h1>

            </div>

        </header>


        <!-- ===================================================== -->
        <!-- CONTENT -->
        <!-- ===================================================== -->

        <main
            class="w-full px-6 md:px-10 py-8
                   flex flex-col gap-6 flex-1"
        >

            @if(session('success'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>@endif
            @if(isset($errors) && $errors->any())<div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>@endif

            <!-- FORM UPLOAD -->
            <form
                method="POST"
                enctype="multipart/form-data"
                action="{{ route('piket.upload-tugas.store') }}"
                class="bg-white border border-brand-100
                       rounded-2xl p-5 md:p-7
                       flex flex-col gap-6"
            >

                @csrf


                <!-- ================================================= -->
                <!-- INFORMASI -->
                <!-- ================================================= -->

                <div>

                    <h2
                        class="font-poppins font-bold
                               text-lg text-[#3E3028]"
                    >
                        Upload Tugas
                    </h2>

                </div>


                <!-- ================================================= -->
                <!-- STATUS GURU (IZIN / SAKIT) -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label class="text-sm font-semibold text-[#3E3028]">
                        Status Guru
                    </label>

                    <div class="grid grid-cols-2 gap-3">

                        <button
                            type="button"
                            id="btnIzin"
                            onclick="pilihStatus('izin')"
                            class="status-btn h-11 rounded-xl border border-[#E5D8CC]
                                   bg-white text-[#3E3028]
                                   text-sm font-semibold
                                   flex items-center justify-center gap-2
                                   hover:bg-brand-50 transition"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M10 2v6l4 2"/>
                                <circle cx="10" cy="10" r="7.5"/>
                            </svg>
                            Izin
                        </button>

                        <button
                            type="button"
                            id="btnSakit"
                            onclick="pilihStatus('sakit')"
                            class="status-btn h-11 rounded-xl border border-[#E5D8CC]
                                   bg-white text-[#3E3028]
                                   text-sm font-semibold
                                   flex items-center justify-center gap-2
                                   hover:bg-brand-50 transition"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
                                <path d="M10 7v3.5M10 13.2v.1"/>
                            </svg>
                            Sakit
                        </button>

                    </div>

                    <p id="statusWarning" class="hidden text-xs font-medium text-[#C62828]">
                        Pilih status guru (Izin/Sakit) terlebih dahulu.
                    </p>

                    <!-- VALUE YANG DIKIRIM -->
                    <input type="hidden" name="status" id="status">

                </div>


                <!-- ================================================= -->
                <!-- ALASAN IZIN (muncul jika status = izin) -->
                <!-- ================================================= -->

                <div id="alasanIzinWrapper" class="hidden flex-col gap-2">

                    <label for="alasanIzin" class="text-sm font-semibold text-[#3E3028]">
                        Alasan Izin
                    </label>

                    <textarea
                        id="alasanIzin"
                        name="alasan_izin"
                        rows="3"
                        placeholder="Contoh: Ada keperluan keluarga mendadak..."
                        class="w-full px-3 py-3
                               bg-white
                               border border-[#E5D8CC]
                               rounded-xl
                               text-sm text-[#3E3028]
                               placeholder:text-[#B3A39A]
                               resize-none
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#D7B899]"
                    ></textarea>

                </div>


                <!-- ================================================= -->
                <!-- KELAS -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="kelasSearch"
                        class="text-sm font-semibold text-[#3E3028]"
                    >
                        Kelas
                    </label>


                    <div class="relative">

                        <!-- SEARCH ICON -->
                        <svg
                            class="absolute left-3 top-1/2
                                   -translate-y-1/2
                                   w-4 h-4 text-[#9E8E83]"
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
                            class="w-full h-11 pl-10 pr-3
                                   bg-white
                                   border border-[#E5D8CC]
                                   rounded-xl
                                   text-sm text-[#3E3028]
                                   placeholder:text-[#B3A39A]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#D7B899]"
                            oninput="cariKelas()"
                        >

                    </div>


                    <!-- HASIL KELAS -->
                    <div
                        id="hasilKelas"
                        class="border border-[#E5D8CC]
                               rounded-xl overflow-hidden
                               bg-white"
                    >

                        <button
                            type="button"
                            onclick="pilihKelas('X RPL 2')"
                            class="w-full text-left px-4 py-3
                                   text-sm text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b border-[#EFE6DD]"
                        >
                            X RPL 2
                        </button>


                        <button
                            type="button"
                            onclick="pilihKelas('XI RPL 2')"
                            class="w-full text-left px-4 py-3
                                   text-sm text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b border-[#EFE6DD]"
                        >
                            XI RPL 2
                        </button>


                        <button
                            type="button"
                            onclick="pilihKelas('XII RPL 1')"
                            class="w-full text-left px-4 py-3
                                   text-sm text-[#3E3028]
                                   hover:bg-[#F9F6F0]"
                        >
                            XII RPL 1
                        </button>

                    </div>


                    <!-- VALUE YANG DIKIRIM -->
                    <input
                        type="hidden"
                        name="id_kelas"
                        id="kelas"
                    >

                </div>


                <!-- ================================================= -->
                <!-- MATA PELAJARAN -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="mapelSearch"
                        class="text-sm font-semibold text-[#3E3028]"
                    >
                        Mata Pelajaran
                    </label>


                    <div class="relative">

                        <!-- SEARCH ICON -->
                        <svg
                            class="absolute left-3 top-1/2
                                   -translate-y-1/2
                                   w-4 h-4 text-[#9E8E83]"
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
                            id="mapelSearch"
                            placeholder="Cari mata pelajaran..."
                            autocomplete="off"
                            class="w-full h-11 pl-10 pr-3
                                   bg-white
                                   border border-[#E5D8CC]
                                   rounded-xl
                                   text-sm text-[#3E3028]
                                   placeholder:text-[#B3A39A]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#D7B899]"
                            oninput="cariMapel()"
                        >

                    </div>


                    <!-- HASIL MAPEL -->
                    <div
                        id="hasilMapel"
                        class="border border-[#E5D8CC]
                               rounded-xl overflow-hidden
                               bg-white"
                    >

                        <button
                            type="button"
                            onclick="pilihMapel('Matematika')"
                            class="w-full text-left px-4 py-3
                                   text-sm text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b border-[#EFE6DD]"
                        >
                            Matematika
                        </button>


                        <button
                            type="button"
                            onclick="pilihMapel('Bahasa Inggris')"
                            class="w-full text-left px-4 py-3
                                   text-sm text-[#3E3028]
                                   hover:bg-[#F9F6F0]
                                   border-b border-[#EFE6DD]"
                        >
                            Bahasa Inggris
                        </button>


                        <button
                            type="button"
                            onclick="pilihMapel('Pemrograman Web')"
                            class="w-full text-left px-4 py-3
                                   text-sm text-[#3E3028]
                                   hover:bg-[#F9F6F0]"
                        >
                            Pemrograman Web
                        </button>

                    </div>


                    <!-- VALUE YANG DIKIRIM -->
                    <input
                        type="hidden"
                        name="mapel"
                        id="mapel"
                    >

                </div>


                <div class="flex flex-col gap-2">
                    <label for="jadwalSelect" class="text-sm font-semibold text-[#3E3028]">Sesi / Jam Ke</label>
                    <select id="jadwalSelect" name="id_jadwal" required disabled class="w-full h-11 px-3 bg-white border border-[#E5D8CC] rounded-xl text-sm text-[#3E3028] disabled:bg-[#F5EFE8]">
                        <option value="">Pilih kelas dan mata pelajaran terlebih dahulu</option>
                    </select>
                    @error('id_jadwal')<p class="text-xs text-red-700">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="materi" class="text-sm font-semibold text-[#3E3028]">Materi Pembelajaran</label>
                    <textarea id="materi" name="materi" rows="2" required maxlength="5000" placeholder="Materi yang seharusnya dipelajari pada sesi ini..." class="w-full px-3 py-3 bg-white border border-[#E5D8CC] rounded-xl text-sm text-[#3E3028] resize-y focus:outline-none focus:ring-2 focus:ring-[#D7B899]">{{ old('materi') }}</textarea>
                    @error('materi')<p class="text-xs text-red-700">{{ $message }}</p>@enderror
                </div>

                <!-- ================================================= -->
                <!-- CATATAN GURU -->
                <!-- ================================================= -->

                <div class="flex flex-col gap-2">

                    <label
                        for="catatan"
                        class="text-sm font-semibold text-[#3E3028]"
                    >
                        Tugas
                    </label>


                    <textarea
                        id="tugas"
                        name="tugas"
                        rows="5"
                        placeholder="Contoh: Tugas dikerjakan di buku tulis dan dikumpulkan kepada guru piket..."
                        class="w-full px-3 py-3
                               bg-white
                               border border-[#E5D8CC]
                               rounded-xl
                               text-sm text-[#3E3028]
                               placeholder:text-[#B3A39A]
                               resize-none
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#D7B899]"
                    ></textarea>

                </div>


                <div class="flex flex-col gap-2">
                    <label for="file" class="text-sm font-semibold text-[#3E3028]">Lampiran materi / tugas (opsional)</label>
                    <input id="file" name="file" type="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip" class="w-full rounded-xl border border-[#E5D8CC] bg-white px-3 py-3 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-[#5C4033] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-[#452F26]">
                    <p class="text-xs text-[#7A6A60]">Lampiran opsional: PDF, dokumen Office, atau ZIP; maksimal 20 MB.</p>
                </div>

                <!-- ================================================= -->
                <!-- BUTTON -->
                <!-- ================================================= -->

                <div
                    class="flex flex-col-reverse sm:flex-row
                           sm:justify-end gap-3 pt-2
                           border-t border-brand-100"
                >

                    <!-- BATAL -->
                    <a
                        @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
                        class="h-11 px-5 rounded-xl
                               border border-[#E5D8CC]
                               bg-white
                               text-[#7A6A60]
                               text-sm font-semibold
                               flex items-center
                               justify-center
                               hover:bg-brand-50
                               transition"
                    >
                        Batal
                    </a>


                    <!-- UPLOAD -->
                    <button
                        type="submit"
                        onclick="return validasiStatus()"
                        class="h-11 px-5 rounded-xl
                               bg-[#5C4033]
                               hover:bg-[#3E2B22]
                               text-white
                               text-sm font-semibold
                               flex items-center
                               justify-center
                               gap-2
                               transition"
                    >

                        <svg
                            class="w-4 h-4"
                            viewBox="0 0 20 20"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M10 13V4"/>
                            <path d="M6.5 7.5L10 4l3.5 3.5"/>
                            <path d="M4 12.5v2.5a1.5 1.5 0 001.5 1.5h9a1.5 1.5 0 001.5-1.5v-2.5"/>
                        </svg>

                        Upload Tugas

                    </button>

                </div>

            </form>

        </main>

    </div>


    <!-- ========================================================= -->
    <!-- BOTTOM NAV MOBILE -->
    <!-- ========================================================= -->

    <nav
        class="md:hidden fixed bottom-0 left-0 right-0
               bg-white border-t border-brand-100
               py-3.5 px-6 z-50
               shadow-[0_-4px_25px_rgba(0,0,0,0.06)]"
    >

        <div class="flex justify-between items-center">

            <!-- Beranda -->
            <a
                href="{{ url('/dashboard-guru') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium text-[#9E8E83]
                       hover:text-brand-800
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


            <!-- Isi Jurnal -->
            <a
                href="{{ route('jurnal.create') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium text-[#9E8E83]
                       hover:text-brand-800
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


            <!-- Riwayat -->
            <a
                href="{{ url('/riwayat-jurnal') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium text-[#9E8E83]
                       hover:text-brand-800
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


            <!-- Piket -->
            <a
                @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
                class="flex flex-col items-center gap-1
                       text-xs font-bold text-brand-800"
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

                <span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span>

            </a>


            <!-- Profil -->
            <a
                href="{{ url('/profil-guru') }}"
                class="flex flex-col items-center gap-1
                       text-xs font-medium text-[#9E8E83]
                       hover:text-brand-800
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
    <!-- SCRIPT PENCARIAN KELAS & MAPEL -->
    <!-- ========================================================= -->

    <script>

        /* =======================================================
           DATA KELAS
           ======================================================= */

        const daftarKelas = @json($kelasOptions);
        const daftarMapel = @json($mapelList->values());
        const daftarJadwal = @json($jadwalOptions);
        const inputKelas = document.getElementById('kelas');
        const inputMapel = document.getElementById('mapel');
        const jadwalSelect = document.getElementById('jadwalSelect');

        function cariKelas() {
            const keyword = document.getElementById('kelasSearch').value.toLowerCase().trim();
            const hasil = document.getElementById('hasilKelas');
            const filtered = daftarKelas.filter(kelas => window.matchesAllSearchTerms(keyword, 'kelas ' + kelas.label));
            hasil.replaceChildren();
            filtered.forEach((kelas, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'w-full text-left px-4 py-3 text-sm text-[#3E3028] hover:bg-[#F9F6F0]' + (index < filtered.length - 1 ? ' border-b border-[#EFE6DD]' : '');
                button.textContent = kelas.label;
                button.addEventListener('click', () => pilihKelas(kelas.id, kelas.label));
                hasil.append(button);
            });
            if (!filtered.length) hasil.innerHTML = '<div class="px-4 py-3 text-sm text-[#9E8E83]">Kelas tidak ditemukan.</div>';
        }

        function pilihKelas(id, label) {
            document.getElementById('kelasSearch').value = label;
            inputKelas.value = id;
            document.getElementById('hasilKelas').replaceChildren();
            document.getElementById('mapelSearch').value = '';
            inputMapel.value = '';
            jadwalSelect.value = '';
            cariMapel();
            perbaruiJadwal();
        }

        function cariMapel() {
            const keyword = document.getElementById('mapelSearch').value.toLowerCase().trim();
            const idKelas = inputKelas.value;
            const mapelTerjadwal = [...new Set(daftarJadwal.filter(j => !idKelas || String(j.id_kelas) === String(idKelas)).map(j => j.mapel))];
            const filtered = daftarMapel.filter(mapel => mapelTerjadwal.includes(mapel) && window.matchesAllSearchTerms(keyword, 'mapel ' + mapel));
            const hasil = document.getElementById('hasilMapel');
            hasil.replaceChildren();
            filtered.forEach((mapel, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'w-full text-left px-4 py-3 text-sm text-[#3E3028] hover:bg-[#F9F6F0]' + (index < filtered.length - 1 ? ' border-b border-[#EFE6DD]' : '');
                button.textContent = mapel;
                button.addEventListener('click', () => pilihMapel(mapel));
                hasil.append(button);
            });
            if (!filtered.length) hasil.innerHTML = '<div class="px-4 py-3 text-sm text-[#9E8E83]">Tidak ada mapel terjadwal untuk kelas ini hari ini.</div>';
        }

        function pilihMapel(mapel) {
            document.getElementById('mapelSearch').value = mapel;
            inputMapel.value = mapel;
            document.getElementById('hasilMapel').replaceChildren();
            perbaruiJadwal();
        }

        function perbaruiJadwal() {
            const tersedia = daftarJadwal.filter(j => String(j.id_kelas) === String(inputKelas.value) && j.mapel === inputMapel.value);
            jadwalSelect.replaceChildren();
            const awal = document.createElement('option');
            awal.value = '';
            awal.textContent = tersedia.length ? 'Pilih jam pelajaran' : 'Tidak ada sesi untuk pilihan ini';
            jadwalSelect.append(awal);
            tersedia.forEach(j => {
                const option = document.createElement('option');
                option.value = j.id;
                option.textContent = `Jam ke-${j.jam_ke} · ${j.jam_mulai}–${j.jam_selesai}`;
                jadwalSelect.append(option);
            });
            jadwalSelect.disabled = !tersedia.length;
        }

        cariKelas();
        cariMapel();

        function pilihStatus(status) {
            document.getElementById('status').value = status;
            document.getElementById('statusWarning').classList.add('hidden');
            const btnIzin = document.getElementById('btnIzin');
            const btnSakit = document.getElementById('btnSakit');
            const alasanWrapper = document.getElementById('alasanIzinWrapper');
            [btnIzin, btnSakit].forEach(btn => {
                btn.classList.remove('bg-[#5C4033]', 'text-white', 'border-[#5C4033]');
                btn.classList.add('bg-white', 'text-[#3E3028]', 'border-[#E5D8CC]');
            });
            const tombolAktif = status === 'izin' ? btnIzin : btnSakit;
            tombolAktif.classList.remove('bg-white', 'text-[#3E3028]', 'border-[#E5D8CC]');
            tombolAktif.classList.add('bg-[#5C4033]', 'text-white', 'border-[#5C4033]');
            if (status === 'izin') {
                alasanWrapper.classList.remove('hidden');
                alasanWrapper.classList.add('flex');
                document.getElementById('alasanIzin').required = true;
            } else {
                alasanWrapper.classList.add('hidden');
                alasanWrapper.classList.remove('flex');
                document.getElementById('alasanIzin').required = false;
                document.getElementById('alasanIzin').value = '';
            }
        }

        function validasiStatus() {
            const status = document.getElementById('status').value;
            if (!status) {
                document.getElementById('statusWarning').classList.remove('hidden');
                document.getElementById('statusWarning').scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            return true;
        }

    </script>

    @include('shared.preserve_search_scroll')
</body>
</html>
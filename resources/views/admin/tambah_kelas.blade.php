<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Kelas - JURNAL GURU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#F7F1EB',
                        brown: '#684838',
                        brownDark: '#56392D',
                        textBrown: '#4C382E',
                        softBrown: '#A88D7B',
                        borderBrown: '#E8DCD1'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-cream text-textBrown">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="flex w-[280px] shrink-0 flex-col border-r border-[#E5D8CC] bg-white">

            <!-- LOGO -->
            <div class="px-5 pt-6 pb-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#5C4033]">

                        <svg
                            class="h-5 w-5 text-white"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>

                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>

                        </svg>

                    </div>

                    <div>

                        <h1 class="font-bold text-[15px] leading-tight text-[#5C4033]">
                            JURNAL GURU
                        </h1>

                        <p class="mt-0.5 text-[11px] text-[#A08978]">
                            Guru
                        </p>

                    </div>

                </div>

            </div>

            <div class="mx-5 border-t border-[#E5D8CC]"></div>


            <!-- MENU -->
            <nav class="flex-1 overflow-y-auto px-3 py-4">

                <!-- MENU UTAMA -->
                <p class="mb-2 px-3.5 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                    Menu Utama
                </p>

                <div class="mb-5 flex flex-col gap-0.5">

                    <!-- DASHBOARD -->
                    <a href="{{ url('/dashboard-admin') }}"
                        class="flex items-center gap-3 rounded-lg bg-[#5C4033] px-3.5 py-2.5 text-sm font-semibold text-white">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M3 12l9-9 9 9"/>

                            <path d="M5 10v10h14V10"/>

                        </svg>

                        Dashboard
                    </a>


                    <!-- JADWAL -->
                    <a href="{{ route('jadwal.index') }}"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <rect x="3" y="4" width="18" height="18" rx="2"/>

                            <path d="M16 2v4M8 2v4M3 10h18"/>

                        </svg>

                        Jadwal
                    </a>

                    <!-- JURNAL -->
                    <a href="#"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>

                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>

                        </svg>

                        Jurnal
                    </a>


                    <!-- VERIFIKASI -->
                    <a href="#"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>

                            <circle cx="12" cy="12" r="3"/>

                        </svg>

                        Verifikasi
                    </a>


                    <!-- REKAP -->
                    <a href="#"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                            <path d="M14 2v6h6"/>

                            <path d="M16 13H8"/>

                            <path d="M16 17H8"/>

                            <path d="M10 9H8"/>

                        </svg>

                        Rekap
                    </a>

                </div>


                <!-- DATA -->
                <p class="mb-2 px-3.5 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                    Data
                </p>

                <div class="mb-5 flex flex-col gap-0.5">

                    <!-- GURU -->
                    <a href="{{ route('admin.guru') }}"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <circle cx="12" cy="8" r="4"/>

                            <path d="M4 21v-1a8 8 0 0 1 16 0v1"/>

                        </svg>

                        Guru
                    </a>


                    <!-- SISWA -->
                    <a href="{{ route('admin.siswa.index') }}"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M12 3l9 5-9 5-9-5 9-5z"/>

                            <path d="M6 10.5v4.5c0 1.5 2.5 3 6 3s6-1.5 6-3v-4.5"/>

                        </svg>

                        Siswa
                    </a>


                    <!-- KELAS -->
                    <a href="{{ route('admin.kelas.index') }}"
                        class="flex items-center gap-3 rounded-lg bg-[#F5EFE8] px-3.5 py-2.5 text-sm font-semibold text-[#5C4033]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <rect x="4" y="3" width="16" height="18" rx="1"/>

                            <path d="M14 12h.01"/>

                        </svg>

                        Kelas
                    </a>


                    <!-- MATA PELAJARAN -->
                    <a href="{{ route('mapel.index') }}"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M2 6c2-1 5-1 7 0v13c-2-1-5-1-7 0V6z"/>

                            <path d="M22 6c-2-1  -5-1-7 0v13c2-1 5-1 7 0V6z"/>

                        </svg>

                        Mata Pelajaran
                    </a>

                </div>


                <!-- PENGATURAN -->
                <p class="mb-2 px-3.5 text-[14px] font-semibold uppercase tracking-wider text-[#5C4033]">
                    Pengaturan
                </p>

                <div class="flex flex-col gap-0.5">

                    <!-- TAMBAH -->
                    <a href="{{ route('admin.kelas.create') }}"
                        class="flex items-center gap-3 rounded-lg bg-[#F5EFE8] px-3.5 py-2.5 text-sm font-semibold text-[#5C4033]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M12 5v14M5 12h14"/>

                        </svg>

                        Tambah
                    </a>


                    <!-- SEMESTER -->
                    <a href="{{ route('semester.index') }}"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <rect x="3" y="4" width="18" height="18" rx="2"/>

                            <path d="M16 2v4M8 2v4M3 10h18"/>

                            <path d="M9 15.5l1.8 1.8L15 13.5"/>

                        </svg>

                        Semester
                    </a>


                    <!-- JAM PELAJARAN -->
                    <a href="{{ route('jam-pelajaran.index') }}"
                        class="flex items-center gap-3 rounded-lg px-3.5 py-2.5 text-sm text-[#3E3028] transition hover:bg-[#F5EFE8]">

                        <svg
                            class="h-[18px] w-[18px] shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <circle cx="12" cy="13" r="8"/>

                            <path d="M12 9v4l3 2"/>

                            <path d="M5 3L3 5M19 3l2 2"/>

                        </svg>

                        Jam Pelajaran
                    </a>

                </div>

            </nav>


            <!-- PROFILE & LOGOUT -->
            <div class="border-t border-[#E5D8CC] px-4 py-4">

                <a href="{{ url('/profil-guru') }}"
                    class="mb-3 flex items-center gap-3 rounded-lg px-1.5 py-1.5 transition hover:bg-[#F5EFE8]">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#E8DFD6]">

                        <span class="text-xs font-bold text-[#5C4033]">
                            BS
                        </span>

                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-sm font-semibold text-[#3E3028]">
                            Budi Santoso
                        </p>

                        <p class="text-[11px] text-[#A08978]">
                            Guru
                        </p>

                    </div>

                </a>


                <a href="{{ url('/login') }}"
                    class="flex w-full items-center gap-3 rounded-lg px-1.5 py-2.5 text-sm font-semibold text-[#C62828] transition hover:bg-[#FFEBEE]">

                    Logout

                </a>

            </div>

        </aside>


        <!-- MAIN -->
        <main class="flex-1">

            <!-- HEADER -->
            <header class="flex items-start justify-between bg-[#684838] px-7 py-5 text-white">

                <div>

                    <p class="mb-1 text-xs text-[#D9B9A3]">
                        Data Master
                    </p>

                    <h1 class="text-2xl font-bold">
                        Tambah Kelas
                    </h1>

                    <p class="mt-3 text-xs font-semibold">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </p>

                </div>


                <div class="flex items-center gap-3">

                </div>

            </header>


            <!-- CONTENT -->
            <section class="px-7 py-8">

              

                <!-- JUDUL -->
                <div class="mb-6">

                    <h2 class="text-xl font-bold text-[#30251F]">
                        Form Tambah Kelas
                    </h2>

                    <p class="mt-1 text-sm text-[#806D60]">
                        Tambahkan data kelas baru ke dalam sistem.
                    </p>

                </div>


                <!-- CARD -->
                <div class="max-w-4xl overflow-hidden rounded-xl border border-[#E8DCD1] bg-white shadow-sm">

                    <!-- CARD HEADER -->
                    <div class="flex items-center gap-4 border-b border-[#E8DCD1] px-7 py-6">

                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-[#684838] text-white">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">

                                <rect x="3" y="4" width="18" height="16" rx="2"/>

                                <path d="M7 8h10M7 12h10M7 16h6"/>

                            </svg>

                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-[#684838]">
                                Informasi Kelas
                            </h3>

                            <p class="mt-1 text-sm text-[#8B7768]">
                                Isi data kelas dengan benar.
                            </p>

                        </div>

                    </div>


                    <!-- FORM -->
                    <form action="{{ route('admin.kelas.store') }}"
                        method="POST"
                        class="px-7 py-7">

                        @csrf


                        <!-- ERROR -->
                        @if ($errors->any())

                            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                                <ul class="list-inside list-disc">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <!-- TINGKAT -->
                        <div class="mb-7">

                            <label
                                for="tingkat"
                                class="mb-3 block text-sm font-bold text-[#684838]">

                                Tingkat Kelas
                                <span class="text-red-500">*</span>

                            </label>

                            <select
                                id="tingkat"
                                name="tingkat"
                                required
                                class="w-full rounded-xl border border-[#E5D9CF] bg-white px-4 py-3.5 text-sm text-[#4C382E] outline-none transition focus:border-[#684838] focus:ring-2 focus:ring-[#EAD8C7]">

                                <option value="">
                                    -- Pilih Tingkat --
                                </option>

                                <option value="10" {{ old('tingkat') == 10 ? 'selected' : '' }}>
                                    X
                                </option>

                                <option value="11" {{ old('tingkat') == 11 ? 'selected' : '' }}>
                                    XI
                                </option>

                                <option value="12" {{ old('tingkat') == 12 ? 'selected' : '' }}>
                                    XII
                                </option>

                            </select>

                            <p class="mt-2 text-xs text-[#8B7768]">
                                Pilih tingkat kelas X, XI, atau XII.
                            </p>

                        </div>


                        <!-- JURUSAN -->
                        <div class="mb-7">

                            <label
                                for="jurusan"
                                class="mb-3 block text-sm font-bold text-[#684838]">

                                Jurusan
                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="jurusan"
                                name="jurusan"
                                value="{{ old('jurusan') }}"
                                placeholder="Contoh: RPL"
                                required
                                class="w-full rounded-xl border border-[#E5D9CF] bg-white px-4 py-3.5 text-sm text-[#4C382E] outline-none transition placeholder:text-[#A99B91] focus:border-[#684838] focus:ring-2 focus:ring-[#EAD8C7]">

                        </div>


                        <!-- ROMBEL -->
                        <div class="mb-7">

                            <label
                                for="rombel"
                                class="mb-3 block text-sm font-bold text-[#684838]">

                                Rombel
                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="number"
                                id="rombel"
                                name="rombel"
                                value="{{ old('rombel') }}"
                                min="1"
                                placeholder="Contoh: 2"
                                required
                                class="w-full rounded-xl border border-[#E5D9CF] bg-white px-4 py-3.5 text-sm text-[#4C382E] outline-none transition placeholder:text-[#A99B91] focus:border-[#684838] focus:ring-2 focus:ring-[#EAD8C7]">

                        </div>


                        <!-- BUTTON -->
                        <div class="mt-8 flex justify-end gap-3 border-t border-[#E8DCD1] pt-6">

                            <a
                                href="{{ route('admin.kelas.index') }}"
                                class="rounded-xl border border-[#CBB9AA] bg-white px-6 py-3 text-sm font-semibold text-[#684838] transition hover:bg-[#F7F1EB]">

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="rounded-xl bg-[#684838] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#56392D]">

                                Simpan Kelas

                            </button>

                        </div>

                    </form>

                </div>

            </section>

        </main>

    </div>

</body>

</html>
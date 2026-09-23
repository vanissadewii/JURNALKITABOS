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
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                       text-[#3E3028] hover:bg-[#F5EFE8]"
            >

                <svg
                    class="w-[18px] h-[18px]"
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


            {{-- JADWAL --}}
            <a
                href="{{ route('jadwal.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                       text-[#3E3028] hover:bg-[#F5EFE8]"
            >

                <svg
                    class="w-[18px] h-[18px]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <path d="M16 2v4M8 2v4M3 10h18"/>
                </svg>

                Jadwal

            </a>


            {{-- JURNAL --}}
            <a
                href="{{ route('admin.jurnal') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                       text-[#3E3028] hover:bg-[#F5EFE8]"
            >

                <svg
                    class="w-[18px] h-[18px]"
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


            {{-- VERIFIKASI --}}
            <a
                href="{{ route('admin.verifikasi') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-sm
                       text-[#3E3028] hover:bg-[#F5EFE8]"
            >

                <svg
                    class="w-[18px] h-[18px]"
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
                    class="w-[18px] h-[18px]"
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


            {{-- ===================================== --}}
            {{-- TAMBAH --}}
            {{-- ===================================== --}}

            <details class="mt-1 group">

                <summary
                    class="list-none cursor-pointer flex items-center justify-between
                           px-3.5 py-2.5 rounded-lg text-sm text-[#3E3028]
                           hover:bg-[#F5EFE8] transition"
                >

                    <span class="flex items-center gap-3">

                        <svg
                            class="w-[18px] h-[18px]"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>

                        <span>
                            Tambah
                        </span>

                    </span>


                    <svg
                        class="w-4 h-4 text-[#7A6A60]
                               transition-transform duration-200
                               group-open:rotate-180"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M6 9l6 6 6-6"/>
                    </svg>

                </summary>


                {{-- SUBMENU --}}
                <div class="mt-1 ml-3 pl-3 border-l border-[#E5D8CC]">

                    <div class="flex flex-col gap-0.5">

                        <a
                            href="{{ route('admin.tambah.admin') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Admin
                        </a>


                        <a
                            href="{{ route('admin.tambah.jadwal') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Jadwal
                        </a>


                        <a
                            href="{{ route('admin.tambah.jam') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Jam Pelajaran
                        </a>


                        <a
                            href="{{ route('admin.tambah.mapel') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Mata Pelajaran
                        </a>


                        <a
                            href="{{ route('admin.tambah.kelas') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Kelas
                        </a>


                        <a
                            href="{{ route('admin.tambah.semester') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Semester
                        </a>

                        <a
                            href="{{ route('admin.tambah.piket') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Piket
                        </a>

                        <a
                            href="{{ route('admin.tambah.siswa') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            Siswa
                        </a>


                        <a
                            href="{{ route('admin.tambah.user') }}"
                            class="px-3 py-2 rounded-lg text-[13px]
                                   text-[#3E3028] hover:bg-[#F5EFE8]"
                        >
                            User
                        </a>

                    </div>

                </div>

            </details>

        </div>

    </nav>


    {{-- PROFILE --}}
    <div class="border-t border-[#E5D8CC] px-4 py-4">

        <div class="flex items-center gap-3 px-1.5">

            <div class="w-8 h-8 rounded-full bg-[#E8DFD6]
                        flex items-center justify-center">

                <span class="text-xs font-bold text-[#5C4033]">
                    AT
                </span>

            </div>

            <div>

                <p class="text-sm font-semibold">
                    Admin Testing
                </p>

                <p class="text-[11px] text-[#A08978]">
                    Administrator
                </p>

            </div>

        </div>

    </div>

</aside>
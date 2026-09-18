<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kelas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen">

    <div class="md:flex">

        {{-- SIDEBAR DESKTOP --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:h-screen md:sticky md:top-0
                       bg-white border-r border-[#E5D8CC] py-6 px-4">

            <div class="mb-8 px-2">
                <h1 class="font-['Poppins'] font-bold text-xl text-[#5C4033]">
                    JURNAL GURU
                </h1>

                <p class="text-md text-[#7A6A60] mt-1">
                    Akun Kelas
                </p>
            </div>

            <nav class="flex flex-col gap-1">

                {{-- DASBOR --}}
                <a href="{{ route('kelas.beranda') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>

                    Dasbor
                </a>


                {{-- SCAN --}}
                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>

                    Scan
                </a>


                {{-- KIRIM JURNAL --}}
                <a href="{{ route('kelas.kirim-jurnal') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M22 2L11 13"/>
                        <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                    </svg>

                    Kirim Jurnal
                </a>


                {{-- PROFIL AKTIF --}}
                <a href="{{ route('kelas.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">

                    <svg class="w-5 h-5 shrink-0"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
                    </svg>

                    Profil
                </a>

            </nav>
        </aside>


        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">

                <span class="text-white text-xl md:text-3xl font-['Poppins'] font-bold">
                    Profil Kelas XI RPL 2
                </span>

                <span class="text-[#D7B899] text-xs font-medium mt-0.8">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>

            </div>


            {{-- ISI --}}
            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-3.5">

                {{-- JUDUL --}}
                <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028] mt-1">
                    Informasi Kelas
                </span>


                {{-- KARTU INFORMASI KELAS --}}
                <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px] md:p-5
                            flex flex-col gap-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

                    {{-- Sekretaris (bisa 2 orang) --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-xs sm:text-sm text-[#7A6A60]">
                            Sekretaris
                        </span>

                        <span class="font-semibold text-sm sm:text-base text-[#3E3028]">
                            1. Seren Khanza Azila
                        </span>

                        <span class="font-semibold text-sm sm:text-base text-[#3E3028]">
                            2. Nama Sekretaris 2
                        </span>
                    </div>

                    <hr class="border-t border-[#E5D8CC] w-full m-0">


                    {{-- JUMLAH SISWA --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-xs sm:text-sm text-[#7A6A60]">
                            Jumlah Siswa
                        </span>

                        <span class="font-semibold text-sm sm:text-base text-[#3E3028]">
                            36 Siswa
                        </span>
                    </div>

                    <hr class="border-t border-[#E5D8CC] w-full m-0">

                    {{-- HUBUNGI ADMIN --}}
                    <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 sm:p-[18px]
                                flex items-center justify-between gap-3
                                shadow-[0_4px_12px_rgba(62,48,40,0.03)]">

                    <div>
                        <div class="font-['Inter'] font-semibold text-sm text-[#3E3028]">
                            Butuh bantuan?
                        </div>

                        <div class="text-xs sm:text-[13px] text-[#7A6A60] mt-0.5">
                            Hubungi admin jika ada kendala.
                        </div>
                    </div>

                    <button type="button"
                            onclick="hubungiAdmin()"
                            class="shrink-0 px-3 py-2 rounded-lg bg-[#F5EFE8] text-[#5C4033]
                                   text-xs sm:text-sm font-semibold hover:bg-[#EDE3D9]">

                        Hubungi

                    </button>

                </div>


                {{-- EDIT PROFIL --}}
                <button type="button"
                        onclick="openEditProfile()"
                        class="w-full bg-[#5C4033] text-white rounded-[10px]
                               px-4 py-3 sm:py-3.5
                               font-['Inter'] font-semibold text-sm
                               hover:bg-[#4B3329]">

                    Edit Profil

                </button>


                {{-- KELUAR AKUN --}}
                <button type="button"
                        class="w-full bg-[#FFEBEE] text-[#C62828] rounded-[10px]
                               px-4 py-3 sm:py-3.5
                               font-['Inter'] font-semibold text-sm
                               hover:bg-[#FFE0E3]">

                    Keluar Akun

                </button>

            </div>

        </main>

    </div>


    {{-- ================================================= --}}
    {{-- POPUP EDIT PROFIL --}}
    {{-- ================================================= --}}

    <div id="editProfileModal"
         class="hidden fixed inset-0 z-[100]
                bg-black/40
                flex items-center justify-center
                px-4 py-6">

        {{-- KOTAK POPUP --}}
        <div class="bg-white w-full max-w-[500px]
                    max-h-[90vh] overflow-y-auto
                    rounded-[12px]
                    shadow-[0_10px_35px_rgba(0,0,0,0.15)]">


            {{-- HEADER POPUP --}}
            <div class="px-5 py-4 sm:px-6 sm:py-5
                        border-b border-[#E5D8CC]
                        flex items-center justify-between">

                <div>
                    <h2 class="font-['Poppins'] font-bold text-lg sm:text-xl text-[#3E3028]">
                        Edit Profil
                    </h2>

                    <p class="text-xs sm:text-sm text-[#7A6A60] mt-1">
                        Ubah informasi kelas
                    </p>
                </div>


                {{-- TOMBOL X --}}
                <button type="button"
                        onclick="closeEditProfile()"
                        class="w-8 h-8 flex items-center justify-center
                               rounded-lg text-[#7A6A60]
                               hover:bg-[#F5EFE8]
                               text-xl">

                    &times;

                </button>

            </div>


            {{-- FORM --}}
            <form class="p-5 sm:p-6">

                <div class="flex flex-col gap-4">


                    {{-- SEKRETARIS 1 --}}
                    <div>

                        <label class="block text-sm font-semibold text-[#3E3028] mb-1.5">
                            Sekretaris 1
                        </label>

                        <input type="text"
                               name="sekretaris_1"
                               value="Seren Khanza Azila"
                               class="w-full px-3.5 py-3 rounded-lg
                                      border border-[#E5D8CC]
                                      bg-white
                                      text-sm text-[#3E3028]
                                      outline-none
                                      focus:border-[#5C4033]
                                      focus:ring-1 focus:ring-[#5C4033]">

                    </div>


                    {{-- SEKRETARIS 2 --}}
                    <div>

                        <label class="block text-sm font-semibold text-[#3E3028] mb-1.5">
                            Sekretaris 2
                        </label>

                        <input type="text"
                               name="sekretaris_2"
                               value="Nama Sekretaris 2"
                               class="w-full px-3.5 py-3 rounded-lg
                                      border border-[#E5D8CC]
                                      bg-white
                                      text-sm text-[#3E3028]
                                      outline-none
                                      focus:border-[#5C4033]
                                      focus:ring-1 focus:ring-[#5C4033]">

                    </div>


                    {{-- JUMLAH SISWA --}}
                    <div>

                        <label class="block text-sm font-semibold text-[#3E3028] mb-1.5">
                            Jumlah Siswa
                        </label>

                        <input type="number"
                               name="jumlah_siswa"
                               value="36"
                               class="w-full px-3.5 py-3 rounded-lg
                                      border border-[#E5D8CC]
                                      bg-white
                                      text-sm text-[#3E3028]
                                      outline-none
                                      focus:border-[#5C4033]
                                      focus:ring-1 focus:ring-[#5C4033]">

                    </div>

                    {{-- PEMBATAS --}}
                    <div class="border-t border-[#E5D8CC] my-1"></div>


                    {{-- PASSWORD LAMA --}}
                    <div>

                        <label class="block text-sm font-semibold text-[#3E3028] mb-1.5">
                            Password Lama
                        </label>

                        <div class="relative">

                            <input id="oldPassword"
                                   name="password_lama"
                                   type="password"
                                   placeholder="Masukkan password lama"
                                   class="w-full px-3.5 py-3 pr-11 rounded-lg
                                          border border-[#E5D8CC]
                                          bg-white
                                          text-sm text-[#3E3028]
                                          outline-none
                                          focus:border-[#5C4033]
                                          focus:ring-1 focus:ring-[#5C4033]">


                            {{-- ICON MATA --}}
                            <button type="button"
                                    onclick="togglePassword('oldPassword')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2
                                           text-[#7A6A60]
                                           hover:text-[#5C4033]">

                                <svg class="w-5 h-5"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                                    <circle cx="12" cy="12" r="3"/>

                                </svg>

                            </button>

                        </div>

                    </div>


                    {{-- PASSWORD BARU --}}
                    <div>

                        <label class="block text-sm font-semibold text-[#3E3028] mb-1.5">
                            Password Baru
                        </label>

                        <div class="relative">

                            <input id="newPassword"
                                   name="password_baru"
                                   type="password"
                                   placeholder="Masukkan password baru"
                                   class="w-full px-3.5 py-3 pr-11 rounded-lg
                                          border border-[#E5D8CC]
                                          bg-white
                                          text-sm text-[#3E3028]
                                          outline-none
                                          focus:border-[#5C4033]
                                          focus:ring-1 focus:ring-[#5C4033]">


                            {{-- ICON MATA --}}
                            <button type="button"
                                    onclick="togglePassword('newPassword')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2
                                           text-[#7A6A60]
                                           hover:text-[#5C4033]">

                                <svg class="w-5 h-5"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                                    <circle cx="12" cy="12" r="3"/>

                                </svg>

                            </button>

                        </div>

                    </div>

                </div>


                {{-- TOMBOL BATAL & SIMPAN --}}
                <div class="flex gap-3 mt-6">

                    {{-- BATAL --}}
                    <button type="button"
                            onclick="closeEditProfile()"
                            class="flex-1 px-4 py-3
                                   rounded-lg
                                   border border-[#E5D8CC]
                                   bg-white
                                   text-[#5C4033]
                                   text-sm font-semibold
                                   hover:bg-[#F5EFE8]">

                        Batal

                    </button>


                    {{-- SIMPAN --}}
                    <button type="button"
                            onclick="saveProfile()"
                            class="flex-1 px-4 py-3
                                   rounded-lg
                                   bg-[#5C4033]
                                   text-white
                                   text-sm font-semibold
                                   hover:bg-[#4B3329]">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- BOTTOM NAV MOBILE --}}
    {{-- ================================================= --}}

    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px]
                bg-white border-t border-[#E5D8CC]
                flex z-50">

        {{-- DASBOR --}}
        <a href="{{ route('kelas.beranda') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="M3 12l9-9 9 9"/>
                <path d="M5 10v10h14V10"/>

            </svg>

            Dasbor
        </a>


        {{-- SCAN --}}
        <a href="{{ route('kelas.scan') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>

            </svg>

            Scan
        </a>


        {{-- KIRIM JURNAL --}}
        <a href="{{ route('kelas.kirim-jurnal') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="M22 2L11 13"/>
                <path d="M22 2l-7 20-4-9-9-4 20-7z"/>

            </svg>

            Kirim Jurnal
        </a>


        {{-- PROFIL AKTIF --}}
        <a href="{{ route('kelas.profile') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#5C4033] font-semibold">

            <svg class="w-5 h-5"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>

            </svg>

            Profil
        </a>

    </nav>


    {{-- ================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ================================================= --}}

    <script>

        // BUKA POPUP EDIT PROFIL
        function openEditProfile() {

            const modal = document.getElementById('editProfileModal');

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

        }


        // TUTUP POPUP EDIT PROFIL
        function closeEditProfile() {

            const modal = document.getElementById('editProfileModal');

            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }


        // LIHAT / SEMBUNYIKAN PASSWORD
        function togglePassword(inputId) {

            const input = document.getElementById(inputId);

            if (input.type === 'password') {

                input.type = 'text';

            } else {

                input.type = 'password';

            }

        }


        // TOMBOL SIMPAN
        // Sementara hanya menutup popup karena belum terhubung database
        function saveProfile() {

            closeEditProfile();

        }


        // TOMBOL HUBUNGI -> LANGSUNG KE WHATSAPP ADMIN
        // Nomor & pesan masih hardcode di frontend (belum ambil dari database)
        function hubungiAdmin() {

            const nomorAdmin = '6281234567890'; // ganti dengan nomor WA admin asli, format 62xxxxxxxxxx tanpa + atau 0 di depan

            const pesan = 'Hallo Admin\nSaya dari Kelas:\nKendala:';

            const url = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(pesan)}`;

            window.open(url, '_blank');

        }


        // KLIK AREA GELAP UNTUK MENUTUP POPUP
        document.getElementById('editProfileModal').addEventListener('click', function(event) {

            if (event.target === this) {

                closeEditProfile();

            }

        });

    </script>

</body>
</html>
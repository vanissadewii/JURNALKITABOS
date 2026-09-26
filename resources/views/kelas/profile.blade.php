<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kelas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
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

                <a href="{{ route('kelas.beranda') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <path d="M3 12l9-9 9 9" />
                        <path d="M5 10v10h14V10" />
                    </svg>

                    Beranda
                </a>


                {{-- SCAN --}}
                <a href="{{ route('kelas.scan') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">

                    <svg class="w-5 h-5 shrink-0"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
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
                        <path d="M22 2L11 13" />
                        <path d="M22 2l-7 20-4-9-9-4 20-7z" />
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
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
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
                    Profil Kelas {{ $kelas->nama_kelas }}
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

                    {{-- JUMLAH SISWA --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-xs sm:text-sm text-[#7A6A60]">
                            Jumlah Siswa
                        </span>

                        <span class="font-semibold text-sm sm:text-base text-[#3E3028]">
                            {{ $jumlahSiswa }} Siswa
                        </span>
                    </div>

                    <hr class="border-t border-[#E5D8CC] w-full m-0">

                    @if (session('success'))
                    <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('kelas.profile.update') }}" class="flex flex-col gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 shadow-[0_4px_12px_rgba(62,48,40,0.03)]">
                    @csrf
                    @method('PUT')
                    @foreach ([['id_ketua_kelas', 'Ketua Kelas'], ['id_sekretaris_1', 'Sekretaris 1'], ['id_sekretaris_2', 'Sekretaris 2']] as [$field, $label])
                        <label for="{{ $field }}" class="text-sm font-semibold text-[#3E3028]">{{ $label }}</label>
                        <select id="{{ $field }}" name="{{ $field }}" class="h-11 rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033]">
                            <option value="">Pilih siswa</option>
                            @foreach ($siswa as $calon)
                                <option value="{{ $calon->id_siswa }}" @selected(old($field, $user->{$field}) == $calon->id_siswa)>{{ $calon->nama }}{{ $calon->no_absen ? ' • No. '.$calon->no_absen : '' }}</option>
                            @endforeach
                        </select>
                    @endforeach
                    <button type="submit" class="w-fit rounded-lg bg-[#5C4033] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#452F26]">Simpan Profil</button>
                </form>

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

                {{-- KELUAR AKUN --}}
                <button type="button"
                    onclick="openLogoutConfirm()"
                    class="w-full h-[45px] rounded-lg bg-red-600 text-white flex items-center justify-center text-sm font-semibold cursor-pointer border-0">
                    Log Out
                </button>
            </div>

        </main>

    </div>


    {{-- MODAL KONFIRMASI LOGOUT --}}
    <div id="logoutConfirmModal"
        class="hidden fixed inset-0 z-[100]
                bg-black/40
                flex items-center justify-center
                px-4 py-6">

        <div class="bg-white w-full max-w-[380px]
                    rounded-[12px]
                    shadow-[0_10px_35px_rgba(0,0,0,0.15)]
                    p-5 sm:p-6">

            <h2 class="font-['Poppins'] font-bold text-lg text-[#3E3028] mb-2">
                Konfirmasi Logout
            </h2>

            <p class="text-sm text-[#7A6A60] mb-6">
                Apakah Anda yakin ingin keluar dari akun ini?
            </p>

            <div class="flex gap-3">
                <button type="button"
                    onclick="closeLogoutConfirm()"
                    class="flex-1 px-4 py-3 rounded-lg
                           border border-[#E5D8CC]
                           bg-white text-[#5C4033]
                           text-sm font-semibold
                           hover:bg-[#F5EFE8]">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-3 rounded-lg
                               bg-red-600 text-white
                               text-sm font-semibold
                               hover:bg-red-700">
                        Ya, Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>


    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px]
                bg-white border-t border-[#E5D8CC]
                flex z-50">

        <a href="{{ route('kelas.beranda') }}"
            class="flex-1 flex flex-col items-center justify-center gap-1
                  text-[11px] text-[#7A6A60]">

            <svg class="w-5 h-5"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <path d="M3 12l9-9 9 9" />
                <path d="M5 10v10h14V10" />

            </svg>

            Beranda
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

                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />

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

                <path d="M22 2L11 13" />
                <path d="M22 2l-7 20-4-9-9-4 20-7z" />

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

                <circle cx="12" cy="8" r="4" />
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />

            </svg>

            Profil
        </a>

    </nav>

    <script>
        function hubungiAdmin() {
            let nomorAdmin = String(@json($adminPhone ?? '')).replace(/\D/g, '');
            if (!nomorAdmin) { alert('Nomor telepon admin belum diatur.'); return; }
            if (nomorAdmin.startsWith('0')) nomorAdmin = `62${nomorAdmin.slice(1)}`;
            else if (!nomorAdmin.startsWith('62')) nomorAdmin = `62${nomorAdmin}`;
            const pesan = `Hallo Admin\nSaya dari kelas {{ $kelas->nama_kelas }}\nKendala:`;
            window.open(`https://wa.me/${nomorAdmin}?text=${encodeURIComponent(pesan)}`, '_blank');
        }

        // BUKA / TUTUP KONFIRMASI LOGOUT
        function openLogoutConfirm() {

            document.getElementById('logoutConfirmModal').classList.remove('hidden');

            document.body.classList.add('overflow-hidden');

        }

        function closeLogoutConfirm() {

            document.getElementById('logoutConfirmModal').classList.add('hidden');

            document.body.classList.remove('overflow-hidden');

        }

        // KLIK AREA GELAP UNTUK MENUTUP KONFIRMASI LOGOUT
        document.getElementById('logoutConfirmModal').addEventListener('click', function(event) {

            if (event.target === this) {

                closeLogoutConfirm();

            }

        });
    </script>

</body>

</html>
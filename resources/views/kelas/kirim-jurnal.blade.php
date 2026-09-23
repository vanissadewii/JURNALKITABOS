<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Jurnal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div class="md:flex md:min-h-screen">

        {{-- SIDEBAR DESKTOP --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:min-h-screen md:h-auto md:sticky md:top-0
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
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9" />
                        <path d="M5 10v10h14V10" />
                    </svg>
                    Dasbor
                </a>

                <a href="{{ route('kelas.scan') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    Scan
                </a>

                <a href="{{ route('kelas.kirim-jurnal') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13" />
                        <path d="M22 2l-7 20-4-9-20-7z" />
                    </svg>
                    Kirim Jurnal
                </a>

                <a href="{{ route('kelas.profile') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
                    </svg>
                    Profil
                </a>

            </nav>
        </aside>


        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full min-w-0 pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">
                <span class="text-white text-xl md:text-3xl font-['Poppins'] font-bold">
                    Kirim Jurnal
                </span>
                <span class="text-[#D7B899] text-xs font-medium mt-0.8">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>
            </div>


            {{-- ISI --}}
            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

                <div class="flex items-center justify-between mt-1">
                    <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028]">
                        Rekap Jurnal Mengajar Hari Ini
                    </span>
                </div>


                {{-- TABEL REKAP --}}
                <div class="w-full max-w-full bg-white border border-[#E5D8CC] rounded-[10px]
                            shadow-[0_4px_12px_rgba(62,48,40,0.03)] overflow-x-auto">

                    <table class="min-w-[1200px] w-full text-left border-collapse">

                        <thead>
                            <tr class="bg-[#F5EFE8]">
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-r border-[#E5D8CC]">
                                    Jam Ke-
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-r border-[#E5D8CC]">
                                    Nama Pengajar
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-r border-[#E5D8CC]">
                                    Mata Pelajaran
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-r border-[#E5D8CC] text-center">
                                    Hadir
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-r border-[#E5D8CC] text-center">
                                    Tidak Hadir<br>
                                    <span class="normal-case font-medium">(Tugas)</span>
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] border-b border-r border-[#E5D8CC] min-w-[260px]">
                                    Materi
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-r border-[#E5D8CC] text-center">
                                    Jumlah Hadir Siswa
                                </th>
                                <th class="px-5 py-4 text-[11px] font-semibold uppercase text-[#5C4033] whitespace-nowrap border-b border-[#E5D8CC] min-w-[200px]">
                                    Siswa Tidak Hadir<br>
                                    <span class="normal-case font-medium">(Nama - S/I/A/D)</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($rekap as $s)
                            @php
                            $j = $s->jurnal;
                            $jam = $s->jam_ke_mulai === $s->jam_ke_sampai
                            ? $s->jam_ke_mulai
                            : "{$s->jam_ke_mulai} - {$s->jam_ke_sampai}";

                            $terverifikasi = $j && $j->status_kehadiran_guru === 'hadir' && $j->status_verifikasi === 'terverifikasi';
                            $menunggu = $j && $j->status_kehadiran_guru === 'hadir' && $j->status_verifikasi !== 'terverifikasi';
                            $guruTidakHadir = $j && $j->status_kehadiran_guru !== 'hadir';
                            $kode = ['Sakit' => 'S', 'Izin' => 'I', 'Alpha' => 'A'];
                            @endphp

                            <tr class="border-b border-[#E5D8CC] align-top">
                                <td class="px-5 py-4 text-[13px] text-[#3E3028] whitespace-nowrap border-r border-[#E5D8CC]">{{ $jam }}</td>
                                <td class="px-5 py-4 text-[13px] text-[#3E3028] whitespace-nowrap border-r border-[#E5D8CC]">{{ $s->guru }}</td>
                                <td class="px-5 py-4 text-[13px] text-[#3E3028] whitespace-nowrap border-r border-[#E5D8CC]">{{ $s->mapel }}</td>

                                {{-- HADIR --}}
                                <td class="px-5 py-4 text-center border-r border-[#E5D8CC]">
                                    @if ($terverifikasi)
                                    <span class="text-[#2E7D32] font-bold">✓</span>
                                    @elseif ($menunggu)
                                    <span class="text-[11px] font-semibold text-[#F57F17]">Menunggu scan</span>
                                    @elseif ($guruTidakHadir || $s->status === 'Selesai')
                                    <span class="text-[#C62828] font-bold">✕</span>
                                    @else
                                    <span class="text-[13px] text-[#7A6A60]">-</span>
                                    @endif
                                </td>

                                {{-- TIDAK HADIR (TUGAS) --}}
                                <td class="px-5 py-4 text-center border-r border-[#E5D8CC]">
                                    @if ($guruTidakHadir)
                                    <span class="text-[#2E7D32] font-bold">✓</span>
                                    @elseif ($terverifikasi || $menunggu)
                                    <span class="text-[#C62828] font-bold">✕</span>
                                    @else
                                    <span class="text-[13px] text-[#7A6A60]">-</span>
                                    @endif
                                </td>

                                {{-- MATERI --}}
                                <td class="px-5 py-4 text-[13px] text-[#3E3028] whitespace-normal break-words min-w-[260px] border-r border-[#E5D8CC]">
                                    {{ $j?->materi ?: '-' }}
                                </td>

                                {{-- JUMLAH HADIR SISWA --}}
                                <td class="px-5 py-4 text-[13px] text-[#3E3028] text-center whitespace-nowrap border-r border-[#E5D8CC]">
                                    {{ $j?->jumlah_hadir ?? '-' }}
                                </td>

                                {{-- SISWA TIDAK HADIR (kode D / dispen menyusul setelah fitur guru piket jadi) --}}
                                <td class="px-5 py-4 text-[13px] text-[#3E3028]">
                                    @if ($j && $j->absenSiswa->isNotEmpty())
                                    <div class="flex flex-col gap-1.5">
                                        @foreach ($j->absenSiswa as $a)
                                        <div class="flex items-start gap-2">
                                            <span class="break-words leading-6">{{ $a->nama }}</span>
                                            <span class="w-6 h-6 flex items-center justify-center rounded-md bg-[#FFEBEE] text-[#C62828] border border-[#FFCDD2] font-bold text-[11px] shrink-0">
                                                {{ $kode[$a->status] ?? '-' }}
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <span class="text-[#7A6A60]">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-5 py-8 text-center text-[13px] text-[#7A6A60]">
                                    Tidak ada jadwal pelajaran hari ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                @if (session('success'))
                <div class="bg-[#E8F5E9] border border-[#C8E6C9] text-[#2E7D32] text-sm font-medium rounded-[10px] p-3">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="bg-[#FFEBEE] border border-[#FFCDD2] text-[#C62828] text-sm font-medium rounded-[10px] p-3">
                    {{ session('error') }}
                </div>
                @endif

                {{-- STATUS SESI --}}
                <div class="w-full rounded-[10px] p-4 mt-2 border {{ $semuaSelesai ? 'bg-[#E8F5E9] border-[#C8E6C9]' : 'bg-[#F0EBE6] border-[#D9CDC3]' }}">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ $semuaSelesai ? 'bg-[#4CAF50]' : 'bg-[#B0A59B]' }}">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                                <path d="M5 12l4 4L19 6" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-['Poppins'] font-bold text-sm {{ $semuaSelesai ? 'text-[#2E7D32]' : 'text-[#7A6A60]' }}">
                                {{ $semuaSelesai ? 'Semua sesi hari ini sudah selesai' : 'Masih ada sesi yang belum selesai' }}
                            </p>
                            <p class="text-xs mt-1 {{ $semuaSelesai ? 'text-[#4E6B50]' : 'text-[#9C8B80]' }}">
                                {{ $semuaSelesai ? 'Jurnal hari ini sudah lengkap dan siap dikirim.' : 'Tombol kirim aktif setelah semua sesi hari ini selesai.' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL KIRIM --}}
                @if ($pengiriman)
                <div class="w-full bg-[#E8F5E9] border border-[#C8E6C9] text-[#2E7D32] py-3.5 rounded-lg font-semibold text-sm text-center mt-1">
                    Jurnal hari ini sudah dikirim pukul {{ $pengiriman->dikirim_at->format('H:i') }} WIB
                </div>
                @else
                <form method="POST" action="{{ route('kelas.kirim-jurnal.store') }}">
                    @csrf
                    <button type="submit"
                        @disabled(! $semuaSelesai)
                        class="w-full text-white py-3.5 rounded-lg font-semibold text-sm transition duration-200 mt-1
                       {{ $semuaSelesai ? 'bg-[#5C4033] hover:bg-[#432D23] cursor-pointer' : 'bg-[#A89B90] cursor-not-allowed opacity-70' }}">
                        <span class="inline-flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13" />
                                <path d="M22 2l-7 20-4-9-9-4 20-7z" />
                            </svg>
                            Kirim Jurnal Hari Ini
                        </span>
                    </button>
                </form>

                <p class="text-center text-[11px] text-[#7A6A60]">
                    Pastikan seluruh jurnal hari ini sudah benar sebelum dikirim.
                </p>
                @endif

            </div>
        </main>
    </div>


    {{-- BOTTOM NAV MOBILE --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}"
            class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12l9-9 9 9" />
                <path d="M5 10v10h14V10" />
            </svg>
            Dasbor
        </a>
        <a href="{{ route('kelas.scan') }}"
            class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Scan
        </a>
        <a href="{{ route('kelas.kirim-jurnal') }}"
            class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 2L11 13" />
                <path d="M22 2l-7 20-4-9-20-7z" />
            </svg>
            Kirim Jurnal
        </a>
        <a href="{{ route('kelas.profile') }}"
            class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
            </svg>
            Profil
        </a>
    </nav>


    <script>
        let isStatusSelesai = false;

        function toggleStatusSelesai() {
            isStatusSelesai = !isStatusSelesai;

            const btnStatus = document.getElementById('btnStatusSelesai');
            const iconStatus = document.getElementById('iconStatus');
            const judulStatus = document.getElementById('judulStatus');
            const subStatus = document.getElementById('subStatus');
            const btnKirim = document.getElementById('btnKirimJurnal');

            if (isStatusSelesai) {
                btnStatus.className = "w-full text-left bg-[#E8F5E9] border border-[#C8E6C9] rounded-[10px] p-4 mt-2 transition-all duration-200 hover:bg-[#DFF0E0] active:scale-[0.99] cursor-pointer select-none";
                iconStatus.className = "w-8 h-8 rounded-lg bg-[#4CAF50] flex items-center justify-center shrink-0 transition-colors duration-200";
                judulStatus.className = "font-['Poppins'] font-bold text-sm text-[#2E7D32] transition-colors duration-200";
                judulStatus.textContent = "Semua sesi hari ini sudah selesai";
                subStatus.className = "text-xs text-[#4E6B50] mt-1 transition-colors duration-200";
                subStatus.textContent = "Jurnal hari ini sudah lengkap dan siap dikirim.";
                btnKirim.disabled = false;
                btnKirim.className = "w-full bg-[#5C4033] hover:bg-[#432D23] text-white py-3.5 rounded-lg font-semibold text-sm transition duration-200 mt-1 cursor-pointer";
            } else {
                btnStatus.className = "w-full text-left bg-[#F0EBE6] border border-[#D9CDC3] rounded-[10px] p-4 mt-2 transition-all duration-200 hover:bg-[#E8E0D8] active:scale-[0.99] cursor-pointer select-none";
                iconStatus.className = "w-8 h-8 rounded-lg bg-[#B0A59B] flex items-center justify-center shrink-0 transition-colors duration-200";
                judulStatus.className = "font-['Poppins'] font-bold text-sm text-[#7A6A60] transition-colors duration-200";
                judulStatus.textContent = "Semua sesi hari ini sudah selesai";
                subStatus.className = "text-xs text-[#9C8B80] mt-1 transition-colors duration-200";
                subStatus.textContent = "Klik untuk konfirmasi bahwa jurnal sudah lengkap.";
                btnKirim.disabled = true;
                btnKirim.className = "w-full bg-[#A89B90] text-white py-3.5 rounded-lg font-semibold text-sm transition duration-200 mt-1 cursor-not-allowed opacity-70";
            }
        }
    </script>

</body>

</html>
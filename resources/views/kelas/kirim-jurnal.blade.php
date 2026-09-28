<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Jurnal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
        </head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div class="md:flex md:min-h-screen">

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
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9"/>
                        <path d="M5 10v10h14V10"/>
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Scan
                </a>

                <a href="{{ route('kelas.kirim-jurnal') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13"/>
                        <path d="M22 2l-7 20-4-9-20-7z"/>
                    </svg>
                    Kirim Jurnal
                </a>

                <a href="{{ route('kelas.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
                    </svg>
                    Profil
                </a>

            </nav>
        </aside>


        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full min-w-0 pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex flex-col gap-1">
                <span class="text-white text-xl md:text-3xl font-['Poppins'] font-bold">
                    Kirim Jurnal
                </span>
            </div>


            <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">
                @if(session('success'))<div role="status" class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">{{ session('success') }}</div>@endif
                @if(session('error'))<div role="alert" class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800">{{ session('error') }}</div>@endif

                <div class="flex items-center justify-between mt-1">
                    <span class="font-['Poppins'] font-bold text-md uppercase text-[#3E3028]">
                        Rekap Jurnal Mengajar Hari Ini
                    </span>
                </div>


                {{-- TABEL REKAP --}}
                <div id="rekap-print" class="w-full max-w-full overflow-x-auto rounded-[10px] border border-[#E5D8CC] bg-white shadow-[0_4px_12px_rgba(62,48,40,0.03)]">
                    <table class="min-w-[1180px] w-full border-collapse text-left">
                        <thead class="text-center uppercase text-[#5C4033]">
                            <tr class="bg-[#F5EFE8] text-sm font-bold">
                                <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Jam ke-</th>
                                <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Nama Pengajar</th>
                                <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Mata Pelajaran</th>
                                <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Hadir</th>
                                <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Tidak Hadir<br><span class="normal-case font-normal">(Tugas)</span></th>
                                <th class="border border-[#E5D8CC] px-3 py-3" rowspan="2">Materi</th>
                                <th class="border border-[#E5D8CC] px-3 py-3" colspan="6">Keadaan Siswa</th>
                            </tr>
                            <tr class="bg-[#F5EFE8] text-sm font-semibold">
                                <th class="border border-[#E5D8CC] px-3 py-3">Jumlah Hadir</th>
                                <th class="border border-[#E5D8CC] px-3 py-3 text-left">Nama Siswa</th>
                                <th class="border border-[#E5D8CC] px-3 py-3">S</th><th class="border border-[#E5D8CC] px-3 py-3">I</th><th class="border border-[#E5D8CC] px-3 py-3">A</th><th class="border border-[#E5D8CC] px-3 py-3">D</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                        @forelse($rekap as $sesi)
                            @php
                                $jurnalSesi = $sesi->jurnal;
                                $tugasSesi = $sesi->tugas;
                                $guruHadir = $jurnalSesi?->status_kehadiran_guru === 'hadir' && $jurnalSesi?->status_verifikasi === 'terverifikasi';
                                $guruTidakHadir = $tugasSesi !== null || $jurnalSesi?->status_kehadiran_guru === 'tidak_hadir';
                                $absensiSiswa = $jurnalSesi?->absenSiswa ?? collect();
                                $barisSiswa = max(1, $absensiSiswa->count());
                                $jumlahHadir = $jurnalSesi?->jumlah_hadir ?? ($tugasSesi ? '—' : max(0, $totalSiswa - $absensiSiswa->count()));
                            @endphp
                            @for($baris = 0; $baris < $barisSiswa; $baris++)
                                @php($absen = $absensiSiswa->values()->get($baris))
                                <tr class="align-top">
                                    @if($baris === 0)
                                        <td rowspan="{{ $barisSiswa }}" class="whitespace-nowrap border border-[#E5D8CC] px-3 py-3">{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif</td>
                                        <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3">{{ $sesi->guru }}</td>
                                        <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3">{{ $sesi->mapel }}</td>
                                        <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3 text-center font-bold {{ $guruHadir ? 'text-green-700' : ($guruTidakHadir ? 'text-red-700' : 'text-amber-700') }}">{{ $guruHadir ? '✓' : ($guruTidakHadir ? '✕' : 'Menunggu scan') }}</td>
                                        <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3 text-center font-bold {{ $tugasSesi ? 'text-green-700' : 'text-red-700' }}">{{ $tugasSesi ? '✓' : '—' }}@if($tugasSesi)<span class="block text-[10px] font-medium">{{ $tugasSesi->status_guru }}</span>@endif</td>
                                        <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3">{{ $tugasSesi->materi ?? $jurnalSesi?->materi ?? '—' }}@if($tugasSesi)<p class="mt-1 whitespace-pre-line text-xs text-[#7A6A60]">Tugas: {{ $tugasSesi->tugas }}</p>@if($tugasSesi->file_path)<a class="mt-1 inline-block text-xs font-semibold text-blue-700 underline" href="{{ route('kelas.tugas.download', $tugasSesi->id_upload_tugas) }}">Buka lampiran</a>@endif@endif</td>
                                        <td rowspan="{{ $barisSiswa }}" class="border border-[#E5D8CC] px-3 py-3 text-center">{{ $jumlahHadir }}</td>
                                    @endif
                                    <td class="border border-[#E5D8CC] px-3 py-3">{{ $absen?->nama ?? '—' }}</td>
                                    @foreach(['Sakit' => 'S', 'Izin' => 'I', 'Alpha' => 'A', 'Dispen' => 'D'] as $namaStatus => $kodeStatus)
                                        <td class="border border-[#E5D8CC] px-3 py-3 text-center text-lg">{{ $absen?->status === $namaStatus ? '✓' : '' }}</td>
                                    @endforeach
                                </tr>
                            @endfor
                        @empty
                            <tr><td colspan="12" class="border border-[#E5D8CC] px-4 py-8 text-center text-sm text-[#7A6A60]">Tidak ada sesi terjadwal hari ini.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pengiriman?->status === 'ditolak')
                    <div class="w-full rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                        <p class="font-bold">Rekap ditolak guru piket.</p>
                        @if($pengiriman->alasan_tolak)<p class="mt-1">Alasan: {{ $pengiriman->alasan_tolak }}</p>@endif
                        <p class="mt-1">Perbaiki data yang kurang, lalu kirim ulang.</p>
                    </div>
                @elseif($pengiriman)
                    <div class="w-full rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                        <p class="font-semibold">Rekap hari ini {{ $pengiriman->status === 'disetujui' ? 'sudah disetujui guru piket.' : 'sudah dikirim dan menunggu pemeriksaan guru piket.' }}</p>
                    </div>
                @else
                    <div class="w-full rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                        <p class="font-semibold">Rekap bisa dikirim kapan saja, meski belum semua sesi selesai. Guru piket akan memeriksa kelengkapannya dan dapat menolak jika ada data yang kurang.</p>
                    </div>
                @endif

                {{-- TOMBOL KIRIM --}}
                <form method="POST" action="{{ route('kelas.kirim-jurnal.store') }}" id="formKirimJurnal">
                    @csrf
                    <button
                    type="submit"
                    id="btnKirimJurnal"
                    @disabled(!$bisaKirim)
                    class="w-full {{ $bisaKirim ? 'bg-green-700 hover:bg-green-800 cursor-pointer' : 'bg-[#A89B90] cursor-not-allowed opacity-70' }} text-white py-3.5 rounded-lg font-semibold text-sm
                           transition duration-200 mt-1">
                    <span class="inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 2L11 13"/>
                            <path d="M22 2l-7 20-4-9-20-7z"/>
                        </svg>
                        {{ $pengiriman?->status === 'ditolak' ? 'Kirim Ulang Jurnal' : ($pengiriman ? 'Jurnal Sudah Dikirim' : 'Kirim Jurnal Hari Ini') }}
                    </span>
                    </button>
                </form>

                <p class="text-center text-[11px] text-[#7A6A60]">
                    Rekap boleh dikirim meskipun belum semua sesi tercatat. Guru piket akan memeriksa kiriman ini.
                </p>

                <div id="konfirmasiKirimJurnal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/40 p-4" role="dialog" aria-modal="true" aria-labelledby="judulKonfirmasiKirim">
                    <div class="w-full max-w-sm rounded-2xl bg-white p-5 shadow-xl">
                        <h2 id="judulKonfirmasiKirim" class="font-['Poppins'] text-lg font-bold text-[#3E3028]">Kirim jurnal sekarang?</h2>
                        <p class="mt-2 text-sm leading-6 text-[#7A6A60]">Rekap jurnal hari ini akan dikirim ke guru piket untuk diperiksa. Pastikan data yang tersedia sudah benar.</p>
                        <div class="mt-5 flex justify-end gap-2">
                            <button type="button" id="batalKirimJurnal" class="rounded-lg border border-[#D8C9BC] px-4 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]">Batal</button>
                            <button type="button" id="setujuKirimJurnal" class="rounded-lg bg-green-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-800">Setuju, Kirim</button>
                        </div>
                    </div>
                </div>

                <script>
                    (() => {
                        const form = document.getElementById('formKirimJurnal');
                        const dialog = document.getElementById('konfirmasiKirimJurnal');
                        const setuju = document.getElementById('setujuKirimJurnal');
                        const batal = document.getElementById('batalKirimJurnal');
                        let sudahKonfirmasi = false;

                        form?.addEventListener('submit', event => {
                            if (sudahKonfirmasi) {
                                sudahKonfirmasi = false;
                                return;
                            }
                            event.preventDefault();
                            dialog?.classList.remove('hidden');
                            dialog?.classList.add('flex');
                        });

                        setuju?.addEventListener('click', () => {
                            sudahKonfirmasi = true;
                            dialog.classList.add('hidden');
                            dialog.classList.remove('flex');
                            form.requestSubmit();
                        });

                        const tutupDialog = () => {
                            dialog.classList.add('hidden');
                            dialog.classList.remove('flex');
                        };
                        batal?.addEventListener('click', tutupDialog);
                        dialog?.addEventListener('click', event => {
                            if (event.target === dialog) tutupDialog();
                        });
                    })();
                </script>

            </div>
        </main>
    </div>


    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12l9-9 9 9"/>
                <path d="M5 10v10h14V10"/>
            </svg>
            Beranda
        </a>
        <a href="{{ route('kelas.scan') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
            </svg>
            Scan
        </a>
        <a href="{{ route('kelas.kirim-jurnal') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 2L11 13"/>
                <path d="M22 2l-7 20-4-9-20-7z"/>
            </svg>
            Kirim Jurnal
        </a>
        <a href="{{ route('kelas.profile') }}"
           class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
            </svg>
            Profil
        </a>
    </nav>




</body>
</html>
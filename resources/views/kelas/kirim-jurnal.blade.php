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


                {{-- Tampilan ringkas untuk ponsel: isi sama, disusun per sesi agar mudah dibaca. --}}
                <div class="w-full space-y-3 md:hidden">
                    @forelse($rekap as $sesi)
                        @php
                            $jurnalSesi = $sesi->jurnal;
                            $tugasSesi = $sesi->tugas;
                            $guruHadir = $jurnalSesi?->status_kehadiran_guru === 'hadir' && $jurnalSesi?->status_verifikasi === 'terverifikasi';
                            $guruTidakHadir = !$guruHadir && ($tugasSesi !== null || in_array($jurnalSesi?->status_kehadiran_guru, ['sakit', 'izin', 'tidak_hadir'], true) || (!$jurnalSesi && $sesi->status === 'Selesai'));
                            $absensiSiswa = $jurnalSesi?->absenSiswa ?? collect();
                            $jumlahHadir = $jurnalSesi?->jumlah_hadir ?? ($tugasSesi && !$guruHadir ? '—' : max(0, $totalSiswa - $absensiSiswa->count()));
                        @endphp
                        <article class="rounded-xl border border-[#E5D8CC] bg-white p-4 shadow-[0_2px_8px_rgba(62,48,40,0.04)]">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold text-[#7A6A60]">Jam ke-{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif</p>
                                    <h3 class="mt-1 font-['Poppins'] text-base font-bold text-[#3E3028]">{{ $sesi->mapel }}</h3>
                                    <p class="text-sm text-[#5C4033]">{{ $sesi->guru }}</p>
                                </div>
                                <span class="shrink-0 text-right text-xs font-bold {{ $guruHadir ? 'text-green-700' : ($guruTidakHadir ? 'text-red-700' : 'text-amber-700') }}">
                                    {{ $guruHadir ? 'Hadir · Terverifikasi' : ($guruTidakHadir ? (($jurnalSesi?->status_kehadiran_guru === 'sakit' || strtolower((string) $tugasSesi?->status_guru) === 'sakit') ? 'Sakit' : (($jurnalSesi?->status_kehadiran_guru === 'izin' || strtolower((string) $tugasSesi?->status_guru) === 'izin') ? 'Izin' : 'Tidak hadir')) : ($sesi->status === 'Selesai' ? 'Selesai' : 'Menunggu scan')) }}
                                </span>
                            </div>
                            <dl class="mt-3 space-y-2 text-sm">
                                <div class="flex justify-between gap-3"><dt class="text-[#7A6A60]">Keterangan tugas piket</dt><dd class="text-right font-medium">{{ $tugasSesi && !$guruHadir ? 'Ya · '.$tugasSesi->status_guru : '—' }}</dd></div>
                                <div class="flex justify-between gap-3"><dt class="text-[#7A6A60]">Materi</dt><dd class="max-w-[65%] text-right">{{ $tugasSesi->materi ?? $jurnalSesi?->materi ?? '—' }}</dd></div>
                                @if($tugasSesi && $tugasSesi->tugas)
                                    <div class="flex justify-between gap-3"><dt class="text-[#7A6A60]">Tugas</dt><dd class="max-w-[65%] whitespace-pre-line text-right">{{ $tugasSesi->tugas }}</dd></div>
                                @endif
                                @if($tugasSesi?->file_path)
                                    <div class="text-right"><a class="text-xs font-semibold text-blue-700 underline" href="{{ route('kelas.tugas.download', $tugasSesi->id_upload_tugas) }}">Buka lampiran</a></div>
                                @endif
                                <div class="flex justify-between gap-3"><dt class="text-[#7A6A60]">Jumlah hadir</dt><dd class="font-semibold">{{ $jumlahHadir }}</dd></div>
                            </dl>
                            <div class="mt-3">
                                <p class="text-xs font-semibold text-[#7A6A60]">Siswa tidak hadir</p>
                                @if($absensiSiswa->isEmpty())
                                    <p class="mt-1 text-sm">Tidak ada.</p>
                                @else
                                    <ul class="mt-1 space-y-1 text-sm">
                                        @foreach($absensiSiswa as $absen)
                                            <li class="flex justify-between gap-3"><span>{{ $absen->nama }}</span><span class="shrink-0 text-[#7A6A60]">{{ $absen->status }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </article>
                    @empty
                        <p class="py-6 text-center text-sm text-[#7A6A60]">Tidak ada sesi terjadwal hari ini.</p>
                    @endforelse
                </div>

                {{-- TABEL REKAP --}}
                <div id="rekap-print" class="hidden w-full overflow-x-auto rounded-[10px] border border-[#E5D8CC] bg-white shadow-[0_4px_12px_rgba(62,48,40,0.03)] md:block">
                    <table class="min-w-[1180px] w-full border-collapse text-left text-sm">
                        <thead class="text-center text-[9px] uppercase leading-tight text-[#5C4033] sm:text-xs md:text-sm">
                            <tr class="bg-[#F5EFE8] font-bold">
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" rowspan="2">Jam ke-</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" rowspan="2">Nama Pengajar</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" rowspan="2">Mata Pelajaran</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" rowspan="2">Status Guru</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" rowspan="2">Tidak Hadir<br><span class="normal-case font-normal">(Tugas)</span></th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" rowspan="2">Materi</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3" colspan="6">Keadaan Siswa</th>
                            </tr>
                            <tr class="bg-[#F5EFE8] font-semibold">
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">Jumlah Hadir</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 text-left sm:px-2 sm:py-3">Nama Siswa</th>
                                <th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">S</th><th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">I</th><th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">A</th><th class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">D</th>
                            </tr>
                        </thead>
                        <tbody class="text-[10px] leading-tight sm:text-xs md:text-sm">
                        @forelse($rekap as $sesi)
                            @php
                                $jurnalSesi = $sesi->jurnal;
                                $tugasSesi = $sesi->tugas;
                                $guruHadir = $jurnalSesi?->status_kehadiran_guru === 'hadir' && $jurnalSesi?->status_verifikasi === 'terverifikasi';
                                $guruTidakHadir = !$guruHadir && ($tugasSesi !== null || in_array($jurnalSesi?->status_kehadiran_guru, ['sakit', 'izin', 'tidak_hadir'], true) || (!$jurnalSesi && $sesi->status === 'Selesai'));
                                $absensiSiswa = $jurnalSesi?->absenSiswa ?? collect();
                                $barisSiswa = max(1, $absensiSiswa->count());
                                $jumlahHadir = $jurnalSesi?->jumlah_hadir ?? ($tugasSesi && !$guruHadir ? '—' : max(0, $totalSiswa - $absensiSiswa->count()));
                            @endphp
                            @for($baris = 0; $baris < $barisSiswa; $baris++)
                                @php($absen = $absensiSiswa->values()->get($baris))
                                <tr class="align-top">
                                    @if($baris === 0)
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 text-center sm:px-2 sm:py-3">{{ $sesi->jam_ke_mulai }}@if($sesi->jam_ke_sampai !== $sesi->jam_ke_mulai)–{{ $sesi->jam_ke_sampai }}@endif</td>
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">{{ $sesi->guru }}</td>
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">{{ $sesi->mapel }}</td>
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 text-center font-bold sm:px-2 sm:py-3 {{ $guruHadir ? 'text-green-700' : ($guruTidakHadir ? 'text-red-700' : 'text-amber-700') }}">{{ $guruHadir ? '✓' : ($guruTidakHadir ? '✕' : ($sesi->status === 'Selesai' ? 'Selesai' : 'Menunggu scan')) }}</td>
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 text-center font-bold sm:px-2 sm:py-3 {{ $tugasSesi ? 'text-green-700' : 'text-red-700' }}">{{ $tugasSesi && !$guruHadir ? '✓' : '—' }}@if($tugasSesi && !$guruHadir)<span class="block text-[10px] font-medium">{{ $tugasSesi->status_guru }}</span>@endif</td>
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">{{ $tugasSesi->materi ?? $jurnalSesi?->materi ?? '—' }}@if($tugasSesi)<p class="mt-1 whitespace-pre-line text-xs text-[#7A6A60]">Tugas: {{ $tugasSesi->tugas }}</p>@if($tugasSesi->file_path)<a class="mt-1 inline-block text-xs font-semibold text-blue-700 underline" href="{{ route('kelas.tugas.download', $tugasSesi->id_upload_tugas) }}">Buka lampiran</a>@endif@endif</td>
                                        <td rowspan="{{ $barisSiswa }}" class="break-words border border-[#E5D8CC] px-1.5 py-2 text-center sm:px-2 sm:py-3">{{ $jumlahHadir }}</td>
                                    @endif
                                    <td class="break-words border border-[#E5D8CC] px-1.5 py-2 sm:px-2 sm:py-3">{{ $absen?->nama ?? '—' }}</td>
                                    @foreach(['Sakit' => 'S', 'Izin' => 'I', 'Alpha' => 'A', 'Dispen' => 'D'] as $namaStatus => $kodeStatus)
                                        <td class="break-words border border-[#E5D8CC] px-1 py-2 text-center text-sm sm:px-2 sm:py-3 sm:text-lg">{{ $absen?->status === $namaStatus ? '✓' : '' }}</td>
                                    @endforeach
                                </tr>
                            @endfor
                        @empty
                            <tr><td colspan="12" class="border border-[#E5D8CC] px-4 py-8 text-center text-sm text-[#7A6A60]">Tidak ada sesi terjadwal hari ini.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pengiriman)
                    <div class="w-full rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                        <p class="font-semibold">Rekap hari ini sudah dikirim dan tersimpan.</p>
                        @if($pengiriman->dikirim_at)<p class="mt-1">Terakhir dikirim {{ $pengiriman->dikirim_at->format('H:i') }}. Kirim ulang jika ingin memperbarui rekap.</p>@endif
                    </div>
                @else
                    <div class="w-full rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                        <p class="font-semibold">Rekap dapat dikirim kapan saja, termasuk sebelum semua sesi selesai.</p>
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
                        {{ $pengiriman ? 'Kirim Ulang / Perbarui Jurnal' : 'Kirim Jurnal Hari Ini' }}
                    </span>
                    </button>
                </form>

                <p class="text-center text-[11px] text-[#7A6A60]">
                    Rekap tersimpan dan dapat dilihat guru piket melalui menu Jurnal Mengajar.
                </p>

                <div id="konfirmasiKirimJurnal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/40 p-4" role="dialog" aria-modal="true" aria-labelledby="judulKonfirmasiKirim">
                    <div class="w-full max-w-sm rounded-2xl bg-white p-5 shadow-xl">
                        <h2 id="judulKonfirmasiKirim" class="font-['Poppins'] text-lg font-bold text-[#3E3028]">Kirim jurnal sekarang?</h2>
                        <p class="mt-2 text-sm leading-6 text-[#7A6A60]">Rekap jurnal hari ini akan disimpan dan ditampilkan di menu Jurnal Mengajar. Kiriman tidak memerlukan persetujuan.</p>
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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Guru</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <style>
        html{scrollbar-width:none}html::-webkit-scrollbar{display:none}
        #qr-reader{box-sizing:border-box;width:min(100%,360px);aspect-ratio:1/1;overflow:hidden;border:4px dashed #D7B899;border-radius:1rem;background:#171717}
        #qr-reader__scan_region{width:100%!important;height:100%!important}
        #qr-reader video,#qr-reader canvas{width:100%!important;height:100%!important;object-fit:cover!important}
    </style>
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen">

    <div class="md:flex">

        {{-- SIDEBAR (desktop) --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:h-screen md:sticky md:top-0
                       bg-white border-r border-[#E5D8CC] py-6 px-4">

            <div class="mb-8 px-2">
                <h1 class="font-['Poppins'] font-bold text-xl text-[#5C4033]">JURNAL GURU</h1>
                <p class="text-md text-[#7A6A60] mt-1">Akun Kelas</p>
            </div>

            <nav class="flex flex-col gap-1">
                <a href="{{ route('kelas.beranda') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/>
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('kelas.scan') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md font-semibold bg-[#F5EFE8] text-[#5C4033]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    Scan
                </a>
                <a href="{{ route('kelas.kirim-jurnal') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                    </svg>
                    Kirim Jurnal
                </a>
                <a href="{{ route('kelas.profile') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-md text-[#7A6A60] hover:bg-[#F5EFE8]">
                    <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
                    </svg>
                    Profil
                </a>
            </nav>
        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 w-full pb-24 md:pb-8">

            {{-- HEADER --}}
            <div class="w-full bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex items-center justify-between text-white">

            <a href="{{ route('kelas.scan') }}"
            class="w-9 h-9 flex items-center justify-center text-2xl shrink-0">
                 ←
            </a>

            <h1 class="m-0 font-['Poppins'] text-xl sm:text-[17px] font-semibold text-center">
                 Verifikasi Guru
            </h1>

            <div class="w-9 shrink-0"></div>

            </div>

            {{-- ISI KONTEN --}}
            <div class="w-full max-w-[500px] mx-auto px-4 py-6">

                <h2 class="text-center font-['Poppins'] text-lg sm:text-xl font-semibold text-[#3E3028] m-0 mb-2">
                    Scan QR Guru
                </h2>

                <p class="text-center text-xs leading-relaxed text-[#7A6A60] max-w-[330px] mx-auto mb-5">
                    Arahkan kamera ke QR Code yang ditampilkan
                    oleh guru Anda untuk memverifikasi sesi mengajar.
                </p>

                {{-- SCANNER --}}
                <div id="qr-reader" class="mx-auto mb-4"></div>
<p id="scan-status" class="text-center text-[#3E3028] text-xs leading-relaxed mb-5">Arahkan kamera ke QR Code guru</p>

                {{-- DETAIL SESI --}}
                <div class="w-full bg-white border border-[#E5D8CC] rounded-[10px] p-4 mb-4">

                    <div class="font-['Poppins'] text-[15px] font-semibold text-[#3E3028] mb-2.5">
                        Detail Sesi Mengajar
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Guru Pengajar</span>
                        <span class="text-[#3E3028] font-medium text-right">{{ $jadwal->guru?->name ?? '—' }}</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Mata Pelajaran</span>
                        <span class="text-[#3E3028] font-medium text-right">{{ $jadwal->mapel?->nama_mapel ?? '—' }}</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Kelas</span>
                        <span class="text-[#3E3028] font-medium text-right">{{ $jadwal->kelas?->nama_kelas ?? '—' }}</span>
                    </div>

                    <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                        <span class="text-[#7A6A60]">Jam</span>
                        <span class="text-[#3E3028] font-medium text-right">{{ $jamMulai && $jamSelesai ? substr($jamMulai, 0, 5).' - '.substr($jamSelesai, 0, 5) : '—' }}</span>
                    </div>

                    <div class="flex justify-between gap-4 pt-2.5 text-[13px]">
                        <span class="text-[#7A6A60]">Status</span>
                        <span class="text-[#3E3028] font-medium text-right">{{ $jurnal->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : 'Menunggu verifikasi' }}</span>
                    </div>

                </div>

                {{-- PERINGATAN --}}
                <div class="w-full mb-5 p-[13px] bg-[#EAF4FF] border border-[#B8D8F5] rounded-lg
                            flex items-start gap-2.5">

                    <div class="w-5 h-5 min-w-5 rounded-full bg-[#5C4033] text-white
                                flex items-center justify-center text-xs font-bold">
                        !
                    </div>

                    <p class="m-0 text-xs leading-relaxed text-[#3E3028]">
                        Pastikan QR Code berasal dari guru yang
                        sedang mengajar di kelas Anda.
                    </p>

                </div>

            </div>
        </main>

    </div>

    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/></svg>
            Beranda
        </a>
        <a href="{{ route('kelas.scan') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#5C4033] font-semibold">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Scan
        </a>
        <a href="{{ route('kelas.kirim-jurnal') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg>
            Kirim Jurnal
        </a>
        <a href="{{ route('kelas.profile') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
            Profil
        </a>
    </nav>

    <script>
        function konfirmasiSesi() {
            alert('Sesi mengajar berhasil dikonfirmasi.');
        }
    </script>

    <script>
    const statusEl = document.getElementById('scan-status');
    if (!window.isSecureContext || !navigator.mediaDevices?.getUserMedia) {
        statusEl.textContent = 'Browser HP memblokir kamera pada alamat HTTP jaringan lokal. Buka aplikasi melalui HTTPS (misalnya tunnel HTTPS) atau localhost untuk mengaktifkan kamera.';
        statusEl.classList.add('text-red-600', 'font-bold');
    } else if (typeof Html5Qrcode === 'undefined') {
        statusEl.textContent = 'Pemindai QR gagal dimuat. Periksa koneksi internet lalu muat ulang.';
    } else {
    const scanner = new Html5Qrcode("qr-reader", { formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE], verbose: false });

    scanner.start(
        { facingMode: "environment" },
        { fps: 10, aspectRatio: 1, qrbox: (viewfinderWidth, viewfinderHeight) => {
            const size = Math.floor(Math.min(viewfinderWidth, viewfinderHeight) * 0.72);
            return { width: size, height: size };
        } },
        (decodedText) => {
            scanner.pause();
            statusEl.textContent = "Memverifikasi...";

            fetch("{{ route('qr.scan-guru') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ kode_qr: decodedText }),
            })
            .then(async res => ({ ok: res.ok, data: await res.json() }))
            .then(({ ok, data }) => {
                if (ok && data.success) {
                    window.location.href = data.redirect || "{{ route('kelas.beranda') }}";
                } else {
                    statusEl.textContent = data.message || 'QR tidak dapat diverifikasi. Coba pindai QR sesi yang benar.';
                    statusEl.classList.add('text-red-600', 'font-bold');
                    setTimeout(() => scanner.resume(), 2000);
                }
            })
            .catch(() => {
                statusEl.textContent = 'Koneksi gagal saat memverifikasi QR. Periksa jaringan lalu coba lagi.';
                setTimeout(() => scanner.resume(), 2000);
            });
        },
        (errorMessage) => { /* diabaikan, ini dipanggil terus tiap frame tanpa QR terbaca */ }
    ).then(() => {
        const video = document.querySelector('#qr-reader video');
        if (video) { video.style.width = '100%'; video.style.height = '100%'; video.style.objectFit = 'cover'; }
    }).catch(err => {
        statusEl.textContent = 'Kamera gagal dibuka. Izinkan akses kamera pada browser, pastikan tidak sedang dipakai aplikasi lain, lalu muat ulang. ' + err;
        statusEl.classList.add('text-red-600', 'font-bold');
    });
    }
</script>

</body>
</html>
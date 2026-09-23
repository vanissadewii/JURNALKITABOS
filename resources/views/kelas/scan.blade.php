<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Sesi Mengajar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <style>
        #qr-reader video { width: 100% !important; height: 100% !important; object-fit: cover !important; }
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
                    Dasbor
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
            <div class="w-full bg-[#5C4033] px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex items-center justify-center text-white">
                <h1 class="m-0 font-['Poppins'] text-[15px] sm:text-[17px] font-semibold text-center">
                    Scan Sesi Mengajar
                </h1>
            </div>

            {{-- ISI: QR / SCANNER DINAMIS --}}
            <div class="w-full max-w-[500px] mx-auto px-4 py-6 sm:px-5 md:pt-10 pb-10 flex flex-col items-center">

                <h2 id="judul" class="m-0 mb-1.5 font-['Poppins'] text-lg sm:text-xl md:text-2xl font-bold text-center text-[#3E3028]">Memuat...</h2>
                <p id="teks" class="m-0 mb-6 text-xs leading-relaxed text-center text-[#7A6A60]"></p>

                {{-- tampilan QR kelas (buat di-scan guru) --}}
                <div id="panel-qr" class="hidden w-[220px] h-[220px] bg-white border border-[#E5D8CC] rounded-2xl items-center justify-center p-[14px] shadow-[0_4px_15px_rgba(62,48,40,0.06)] select-none">
                    <img id="gambar-qr" alt="QR Code" class="w-full h-full pointer-events-none select-none" draggable="false">
                </div>

                {{-- tampilan pemindai (buat scan QR guru) --}}
                <div id="panel-scan" class="hidden">
                    <div id="qr-reader" class="w-[260px] h-[260px] mx-auto rounded-2xl overflow-hidden border-4 border-dashed border-[#D7B899]"></div>
                </div>

                <p id="pesan" class="mt-5 text-center text-xs leading-relaxed text-[#3E3028]"></p>

            </div>
        </main>

    </div>

    {{-- BOTTOM NAV (mobile) --}}
    <nav class="md:hidden fixed bottom-0 inset-x-0 h-[72px] bg-white border-t border-[#E5D8CC] flex z-50">
        <a href="{{ route('kelas.beranda') }}" class="flex-1 flex flex-col items-center justify-center gap-1 text-[11px] text-[#7A6A60]">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9"/><path d="M5 10v10h14V10"/></svg>
            Dasbor
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
        (() => {
            const statusUrl = "{{ route('kelas.scan.status') }}";
            const scanUrl = "{{ route('kelas.qr.scan-guru') }}";
            const teks = {
                qr: { judul: "QR Code Kelas", isi: "Tunjukkan QR ini ke layar guru untuk memulai verifikasi sesi mengajar." },
                scan: { judul: "Scan QR Guru", isi: "Arahkan kamera ke QR Code yang ditampilkan oleh guru." },
            };

            const el = (id) => document.getElementById(id);
            const scanner = new Html5Qrcode('qr-reader');
            let tahap = null;
            let sedangKirim = false;
            let kameraAktif = false;
            let qrTerakhir = null;

            function pesan(isi, error = false) {
                el('pesan').textContent = isi || '';
                el('pesan').className = 'mt-5 text-center text-xs leading-relaxed ' + (error ? 'text-red-600 font-bold' : 'text-[#3E3028]');
            }

            function tampil(mode) {
                el('panel-qr').classList.toggle('hidden', mode !== 'qr');
                el('panel-qr').classList.toggle('flex', mode === 'qr');
                el('panel-scan').classList.toggle('hidden', mode !== 'scan');

                if (mode) {
                    el('judul').textContent = teks[mode].judul;
                    el('teks').textContent = teks[mode].isi;
                }
            }

            async function nyalakanKamera() {
                if (kameraAktif) return;
                kameraAktif = true;
                try {
                    await scanner.start({ facingMode: 'environment' }, { fps: 10, qrbox: 220 }, kirim, () => {});
                } catch (e) {
                    kameraAktif = false;
                    pesan('Gagal mengakses kamera: ' + e, true);
                }
            }

            async function matikanKamera() {
                if (!kameraAktif) return;
                kameraAktif = false;
                try { await scanner.stop(); } catch (e) {}
            }

            async function kirim(kode) {
                if (sedangKirim) return;
                sedangKirim = true;
                pesan('Memverifikasi...');

                try {
                    const res = await fetch(scanUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        body: JSON.stringify({ kode_qr: kode }),
                    });
                    const data = await res.json();

                    if (data.success) {
                        window.location.href = data.redirect;
                        return;
                    } else {
                        pesan(data.message ?? 'Verifikasi gagal.', true);
                    }
                } catch (e) {
                    pesan('Terjadi kesalahan, coba lagi.', true);
                }

                setTimeout(() => { sedangKirim = false; }, 2000);
            }

            async function muat() {
                let data;
                try {
                    const res = await fetch(statusUrl, { headers: { 'Accept': 'application/json' } });
                    data = await res.json();
                } catch (e) {
                    return;
                }

                if (data.tahap === 'tampil_qr') {
                    if (tahap !== 'tampil_qr') await matikanKamera();
                    tampil('qr');
                    if (qrTerakhir !== data.qr) {
                        qrTerakhir = data.qr;
                        el('gambar-qr').src = data.qr;
                    }
                } else if (data.tahap === 'scan') {
                    tampil('scan');
                    await nyalakanKamera();
                } else {
                    await matikanKamera();
                    tampil(null);
                    el('judul').textContent = 'Informasi';
                    el('teks').textContent = '';
                    pesan(data.pesan ?? '');
                }

                tahap = data.tahap;
            }

            muat();
            setInterval(muat, 3000);
        })();
    </script>

</body>
</html>
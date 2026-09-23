<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<div class="w-full max-w-[500px] mx-auto px-4 py-6 sm:px-5 md:pt-10 pb-10 flex flex-col items-center">

    <h2 id="judul" class="m-0 mb-1.5 font-['Poppins'] text-lg sm:text-xl md:text-2xl font-bold text-center text-[#3E3028]">Memuat...</h2>
    <p id="teks" class="m-0 mb-6 text-xs leading-relaxed text-center text-[#7A6A60]"></p>

    {{-- tampilan QR --}}
    <div id="panel-qr" class="hidden w-[220px] h-[220px] bg-white border border-[#E5D8CC] rounded-2xl items-center justify-center p-[14px] shadow-[0_4px_15px_rgba(62,48,40,0.06)] select-none">
        <img id="gambar-qr" alt="QR Code" class="w-full h-full pointer-events-none select-none" draggable="false">
    </div>

    {{-- tampilan pemindai --}}
    <div id="panel-scan" class="hidden">
        <div id="qr-reader" class="w-[260px] h-[260px] mx-auto rounded-2xl overflow-hidden border-4 border-dashed border-[#D7B899]"></div>
    </div>

    <p id="pesan" class="mt-5 text-center text-xs leading-relaxed text-[#3E3028]"></p>

    @if (app()->isLocal())
        {{-- HANYA UNTUK TES di komputer lokal (tanpa kamera): tempel kode QR pihak lawan --}}
        <div class="mt-6 w-full rounded-lg border border-dashed border-[#D7B899] p-3 text-[11px] text-[#7A6A60]">
            <p class="font-semibold">Mode uji (hanya di lokal)</p>
            <p class="mt-1 break-all">Kode QR di layar ini: <span id="kode-uji" class="font-mono"></span></p>
            <div class="mt-2 flex gap-2">
                <input id="kode-manual" type="text" placeholder="Tempel kode QR lawan..."
                       class="flex-1 rounded border border-[#E5D8CC] px-2 py-1">
                <button type="button" onclick="kirimManual()" class="rounded bg-[#5C4033] px-3 py-1 text-white">Kirim</button>
            </div>
        </div>
    @endif
</div>

<script>
    (() => {
        const statusUrl = @json($statusUrl);
        const scanUrl = @json($scanUrl);
        const teks = {
            qr: { judul: @json($judulQr), isi: @json($teksQr) },
            scan: { judul: @json($judulScan), isi: @json($teksScan) },
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
                        'X-CSRF-TOKEN': @json(csrf_token()),
                    },
                    body: JSON.stringify({ kode_qr: kode }),
                });
                const data = await res.json();

                if (data.success) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }
                    pesan('Berhasil.');
                    await muat();
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

            if (data.tahap === 'selesai' && data.redirect) {
                window.location.href = data.redirect;
                return;
            }

            if (data.tahap === 'tampil_qr') {
                if (tahap !== 'tampil_qr') await matikanKamera();
                tampil('qr');
                if (qrTerakhir !== data.qr) {
                    qrTerakhir = data.qr;
                    el('gambar-qr').src = data.qr;
                }
                if (el('kode-uji')) el('kode-uji').textContent = data.kode ?? '';
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

        window.kirimManual = () => kirim(el('kode-manual').value.trim());

        muat();
        setInterval(muat, 3000);
    })();
</script>
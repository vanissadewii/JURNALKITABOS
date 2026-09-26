<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Kehadiran Guru</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  @vite('resources/css/app.css')
  <style>
    #qr-reader video {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
    }
  </style>
  <style>
    /* Animasi Laser Scanner */
    @keyframes scanAnimation {
      0% { top: 5%; }
      50% { top: 90%; }
      100% { top: 5%; }
    }
    .scanner-laser {
      animation: scanAnimation 2.2s infinite ease-in-out;
    }
    #webcam-preview video { width: 100% !important; height: 100% !important; object-fit: cover !important; border-radius: 1rem; }
    #webcam-preview canvas { display: none; }
  </style>
  <script src="https://unpkg.com/html5-qrcode" defer></script>
  <style>
    html { scrollbar-width: none; }
    html::-webkit-scrollbar { display: none; }
    .guru-sidebar-nav a { gap: .75rem !important; padding: .625rem .75rem !important; border-radius: .5rem !important; font-size: 1rem !important; color: #7A6A60 !important; }
    .guru-sidebar-nav a svg { color: #7A6A60 !important; }
    .guru-sidebar-nav a.bg-\[\#F5EFE8\] { color: #5C4033 !important; }
    .guru-sidebar-nav a.bg-\[\#F5EFE8\] svg { color: #3E3028 !important; }
    .guru-sidebar > div:first-child { padding: 1.5rem 1rem !important; gap: 2rem !important; }
  </style>
</head>

<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

  <!-- SIDEBAR LEFT NAVIGATION (Desktop) -->
  <aside class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC] min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="py-6 px-4 flex flex-col gap-8">

      <!-- Brand Logo / Title -->
      <div class="flex flex-col gap-0.5">
        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
        <span class="text-md font-medium text-[#7A6A60]">Akun Guru</span>
      </div>

      <!-- Navigation Links -->
      <nav class="guru-sidebar-nav flex flex-col gap-1">
        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
          </svg>
          <span>Beranda</span>
        </a>

        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold text-md text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="h-5 w-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span>
        </a>

        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
            <circle cx="10" cy="6.5" r="3.5"/>
          </svg>
          <span>Profil</span>
        </a>
      </nav>
    </div>
  </aside>

  <!-- MAIN CONTENT AREA -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">

    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="w-full flex items-center justify-between">
        <a href="{{ url('/form-jurnal') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Verifikasi Kehadiran Guru</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-7 sm:py-10 flex-1 flex flex-col gap-6">

      <section class="rounded-3xl bg-white border border-brand-100 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-[#5C4033] to-[#795846] px-5 py-6 sm:px-8 sm:py-7 text-white">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
            <div>
              <p class="text-xs uppercase tracking-[0.18em] text-white/70 font-semibold">Jurnal berhasil disimpan</p>
              <h2 class="mt-2 font-poppins font-bold text-xl sm:text-2xl">{{ $jurnal->jadwal->mapel->nama_mapel ?? 'Mata Pelajaran' }}</h2>
              <p class="mt-1 text-sm text-white/80">{{ $jurnal->jadwal->kelas->nama_kelas ?? 'Kelas' }}</p>
            </div>
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/20 px-4 py-2 text-xs font-semibold w-fit">
              <span class="w-2 h-2 rounded-full bg-amber-300 animate-pulse"></span>
              Menunggu scan QR kelas
            </span>
          </div>
        </div>

        <div class="p-5 sm:p-8 flex flex-col items-center gap-5 text-center">
          <div class="max-w-xl">
            <h3 class="font-poppins font-bold text-lg sm:text-xl">Pindai QR yang tampil di layar kelas</h3>
            <p class="mt-2 text-sm text-brand-600">Izinkan akses kamera, lalu arahkan kamera ke kode QR kelas. Setelah terbaca, halaman QR guru akan terbuka otomatis.</p>
          </div>

          <div class="w-full max-w-lg aspect-[4/3] bg-[#171411] rounded-3xl relative overflow-hidden flex items-center justify-center shadow-lg border-[6px] border-brand-100">
            <div id="webcam-preview" class="absolute inset-0 w-full h-full"></div>
            <div class="absolute inset-[12%] rounded-2xl border border-white/30 pointer-events-none">
              <div class="absolute -top-px -left-px w-8 h-8 border-t-4 border-l-4 border-amber-400 rounded-tl-xl"></div>
              <div class="absolute -top-px -right-px w-8 h-8 border-t-4 border-r-4 border-amber-400 rounded-tr-xl"></div>
              <div class="absolute -bottom-px -left-px w-8 h-8 border-b-4 border-l-4 border-amber-400 rounded-bl-xl"></div>
              <div class="absolute -bottom-px -right-px w-8 h-8 border-b-4 border-r-4 border-amber-400 rounded-br-xl"></div>
              <div class="scanner-laser absolute left-2 right-2 h-0.5 bg-gradient-to-r from-transparent via-rose-400 to-transparent shadow-[0_0_14px_#fb7185]"></div>
            </div>
            <div class="absolute top-3 left-3 rounded-full bg-black/60 backdrop-blur px-3 py-1.5 flex items-center gap-2 border border-white/10 pointer-events-none">
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              <span id="camera-label" class="text-[11px] font-semibold text-white">Menyiapkan kamera...</span>
            </div>
          </div>

          <div id="scan-status" role="status" aria-live="polite" class="w-full max-w-lg rounded-xl bg-brand-50 border border-brand-100 px-4 py-3 text-sm text-brand-700">
            Menunggu kamera siap...
          </div>
        </div>
      </section>
    </main>

  </div>

  <!-- Bottom Navigation Bar (Mobile) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Beranda</span>
      </a>

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
        </svg>
        <span>Riwayat</span>
      </a>

      <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></a>

      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>
        </svg>
        <span>Profil</span>
      </a>
    </div>
  </nav>

  <!-- Script Penanganan Hasil Scan QR Kamera -->
  <script>
    let scanFinished = false;

    const statusBox = document.getElementById('scan-status');
    const cameraLabel = document.getElementById('camera-label');

    function tampilkanStatus(pesan, gagal = false) {
      statusBox.textContent = pesan;
      statusBox.className = gagal
        ? 'w-full max-w-lg rounded-xl bg-rose-50 border border-rose-200 px-4 py-3 text-sm text-rose-800'
        : 'w-full max-w-lg rounded-xl bg-brand-50 border border-brand-100 px-4 py-3 text-sm text-brand-700';
    }

    async function onScanSuccess(qrCodeMessage) {
      if (scanFinished) return;
      scanFinished = true;
      tampilkanStatus('QR terbaca. Memeriksa kode kelas...');

      try {
        const response = await fetch("{{ route('guru.scan-kelas.process', $jurnal) }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ kode_qr: qrCodeMessage })
        });
        const result = await response.json();
        if (response.ok && result.success && result.redirect) {
          tampilkanStatus('QR kelas valid. Membuka QR guru...');
          window.location.href = result.redirect;
          return;
        }
        tampilkanStatus(result.message || 'QR kelas tidak valid. Arahkan kamera ke QR kelas yang sesuai.', true);
      } catch (error) {
        tampilkanStatus('Tidak dapat memeriksa QR. Periksa koneksi lalu coba pindai lagi.', true);
      }
      scanFinished = false;
    }

    function startScanner() {
      if (!window.isSecureContext || !navigator.mediaDevices?.getUserMedia) {
        cameraLabel.textContent = 'Butuh koneksi HTTPS';
        tampilkanStatus('Browser HP memblokir kamera karena halaman dibuka melalui alamat HTTP jaringan lokal. Buka aplikasi lewat alamat HTTPS (misalnya tunnel HTTPS) atau localhost agar izin kamera tersedia.', true);
        return;
      }

      const scanner = new Html5Qrcode('webcam-preview');
      scanner.start(
        { facingMode: 'environment' },
        { fps: 10, qrbox: (viewWidth, viewHeight) => {
          const sisi = Math.floor(Math.min(viewWidth, viewHeight) * 0.68);
          return { width: sisi, height: sisi };
        } },
        onScanSuccess,
        () => {}
      ).then(() => {
        cameraLabel.textContent = 'Kamera siap';
        tampilkanStatus('Kamera aktif. Arahkan ke QR kelas untuk melanjutkan.');
      }).catch(() => {
        cameraLabel.textContent = 'Kamera tidak tersedia';
        tampilkanStatus('Kamera tidak dapat diakses. Pastikan izin kamera untuk situs ini diaktif, tutup aplikasi lain yang memakai kamera, lalu muat ulang. Kamera HP memerlukan HTTPS atau localhost.', true);
      });
    }

    window.addEventListener('load', () => {
      if (window.Html5Qrcode) {
        startScanner();
      } else {
        cameraLabel.textContent = 'Pemindai tidak tersedia';
        tampilkanStatus('Pemindai QR gagal dimuat. Muat ulang halaman dan coba lagi.', true);
      }
    });
  </script>

</body>

</html>
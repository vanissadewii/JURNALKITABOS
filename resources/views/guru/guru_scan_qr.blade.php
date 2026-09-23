<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scan QR Presensi Siswa</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            poppins: ['Poppins', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#F9F6F0',
              100: '#EFE6DD',
              200: '#E2C7B0',
              300: '#D7B899',
              600: '#7A6A60',
              700: '#6D5C52',
              800: '#5C4033',
              900: '#3E2B22',
            }
          }
        }
      }
    }
  </script>

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

        <a href="{{ url('/dashboard-guru-piket') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
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
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Scan QR Siswa</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full px-6 md:px-10 py-6 sm:py-8 flex-1 flex flex-col items-center justify-center gap-6">

      <!-- Card Camera Viewfinder -->
      <div class="w-full bg-white border border-brand-100 rounded-3xl p-6 sm:p-8 flex flex-col items-center gap-6 shadow-xs text-center">

        <div class="flex flex-col gap-1 max-w-xl">
          <h2 class="font-poppins font-bold text-lg sm:text-xl text-[#3E3028]">Pindai Kode QR Siswa</h2>
          <p class="text-xs sm:text-sm text-brand-600">Arahkan kamera ke QR Code kelas untuk memulai sesi mengajar.</p>
        </div>

        <!-- Box Frame Kamera -->
        <div class="w-full max-w-md aspect-square bg-gray-900 rounded-2xl relative overflow-hidden flex items-center justify-center shadow-inner border-4 border-brand-100">

          <div id="webcam-preview" class="w-full h-full"></div>

          <div class="absolute w-56 h-56 border-2 border-white/50 rounded-2xl flex flex-col justify-between p-2 pointer-events-none">
            <div class="flex justify-between">
              <div class="w-6 h-6 border-t-4 border-l-4 border-amber-400 rounded-tl-lg"></div>
              <div class="w-6 h-6 border-t-4 border-r-4 border-amber-400 rounded-tr-lg"></div>
            </div>

            <div class="w-full h-0.5 bg-gradient-to-r from-transparent via-rose-500 to-transparent shadow-[0_0_12px_#f43f5e] relative scanner-laser"></div>

            <div class="flex justify-between">
              <div class="w-6 h-6 border-b-4 border-l-4 border-amber-400 rounded-bl-lg"></div>
              <div class="w-6 h-6 border-b-4 border-r-4 border-amber-400 rounded-br-lg"></div>
            </div>
          </div>

          <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-md px-3 py-1 rounded-full flex items-center gap-2 border border-white/10">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span class="text-[11px] font-medium text-white">Kamera Aktif</span>
          </div>

        </div>

      </div>

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

      <a href="{{ url('/dashboard-guru-piket') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></a>

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

    async function onScanSuccess(qrCodeMessage) {
      if (scanFinished) return;

      const response = await fetch("{{ route('guru.scan-kelas.process', $jurnal) }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ kode_kelas: qrCodeMessage })
      });

      const result = await response.json();
      if (result.success) {
        scanFinished = true;
        window.location.href = result.redirect;
      } else {
        alert(result.message || 'QR kelas tidak valid.');
      }
    }

    function startScanner() {
      const scanner = new Html5Qrcode('webcam-preview');
      scanner.start(
        { facingMode: 'environment' },
        { fps: 10, qrbox: { width: 220, height: 220 } },
        onScanSuccess,
        () => {}
      ).catch(() => {
        document.getElementById('webcam-preview').innerHTML = '<p class="p-4 text-center text-sm text-white">Kamera tidak dapat diakses.</p>';
      });
    }

    window.addEventListener('load', () => {
      if (window.Html5Qrcode) startScanner();
    });
  </script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Verifikasi Jurnal</title>

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

  <!-- MAIN CONTENT AREA (Digeser ke kanan untuk layar laptop) -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">
    
    <!-- Top Header Bar (Warna Cokelat Dashboard) -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex items-center justify-between">
      <div class="max-w-4xl w-full mx-auto flex items-center justify-between">
        <a href="{{ url('/form-jurnal') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">QR Code Verifikasi Sesi</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-lg mx-auto px-4 sm:px-6 py-8 flex-1 flex flex-col items-center justify-center gap-6">
      
      <!-- Card Display QR Code -->
      <div class="w-full bg-white border border-brand-100 rounded-2xl p-6 sm:p-8 flex flex-col items-center gap-6 shadow-xs text-center">
        
        <div class="flex flex-col gap-1">
          <span class="px-3 py-1 bg-emerald-50 text-emerald-800 text-xs font-bold rounded-full border border-emerald-200 w-fit mx-auto flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Jurnal Berhasil Disimpan</span>
          </span>
          <h2 class="font-poppins font-bold text-xl sm:text-2xl text-[#3E3028] mt-2">{{ $jurnal->jadwal->mapel->nama_mapel ?? 'Mata Pelajaran' }} — {{ $jurnal->jadwal->kelas->nama_kelas }}</h2>
          <p class="text-xs text-brand-600">Tunjukkan QR ini ke kelas untuk diverifikasi.</p>
        </div>

        <!-- Box Display Timer Masa Berlaku QR -->
        <div class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 px-4 py-2 rounded-xl text-amber-800 text-xs sm:text-sm font-semibold">
          <svg class="w-4 h-4 text-amber-600 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
          <span>Masa berlaku QR: <strong id="timer-count" class="font-poppins font-bold text-amber-900">05:00</strong></span>
        </div>

        <!-- Box Gambar QR Code -->
        <div id="qr-container" class="p-4 bg-brand-50 border-2 border-dashed border-brand-200 rounded-2xl flex flex-col items-center justify-center gap-2 relative transition-all">
          
          <!-- Ilustrasi QR Code SVG -->
          <img id="qr-svg" class="w-48 h-48 transition-opacity duration-300" src="{{ $qrImage }}" alt="QR code verifikasi sesi">
          <span class="text-[11px] font-mono text-brand-600">ID Sesi: {{ $qrSesi->kode_qr }}</span>

          <!-- Overlay Kadaluarsa (Muncul jika waktu habis) -->
          <div id="qr-expired-overlay" class="hidden absolute inset-0 bg-white/90 backdrop-blur-xs rounded-2xl flex-col items-center justify-center p-4 gap-2">
            <span class="text-xs font-bold text-rose-600 uppercase tracking-wide">QR Kadaluarsa</span>
            <button onclick="resetTimer()" class="px-4 py-2 bg-brand-800 hover:bg-brand-900 text-white text-xs font-poppins font-semibold rounded-xl shadow-sm active:scale-95 transition-all">
              Generate Ulang QR
            </button>
          </div>

        </div>

        <!-- Tombol Kembali / Selesai -->
        <div class="w-full pt-2">
          <a href="{{ url('/dashboard-guru') }}" class="w-full h-12 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
            Kembali ke Beranda
          </a>
        </div>

      </div>

    </main>

  </div>

  <!-- Bottom Navigation Bar (Hanya muncul di Mobile/HP) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
        </svg>
        <span>Beranda</span>
      </a>

      <!-- Active Mobile Link (isi Jurnal) -->
      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>isi Jurnal</span>
      </a>

      <!-- Mobile Link Riwayat Jurnal -->
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

  <!-- Script Timer Hitung Mundur & Redirect Kamera Guru -->
  <script>
    let durasiDetik = 300; // 5 Menit
    let timerInterval;

    function startTimer() {
      const display = document.getElementById('timer-count');
      const overlay = document.getElementById('qr-expired-overlay');
      const svg = document.getElementById('qr-svg');

      timerInterval = setInterval(() => {
        let menit = Math.floor(durasiDetik / 60);
        let detik = durasiDetik % 60;

        menit = menit < 10 ? '0' + menit : menit;
        detik = detik < 10 ? '0' + detik : detik;

        display.textContent = `${menit}:${detik}`;

        if (--durasiDetik < 0) {
          clearInterval(timerInterval);
          display.textContent = "00:00";
          svg.classList.add('opacity-10');
          overlay.classList.remove('hidden');
          overlay.classList.add('flex');
        }
      }, 1000);
    }

    function resetTimer() {
      durasiDetik = 300;
      document.getElementById('qr-expired-overlay').classList.add('hidden');
      document.getElementById('qr-expired-overlay').classList.remove('flex');
      document.getElementById('qr-svg').classList.remove('opacity-10');
      startTimer();
    }

    // Jalankan timer saat halaman terbuka
    window.onload = startTimer;

    const statusUrl = "{{ route('qr.status-guru', $jurnal) }}";
    const homeUrl = "{{ url('/dashboard-guru') }}";

    const statusInterval = setInterval(async () => {
      const response = await fetch(statusUrl, { headers: { 'Accept': 'application/json' } });
      const result = await response.json();

      if (result.scanned) {
        clearInterval(statusInterval);
        window.location.href = homeUrl;
      }
    }, 2000);
  </script>

</body>
</html>
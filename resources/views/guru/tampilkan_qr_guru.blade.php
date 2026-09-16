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
</head>
<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

  <!-- SIDEBAR LEFT NAVIGATION (Desktop) -->
  <aside class="w-64 bg-white border-r border-brand-100 min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
    <div class="p-6 flex flex-col gap-8">
      
      <!-- Brand Logo / Title -->
      <div class="flex flex-col gap-0.5">
        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
        <span class="text-xs font-medium text-brand-600">Akun Guru</span>
      </div>

      <!-- Navigation Links -->
      <nav class="flex flex-col gap-1.5">
        
        <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
          </svg>
          <span>Beranda</span>
        </a>

        <!-- Active Link (isi Jurnal) -->
        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>isi Jurnal</span>
        </a>

        <!-- Menu Riwayat Jurnal -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
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
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
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
         <h2 class="font-poppins font-bold text-xl sm:text-2xl text-[#3E3028] mt-2">
    {{ $jurnal->jadwal->mapel->nama_mapel }} — {{ $jurnal->jadwal->kelas->nama_kelas }}
</h2>
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
    <img src="{{ $qrImage }}" alt="QR Code" class="w-48 h-48">
    <span class="text-[11px] font-mono text-brand-600">ID Sesi: {{ $qrSesi->kode_qr }}</span>

    <div id="qr-expired-overlay" class="hidden absolute inset-0 bg-white/90 backdrop-blur-xs rounded-2xl flex-col items-center justify-center p-4 gap-2">
        <span class="text-xs font-bold text-rose-600 uppercase tracking-wide">QR Kadaluarsa</span>
    </div>

    <div id="qr-verified-overlay" class="hidden absolute inset-0 bg-white/95 backdrop-blur-xs rounded-2xl flex-col items-center justify-center p-4 gap-2">
        <span class="text-xs font-bold text-emerald-600 uppercase tracking-wide">✓ Sudah Diverifikasi Kelas</span>
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
    const waktuExpired = new Date("{{ $qrSesi->waktu_expired->toIso8601String() }}").getTime();

    function updateTimer() {
        const sisaMs = waktuExpired - Date.now();
        const display = document.getElementById('timer-count');
        const overlay = document.getElementById('qr-expired-overlay');

        if (sisaMs <= 0) {
            display.textContent = "00:00";
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            return;
        }

        const menit = Math.floor(sisaMs / 60000);
        const detik = Math.floor((sisaMs % 60000) / 1000);
        display.textContent = `${String(menit).padStart(2, '0')}:${String(detik).padStart(2, '0')}`;
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    // Polling: cek apakah kelas sudah scan QR ini
    function cekStatus() {
        fetch("{{ route('qr.status-guru', $jurnal->id_jurnal) }}")
            .then(res => res.json())
            .then(data => {
                if (data.sudah_dipindai) {
                    document.getElementById('qr-verified-overlay').classList.remove('hidden');
                    document.getElementById('qr-verified-overlay').classList.add('flex');
                    clearInterval(pollInterval);
                }
            });
    }

    const pollInterval = setInterval(cekStatus, 3000);
</script>
</body>
</html>
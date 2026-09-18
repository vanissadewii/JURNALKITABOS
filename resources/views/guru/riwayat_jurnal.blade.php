<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jurnal Mengajar - Riwayat</title>

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

        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <!-- Active Link (Riwayat Jurnal) -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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

  <!-- MAIN CONTENT AREA (Full Width Desktop) -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">
    
    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="w-full flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Riwayat Jurnal Mengajar</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container (Penuh Lebar Layar) -->
    <main class="w-full px-6 md:px-10 py-6 sm:py-8 flex flex-col gap-6 flex-1">
      
      <!-- Section Title -->
      <div class="flex items-center justify-between">
        <h2 class="font-poppins font-bold text-sm sm:text-base tracking-wider uppercase text-brand-600">
          Daftar Sesi Mengajar
        </h2>
        <span class="text-xs font-semibold text-brand-700 bg-white border border-brand-100 px-3 py-1 rounded-full shadow-xs">
          3 Sesi Tersimpan
        </span>
      </div>

      <!-- Container Card Jurnal (Grid Responsif 1 -> 2 -> 3 Kolom) -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 w-full">
        
        <!-- CARD 1 -->
        <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4">
          
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Matematika</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">X RPL 1 • 21 Juli 2026 (Jam ke-1)</span>
              </div>
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1.5 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> Persamaan Linear Satu Variabel</p>
              <p><strong class="font-semibold text-[#3E3028]">Kehadiran:</strong> 30 Hadir / 2 Absen • <span class="text-brand-700 font-medium">07:03 – 07:43</span></p>
            </div>

            <!-- MINI-CARD: Keterangan Dispen / Absen -->
            <div class="bg-amber-50/60 border border-amber-200/60 rounded-xl p-3 flex flex-col gap-1.5 mt-1">
              <div class="flex items-center gap-1.5 text-amber-900 font-semibold text-xs">
                <svg class="w-4 h-4 text-amber-700 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <span>Siswa Dispen / Izin (2):</span>
              </div>
              <ul class="text-xs text-amber-900/90 pl-5 list-disc space-y-0.5">
                <li>Ahmad Dani <span class="text-amber-700 font-medium">(Dispen Lomba OSN)</span></li>
                <li>Siti Nurhaliza <span class="text-amber-700 font-medium">(Izin Sakit)</span></li>
              </ul>
            </div>

          </div>

          <!-- Action Button (Hanya Lihat) -->
          <div class="flex justify-end pt-2 border-t border-brand-50">
            <a href="{{ url('/detail-jurnal') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat Detail
            </a>
          </div>

        </div>

        <!-- CARD 2 -->
        <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4">
          
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Matematika</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">X RPL 2 • 21 Juli 2026 (Jam ke-2)</span>
              </div>
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1.5 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> Sistem Pertidaksamaan Linear</p>
              <p><strong class="font-semibold text-[#3E3028]">Kehadiran:</strong> 32 Hadir / 0 Absen • <span class="text-brand-700 font-medium">08:00 – 08:45</span></p>
            </div>

            <!-- MINI-CARD: Keterangan Dispen (Nihil) -->
            <div class="bg-brand-50 border border-brand-100/80 rounded-xl p-3 flex items-center gap-2 mt-1">
              <svg class="w-4 h-4 text-brand-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="text-xs text-brand-700 font-medium">Nihil / Seluruh siswa hadir kelas</span>
            </div>

          </div>

          <!-- Action Button (Hanya Lihat) -->
          <div class="flex justify-end pt-2 border-t border-brand-50">
            <a href="{{ url('/detail-jurnal') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat Detail
            </a>
          </div>

        </div>

        <!-- CARD 3 -->
        <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4">
          
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">Matematika</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">XI RPL 1 • 20 Juli 2026 (Jam ke-3)</span>
              </div>
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1.5 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> Fungsi Kuadrat & Grafik</p>
              <p><strong class="font-semibold text-[#3E3028]">Kehadiran:</strong> 28 Hadir / 1 Absen • <span class="text-brand-700 font-medium">09:00 – 09:45</span></p>
            </div>

            <!-- MINI-CARD: Keterangan Dispen -->
            <div class="bg-amber-50/60 border border-amber-200/60 rounded-xl p-3 flex flex-col gap-1.5 mt-1">
              <div class="flex items-center gap-1.5 text-amber-900 font-semibold text-xs">
                <svg class="w-4 h-4 text-amber-700 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <span>Siswa Dispen / Izin (1):</span>
              </div>
              <ul class="text-xs text-amber-900/90 pl-5 list-disc space-y-0.5">
                <li>Budi Pratama <span class="text-amber-700 font-medium">(Dispen Tugas Paskibra)</span></li>
              </ul>
            </div>

          </div>

          <!-- Action Button (Hanya Lihat) -->
          <div class="flex justify-end pt-2 border-t border-brand-50">
            <a href="{{ url('/detail-jurnal') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat Detail
            </a>
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

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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

</body>
</html>
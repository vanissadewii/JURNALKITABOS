<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sesi Terverifikasi</title>

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
              50: '#F5EFE8',
              100: '#E5D8CC',
              200: '#E2C7B0',
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
<body class="bg-[#F5EFE8] font-sans min-h-screen flex flex-col justify-between text-[#3E3028]">

  <div class="w-full flex-1 flex flex-col items-center">
    
    <!-- Screen Header -->
    <header class="w-full bg-white border-b border-[#E5D8CC] sticky top-0 z-40 shadow-sm">
      <div class="max-w-4xl mx-auto px-4 h-12 sm:h-14 flex items-center justify-between">
        <a href="{{ url('/dashboard-guru') }}" class="w-8 h-8 flex items-center justify-center text-[#3E3028] hover:opacity-75 transition-opacity" aria-label="Kembali ke Dashboard">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-semibold text-base sm:text-lg text-[#3E3028]">Sesi Berjalan</h1>
        <div class="w-8"></div>
      </div>
    </header>

    <!-- Main Content Container (1 Kolom di HP, 2 Kolom di Desktop) -->
    <main class="w-full max-w-3xl px-4 sm:px-6 py-6 md:py-10 flex-1 flex flex-col items-center justify-center">
      
      <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        
        <!-- KOLOM KIRI: Indikator Sukses -->
        <div class="flex flex-col items-center text-center gap-3">
          
          <!-- Circle Checkmark Icon -->
          <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#E8F5E9] flex items-center justify-center shadow-sm">
            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#2E7D32]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
          </div>

          <div class="flex flex-col items-center gap-2">
            <h2 class="font-poppins font-bold text-xl sm:text-2xl text-[#2E7D32]">✓ Sesi Terverifikasi</h2>
            
            <!-- Badge Sedang Mengajar -->
            <span class="px-3.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs tracking-wide uppercase">
              SEDANG MENGAJAR
            </span>
          </div>

        </div>

        <!-- KOLOM KANAN: Detail Informasi Sesi -->
        <div class="flex flex-col gap-5 w-full">
          
          <!-- Detail Box -->
          <div class="bg-white border border-[#E5D8CC] rounded-xl p-4 sm:p-5 flex flex-col divide-y divide-[#E5D8CC] shadow-sm text-xs sm:text-sm">
            
            <div class="flex justify-between items-center py-2.5">
              <span class="text-[#7A6A60]">Pengajar</span>
              <span class="font-semibold text-[#3E3028]">Budi Santoso</span>
            </div>

            <div class="flex justify-between items-center py-2.5">
              <span class="text-[#7A6A60]">Kelas</span>
              <span class="font-semibold text-[#3E3028]">X RPL 1</span>
            </div>

            <div class="flex justify-between items-center py-2.5">
              <span class="text-[#7A6A60]">Mata Pelajaran</span>
              <span class="font-semibold text-[#3E3028]">Matematika</span>
            </div>

            <div class="flex justify-between items-center py-2.5">
              <span class="text-[#7A6A60]">Check-in Sesi</span>
              <span class="font-semibold text-[#3E3028]">07:03 WIB</span>
            </div>

            <div class="flex justify-between items-center py-2.5">
              <span class="text-[#7A6A60]">Siswa Terverifikasi</span>
              <span class="font-semibold text-[#2E7D32]">Perwakilan (Kehadiran Sah)</span>
            </div>

          </div>

          <!-- Instruction & Primary Button -->
          <div class="flex flex-col items-center gap-3 w-full">
            <p class="text-xs text-[#7A6A60] text-center leading-relaxed">
              Gunakan tombol di bawah ini untuk menutup sesi ketika jam pelajaran selesai.
            </p>

            <a href="{{ url('/dashboard-guru') }}" class="w-full h-11 bg-[#5C4033] hover:bg-[#4A3329] text-white font-poppins font-semibold text-sm rounded-lg flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
              Selesai Mengajar
            </a>
          </div>

        </div>

      </div>

    </main>

  </div>

</body>
</html>
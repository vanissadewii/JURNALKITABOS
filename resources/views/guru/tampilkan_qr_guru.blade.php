<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Presensi Guru</title>

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
      <div class="max-w-5xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
        <a href="{{ url('/mulai-sesi') }}" class="w-8 h-8 flex items-center justify-center text-[#3E3028] hover:opacity-75 transition-opacity" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-semibold text-base sm:text-lg text-[#3E3028]">Scan QR Pengajar</h1>
        <div class="w-8"></div>
      </div>
    </header>

    <!-- Main Content Grid (1 Kolom di HP, 2 Kolom di Laptop) -->
    <main class="w-full max-w-5xl px-4 sm:px-6 py-6 md:py-10 flex-1 flex flex-col items-center justify-center">
      
      <!-- Headline Group -->
      <div class="flex flex-col items-center text-center gap-1 mb-6">
        <h2 class="font-poppins font-bold text-lg sm:text-2xl text-[#3E3028]">Scan QR Ini Untuk Verifikasi</h2>
        <p class="text-xs sm:text-sm text-[#7A6A60] max-w-md">
          Perwakilan siswa harus melakukan scan untuk mengonfirmasi sesi mengajar.
        </p>
      </div>

      <!-- Two-Column Wrapper for Desktop -->
      <div class="w-full max-w-3xl grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        
        <!-- KOLOM KIRI: QR Code Box -->
        <div class="bg-white border border-[#E5D8CC] rounded-2xl p-6 shadow-sm flex flex-col items-center gap-4 w-full justify-center">
          
          <div class="w-[200px] h-[200px] sm:w-[220px] sm:h-[220px] bg-white flex items-center justify-center p-2 border border-dashed border-[#E5D8CC] rounded-xl">
            <svg class="w-full h-full text-[#5C4033]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M3 3h6v6H3zM15 3h6v6h-6zM3 15h6v6H3zM15 15h3v3h-3zM18 18h3v3h-3zM15 18h3v3h-3zM18 15h3v3h-3z"/>
            </svg>
          </div>

          <!-- Timer Badge -->
          <div class="px-3 py-1 bg-[#FFFDE7] border border-amber-200 rounded-lg flex items-center justify-center">
            <span class="text-xs font-semibold text-[#F57F17]">
              QR berlaku: <span id="timer">01:48</span>
            </span>
          </div>

        </div>

        <!-- KOLOM KANAN: Detail Informasi & Tombol Aksi -->
        <div class="flex flex-col gap-5 w-full">
          
          <!-- Detail Card -->
          <div class="bg-white border border-[#E5D8CC] rounded-2xl p-5 w-full flex flex-col gap-3 shadow-sm text-xs sm:text-sm">
            
            <div class="flex justify-between items-center py-1">
              <span class="text-[#7A6A60]">Pengajar:</span>
              <span class="font-semibold text-[#3E3028]">Budi Santoso</span>
            </div>

            <div class="w-full h-px bg-[#F5EFE8]"></div>

            <div class="flex justify-between items-center py-1">
              <span class="text-[#7A6A60]">Kelas:</span>
              <span class="font-semibold text-[#3E3028]">X RPL 1</span>
            </div>

            <div class="w-full h-px bg-[#F5EFE8]"></div>

            <div class="flex justify-between items-center py-1">
              <span class="text-[#7A6A60]">Mata Pelajaran:</span>
              <span class="font-semibold text-[#3E3028]">Matematika</span>
            </div>

            <div class="w-full h-px bg-[#F5EFE8]"></div>

            <div class="flex justify-between items-center py-1">
              <span class="text-[#7A6A60]">Waktu:</span>
              <span class="font-semibold text-[#3E3028]">Jam ke-1 (07:03)</span>
            </div>

          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col gap-2.5 w-full">
            <a href="{{ url('/scan-qr-siswa') }}" class="w-full h-11 bg-gradient-to-r from-brand-800 to-brand-900 text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md hover:opacity-95 active:scale-[0.99] transition-all">
              Lanjut Scan QR Siswa
            </a>

            <a href="{{ url('/mulai-sesi') }}" class="w-full h-11 bg-white border-[1.5px] border-[#5C4033] text-[#5C4033] hover:bg-[#F5EFE8] font-poppins font-semibold text-sm rounded-xl flex items-center justify-center active:scale-[0.99] transition-all">
              Batal Sesi
            </a>
          </div>

        </div>

      </div>

    </main>

  </div>

</body>
</html>
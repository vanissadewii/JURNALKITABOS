<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selesai Mengajar - Konfirmasi</title>

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
<body class="bg-brand-50 font-sans min-h-screen relative overflow-x-hidden text-[#3E3028] flex">

  <!-- BACKGROUND BACKDROP CONTENT (Latar Belakang Sesi Berjalan) -->
  <div class="w-full min-h-screen opacity-30 pointer-events-none flex flex-col justify-between flex-1 md:ml-64">
    
    <!-- Header Backdrop -->
    <header class="w-full bg-[#5C4033] h-16 flex items-center justify-between px-6">
      <div class="w-9 h-9"></div>
      <h1 class="font-poppins font-bold text-base text-white">Sesi Berjalan</h1>
      <div class="w-9 h-9"></div>
    </header>

    <!-- Main Content Background Placeholder -->
    <main class="max-w-xl mx-auto w-full p-6 flex flex-col gap-4">
      <div class="bg-white rounded-2xl p-6 flex flex-col gap-2 border border-brand-100">
        <h3 class="font-bold text-xl text-[#3E3028]">Matematika - X RPL 1</h3>
        <span class="text-sm text-brand-600">07:00 – 07:45 (Jam ke-1)</span>
      </div>
    </main>

    <div></div>
  </div>

  <!-- MODAL DIALOG OVERLAY UTAMA -->
  <div class="fixed inset-0 bg-[#3E3028]/50 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    
    <!-- Dialog Box Card -->
    <div class="bg-white w-full max-w-[342px] rounded-2xl p-6 shadow-xl flex flex-col gap-6 border border-brand-100 animate-in fade-in zoom-in-95 duration-200">
      
      <!-- Dialog Header Text -->
      <div class="flex flex-col gap-1.5">
        <h2 class="font-poppins font-bold text-xl leading-tight text-[#3E3028]">
          Selesai Mengajar?
        </h2>
        <p class="text-xs leading-relaxed text-brand-600">
          Konfirmasi penyelesaian sesi untuk memproses jurnal mengajar.
        </p>
      </div>

      <!-- Sesi Ringkasan Box -->
      <div class="bg-brand-50/80 rounded-xl p-4 flex flex-col gap-2.5 border border-brand-100/60">
        
        <div class="flex justify-between items-center text-xs">
          <span class="text-brand-600 font-medium">Kelas</span>
          <span class="font-bold text-[#3E3028]">X RPL 1</span>
        </div>

        <div class="w-full h-px bg-brand-100"></div>

        <div class="flex justify-between items-center text-xs">
          <span class="text-brand-600 font-medium">Mulai</span>
          <span class="font-bold text-[#3E3028]">07:03 WIB</span>
        </div>

        <div class="w-full h-px bg-brand-100"></div>

        <div class="flex justify-between items-center text-xs">
          <span class="text-brand-600 font-medium">Waktu Sekarang</span>
          <span class="font-bold text-[#3E3028]">07:43 WIB</span>
        </div>

      </div>

      <!-- Action Button Group -->
      <div class="flex flex-col gap-2.5">
        <!-- Tombol Konfirmasi 'Ya, Selesai' -->
        <a href="{{ url('/dashboard-guru') }}" class="w-full h-11 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-xs rounded-xl flex items-center justify-center shadow-md active:scale-[0.98] transition-all">
          Ya, Selesai
        </a>

        <!-- Tombol Batal -->
        <a href="{{ url('/sesi-terverifikasi') }}" class="w-full h-11 bg-white border border-[#5C4033] text-[#5C4033] hover:bg-brand-50 font-poppins font-semibold text-xs rounded-xl flex items-center justify-center active:scale-[0.98] transition-all">
          Batal
        </a>
      </div>

    </div>

  </div>

</body>
</html>
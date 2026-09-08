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
<body class="bg-[#F5EFE8] font-sans min-h-screen relative overflow-x-hidden text-[#3E3028]">

  <!-- Background Content (Latar Belakang Sesi Berjalan) -->
  <div class="w-full min-h-screen opacity-40 pointer-events-none flex flex-col justify-between">
    
    <!-- Screen Header Backdrop -->
    <header class="w-full bg-white border-b border-[#E5D8CC] h-12 flex items-center justify-between px-4">
      <div class="w-8 h-8"></div>
      <h1 class="font-poppins font-semibold text-base text-[#3E3028]">Sesi Berjalan</h1>
      <div class="w-8 h-8"></div>
    </header>

    <!-- Main Content Background Placeholder -->
    <main class="max-w-md mx-auto w-full p-5 flex flex-col gap-4">
      <div class="bg-white rounded-xl p-4 flex flex-col gap-2">
        <h3 class="font-bold text-lg text-[#3E3028]">Matematika - X RPL 1</h3>
        <span class="text-sm text-[#7A6A60]">07:00 – 07:45 (Jam ke-1)</span>
      </div>
    </main>

    <div></div>
  </div>

  <!-- Modal Backdrop Overlay (Dialog Box Utama) -->
  <div class="fixed inset-0 bg-[#3E3028]/40 backdrop-blur-xs z-50 flex items-center justify-center p-4">
    
    <!-- Dialog Box Card (342px Width Sesuai Figma) -->
    <div class="bg-white w-full max-w-[342px] rounded-xl p-6 shadow-[0_8px_24px_rgba(62,48,40,0.15)] flex flex-col gap-6 border border-[#E5D8CC]/50 animate-in fade-in zoom-in-95 duration-200">
      
      <!-- Dialog Header Text -->
      <div class="flex flex-col gap-2">
        <h2 class="font-poppins font-bold text-[20px] leading-[30px] text-[#3E3028]">
          Selesai Mengajar?
        </h2>
        <p class="text-[14px] leading-[17px] text-[#7A6A60]">
          Konfirmasi penyelesaian sesi untuk memproses jurnal mengajar.
        </p>
      </div>

      <!-- Sesi Ringkasan Box -->
      <div class="bg-[#F5EFE8] rounded-lg p-4 flex flex-col gap-2.5">
        
        <div class="flex justify-between items-center text-[13px] leading-[16px]">
          <span class="text-[#7A6A60]">Kelas</span>
          <span class="font-semibold text-[#3E3028] text-right">X RPL 1</span>
        </div>

        <div class="w-full h-px bg-[#E5D8CC]"></div>

        <div class="flex justify-between items-center text-[13px] leading-[16px]">
          <span class="text-[#7A6A60]">Mulai</span>
          <span class="font-semibold text-[#3E3028] text-right">07:03 WIB</span>
        </div>

        <div class="w-full h-px bg-[#E5D8CC]"></div>

        <div class="flex justify-between items-center text-[13px] leading-[16px]">
          <span class="text-[#7A6A60]">Waktu Sekarang</span>
          <span class="font-semibold text-[#3E3028] text-right">07:43 WIB</span>
        </div>

      </div>

      <!-- Action Button Group -->
      <div class="flex flex-col gap-3">
        <!-- Tombol Konfirmasi 'Ya, Selesai' -->
        <a href="{{ url('/dashboard-guru') }}" class="w-full h-[45px] bg-[#5C4033] hover:bg-[#4A3329] text-white font-poppins font-semibold text-[14px] leading-[21px] rounded-lg flex items-center justify-center shadow-md active:scale-[0.98] transition-all">
          Ya, Selesai
        </a>

        <!-- Tombol Batal -->
        <a href="{{ url('/sesi-terverifikasi') }}" class="w-full h-[45px] bg-white border-[1.5px] border-[#5C4033] text-[#5C4033] hover:bg-[#F5EFE8] font-poppins font-semibold text-[14px] leading-[21px] rounded-lg flex items-center justify-center active:scale-[0.98] transition-all">
          Batal
        </a>
      </div>

    </div>

  </div>

</body>
</html>
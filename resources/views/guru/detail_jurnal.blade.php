<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jurnal Mengajar - Detail Sesi</title>

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

  <!-- MAIN CONTENT AREA -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">
    
    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="max-w-4xl w-full mx-auto flex items-center justify-between">
        <a href="{{ url('/riwayat-jurnal') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Detail Sesi Mengajar</h1>
        <button onclick="window.print()" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" title="Cetak / Download PDF">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 6 2 18 2 18 9"></polyline>
            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
            <rect x="6" y="14" width="12" height="8"></rect>
          </svg>
        </button>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full max-w-4xl mx-auto px-4 sm:px-6 py-6 sm:py-8 flex flex-col gap-6 flex-1">
      
      <!-- Status Card -->
      <div class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
          <div class="w-10 h-10 rounded-xl bg-[#E8F5E9] flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-[#2E7D32]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
              <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
          </div>
          <div>
            <h2 class="font-poppins font-bold text-base text-[#3E3028]">Sesi Mengajar Terverifikasi</h2>
            <p class="text-xs text-brand-600">Disetujui oleh Kurikulum pada 21 Juli 2026 • 09:30 WIB</p>
          </div>
        </div>
        <a href="{{ url('/form-jurnal') }}" class="px-4 py-2 bg-brand-50 border border-brand-800 text-brand-800 hover:bg-brand-100 font-poppins font-semibold text-xs rounded-xl transition-colors shrink-0">
          Edit Jurnal
        </a>
      </div>

      <!-- Detail Informasi Utama -->
      <div class="bg-white border border-brand-100 rounded-2xl p-6 shadow-xs flex flex-col gap-6">
        
        <div class="flex flex-col gap-1 border-b border-brand-100 pb-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-brand-600">Mata Pelajaran</span>
          <h3 class="font-poppins font-extrabold text-xl sm:text-2xl text-[#3E3028]">Matematika</h3>
        </div>

        <!-- Grid Rincian Informasi -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs sm:text-sm">
          <div class="flex flex-col gap-1">
            <span class="text-brand-600 font-medium">Kelas</span>
            <span class="font-poppins font-bold text-[#3E3028]">X RPL 1</span>
          </div>

          <div class="flex flex-col gap-1">
            <span class="text-brand-600 font-medium">Tanggal</span>
            <span class="font-poppins font-bold text-[#3E3028]">21 Juli 2026</span>
          </div>

          <div class="flex flex-col gap-1">
            <span class="text-brand-600 font-medium">Jam Ke-</span>
            <span class="font-poppins font-bold text-[#3E3028]">Jam ke-1</span>
          </div>

          <div class="flex flex-col gap-1">
            <span class="text-brand-600 font-medium">Waktu Sesi</span>
            <span class="font-poppins font-bold text-[#3E3028]">07:03 – 07:43 WIB</span>
          </div>
        </div>

        <div class="w-full h-px bg-brand-100"></div>

        <!-- Material / Topics -->
        <div class="flex flex-col gap-2">
          <h4 class="font-poppins font-bold text-sm text-[#3E3028] uppercase tracking-wider text-brand-600">Materi Pembelajaran</h4>
          <p class="text-sm font-medium text-[#3E3028] leading-relaxed bg-brand-50 p-4 rounded-xl border border-brand-100">
            Persamaan Linear Satu Variabel (PLSV) — Membahas konsep dasar, bentuk umum, serta metode penyelesaian soal cerita kehidupan sehari-hari.
          </p>
        </div>

        <!-- Catatan Pembelajaran / Jurnal Kelas -->
        <div class="flex flex-col gap-2">
          <h4 class="font-poppins font-bold text-sm text-[#3E3028] uppercase tracking-wider text-brand-600">Catatan KBM & Kendala Kelas</h4>
          <div class="text-sm text-brand-700 leading-relaxed bg-brand-50 p-4 rounded-xl border border-brand-100 flex flex-col gap-2">
            <p>• Pembelajaran berjalan lancar, antusiasme siswa cukup baik saat latihan soal kelompok.</p>
            <p>• Terdapat 2 siswa yang tidak hadir karena sakit dan ada surat izin terlampir.</p>
          </div>
        </div>

      </div>

      <!-- Rekap Kehadiran Siswa -->
      <div class="bg-white border border-brand-100 rounded-2xl p-6 shadow-xs flex flex-col gap-5">
        
        <div class="flex items-center justify-between border-b border-brand-100 pb-4">
          <h4 class="font-poppins font-bold text-base text-[#3E3028]">Presensi Siswa</h4>
          <span class="text-xs font-semibold text-brand-800 bg-brand-50 border border-brand-100 px-3 py-1 rounded-full">
            Total 32 Siswa
          </span>
        </div>

        <!-- Summary Stat Badges -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
          <div class="p-3 rounded-xl bg-[#E8F5E9] border border-[#C8E6C9] flex flex-col items-center">
            <span class="text-xs text-[#2E7D32] font-medium">Hadir</span>
            <span class="font-poppins font-bold text-lg text-[#1B5E20]">30</span>
          </div>
          <div class="p-3 rounded-xl bg-[#FFF3E0] border border-[#FFE0B2] flex flex-col items-center">
            <span class="text-xs text-[#E65100] font-medium">Sakit</span>
            <span class="font-poppins font-bold text-lg text-[#BF360C]">1</span>
          </div>
          <div class="p-3 rounded-xl bg-[#E3F2FD] border border-[#BBDEFB] flex flex-col items-center">
            <span class="text-xs text-[#1565C0] font-medium">Izin</span>
            <span class="font-poppins font-bold text-lg text-[#0D47A1]">1</span>
          </div>
          <div class="p-3 rounded-xl bg-[#FFEBEE] border border-[#FFCDD2] flex flex-col items-center">
            <span class="text-xs text-[#C62828] font-medium">Alpha</span>
            <span class="font-poppins font-bold text-lg text-[#B71C1C]">0</span>
          </div>
        </div>

        <!-- Tabel Siswa Absen / Keterangan -->
        <div class="flex flex-col gap-2 mt-2">
          <span class="text-xs font-semibold text-brand-600 uppercase tracking-wider">Daftar Siswa Tidak Hadir</span>
          <div class="overflow-x-auto rounded-xl border border-brand-100">
            <table class="w-full text-left text-xs sm:text-sm">
              <thead class="bg-brand-50 text-brand-800 font-poppins font-semibold border-b border-brand-100">
                <tr>
                  <th class="p-3">No</th>
                  <th class="p-3">Nama Siswa</th>
                  <th class="p-3">Status</th>
                  <th class="p-3">Keterangan</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-brand-100 text-[#3E3028]">
                <tr>
                  <td class="p-3 font-medium">1</td>
                  <td class="p-3 font-semibold">Ahmad Fauzi</td>
                  <td class="p-3">
                    <span class="px-2 py-0.5 bg-[#FFF3E0] text-[#E65100] rounded font-semibold text-xs">Sakit</span>
                  </td>
                  <td class="p-3 text-brand-600">Surat dari dokter terlampir</td>
                </tr>
                <tr>
                  <td class="p-3 font-medium">2</td>
                  <td class="p-3 font-semibold">Budi Santoso</td>
                  <td class="p-3">
                    <span class="px-2 py-0.5 bg-[#E3F2FD] text-[#1565C0] rounded font-semibold text-xs">Izin</span>
                  </td>
                  <td class="p-3 text-brand-600">Acara keluarga</td>
                </tr>
              </tbody>
            </table>
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
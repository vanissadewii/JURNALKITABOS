<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jurnal Mengajar - Detail Sesi</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'], poppins: ['Poppins', 'sans-serif'] },
          colors: {
            brand: {
              50: '#F9F6F0', 100: '#EFE6DD', 200: '#E2C7B0', 300: '#D7B899',
              600: '#7A6A60', 700: '#6D5C52', 800: '#5C4033', 900: '#3E2B22',
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

@php
  $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  $tglIndo = fn ($t) => $t->format('j').' '.$bulan[$t->month - 1].' '.$t->format('Y');

  $guruHadir = $jurnal->status_kehadiran_guru === 'hadir';
  $terverifikasi = $jurnal->status_verifikasi === 'terverifikasi';

  $labelJam = $jamAwal
      ? 'Jam ke-'.$jamAwal->jam_ke.((int) $jamAkhir->jam_ke !== (int) $jamAwal->jam_ke ? ' s/d '.$jamAkhir->jam_ke : '')
      : '-';
  $labelWaktu = $jamAwal
      ? substr($jamAwal->jam_mulai, 0, 5).' – '.substr($jamAkhir->jam_selesai, 0, 5).' WIB'
      : '-';

  $badgeStatus = [
    'Sakit' => 'bg-amber-50 text-amber-800 border-amber-200',
    'Izin'  => 'bg-blue-50 text-blue-700 border-blue-200',
    'Alpha' => 'bg-rose-50 text-rose-700 border-rose-200',
  ];
@endphp

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

        <a href="{{ route('jurnal.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold text-md text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
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
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">
    
    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-6 md:px-10 h-16 flex items-center justify-between">
      <div class="w-full flex items-center justify-between">
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
    <main class="w-full px-6 md:px-10 py-6 sm:py-8 flex flex-col gap-6 flex-1">

      <!-- STATUS VERIFIKASI -->
      @if (! $guruHadir)
        <div class="bg-white border border-brand-100 rounded-2xl p-5 flex items-center gap-4 shadow-xs">
          <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0 font-poppins font-bold">i</div>
          <div>
            <h2 class="font-poppins font-bold text-base text-[#3E3028]">Guru {{ ucfirst($jurnal->status_kehadiran_guru) }}</h2>
            <p class="text-xs sm:text-sm text-brand-600">Guru tidak masuk kelas, sehingga tidak ada verifikasi QR.</p>
          </div>
        </div>
      @elseif ($terverifikasi)
        <div class="bg-white border border-brand-100 rounded-2xl p-5 flex items-center gap-4 shadow-xs">
          <div class="w-12 h-12 rounded-xl bg-[#E8F5E9] text-[#2E7D32] flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
          </div>
          <div>
            <h2 class="font-poppins font-bold text-base text-[#3E3028]">Sesi Mengajar Terverifikasi</h2>
            <p class="text-xs text-brand-600">Disetujui oleh Tim Kurikulum pada 21 Juli 2026 • 09:30 WIB</p>
          </div>
        </div>
      @else
        <div class="bg-white border border-amber-200 rounded-2xl p-5 flex items-center gap-4 shadow-xs">
          <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0 font-poppins font-bold">!</div>
          <div>
            <h2 class="font-poppins font-bold text-base text-[#3E3028]">Belum Diverifikasi</h2>
            <p class="text-xs sm:text-sm text-brand-600">Kelas belum memindai QR untuk sesi ini.</p>
          </div>
        </div>
      @endif

      <!-- Detail Informasi Utama -->
      <div class="bg-white border border-brand-100 rounded-2xl p-6 shadow-xs flex flex-col gap-6">
        
        <div class="flex flex-col gap-1 border-b border-brand-100 pb-4">
          <span class="text-xs font-semibold uppercase tracking-wider text-brand-600">Kelas</span>
          <h3 class="font-poppins font-extrabold text-xl sm:text-2xl text-[#3E3028]">X RPL 1</h3>
          <p class="text-sm font-medium text-[#8C7B70]">Matematika</p>
        </div>

        <!-- Grid Rincian Informasi -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs sm:text-sm">
          <div class="flex flex-col gap-1">
            <span class="text-brand-600 font-medium">Mata Pelajaran</span>
            <span class="font-poppins font-bold text-[#3E3028]">Matematika</span>
          </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 text-sm">
          <div>
            <p class="text-brand-600">Kelas</p>
            <p class="font-poppins font-bold text-[#3E3028]">{{ $jadwal->kelas->nama_kelas ?? '-' }}</p>
          </div>
          <div>
            <p class="text-brand-600">Tanggal</p>
            <p class="font-poppins font-bold text-[#3E3028]">{{ $tglIndo($jurnal->tanggal) }}</p>
          </div>
          <div>
            <p class="text-brand-600">Jam Ke-</p>
            <p class="font-poppins font-bold text-[#3E3028]">{{ $labelJam }}</p>
          </div>
          <div>
            <p class="text-brand-600">Waktu Sesi</p>
            <p class="font-poppins font-bold text-[#3E3028]">{{ $labelWaktu }}</p>
          </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 text-sm">
          <div>
            <p class="text-brand-600">Kehadiran Guru</p>
            <p class="font-poppins font-bold text-[#3E3028]">{{ $guruHadir ? 'Hadir di Kelas' : ucfirst($jurnal->status_kehadiran_guru) }}</p>
          </div>
          @if ($guruHadir)
            <div>
              <p class="text-brand-600">Siswa Hadir</p>
              <p class="font-poppins font-bold text-[#3E3028]">{{ $jurnal->jumlah_hadir ?? '-' }}</p>
            </div>
            <div>
              <p class="text-brand-600">Siswa Tidak Hadir</p>
              <p class="font-poppins font-bold text-[#3E3028]">{{ count($tidakHadir) }}</p>
            </div>
          @endif
          <div>
            <p class="text-brand-600">Jurnal Diisi</p>
            <p class="font-poppins font-bold text-[#3E3028]">
              {{ $jurnal->waktu_submit ? $jurnal->waktu_submit->format('H:i').' WIB' : '-' }}
            </p>
          </div>
        </div>

        <div class="w-full h-px bg-brand-50"></div>

        <!-- Materi Pembelajaran -->
        <div class="flex flex-col gap-2">
          <h3 class="font-poppins font-bold text-sm uppercase tracking-wider text-brand-600">Materi Pembelajaran</h3>
          <div class="bg-brand-50 border border-brand-100 rounded-xl p-4 text-sm">
            {{ $jurnal->materi ?: 'Materi belum diisi.' }}
          </div>
        </div>

      </div>

        @forelse ($tidakHadir as $s)
          <div class="flex items-center justify-between gap-3 p-3 bg-brand-50/60 border border-brand-100 rounded-xl text-sm">
            <div class="flex items-center gap-3 min-w-0">
              <span class="w-7 h-7 rounded-full bg-brand-100 text-brand-800 font-bold text-xs flex items-center justify-center shrink-0">{{ $loop->iteration }}</span>
              <span class="font-semibold text-[#3E3028] truncate">{{ $s['nama'] }}</span>
            </div>
            <span class="px-2.5 py-1 border rounded-md font-semibold text-xs shrink-0 {{ $badgeStatus[$s['status']] ?? 'bg-gray-100 text-gray-600 border-gray-200' }}">
              {{ $s['status'] }}
            </span>
          </div>
        @empty
          <p class="text-sm text-brand-600">Nihil, seluruh siswa hadir.</p>
        @endforelse
      </section>
      @endif

        <!-- Ringkasan Kehadiran -->
        <div class="grid grid-cols-5 gap-2 sm:gap-3">
          <div class="rounded-xl bg-[#E8F5E9] border border-[#C8E6C9] px-2 py-2 text-center"><span class="block text-[10px] sm:text-xs text-[#2E7D32]">Hadir</span><span class="font-bold text-base text-[#1B5E20]">30</span></div>
          <div class="rounded-xl bg-[#FFF3E0] border border-[#FFE0B2] px-2 py-2 text-center"><span class="block text-[10px] sm:text-xs text-[#E65100]">Sakit</span><span class="font-bold text-base text-[#BF360C]">1</span></div>
          <div class="rounded-xl bg-[#E3F2FD] border border-[#BBDEFB] px-2 py-2 text-center"><span class="block text-[10px] sm:text-xs text-[#1565C0]">Izin</span><span class="font-bold text-base text-[#0D47A1]">1</span></div>
          <div class="rounded-xl bg-[#FFEBEE] border border-[#FFCDD2] px-2 py-2 text-center"><span class="block text-[10px] sm:text-xs text-[#C62828]">Alpa</span><span class="font-bold text-base text-[#B71C1C]">0</span></div>
          <div class="rounded-xl bg-violet-50 border border-violet-200 px-2 py-2 text-center"><span class="block text-[10px] sm:text-xs text-violet-700">Dispen</span><span class="font-bold text-base text-violet-900">0</span></div>
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
                  <td class="p-3 font-semibold">Ahmad Dani</td>
                  <td class="p-3">
                    <span class="px-2 py-0.5 bg-[#E3F2FD] text-[#1565C0] rounded font-semibold text-xs">Izin</span>
                  </td>
                  <td class="p-3 text-brand-600">Acara keluarga terlampir</td>
                </tr>
                <tr>
                  <td class="p-3 font-medium">2</td>
                  <td class="p-3 font-semibold">Siti Nurhaliza</td>
                  <td class="p-3">
                    <span class="px-2 py-0.5 bg-[#FFF3E0] text-[#E65100] rounded font-semibold text-xs">Sakit</span>
                  </td>
                  <td class="p-3 text-brand-600">Surat dari dokter terlampir</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </main>
  </div>

  <!-- Bottom Nav (Mobile) -->
  <nav class="print:hidden md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
        <span>Beranda</span>
      </a>
      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/><path d="M7 3v14"/></svg>
        <span>Isi Jurnal</span>
      </a>
      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 4h14M3 8h14M3 12h10M3 16h6"/></svg>
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

</body>
</html>
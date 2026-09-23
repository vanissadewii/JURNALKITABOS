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
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
          </svg>
          <span>Beranda</span>
        </a>

        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
            <path d="M7 3v14" />
          </svg>
          <span>Isi Jurnal</span>
        </a>

        <!-- Active Link (Riwayat Jurnal) -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6" />
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17" />
            <circle cx="10" cy="6.5" r="3.5" />
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
        <a href="{{ url('/dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95" aria-label="Kembali">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </a>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Riwayat Jurnal Mengajar</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full px-6 md:px-10 py-6 sm:py-8 flex flex-col gap-6 flex-1">

      <!-- KALENDER GRID KOTAK (BULAN 1-12 & HARI 1-30/31) -->
      <section class="bg-white border border-brand-100 rounded-2xl p-5 shadow-xs flex flex-col gap-4">

        <!-- Header Pilih Bulan & Tahun + Tombol Tampilkan Semua -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-brand-50 pb-3">
          <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center text-brand-800 shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <h2 class="font-poppins font-bold text-base text-[#3E3028]">Kalender Sesi Mengajar</h2>
              <p class="text-xs text-brand-600">Klik salah satu tanggal pada kotak untuk melihat jurnal</p>
            </div>
          </div>

          <div class="flex items-center gap-2">
            <!-- Select Bulan (1-12) -->
            <select id="month-select" onchange="generateGridCalendar()" class="bg-brand-50 border border-brand-200 text-[#3E3028] text-xs rounded-xl px-3 py-2 font-semibold focus:ring-2 focus:ring-brand-800 focus:outline-none cursor-pointer">
              <option value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>

            <!-- Select Tahun -->
            <select id="year-select" onchange="generateGridCalendar()" class="bg-brand-50 border border-brand-200 text-[#3E3028] text-xs rounded-xl px-3 py-2 font-semibold focus:ring-2 focus:ring-brand-800 focus:outline-none cursor-pointer">
              <option value="2025">2025</option>
              <option value="2026" selected>2026</option>
              <option value="2027">2027</option>
            </select>

            <!-- Tombol Tampilkan Semua -->
            <button onclick="filterByDate('all', null)" class="bg-brand-800 text-white text-xs font-semibold px-3 py-2 rounded-xl hover:bg-brand-900 transition-colors shrink-0">
              Semua Sesi
            </button>
          </div>
        </div>

        <!-- Header Hari Kalender Kotak (Min-Sab) -->
        <div class="grid grid-cols-7 text-center font-semibold text-xs text-brand-600 pt-1">
          <div class="text-rose-600">Ming</div>
          <div>Sen</div>
          <div>Sel</div>
          <div>Rab</div>
          <div>Kam</div>
          <div>Jum</div>
          <div>Sab</div>
        </div>

        <!-- Grid Angka Tanggal Kalender Kotak (7 Kolom) -->
        <div id="calendar-grid" class="grid grid-cols-7 gap-1.5 sm:gap-2">
          <!-- Diisi otomatis oleh JavaScript -->
        </div>

        <!-- Keterangan Legenda Indikator -->
        <div class="flex items-center gap-4 text-xs text-brand-600 pt-2 border-t border-brand-50">
          <div class="flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-amber-500 inline-block"></span>
            <span>Ada Sesi Jurnal</span>
          </div>
          <div class="flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-brand-800 inline-block"></span>
            <span>Tanggal Terpilih</span>
          </div>
        </div>

      </section>

      <!-- Section Title -->
      <div class="flex items-center justify-between">
        <h2 class="font-poppins font-bold text-sm sm:text-base tracking-wider uppercase text-brand-600" id="selected-date-label">
          Sesi Mengajar
        </h2>
        <span id="session-count-badge" class="text-xs font-semibold text-brand-700 bg-white border border-brand-100 px-3 py-1 rounded-full shadow-xs">
          0 Sesi Tersimpan
        </span>
      </div>

      @php
      $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
      $tglIndo = fn ($t) => $t->format('j').' '.$bulan[$t->month - 1].' '.$t->format('Y');
      @endphp

      <!-- Container Card Jurnal -->
      <div id="jurnal-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 w-full">

        @foreach ($semuaJurnal as $j)
        @php
        $jadwal = $j->jadwal;
        $jam = $jadwal->jamPelajaran;
        $guruHadir = $j->status_kehadiran_guru === 'hadir';
        $ket = trim((string) $j->keterangan);
        @endphp

        <div class="jurnal-card bg-white border border-brand-100 rounded-2xl p-5 shadow-xs hover:shadow-md transition-shadow flex flex-col justify-between gap-4" data-date="{{ $j->tanggal->format('Y-m-d') }}">
          <div class="flex flex-col gap-3">
            <div class="flex justify-between items-start gap-2">
              <div class="flex flex-col gap-0.5">
                <h3 class="font-poppins font-bold text-base sm:text-lg text-[#3E3028]">{{ $jadwal->mapel->nama_mapel ?? '-' }}</h3>
                <span class="text-xs sm:text-sm font-medium text-brand-600">
                  {{ $jadwal->kelas->nama_kelas ?? '-' }} • {{ $tglIndo($j->tanggal) }}@if ($jam) (Jam ke-{{ $jam->jam_ke }})@endif
                </span>
              </div>

              @if (! $guruHadir)
              <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-md font-semibold text-xs shrink-0">
                Guru {{ ucfirst($j->status_kehadiran_guru) }}
              </span>
              @elseif ($j->status_verifikasi === 'terverifikasi')
              <span class="px-2.5 py-1 bg-[#E8F5E9] text-[#2E7D32] rounded-md font-semibold text-xs shrink-0">
                Terverifikasi
              </span>
              @else
              <span class="px-2.5 py-1 bg-amber-50 text-amber-800 rounded-md font-semibold text-xs shrink-0">
                Belum Diverifikasi
              </span>
              @endif
            </div>

            <div class="w-full h-px bg-brand-50"></div>

            <div class="flex flex-col gap-1.5 text-xs sm:text-sm text-brand-600">
              <p><strong class="font-semibold text-[#3E3028]">Materi:</strong> {{ $j->materi ?: '-' }}</p>
              @if ($guruHadir)
              <p>
                <strong class="font-semibold text-[#3E3028]">Kehadiran:</strong>
                {{ $j->jumlah_hadir ?? '-' }} Hadir
                @if ($jam)
                • <span class="text-brand-700 font-medium">{{ substr($jam->jam_mulai, 0, 5) }} – {{ substr($jam->jam_selesai, 0, 5) }}</span>
                @endif
              </p>
              @endif
            </div>

            @if ($ket !== '')
            <div class="bg-amber-50/60 border border-amber-200/60 rounded-xl p-3 flex flex-col gap-1.5 mt-1">
              <div class="flex items-center gap-1.5 text-amber-900 font-semibold text-xs">
                <svg class="w-4 h-4 text-amber-700 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <span>Keterangan:</span>
              </div>
              <p class="text-xs text-amber-900/90 whitespace-pre-line">{{ $ket }}</p>
            </div>
            @else
            <div class="bg-brand-50 border border-brand-100/80 rounded-xl p-3 flex items-center gap-2 mt-1">
              <span class="text-xs text-brand-700 font-medium">Nihil / Seluruh siswa hadir</span>
            </div>
            @endif
          </div>

          <div class="flex justify-end pt-2 border-t border-brand-50">
            <a href="{{ route('jurnal.detail', $j->id_jurnal) }}" class="w-full sm:w-auto text-center px-4 py-2 bg-brand-800 hover:bg-brand-900 text-white font-poppins font-semibold text-xs rounded-lg shadow-xs transition-colors">
              Lihat Detail
            </a>
          </div>
        </div>
        @endforeach

      </div>

      <!-- EMPTY STATE -->
      <div id="empty-state" class="hidden bg-white border border-brand-100 rounded-2xl p-10 flex flex-col items-center justify-center text-center gap-3">
        <div class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center text-brand-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h3 class="font-poppins font-bold text-base text-[#3E3028]">Tidak Ada Sesi Mengajar</h3>
        <p class="text-xs text-brand-600 max-w-sm">Belum ada catatan jurnal mengajar yang diisi atau tersimpan untuk tanggal yang Anda pilih.</p>
      </div>

    </main>

  </div>

  <!-- Bottom Navigation Bar (Mobile) -->
  <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ url('/dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
        </svg>
        <span>Beranda</span>
      </a>

      <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
          <path d="M7 3v14" />
        </svg>
        <span>Isi Jurnal</span>
      </a>

      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6" />
        </svg>
        <span>Riwayat</span>
      </a>

      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17" />
          <circle cx="10" cy="6.5" r="3.5" />
        </svg>
        <span>Profil</span>
      </a>
    </div>
  </nav>

  <!-- SCRIPT GENERATOR KALENDER GRID KOTAK DENGAN INDIKATOR -->
  <script>
    const monthsName = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    const today = new Date();
    let selectedDateString = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

    // Inisialisasi kalender saat dokumen siap
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('month-select').value = today.getMonth() + 1; // getMonth() itu 0-indexed
      document.getElementById('year-select').value = today.getFullYear();
      generateGridCalendar(today.getDate());
    });

    function generateGridCalendar(targetDay = 21) {
      const month = parseInt(document.getElementById('month-select').value);
      const year = parseInt(document.getElementById('year-select').value);

      const gridContainer = document.getElementById('calendar-grid');
      gridContainer.innerHTML = '';

      // Hari pertama dalam bulan ini (0 = Minggu, 1 = Senin, dst.)
      const firstDayIndex = new Date(year, month - 1, 1).getDay();

      // Total jumlah hari dalam bulan terpilih (28, 29, 30, atau 31)
      const totalDays = new Date(year, month, 0).getDate();

      // Kumpulkan daftar tanggal yang memiliki data jurnal dari DOM
      const existingDates = new Set();
      document.querySelectorAll('.jurnal-card').forEach(card => {
        existingDates.add(card.getAttribute('data-date'));
      });

      // 1. Tambahkan kotak kosong (padding) untuk hari sebelum tanggal 1
      for (let i = 0; i < firstDayIndex; i++) {
        const emptyCell = document.createElement('div');
        emptyCell.className = 'h-10 sm:h-12 rounded-xl bg-transparent';
        gridContainer.appendChild(emptyCell);
      }

      let activeBtn = null;

      // 2. Buat Kotak Angka Tanggal (1 sampai totalDays)
      for (let day = 1; day <= totalDays; day++) {
        const formattedMonth = String(month).padStart(2, '0');
        const formattedDay = String(day).padStart(2, '0');
        const dateStr = `${year}-${formattedMonth}-${formattedDay}`;

        const isSelected = (day === targetDay);
        const hasSession = existingDates.has(dateStr);

        const dayBtn = document.createElement('button');
        dayBtn.className = `calendar-cell relative flex flex-col items-center justify-center h-10 sm:h-12 rounded-xl text-xs sm:text-sm font-poppins font-bold transition-all ${
          isSelected 
            ? 'bg-brand-800 text-white shadow-md' 
            : 'bg-brand-50/70 text-[#3E3028] hover:bg-brand-100/70 border border-brand-100'
        }`;

        dayBtn.onclick = () => filterByDate(dateStr, dayBtn);

        // Render Angka Tanggal
        let innerHTML = `<span>${day}</span>`;

        // Tambahkan Indikator Titik jika tanggal tersebut memiliki catatan jurnal
        if (hasSession) {
          innerHTML += `<span class="w-1.5 h-1.5 rounded-full ${isSelected ? 'bg-amber-300' : 'bg-amber-500'} absolute bottom-1.5"></span>`;
        }

        dayBtn.innerHTML = innerHTML;
        gridContainer.appendChild(dayBtn);

        if (isSelected) {
          activeBtn = dayBtn;
          selectedDateString = dateStr;
        }
      }

      // Terapkan filter awal
      filterByDate(selectedDateString, activeBtn);
    }

    function filterByDate(selectedDate, element) {
      // Reset styling tombol kotak kalender
      document.querySelectorAll('.calendar-cell').forEach(cell => {
        cell.classList.remove('bg-brand-800', 'text-white', 'shadow-md');
        cell.classList.add('bg-brand-50/70', 'text-[#3E3028]', 'border', 'border-brand-100');

        // Sesuaikan warna titik indikator
        const dot = cell.querySelector('.rounded-full');
        if (dot) {
          dot.classList.remove('bg-amber-300');
          dot.classList.add('bg-amber-500');
        }
      });

      // Beri warna aktif jika kotak tertentu diklik
      if (element) {
        element.classList.remove('bg-brand-50/70', 'text-[#3E3028]', 'border', 'border-brand-100');
        element.classList.add('bg-brand-800', 'text-white', 'shadow-md');

        const dot = element.querySelector('.rounded-full');
        if (dot) {
          dot.classList.remove('bg-amber-500');
          dot.classList.add('bg-amber-300');
        }
      }

      // Filter kartu riwayat jurnal
      const journalCards = document.querySelectorAll('.jurnal-card');
      let visibleCount = 0;

      journalCards.forEach(card => {
        const cardDate = card.getAttribute('data-date');
        if (selectedDate === 'all' || cardDate === selectedDate) {
          card.classList.remove('hidden');
          visibleCount++;
        } else {
          card.classList.add('hidden');
        }
      });

      // Update badge & header
      const badge = document.getElementById('session-count-badge');
      const label = document.getElementById('selected-date-label');
      const emptyState = document.getElementById('empty-state');

      badge.innerText = `${visibleCount} Sesi Tersimpan`;

      if (selectedDate === 'all') {
        label.innerText = 'Semua Sesi Mengajar';
      } else {
        label.innerText = `Sesi Mengajar — ${formatDateString(selectedDate)}`;
      }

      // Tampilkan Empty State bila tidak ada jurnal pada tanggal tersebut
      if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
      } else {
        emptyState.classList.add('hidden');
      }
    }

    function formatDateString(dateStr) {
      const parts = dateStr.split('-');
      if (parts.length !== 3) return dateStr;
      const day = parseInt(parts[2], 10);
      const monthIndex = parseInt(parts[1], 10) - 1;
      const year = parts[0];
      return `${day} ${monthsName[monthIndex]} ${year}`;
    }
  </script>

</body>

</html>
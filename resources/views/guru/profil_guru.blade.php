<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Saya - Guru</title>

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
            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
          </svg>
          <span>Beranda</span>
        </a>

        <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
            <path d="M7 3v14" />
          </svg>
          <span>isi Jurnal</span>
        </a>

        <!-- Menu Riwayat Jurnal -->
        <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 4h14M3 8h14M3 12h10M3 16h6" />
          </svg>
          <span>Riwayat Jurnal</span>
        </a>

        <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-md text-[#7A6A60] hover:bg-[#F5EFE8] hover:text-[#5C4033] transition-all">
          <svg class="h-5 w-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span>
        </a>

        <!-- Active Link (Profil Guru) -->
        <a href="{{ url('/profil-guru') }}" class="flex items-center gap-3 px-3 py-2.5 bg-[#F5EFE8] rounded-lg font-poppins font-bold text-md text-[#5C4033] transition-all">
          <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17" />
            <circle cx="10" cy="6.5" r="3.5" />
          </svg>
          <span>Profil</span>
        </a>

      </nav>

    </div>
  </aside>

  <!-- MAIN CONTENT AREA -->
  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8">

    <!-- Top Header Bar -->
    <header class="w-full bg-[#5C4033] shadow-md sticky top-0 z-30 px-4 py-5 sm:px-6 sm:py-6 md:px-7 md:py-7 flex items-center justify-between">
      <div class="max-w-4xl w-full mx-auto flex items-center justify-between">
        <div class="w-9"></div>
        <h1 class="font-poppins font-bold text-base sm:text-lg text-white">Profil Saya</h1>
        <div class="w-9"></div>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="w-full px-4 sm:px-6 md:px-8 lg:px-10 py-8 flex-1 flex flex-col gap-6">

      @if (session('success'))
        <div class="w-full rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
          {{ $errors->first() }}
        </div>
      @endif

      <!-- Card Gabungan: Data Guru + Butuh Bantuan -->
      <div class="w-full bg-white border border-brand-100 rounded-2xl p-5 sm:p-6 shadow-xs flex flex-col gap-5">

        <!-- Bagian Data Guru -->
        <div class="flex flex-col gap-1 items-center text-center pb-4 border-b border-brand-100">
          <h2 class="font-poppins font-bold text-xl sm:text-2xl text-[#3E3028]">{{ $user->name }}</h2>
        </div>

        <div class="flex flex-col divide-y divide-brand-100/80 text-sm">
          <div class="flex flex-wrap justify-between items-center gap-2 py-4 pt-0">
            <span class="text-brand-600 font-medium">Mengampu Mata Pelajaran</span>
            <span class="font-bold text-[#3E3028]">{{ $mapel->isNotEmpty() ? $mapel->implode(', ') : 'Belum ada jadwal mengajar' }}</span>
          </div>
          <div class="flex flex-wrap justify-between items-center gap-2 py-4">
            <span class="text-brand-600 font-medium">No. HP</span>
            <span class="font-bold text-[#3E3028]">{{ $user->no_telepon ?: 'Belum diatur' }}</span>
          </div>
        </div>

        <!-- Bagian Butuh Bantuan (box tersendiri di dalam card) -->
        <div class="border border-brand-100 rounded-xl p-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h3 class="font-poppins font-bold text-sm sm:text-base text-[#3E3028]">Butuh bantuan?</h3>
            <p class="mt-0.5 text-xs sm:text-sm text-brand-600">Hubungi admin jika ada kendala.</p>
          </div>
          <button type="button" onclick="hubungiAdmin()" class="inline-flex w-full sm:w-auto shrink-0 items-center justify-center rounded-lg bg-brand-50 border border-brand-100 px-5 py-2.5 text-sm font-semibold text-[#5C4033] hover:bg-brand-100 transition">Hubungi</button>
        </div>

      </div>

      <!-- Action Button Group -->
      <div class="w-full flex flex-col gap-3">
        <!-- Edit Profil Button -->
        <button type="button" onclick="openEditModal()" class="w-full h-12 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all">
          Edit Profil
        </button>

        <!-- Logout Button (Memicu Modal Pop-up) -->
        <button type="button" onclick="openLogoutModal()" class="w-full h-12 bg-red-600 hover:bg-red-700 text-white font-poppins font-semibold text-sm rounded-xl flex items-center justify-center shadow-md active:scale-[0.99] transition-all gap-2">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
          <span>Log Out</span>
        </button>

        <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
          @csrf
        </form>
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
        <span>isi Jurnal</span>
      </a>

      <!-- Mobile Link Riwayat Jurnal -->
      <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M3 4h14M3 8h14M3 12h10M3 16h6" />
        </svg>
        <span>Riwayat</span>
      </a>

      <a @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif @if(!auth()->user()->sedangPiket()) style="pointer-events:none;opacity:.5;cursor:not-allowed" @endif class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></a>

      <!-- Active Mobile Link (Profil Guru) -->
      <a href="{{ url('/profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17" />
          <circle cx="10" cy="6.5" r="3.5" />
        </svg>
        <span>Profil</span>
      </a>

    </div>
  </nav>

  <!-- MODAL EDIT PROFIL -->
  <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-xl transform scale-95 transition-transform duration-200">
      <div class="flex items-center justify-between gap-4 border-b border-brand-100 pb-4">
        <div>
          <h3 class="font-poppins font-bold text-lg text-[#3E3028]">Edit Profil</h3>
          <p class="text-xs text-brand-600 mt-1">Perbarui data akun guru.</p>
        </div>
        <button type="button" onclick="closeEditModal()" class="text-brand-600 hover:text-brand-800" aria-label="Tutup edit profil">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>

      <form action="{{ url('/profil-guru') }}" method="POST" class="flex flex-col gap-4 pt-5">
        @csrf
        <div class="flex flex-col gap-1.5">
          <label for="name" class="text-xs font-semibold text-brand-600">Nama Lengkap</label>
          <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors">
        </div>

        <div class="flex flex-col gap-1.5">
          <label for="no_telepon" class="text-xs font-semibold text-brand-600">No. HP</label>
          <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" class="w-full h-11 px-3.5 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors">
        </div>

        <div class="flex flex-col gap-1.5">
          <label for="mapel" class="text-xs font-semibold text-brand-600">Mata Pelajaran dari Jadwal Admin</label>
          <input type="text" id="mapel" value="{{ $mapel->isNotEmpty() ? $mapel->implode(', ') : 'Belum ada jadwal mengajar' }}" readonly class="w-full h-11 px-3.5 bg-brand-50 border border-brand-100 rounded-xl text-sm text-[#3E3028]">
        </div>

        <div class="flex flex-col gap-1.5">
          <label for="password_lama" class="text-xs font-semibold text-brand-600">Password Lama</label>
          <div class="relative">
            <input type="password" id="password_lama" name="password_lama" placeholder="Masukkan password lama jika mengganti password" class="w-full h-11 px-3.5 pr-11 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors">
            <button type="button" onclick="togglePassword('password_lama', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-600 hover:text-brand-800" aria-label="Tampilkan password lama">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        <div class="flex flex-col gap-1.5">
          <label for="password_baru" class="text-xs font-semibold text-brand-600">Password Baru</label>
          <div class="relative">
            <input type="password" id="password_baru" name="password_baru" minlength="8" placeholder="Kosongkan jika tidak ingin mengubah" class="w-full h-11 px-3.5 pr-11 bg-white border border-brand-100 rounded-xl text-sm text-[#3E3028] focus:outline-none focus:border-brand-800 transition-colors">
            <button type="button" onclick="togglePassword('password_baru', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-600 hover:text-brand-800" aria-label="Tampilkan password baru">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 border-t border-brand-100 pt-5">
          <button type="button" onclick="closeEditModal()" class="w-full sm:w-36 h-11 bg-white border border-[#5C4033] text-[#5C4033] hover:bg-brand-50 font-poppins font-semibold text-sm rounded-xl">Batal</button>
          <button type="submit" class="w-full sm:w-44 h-11 bg-[#5C4033] hover:bg-[#3E2B22] text-white font-poppins font-semibold text-sm rounded-xl shadow-md">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL KONFIRMASI LOGOUT -->
  <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-200">
    <!-- Card Modal -->
    <div class="bg-white w-full max-w-sm rounded-2xl p-6 shadow-xl transform scale-95 transition-transform duration-200 flex flex-col items-center text-center gap-4">

      <!-- Icon Peringatan -->
      <div class="w-14 h-14 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
          <line x1="12" y1="9" x2="12" y2="13" />
          <line x1="12" y1="17" x2="12.01" y2="17" />
        </svg>
      </div>

      <!-- Teks Konfirmasi -->
      <div class="flex flex-col gap-1">
        <h3 class="font-poppins font-bold text-lg text-[#3E3028]">Konfirmasi Log Out</h3>
        <p class="text-xs sm:text-sm text-brand-600">Apakah Anda yakin ingin keluar dari akun ini?</p>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex gap-3 w-full mt-2">
        <button type="button" onclick="closeLogoutModal()" class="flex-1 h-11 bg-brand-50 hover:bg-brand-100 text-brand-800 font-poppins font-semibold text-sm rounded-xl transition-all">
          Batal
        </button>
        <button type="button" onclick="confirmLogout()" class="flex-1 h-11 bg-red-600 hover:bg-red-700 text-white font-poppins font-semibold text-sm rounded-xl transition-all shadow-md">
          Ya, Log Out
        </button>
      </div>

    </div>
  </div>

  <!-- JAVASCRIPT UNTUK MODAL -->
  <script>
    const editModal = document.getElementById('editModal');
    const editModalCard = editModal.querySelector('div');
    const modal = document.getElementById('logoutModal');
    const modalCard = modal.querySelector('div');

    function openEditModal() {
      editModal.classList.remove('opacity-0', 'pointer-events-none');
      editModalCard.classList.remove('scale-95');
      editModalCard.classList.add('scale-100');
    }

    function closeEditModal() {
      editModal.classList.add('opacity-0', 'pointer-events-none');
      editModalCard.classList.remove('scale-100');
      editModalCard.classList.add('scale-95');
    }

    function openLogoutModal() {
      modal.classList.remove('opacity-0', 'pointer-events-none');
      modalCard.classList.remove('scale-95');
      modalCard.classList.add('scale-100');
    }

    function closeLogoutModal() {
      modal.classList.add('opacity-0', 'pointer-events-none');
      modalCard.classList.remove('scale-100');
      modalCard.classList.add('scale-95');
    }

    function confirmLogout() {
      document.getElementById('logoutForm').submit();
    }

    function hubungiAdmin() {
      let nomorAdmin = String(@json($adminPhone ?? '')).replace(/\D/g, '');
      if (!nomorAdmin) { alert('Nomor telepon admin belum diatur.'); return; }
      if (nomorAdmin.startsWith('0')) nomorAdmin = `62${nomorAdmin.slice(1)}`;
      else if (!nomorAdmin.startsWith('62')) nomorAdmin = `62${nomorAdmin}`;
      const pesan = `Hallo Admin\nSaya: ${@json($user->name)}\nKendala:`;
      const url = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(pesan)}`;
      window.open(url, '_blank');
    }

    function togglePassword(inputId, button) {
      const input = document.getElementById(inputId);
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      button.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
    }

    // Menutup modal jika area backdrop di luar modal diklik
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeLogoutModal();
      }
    });

    editModal.addEventListener('click', function(e) {
      if (e.target === editModal) {
        closeEditModal();
      }
    });
  </script>

</body>
</html>

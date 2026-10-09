<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Jurnal Mengajar - Piket</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet">

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
    html, body, dialog { scrollbar-width: none; }
    html::-webkit-scrollbar, body::-webkit-scrollbar, dialog::-webkit-scrollbar { display: none; }

    dialog::backdrop {
      background: rgba(62,43,34,0.35);
    }

    .kelas-card.is-hidden {
      display: none;
    }

    .guru-sidebar-nav a {
      gap: .75rem !important;
      padding: .625rem .75rem !important;
      border-radius: .5rem !important;
      font-size: 1rem !important;
      color: #7A6A60 !important;
    }

    .guru-sidebar-nav a svg {
      color: #7A6A60 !important;
    }

    .guru-sidebar-nav a.bg-\[\#F5EFE8\] {
      color: #5C4033 !important;
    }

    .guru-sidebar-nav a.bg-\[\#F5EFE8\] svg {
      color: #3E3028 !important;
    }

    .guru-sidebar > div:first-child {
      padding: 1.5rem 1rem !important;
      gap: 2rem !important;
    }
  </style>
</head>

<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">




  <!-- ========================================================= -->
  <!-- SIDEBAR -->
  <!-- ========================================================= -->

  <aside
    class="guru-sidebar w-64 bg-white border-r border-[#E5D8CC]
           min-h-screen flex flex-col justify-between shrink-0
           fixed left-0 top-0 bottom-0 z-40 hidden md:flex">

    <div class="py-6 px-4 flex flex-col gap-8">

      <!-- BRAND -->
      <div class="flex flex-col gap-0.5">

        <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">
          JURNAL GURU
        </h2>

        <span class="text-md font-medium text-[#7A6A60]">
          Akun Guru
        </span>

      </div>


      <!-- NAVIGATION -->
      <nav class="guru-sidebar-nav flex flex-col gap-1">

        <!-- BERANDA -->
        <a
          href="{{ url('/dashboard-guru') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>

          </svg>

          <span>Beranda</span>

        </a>


        <!-- ISI JURNAL -->
        <a
          href="{{ route('jurnal.create') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
            <path d="M7 3v14"/>

          </svg>

          <span>Isi Jurnal</span>

        </a>


        <!-- RIWAYAT JURNAL -->
        <a
          href="{{ url('/riwayat-jurnal') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>

          </svg>

          <span>Riwayat Jurnal</span>

        </a>


        <!-- PIKET - AKTIF -->
        <a
          @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
          class="flex items-center gap-3 px-3 py-2.5
                 bg-[#F5EFE8] rounded-lg
                 font-poppins font-bold text-md text-[#5C4033]
                 transition-all">

          <svg
            class="h-5 w-5 text-[#3E3028]"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
            <path d="M7 10l2 2 4-4"/>

          </svg>

          <span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span>

        </a>


        <!-- PROFIL -->
        <a
          href="{{ url('/profil-guru') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg
                 font-medium text-md text-[#7A6A60]
                 hover:bg-[#F5EFE8] hover:text-[#5C4033]
                 transition-all">

          <svg
            class="w-5 h-5 text-brand-600"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8">

            <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
            <circle cx="10" cy="6.5" r="3.5"/>

          </svg>

          <span>Profil</span>

        </a>

      </nav>

    </div>

  </aside>


  <!-- ========================================================= -->
  <!-- MAIN CONTENT -->
  <!-- ========================================================= -->

  <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">


    <!-- HEADER -->

    <header
      class="sticky top-0 z-30 w-full bg-[#5C4033] shadow-md
             px-6 md:px-10 py-6
             flex flex-col md:flex-row
             justify-between items-start md:items-center
             gap-3">

      <div class="flex flex-col gap-1">

        <a
          @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
          class="text-xs font-semibold text-[#D7B899]
                 hover:text-white flex items-center gap-1 mb-1">

          <svg
            class="w-3.5 h-3.5"
            viewBox="0 0 20 20"
            fill="none"
            stroke="currentColor"
            stroke-width="2">

            <path d="M12 15l-5-5 5-5"/>

          </svg>

          Kembali ke Piket

        </a>

        <h1
          class="font-poppins text-2xl sm:text-3xl
                 font-bold text-white tracking-tight">

          Jurnal Mengajar

        </h1>
        
      </div>

    </header>

    @if($isPiketHariIni)
      <div class="sticky top-[104px] z-30 w-full border-b border-brand-100 bg-[#F5EFE8] px-6 py-3 md:top-[112px] md:px-10">
        <label for="cariJurnalPiket" class="sr-only">Cari kelas, jurnal, atau tugas</label>
        <input id="cariJurnalPiket" type="search" placeholder="Cari kelas, guru, mata pelajaran, materi, atau tugas..." class="h-11 w-full rounded-xl border border-brand-100 bg-white px-4 text-sm text-[#3E3028] shadow-sm outline-none placeholder:text-[#A08978] focus:border-brand-800 focus:ring-2 focus:ring-brand-100">
      </div>
    @endif


    <!-- MAIN -->

    <main
      class="w-full px-4 sm:px-6 md:px-10 py-5 sm:py-8
             flex flex-col gap-6 flex-1">

      @if(!$isPiketHariIni)

        <div
          class="bg-white border border-rose-200 rounded-2xl
                 p-8 flex flex-col items-center
                 text-center gap-3">

          <div
            class="w-12 h-12 rounded-full bg-rose-50
                   text-rose-600 flex items-center justify-center">

            <svg
              class="w-6 h-6"
              viewBox="0 0 20 20"
              fill="none"
              stroke="currentColor"
              stroke-width="2">

              <circle cx="10" cy="10" r="7"/>
              <path d="M7 7l6 6M13 7l-6 6"/>

            </svg>

          </div>

          <h3 class="font-poppins font-bold text-lg">
            Akses Ditolak
          </h3>

          <p class="text-sm text-[#8C7B70] max-w-sm">
            Halaman ini hanya bisa diakses oleh guru yang sedang bertugas piket hari ini.
          </p>

        </div>

      @else

        <!-- FILTER TINGKAT KELAS -->

        <div
          id="filterBar"
          class="-mx-4 mb-4 grid grid-cols-3 gap-2 border-b border-brand-100 bg-brand-50/95 px-4 py-3 sm:-mx-6 sm:px-6 md:-mx-10 md:px-10">

          @foreach(['X', 'XI', 'XII'] as $t)

            <button
              type="button"
              data-tingkat="{{ $t }}"
              onclick="filterTingkat('{{ $t }}')"
              class="filter-btn min-w-0 rounded-full px-2 py-2 text-xs sm:px-3 sm:text-sm font-semibold {{ $t === ($daftarTingkat[0] ?? 'X') ? 'bg-brand-800 text-white' : 'bg-white border border-brand-100 text-[#7A6A60]' }}">

              Kelas {{ $t }}

            </button>

          @endforeach

        </div>

        @php
          $pengirimanPerNamaKelas = $pengirimanKelas->keyBy(fn ($kiriman) => $kiriman->kelas?->nama_kelas);
          $jurnalPerKelas = collect($daftarJurnal)->groupBy('kelas')->map(function ($items) use ($pengirimanPerNamaKelas) {
            $utama = $items->first();
            $utama['ids'] = $items->pluck('id')->all();
            $utama['sesi'] = $items->flatMap(fn ($item) => $item['sesi'])->values()->all();
            $utama['waktu_kirim'] = $items->pluck('waktu_kirim')->filter()->unique()->implode(', ');
            $utama['status'] = $items->contains(fn ($item) => $item['status'] === 'terkirim') ? 'terkirim' : $utama['status'];
            $utama['kiriman_kelas'] = $pengirimanPerNamaKelas->get($utama['kelas']);
            return $utama;
          })->values();
        @endphp

        <div id="panelKelas" class="w-full min-w-0">
        <div class="flex w-full min-w-0 flex-col gap-3 sm:gap-4" id="daftarKelas">
          @foreach($jurnalPerKelas as $j)
            @php
              $badge = match ($j['status']) {
                'tidak_hadir' => ['bg-rose-50 border-rose-200 text-rose-800', 'Guru Tidak Hadir'],
                'terkirim' => ['bg-sky-50 border-sky-200 text-sky-800', 'Terkirim'],
                default => ['bg-emerald-50 border-emerald-200 text-emerald-800', 'Terverifikasi'],
              };
            @endphp


            <article
              class="kelas-card bg-white border border-brand-100
                     rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4"
              data-tingkat="{{ $j['tingkat'] }}"
              data-status="{{ $j['status'] }}"
              data-id="{{ implode(',', $j['ids']) }}">

                  <div
                    class="flex min-w-0 items-center gap-3 sm:w-44 shrink-0">

                    <div
                      class="w-11 h-11 rounded-xl
                             bg-brand-50 border border-brand-100
                             flex items-center justify-center
                             font-poppins font-bold
                             text-brand-800 text-xs shrink-0">

                      {{ $j['tingkat'] }}

                    </div>

                    <div class="flex min-w-0 flex-col">

                      <h4
                        class="break-words font-poppins font-bold text-base
                               text-[#3E3028] leading-tight">

                        {{ $j['kelas'] }}

                      </h4>

                      <span class="break-words text-xs text-[#8C7B70]">
                        {{ count($j['sesi']) }} sesi • kirim {{ $j['waktu_kirim'] }}
                      </span>
                      @if($j['kiriman_kelas'])
                        <span class="mt-1 text-xs font-semibold text-brand-600">Rekap kelas terkirim {{ $j['kiriman_kelas']->dikirim_at?->format('H:i') ?? '—' }}</span>
                      @endif

                    </div>

                  </div>


                  <div class="flex-1"></div>


                  <div class="flex items-center gap-2 flex-wrap sm:ml-auto">

                    <span
                      class="px-2.5 py-1 rounded-full
                             text-xs font-semibold border
                             {{ $badge[0] }}
                             whitespace-nowrap">

                      {{ $badge[1] }}

                    </span>

                  </div>


                <button type="button" onclick="bukaDetailJurnal(@js($j))" class="w-full shrink-0 rounded-lg bg-brand-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-900 sm:w-auto">Lihat detail</button>

            </article>


          @endforeach

        </div>

        <div
          id="kosongMenunggu"
          class="hidden mt-3 w-full rounded-2xl border border-brand-200 bg-white px-5 py-8 text-center text-sm text-[#8C7B70] sm:px-8">

          <p id="pesanKosongJurnal" class="font-semibold text-brand-800">Belum ada jurnal untuk ditampilkan.</p>
          <p id="bantuanKosongJurnal" class="mx-auto mt-1 max-w-md text-xs leading-5">Jurnal dari kelas akan muncul di sini setelah dikirim.</p>

        </div>
        </div>

      @endif

    </main>

  </div>

  <dialog id="dialogDetailJurnal" class="w-[calc(100%-1.5rem)] max-w-2xl max-h-[85vh] overflow-y-auto rounded-2xl border border-brand-100 p-0 shadow-xl">
    <div class="sticky top-0 z-10 flex items-center justify-between gap-3 border-b border-brand-100 bg-white px-4 py-4 sm:px-6">
      <div><p class="text-xs font-semibold uppercase tracking-wide text-brand-600">Detail jurnal kelas</p><h2 id="judulDetailJurnal" class="mt-1 font-poppins text-lg font-bold"></h2></div>
      <button type="button" onclick="tutupDialog('dialogDetailJurnal')" class="rounded-lg border border-brand-100 px-3 py-2 text-sm font-semibold">Tutup</button>
    </div>
    <div id="isiDetailJurnal" class="space-y-3 p-4 sm:p-6"></div>
  </dialog>

  <!-- ========================================================= -->
  <!-- BOTTOM NAV MOBILE -->
  <!-- ========================================================= -->

  <nav
    class="md:hidden fixed bottom-0 left-0 right-0
           bg-white border-t border-brand-100
           py-3.5 px-6 z-50
           shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">

    <div class="flex justify-between items-center">

      <a
        href="{{ url('/dashboard-guru') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>

        </svg>

        <span>Beranda</span>

      </a>


      <a
        href="{{ route('jurnal.create') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/>
          <path d="M7 3v14"/>

        </svg>

        <span>Isi Jurnal</span>

      </a>


      <a
        href="{{ url('/riwayat-jurnal') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M3 4h14M3 8h14M3 12h10M3 16h6"/>

        </svg>

        <span>Riwayat</span>

      </a>


      <a
        @if(auth()->user()->sedangPiket()) href="{{ route('dashboard-guru-piket') }}" @else aria-disabled="true" tabindex="-1" title="Menu tersedia saat jadwal piket Anda aktif" @endif style="@if(!auth()->user()->sedangPiket())pointer-events:none;opacity:.5;cursor:not-allowed @endif"
        class="flex flex-col items-center gap-1
               text-xs font-bold text-brand-800">

        <svg
          class="h-5 w-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="2.2">

          <path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/>
          <path d="M7 10l2 2 4-4"/>

        </svg>

        <span>{{ auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket() ? 'Rekap Piket' : 'Piket' }}</span>

      </a>


      <a
        href="{{ url('/profil-guru') }}"
        class="flex flex-col items-center gap-1
               text-xs font-medium text-[#9E8E83]">

        <svg
          class="w-5 h-5"
          viewBox="0 0 20 20"
          fill="none"
          stroke="currentColor"
          stroke-width="1.8">

          <path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/>
          <circle cx="10" cy="6.5" r="3.5"/>

        </svg>

        <span>Profil</span>

      </a>

    </div>

  </nav>


  <script>

    let tingkatAktif = 'X';



    function filterTingkat(t) {

      tingkatAktif = t;

      document.querySelectorAll('.filter-btn').forEach(btn => {

        const active = btn.dataset.tingkat === t;

        btn.className =
          'filter-btn rounded-full px-3 py-2 text-xs sm:text-sm font-semibold ' +
          (
            active
              ? 'bg-brand-800 text-white'
              : 'bg-white border border-brand-100 text-[#7A6A60]'
          );

      });

      terapkanFilter();

    }

    function terapkanFilter() {

      let terlihat = 0;

      document.querySelectorAll('.kelas-card').forEach(card => {

        const sedangMencari = Boolean(document.getElementById('cariJurnalPiket')?.value.trim());
        const cocok = (sedangMencari || card.dataset.tingkat === tingkatAktif) && cocokPencarian(card);

        card.classList.toggle(
          'is-hidden',
          !cocok
        );

        if (cocok) {
          terlihat++;
        }

      });

      const kosong = document.getElementById('kosongMenunggu');
      const mencari = Boolean(document.getElementById('cariJurnalPiket')?.value.trim());
      kosong.classList.toggle('hidden', terlihat > 0);
      document.getElementById('pesanKosongJurnal').textContent = mencari ? 'Tidak ada jurnal yang cocok dengan pencarian.' : 'Belum ada jurnal untuk ditampilkan.';
      document.getElementById('bantuanKosongJurnal').textContent = mencari
        ? 'Coba ubah kata kunci pencarian.'
        : 'Jurnal dari kelas akan muncul di sini setelah dikirim. Pilih tingkat kelas lain untuk melihat jurnal lainnya.';

    }

    function cocokPencarian(elemen) {
      const query = document.getElementById('cariJurnalPiket')?.value.trim().toLocaleLowerCase() || '';
      return !query || elemen.textContent.toLocaleLowerCase().includes(query);
    }

    document.getElementById('cariJurnalPiket')?.addEventListener('input', terapkanFilter);


    const dataJurnal = @js($jurnalPerKelas->keyBy('kelas')->map(function ($jurnal) { $kiriman = $jurnal['kiriman_kelas']; $jurnal['ringkasan_kiriman'] = $kiriman ? ['waktu' => $kiriman->dikirim_at?->format('d/m/Y H:i') ?? '—', 'status' => 'Terkirim', 'jumlah_sesi' => $kiriman->jumlah_sesi, 'jumlah_lengkap' => $kiriman->jumlah_lengkap, 'jumlah_kurang' => $kiriman->jumlah_kurang, 'alasan' => null] : null; return $jurnal; }));


    function teks(value) {
      const el = document.createElement('span');
      el.textContent = value ?? '—';
      return el.innerHTML;
    }

    function tutupDialog(id) { document.getElementById(id).close(); }

    function bukaDetailJurnal(jurnal) {
      if (!jurnal) return;
      document.getElementById('judulDetailJurnal').textContent = `${jurnal.kelas} · Kelas ${jurnal.tingkat}`;
      const sesi = (jurnal.sesi || []).map(item => `
        <article class="rounded-xl border border-brand-100 bg-[#FFFCF9] p-4">
          <div class="flex flex-wrap items-start justify-between gap-2"><div><p class="text-xs text-brand-600">Jam ke-${teks(item.jam)} · ${teks(item.mapel)}</p><h3 class="mt-1 font-bold">${teks(item.guru)}</h3></div><span class="rounded-full px-2.5 py-1 text-xs font-semibold ${item.hadir_guru ? 'bg-emerald-50 text-emerald-800' : 'bg-rose-50 text-rose-800'}">${item.hadir_guru ? 'Guru hadir' : 'Guru tidak hadir'}</span></div>
          <dl class="mt-4 grid grid-cols-1 gap-3 text-sm sm:grid-cols-2"><div><dt class="text-xs text-brand-600">Jumlah hadir</dt><dd class="font-semibold">${teks(item.jumlah_hadir)}</dd></div><div class="sm:col-span-2"><dt class="text-xs text-brand-600">Materi</dt><dd class="break-words">${teks(item.materi)}</dd></div></dl>
          ${(item.siswa || []).length ? `<div class="mt-4"><h4 class="text-sm font-bold">Siswa tidak hadir (${item.siswa.length})</h4><ul class="mt-2 grid gap-2 sm:grid-cols-2">${item.siswa.map(s => `<li class="rounded-lg bg-white px-3 py-2 text-sm">${teks(s.nama)} <span class="ml-1 font-bold text-brand-600">${teks(s.ket)}</span></li>`).join('')}</ul></div>` : '<p class="mt-3 text-sm text-brand-600">Tidak ada catatan siswa tidak hadir.</p>'}
        </article>`).join('');
      const kiriman = jurnal.ringkasan_kiriman;
      const ringkasanKiriman = kiriman ? `<section class="rounded-xl border border-brand-100 bg-brand-50 p-4"><h3 class="font-bold">Rekap dari akun kelas</h3><dl class="mt-3 grid grid-cols-2 gap-3 text-sm"><div><dt class="text-xs text-brand-600">Dikirim</dt><dd>${teks(kiriman.waktu)}</dd></div><div><dt class="text-xs text-brand-600">Status</dt><dd>${teks(kiriman.status)}</dd></div><div><dt class="text-xs text-brand-600">Sesi tercatat</dt><dd>${teks(kiriman.jumlah_lengkap)} dari ${teks(kiriman.jumlah_sesi)}</dd></div><div><dt class="text-xs text-brand-600">Sesi belum tercatat</dt><dd>${teks(kiriman.jumlah_kurang)}</dd></div></dl>${kiriman.alasan ? `<p class="mt-3 text-sm text-rose-700">Catatan: ${teks(kiriman.alasan)}</p>` : ''}</section>` : '';
      document.getElementById('isiDetailJurnal').innerHTML = ringkasanKiriman + `<p class="mb-3 text-xs text-brand-600">Jurnal terakhir per sesi · dikirim pukul ${teks(jurnal.waktu_kirim)}</p>${sesi}`;
      document.getElementById('dialogDetailJurnal').showModal();
    }



    document.addEventListener('DOMContentLoaded', () => filterTingkat(tingkatAktif));

  </script>

</body>

</html>

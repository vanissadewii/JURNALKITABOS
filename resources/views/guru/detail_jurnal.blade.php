<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Sesi Mengajar</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif'],poppins:['Poppins','sans-serif']},colors:{brand:{50:'#F9F6F0',100:'#EFE6DD',200:'#E2C7B0',300:'#D7B899',600:'#7A6A60',800:'#5C4033',900:'#3E2B22'}}}}}</script>
  <style>
    @media print {
      body { background: #fff !important; color: #111 !important; }
      html, body { width: 100% !important; min-height: 0 !important; margin: 0 !important; padding: 0 !important; background: #fff !important; color: #111 !important; }
      body { display: block !important; }
      body > div { display: block !important; min-height: 0 !important; }
      body > div > aside, .no-print { display: none !important; }
      body > div > div { display: block !important; width: 100% !important; margin: 0 !important; padding: 0 !important; }
      #print-area { display: flex !important; position: static !important; width: 100% !important; max-width: none !important; padding: 0 !important; margin: 0 !important; gap: 8mm !important; }
      #print-area, #print-area * { visibility: visible !important; color: #111 !important; }
      #print-area .print-card { break-inside: avoid; box-shadow: none !important; border-color: #bbb !important; background: #fff !important; }
      #print-area table { width: 100% !important; border-collapse: collapse !important; }
      #print-area th, #print-area td { border: 1px solid #bbb !important; }
      #print-area tr { break-inside: avoid; }
      @page { size: A4; margin: 12mm; }
    }
  </style>
</head>
<body class="min-h-screen bg-brand-50 font-sans text-[#3E3028]">
  <div class="flex min-h-screen">
    @include('guru.partials.piket-sidebar')
    <div class="flex min-w-0 flex-1 flex-col pb-24 md:ml-64 md:pb-8">
      <header class="no-print sticky top-0 z-20 flex min-h-16 items-center gap-3 bg-[#5C4033] px-4 py-4 text-white shadow md:px-10">
        <a href="{{ route('riwayat-jurnal') }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10" aria-label="Kembali ke riwayat">‹</a>
        <h1 class="flex-1 font-poppins text-xl font-bold sm:text-2xl">Detail Sesi Mengajar</h1>
        <button type="button" onclick="window.print()" class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 hover:bg-white/20" title="Cetak isi jurnal" aria-label="Cetak"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v8H6z"/></svg></button>
      </header>

      <main id="print-area" class="mx-auto flex w-full max-w-6xl flex-col gap-5 px-4 py-5 sm:px-6 md:px-10 md:py-8">
        <section class="print-card rounded-2xl border border-green-200 bg-green-50 p-5 shadow-sm">
          <h2 class="font-poppins text-base font-bold text-green-900">{{ $jurnal->status_verifikasi === 'terverifikasi' ? 'Sesi Mengajar Terverifikasi' : 'Menunggu Verifikasi' }}</h2>
          <p class="mt-1 text-sm text-green-800">
            @if($pemindai)
              Dipindai oleh {{ $pemindai->name }}@if($qr?->dipindai_at) pada {{ $qr->dipindai_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }} WIB @endif
            @else
              Verifikasi QR kelas tercatat.
            @endif
          </p>
        </section>

        <section class="print-card rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-7">
          <div class="border-b border-brand-100 pb-4">
            <p class="text-xs font-semibold uppercase tracking-wider text-brand-600">{{ $jadwal->kelas->nama_kelas }}</p>
            <h2 class="mt-1 font-poppins text-xl font-extrabold sm:text-2xl">{{ $jadwal->mapel->nama_mapel }}</h2>
            <p class="mt-1 text-sm text-brand-600">{{ $jadwal->guru->name ?? auth()->user()->name }}</p>
          </div>
          <dl class="grid grid-cols-2 gap-4 py-5 text-sm sm:grid-cols-4">
            <div><dt class="text-brand-600">Tanggal</dt><dd class="mt-1 font-semibold">{{ $jurnal->tanggal->locale('id')->translatedFormat('d F Y') }}</dd></div>
            <div><dt class="text-brand-600">Jam pelajaran</dt><dd class="mt-1 font-semibold">{{ $jamAwal?->jam_ke === $jamAkhir?->jam_ke ? 'Jam ke-'.$jamAwal?->jam_ke : 'Jam ke-'.$jamAwal?->jam_ke.' sampai ke-'.$jamAkhir?->jam_ke }}</dd></div>
            <div><dt class="text-brand-600">Waktu sesi</dt><dd class="mt-1 font-semibold">{{ $jamAwal ? substr($jamAwal->jam_mulai, 0, 5) : '—' }} – {{ $jamAkhir ? substr($jamAkhir->jam_selesai, 0, 5) : '—' }} WIB</dd></div>
            <div><dt class="text-brand-600">Jumlah siswa</dt><dd class="mt-1 font-semibold">{{ $jumlahSiswa }}</dd></div>
          </dl>
          <div class="border-t border-brand-100 pt-5">
            <h3 class="font-poppins text-sm font-bold uppercase tracking-wide text-brand-600">Materi Pembelajaran</h3>
            <p class="mt-2 whitespace-pre-line rounded-xl border border-brand-100 bg-brand-50 p-4 text-sm leading-relaxed">{{ $jurnal->materi ?: '—' }}</p>
          </div>
          @if($jurnal->keterangan)
            <div class="mt-5 border-t border-brand-100 pt-5"><h3 class="font-poppins text-sm font-bold uppercase tracking-wide text-brand-600">Catatan</h3><p class="mt-2 whitespace-pre-line text-sm leading-relaxed">{{ $jurnal->keterangan }}</p></div>
          @endif
        </section>

        <section class="print-card rounded-2xl border border-brand-100 bg-white p-5 shadow-sm sm:p-7">
          <div class="flex items-center justify-between border-b border-brand-100 pb-4">
            <h3 class="font-poppins text-base font-bold">Presensi Siswa</h3>
            <span class="rounded-full border border-brand-100 bg-brand-50 px-3 py-1 text-xs font-semibold">Total {{ $jumlahSiswa }} siswa</span>
          </div>
          <div class="mt-4 grid grid-cols-5 gap-1.5 sm:gap-3">
            <div class="rounded-xl border border-green-200 bg-green-50 min-w-0 p-1.5 text-center sm:p-2"><span class="block truncate text-[10px] sm:text-xs text-green-800">Hadir</span><strong>{{ $jumlahHadir }}</strong></div>
            <div class="rounded-xl border border-amber-200 bg-amber-50 min-w-0 p-1.5 text-center sm:p-2"><span class="block truncate text-[10px] sm:text-xs text-amber-800">Sakit</span><strong>{{ $jumlahSakit }}</strong></div>
            <div class="rounded-xl border border-blue-200 bg-blue-50 min-w-0 p-1.5 text-center sm:p-2"><span class="block truncate text-[10px] sm:text-xs text-blue-800">Izin</span><strong>{{ $jumlahIzin }}</strong></div>
            <div class="rounded-xl border border-red-200 bg-red-50 min-w-0 p-1.5 text-center sm:p-2"><span class="block truncate text-[10px] sm:text-xs text-red-800">Alpa</span><strong>{{ $jumlahAlpha }}</strong></div>
            <div class="rounded-xl border border-violet-200 bg-violet-50 min-w-0 p-1.5 text-center sm:p-2"><span class="block truncate text-[10px] sm:text-xs text-violet-800">Dispen</span><strong>{{ $jumlahDispen }}</strong></div>
          </div>
          <div class="mt-5 overflow-x-auto rounded-xl border border-brand-100">
            <table class="w-full text-left text-sm">
              <thead class="bg-brand-50 text-xs uppercase text-brand-800"><tr><th class="p-3">No</th><th class="p-3">Nama siswa</th><th class="p-3">Status</th></tr></thead>
              <tbody class="divide-y divide-brand-100">
                @forelse($tidakHadir as $index => $item)
                  <tr><td class="p-3">{{ $index + 1 }}</td><td class="p-3 font-semibold">{{ $item['nama'] }}</td><td class="p-3">{{ $item['status'] }}</td></tr>
                @empty
                  <tr><td colspan="3" class="p-4 text-center text-brand-600">Semua siswa tercatat hadir.</td></tr>
                @endforelse
                @foreach($dispen as $index => $item)
                  <tr><td class="p-3">{{ count($tidakHadir) + $index + 1 }}</td><td class="p-3 font-semibold">{{ $item }}</td><td class="p-3">Dispen</td></tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>
  </div>
  <nav class="no-print md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-brand-100 py-3.5 px-6 z-50 shadow-[0_-4px_25px_rgba(0,0,0,0.06)]">
    <div class="flex justify-between items-center">
      <a href="{{ route('dashboard-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg><span>Beranda</span></a>
      <a href="{{ route('jurnal.create') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z"/><path d="M7 3v14"/></svg><span>Isi Jurnal</span></a>
      <a href="{{ route('riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 4h14M3 8h14M3 12h10M3 16h6"/></svg><span>Riwayat</span></a>
      @if(auth()->user()->role === 'wali_kelas' && !auth()->user()->sedangPiket())
        <a href="{{ route('piket.rekap') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Rekap</span></a>
      @elseif(auth()->user()->sedangPiket())
        <a href="{{ route('dashboard-guru-piket') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></a>
      @else
        <span class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] opacity-50"><svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 2.5l6.5 3v4.2c0 4-2.7 6.4-6.5 7.8-3.8-1.4-6.5-3.8-6.5-7.8V5.5L10 2.5z"/><path d="M7 10l2 2 4-4"/></svg><span>Piket</span></span>
      @endif
      <a href="{{ route('profil-guru') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83]"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 17v-1.5a3.5 3.5 0 00-3.5-3.5h-5A3.5 3.5 0 004 15.5V17"/><circle cx="10" cy="6.5" r="3.5"/></svg><span>Profil</span></a>
    </div>
  </nav>
</body>
</html>

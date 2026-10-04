<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Guru - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            #sidebar, #sidebarOverlay, .no-print { display: none !important; }
            .print-area { margin: 0 !important; }
            body { background: #fff !important; }
        }
    </style>
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden" onclick="closeSidebar()"></div>

    @include('admin.partials.tambah_sidebar')

    <div class="md:ml-[280px] min-h-screen print-area">

        {{-- HEADER (tanpa hari & tanggal) --}}
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm no-print">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[#D7B899] text-xs font-medium">Rekap kehadiran harian guru</p>
                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">Kehadiran Guru</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

            <form method="GET" action="{{ route('admin.kehadiran') }}" class="flex flex-col gap-4">
                <div class="flex flex-col gap-3 rounded-lg border border-[#E5D8CC] bg-white p-4 sm:flex-row sm:items-end sm:justify-between sm:p-5">
                    <div><p class="text-[11px] font-semibold uppercase tracking-wide text-[#A08978]">Rekap harian</p><h2 class="font-[Poppins] text-lg font-bold">Kehadiran Guru</h2><p class="text-sm text-[#7A6A60]">Data berdasarkan jadwal dan jurnal guru pada tanggal yang dipilih.</p>@if(!empty($namaKegiatan))<p class="mt-1 text-sm font-semibold text-[#A16207]">{{ $namaKegiatan }} · jadwal pelajaran ditiadakan hari ini.</p>@endif</div>
                    <label class="flex flex-col gap-1 text-xs font-semibold text-[#7A6A60]">Tanggal<input type="date" name="tanggal" id="tanggalPicker" value="{{ $tanggal->format('Y-m-d') }}" onchange="this.form.submit()" class="rounded-lg border border-[#E5D8CC] bg-[#FDFBF7] px-3 py-2 text-sm text-[#3E3028]"></label>
                </div>
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="flex flex-wrap gap-2 no-print">
                        @foreach ([['semua','Semua'],['hadir','Hadir'],['izin','Izin'],['sakit','Sakit'],['tidak-hadir','Tidak Hadir'],['belum','Belum ada jurnal']] as [$key,$label])
                            <button type="button" data-status-btn="{{ $key }}" onclick="filterStatus('{{ $key }}', this)" class="status-tab-btn rounded-lg border border-[#D8C9BC] bg-white px-3 py-2 text-xs font-bold text-[#5C4033] transition">{{ $label }} <span class="opacity-80">({{ $ringkasan[$key] ?? 0 }})</span></button>
                        @endforeach
                        </div>
                            <input id="cariKehadiranGuru" type="search" oninput="filterKehadiran()" placeholder="Ketik untuk mencari..." class="w-full rounded-lg border border-[#D8C9BC] bg-white px-3 py-2 text-sm font-normal text-[#3E3028] sm:w-64">
                        </label>
                    </div>
                    <a href="{{ route('admin.kehadiran.export', ['tanggal' => $tanggal->format('Y-m-d')]) }}" class="rounded-lg border border-[#D8C9BC] bg-[#5C4033] px-3.5 py-2 text-xs font-bold text-white hover:bg-[#452F26]">Export Excel</a>
                </div>
            </form>
            <div class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="overflow-x-auto"><table id="tabelKehadiran" class="w-full min-w-[760px] text-left text-sm">
                    <thead class="bg-[#F5EFE8] text-[11px] uppercase text-[#5C4033]"><tr><th class="p-3">Guru</th><th class="p-3">Mata Pelajaran</th><th class="p-3">Status</th><th class="p-3">Materi / Keterangan</th><th class="p-3">Kelas</th><th class="p-3">Jam</th></tr></thead>
                    <tbody class="divide-y divide-[#E5D8CC]">
                        @forelse ($barisKehadiran as $baris)
                            @php($jurnal = $baris->jurnalHariIni)
                            @php($status = $baris->statusTampilan)
                            @php($labelStatus = match($status) { 'hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'tidak-hadir' => 'Tidak Hadir', default => 'Belum ada jurnal' })
                            @php($warnaStatus = match($status) { 'hadir' => 'bg-[#E8F5E9] text-[#2E7D32]', 'izin' => 'bg-[#E3F2FD] text-[#1565C0]', 'sakit' => 'bg-[#FFF3E0] text-[#E65100]', 'tidak-hadir' => 'bg-[#FFEBEE] text-[#C62828]', default => 'bg-[#F5EFE8] text-[#7A6A60]' })
                            <tr data-status="{{ $status }}"><td class="p-3 font-semibold">{{ $baris->guru->name }}</td><td class="p-3">{{ $baris->mapel->nama_mapel ?? '—' }}</td><td class="p-3"><span class="rounded-md px-2 py-1 text-xs font-bold {{ $warnaStatus }}">{{ $labelStatus }}</span></td><td class="max-w-sm whitespace-pre-line p-3">{{ $jurnal?->materi ?: ($jurnal?->keterangan ?: '—') }}</td><td class="p-3">{{ $baris->kelas->nama_kelas }}</td><td class="p-3 whitespace-nowrap">{{ substr($baris->jamPelajaran->jam_mulai,0,5) }}–{{ substr($baris->jamPelajaran->jam_selesai,0,5) }}</td></tr>
                        @empty
                            <tr><td colspan="6" class="p-8 text-center text-sm text-[#7A6A60]">{{ !empty($namaKegiatan) ? 'Jadwal pelajaran ditiadakan untuk kegiatan '.$namaKegiatan.'. Guru tidak dihitung tidak hadir.' : 'Tidak ada jadwal mengajar pada tanggal ini.' }}</td></tr>
                        @endforelse
                        @if($barisKehadiran->isNotEmpty())
                            <tr id="hasilCariKehadiran" class="hidden"><td colspan="6" class="p-8 text-center text-sm text-[#7A6A60]">Tidak ada data yang cocok dengan pencarian/filter.</td></tr>
                        @endif
                    </tbody>
                </table></div>
            </div>
        </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }

        function closeTambahMenu() {
            const menu = document.getElementById('tambahMenu');
            if (menu) {
                menu.open = false;
            }
        }

        // ===== PENCARIAN DAN FILTER STATUS =====
        let statusKehadiranAktif = 'semua';
        function filterKehadiran() {
            const query = document.getElementById('cariKehadiranGuru').value.trim().toLocaleLowerCase();
            let jumlahTerlihat = 0;
            document.querySelectorAll('#tabelKehadiran tbody tr[data-status]').forEach(row => {
                const cocokStatus = statusKehadiranAktif === 'semua' || row.dataset.status === statusKehadiranAktif;
                const cocokCari = row.textContent.toLocaleLowerCase().includes(query);
                const tampil = cocokStatus && cocokCari;
                row.classList.toggle('hidden', !tampil);
                if (tampil) jumlahTerlihat++;
            });
            document.getElementById('hasilCariKehadiran')?.classList.toggle('hidden', jumlahTerlihat > 0);
        }
        function filterStatus(status, btn) {
            statusKehadiranAktif = status;
            document.querySelectorAll('.status-tab-btn').forEach(tab => {
                tab.classList.remove('bg-[#5C4033]', 'text-white');
                tab.classList.add('bg-white');
            });
            btn.classList.remove('bg-white');
            btn.classList.add('bg-[#5C4033]', 'text-white');
            filterKehadiran();
        }


    </script>
</body>
</html>
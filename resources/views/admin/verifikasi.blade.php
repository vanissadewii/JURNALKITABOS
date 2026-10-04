<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"
         onclick="closeSidebar()">
    </div>

    @include('admin.partials.tambah_sidebar')


    <div class="md:ml-[280px] min-h-screen">

        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-[#D7B899] text-xs font-medium">
                        Pantau status verifikasi hari ini
                    </p>

                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">
                        Verifikasi
                    </h1>
                </div>

                <button
                    type="button"
                    onclick="openSidebar()"
                    class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white/10"
                >
                    <svg
                        class="w-6 h-6 text-white"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

            </div>

        </div>


        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-4">

            <section class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-3"><h2 class="font-['Poppins'] text-sm font-bold uppercase">Jadwal Piket</h2></div>
                <div class="overflow-x-auto"><table class="w-full min-w-[560px] text-left text-sm"><thead class="text-[11px] uppercase text-[#7A6A60]"><tr><th class="p-3">Petugas</th><th class="p-3">Peran</th><th class="p-3">Jam tugas</th><th class="p-3">Status</th></tr></thead><tbody class="divide-y divide-[#E5D8CC]">
                    @forelse ($piketHariIni as $petugas)
                        @php($namaPetugas = $petugas->sesi === 'waka' ? ($petugas->waka?->nama ?? 'Waka belum ditentukan') : ($petugas->guru?->name ?? 'Guru belum ditentukan'))
                        <tr><td class="p-3 font-semibold">{{ $namaPetugas }}</td><td class="p-3">{{ $petugas->sesi === 'waka' ? 'Waka' : 'Guru Piket • '.ucfirst($petugas->sesi) }}</td><td class="p-3">{{ $petugas->jam_mulai ? substr($petugas->jam_mulai,0,5) : '—' }}–{{ $petugas->jam_selesai ? substr($petugas->jam_selesai,0,5) : '—' }}</td><td class="p-3"><span class="rounded-md bg-[#F5EFE8] px-2 py-1 text-xs font-bold text-[#5C4033]">{{ $petugas->statusTampilan }}</span></td></tr>
                    @empty
                        <tr><td colspan="4" class="p-8 text-center text-sm text-[#7A6A60]">Belum ada jadwal piket pada tanggal yang dipilih.</td></tr>
                    @endforelse
                </tbody></table></div>
            </section>

            <section class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-4">
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between"><div><h2 class="font-['Poppins'] text-sm font-bold uppercase">Dispensasi Siswa</h2><p class="mt-1 text-xs text-[#7A6A60]">Status dispensasi dari pengajuan guru piket dan persetujuan Waka.</p></div>
                        <form method="GET" action="{{ route('admin.verifikasi') }}" class="flex flex-col gap-2 sm:flex-row"><select id="filterKelas" onchange="filterDispensasi()" class="rounded-lg border border-[#E5D8CC] bg-white px-3 py-2 text-[13px] text-[#3E3028]"><option value="semua">Semua Kelas</option><option value="X">Kelas X</option><option value="XI">Kelas XI</option><option value="XII">Kelas XII</option></select><input type="date" id="filterTanggal" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="rounded-lg border border-[#E5D8CC] bg-white px-3 py-2 text-[13px] text-[#3E3028]"><a href="{{ route('admin.verifikasi') }}" class="rounded-lg bg-[#5C4033] px-3 py-2 text-center text-[13px] font-semibold text-white">Reset</a></form>
                    </div>
                </div>
                <div id="dispensasiList" class="divide-y divide-[#E5D8CC]">
                    @forelse ($dispensasi as $item)
                        @php($kelasTingkat = $tingkat[(string)($item->kelas?->tingkat ?? '')] ?? (string)($item->kelas?->tingkat ?? ''))
                        @php($warnaDispen = match($item->status) { 'disetujui' => 'bg-[#E8F5E9] text-[#2E7D32]', 'ditolak' => 'bg-[#FFEBEE] text-[#C62828]', default => 'bg-[#FFF3E0] text-[#E65100]' })
                        <article class="dispensasi-item p-4" data-kelas="{{ $kelasTingkat }}" data-tanggal="{{ $item->tanggal->format('Y-m-d') }}">
                            <button type="button" onclick="toggleDispensasi(this)" class="flex w-full items-center justify-between gap-3 text-left"><div><p class="font-semibold text-[#3E3028]">{{ $item->siswa?->nama ?? 'Siswa tidak ditemukan' }}</p><p class="mt-1 text-xs text-[#7A6A60]">{{ $item->kelas?->nama_kelas ?? 'Kelas tidak ditemukan' }} · {{ $item->tanggal->format('d/m/Y') }} · {{ $item->labelJam() }}</p></div><span class="rounded-md px-2 py-1 text-xs font-bold {{ $warnaDispen }}">{{ ucfirst($item->status) }}</span></button>
                            <div class="dispen-content hidden mt-3 border-t border-[#E5D8CC] pt-3 text-sm"><p>{{ $item->alasan }}</p><p class="mt-2 text-xs text-[#7A6A60]">Diajukan oleh: {{ $item->guruPiket?->name ?? '—' }}@if($item->disetujui_at) · Diproses {{ $item->disetujui_at->format('d/m/Y H:i') }}@endif</p>@if($item->status === 'menunggu')<p class="mt-1 text-xs text-amber-700">Menunggu keputusan melalui tautan persetujuan Waka.</p>@endif</div>
                        </article>
                    @empty
                        <div id="emptyDispensasi" class="p-8 text-center text-sm text-[#7A6A60]">Tidak ada dispensasi pada tanggal ini.</div>
                    @endforelse
                    @if($dispensasi->isNotEmpty())<div id="emptyDispensasi" class="hidden p-8 text-center text-sm text-[#7A6A60]">Tidak ada dispensasi yang cocok dengan filter.</div>@endif
                </div>
            </section>

            <section class="overflow-hidden rounded-lg border border-[#E5D8CC] bg-white">
                <div class="border-b border-[#E5D8CC] bg-[#F5EFE8] px-4 py-3">
                    <h2 class="font-['Poppins'] text-sm font-bold uppercase">Input Surat Siswa</h2>
                    <p class="mt-1 text-xs text-[#7A6A60]">Surat sakit dan izin yang dicatat guru piket pada {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}.</p>
                </div>
                <div class="overflow-x-auto"><table class="w-full min-w-[560px] text-left text-sm">
                    <thead class="text-[11px] uppercase text-[#7A6A60]"><tr><th class="p-3">Siswa</th><th class="p-3">Kelas</th><th class="p-3">Status</th><th class="p-3">Diinput oleh</th></tr></thead>
                    <tbody class="divide-y divide-[#E5D8CC]">
                        @forelse($suratSiswa as $surat)
                            <tr><td class="p-3 font-semibold">{{ $surat->nama_siswa }}</td><td class="p-3">{{ $tingkat[(string)$surat->tingkat] ?? $surat->tingkat }} {{ $surat->jurusan }} {{ $surat->rombel }}</td><td class="p-3">{{ $surat->status }}</td><td class="p-3">{{ $surat->guru_piket ?? '—' }}</td></tr>
                        @empty
                            <tr><td colspan="4" class="p-8 text-center text-sm text-[#7A6A60]">Belum ada input surat pada tanggal ini.</td></tr>
                        @endforelse
                    </tbody>
                </table></div>
            </section>
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


        function toggleDispensasi(button) {

            const detail = button.nextElementSibling;
            const icon = button.querySelector('svg');

            detail.classList.toggle('hidden');

            if (detail.classList.contains('hidden')) {
                icon.classList.remove('rotate-180');
            } else {
                icon.classList.add('rotate-180');
            }

        }


        function filterDispensasi() {

            const kelas = document.getElementById('filterKelas').value;
            const tanggal = document.getElementById('filterTanggal').value;

            const items = document.querySelectorAll('.dispensasi-item');

            let jumlahTampil = 0;

            items.forEach(function(item) {

                const itemKelas = item.dataset.kelas;
                const itemTanggal = item.dataset.tanggal;

                const cocokKelas =
                    kelas === 'semua' ||
                    itemKelas === kelas;

                const cocokTanggal =
                    tanggal === '' ||
                    itemTanggal === tanggal;

                if (cocokKelas && cocokTanggal) {

                    item.classList.remove('hidden');
                    jumlahTampil++;

                } else {

                    item.classList.add('hidden');

                    const detail = item.querySelector('.dispensasi-detail');
                    const icon = item.querySelector('button svg');

                    detail.classList.add('hidden');
                    icon.classList.remove('rotate-180');

                }

            });


            const emptyState = document.getElementById('emptyDispensasi');

            if (jumlahTampil === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }

        }


        function resetFilter() {

            document.getElementById('filterKelas').value = 'semua';
            document.getElementById('filterTanggal').value = '';

            filterDispensasi();

        }

    </script>

</body>
</html>
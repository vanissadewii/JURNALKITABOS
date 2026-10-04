<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    <script src="https://cdn.tailwindcss.com"></script>
    <style>html { scrollbar-width: none; } html::-webkit-scrollbar { display: none; }</style>
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen overflow-x-hidden">

    {{-- SIDEBAR OVERLAY --}}
    <div
        id="sidebarOverlay"
        class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"
        onclick="closeSidebar()"
    ></div>


    {{-- SIDEBAR --}}
    @include('admin.partials.tambah_sidebar')



    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="md:ml-[280px] min-h-screen">


        {{-- HEADER --}}
        <div class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 sm:px-6 md:px-7 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-[#D7B899] text-xs font-medium">
                        Selamat Datang,
                    </p>

                    <h1 class="text-white font-['Poppins'] font-bold text-xl md:text-2xl">
                        {{ auth()->user()->name }}
                    </h1>

                </div>


                {{-- MOBILE MENU --}}
                <button
                    type="button"
                    onclick="openSidebar()"
                    class="md:hidden w-10 h-10 flex items-center justify-center
                           rounded-lg hover:bg-white/10"
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


            <div class="flex items-center gap-2 mt-3">

                <span class="text-white text-[13px] font-medium">
                    {{ \App\Support\Waktu::sekarang()->locale('id')->translatedFormat('l, d F Y') }}
                </span>

            </div>

        </div>



        {{-- CONTENT --}}
        <div class="px-4 py-5 sm:p-6 md:p-7 flex flex-col gap-5">
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
                <a href="{{ route('admin.user.index', ['role' => 'guru']) }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#5C4033] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#5C4033]/10 text-[#5C4033]">G</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Guru</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahGuru }}</p></div>
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#2E7D32] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#2E7D32]/10 text-[#2E7D32]">S</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Siswa</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahSiswa }}</p></div>
                </a>
                <a href="{{ route('admin.kelas.index') }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#1565C0] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#1565C0]/10 text-[#1565C0]">K</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Total Kelas</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahKelas }}</p></div>
                </a>
                <a href="{{ route('admin.rekap', ['dari' => \App\Support\Waktu::sekarang()->toDateString(), 'sampai' => \App\Support\Waktu::sekarang()->toDateString()]) }}" class="group flex items-center gap-3 rounded-xl border border-[#E5D8CC] bg-white p-4 transition hover:border-[#F57F17] hover:shadow-md">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#F57F17]/10 text-[#F57F17]">J</div>
                    <div><p class="truncate text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">Jurnal Hari Ini</p><p class="font-['Poppins'] text-xl font-extrabold">{{ $jumlahJurnal }}</p></div>
                </a>
            </div>

            <a href="{{ route('admin.jurnal') }}" class="flex items-center justify-between gap-3 rounded-xl border border-[#F5D08A] bg-white p-3.5 transition hover:border-[#F57F17] hover:shadow-md">
                <div><p class="text-[13px] font-semibold text-[#3E3028]">{{ $menungguVerifikasi }} jurnal menunggu verifikasi hari ini</p><p class="mt-0.5 text-[11px] text-[#7A6A60]">Buka daftar jurnal guru</p></div>
                <span class="text-[#7A6A60]">→</span>
            </a>

            <section>
                <h2 class="mb-2.5 font-['Poppins'] text-[13px] font-bold uppercase">Ringkasan Jurnal Guru Hari Ini</h2>
                <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
                    @foreach ([['Hadir','hadir','#2E7D32'],['Izin','izin','#1565C0'],['Sakit','sakit','#F57F17'],['Tidak Hadir','tidak_hadir','#C62828']] as [$label,$key,$warna])
                        <a href="{{ route('admin.kehadiran') }}" class="rounded-xl border border-[#E5D8CC] border-l-4 bg-white p-3.5 hover:shadow-md" style="border-left-color: {{ $warna }}">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-[#7A6A60]">{{ $label }}</p>
                            <p class="mt-1 font-['Poppins'] text-xl font-extrabold" style="color: {{ $warna }}">{{ $ringkasanKehadiran[$key] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>

            <section>
                <div class="mb-2.5 flex items-center justify-between"><h2 class="font-['Poppins'] text-[13px] font-bold uppercase">Jadwal Mengajar Hari Ini · {{ $hariIni }}</h2></div>
                <div class="mb-3 flex gap-2">
                    @foreach (['X','XI','XII'] as $tingkat)
                        <button type="button" onclick="filterTingkat('{{ $tingkat }}', this)" data-tingkat-btn="{{ $tingkat }}" class="tingkat-tab-btn rounded-full border border-[#D8C9BC] bg-white px-4 py-1.5 text-xs font-semibold text-[#5C4033] transition">Kelas {{ $tingkat }}</button>
                    @endforeach
                </div>
                <div class="flex flex-col gap-2.5">
                    @foreach (['X', 'XI', 'XII'] as $tingkatKosong)
                        @if (($kelasPerTingkat->get($tingkatKosong) ?? collect())->isEmpty())
                            <div data-tingkat-empty="{{ $tingkatKosong }}" class="hidden rounded-xl border border-dashed border-[#D8C9BC] bg-white p-6 text-center text-sm text-[#7A6A60]">Belum ada data kelas tingkat {{ $tingkatKosong }}.</div>
                        @endif
                    @endforeach
                    @foreach ($kelasPerTingkat as $tingkat => $daftarKelas)
                        @foreach ($daftarKelas as $kelas)
                            @php($daftarJadwal = $jadwalPerKelas->get($kelas->id_kelas, collect()))
                            <div data-tingkat="{{ $tingkat }}" class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white">
                                <button type="button" onclick="toggleJadwal('kelas-{{ $kelas->id_kelas }}')" class="flex w-full items-center justify-between p-3.5 text-left transition hover:bg-[#F5EFE8]">
                                    <div><p class="font-['Poppins'] text-[15px] font-bold">{{ $kelas->nama_kelas }}</p><p class="mt-0.5 text-[12px] text-[#7A6A60]">{{ $daftarJadwal->count() }} jadwal hari ini</p></div>
                                    <div class="flex items-center gap-2"><span class="rounded-md bg-[#E8F5E9] px-2.5 py-1 text-[11px] font-bold text-[#2E7D32]">{{ $daftarJadwal->count() }} jadwal</span><svg id="icon-kelas-{{ $kelas->id_kelas }}" class="h-4 w-4 text-[#7A6A60] transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                                </button>
                                <div id="kelas-{{ $kelas->id_kelas }}" class="hidden border-t border-[#E5D8CC] p-3.5">
                                    @forelse ($daftarJadwal as $jadwal)
                                        @php($jurnal = $jadwal->jurnalHariIni)
                                        @php($status = $jurnal?->status_kehadiran_guru)
                                        <article class="mb-2.5 rounded-lg border border-[#E5D8CC] p-3 last:mb-0">
                                            <div class="flex flex-wrap justify-between gap-3"><div><p class="text-[13px] font-semibold">{{ $jadwal->mapel->nama_mapel ?? 'Mata pelajaran belum diatur' }}</p><p class="mt-1 text-[11px] text-[#7A6A60]">{{ $jadwal->guru->name ?? 'Guru belum diatur' }} · {{ substr($jadwal->jam_mulai,0,5) }}–{{ substr($jadwal->jam_selesai,0,5) }}@if($jadwal->jam_ke_mulai !== $jadwal->jam_ke_sampai) (jam ke-{{ $jadwal->jam_ke_mulai }}–{{ $jadwal->jam_ke_sampai }}) @endif</p></div>
                                                @if ($status === 'tidak_hadir')<span class="h-fit rounded-md bg-[#FFEBEE] px-2 py-1 text-[10px] font-bold text-[#C62828]">Tidak hadir</span>
                                                @elseif ($jurnal)<span class="h-fit rounded-md bg-[#E8F5E9] px-2 py-1 text-[10px] font-bold text-[#2E7D32]">Jurnal dikirim</span>
                                                @else<span class="h-fit rounded-md bg-[#FFFDE7] px-2 py-1 text-[10px] font-bold text-[#F57F17]">Belum ada jurnal</span>@endif
                                            </div>
                                            @if ($jurnal && $status !== 'tidak_hadir')<p class="mt-2 text-[11px] text-[#7A6A60]">Verifikasi jurnal: {{ $jurnal->status_verifikasi === 'terverifikasi' ? 'Terverifikasi' : 'Menunggu verifikasi' }}</p>@endif
                                        </article>
                                    @empty
                                        <p class="rounded-lg bg-[#F5EFE8] p-3 text-xs text-[#7A6A60]">Belum ada jadwal untuk kelas ini hari ini.</p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    @if ($kelasList->isEmpty())<p class="rounded-xl border border-dashed border-[#D8C9BC] bg-white p-6 text-center text-sm text-[#7A6A60]">Belum ada data kelas. Tambahkan kelas melalui menu admin.</p>@endif
                </div>
            </section>
        </div>
    </div>

    {{-- LOGOUT CONFIRMATION --}}
    <div
        id="logoutModal"
        class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 px-4"
        onclick="closeLogoutModal(event)"
    >
        <div
            class="w-full max-w-sm rounded-xl bg-white p-5 shadow-xl"
            role="dialog"
            aria-modal="true"
            aria-labelledby="logoutModalTitle"
            onclick="event.stopPropagation()"
        >
            <h2 id="logoutModalTitle" class="font-['Poppins'] text-lg font-bold text-[#3E3028]">
                Yakin ingin logout?
            </h2>

            <p class="mt-2 text-sm text-[#7A6A60]">
                Anda akan keluar dari akun admin.
            </p>

            <div class="mt-5 flex justify-end gap-2">
                <button
                    type="button"
                    onclick="closeLogoutModal()"
                    class="rounded-lg px-4 py-2 text-sm font-semibold text-[#5C4033] hover:bg-[#F5EFE8]"
                >
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-lg bg-[#C62828] px-4 py-2 text-sm font-semibold text-white hover:bg-[#A51F1F]"
                    >
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>


    {{-- JAVASCRIPT --}}
    <script>

        function openLogoutModal() {

            const modal = document.getElementById('logoutModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }


        function closeLogoutModal(event) {

            if (event && event.target !== event.currentTarget) {
                return;
            }

            const modal = document.getElementById('logoutModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');

        }

        function openSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .remove('-translate-x-full');

            document
                .getElementById('sidebarOverlay')
                .classList
                .remove('hidden');

        }


        function closeSidebar() {

            document
                .getElementById('sidebar')
                .classList
                .add('-translate-x-full');

            document
                .getElementById('sidebarOverlay')
                .classList
                .add('hidden');

        }

        function toggleJadwal(id) {

            const content = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            content.classList.toggle('hidden');

            if (content.classList.contains('hidden')) {

                icon.classList.remove('rotate-180');

            } else {

                icon.classList.add('rotate-180');

            }

        }

        function closeTambahMenu() {
            const menu = document.getElementById('tambahMenu');
            if (menu) {
                menu.open = false;
            }
        }

        function filterTingkat(tingkat, btn) {

            // tampilkan/sembunyikan kartu kelas sesuai tingkat yang dipilih
            document.querySelectorAll('[data-tingkat]').forEach(function (card) {
                card.classList.toggle('hidden', card.dataset.tingkat !== tingkat);
            });

            // tampilkan pesan "belum ada jadwal" jika tingkat kosong
            document.querySelectorAll('[data-tingkat-empty]').forEach(function (empty) {
                empty.classList.toggle('hidden', empty.dataset.tingkatEmpty !== tingkat);
            });

            // update style tombol tab aktif
            document.querySelectorAll('.tingkat-tab-btn').forEach(function (tab) {
                const aktif = tab === btn;
                tab.classList.toggle('bg-[#5C4033]', aktif);
                tab.classList.toggle('text-white', aktif);
                tab.classList.toggle('bg-white', !aktif);
                tab.classList.toggle('border', !aktif);
                tab.classList.toggle('border-[#D8C9BC]', !aktif);
                tab.classList.toggle('text-[#5C4033]', !aktif);
            });

        }

        document.addEventListener('DOMContentLoaded', function () {
            const tabAwal = document.querySelector('[data-tingkat-btn="X"]');
            if (tabAwal) {
                filterTingkat('X', tabAwal);
            }
        });

    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan QR - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>html{scrollbar-width:none}html::-webkit-scrollbar{display:none}</style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#F5EFE8] font-['Inter'] text-[#3E3028]">
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 md:hidden" onclick="closeSidebar()"></div>
    @include('admin.partials.tambah_sidebar')
    <main class="min-h-screen md:ml-[280px]">
        <header class="sticky top-0 z-30 bg-[#5C4033] px-4 py-5 text-white shadow-sm sm:px-6 md:px-7">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium text-[#D7B899]">Pengaturan Keamanan</p>
                    <h1 class="font-['Poppins'] text-xl font-bold md:text-2xl">Pengaturan QR</h1>
                </div>
                <button type="button" onclick="openSidebar()" class="rounded-lg px-3 py-2 text-white hover:bg-white/10 md:hidden" aria-label="Buka sidebar">☰</button>
            </div>
        </header>

        <section class="flex flex-col gap-4 p-4 sm:p-6 md:p-7">
            @if (session('success'))
                <div class="rounded-xl border border-[#B7DDBB] bg-[#E8F5E9] px-4 py-3 text-sm font-semibold text-[#2E7D32]">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-800">{{ $errors->first() }}</div>
            @endif

            <article class="overflow-hidden rounded-xl border border-[#E5D8CC] bg-white shadow-sm">
                <div class="border-b border-[#E5D8CC] bg-[#FFFCF9] px-4 py-3">
                    <h2 class="font-['Poppins'] text-base font-bold">Durasi Masa Berlaku QR</h2>
                    <p class="mt-0.5 text-xs text-[#7A6A60]">Atur berapa detik QR sesi mengajar berlaku sebelum kedaluwarsa.</p>
                </div>

                <form method="POST" action="{{ route('admin.aturan-qr.update') }}" class="flex flex-col gap-3 px-4 py-4">
                    @csrf
                    @method('PUT')
                    <label for="masa_qr_detik" class="text-sm font-semibold">Durasi (detik)</label>
                    <input id="masa_qr_detik" name="masa_qr_detik" type="number" min="5" max="120"
                           value="{{ old('masa_qr_detik', $masaQrDetik) }}"
                           class="h-10 w-full max-w-xs rounded-lg border border-[#D8C9BC] bg-white px-3.5 text-sm outline-none focus:border-[#5C4033] focus:ring-2 focus:ring-[#5C4033]/10">
                    <p class="text-xs text-[#7A6A60]">Batas 5 sampai 120 detik. Semakin pendek durasi, semakin sulit QR difoto dan dikirim ke orang lain. Perubahan berlaku untuk QR yang dibuat setelah disimpan.</p>
                    <button type="submit" class="w-fit rounded-lg bg-[#5C4033] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#4B3329]">Simpan Pengaturan</button>
                </form>
            </article>
        </section>
    </main>

    <script>
        function openSidebar(){document.getElementById('sidebar').classList.remove('-translate-x-full');document.getElementById('sidebarOverlay').classList.remove('hidden')}
        function closeSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('sidebarOverlay').classList.add('hidden')}
    </script>
</body>
</html>
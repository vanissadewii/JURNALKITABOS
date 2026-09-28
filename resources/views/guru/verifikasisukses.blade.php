<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sukses</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen">

    <div class="w-full bg-[#5C4033] px-4 py-5 sm:px-6 flex items-center justify-center text-white">
        <h1 class="m-0 font-['Poppins'] text-[15px] sm:text-[17px] font-semibold text-center">Verifikasi Sukses</h1>
    </div>

    <div class="w-full max-w-[500px] mx-auto px-6 pt-8 sm:pt-10 pb-5 text-center">

        <div class="w-[72px] h-[72px] mx-auto mb-4 rounded-full bg-[#E8F5E9] border-2 border-[#2E7D32]
                    flex items-center justify-center text-[#2E7D32] text-4xl font-bold">✓</div>

        <h2 class="font-['Poppins'] text-lg sm:text-xl font-semibold text-[#2E7D32] m-0 mb-2">Jurnal Terverifikasi</h2>
        <p class="text-xs leading-relaxed text-[#7A6A60] max-w-[320px] mx-auto mb-6">
            Kehadiran Anda sudah dikonfirmasi oleh kelas dan jurnal tersimpan.
        </p>

        <div class="bg-white border border-[#E5D8CC] rounded-[10px] p-4 text-left shadow-[0_2px_8px_rgba(62,48,40,0.06)]">
            <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                <span class="text-[#7A6A60]">Kelas</span>
                <span class="text-[#3E3028] font-medium text-right">{{ $jurnal->jadwal->kelas->nama_kelas ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-4 py-2.5 border-b border-[#E5D8CC] text-[13px]">
                <span class="text-[#7A6A60]">Mata Pelajaran</span>
                <span class="text-[#3E3028] font-medium text-right">{{ $jurnal->jadwal->mapel->nama_mapel ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-4 pt-2.5 text-[13px]">
                <span class="text-[#7A6A60]">Materi</span>
                <span class="text-[#3E3028] font-medium text-right">{{ $jurnal->materi ?: '-' }}</span>
            </div>
        </div>

        <a href="{{ route('riwayat-jurnal') }}"
           class="w-full h-[45px] mt-6 rounded-lg bg-[#5C4033] hover:bg-[#4B3329] text-white
                  font-['Poppins'] text-sm font-medium flex items-center justify-center">
            Lihat Riwayat Jurnal
        </a>
    </div>

</body>
</html>
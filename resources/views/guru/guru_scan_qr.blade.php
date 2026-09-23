<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Sesi Mengajar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    <style>
        #qr-reader video {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }

        #qr-reader__scan_region {
            min-height: unset !important;
        }
    </style>
</head>

<body class="bg-brand-50 font-sans min-h-screen flex text-[#3E3028]">

    <!-- SIDEBAR LEFT NAVIGATION (Desktop) -->
    <aside class="w-64 bg-white border-r border-brand-100 min-h-screen flex flex-col justify-between shrink-0 fixed left-0 top-0 bottom-0 z-40 hidden md:flex">
        <div class="p-6 flex flex-col gap-8">

            <div class="flex flex-col gap-0.5">
                <h2 class="font-poppins font-extrabold text-xl text-[#3E3028] tracking-tight">JURNAL GURU</h2>
                <span class="text-xs font-medium text-brand-600">Akun Guru</span>
            </div>

            <nav class="flex flex-col gap-1.5">
                <a href="{{ url('/dashboard-guru') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
                    <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 9.5L10 4l7 5.5V16a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
                    </svg>
                    <span>Beranda</span>
                </a>

                <a href="{{ url('/form-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 bg-brand-50 rounded-xl font-poppins font-bold text-sm text-[#3E3028] transition-all">
                    <svg class="w-5 h-5 text-[#3E3028]" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
                        <path d="M7 3v14" />
                    </svg>
                    <span>Isi Jurnal</span>
                </a>

                <a href="{{ url('/riwayat-jurnal') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl font-medium text-sm text-brand-600 hover:bg-brand-50 hover:text-[#3E3028] transition-all">
                    <svg class="w-5 h-5 text-brand-600" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
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

    <!-- MAIN CONTENT -->
    <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-24 md:pb-8 w-full min-w-0">

        <header class="w-full bg-[#5C4033] shadow-md px-6 md:px-10 py-6 sm:py-8 flex items-center justify-between">
            <a href="{{ route('dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center text-2xl text-white shrink-0">←</a>
            <h1 class="m-0 font-poppins text-base sm:text-lg font-bold text-white text-center">Scan Sesi Mengajar</h1>
            <div class="w-9 shrink-0"></div>
        </header>

        <main class="w-full max-w-lg mx-auto px-4 sm:px-6 py-8 flex-1 flex flex-col gap-4">

            @if (session('error'))
            <div class="bg-[#FFEBEE] border border-[#FFCDD2] text-[#C62828] text-sm font-medium rounded-[10px] p-3">
                {{ session('error') }}
            </div>
            @endif

            @if (session('info') || session('success'))
            <div class="bg-[#E3F2FD] border border-[#B8D8F5] text-[#1976D2] text-sm font-medium rounded-[10px] p-3">
                {{ session('info') ?? session('success') }}
            </div>
            @endif

            @include('partials.scan-dua-arah', [
            'statusUrl' => route('guru.scan-status'),
            'scanUrl' => route('guru.scan-kelas'),
            'judulScan' => 'Pindai QR Kelas',
            'teksScan' => 'Arahkan kamera ke QR yang tampil di layar kelas.',
            'judulQr' => 'QR Code Guru',
            'teksQr' => 'Tunjukkan QR ini ke layar kelas. Halaman akan otomatis pindah setelah terverifikasi.',
            ])

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

            <a href="{{ url('/form-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-bold text-brand-800">
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1z" />
                    <path d="M7 3v14" />
                </svg>
                <span>Isi Jurnal</span>
            </a>

            <a href="{{ url('/riwayat-jurnal') }}" class="flex flex-col items-center gap-1 text-xs font-medium text-[#9E8E83] hover:text-brand-800 transition-colors">
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
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

</body>

</html>

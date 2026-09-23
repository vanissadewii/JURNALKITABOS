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

<body class="bg-[#F5EFE8] font-['Inter'] text-[#3E3028] min-h-screen">


    <div class="w-full bg-[#5C4033] px-4 py-5 sm:px-6 flex items-center justify-between text-white">
        <a href="{{ route('dashboard-guru') }}" class="w-9 h-9 flex items-center justify-center text-2xl shrink-0">←</a>
        <h1 class="m-0 font-['Poppins'] text-[15px] sm:text-[17px] font-semibold text-center">Scan Sesi Mengajar</h1>
        <div class="w-9 shrink-0"></div>
    </div>

    @if (session('error'))
    <div class="max-w-[500px] mx-auto mt-4 px-4">
        <div class="bg-[#FFEBEE] border border-[#FFCDD2] text-[#C62828] text-sm font-medium rounded-[10px] p-3">
            {{ session('error') }}
        </div>
    </div>
    @endif

    @if (session('info') || session('success'))
    <div class="max-w-[500px] mx-auto mt-4 px-4">
        <div class="bg-[#E3F2FD] border border-[#B8D8F5] text-[#1976D2] text-sm font-medium rounded-[10px] p-3">
            {{ session('info') ?? session('success') }}
        </div>
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

</body>

</html>
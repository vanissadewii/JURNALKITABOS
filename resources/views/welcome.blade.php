<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jurnal Guru - Welcome</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <!-- Menggunakan CDN Tailwind agar tidak error Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9F6F0] text-[#3E3028] flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col font-sans">

    <div class="flex flex-col items-center justify-center w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-[#EFE6DD] text-center gap-6">
        <div class="flex flex-col items-center gap-2">
            <h1 class="text-2xl font-bold text-[#3E3028]">Sistem Jurnal Guru</h1>
            <p class="text-sm text-[#7A6A60]">Selamat datang di aplikasi manajemen jurnal mengajar.</p>
        </div>

        <div class="flex flex-col w-full gap-3">
            <a href="{{ url('/login') }}" class="w-full py-3 bg-[#5C4033] hover:bg-[#4A3329] text-white font-semibold rounded-xl transition">
                Masuk ke Halaman Login
            </a>
            <a href="{{ url('/dashboard-guru') }}" class="w-full py-3 bg-white border border-[#5C4033] text-[#5C4033] hover:bg-[#F9F6F0] font-semibold rounded-xl transition">
                Lihat Dashboard Guru
            </a>
        </div>
    </div>

</body>
</html>
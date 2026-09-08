<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Jurnal Guru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F5EFE8] min-h-screen flex flex-col">

    {{-- Konten utama: header ditaruh agak ke atas, bukan center penuh --}}
    <div class="flex-1 flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-[390px] sm:max-w-[420px] flex flex-col items-center gap-10 sm:-translate-y-6 lg:-translate-y-12">

            {{-- Header: icon + judul (lebih besar) --}}
            <div class="flex flex-col items-center gap-3 w-full">
                <div class="w-16 h-16 flex items-center justify-center bg-[#5C4033] rounded-[12px]">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M12 6.5C10.5 5 8 4 4 4v14c4 0 6.5 1 8 2.5M12 6.5C13.5 5 16 4 20 4v14c-4 0-6.5 1-8 2.5M12 6.5v13" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h1 class="font-heading font-extrabold text-3xl text-[#5C4033]">JURNAL GURU</h1>
                <p class="text-[13px] font-medium text-[#7A6A60] text-center">
                    Sistem Jurnal Mengajar &amp; Verifikasi Kehadiran
                </p>
            </div>

            {{-- Form Card --}}
            <div class="w-full bg-white rounded-[10px] shadow-[0px_4px_8px_rgba(62,48,40,0.05)] p-5 flex flex-col gap-4">

                <h2 class="font-heading font-semibold text-base text-[#3E3028]">
                    Masuk menggunakan akun Anda.
                </h2>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-md p-3">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf

                    {{-- Username --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-xs font-semibold text-[#7A6A60]">
                            Nama Pengguna
                        </label>
                        <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus
                            placeholder=""
                            class="w-full h-10 px-3 border border-[#E5D8CC] rounded-lg text-sm text-[#3E3028] placeholder-[#B7A99C] focus:outline-none focus:ring-2 focus:ring-[#5C4033]/30">
                    </div>

                    {{-- Password --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="text-xs font-semibold text-[#7A6A60]">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                placeholder=""
                                class="w-full h-10 px-3 pr-10 border border-[#E5D8CC] rounded-lg text-sm text-[#3E3028] placeholder-[#7A6A60] focus:outline-none focus:ring-2 focus:ring-[#5C4033]/30">
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2">
                                <svg id="eye-icon" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="#7A6A60" stroke-width="2">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="12" cy="12" r="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Lupa password → hubungi admin, taruh di atas tombol login --}}
                    <p class="text-xs text-center text-[#7A6A60]">
                        Lupa password?
                        <a href="#" class="font-semibold text-[#5C4033] hover:underline">
                            Hubungi admin
                        </a>
                    </p>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full h-11 flex items-center justify-center bg-[#5C4033] rounded-lg font-heading font-semibold text-sm text-white hover:bg-[#4a3329] transition">
                        Masuk
                    </button>
                </form>
            </div>

        </div>
    </div>

    {{-- Footer, nempel di paling bawah layar --}}
    <p class="text-[11px] text-[#7A6A60] text-center pb-4">
        v1.2.0 • SMK Negeri 1 Boyolangu
    </p>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>
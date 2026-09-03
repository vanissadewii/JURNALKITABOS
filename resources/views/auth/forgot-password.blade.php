<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Jurnal Guru</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">

            <h1>Lupa Password</h1>
            <p class="text-sm text-gray-600 mb-4">
                Masukkan email kamu, nanti kami kirimkan link untuk reset password.
            </p>

            @if (session('status'))
                <div class="mb-4 text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <button type="submit">Kirim Link Reset Password</button>
            </form>

            <p class="mt-4 text-sm">
                <a href="{{ route('login') }}">Kembali ke halaman login</a>
            </p>

        </div>
    </div>
</body>
</html>
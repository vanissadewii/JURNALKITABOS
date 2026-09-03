<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Jurnal Guru</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">

            <h1>Reset Password</h1>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                {{-- Token dari link reset dan email dikirim otomatis lewat $request --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
                </div>

                <div>
                    <label for="password">Password Baru</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div>
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                <button type="submit">Reset Password</button>
            </form>

        </div>
    </div>
</body>
</html>
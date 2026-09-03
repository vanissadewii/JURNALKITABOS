<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Jurnal Guru</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="min-h-screen p-8">
        <h1>Selamat datang, {{ auth()->user()->name }}!</h1>
        <p>Email: {{ auth()->user()->email }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
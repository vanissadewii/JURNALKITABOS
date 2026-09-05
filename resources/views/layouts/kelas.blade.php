<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jurnal Guru')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #F5EFE8;
            --brown: #5C4033;
            --text-dark: #3E3028;
            --text-gray: #7A6A60;
            --border: #E5D8CC;
            --accent: #D7B899;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            max-width: 430px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
            padding-bottom: 80px; /* space for bottom nav */
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 430px;
            display: flex;
            justify-content: space-around;
            background: #FFFFFF;
            border-top: 1px solid var(--border);
            padding: 8px 0;
        }
        .nav-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: var(--text-gray);
            font-size: 11px;
            font-weight: 400;
        }
        .nav-tab.active {
            color: var(--brown);
            font-weight: 600;
        }
        .nav-tab svg { width: 20px; height: 20px; }
    </style>
</head>
<body>

    <main>
        @yield('content')
    </main>

    <nav class="bottom-nav">
        <a href="{{ route('siswa.beranda') }}" class="nav-tab {{ request()->routeIs('siswa.beranda') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9M5 10v10h14V10"/></svg>
            Beranda
        </a>
        <a href="{{ route('siswa.scan') }}" class="nav-tab {{ request()->routeIs('siswa.scan') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Scan
        </a>

        <a href="{{ route('siswa.profile') }}" class="nav-tab {{ request()->routeIs('siswa.profile') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
            Profile
        </a>
    </nav>

</body>
</html>
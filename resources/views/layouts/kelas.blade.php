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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            min-height: 100%;
        }

        body {
            background: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            margin: 0;
        }

        main {
            width: 100%;
            min-height: 100vh;
            padding-bottom: 85px;
        }

        /* =========================
           BOTTOM NAVIGATION
        ========================= */

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 72px;

            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0;

            background: #FFFFFF;
            border-top: 1px solid var(--border);

            z-index: 1000;
        }

        .nav-tab {
            width: 120px;
            height: 100%;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            gap: 4px;

            text-decoration: none;
            color: var(--text-gray);

            font-size: 11px;
            font-weight: 400;

            transition: 0.2s ease;
        }

        .nav-tab.active {
            color: var(--brown);
            font-weight: 600;
        }

        .nav-tab svg {
            width: 20px;
            height: 20px;
        }

        @media (min-width: 600px) {

            main {
                max-width: 700px;
                margin: 0 auto;
                padding-bottom: 90px;
            }

            .bottom-nav {
                height: 76px;
            }

            .nav-tab {
                width: 150px;
                font-size: 12px;
            }

            .nav-tab svg {
                width: 21px;
                height: 21px;
            }
        }

        @media (min-width: 900px) {

            main {
                max-width: 900px;
                margin: 0 auto;
                padding-bottom: 100px;
            }

            .bottom-nav {
                height: 80px;
            }

            .nav-tab {
                width: 160px;
                font-size: 12px;
            }

            .nav-tab svg {
                width: 22px;
                height: 22px;
            }
        }

        @media (max-width: 430px) {

            main {
                width: 100%;
            }

            .bottom-nav {
                height: 68px;
            }

            .nav-tab {
                flex: 1;
                width: auto;
                font-size: 10px;
            }

            .nav-tab svg {
                width: 19px;
                height: 19px;
            }
        }
    </style>
</head>

<body>

    <main>
        @yield('content')
    </main>


    <!-- BOTTOM NAVIGATION -->
    <nav class="bottom-nav">

        <a href="{{ route('kelas.beranda') }}"
           class="nav-tab {{ request()->routeIs('kelas.beranda') ? 'active' : '' }}">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="M3 12l9-9 9 9"/>
                <path d="M5 10v10h14V10"/>

            </svg>

            Dasbor
        </a>


        <a href="{{ route('kelas.scan') }}"
           class="nav-tab {{ request()->routeIs('kelas.scan') ? 'active' : '' }}">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>

            </svg>

            Scan
        </a>


        <a href="{{ route('kelas.kirim-jurnal') }}"
           class="nav-tab {{ request()->routeIs('kelas.kirim-jurnal') ? 'active' : '' }}">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="M22 2L11 13"/>
                <path d="M22 2l-7 20-4-9-9-4 20-7z"/>

            </svg>

            Kirim Jurnal
        </a>


        <a href="{{ route('kelas.profile') }}"
           class="nav-tab {{ request()->routeIs('kelas.profile') ? 'active' : '' }}">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>

            </svg>

            Profil
        </a>

    </nav>

</body>
</html>
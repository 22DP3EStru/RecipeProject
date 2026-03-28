<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vecmāmiņas Receptes')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --surface: #fffdf9;
            --surface-soft: #f6efe7;
            --surface-soft-2: #efe4d6;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --success-bg: #e8eee2;
            --success-text: #667652;
            --shadow: 0 16px 40px rgba(79, 59, 42, 0.07);
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
        }

        .site-shell {
            min-height: 100vh;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 28px 20px 42px;
        }

        .hero-block {
            text-align: center;
            padding: 32px 0 18px;
            margin-bottom: 20px;
        }

        .hero-block h1 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 3.4rem;
            line-height: 1.05;
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 10px;
            letter-spacing: 0.01em;
        }

        .hero-block p {
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .nav-bar {
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 26px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 500;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: 0.02em;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 14px;
        }

        .nav-links a:hover {
            background: var(--surface-soft);
            border-color: var(--line);
            color: var(--accent);
        }

        .main-content {
            background: rgba(255, 253, 249, 0.82);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: #d7dfcc;
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: #e3c9c2;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            padding: 26px;
            margin-bottom: 22px;
            box-shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
        }

        .card-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.8rem;
            color: var(--accent);
            margin-bottom: 16px;
            text-align: center;
            font-weight: 500;
        }

        .text-center {
            text-align: center;
        }

        .grid {
            display: grid;
            gap: 18px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-top: 16px;
        }

        .stat-box {
            background: var(--surface-soft-2);
            color: var(--text);
            padding: 22px 18px;
            text-align: center;
            border: 1px solid var(--line);
        }

        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.2rem;
            font-weight: 700;
            display: block;
            margin-bottom: 6px;
            color: var(--accent);
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--muted);
        }

        .section-divider {
            border-top: 1px solid var(--line);
            margin: 26px 0;
        }

        @media (max-width: 980px) {
            .main-content {
                padding: 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }

            .hero-block h1 {
                font-size: 2.6rem;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 16px 12px 26px;
            }

            .nav-bar {
                padding: 16px;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .hero-block {
                padding: 18px 0 10px;
            }

            .hero-block h1 {
                font-size: 2.1rem;
            }

            .hero-block p {
                font-size: 0.95rem;
            }

            .main-content {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
<div class="site-shell">
    <div class="container">

        @if (!request()->is('admin*'))
            <div class="hero-block">
                <h1>Vecmāmiņas Receptes</h1>
                <p>Garšas, kas paliek atmiņā</p>
            </div>
        @endif

        @if(request()->is('admin*'))
            <div class="hero-block">
                <h1>Administrācijas panelis</h1>
                <p>Šeit vari pārvaldīt lietotājus, receptes un sistēmas saturu.</p>
            </div>
        @endif

        <nav class="nav-bar">
            <a href="{{ url('/dashboard') }}" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-links">
                <a href="{{ url('/dashboard') }}">Vadības panelis</a>
                <a href="{{ url('/recipes') }}">Receptes</a>
                <a href="{{ url('/categories') }}">Kategorijas</a>
                <a href="{{ url('/profile/recipes') }}">Manas receptes</a>
                <a href="{{ url('/profile/favorites') }}">Favorīti</a>

                @if(Auth::check() && Auth::user()->is_admin)
                    <a href="{{ url('/admin') }}">Admin</a>
                @endif

                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Iziet</button>
                    </form>
                @endauth
            </div>
        </nav>

        <div class="main-content">
            @yield('content')
        </div>

    </div>
</div>
</body>
</html>
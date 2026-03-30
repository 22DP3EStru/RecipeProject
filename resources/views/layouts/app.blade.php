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
            --danger-border: #e3c9c2;
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

        .page {
            max-width: 1450px;
            margin: 0 auto;
            padding: 28px 20px 50px;
        }

        .hero {
            padding: 18px 20px 32px;
            text-align: center;
        }

        .hero-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 4rem;
            line-height: 1.08;
            color: var(--accent);
            font-weight: 400;
            margin-bottom: 12px;
        }

        .hero-text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
            max-width: 820px;
            margin: 0 auto;
        }

        .nav-bar {
            background: rgba(255, 253, 249, 0.95);
            border: 1px solid var(--line);
            padding: 16px 22px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
            white-space: nowrap;
        }

        .nav-center {
            min-width: 0;
            display: flex;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex-wrap: nowrap;
            min-width: 0;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 9px 11px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 13.5px;
            white-space: nowrap;
            line-height: 1.2;
        }

        .nav-links a:hover {
            background: var(--surface-soft);
            border-color: var(--line);
            color: var(--accent);
        }

        .nav-links a.active {
            color: var(--accent);
            background: var(--surface-soft);
            border-color: var(--line);
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            white-space: nowrap;
        }

        .nav-user-name {
            color: var(--muted);
            font-size: 13.5px;
            font-weight: 700;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .main-content {
            background: rgba(255, 253, 249, 0.82);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            text-align: center;
            white-space: nowrap;
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

        .btn-success:hover {
            background: #dde6d3;
        }

        .btn-secondary {
            background: var(--surface-soft);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: var(--surface-soft-2);
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .btn-danger:hover {
            background: #eed6d1;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
        }

        .card-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            margin-bottom: 18px;
            text-align: center;
            font-weight: 500;
        }

        .text-center {
            text-align: center;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 18px;
        }

        .stat-box {
            background: linear-gradient(180deg, #f7f0e7 0%, #efe2d2 100%);
            color: var(--text);
            padding: 24px 16px;
            text-align: center;
            border: 1px solid var(--line);
            box-shadow: 0 8px 24px rgba(90, 69, 52, 0.05);
        }

        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.3rem;
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
            color: var(--accent-dark);
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--muted);
        }

        .list-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--line);
        }

        .list-row:last-child {
            border-bottom: 0;
        }

        .avatar,
        .emoji-box {
            height: 48px;
            width: 48px;
            background: linear-gradient(180deg, #f6efe7 0%, #ecdfd0 100%);
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--accent-dark);
            flex: 0 0 auto;
        }

        .muted {
            color: var(--muted);
            font-size: 14px;
        }

        .nowrap {
            white-space: nowrap;
        }

        .hero-icon {
            font-size: 3.7rem;
            margin-bottom: 12px;
        }

        .section-subtitle {
            color: var(--muted);
            line-height: 1.7;
            max-width: 720px;
            margin: 0 auto;
        }

        .panel-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent-dark);
            margin-bottom: 10px;
            font-size: 2.3rem;
            font-weight: 500;
        }

        .row-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        @media (max-width: 1280px) {
            .nav-bar {
                grid-template-columns: 1fr;
                justify-items: center;
                text-align: center;
            }

            .nav-center {
                width: 100%;
            }

            .nav-links {
                flex-wrap: wrap;
            }

            .nav-right {
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-user-name {
                max-width: none;
            }
        }

        @media (max-width: 980px) {
            .main-content {
                padding: 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-2,
            .grid-3 {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-links a {
                font-size: 13px;
                padding: 8px 10px;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 16px 12px 32px;
            }

            .hero {
                padding: 10px 8px 24px;
            }

            .hero-title {
                font-size: 2.3rem;
            }

            .hero-text {
                font-size: 15px;
            }

            .nav-bar {
                padding: 16px;
                gap: 14px;
            }

            .main-content,
            .card {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .list-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .nowrap {
                white-space: normal;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body>
<div class="site-shell">
    <div class="page">

        @if(request()->is('admin*'))
            <div class="hero">
                <h1 class="hero-title">Administrācijas panelis</h1>
                <p class="hero-text">Šeit vari pārvaldīt lietotājus, receptes un sistēmas saturu.</p>
            </div>
        @else
            <div class="hero">
                <h1 class="hero-title">Vecmāmiņas Receptes</h1>
                <p class="hero-text">Garšas, kas paliek atmiņā</p>
            </div>
        @endif

        <nav class="nav-bar">
            <a href="{{ url('/dashboard') }}" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-center">
                <div class="nav-links">
                    <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Vadības panelis</a>
                    <a href="{{ url('/recipes') }}" class="{{ request()->is('recipes') || request()->is('recipes/*') ? 'active' : '' }}">Receptes</a>
                    <a href="{{ url('/categories') }}" class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">Kategorijas</a>
                    <a href="{{ url('/profile/recipes') }}" class="{{ request()->is('profile/recipes') ? 'active' : '' }}">Manas receptes</a>
                    <a href="{{ url('/profile/favorites') }}" class="{{ request()->is('profile/favorites') ? 'active' : '' }}">Favorīti</a>
                    <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Kontakti</a>
                    <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">Profils</a>

                    @if(Auth::check() && Auth::user()->is_admin)
                        <a href="{{ url('/admin') }}" class="{{ request()->is('admin') || request()->is('admin/*') ? 'active' : '' }}">Administrācija</a>
                    @endif
                </div>
            </div>

            <div class="nav-right">
                @auth
                    <span class="nav-user-name">{{ Auth::user()->name }}</span>

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
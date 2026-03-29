<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Vecmāmiņas Receptes</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --card-bg: #fffdf9;
            --soft-bg: #f6efe7;
            --soft-bg-2: #efe4d6;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --tag-bg: #f2e7da;
            --tag-text: #7a5a43;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --danger-border: #e3c9c2;
            --shadow: 0 16px 40px rgba(79, 59, 42, 0.07);
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
            min-height: 100vh;
            color: var(--text);
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
            background: var(--soft-bg);
            border-color: var(--line);
            color: var(--accent);
        }

        .nav-links a.active {
            color: var(--accent);
            background: var(--soft-bg);
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
            background: rgba(255, 253, 249, 0.88);
            border: 1px solid rgba(220, 207, 193, 0.85);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 10px 30px rgba(90, 69, 52, 0.05);
        }

        .card-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            margin-bottom: 18px;
            text-align: center;
            font-weight: 500;
            letter-spacing: 0.02em;
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
            background: var(--soft-bg);
            color: var(--text);
        }

        .btn-success:hover {
            background: var(--soft-bg-2);
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
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

            .grid-2 {
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

            .main-content,
            .card {
                padding: 20px;
            }

            .nav-bar {
                padding: 16px;
                gap: 14px;
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
</head>

<body>
<div class="page">

    <div class="hero">
        <h1 class="hero-title">Administrācijas panelis</h1>
        <p class="hero-text">
            Šeit vari pārvaldīt lietotājus un receptes, kā arī redzēt jaunākās aktivitātes sistēmā.
        </p>
    </div>

    <nav class="nav-bar">
        <a class="nav-brand" href="/dashboard">Vecmāmiņas Receptes</a>

        <div class="nav-center">
            <div class="nav-links">
                <a href="/dashboard">Vadības panelis</a>
                <a href="/recipes">Receptes</a>
                <a href="/categories">Kategorijas</a>
                <a href="/profile/recipes">Manas receptes</a>
                <a href="/profile/favorites">Favorīti</a>
                <a href="/contact">Kontakti</a>
                <a href="{{ route('profile.edit') }}">Profils</a>
                <a href="/admin" class="active">Administrācija</a>
            </div>
        </div>

        <div class="nav-right">
            <span class="nav-user-name">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="btn btn-danger" type="submit">Iziet</button>
            </form>
        </div>
    </nav>

    <div class="main-content">

        <div class="card text-center">
            <div class="hero-icon">🛠️</div>
            <h2 class="panel-title">Admin Dashboard</h2>
            <p class="section-subtitle">
                Šeit vari pārvaldīt lietotājus un receptes, kā arī redzēt pēdējās aktivitātes.
            </p>
        </div>

        <div class="card">
            <h3 class="card-title">Kopsavilkums</h3>

            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-number">{{ $totalUsers }}</span>
                    <span class="stat-label">Kopā lietotāji</span>
                </div>

                <div class="stat-box">
                    <span class="stat-number">{{ $totalRecipes }}</span>
                    <span class="stat-label">Kopā receptes</span>
                </div>

                <div class="stat-box">
                    <span class="stat-number">{{ $totalAdmins }}</span>
                    <span class="stat-label">Admini</span>
                </div>

                <div class="stat-box">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Šodienas receptes</span>
                </div>
            </div>

            <div class="grid grid-2" style="margin-top: 18px;">
                @if (Route::has('admin.users'))
                    <a class="btn btn-primary" href="{{ route('admin.users') }}">Pārvaldīt lietotājus</a>
                @else
                    <a class="btn btn-primary" href="/admin/users">Pārvaldīt lietotājus</a>
                @endif

                @if (Route::has('admin.recipes'))
                    <a class="btn btn-success" href="{{ route('admin.recipes') }}">Pārvaldīt receptes</a>
                @else
                    <a class="btn btn-success" href="/admin/recipes">Pārvaldīt receptes</a>
                @endif
            </div>
        </div>

        <div class="grid grid-2">
            <div class="card">
                <h3 class="card-title">Jaunākie lietotāji</h3>

                @forelse($recentUsers as $user)
                    <div class="list-row">
                        <div class="row-left">
                            <div class="avatar">{{ strtoupper(substr($user->name ?? '—', 0, 1)) }}</div>

                            <div>
                                <div class="item-title">{{ $user->name ?? '—' }}</div>
                                <div class="muted">{{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="muted nowrap">{{ $user->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                @empty
                    <div class="muted">Nav lietotāju.</div>
                @endforelse
            </div>

            <div class="card">
                <h3 class="card-title">Jaunākās receptes</h3>

                @forelse($recentRecipes as $recipe)
                    <div class="list-row">
                        <div class="row-left">
                            <div class="emoji-box">🍽️</div>

                            <div>
                                <div class="item-title">{{ $recipe->title ?? $recipe->name ?? '—' }}</div>
                                <div class="muted">Autors: {{ $recipe->user->name ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="muted nowrap">{{ $recipe->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                @empty
                    <div class="muted">Nav recepšu.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
</body>
</html>
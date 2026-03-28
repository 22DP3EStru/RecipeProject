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
            --bg: #ebe4da;
            --bg-soft: #f6f1ea;
            --card: #fffdf9;
            --card-2: #f2e8dc;
            --text: #2f241d;
            --muted: #7a6b61;
            --line: #dccfc1;
            --accent: #9d7a5b;
            --accent-dark: #6e5038;
            --shadow: 0 18px 40px rgba(90, 69, 52, 0.08);
            --radius-lg: 28px;
            --radius-md: 18px;
            --radius-sm: 12px;
        }

        body {
            font-family: Georgia, "Times New Roman", serif;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.45), transparent 30%),
                linear-gradient(180deg, #ede6dc 0%, #e6ddd2 100%);
            min-height: 100vh;
            color: var(--text);
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 28px 20px 40px;
        }

        .header {
            text-align: center;
            padding: 18px 0 22px;
            margin-bottom: 18px;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            color: var(--text);
            margin-bottom: 8px;
        }

        .header p {
            font-size: 1rem;
            color: var(--muted);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .nav-bar {
            background: rgba(255, 253, 249, 0.92);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(220, 207, 193, 0.85);
            border-radius: 999px;
            padding: 14px 20px;
            margin-bottom: 28px;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .nav-brand {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.02em;
        }

        .nav-links {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            transition: 0.25s ease;
            font-weight: 600;
            font-size: 14px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            border: 1px solid transparent;
        }

        .nav-links a:hover {
            background: var(--card-2);
            border-color: var(--line);
            color: var(--accent-dark);
        }

        .main-content {
            background: rgba(255, 253, 249, 0.88);
            border: 1px solid rgba(220, 207, 193, 0.85);
            border-radius: 34px;
            padding: 34px;
            box-shadow: var(--shadow);
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 10px 30px rgba(90, 69, 52, 0.05);
        }

        .card-title {
            font-size: 1.6rem;
            color: var(--text);
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
            border-radius: 24px;
            text-align: center;
            border: 1px solid var(--line);
            box-shadow: 0 8px 24px rgba(90, 69, 52, 0.05);
        }

        .stat-number {
            font-size: 2.3rem;
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
            color: var(--accent-dark);
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--muted);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn {
            display: inline-block;
            padding: 13px 18px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            text-align: center;
            transition: 0.25s ease;
            border: 1px solid var(--line);
            cursor: pointer;
            font-size: 14px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--accent-dark);
            color: #fffaf5;
            border-color: var(--accent-dark);
        }

        .btn-primary:hover {
            background: #5f442f;
        }

        .btn-success {
            background: #ede2d4;
            color: var(--text);
        }

        .btn-success:hover {
            background: #e6d8c8;
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

        .pill-admin {
            display: inline-block;
            margin-top: 6px;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 999px;
            background: #f1e2d3;
            color: var(--accent-dark);
            font-weight: 700;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .avatar,
        .emoji-box {
            height: 48px;
            width: 48px;
            border-radius: 16px;
            background: linear-gradient(180deg, #f6efe7 0%, #ecdfd0 100%);
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--accent-dark);
            flex: 0 0 auto;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .muted {
            opacity: 1;
            color: var(--muted);
            font-size: 14px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .panel-title {
            color: var(--accent-dark);
            margin-bottom: 10px;
            font-size: 2rem;
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
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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

            .nav-bar {
                border-radius: 24px;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 18px 14px 28px;
            }

            .header h1 {
                font-size: 2.2rem;
            }

            .header p {
                font-size: 0.9rem;
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
</head>

<body>
<div class="container">

    <div class="header">
        <h1>Vecmāmiņas Receptes</h1>
        <p>Administrēšana</p>
    </div>

    <div class="nav-bar">
        <a class="nav-brand" href="/dashboard">🍽️ Vecmāmiņas Receptes</a>

        <div class="nav-links">
            <a href="/dashboard">🏠 Vadības panelis</a>
            <a href="/recipes">🍽️ Receptes</a>
            <a href="/categories">📂 Kategorijas</a>
            <a href="/profile/recipes">📝 Manas receptes</a>
            <a href="/profile/favorites">❤️ Favorīti</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="btn btn-primary" type="submit" style="padding: 10px 14px; font-size: 13px;">Iziet</button>
            </form>
        </div>
    </div>

    <div class="main-content">

        <div class="card text-center">
            <div class="hero-icon">🛠️</div>
            <h2 class="panel-title">Admin Dashboard</h2>
            <p class="section-subtitle">
                Šeit vari pārvaldīt lietotājus un receptes, kā arī redzēt pēdējās aktivitātes.
            </p>
        </div>

        <div class="card">
            <h3 class="card-title">📊 Kopsavilkums</h3>

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
                <h3 class="card-title">👤 Jaunākie lietotāji</h3>

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
                <h3 class="card-title">🍽️ Jaunākās receptes</h3>

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
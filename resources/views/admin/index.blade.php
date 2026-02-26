<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Vecmāmiņas Receptes</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 22px;
            padding: 22px 0 8px;
        }

        .header h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.25);
        }
        .header p { font-size: 1.1rem; opacity: 0.92; }

        .nav-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 16px 18px;
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.10);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .nav-brand {
            font-size: 20px;
            font-weight: 800;
            color: #667eea;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }

        .nav-links a {
            color: #333;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            transition: all 0.25s ease;
            font-weight: 600;
            font-size: 14px;
        }

        .nav-links a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 34px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.22);
        }

        .card {
            background: rgba(255, 255, 255, 0.86);
            border-radius: 15px;
            padding: 26px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.30);
        }

        .card-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 16px;
            text-align: center;
            font-weight: 800;
        }

        .text-center { text-align: center; }

        .grid { display: grid; gap: 18px; }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-top: 16px;
        }

        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 22px 18px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
        }

        .stat-number { font-size: 2.2rem; font-weight: 900; display: block; margin-bottom: 6px; }
        .stat-label { font-size: 0.95rem; opacity: 0.95; }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            text-align: center;
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
        }

        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); color: white; }

        .list-row {
            display:flex;
            justify-content:space-between;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .list-row:last-child { border-bottom: 0; }

        .pill-admin {
            display:inline-block;
            margin-top: 6px;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(245,87,108,0.14);
            color:#f5576c;
            font-weight: 900;
        }

        .avatar {
            height: 42px;
            width: 42px;
            border-radius: 50%;
            background: rgba(102,126,234,0.15);
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight: 900;
            color:#667eea;
            flex: 0 0 auto;
        }

        .emoji-box {
            height: 42px;
            width: 42px;
            border-radius: 12px;
            background: rgba(240,147,251,0.18);
            display:flex;
            align-items:center;
            justify-content:center;
            flex: 0 0 auto;
        }

        .muted { opacity: 0.75; font-size: 14px; }
        .nowrap { white-space: nowrap; }

        @media (max-width: 900px) {
            .main-content { padding: 22px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .grid-2 { grid-template-columns: 1fr; }
            .grid-3 { grid-template-columns: 1fr; }
        }

        @media (max-width: 520px) {
            .header h1 { font-size: 1.8rem; }
            .header p { font-size: 1rem; }
            .nav-bar { padding: 14px; }
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

            {{-- Ja tev ir cits logout maršruts, nomaini action --}}
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="btn btn-primary" type="submit" style="padding: 8px 12px; font-size: 13px;">Iziet</button>
            </form>
        </div>
    </div>

    <div class="main-content">

        <div class="card text-center">
            <div style="font-size: 3.5rem; margin-bottom: 10px;">🛠️</div>
            <h2 style="color: #667eea; margin-bottom: 10px; font-weight: 900;">Admin Dashboard</h2>
            <p class="muted" style="line-height: 1.6;">
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

            <div class="grid grid-2" style="margin-top: 16px;">
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
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div class="avatar">{{ strtoupper(substr($user->name ?? '—', 0, 1)) }}</div>

                            <div>
                                <div style="font-weight: 900;">{{ $user->name ?? '—' }}</div>
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
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div class="emoji-box">🍽️</div>

                            <div>
                                <div style="font-weight: 900;">{{ $recipe->title ?? $recipe->name ?? '—' }}</div>
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
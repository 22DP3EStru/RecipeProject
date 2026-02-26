<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vecmāmiņas Receptes')</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }

        /* COOL TITLE ABOVE NAV */
        .header {
            text-align: center;
            color: white;
            margin-bottom: 22px;
            padding: 34px 0 10px;
        }
        .header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .header p { font-size: 1.2rem; opacity: 0.92; }

        /* NAV */
        .nav-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 18px 20px;
            margin-bottom: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .nav-brand {
            font-size: 22px;
            font-weight: 900;
            color: #667eea;
            text-decoration: none;
        }
        .nav-links { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
        .nav-links a {
            color: #333;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 10px;
            transition: all 0.25s ease;
            font-weight: 400;
        }
        .nav-links a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        /* MAIN WHITE WRAPPER */
        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 34px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* COMPONENT CLASSES YOUR PAGES USE */
        .card {
            background: rgba(255, 255, 255, 0.86);
            border-radius: 15px;
            padding: 26px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .card-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 16px;
            text-align: center;
            font-weight: 900;
        }
        .text-center { text-align: center; }

        .grid { display: grid; gap: 18px; }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }

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
            font-weight: 900;
            text-align: center;
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
        }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); color: white; }

        @media (max-width: 900px) {
            .main-content { padding: 22px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .grid-2 { grid-template-columns: 1fr; }
            .header h1 { font-size: 2.2rem; }
        }
    </style>
</head>

<body>
<div class="container">

   @if (!request()->is('admin*'))
    <div class="purple-background">
        <h1>Vecmāmiņas Receptes</h1>
        <p>Garšas, kas paliek atmiņā</p>
    </div>
@endif
@if(request()->is('admin*'))
    <div style="text-align:center; color:white; padding: 60px 0;">
        <h1 style="font-size: 3.2rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.25);">
            🛠️ Administrācijas panelis
        </h1>
        <p style="font-size: 1.2rem; opacity: 0.95; margin-top: 10px;">
            Šeit vari pārvaldīt lietotājus un receptes, kā arī redzēt pēdējās aktivitātes.
        </p>
    </div>
@endif

    <nav class="nav-bar">
        <a href="{{ url('/dashboard') }}" class="nav-brand">🍽️ Vecmāmiņas Receptes</a>

        <div class="nav-links">
            <a href="{{ url('/dashboard') }}">🏠 Vadības panelis</a>
            <a href="{{ url('/recipes') }}">🍽️ Receptes</a>
            <a href="{{ url('/categories') }}">📂 Kategorijas</a>
            <a href="{{ url('/profile/recipes') }}">📝 Manas receptes</a>
            <a href="{{ url('/profile/favorites') }}">❤️ Favorīti</a>

            @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ url('/admin') }}">🛠️ Admin</a>
            @endif

            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="padding: 8px 12px; font-size: 13px;">Iziet</button>
                </form>
            @endauth
        </div>
    </nav>

    <div class="main-content">
        @yield('content')
    </div>

</div>
</body>
</html>
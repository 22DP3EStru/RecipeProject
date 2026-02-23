<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mani favorīti - Vecmāmiņas Receptes</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height:100vh;
            color:#333;
        }

        .container { max-width:1200px; margin:0 auto; padding:20px; }

        .header {
            text-align:center;
            color:white;
            margin-bottom:40px;
            padding:40px 0;
        }

        .header h1 {
            font-size:3rem;
            margin-bottom:15px;
            text-shadow:2px 2px 4px rgba(0,0,0,0.3);
        }

        .nav-bar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius:15px;
            padding:20px;
            margin-bottom:30px;
            box-shadow:0 8px 32px rgba(0,0,0,0.1);
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
        }

        .nav-links {
            display:flex;
            gap:20px;
            flex-wrap:wrap;
        }

        .nav-links a {
            color:#333;
            text-decoration:none;
            padding:8px 16px;
            border-radius:8px;
            transition:all .3s ease;
            font-weight:500;
        }

        .nav-links a:hover {
            background:#667eea;
            color:white;
        }

        .card {
            background: rgba(255,255,255,0.9);
            border-radius:15px;
            padding:20px;
            box-shadow:0 8px 25px rgba(0,0,0,0.1);
            transition: transform .2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            display:inline-block;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:600;
            border:none;
            cursor:pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg,#667eea,#764ba2);
            color:white;
        }

        .btn-danger {
            background: linear-gradient(135deg,#ff416c,#ff4b2b);
            color:white;
        }

        .grid {
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap:25px;
        }

        .empty-box {
            background: rgba(255,255,255,0.9);
            padding:40px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 8px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>❤️ Mani favorīti</h1>
        <p>Visas receptes, kas tev ir iepatikušās</p>
    </div>

    <nav class="nav-bar">
        <div class="nav-links">
            <a href="/dashboard">🏠 Vadības panelis</a>
            <a href="/recipes">🍽️ Receptes</a>
            <a href="/profile/recipes">📝 Manas receptes</a>
            <a href="{{ route('profile.edit') }}">⚙️ Profils</a>
        </div>

        <a href="/recipes" class="btn btn-primary">🔍 Atrast jaunas receptes</a>
    </nav>

    @if($recipes->count() > 0)

        <div class="grid">
            @foreach($recipes as $recipe)
                <div class="card">
                    <h3 style="color:#667eea; margin-bottom:10px;">
                        {{ $recipe->title }}
                    </h3>

                    <p style="color:#666; font-size:14px; margin-bottom:15px;">
                        {{ Str::limit($recipe->description, 100) }}
                    </p>

                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                            Skatīt →
                        </a>

                        <form method="POST"
                              action="{{ route('recipes.favorite.toggle', $recipe) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                💔 Noņemt
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top:30px;">
            {{ $recipes->links() }}
        </div>

    @else

        <div class="empty-box">
            <h2 style="margin-bottom:15px;">Tev vēl nav favorītu</h2>
            <p style="margin-bottom:20px; color:#666;">
                Atver kādu recepti un nospied ❤️ sirsniņu.
            </p>

            <a href="/recipes" class="btn btn-primary">
                Pārlūkot receptes
            </a>
        </div>

    @endif

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receptes.lv</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', sans-serif; background: #fff8f0; color: #2d2d2d; margin: 0; }
        header { background:rgb(253, 141, 186); color: #fff; padding: 1.5rem 0; text-align: center; }
        .container { max-width: 900px; margin: 2rem auto; padding: 1rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; }
        h1 { margin-top: 0; }
        .news { background: #fff2f2; border-left: 4px solid #f53003; padding: 1rem; margin-bottom: 2rem; border-radius: 4px; }
        .recipes { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; }
        .recipe { background: #fdfdfc; border-radius: 6px; box-shadow: 0 1px 4px #0001; padding: 1rem; }
        .recipe img { width: 100%; border-radius: 6px; }
        .recipe h3 { margin: 0.5rem 0 0.25rem 0; }
        .recipe p { margin: 0; font-size: 0.95em; color: #555; }
        .login-links { text-align: right; margin-bottom: 1rem; }
        .btn {
            display: inline-block;
            background: #f53003;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 0.5rem 1.2rem;
            margin-left: 1rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #c41e00;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Receptes.lv</h1>
        <p>Garšīgas un pārbaudītas receptes katrai dienai!</p>
    </header>
    <div class="container">
        <div class="login-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn">Mans profils</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Pieslēgties</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn">Reģistrēties</a>
                    @endif
                @endauth
            @endif
        </div>
        <section class="news">
            <h2>Aktualitātes</h2>
            <ul>
                <li>🍓 Jauna zemeņu kūkas recepte!</li>
                <li>🥗 Vasaras salātu idejas karstām dienām.</li>
                <li>🍰 Konkursā uzvarēja Māras medus kūka – apsveicam!</li>
            </ul>
        </section>
        <section>
            <h2>Populārākās receptes</h2>
            <div class="recipes">
                <div class="recipe">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" alt="Zemeņu kūka">
                    <h3>Zemeņu kūka</h3>
                    <p>Svaiga, gaisīga un ļoti garšīga kūka ar zemenēm. Pagatavošana – 45 minūtes.</p>
                </div>
                <div class="recipe">
                    <img src="https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?auto=format&fit=crop&w=400&q=80" alt="Vasaras salāti">
                    <h3>Vasaras salāti</h3>
                    <p>Ātri un veselīgi salāti ar gurķiem, tomātiem un fetas sieru.</p>
                </div>
                <div class="recipe">
                    <img src="https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80" alt="Medus kūka">
                    <h3>Medus kūka</h3>
                    <p>Klasiska latviešu medus kūka ar bagātīgu krēmu. Pagatavošana – 1h 20min.</p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
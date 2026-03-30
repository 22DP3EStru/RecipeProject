<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vadības panelis - Vecmāmiņas Receptes</title>
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
            --success-bg: #edf3e7;
            --success-text: #667652;
            --warning-bg: #f3e8e3;
            --warning-text: #9a6b56;
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
            background: rgba(255, 253, 249, 0.78);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .section-block + .section-block {
            margin-top: 28px;
        }

        .intro-box,
        .stats-box,
        .actions-box,
        .recipes-box,
        .empty-box,
        .tips-box {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 28px;
        }

        .intro-box {
            text-align: center;
        }

        .intro-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
        }

        .intro-box h2,
        .section-title,
        .recipe-card h4,
        .my-recipe-card h4,
        .tip-card h4,
        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-weight: 500;
        }

        .intro-box h2 {
            font-size: 2.3rem;
            margin-bottom: 12px;
        }

        .intro-box p,
        .section-subtext,
        .muted-text {
            color: var(--muted);
            line-height: 1.8;
        }

        .section-title {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.9rem;
        }

        .section-subtext {
            margin-bottom: 22px;
        }

        .grid {
            display: grid;
            gap: 22px;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
            font-family: inherit;
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
            border-color: #d8e1cf;
        }

        .btn-warning {
            background: var(--warning-bg);
            color: var(--warning-text);
            border-color: #e2ccc1;
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 18px;
        }

        .stat-box {
            background: var(--soft-bg);
            border: 1px solid var(--line);
            padding: 26px 22px;
            text-align: center;
        }

        .stat-number {
            font-size: 2.8rem;
            display: block;
            margin-bottom: 10px;
            line-height: 1;
        }

        .stat-label {
            font-size: 15px;
            color: var(--muted);
            font-weight: 700;
            line-height: 1.6;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .recipe-card,
        .my-recipe-card,
        .tip-card {
            background: var(--soft-bg);
            border: 1px solid var(--line);
            padding: 22px;
            transition: 0.2s ease;
        }

        .recipe-card:hover,
        .my-recipe-card:hover,
        .tip-card:hover {
            background: #fffaf5;
        }

        .recipe-card h4,
        .my-recipe-card h4,
        .tip-card h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .recipe-description {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .recipe-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            font-size: 13px;
            color: var(--muted);
        }

        .my-recipe-card {
            background: var(--success-bg);
            border-color: #d8e1cf;
        }

        .my-recipe-date {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .my-recipe-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .my-recipe-actions .btn {
            flex: 1;
        }

        .empty-box {
            text-align: center;
            padding: 50px 28px;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .empty-box h4 {
            color: var(--accent);
            margin-bottom: 15px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 500;
        }

        .tip-card {
            height: 100%;
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

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
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

            .nav-bar {
                padding: 16px;
                gap: 14px;
            }

            .main-content,
            .intro-box,
            .stats-box,
            .actions-box,
            .recipes-box,
            .empty-box,
            .tips-box {
                padding: 20px;
            }

            .grid-2,
            .grid-3,
            .stats-grid,
            .actions-grid,
            .recipe-grid {
                grid-template-columns: 1fr;
            }

            .my-recipe-actions {
                flex-direction: column;
            }

            .actions-grid .btn,
            .recipe-card .btn,
            .my-recipe-actions .btn {
                width: 100%;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
<div class="page">
    <div class="hero">
        <h1 class="hero-title">Sveicināti atpakaļ!</h1>
        <p class="hero-text">
            Jūsu kulinārais ceļojums turpinās, {{ Auth::user()->name }}.
        </p>
    </div>

    <nav class="nav-bar">
        <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

        <div class="nav-center">
            <div class="nav-links">
                <a href="/dashboard" class="active">Vadības panelis</a>
                <a href="/recipes">Receptes</a>
                <a href="/categories">Kategorijas</a>
                <a href="/profile/recipes">Manas receptes</a>
                <a href="/profile/favorites">Favorīti</a>
                <a href="/contact">Kontakti</a>
                <a href="{{ route('profile.edit') }}">Profils</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">Administrācija</a>
                @endif
            </div>
        </div>

        <div class="nav-right">
            <span class="nav-user-name">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Iziet</button>
            </form>
        </div>
    </nav>

    <div class="main-content">
        <div class="section-block intro-box">
            <div class="intro-icon">👨‍🍳</div>
            <h2>Sveicināti jūsu kulinārijas studijā</h2>
            <p>
                Esiet gatavi radīt, dalīties un atklāt brīnišķīgas receptes. Jūsu nākamā iecienītākā recepte ir tikai dažu klikšķu attālumā.
            </p>
        </div>

        @if(Auth::user()->is_admin)
            <div class="section-block actions-box">
                <h3 class="section-title">🛠 Administrācija</h3>
                <p class="section-subtext">
                    Piekļuve administrācijas panelim un platformas pārvaldības statistikām.
                </p>

                <div class="actions-grid">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">Atvērt administrācijas paneli</a>
                </div>
            </div>
        @endif

        <div class="section-block stats-box">
            <h3 class="section-title">📊 Jūsu kulinārijas statistika</h3>
            <p class="section-subtext">
                Īss pārskats par jūsu aktivitāti un kopējo platformas saturu.
            </p>

            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::where('user_id', Auth::id())->count() }}</span>
                    <span class="stat-label">Jūsu receptes</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                    <span class="stat-label">Kopā receptes</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\User::count() }}</span>
                    <span class="stat-label">Kopienas dalībnieki</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', today())->count() }}</span>
                    <span class="stat-label">Šodienas receptes</span>
                </div>
            </div>
        </div>

        <div class="section-block actions-box">
            <h3 class="section-title">🚀 Ātras darbības</h3>
            <p class="section-subtext">
                Ātrākā piekļuve biežāk izmantotajām sadaļām un darbībām.
            </p>

            <div class="actions-grid">
                <a href="/recipes/create" class="btn btn-success">Izveidot jaunu recepti</a>
                <a href="/recipes" class="btn btn-primary">Pārlūkot visas receptes</a>
                <a href="/categories" class="btn btn-warning">Apskatīt kategorijas</a>
                <a href="/profile/recipes" class="btn btn-danger">Manas receptes</a>
                <a href="/profile/favorites" class="btn btn-primary">Mani favorīti</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Kontakti</a>
            </div>
        </div>

        @php
            $recentRecipes = \App\Models\Recipe::with('user')->latest()->limit(4)->get();
        @endphp

        @if($recentRecipes->count() > 0)
            <div class="section-block recipes-box">
                <h3 class="section-title">🕒 Jaunākās receptes</h3>
                <p class="section-subtext">
                    Pēdējās pievienotās receptes no kopienas.
                </p>

                <div class="recipe-grid">
                    @foreach($recentRecipes as $recipe)
                        <div class="recipe-card">
                            <h4>{{ $recipe->title }}</h4>
                            <p class="recipe-description">{{ Str::limit($recipe->description, 80) }}</p>
                            <div class="recipe-meta">
                                <span>Autors: {{ $recipe->user->name }}</span>
                                <span>{{ $recipe->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary">Skatīt recepti</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @php
            $myRecentRecipes = \App\Models\Recipe::where('user_id', Auth::id())->latest()->limit(3)->get();
        @endphp

        @if($myRecentRecipes->count() > 0)
            <div class="section-block recipes-box">
                <h3 class="section-title">📝 Jūsu jaunākās receptes</h3>
                <p class="section-subtext">
                    Pēdējie jūsu izveidotie ieraksti ar ātru piekļuvi apskatei un rediģēšanai.
                </p>

                <div class="grid grid-3">
                    @foreach($myRecentRecipes as $recipe)
                        <div class="my-recipe-card">
                            <h4>{{ $recipe->title }}</h4>
                            <p class="recipe-description">{{ Str::limit($recipe->description, 60) }}</p>
                            <div class="my-recipe-date">
                                Izveidots: {{ $recipe->created_at->diffForHumans() }}
                            </div>
                            <div class="my-recipe-actions">
                                <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary">Skatīt</a>
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">Rediģēt</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="section-block empty-box">
                <div class="empty-icon">📝</div>
                <h4>Jūs vēl neesat izveidojis nevienu recepti</h4>
                <p class="muted-text" style="margin-bottom: 25px;">
                    Sāciet savu kulinārijas ceļojumu, izveidojot savu pirmo recepti.
                </p>
                <a href="/recipes/create" class="btn btn-success">Izveidot pirmo recepti</a>
            </div>
        @endif

        <div class="section-block tips-box">
            <h3 class="section-title">💡 Padomi un ieteikumi</h3>
            <p class="section-subtext">
                Daži noderīgi ieteikumi ērtākai platformas izmantošanai.
            </p>

            <div class="grid grid-2">
                <div class="tip-card">
                    <h4>Efektīva meklēšana</h4>
                    <p class="muted-text">
                        Izmantojiet meklēšanas filtrus, lai atrastu receptes pēc kategorijas, grūtības līmeņa vai sastāvdaļām.
                    </p>
                </div>

                <div class="tip-card">
                    <h4>Recepšu rakstīšana</h4>
                    <p class="muted-text">
                        Iekļaujiet detalizētas instrukcijas un precīzas sastāvdaļas, lai citi varētu viegli sekot jūsu receptei.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
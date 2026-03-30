<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mani favorīti - Vecmāmiņas Receptes</title>
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
            --info-bg: #f2e7da;
            --info-text: #7a5a43;
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

        .section-wrap {
            background: rgba(255, 253, 249, 0.78);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .section-block + .section-block {
            margin-top: 28px;
        }

        .profile-intro {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 30px;
            text-align: center;
        }

        .profile-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
        }

        .profile-intro h2 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2.3rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .profile-intro p {
            color: var(--muted);
            line-height: 1.8;
            max-width: 760px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 24px;
            text-align: center;
        }

        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.6rem;
            color: var(--accent);
            margin-bottom: 8px;
            line-height: 1;
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        .actions-bar {
            text-align: center;
        }

        .actions-row {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .recipe-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
        }

        .recipe-top {
            padding: 24px 24px 16px;
            border-bottom: 1px solid #e8ddd1;
            background: #fcf9f4;
        }

        .recipe-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 1.8rem;
            line-height: 1.2;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .recipe-desc {
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        .recipe-body {
            padding: 20px 24px 24px;
        }

        .recipe-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 16px;
            color: var(--muted);
            font-size: 14px;
        }

        .recipe-footer {
            border-top: 1px solid var(--line);
            padding-top: 14px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        .recipe-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .recipe-actions form {
            margin: 0;
        }

        .recipe-actions .btn,
        .recipe-actions button {
            width: 100%;
            padding: 10px;
            font-size: 13px;
        }

        .pagination-wrap {
            margin-top: 36px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
            display: flex;
            justify-content: center;
        }

        .empty-state {
            text-align: center;
            padding: 70px 20px;
            background: var(--card-bg);
            border: 1px solid var(--line);
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 18px;
        }

        .empty-state h3 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .empty-state p {
            color: var(--muted);
            line-height: 1.8;
            margin-bottom: 26px;
            max-width: 760px;
            margin-left: auto;
            margin-right: auto;
        }

        .tips-box {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 28px;
        }

        .tips-box h3 {
            text-align: center;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
        }

        .tip-card {
            border: 1px solid var(--line);
            padding: 20px;
            background: var(--soft-bg);
        }

        .tip-card h4 {
            color: var(--accent);
            margin-bottom: 10px;
            font-size: 16px;
        }

        .tip-card p {
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
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

            .section-wrap {
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

            .section-wrap {
                padding: 20px;
            }

            .recipes-grid {
                grid-template-columns: 1fr;
            }

            .recipe-actions {
                grid-template-columns: 1fr;
            }

            .recipe-info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div class="page">

        <div class="hero">
            <h1 class="hero-title">Mani favorīti</h1>
            <p class="hero-text">
                Šeit vari pārvaldīt savas saglabātās receptes, ātri tās atvērt un noņemt no favorītiem.
            </p>
        </div>

        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-center">
                <div class="nav-links">
                    <a href="/dashboard">Vadības panelis</a>
                    <a href="/recipes">Receptes</a>
                    <a href="/categories">Kategorijas</a>
                    <a href="/profile/recipes">Manas receptes</a>
                    <a href="/profile/favorites" class="active">Favorīti</a>
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

        <div class="section-wrap">

            <div class="section-block profile-intro">
                <div class="profile-icon">❤️</div>
                <h2>{{ Auth::user()->name }} favorītu kolekcija</h2>
                <p>
                    Šeit redzamas receptes, kuras esi saglabājis savos favorītos. Vari tās ātri pārskatīt,
                    atvērt pilno recepti un vajadzības gadījumā noņemt no saraksta.
                </p>
            </div>

            <div class="section-block stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ method_exists($recipes, 'total') ? $recipes->total() : $recipes->count() }}</div>
                    <div class="stat-label">Kopā favorīti</div>
                </div>

                <div class="stat-card">
                    <div class="stat-number">
                        {{ $recipes->filter(function($recipe) { return $recipe->created_at && $recipe->created_at >= now()->subDays(30); })->count() }}
                    </div>
                    <div class="stat-label">Pievienotas šomēnes</div>
                </div>

                <div class="stat-card">
                    <div class="stat-number">
                        {{ $recipes->filter(function($recipe) { return !empty($recipe->category_id) || !empty($recipe->category); })->unique('category_id')->count() }}
                    </div>
                    <div class="stat-label">Kategorijas</div>
                </div>
            </div>

            <div class="section-block actions-bar">
                <div class="actions-row">
                    <a href="/recipes" class="btn btn-primary">
                        Pārlūkot visas receptes
                    </a>
                    <a href="/profile/recipes" class="btn btn-secondary">
                        Skatīt manas receptes
                    </a>
                </div>
            </div>

            @if($recipes->count() > 0)
                <div class="section-block">
                    <div class="recipes-grid">
                        @foreach($recipes as $recipe)
                            <div class="recipe-card">
                                <div class="recipe-top">
                                    <h3 class="recipe-title">{{ $recipe->title }}</h3>
                                    <p class="recipe-desc">{{ Str::limit($recipe->description, 100) }}</p>
                                </div>

                                <div class="recipe-body">
                                    <div class="recipe-info-grid">
                                        <div>👤 {{ $recipe->user->name ?? 'Nav norādīts' }}</div>
                                        <div>📂 {{ $recipe->category->name ?? $recipe->category ?? 'Nav kategorijas' }}</div>

                                        @if($recipe->prep_time || $recipe->cook_time)
                                            <div>⏱️ {{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} min</div>
                                        @endif

                                        @if($recipe->servings)
                                            <div>👥 {{ $recipe->servings }} porcijas</div>
                                        @endif
                                    </div>

                                    <div class="recipe-footer">
                                        Pievienota: {{ $recipe->created_at ? $recipe->created_at->format('d.m.Y H:i') : '-' }}
                                    </div>

                                    <div class="recipe-actions">
                                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                            Skatīt
                                        </a>

                                        <form method="POST" action="{{ route('recipes.favorite.toggle', $recipe) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                Noņemt
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrap">
                        {{ $recipes->links() }}
                    </div>
                </div>
            @else
                <div class="section-block empty-state">
                    <div class="icon">🤍</div>
                    <h3>Tev vēl nav saglabātu favorītu</h3>
                    <p>
                        Kad pie receptes nospiedīsi sirsniņu, tā parādīsies šajā sadaļā un būs ērti pieejama jebkurā laikā.
                    </p>
                    <a href="/recipes" class="btn btn-success">
                        Atrast receptes
                    </a>
                </div>
            @endif

            @if((method_exists($recipes, 'total') ? $recipes->total() : $recipes->count()) < 5)
                <div class="section-block tips-box">
                    <h3>Idejas favorītu izmantošanai</h3>
                    <div class="tips-grid">
                        <div class="tip-card">
                            <h4>📌 Saglabā labākās receptes</h4>
                            <p>Pievieno favorītiem receptes, kuras vēlies pagatavot atkārtoti vai izmēģināt tuvākajā laikā.</p>
                        </div>

                        <div class="tip-card">
                            <h4>🗂️ Veido savu izlasi</h4>
                            <p>Saglabā dažādu kategoriju receptes, lai būtu vieglāk atrast idejas brokastīm, pusdienām vai desertiem.</p>
                        </div>

                        <div class="tip-card">
                            <h4>👨‍🍳 Atgriezies pie iemīļotajām</h4>
                            <p>Favorītu saraksts ļauj ātri piekļūt receptēm, kuras tev patīk visvairāk un kuras gatavo biežāk.</p>
                        </div>

                        <div class="tip-card">
                            <h4>💡 Plāno maltītes</h4>
                            <p>Izmanto favorītus kā savu personīgo recepšu izlasi, lai ērtāk plānotu nedēļas ēdienkarti.</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</body>
</html>
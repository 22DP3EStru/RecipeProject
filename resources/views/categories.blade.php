<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorijas - Vecmāmiņas Receptes</title>
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
        .summary-box,
        .category-card,
        .recipe-card,
        .stats-box,
        .empty-box,
        .breadcrumbs-box {
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
        .summary-box h2,
        .stats-box h3,
        .empty-box h3 {
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
        .summary-box p,
        .empty-box p {
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

        .breadcrumbs-box {
            padding: 16px 20px;
            background: var(--soft-bg);
        }

        .breadcrumbs-box a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
        }

        .breadcrumbs-box span {
            color: var(--muted);
        }

        .summary-box {
            text-align: center;
            background: var(--soft-bg);
        }

        .summary-box h2 {
            margin-bottom: 14px;
            font-size: 2rem;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 22px;
        }

        .category-card {
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: 0.2s ease;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--soft-bg-2);
        }

        .category-card:hover,
        .recipe-card:hover,
        .stat-item:hover {
            background: #fffaf5;
        }

        .category-breakfast::before { background: linear-gradient(90deg, #d6a06d 0%, #c97a5c 100%); }
        .category-lunch::before { background: linear-gradient(90deg, #88a78c 0%, #6e8f73 100%); }
        .category-dinner::before { background: linear-gradient(90deg, #9b856f 0%, #7a5a43 100%); }
        .category-dessert::before { background: linear-gradient(90deg, #c9a2a5 0%, #b97b82 100%); }
        .category-drinks::before { background: linear-gradient(90deg, #8ea8b8 0%, #6f8fa6 100%); }
        .category-snacks::before { background: linear-gradient(90deg, #a8b487 0%, #829364 100%); }
        .category-salads::before { background: linear-gradient(90deg, #9fb58f 0%, #7e9b71 100%); }
        .category-soups::before { background: linear-gradient(90deg, #c79a72 0%, #b98252 100%); }
        .category-default::before { background: linear-gradient(90deg, #bfae9b 0%, #a18974 100%); }

        .category-icon {
            font-size: 3.8rem;
            margin-bottom: 18px;
        }

        .category-title {
            color: var(--accent);
            margin-bottom: 14px;
            font-size: 1.7rem;
            font-family: Georgia, "Times New Roman", serif;
            font-weight: 500;
        }

        .category-description {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 20px;
            min-height: 72px;
        }

        .category-stats {
            background: var(--soft-bg);
            border: 1px solid var(--line);
            padding: 18px;
            margin-bottom: 18px;
            text-align: left;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 13px;
            line-height: 1.5;
        }

        .stats-row:last-child {
            margin-bottom: 0;
        }

        .stats-label {
            color: var(--muted);
            font-weight: 600;
        }

        .stats-value {
            color: var(--text);
            font-weight: 800;
            text-align: right;
        }

        .pdf-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .pdf-btn {
            display: inline-block;
            padding: 10px 14px;
            font-size: 13px;
            line-height: 1.2;
            text-decoration: none;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            color: var(--text);
            transition: 0.2s ease;
            font-weight: 700;
        }

        .pdf-btn:hover {
            background: var(--soft-bg-2);
        }

        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
        }

        .recipe-card {
            transition: 0.2s ease;
        }

        .recipe-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .recipe-card h3 {
            color: var(--accent);
            font-size: 1.5rem;
            font-family: Georgia, "Times New Roman", serif;
            font-weight: 500;
            line-height: 1.2;
        }

        .badge {
            padding: 6px 10px;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            color: var(--accent);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .recipe-description {
            color: var(--muted);
            margin-bottom: 16px;
            line-height: 1.7;
            font-size: 14px;
        }

        .recipe-meta-row,
        .recipe-meta-row-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 14px;
            font-size: 13px;
        }

        .recipe-meta-pill {
            background: var(--soft-bg);
            border: 1px solid var(--line);
            color: var(--accent);
            padding: 6px 10px;
            font-weight: 700;
            font-size: 12px;
        }

        .recipe-author,
        .recipe-date {
            color: var(--muted);
            font-weight: 600;
        }

        .stats-box {
            background: var(--soft-bg);
        }

        .stats-box h3 {
            text-align: center;
            margin-bottom: 24px;
            font-size: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 22px;
            background: var(--card-bg);
            border: 1px solid var(--line);
            transition: 0.2s ease;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 6px;
            font-family: Georgia, "Times New Roman", serif;
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .stat-extra {
            color: var(--success-text);
            font-weight: 700;
            margin-top: 6px;
            font-size: 13px;
        }

        .empty-box {
            text-align: center;
            padding: 60px 28px;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .empty-box h3 {
            margin-bottom: 15px;
            font-size: 2rem;
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
            .summary-box,
            .category-card,
            .recipe-card,
            .stats-box,
            .empty-box,
            .breadcrumbs-box {
                padding: 20px;
            }

            .categories-grid,
            .recipes-grid,
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .pdf-actions,
            .recipe-card-top,
            .recipe-meta-row,
            .recipe-meta-row-bottom {
                flex-direction: column;
                align-items: stretch;
            }

            .pdf-actions a,
            .category-card .btn,
            .recipe-card .btn {
                width: 100%;
            }

            .stats-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-value {
                text-align: left;
            }
        }
    </style>
        <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
</head>
<body>
    @php
        $categories = \App\Models\Recipe::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $totalRecipes = \App\Models\Recipe::count();

        $descriptions = [
            'Brokastis' => 'Sāciet dienu ar garšīgām un barojošām brokastīm',
            'Pusdienas' => 'Sātīgi ēdieni dienas vidum un enerģijas uzpildīšanai',
            'Vakariņas' => 'Eleganti vakariņu ēdieni romantiski vai ģimenes vakariem',
            'Deserti' => 'Saldi kārumi un deserti īpašiem brīžiem',
            'Dzērieni' => 'Atspirdzinošie dzērieni un kokteiļi visām gaumēm',
            'Uzkodas' => 'Ātri un garšīgi uzkožamie visos dzīves brīžos',
            'Salāti' => 'Svaigi un veselīgi salāti pilni ar vitamīniem',
            'Zupas' => 'Siltas un mājīgas zupas aukstajiem vakariem'
        ];
    @endphp

    <div class="page">
        <div class="hero">
            <h1 class="hero-title">Kategorijas</h1>
            <p class="hero-text">
                Atklājiet daudzveidīgo recepšu pasauli un pārlūkojiet ēdienus pēc sev interesējošajām kategorijām.
            </p>
        </div>

        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-center">
                <div class="nav-links">
                    <a href="/dashboard">Vadības panelis</a>
                    <a href="/recipes">Receptes</a>
                    <a href="{{ route('categories.index') }}" class="active">Kategorijas</a>
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
            <div class="section-block breadcrumbs-box">
                <a href="/dashboard">Vadības panelis</a>
                <span> / </span>
                <span>Kategorijas</span>
            </div>

            <div class="section-block intro-box">
                <div class="intro-icon">📂</div>
                <h2>Recepšu kategoriju pārskats</h2>
                <p>
                    Izvēlieties kategoriju, lai apskatītu tajā pieejamās receptes, autorus un aktualitātes. Šeit vienuviet redzams arī īss statistikas pārskats.
                </p>
            </div>

            <div class="section-block summary-box">
                <h2>{{ $categories->count() }} kategorijas pieejamas</h2>
                <p>
                    Kopā {{ $totalRecipes }} receptes sadalītas {{ $categories->count() }} dažādās kategorijās.
                    Izvēlieties kategoriju, lai atklātu sev piemērotākās receptes.
                </p>
            </div>

            @if($categories->count() > 0)
                <div class="section-block">
                    <h3 class="section-title">📋 Pieejamās kategorijas</h3>
                    <p class="section-subtext">
                        Katra kategorija ietver savu recepšu skaitu, aktivitāti un autoru daudzveidību.
                    </p>

                    <div class="categories-grid">
                        @foreach($categories as $category)
                            @php
                                $categoryName = $category;

                                $totalCategoryRecipes = \App\Models\Recipe::where('category', $categoryName)->count();

                                $recentRecipes = \App\Models\Recipe::where('category', $categoryName)
                                    ->where('created_at', '>=', now()->subDays(7))
                                    ->count();

                                $popularAuthors = \App\Models\Recipe::where('category', $categoryName)
                                    ->with('user')
                                    ->get()
                                    ->groupBy('user_id')
                                    ->count();

                                $categoryClass = match(mb_strtolower($categoryName)) {
                                    'brokastis' => 'category-breakfast',
                                    'pusdienas' => 'category-lunch',
                                    'vakariņas' => 'category-dinner',
                                    'deserti' => 'category-dessert',
                                    'dzērieni' => 'category-drinks',
                                    'uzkodas' => 'category-snacks',
                                    'salāti' => 'category-salads',
                                    'zupas' => 'category-soups',
                                    default => 'category-default'
                                };
                            @endphp

                            <div class="category-card {{ $categoryClass }}">
                                <div class="category-icon">
                                    @switch($categoryName)
                                        @case('Brokastis')
                                            🍳
                                            @break
                                        @case('Pusdienas')
                                            🍽️
                                            @break
                                        @case('Vakariņas')
                                            🌙
                                            @break
                                        @case('Deserti')
                                            🍰
                                            @break
                                        @case('Dzērieni')
                                            🥤
                                            @break
                                        @case('Uzkodas')
                                            🥨
                                            @break
                                        @case('Salāti')
                                            🥗
                                            @break
                                        @case('Zupas')
                                            🍲
                                            @break
                                        @default
                                            🍴
                                    @endswitch
                                </div>

                                <h3 class="category-title">{{ $categoryName }}</h3>

                                <p class="category-description">
                                    {{ $descriptions[$categoryName] ?? "Atklājiet garšīgas {$categoryName} receptes šajā sadaļā" }}
                                </p>

                                <div class="category-stats">
                                    <div class="stats-row">
                                        <span class="stats-label">Kopā recepšu</span>
                                        <span class="stats-value">{{ $totalCategoryRecipes }}</span>
                                    </div>
                                    <div class="stats-row">
                                        <span class="stats-label">Jaunas šonedēļ</span>
                                        <span class="stats-value">{{ $recentRecipes }}</span>
                                    </div>
                                    <div class="stats-row">
                                        <span class="stats-label">Dažādi autori</span>
                                        <span class="stats-value">{{ $popularAuthors }}</span>
                                    </div>
                                    <div class="stats-row">
                                        <span class="stats-label">Popularitāte</span>
                                        <span class="stats-value">
                                            @if($totalCategoryRecipes >= 20)
                                                Ļoti populāra
                                            @elseif($totalCategoryRecipes >= 10)
                                                Populāra
                                            @elseif($totalCategoryRecipes >= 5)
                                                Aktīva
                                            @else
                                                Augošā
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="pdf-actions">
                                    <a href="{{ route('pdf.category.recipes.byname', urlencode($categoryName)) }}" class="pdf-btn">
                                        Kategorijas PDF
                                    </a>
                                </div>

                                <a href="{{ route('categories.show', urlencode($categoryName)) }}" class="btn btn-primary" style="width: 100%;">
                                    Skatīt {{ $totalCategoryRecipes }} {{ $totalCategoryRecipes == 1 ? 'recepti' : 'receptes' }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="section-block empty-box">
                    <div class="empty-icon">📂</div>
                    <h3>Nav kategoriju</h3>
                    <p>
                        Vēl nav izveidota neviena recepte ar kategoriju.
                    </p>
                    <div style="margin-top: 24px;">
                        <a href="/recipes/create" class="btn btn-primary">
                            Izveidot pirmo recepti
                        </a>
                    </div>
                </div>
            @endif

            @if($recipes->count() > 0)
                <div class="section-block">
                    <h3 class="section-title">🕒 Jaunākās receptes no visām kategorijām</h3>
                    <p class="section-subtext">
                        Pēdējās pievienotās receptes, lai ātri apskatītu jaunāko saturu platformā.
                    </p>

                    <div class="recipes-grid">
                        @foreach($recipes->sortByDesc('created_at')->take(6) as $recipe)
                            <div class="recipe-card">
                                <div class="recipe-card-top">
                                    <h3>{{ $recipe->title }}</h3>
                                    <span class="badge">JAUNA</span>
                                </div>

                                <p class="recipe-description">
                                    {{ Str::limit($recipe->description, 100) }}
                                </p>

                                <div class="recipe-meta-row">
                                    <span class="recipe-meta-pill">{{ $recipe->category ?? 'Nav norādīta' }}</span>
                                    <span class="recipe-author">{{ $recipe->user->name }}</span>
                                </div>

                                <div class="recipe-meta-row-bottom">
                                    <span class="recipe-meta-pill">{{ $recipe->difficulty ?? 'N/A' }}</span>
                                    <span class="recipe-date">{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>

                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="width: 100%;">
                                    Skatīt recepti
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div style="text-align: center; margin-top: 28px;">
                        <a href="/recipes" class="btn btn-primary" style="min-width: 260px;">
                            Skatīt visas {{ $totalRecipes }} receptes
                        </a>
                    </div>
                </div>
            @endif

            <div class="section-block stats-box">
                <h3>📊 Kategoriju statistika</h3>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon">🏆</div>
                        <div class="stat-value">
                            @php
                                $topCategory = $categories->map(function($cat) {
                                    return [
                                        'name' => $cat,
                                        'count' => \App\Models\Recipe::where('category', $cat)->count()
                                    ];
                                })->sortByDesc('count')->first();
                            @endphp
                            {{ $topCategory['name'] ?? 'Nav' }}
                        </div>
                        <div class="stat-label">Populārākā kategorija</div>
                        <div class="stat-extra">{{ $topCategory['count'] ?? 0 }} receptes</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">📈</div>
                        <div class="stat-value">{{ $totalRecipes }}</div>
                        <div class="stat-label">Kopā receptes</div>
                        <div class="stat-extra">Visās kategorijās</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">👥</div>
                        <div class="stat-value">{{ \App\Models\User::has('recipes')->count() }}</div>
                        <div class="stat-label">Aktīvi autori</div>
                        <div class="stat-extra">Kopš sākuma</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
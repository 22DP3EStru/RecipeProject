<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $categoryName ?? 'Kategorija' }} - Vecmāmiņas Receptes</title>
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

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .section-wrap {
            background: rgba(255, 253, 249, 0.78);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .section-intro {
            margin-bottom: 28px;
        }

        .section-intro p {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .category-summary {
            display: inline-block;
            padding: 16px 20px;
            background: var(--soft-bg);
            border: 1px solid var(--line);
            color: var(--text);
        }

        .category-summary strong {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 1.6rem;
            font-weight: 500;
            margin-right: 8px;
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
            font-size: 1.9rem;
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

        .recipe-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 14px;
        }

        .recipe-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .difficulty {
            display: inline-block;
            padding: 6px 12px;
            background: var(--tag-bg);
            color: var(--tag-text);
            border: 1px solid var(--line);
            font-size: 12px;
            font-weight: 700;
        }

        .created-time {
            color: var(--muted);
            font-size: 12px;
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
        }

        .empty-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .other-categories {
            margin-top: 42px;
            padding-top: 26px;
            border-top: 1px solid var(--line);
        }

        .other-categories h3 {
            text-align: center;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            margin-bottom: 22px;
            font-weight: 500;
        }

        .category-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .category-tags a {
            display: inline-block;
            padding: 10px 16px;
            background: var(--soft-bg);
            color: var(--accent);
            text-decoration: none;
            border: 1px solid var(--line);
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .category-tags a:hover {
            background: var(--soft-bg-2);
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
            .section-wrap {
                padding: 24px;
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
        }
    </style>
        <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
</head>
<body>
    <div class="page">

        <div class="hero">
            <h1 class="hero-title">{{ $categoryName ?? 'Kategorija' }}</h1>
            <p class="hero-text">
                Pārlūkojiet visas receptes kategorijā "{{ $categoryName ?? 'Nezināma kategorija' }}" un atrodiet idejas savām nākamajām maltītēm.
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
                    @auth
                        <a href="/profile/favorites">Favorīti</a>
                        <a href="{{ route('profile.edit') }}">Profils</a>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.index') }}">Administrācija</a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="nav-right">
                @auth
                    <span class="nav-user-name">{{ Auth::user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Iziet</button>
                    </form>
                @endauth
            </div>
        </nav>

        <div class="section-wrap">
            <div class="breadcrumb">
                <a href="{{ route('categories.index') }}">Kategorijas</a>
                <span> / </span>
                <span style="font-weight: 700; color: var(--text);">{{ $categoryName ?? 'Kategorija' }}</span>
            </div>

            <div class="section-intro">
                <p>
                    Šajā sadaļā atradīsiet visas receptes, kas pievienotas kategorijai "{{ $categoryName ?? 'Nezināma kategorija' }}".
                </p>

                <div class="category-summary">
                    <strong>
                        {{ isset($recipes) ? (method_exists($recipes, 'total') ? $recipes->total() : $recipes->count()) : 0 }}
                    </strong>
                    {{
                        (isset($recipes) ? (method_exists($recipes, 'total') ? $recipes->total() : $recipes->count()) : 0) == 1
                        ? 'recepte'
                        : 'receptes'
                    }}
                </div>
            </div>

            @if(isset($recipes) && $recipes->count() > 0)
                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <div class="recipe-top">
                                <h3 class="recipe-title">{{ $recipe->title }}</h3>
                                <p class="recipe-desc">
                                    {{ Str::limit($recipe->description, 100) }}
                                </p>
                            </div>

                            <div class="recipe-body">
                                <div class="recipe-row">
                                    <span>{{ $recipe->user->name ?? 'Nezināms' }}</span>
                                    <span>{{ $recipe->prep_time ?? 'N/A' }} min</span>
                                </div>

                                <div class="recipe-meta">
                                    <span class="difficulty">{{ $recipe->difficulty ?? 'N/A' }}</span>
                                    <span class="created-time">{{ $recipe->created_at ? $recipe->created_at->diffForHumans() : '' }}</span>
                                </div>

                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="width: 100%; text-align: center;">
                                    Skatīt recepti
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $recipes->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="icon">🍽️</div>
                    <h3>Nav recepšu šajā kategorijā</h3>
                    <p>
                        Kategorijā "{{ $categoryName ?? 'Nezināma kategorija' }}" vēl nav pievienota neviena recepte.
                    </p>
                    <div class="empty-actions">
                        <a href="/recipes/create" class="btn btn-primary">
                            Izveidot jaunu recepti
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            Atpakaļ uz kategorijām
                        </a>
                    </div>
                </div>
            @endif

            @if(isset($allCategories) && $allCategories->count() > 1)
                <div class="other-categories">
                    <h3>Citas kategorijas</h3>
                    <div class="category-tags">
                        @foreach($allCategories as $cat)
                            @if($cat != ($categoryName ?? ''))
                                <a href="{{ route('categories.show', urlencode($cat)) }}">
                                    {{ $cat }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pārlūkot receptes - Vecmāmiņas Receptes</title>
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
            max-width: 1280px;
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
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            flex-wrap: wrap;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            min-width: 240px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
        }

        .nav-user-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        .nav-right {
            display: flex;
            flex: 1;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
            min-width: 320px;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 14px;
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
        .search-box,
        .result-box,
        .empty-box,
        .pagination-box {
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

        .intro-box h2 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2.3rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .intro-box p {
            color: var(--muted);
            line-height: 1.8;
            max-width: 760px;
            margin: 0 auto;
        }

        .section-title {
            color: var(--accent);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            font-weight: 500;
        }

        .section-subtext {
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 16px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            font-weight: 700;
            color: var(--text);
            font-size: 15px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--line);
            font-size: 15px;
            background: #fffdfa;
            color: var(--text);
            transition: 0.2s ease;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #bba692;
            background: #fff;
        }

        .search-actions {
            margin-top: 16px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pdf-btn {
            display: inline-block;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .pdf-btn:hover {
            background: var(--soft-bg-2);
        }

        .result-box {
            text-align: center;
            background: var(--soft-bg);
        }

        .result-box h3 {
            color: var(--accent);
            margin-bottom: 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 500;
        }

        .result-box p {
            color: var(--muted);
            line-height: 1.7;
        }

        .top-actions {
            text-align: center;
        }

        .top-actions .btn {
            min-width: 240px;
        }

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
            gap: 22px;
        }

        .recipe-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 24px;
            transition: 0.2s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .recipe-card:hover {
            background: #fffaf5;
        }

        .recipe-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 1.7rem;
            font-weight: 500;
            margin-bottom: 14px;
            line-height: 1.2;
        }

        .recipe-description {
            color: var(--muted);
            margin-bottom: 18px;
            line-height: 1.7;
            flex-grow: 1;
        }

        .recipe-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 14px;
            margin-bottom: 16px;
            font-size: 14px;
            color: var(--muted);
        }

        .rating-row {
            margin: 6px 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            padding: 12px 14px;
            background: var(--soft-bg);
            border: 1px solid var(--line);
        }

        .rating-value {
            font-weight: 700;
            color: var(--text);
        }

        .rating-count {
            color: var(--muted);
        }

        .rating-stars {
            margin-left: auto;
            color: #b9872f;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .author-row {
            border-top: 1px solid var(--line);
            padding-top: 15px;
            margin-bottom: 18px;
        }

        .author-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 13px;
            color: var(--muted);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 10px 14px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-weight: 700;
            transition: 0.2s ease;
        }

        .pagination a:hover {
            background: var(--soft-bg);
            color: var(--accent);
        }

        .pagination .current,
        .pagination .active span {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
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
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            margin-bottom: 15px;
            font-size: 2rem;
            font-weight: 500;
        }

        .empty-box p {
            color: var(--muted);
            margin-bottom: 30px;
            line-height: 1.8;
            max-width: 620px;
            margin-left: auto;
            margin-right: auto;
        }

        .empty-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 980px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
            }

            .form-grid {
                grid-template-columns: 1fr 1fr;
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
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-right {
                min-width: 100%;
                justify-content: flex-start;
            }

            .nav-links {
                justify-content: flex-start;
            }

            .main-content,
            .intro-box,
            .search-box,
            .result-box,
            .empty-box,
            .pagination-box {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .recipe-meta {
                grid-template-columns: 1fr;
            }

            .rating-stars {
                margin-left: 0;
                width: 100%;
            }

            .empty-actions {
                flex-direction: column;
            }

            .empty-actions .btn,
            .top-actions .btn,
            .recipe-card .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="page">

    <div class="hero">
        <h1 class="hero-title">Pārlūkot receptes</h1>
        <p class="hero-text">
            Atklājiet gardas, iedvesmojošas un kopienas veidotas receptes ikdienai, svētkiem un īpašiem mirkļiem.
        </p>
    </div>

    <nav class="nav-bar">
        <div class="nav-left">
            <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-user-row">
                <span>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Iziet</button>
                </form>
            </div>
        </div>

        <div class="nav-right">
            <div class="nav-links">
                <a href="/dashboard">Vadības panelis</a>
                <a href="/recipes" class="active">Receptes</a>
                <a href="/categories">Kategorijas</a>
                <a href="/profile/recipes">Manas receptes</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">Administrācija</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="main-content">

        <div class="section-block intro-box">
            <div class="intro-icon">🔍</div>
            <h2>Atrodiet savu nākamo recepti</h2>
            <p>
                Izmantojiet meklēšanu un filtrus, lai ātri atrastu piemērotākās receptes pēc nosaukuma, kategorijas vai grūtības līmeņa.
            </p>
        </div>

        <div class="section-block search-box">
            <h3 class="section-title">📋 Meklēšana un filtri</h3>
            <p class="section-subtext">
                Atlasiet receptes pēc sev svarīgākajiem kritērijiem un, ja nepieciešams, izdrukājiet atlasīto sarakstu.
            </p>

            <form method="GET" action="{{ route('recipes.index') }}">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Meklēt receptes</label>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-input"
                            placeholder="Meklēt pēc nosaukuma, apraksta vai sastāvdaļām..."
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategorija</label>
                        <select name="category" class="form-select">
                            <option value="">Visas kategorijas</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Grūtība</label>
                        <select name="difficulty" class="form-select">
                            <option value="">Jebkura</option>
                            <option value="Viegla" {{ request('difficulty') == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                            <option value="Vidēja" {{ request('difficulty') == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                            <option value="Grūta" {{ request('difficulty') == 'Grūta' ? 'selected' : '' }}>Grūta</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Meklēt</button>
                </div>

                @if(request()->hasAny(['search', 'category', 'difficulty', 'max_time']))
                    <div class="search-actions">
                        <a href="{{ route('recipes.index') }}" class="btn btn-warning">
                            Notīrīt filtrus
                        </a>

                        <a href="{{ route('pdf.filtered.recipes', request()->query()) }}" class="pdf-btn">
                            Drukāt atlasīto
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <div class="section-block result-box">
            <h3>📊 Atrasts {{ $recipes->total() }} recepšu rezultāts</h3>

            @if(request()->hasAny(['search', 'category', 'difficulty', 'max_time']))
                <p>
                    Filtrēti rezultāti:
                    @if(request('search')) meklēšana "{{ request('search') }}" @endif
                    @if(request('category')) | kategorija "{{ request('category') }}" @endif
                    @if(request('difficulty')) | grūtība "{{ request('difficulty') }}" @endif
                    @if(request('max_time')) | max laiks "{{ request('max_time') }} min" @endif
                </p>
            @else
                <p>
                    Šeit redzams pilns pieejamo recepšu saraksts no kopienas.
                </p>
            @endif
        </div>

        <div class="section-block top-actions">
            <a href="{{ route('recipes.create') }}" class="btn btn-success">
                Pievienot jaunu recepti
            </a>
        </div>

        @if($recipes->count() > 0)
            <div class="section-block">
                <div class="recipe-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <h3 class="recipe-title">{{ $recipe->title }}</h3>

                            <p class="recipe-description">
                                {{ Str::limit($recipe->description, 100) }}
                            </p>

                            <div class="recipe-meta">
                                <div>📂 {{ $recipe->category ?? 'Nav kategorijas' }}</div>
                                <div>⭐ {{ $recipe->difficulty ?? 'Nav norādīta' }}</div>
                                @if($recipe->prep_time || $recipe->cook_time)
                                    <div>⏱️ {{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} min</div>
                                @endif
                                @if($recipe->servings)
                                    <div>👥 {{ $recipe->servings }} porcijas</div>
                                @endif
                            </div>

                            <div class="rating-row">
                                <span class="rating-value">
                                    {{ $recipe->reviews_avg_rating ? round($recipe->reviews_avg_rating, 1) : 'Nav vērtējumu' }} / 5
                                </span>

                                <span class="rating-count">
                                    ({{ $recipe->reviews_count }})
                                </span>

                                <span class="rating-stars">
                                    @php $r = (int) round($recipe->reviews_avg_rating ?? 0); @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        {!! $i <= $r ? '★' : '☆' !!}
                                    @endfor
                                </span>
                            </div>

                            <div class="author-row">
                                <div class="author-meta">
                                    <span>Autors: {{ $recipe->user->name }}</span>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                Skatīt recepti
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="section-block pagination-box">
                <div class="pagination">
                    {{ $recipes->links() }}
                </div>
            </div>
        @else
            <div class="section-block empty-box">
                <div class="empty-icon">🔎</div>
                <h3>Nav atrasta neviena recepte</h3>
                <p>
                    Mēģiniet mainīt meklēšanas kritērijus vai pievienojiet jaunu recepti, lai papildinātu kolekciju ar savu ideju.
                </p>

                <div class="empty-actions">
                    <a href="{{ route('recipes.index') }}" class="btn btn-warning">Skatīt visas receptes</a>
                    <a href="{{ route('recipes.create') }}" class="btn btn-success">Izveidot jaunu recepti</a>
                </div>
            </div>
        @endif

    </div>
</div>
</body>
</html>
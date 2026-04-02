@extends('layouts.app')

@section('title', 'Kategorijas - Vecmāmiņas Receptes')
@section('meta_description', 'Atklājiet daudzveidīgo recepšu pasauli un pārlūkojiet ēdienus pēc sev interesējošajām kategorijām.')

@section('hero_title', 'Kategorijas')
@section('hero_text', 'Atklājiet daudzveidīgo recepšu pasauli un pārlūkojiet ēdienus pēc sev interesējošajām kategorijām.')

@section('content')
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
        'Vakariņas' => 'Eleganti vakariņu ēdieni romantiskiem vai ģimenes vakariem',
        'Deserti' => 'Saldi kārumi un deserti īpašiem brīžiem',
        'Dzērieni' => 'Atspirdzinoši dzērieni un kokteiļi visām gaumēm',
        'Uzkodas' => 'Ātri un garšīgi uzkožamie visos dzīves brīžos',
        'Salāti' => 'Svaigi un veselīgi salāti pilni ar vitamīniem',
        'Zupas' => 'Siltas un mājīgas zupas vēsākiem vakariem'
    ];
@endphp

<style>
    .categories-page {
        color: var(--text);
    }

    .categories-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .categories-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .categories-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .categories-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .categories-hero-icon-wrap {
        width: 108px;
        height: 108px;
        border-radius: 50%;
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        border: 4px solid #f0e5d8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.8rem;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        flex-shrink: 0;
    }

    .categories-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid rgba(122, 90, 67, 0.12);
        background: #f5ece2;
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .categories-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
    }

    .categories-main-text {
        color: var(--muted);
        line-height: 1.85;
        font-size: 14px;
        max-width: 820px;
    }

    .breadcrumbs-card {
        padding: 16px 20px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
    }

    .breadcrumbs-card a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 800;
    }

    .breadcrumbs-card span {
        color: var(--muted);
    }

    .summary-card {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        text-align: center;
    }

    .summary-card h2 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        margin-bottom: 14px;
        font-size: 2rem;
        font-weight: 500;
    }

    .summary-card p {
        color: var(--muted);
        line-height: 1.8;
        max-width: 820px;
        margin: 0 auto;
    }

    .section-head {
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    .section-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #f5ece2;
        border: 1px solid rgba(122, 90, 67, 0.12);
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .section-title {
        color: var(--accent);
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
        line-height: 1.1;
    }

    .section-subtext {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
        max-width: 760px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 22px;
    }

    .category-card {
        position: relative;
        overflow: hidden;
        background: #fffdf9;
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 22px;
        padding: 24px;
        transition: 0.2s ease;
        box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
    }

    .category-card:hover,
    .recipe-card:hover,
    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
    }

    .category-card::before {
        content: '';
        position: absolute;
        inset: 0 0 auto 0;
        height: 5px;
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
        font-size: 3.4rem;
        margin-bottom: 16px;
    }

    .category-title {
        color: var(--accent);
        margin-bottom: 12px;
        font-size: 1.7rem;
        font-family: Georgia, "Times New Roman", serif;
        font-weight: 500;
        line-height: 1.15;
    }

    .category-description {
        font-size: 14px;
        color: var(--muted);
        line-height: 1.75;
        margin-bottom: 18px;
        min-height: 72px;
    }

    .category-stats {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
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
        font-weight: 700;
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

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 22px;
    }

    .recipe-card {
        background: #fffdf9;
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 22px;
        padding: 24px;
        transition: 0.2s ease;
        box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
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
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 999px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        color: var(--accent);
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .recipe-description {
        color: var(--muted);
        margin-bottom: 16px;
        line-height: 1.75;
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
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 999px;
        color: var(--accent);
        padding: 6px 10px;
        font-weight: 800;
        font-size: 12px;
    }

    .recipe-author,
    .recipe-date {
        color: var(--muted);
        font-weight: 700;
    }

    .stats-box {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
    }

    .stats-box h3 {
        text-align: center;
        margin-bottom: 24px;
        font-size: 2rem;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 22px;
        background: #fffdf9;
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 20px;
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
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
        line-height: 1.15;
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
        background: linear-gradient(180deg, #fbf5ee 0%, #f4eadf 100%);
        border: 1px dashed rgba(122, 90, 67, 0.24);
        border-radius: 24px;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .empty-box h3 {
        margin-bottom: 15px;
        font-size: 2rem;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .empty-box p {
        color: var(--muted);
        line-height: 1.8;
        max-width: 700px;
        margin: 0 auto;
    }

    @media (max-width: 980px) {
        .categories-section-card {
            padding: 22px;
        }

        .categories-hero-inner {
            grid-template-columns: 1fr;
        }

        .categories-hero-icon-wrap {
            width: 92px;
            height: 92px;
            font-size: 2.4rem;
        }
    }

    @media (max-width: 640px) {
        .categories-section-card {
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

        .categories-main-title {
            font-size: 2rem;
        }
    }
</style>

<div class="categories-page">
    <div class="categories-stack">

        <div class="categories-section-card breadcrumbs-card">
            <a href="/dashboard">Vadības panelis</a>
            <span> / </span>
            <span>Kategorijas</span>
        </div>

        <div class="categories-section-card categories-hero-card">
            <div class="categories-hero-inner">
                <div class="categories-hero-icon-wrap">📂</div>

                <div>
                    <div class="categories-badge">Recepšu pasaule</div>
                    <h2 class="categories-main-title">Recepšu kategoriju pārskats</h2>
                    <p class="categories-main-text">
                        Izvēlieties kategoriju, lai apskatītu tajā pieejamās receptes, autorus un aktualitātes.
                        Šeit vienuviet redzams arī īss statistikas pārskats.
                    </p>
                </div>
            </div>
        </div>

        <div class="categories-section-card summary-card">
            <h2>{{ $categories->count() }} kategorijas pieejamas</h2>
            <p>
                Kopā {{ $totalRecipes }} receptes sadalītas {{ $categories->count() }} dažādās kategorijās.
                Izvēlieties kategoriju, lai atklātu sev piemērotākās receptes.
            </p>
        </div>

        @if($categories->count() > 0)
            <div class="categories-section-card">
                <div class="section-head">
                    <div class="section-kicker">Pieejamās kategorijas</div>
                    <h3 class="section-title">Pārlūkojiet pēc kategorijas</h3>
                    <p class="section-subtext">
                        Katra kategorija ietver savu recepšu skaitu, aktivitāti un autoru daudzveidību.
                    </p>
                </div>

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
                                    @case('Brokastis') 🍳 @break
                                    @case('Pusdienas') 🍽️ @break
                                    @case('Vakariņas') 🌙 @break
                                    @case('Deserti') 🍰 @break
                                    @case('Dzērieni') 🥤 @break
                                    @case('Uzkodas') 🥨 @break
                                    @case('Salāti') 🥗 @break
                                    @case('Zupas') 🍲 @break
                                    @default 🍴
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
                                <a href="{{ route('pdf.category.recipes.byname', urlencode($categoryName)) }}" class="btn btn-secondary">
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
            <div class="categories-section-card empty-box">
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
            <div class="categories-section-card">
                <div class="section-head">
                    <div class="section-kicker">Jaunākais saturs</div>
                    <h3 class="section-title">Jaunākās receptes no visām kategorijām</h3>
                    <p class="section-subtext">
                        Pēdējās pievienotās receptes, lai ātri apskatītu jaunāko saturu platformā.
                    </p>
                </div>

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

        <div class="categories-section-card stats-box">
            <h3>Kategoriju statistika</h3>

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
@endsection
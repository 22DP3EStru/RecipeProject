@extends('layouts.app')

@section('title', 'Pārlūkot receptes - Vecmāmiņas Receptes')
@section('meta_description', 'Pārlūkojiet kopienas receptes, izmantojiet meklēšanu un filtrus, lai atrastu piemērotāko ēdienu jebkurai situācijai.')

@section('hero_title', 'Pārlūkot receptes')
@section('hero_text', 'Atklājiet gardas, iedvesmojošas un kopienas veidotas receptes ikdienai, svētkiem un īpašiem mirkļiem.')

@section('content')
<style>
    .recipes-index-page {
        color: var(--text);
    }

    .recipes-index-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .recipes-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        overflow: hidden;
    }

    .recipes-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
    }

    .recipes-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .recipes-hero-icon-wrap {
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

    .recipes-badge {
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

    .recipes-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
        word-break: break-word;
    }

    .recipes-main-text {
        color: var(--muted);
        line-height: 1.85;
        font-size: 14px;
        max-width: 820px;
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

    .filters-form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 16px;
        align-items: end;
    }

    .form-group {
        margin-bottom: 0;
        min-width: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: var(--text);
        font-size: 14px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--line);
        border-radius: 14px;
        font-size: 15px;
        background: #fffdfa;
        color: var(--text);
        transition: 0.2s ease;
        font-family: inherit;
        box-shadow: inset 0 1px 2px rgba(79, 59, 42, 0.02);
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
    }

    .filters-submit-btn {
        min-width: 140px;
    }

    .filters-extra-actions {
        margin-top: 16px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .results-summary-card {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        text-align: center;
    }

    .results-summary-title {
        color: var(--accent);
        margin-bottom: 10px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
        word-break: break-word;
    }

    .results-summary-text {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
    }

    .actions-center {
        text-align: center;
    }

    .actions-center .btn {
        min-width: 240px;
    }

    .recipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 22px;
    }

    .recipe-card {
        background: #fffdf9;
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
        transition: 0.2s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .recipe-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
    }

    .recipe-card-top {
        padding: 24px 24px 16px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
    }

    .recipe-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.8rem;
        font-weight: 500;
        margin-bottom: 12px;
        line-height: 1.16;
        word-break: break-word;
    }

    .recipe-description {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
    }

    .recipe-card-body {
        padding: 20px 24px 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .recipe-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .recipe-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: 46px;
        padding: 10px 12px;
        border-radius: 14px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        color: var(--muted);
        font-size: 13px;
        line-height: 1.5;
        min-width: 0;
    }

    .recipe-meta-item span:last-child {
        word-break: break-word;
    }

    .recipe-meta-icon {
        font-size: 1rem;
        flex-shrink: 0;
    }

    .rating-row {
        margin: 4px 0 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        padding: 12px 14px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 16px;
    }

    .rating-value {
        font-weight: 800;
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
        border-top: 1px solid rgba(221, 207, 192, 0.9);
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
        line-height: 1.6;
    }

    .pagination-box {
        text-align: center;
    }

    .pagination-summary {
        margin-bottom: 18px;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.6;
    }

    .pagination-box nav {
        display: flex;
        justify-content: center;
    }

    .pagination-box nav > div:first-child {
        display: none;
    }

    .pagination-box svg {
        width: 18px;
        height: 18px;
    }

    .pagination-box .relative.z-0.inline-flex.shadow-sm.rounded-md,
    .pagination-box .inline-flex.-space-x-px.rounded-md.shadow-sm {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        box-shadow: none !important;
    }

    .pagination-box .relative.inline-flex.items-center,
    .pagination-box .inline-flex.items-center {
        padding: 10px 14px;
        text-decoration: none;
        border: 1px solid var(--line);
        border-radius: 12px;
        background: #fff;
        color: var(--text);
        font-weight: 700;
        transition: 0.2s ease;
        min-width: 44px;
        justify-content: center;
    }

    .pagination-box a.relative.inline-flex.items-center:hover,
    .pagination-box a.inline-flex.items-center:hover {
        background: var(--surface-soft);
        color: var(--accent);
        transform: translateY(-1px);
    }

    .pagination-box span[aria-current="page"] > span,
    .pagination-box .text-white {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
        color: #fffaf4 !important;
    }

    .pagination-box .text-gray-500,
    .pagination-box .text-gray-400 {
        color: var(--muted) !important;
    }

    .empty-box {
        text-align: center;
        padding: 60px 24px;
        background: linear-gradient(180deg, #fbf5ee 0%, #f4eadf 100%);
        border: 1px dashed rgba(122, 90, 67, 0.24);
        border-radius: 24px;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 16px;
    }

    .empty-box h3 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        margin-bottom: 12px;
        font-size: 2rem;
        font-weight: 500;
    }

    .empty-box p {
        color: var(--muted);
        margin-bottom: 26px;
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
    .recipes-section-card {
        padding: 16px;
        border-radius: 18px;
    }

    .recipes-hero-inner,
    .filters-form-grid {
        grid-template-columns: 1fr;
    }

    .recipes-hero-icon-wrap {
        width: 68px;
        height: 68px;
        font-size: 1.8rem;
        border-radius: 16px;
    }

    .filters-submit-btn {
        width: 100%;
    }

    .recipe-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
}

@media (max-width: 768px) {
    .recipes-index-stack {
        gap: 10px;
    }

    .recipes-section-card {
        padding: 10px;
        border-radius: 14px;
    }

    .recipe-grid {
        grid-template-columns: 1fr;
        gap: 8px;
    }

    .recipe-card {
        border-radius: 12px;
        overflow: hidden;
    }

    .recipe-card-top,
    .recipe-card-body {
        padding-left: 10px;
        padding-right: 10px;
    }

    .recipe-card-top {
        padding-top: 10px;
        padding-bottom: 8px;
    }

    .recipe-card-body {
        padding-bottom: 10px;
    }

    .recipe-card-image,
    .recipe-card img,
    .recipe-thumb,
    .recipe-cover {
        height: 110px;
        border-radius: 10px;
        object-fit: cover;
    }

    .results-summary-title,
    .section-title {
        font-size: 1.05rem;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .recipes-main-title {
        font-size: 1rem;
        line-height: 1.15;
        margin-bottom: 4px;
    }

    .recipes-main-text,
    .results-summary-text,
    .recipe-card p,
    .recipe-card-text {
        font-size: 11.5px;
        line-height: 1.35;
    }

    .filters-extra-actions {
        flex-direction: column;
        gap: 6px;
    }

    .filters-extra-actions .btn,
    .actions-center .btn,
    .recipe-card .btn {
        width: 100%;
        min-height: 34px;
        padding: 7px 10px;
        font-size: 11.5px;
        border-radius: 10px;
    }

    .recipe-meta-grid {
        gap: 6px;
    }

    .recipe-meta-grid > *,
    .recipe-meta-item,
    .recipe-pill,
    .recipe-chip {
        padding: 6px 8px;
        border-radius: 10px;
        font-size: 11px;
    }
}

@media (max-width: 640px) {
    .recipes-section-card {
        padding: 8px;
        border-radius: 12px;
    }

    .recipes-hero-inner {
        gap: 10px;
    }

    .recipes-hero-icon-wrap {
        width: 52px;
        height: 52px;
        font-size: 1.35rem;
        border-radius: 12px;
    }

    .recipe-card-top,
    .recipe-card-body {
        padding-left: 8px;
        padding-right: 8px;
    }

    .recipe-card-top {
        padding-top: 8px;
        padding-bottom: 6px;
    }

    .recipe-card-body {
        padding-bottom: 8px;
    }

    .recipe-card-image,
    .recipe-card img,
    .recipe-thumb,
    .recipe-cover {
        height: 96px;
        border-radius: 8px;
    }

    .recipe-meta-grid {
        grid-template-columns: 1fr;
        gap: 6px;
    }

    .rating-row,
    .author-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }

    .rating-stars {
        margin-left: 0;
        width: 100%;
    }

    .empty-actions {
        flex-direction: column;
        gap: 6px;
    }

    .empty-actions .btn,
    .actions-center .btn,
    .recipe-card .btn,
    .filters-submit-btn {
        width: 100%;
        min-width: 0;
        min-height: 32px;
        padding: 6px 9px;
        font-size: 11px;
    }

    .recipes-main-title {
        font-size: 0.95rem;
    }

    .results-summary-title,
    .empty-box h3 {
        font-size: 1rem;
    }

    .recipes-main-text,
    .results-summary-text,
    .recipe-card p,
    .recipe-card-text,
    .author-meta,
    .recipe-date {
        font-size: 11px;
        line-height: 1.3;
    }

    .pagination-box .relative.inline-flex.items-center,
    .pagination-box .inline-flex.items-center {
        padding: 6px 8px;
        min-width: 30px;
        min-height: 30px;
        font-size: 11px;
        border-radius: 8px;
    }
}
</style>

@php
    $activeSearch = $search ?? request('search');
    $activeCategory = $category ?? request('category');
    $activeDifficulty = $difficulty ?? request('difficulty');
@endphp

<div class="recipes-index-page">
    <div class="recipes-index-stack">

        <div class="recipes-section-card recipes-hero-card">
            <div class="recipes-hero-inner">
                <div class="recipes-hero-icon-wrap">🔍</div>

                <div>
                    <div class="recipes-badge">Receptes un iedvesma</div>
                    <h2 class="recipes-main-title">Atrodiet savu nākamo recepti</h2>
                    <p class="recipes-main-text">
                        Izmantojiet meklēšanu un filtrus, lai ātri atrastu piemērotākās receptes pēc nosaukuma,
                        kategorijas vai grūtības līmeņa, un atklātu jaunas idejas ikdienai.
                    </p>
                </div>
            </div>
        </div>

        <div class="recipes-section-card">
            <div class="section-head">
                <div class="section-kicker">Meklēšana un filtri</div>
                <h3 class="section-title">Atlasiet sev piemērotākās receptes</h3>
                <p class="section-subtext">
                    Filtrējiet receptes pēc sev svarīgākajiem kritērijiem un, ja nepieciešams,
                    izdrukājiet atlasīto sarakstu.
                </p>
            </div>

            <form method="GET" action="{{ route('recipes.index') }}">
                <div class="filters-form-grid">
                    <div class="form-group">
                        <label class="form-label">Meklēt receptes</label>
                        <input
                            type="text"
                            name="search"
                            value="{{ $activeSearch }}"
                            class="form-input"
                            placeholder="Meklēt pēc nosaukuma, apraksta vai sastāvdaļām..."
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategorija</label>
                        <select name="category" class="form-select">
                            <option value="">Visas kategorijas</option>
                            @foreach($categories as $cat)
                                @php
                                    $catValue = is_object($cat) ? ($cat->name ?? '') : $cat;
                                @endphp
                                <option value="{{ $catValue }}" {{ $activeCategory == $catValue ? 'selected' : '' }}>
                                    {{ $catValue }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Grūtība</label>
                        <select name="difficulty" class="form-select">
                            <option value="">Jebkura</option>
                            <option value="Viegla" {{ $activeDifficulty == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                            <option value="Vidēja" {{ $activeDifficulty == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                            <option value="Grūta" {{ $activeDifficulty == 'Grūta' ? 'selected' : '' }}>Grūta</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary filters-submit-btn">Meklēt</button>
                </div>

                @if(request()->hasAny(['search', 'category', 'difficulty', 'max_time']))
                    <div class="filters-extra-actions">
                        <a href="{{ route('recipes.index') }}" class="btn btn-warning">
                            Notīrīt filtrus
                        </a>

                        <a href="{{ route('pdf.filtered.recipes', request()->query()) }}" class="btn btn-secondary">
                            Drukāt atlasīto
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <div class="recipes-section-card results-summary-card">
            <h3 class="results-summary-title">Atrastas {{ $recipes->total() }} receptes</h3>

            @if(request()->hasAny(['search', 'category', 'difficulty', 'max_time']))
                <p class="results-summary-text">
                    Filtrēti rezultāti:
                    @if(request('search')) meklēšana "{{ request('search') }}" @endif
                    @if(request('category')) | kategorija "{{ request('category') }}" @endif
                    @if(request('difficulty')) | grūtība "{{ request('difficulty') }}" @endif
                    @if(request('max_time')) | max laiks "{{ request('max_time') }} min" @endif
                </p>
            @else
                <p class="results-summary-text">
                    Šeit redzams pilns pieejamo recepšu saraksts no kopienas.
                </p>
            @endif
        </div>

        <div class="recipes-section-card actions-center">
            <a href="{{ route('recipes.create') }}" class="btn btn-success">
                Pievienot jaunu recepti
            </a>
        </div>

        @if($recipes->count() > 0)
            <div class="recipes-section-card">
                <div class="section-head">
                    <div class="section-kicker">Kopienas receptes</div>
                    <h3 class="section-title">Recepšu saraksts</h3>
                    <p class="section-subtext">
                        Pārlūkojiet receptes, salīdziniet vērtējumus un atrodiet sev piemērotāko maltīti.
                    </p>
                </div>

                <div class="recipe-grid">
                    @foreach($recipes as $recipe)
                        @php
                            $recipeCategoryName = $recipe->category->name ?? $recipe->category ?? 'Nav kategorijas';
                            $recipeDifficultyName = $recipe->difficulty ?? 'Nav norādīta';
                            $totalTime = (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0);
                            $roundedRating = (int) round($recipe->reviews_avg_rating ?? 0);
                        @endphp

                        <div class="recipe-card">
                            <div class="recipe-card-top">
                                <h3 class="recipe-title">{{ $recipe->title }}</h3>

                                <p class="recipe-description">
                                    {{ \Illuminate\Support\Str::limit($recipe->description, 100) }}
                                </p>
                            </div>

                            <div class="recipe-card-body">
                                <div class="recipe-meta-grid">
                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">📂</span>
                                        <span>{{ $recipeCategoryName }}</span>
                                    </div>

                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">⭐</span>
                                        <span>{{ $recipeDifficultyName }}</span>
                                    </div>

                                    @if($recipe->prep_time || $recipe->cook_time)
                                        <div class="recipe-meta-item">
                                            <span class="recipe-meta-icon">⏱️</span>
                                            <span>{{ $totalTime }} min</span>
                                        </div>
                                    @endif

                                    @if($recipe->servings)
                                        <div class="recipe-meta-item">
                                            <span class="recipe-meta-icon">👥</span>
                                            <span>{{ $recipe->servings }} porcijas</span>
                                        </div>
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
                                        @for($i = 1; $i <= 5; $i++)
                                            {!! $i <= $roundedRating ? '★' : '☆' !!}
                                        @endfor
                                    </span>
                                </div>

                                <div class="author-row">
                                    <div class="author-meta">
                                        <span>Autors: {{ $recipe->user->name ?? 'Nezināms autors' }}</span>
                                        <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                    Skatīt recepti
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($recipes->hasPages())
                <div class="recipes-section-card pagination-box">
                    <div class="pagination-summary">
                        Rāda {{ $recipes->firstItem() }}–{{ $recipes->lastItem() }} no {{ $recipes->total() }} receptēm
                    </div>

                    {{ $recipes->links() }}
                </div>
            @endif
        @else
            <div class="recipes-section-card empty-box">
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
@endsection
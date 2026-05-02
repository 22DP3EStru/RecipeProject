@extends('layouts.app')

@section('title', 'Mani favorīti - Vecmāmiņas Receptes')
@section('meta_description', 'Pārvaldi savas saglabātās receptes, ātri tās atver un noņem no favorītiem Vecmāmiņas Receptes profilā.')

@section('hero_title', 'Favorīti')
@section('hero_text', 'Tavas saglabātās receptes vienuviet')

@section('content')
<style>
    .favorites-page {
        color: var(--text);
    }

    .favorites-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .favorites-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .favorites-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .favorites-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .favorites-icon-wrap {
        width: 108px;
        height: 108px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f3e3df 0%, #ecd2cf 100%);
        border: 4px solid #f0e5d8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.8rem;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        flex-shrink: 0;
    }

    .favorites-badge {
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

    .favorites-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
    }

    .favorites-main-text {
        color: var(--muted);
        line-height: 1.85;
        font-size: 14px;
        max-width: 760px;
    }

    .favorites-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .stat-card {
        background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 18px;
        padding: 20px 18px;
        text-align: center;
        transition: 0.18s ease;
        box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(79, 59, 42, 0.08);
    }

    .stat-card.soft-green {
        background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
    }

    .stat-card.soft-pink {
        background: linear-gradient(180deg, #faf0f3 0%, #f6e8ed 100%);
    }

    .stat-number {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.35rem;
        color: #6f472c;
        margin-bottom: 8px;
        line-height: 1;
        font-weight: 700;
    }

    .stat-label {
        color: var(--muted);
        font-size: 14px;
        font-weight: 700;
    }

    .favorites-actions-card {
        text-align: center;
    }

    .favorites-actions-row {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .recipes-head {
        margin-bottom: 22px;
    }

    .recipes-kicker {
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

    .recipes-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.1rem;
        font-weight: 500;
        margin-bottom: 8px;
        line-height: 1.1;
    }

    .recipes-subtitle {
        color: var(--muted);
        line-height: 1.8;
        font-size: 14px;
        max-width: 760px;
    }

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 22px;
    }

    .recipe-card {
        background: #fffdf9;
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
        transition: 0.2s ease;
    }

    .recipe-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
    }

    .recipe-top {
        padding: 24px 24px 16px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
    }

    .recipe-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.8rem;
        line-height: 1.16;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .recipe-desc {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
    }

    .recipe-body {
        padding: 20px 24px 24px;
        background: #fffdf9;
    }

    .recipe-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .recipe-info-item {
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
    }

    .recipe-info-icon {
        font-size: 1rem;
        flex-shrink: 0;
    }

    .recipe-footer {
        border-top: 1px solid rgba(221, 207, 192, 0.9);
        padding-top: 14px;
        margin-bottom: 18px;
        text-align: center;
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    .recipe-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .recipe-actions form {
        margin: 0;
    }

    .recipe-actions .btn,
    .recipe-actions button {
        width: 100%;
    }

    .pagination-wrap {
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid rgba(221, 207, 192, 0.9);
        text-align: center;
    }

    .pagination-summary {
        margin-bottom: 18px;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.6;
    }

    .pagination-wrap nav {
        display: flex;
        justify-content: center;
    }

    .pagination-wrap nav > div:first-child {
        display: none;
    }

    .pagination-wrap svg {
        width: 18px;
        height: 18px;
    }

    .pagination-wrap .relative.z-0.inline-flex.shadow-sm.rounded-md,
    .pagination-wrap .inline-flex.-space-x-px.rounded-md.shadow-sm {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        box-shadow: none !important;
    }

    .pagination-wrap .relative.inline-flex.items-center,
    .pagination-wrap .inline-flex.items-center {
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

    .pagination-wrap a.relative.inline-flex.items-center:hover,
    .pagination-wrap a.inline-flex.items-center:hover {
        background: var(--surface-soft);
        color: var(--accent);
        transform: translateY(-1px);
    }

    .pagination-wrap span[aria-current="page"] > span,
    .pagination-wrap .text-white {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
        color: #fffaf4 !important;
    }

    .pagination-wrap .text-gray-500,
    .pagination-wrap .text-gray-400 {
        color: var(--muted) !important;
    }

    .empty-state {
        text-align: center;
        padding: 60px 24px;
        background: linear-gradient(180deg, #fbf5ee 0%, #f4eadf 100%);
        border: 1px dashed rgba(122, 90, 67, 0.24);
        border-radius: 24px;
    }

    .empty-state .icon {
        font-size: 4rem;
        margin-bottom: 16px;
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

    .tips-box h3 {
        text-align: center;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2rem;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .tips-subtitle {
        text-align: center;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 18px;
    }

    .tip-card {
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 18px;
        padding: 20px;
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .tip-card h4 {
        color: var(--accent);
        margin-bottom: 10px;
        font-size: 16px;
    }

    .tip-card p {
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
    }
</style>

<div class="favorites-page">
    <div class="favorites-stack">

        <div class="favorites-section-card favorites-hero-card">
            <div class="favorites-hero-inner">
                <div class="favorites-icon-wrap">❤️</div>

                <div>
                    <div class="favorites-badge">Mana kolekcija</div>
                    <h2 class="favorites-main-title">{{ Auth::user()->name }} favorīti</h2>
                    <p class="favorites-main-text">
                        Šeit redzamas receptes, kuras esi saglabājis savos favorītos. Vari tās ātri pārskatīt,
                        atvērt pilno recepti un vajadzības gadījumā noņemt no savas kolekcijas.
                    </p>
                </div>
            </div>
        </div>

        <div class="favorites-stats">
            <div class="stat-card">
                <div class="stat-number">{{ $recipes->total() }}</div>
                <div class="stat-label">Kopā favorīti</div>
            </div>

            <div class="stat-card soft-green">
                <div class="stat-number">
                    {{ $recipes->filter(function($recipe) { return $recipe->created_at && $recipe->created_at >= now()->subDays(30); })->count() }}
                </div>
                <div class="stat-label">Šajā lapā pēdējās 30 dienās</div>
            </div>

            <div class="stat-card soft-pink">
                <div class="stat-number">
                    {{ $recipes->filter(function($recipe) { return !empty($recipe->category_id) || !empty($recipe->category); })->pluck('category')->filter()->unique()->count() }}
                </div>
                <div class="stat-label">Kategorijas šajā lapā</div>
            </div>
        </div>

        <div class="favorites-section-card favorites-actions-card">
            <div class="favorites-actions-row">
                <a href="{{ route('recipes.index') }}" class="btn btn-primary">
                    Pārlūkot visas receptes
                </a>
                <a href="{{ route('profile.recipes') }}" class="btn btn-secondary">
                    Skatīt manas receptes
                </a>
            </div>
        </div>

        @if($recipes->count() > 0)
            <div class="favorites-section-card">
                <div class="recipes-head">
                    <div class="recipes-kicker">Saglabātās receptes</div>
                    <h3 class="recipes-title">Tavs favorītu saraksts</h3>
                    <p class="recipes-subtitle">
                        Šeit vari ātri piekļūt receptēm, kuras esi atzīmējis kā sev svarīgas vai kuras vēlies pagatavot vēlreiz.
                    </p>
                </div>

                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <div class="recipe-top">
                                <h3 class="recipe-title">{{ $recipe->title }}</h3>
                                <p class="recipe-desc">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
                            </div>

                            <div class="recipe-body">
                                <div class="recipe-info-grid">
                                    <div class="recipe-info-item">
                                        <span class="recipe-info-icon">👤</span>
                                        <span>{{ $recipe->user->name ?? 'Nav norādīts' }}</span>
                                    </div>

                                    <div class="recipe-info-item">
                                        <span class="recipe-info-icon">📂</span>
                                        <span>{{ $recipe->category->name ?? $recipe->category ?? 'Nav kategorijas' }}</span>
                                    </div>

                                    @if($recipe->prep_time || $recipe->cook_time)
                                        <div class="recipe-info-item">
                                            <span class="recipe-info-icon">⏱️</span>
                                            <span>{{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} min</span>
                                        </div>
                                    @endif

                                    @if($recipe->servings)
                                        <div class="recipe-info-item">
                                            <span class="recipe-info-icon">👥</span>
                                            <span>{{ $recipe->servings }} porcijas</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="recipe-footer">
                                    Pievienota: {{ $recipe->created_at ? $recipe->created_at->format('d.m.Y H:i') : '-' }}
                                </div>

                                <div class="recipe-actions">
                                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                        Skatīt
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('recipes.favorite.toggle', $recipe) }}"
                                        data-confirm-delete
                                        data-confirm-message="Vai tiešām vēlaties noņemt šo recepti no favorītiem?"
                                    >
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

                @if($recipes->hasPages())
                    <div class="pagination-wrap">
                        <div class="pagination-summary">
                            Rāda {{ $recipes->firstItem() }}–{{ $recipes->lastItem() }} no {{ $recipes->total() }} favorītiem
                        </div>

                        {{ $recipes->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="favorites-section-card empty-state">
                <div class="icon">🤍</div>
                <h3>Tev vēl nav saglabātu favorītu</h3>
                <p>
                    Kad pie receptes nospiedīsi sirsniņu, tā parādīsies šajā sadaļā un būs ērti pieejama jebkurā laikā.
                </p>
                <a href="{{ route('recipes.index') }}" class="btn btn-success">
                    Atrast receptes
                </a>
            </div>
        @endif

        @if($recipes->total() < 5)
            <div class="favorites-section-card tips-box">
                <h3>Idejas favorītu izmantošanai</h3>
                <p class="tips-subtitle">
                    Izmanto favorītus kā savu personīgo recepšu izlasi, kas vienmēr ir pa rokai.
                </p>

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
@endsection
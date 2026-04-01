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
        background: var(--surface);
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
        background: var(--surface);
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
        background: var(--surface);
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
        text-align: center;
    }

    .pagination-summary {
        margin-bottom: 18px;
        color: var(--muted);
        font-size: 14px;
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
        background: #fff;
        color: var(--text);
        font-weight: 700;
        transition: 0.2s ease;
        min-width: 44px;
        justify-content: center;
    }

    .pagination-wrap a.relative.inline-flex.items-center:hover,
    .pagination-wrap a.inline-flex.items-center:hover {
        background: var(--soft-bg);
        color: var(--accent);
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
        padding: 70px 20px;
        background: var(--surface);
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
        background: var(--surface);
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
        background: var(--surface-soft);
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

    @media (max-width: 900px) {
        .section-wrap {
            padding: 24px;
        }
    }

    @media (max-width: 640px) {
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

<div class="favorites-page">
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
                <div class="stat-number">{{ $recipes->total() }}</div>
                <div class="stat-label">Kopā favorīti</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">
                    {{ $recipes->filter(function($recipe) { return $recipe->created_at && $recipe->created_at >= now()->subDays(30); })->count() }}
                </div>
                <div class="stat-label">Šajā lapā pēdējās 30 dienās</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">
                    {{ $recipes->filter(function($recipe) { return !empty($recipe->category_id) || !empty($recipe->category); })->pluck('category')->filter()->unique()->count() }}
                </div>
                <div class="stat-label">Kategorijas šajā lapā</div>
            </div>
        </div>

        <div class="section-block actions-bar">
            <div class="actions-row">
                <a href="{{ route('recipes.index') }}" class="btn btn-primary">
                    Pārlūkot visas receptes
                </a>
                <a href="{{ route('profile.recipes') }}" class="btn btn-secondary">
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
                                <p class="recipe-desc">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
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
            <div class="section-block empty-state">
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
@endsection
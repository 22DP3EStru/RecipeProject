@extends('layouts.app')

@section('title', ($categoryName ?? 'Kategorija') . ' - Vecmāmiņas Receptes')
@section('meta_description', 'Pārlūkojiet visas receptes kategorijā ' . ($categoryName ?? 'Kategorija') . ' un atrodiet idejas savām nākamajām maltītēm.')

@section('content')
<style>
    .category-page {
        color: var(--text);
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
        background: var(--surface-soft);
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
        background: #f2e7da;
        color: #7a5a43;
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
        background: var(--surface-soft);
        color: var(--accent);
        text-decoration: none;
        border: 1px solid var(--line);
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .category-tags a:hover {
        background: var(--surface-soft-2);
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
    }
</style>

<div class="category-page">
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
@endsection
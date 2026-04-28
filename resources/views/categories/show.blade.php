@extends('layouts.app')

@section('title', $categoryName . ' - Vecmāmiņas Receptes')
@section('meta_description', 'Apskatiet receptes kategorijā ' . $categoryName . '.')

@section('hero_title', $categoryName)
@section('hero_text', 'Apskatiet visas receptes šajā kategorijā.')

@section('content')

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

    .section-head {
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    .section-kicker {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        background: #f5ece2;
        border: 1px solid rgba(122, 90, 67, 0.12);
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .section-title {
        color: var(--accent);
        font-family: Georgia, serif;
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .section-subtext {
        color: var(--muted);
        font-size: 14px;
    }

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, 300px);
        gap: 22px;
        justify-content: start;
    }

    .recipe-card {
        width: 300px;
        max-width: 300px;
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
        min-height: 150px;
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

    .recipe-card .btn {
        width: 100%;
    }

    .empty-box {
        text-align: center;
        padding: 60px;
    }
</style>

<div class="categories-page">
    <div class="categories-stack">

        <div class="categories-section-card breadcrumbs-card">
            <a href="/dashboard">Vadības panelis</a>
            <span> / </span>
            <a href="/categories">Kategorijas</a>
            <span> / </span>
            <span>{{ $categoryName }}</span>
        </div>

        <div class="categories-section-card">
            <div class="section-head">
                <div class="section-kicker">Kategorija</div>
                <h3 class="section-title">{{ $categoryName }}</h3>
                <p class="section-subtext">
                    Visas receptes šajā kategorijā.
                </p>
            </div>

            @if($recipes->count() > 0)

                <div class="recipes-grid">
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

                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">⏱️</span>
                                        <span>{{ $totalTime > 0 ? $totalTime : 'N/A' }} min</span>
                                    </div>

                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">👥</span>
                                        <span>{{ $recipe->servings ?? 'N/A' }} porcijas</span>
                                    </div>
                                </div>

                                <div class="rating-row">
                                    <span class="rating-value">
                                        {{ $recipe->reviews_avg_rating ? round($recipe->reviews_avg_rating, 1) : 'Nav vērtējumu' }} / 5
                                    </span>

                                    <span class="rating-count">
                                        ({{ $recipe->reviews_count ?? 0 }})
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

            @else
                <div class="empty-box">
                    <h3>Nav recepšu</h3>
                    <p>Šajā kategorijā vēl nav nevienas receptes.</p>
                </div>
            @endif

        </div>

    </div>
</div>

@endsection
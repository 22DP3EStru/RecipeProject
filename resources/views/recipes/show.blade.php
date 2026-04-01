@extends('layouts.app')

@section('title', $recipe->title . ' - Vecmāmiņas Receptes')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($recipe->description ?? 'Apskatiet recepti Vecmāmiņas Receptes platformā.'), 160))

@section('hero_title', $recipe->title)
@section('hero_text', 'Autors: ' . $recipe->user->name . ' · Skatījumi: ' . number_format((int)($recipe->views ?? 0), 0, ',', ' '))

@section('content')
@php
    $isFav = false;
    if (Auth::check()) {
        $isFav = Auth::user()
            ->favoriteRecipes()
            ->where('recipe_id', $recipe->id)
            ->exists();
    }

    $origServings = (int)($recipe->servings ?? 1);
    if ($origServings <= 0) { $origServings = 1; }

    $origPrep = (int)($recipe->prep_time ?? 0);
    $origCook = (int)($recipe->cook_time ?? 0);
    $origTotal = $origPrep + $origCook;

    $ingredientsRel = collect();
    try {
        $ingredientsRel = $recipe->ingredientsItems;
    } catch (\Throwable $e) {
        $ingredientsRel = collect();
    }
@endphp

<style>
    .recipe-show-page {
        color: var(--text);
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

    .section-block + .section-block {
        margin-top: 28px;
    }

    .intro-box,
    .hero-card,
    .meta-card,
    .content-card,
    .author-card,
    .review-card-box,
    .comment-card-box,
    .related-card,
    .flash-success {
        background: var(--surface);
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
    .hero-card-title,
    .empty-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .intro-box h2 {
        font-size: 2.3rem;
        margin-bottom: 12px;
    }

    .intro-box p,
    .hero-card p,
    .muted-text {
        color: var(--muted);
        line-height: 1.8;
    }

    .hero-card {
        text-align: center;
    }

    .hero-card-head {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .hero-card-title {
        font-size: 2.6rem;
        line-height: 1.15;
        margin: 0;
    }

    .recipe-description {
        font-size: 17px;
        max-width: 820px;
        margin: 0 auto;
    }

    .recipe-top-meta {
        margin-top: 16px;
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .recipe-top-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border: 1px solid var(--line);
        background: var(--surface-soft);
        color: var(--accent);
        font-weight: 800;
    }

    .heart-btn {
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        font-size: 28px;
        line-height: 1;
        padding: 8px 10px;
        transition: 0.2s ease;
    }

    .heart-btn:hover {
        background: var(--surface-soft);
        border-color: var(--line);
    }

    .servings-control {
        margin: 22px auto 0;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .servings-input {
        width: 90px;
        padding: 12px 14px;
        border: 1px solid var(--line);
        outline: none;
        font-weight: 800;
        text-align: center;
        background: #fffdfa;
        color: var(--text);
        font-family: inherit;
    }

    .servings-input:focus {
        border-color: #bba692;
        background: #fff;
    }

    .servings-hint {
        font-size: 13px;
        color: var(--muted);
        font-weight: 700;
    }

    .pdf-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 18px;
        justify-content: center;
    }

    .pdf-btn {
        display: inline-block;
        padding: 10px 14px;
        text-decoration: none;
        border: 1px solid var(--line);
        background: var(--surface-soft);
        color: var(--text);
        font-size: 13px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .pdf-btn:hover {
        background: var(--surface-soft-2);
    }

    .media-wrap {
        max-width: 820px;
        margin: 24px auto 0;
    }

    .media-card {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 16px;
        margin-top: 14px;
    }

    .media-img,
    .media-video {
        width: 100%;
        display: block;
        border: 1px solid var(--line);
    }

    .media-img {
        max-height: 420px;
        object-fit: cover;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 18px;
    }

    .meta-item {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 22px;
        text-align: center;
    }

    .meta-icon {
        font-size: 2.3rem;
        margin-bottom: 10px;
    }

    .meta-item h4 {
        color: var(--accent);
        margin-bottom: 6px;
        font-size: 16px;
        font-weight: 700;
    }

    .meta-item p {
        color: var(--muted);
        font-weight: 600;
        line-height: 1.6;
    }

    .content-inner {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 24px;
    }

    .ingredient-list,
    .instruction-list {
        list-style: none;
        padding: 0;
    }

    .ingredient-list li,
    .instruction-list li {
        padding: 12px 0;
        border-bottom: 1px solid var(--line);
    }

    .ingredient-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .ingredient-check {
        color: var(--success-text);
        font-weight: 800;
    }

    .ingredientQty {
        color: var(--text);
        font-weight: 900;
    }

    .ingredient-unit {
        color: var(--muted);
        font-weight: 800;
    }

    .ingredient-name {
        color: var(--text);
        font-size: 16px;
    }

    .old-format-note {
        margin-bottom: 12px;
        color: var(--muted);
        font-weight: 700;
    }

    .instruction-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .step-badge {
        background: var(--accent);
        color: #fffaf4;
        min-width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .instruction-text {
        color: var(--text);
        font-size: 16px;
        line-height: 1.7;
    }

    .author-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 18px;
        text-align: center;
    }

    .author-box {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 20px;
    }

    .author-box h4 {
        color: var(--accent);
        margin-bottom: 6px;
        font-size: 15px;
    }

    .author-box p {
        color: var(--muted);
        font-weight: 600;
        line-height: 1.6;
    }

    .flash-success {
        background: var(--success-bg);
        color: var(--success-text);
        border-color: #d8e1cf;
        font-weight: 700;
        margin-bottom: 18px;
        padding: 18px 20px;
    }

    .review-summary,
    .comment-summary {
        text-align: center;
        margin-bottom: 18px;
    }

    .review-badge,
    .comment-badge {
        display: inline-block;
        padding: 8px 14px;
        border: 1px solid var(--line);
        background: var(--surface-soft);
        color: var(--accent);
        font-weight: 800;
    }

    .review-card,
    .comment-card,
    .reply-card {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 22px;
    }

    .review-card + .review-card,
    .comment-card + .comment-card {
        margin-top: 18px;
    }

    .review-top,
    .comment-top,
    .reply-top {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    .review-user,
    .comment-user,
    .reply-user {
        font-weight: 800;
        color: var(--text);
    }

    .review-date,
    .comment-date,
    .reply-date {
        color: var(--muted);
        font-size: 13px;
    }

    .review-text,
    .comment-text,
    .reply-text {
        color: var(--text);
        line-height: 1.7;
    }

    .stars {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 6px;
    }

    .stars input {
        display: none;
    }

    .stars label {
        cursor: pointer;
        font-size: 26px;
        color: rgba(0,0,0,0.25);
        transition: 0.15s ease;
    }

    .stars label:hover {
        transform: translateY(-2px);
    }

    .stars input:checked ~ label,
    .stars label:hover,
    .stars label:hover ~ label {
        color: #b9872f;
    }

    .static-stars {
        margin-left: 10px;
    }

    .static-stars .filled {
        color: #b9872f;
    }

    .static-stars .empty {
        color: rgba(185, 135, 47, 0.3);
    }

    .comment-form-textarea,
    .reply-form-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--line);
        background: #fffdfa;
        color: var(--text);
        font-family: inherit;
        resize: vertical;
        min-height: 110px;
    }

    .reply-form-textarea {
        min-height: 90px;
    }

    .comment-form-textarea:focus,
    .reply-form-textarea:focus {
        outline: none;
        border-color: #bba692;
        background: #fff;
    }

    .error-text {
        color: var(--danger-text);
        font-weight: 700;
        margin-top: 8px;
    }

    .review-actions,
    .page-actions,
    .comment-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .page-actions {
        justify-content: center;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 14px;
    }

    .related-item {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 20px;
        transition: 0.2s ease;
    }

    .related-item:hover {
        background: #fffaf5;
    }

    .related-item h4 {
        color: var(--accent);
        margin-bottom: 10px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 1.4rem;
        font-weight: 500;
    }

    .related-item p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .related-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        font-size: 12px;
        color: var(--muted);
        margin-bottom: 14px;
    }

    .empty-review,
    .empty-comment {
        text-align: center;
        color: var(--muted);
    }

    .comment-form-box {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 22px;
        margin-bottom: 18px;
    }

    .comment-form-title {
        font-weight: 800;
        margin-bottom: 12px;
        color: var(--text);
    }

    .comment-login-note {
        text-align: center;
        color: var(--muted);
        margin-bottom: 18px;
    }

    .review-info-grid {
        display: grid;
        gap: 14px;
        margin-top: 12px;
    }

    .review-info-box {
        background: #fffdfa;
        border: 1px solid var(--line);
        padding: 14px 16px;
    }

    .review-label {
        display: block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 8px;
    }

    .review-value {
        color: var(--text);
        line-height: 1.7;
    }

    .comment-actions {
        margin-top: 14px;
    }

    .reply-toggle-btn {
        padding: 10px 14px;
        border: 1px solid var(--line);
        background: #fffdfa;
        color: var(--accent);
        font-weight: 800;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .reply-toggle-btn:hover {
        background: var(--surface-soft-2);
    }

    .reply-form-wrap {
        margin-top: 16px;
        background: #fffdfa;
        border: 1px solid var(--line);
        padding: 16px;
    }

    .replies-wrap {
        margin-top: 18px;
        padding-left: 22px;
        border-left: 3px solid var(--line);
        display: grid;
        gap: 14px;
    }

    .reply-card {
        background: #fffdfa;
    }

    .comments-pagination-wrap {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--line);
        text-align: center;
    }

    .pagination-summary {
        margin-bottom: 18px;
        color: var(--muted);
        font-size: 14px;
    }

    .comments-pagination-wrap nav {
        display: flex;
        justify-content: center;
    }

    .comments-pagination-wrap nav > div:first-child {
        display: none;
    }

    .comments-pagination-wrap svg {
        width: 18px;
        height: 18px;
    }

    .comments-pagination-wrap .relative.z-0.inline-flex.shadow-sm.rounded-md,
    .comments-pagination-wrap .inline-flex.-space-x-px.rounded-md.shadow-sm {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        box-shadow: none !important;
    }

    .comments-pagination-wrap .relative.inline-flex.items-center,
    .comments-pagination-wrap .inline-flex.items-center {
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

    .comments-pagination-wrap a.relative.inline-flex.items-center:hover,
    .comments-pagination-wrap a.inline-flex.items-center:hover {
        background: var(--soft-bg);
        color: var(--accent);
    }

    .comments-pagination-wrap span[aria-current="page"] > span,
    .comments-pagination-wrap .text-white {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
        color: #fffaf4 !important;
    }

    .comments-pagination-wrap .text-gray-500,
    .comments-pagination-wrap .text-gray-400 {
        color: var(--muted) !important;
    }

    @media (max-width: 900px) {
        .hero-title {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 640px) {
        .hero {
            padding: 10px 8px 24px;
        }

        .hero-title {
            font-size: 2.3rem;
        }

        .intro-box,
        .hero-card,
        .meta-card,
        .content-card,
        .author-card,
        .review-card-box,
        .comment-card-box,
        .related-card,
        .flash-success {
            padding: 20px;
        }

        .hero-card-title {
            font-size: 2rem;
        }

        .hero-card-head,
        .servings-control,
        .pdf-actions,
        .review-actions,
        .page-actions,
        .comment-actions {
            flex-direction: column;
        }

        .hero-card-head form,
        .pdf-actions a,
        .review-actions .btn,
        .page-actions .btn,
        .page-actions form,
        .page-actions form button,
        .comment-actions button {
            width: 100%;
        }

        .ingredient-row,
        .instruction-row,
        .review-top,
        .comment-top,
        .reply-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .author-grid,
        .meta-grid,
        .related-grid {
            grid-template-columns: 1fr;
        }

        .static-stars {
            margin-left: 0;
            display: block;
            margin-top: 6px;
        }

        .replies-wrap {
            padding-left: 12px;
        }
    }
</style>

<div class="recipe-show-page">

    <div class="section-block intro-box">
        <div class="intro-icon">🍽️</div>
        <h2>Receptes apskats</h2>
        <p>
            Šeit varat pārskatīt receptes aprakstu, sastāvdaļas, gatavošanas soļus, vērtējumus, komentārus un saistītās receptes vienuviet.
        </p>
    </div>

    <div class="section-block hero-card">
        <div class="hero-card-head">
            <h2 class="hero-card-title">{{ $recipe->title }}</h2>

            @auth
                <form method="POST" action="{{ route('recipes.favorite.toggle', $recipe) }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="heart-btn" aria-label="Pievienot favorītiem">
                        {!! $isFav ? '❤️' : '🤍' !!}
                    </button>
                </form>
            @endauth

            @guest
                <span title="Pieslēdzies, lai pievienotu favorītiem" style="font-size:28px; opacity:.6;">🤍</span>
            @endguest
        </div>

        <p class="recipe-description">
            {{ $recipe->description }}
        </p>

        <div class="recipe-top-meta">
            <span class="recipe-top-badge">👁️ Skatījumi: {{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</span>
            <span class="recipe-top-badge">📅 Publicēta: {{ $recipe->created_at->format('d.m.Y') }}</span>
        </div>

        <div class="servings-control">
            <span style="font-weight: 900; color: var(--accent);">Porcijas:</span>
            <input
                id="servingsInput"
                class="servings-input"
                type="number"
                min="1"
                value="{{ $origServings }}"
                aria-label="Porciju skaits"
            >
            <span class="servings-hint">(oriģināli: {{ $origServings }})</span>
        </div>

        <div class="pdf-actions">
            <a href="{{ route('pdf.recipe.full', $recipe->id) }}" class="pdf-btn pdf-link" data-type="full">PDF pilns</a>
            <a href="{{ route('pdf.recipe.ingredients', $recipe->id) }}" class="pdf-btn pdf-link" data-type="ingredients">Sastāvdaļas</a>
            <a href="{{ route('pdf.recipe.steps', $recipe->id) }}" class="pdf-btn pdf-link" data-type="steps">Soļi</a>
        </div>

        @if($recipe->image_path || $recipe->video_path)
            <div class="media-wrap">
                @if($recipe->image_path)
                    <div class="media-card">
                        <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="Receptes attēls" class="media-img">
                    </div>
                @endif

                @if($recipe->video_path)
                    <div class="media-card">
                        <video controls class="media-video">
                            <source src="{{ asset('storage/' . $recipe->video_path) }}">
                            Jūsu pārlūks neatbalsta video.
                        </video>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <div class="section-block meta-card">
        <h3 class="section-title">📋 Receptes informācija</h3>

        <div class="meta-grid">
            <div class="meta-item">
                <div class="meta-icon">📂</div>
                <h4>Kategorija</h4>
                <p>{{ $recipe->category ?? 'Nav norādīta' }}</p>
            </div>

            <div class="meta-item">
                <div class="meta-icon">⭐</div>
                <h4>Grūtība</h4>
                <p>{{ $recipe->difficulty ?? 'Nav norādīta' }}</p>
            </div>

            <div class="meta-item">
                <div class="meta-icon">👁️</div>
                <h4>Skatījumi</h4>
                <p>{{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</p>
            </div>

            @if(!is_null($recipe->prep_time))
                <div class="meta-item">
                    <div class="meta-icon">🔪</div>
                    <h4>Sagatavošana</h4>
                    <p>
                        <span id="prepTime" data-original="{{ $origPrep }}">{{ $origPrep }}</span> minūtes
                    </p>
                </div>
            @endif

            @if(!is_null($recipe->cook_time))
                <div class="meta-item">
                    <div class="meta-icon">🔥</div>
                    <h4>Gatavošana</h4>
                    <p>
                        <span id="cookTime" data-original="{{ $origCook }}">{{ $origCook }}</span> minūtes
                    </p>
                </div>
            @endif

            <div class="meta-item">
                <div class="meta-icon">⏱️</div>
                <h4>Kopā laiks</h4>
                <p>
                    <span id="totalTime" data-original="{{ $origTotal }}">{{ $origTotal }}</span> minūtes
                    </p>
                </div>

            <div class="meta-item">
                <div class="meta-icon">👥</div>
                <h4>Porcijas</h4>
                <p>
                    <span id="servingsDisplay" data-original="{{ $origServings }}">{{ $origServings }}</span> porcijas
                </p>
            </div>
        </div>
    </div>

    <div class="section-block content-card">
        <h3 class="section-title">🥕 Sastāvdaļas</h3>

        <div class="content-inner">
            @if($ingredientsRel instanceof \Illuminate\Support\Collection && $ingredientsRel->count() > 0)
                <ul class="ingredient-list">
                    @foreach($ingredientsRel as $ing)
                        <li>
                            <div class="ingredient-row">
                                <span class="ingredient-check">✓</span>

                                @php
                                    $q = $ing->quantity ?? $ing->amount ?? $ing->qty ?? (isset($ing->pivot) ? ($ing->pivot->quantity ?? null) : null);
                                @endphp

                                @if(!is_null($q))
                                    <span class="ingredientQty" data-original="{{ (float)$q }}">
                                        {{ rtrim(rtrim(number_format((float)$q, 2, '.', ''), '0'), '.') }}
                                    </span>
                                @else
                                    <span class="ingredientQty" data-original=""></span>
                                @endif

                                @if($ing->unit)
                                    <span class="ingredient-unit">{{ $ing->unit }}</span>
                                @endif

                                <span class="ingredient-name">{{ $ing->name }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                @php
                    $ingredients = explode("\n", (string)$recipe->ingredients);
                @endphp

                <div class="old-format-note">
                    Šai receptei sastāvdaļas vēl ir vecajā formātā, tāpēc automātiska pārrēķināšana var nebūt precīza.
                </div>

                <ul class="ingredient-list">
                    @foreach($ingredients as $ingredient)
                        @if(trim($ingredient))
                            <li>
                                <div class="ingredient-row">
                                    <span class="ingredient-check">✓</span>
                                    <span class="ingredient-name">{{ trim($ingredient) }}</span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="section-block content-card">
        <h3 class="section-title">👩‍🍳 Gatavošanas instrukcijas</h3>

        <div class="content-inner">
            @php
                $instructions = explode("\n", (string)$recipe->instructions);
                $stepNumber = 1;
            @endphp

            <ol class="instruction-list">
                @foreach($instructions as $instruction)
                    @if(trim($instruction))
                        <li>
                            <div class="instruction-row">
                                <span class="step-badge">{{ $stepNumber++ }}</span>
                                <span class="instruction-text">{{ trim($instruction) }}</span>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ol>
        </div>
    </div>

    <div class="section-block author-card">
        <h3 class="section-title">👨‍🍳 Par šo recepti</h3>

        <div class="author-grid">
            <div class="author-box">
                <h4>Receptes autors</h4>
                <p>{{ $recipe->user->name }}</p>
            </div>

            <div class="author-box">
                <h4>Publicēts</h4>
                <p>{{ $recipe->created_at->format('d.m.Y') }}</p>
            </div>

            <div class="author-box">
                <h4>Pēdējās izmaiņas</h4>
                <p>{{ $recipe->updated_at->diffForHumans() }}</p>
            </div>

            <div class="author-box">
                <h4>Skatījumu skaits</h4>
                <p>{{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</p>
            </div>
        </div>
    </div>

    @php
        $avg = $recipe->reviews->avg('rating');
        $avgRounded = $avg ? round($avg, 1) : null;
        $count = $recipe->reviews->count();
    @endphp

    <div class="section-block review-card-box">
        <h3 class="section-title">⭐ Vērtējumi</h3>

        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif

        <div class="review-summary">
            <span class="review-badge">
                Vidējais vērtējums: {{ $avgRounded ?? 'Nav' }}@if($avgRounded) / 5 @endif ({{ $count }})
            </span>
        </div>

        @auth
            <div class="review-card" style="margin-bottom: 18px;">
                @if(!$myReview)
                    <div style="font-weight:800; margin-bottom:12px;">Tavs vērtējums</div>

                    <form method="POST" action="{{ route('recipes.reviews.store', $recipe) }}">
                        @csrf

                        <div style="margin-bottom:14px;">
                            <label class="review-label" style="margin-bottom:10px;">Vērtējums</label>

                            <div class="stars">
                                @for($i=5; $i>=1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                    <label for="star{{ $i }}">★</label>
                                @endfor
                            </div>

                            @error('rating')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success" style="margin-top:12px;">
                            Saglabāt vērtējumu
                        </button>
                    </form>
                @else
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap;">
                        <div>
                            <div style="font-weight:800;">Tavs vērtējums</div>
                        </div>

                        <div class="review-actions">
                            <button
                                class="btn btn-warning"
                                type="button"
                                onclick="document.getElementById('edit-review-form').style.display='block'; this.style.display='none';">
                                Rediģēt
                            </button>

                            <form method="POST" action="{{ route('recipes.reviews.destroy', $recipe) }}"
                                  onsubmit="return confirm('Dzēst savu vērtējumu?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Dzēst
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="review-info-grid">
                        <div class="review-info-box">
                            <span class="review-label">Vērtējums</span>
                            <div class="review-value">
                                <span class="static-stars" style="margin-left:0;">
                                    @for($s=1; $s<=5; $s++)
                                        {!! $s <= $myReview->rating
                                            ? '<span class="filled">★</span>'
                                            : '<span class="empty">★</span>' !!}
                                    @endfor
                                </span>
                            </div>
                        </div>
                    </div>

                    <form
                        id="edit-review-form"
                        method="POST"
                        action="{{ route('recipes.reviews.store', $recipe) }}"
                        style="display:none; margin-top:18px;">
                        @csrf

                        <div style="margin-bottom:14px;">
                            <label class="review-label" style="margin-bottom:10px;">Vērtējums</label>

                            <div class="stars">
                                @for($i=5; $i>=1; $i--)
                                    <input type="radio" id="editStar{{ $i }}" name="rating" value="{{ $i }}"
                                           @checked((int)$myReview->rating === $i) required>
                                    <label for="editStar{{ $i }}">★</label>
                                @endfor
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success" style="margin-top:12px;">
                            Saglabāt izmaiņas
                        </button>
                    </form>
                @endif
            </div>
        @endauth

        @forelse($recipe->reviews as $review)
            <div class="review-card">
                <div class="review-top">
                    <div class="review-user">{{ $review->user->name }}</div>
                    <div class="review-date">{{ $review->created_at->format('d.m.Y H:i') }}</div>
                </div>

                <div class="review-info-grid">
                    <div class="review-info-box">
                        <span class="review-label">Vērtējums</span>
                        <div class="review-value">
                            <span class="static-stars" style="margin-left:0;">
                                @for($s=1; $s<=5; $s++)
                                    {!! $s <= $review->rating
                                        ? '<span class="filled">★</span>'
                                        : '<span class="empty">★</span>' !!}
                                @endfor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="review-card empty-review">
                Šai receptei vēl nav vērtējumu.
            </div>
        @endforelse
    </div>

    <div class="section-block comment-card-box">
        <h3 class="section-title">💬 Komentāri</h3>

        @if(session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif

        <div class="comment-summary">
            <span class="comment-badge">
                Kopā komentāri: {{ $comments->total() }}
            </span>
        </div>

        @auth
            <div class="comment-form-box">
                <div class="comment-form-title">Pievienot komentāru</div>

                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <input type="hidden" name="parent_id" value="">

                    <textarea
                        name="body"
                        rows="4"
                        class="comment-form-textarea"
                        placeholder="Uzraksti savu komentāru..."
                    >{{ old('body') }}</textarea>

                    @error('body')
                        <div class="error-text">{{ $message }}</div>
                    @enderror

                    @error('recipe_id')
                        <div class="error-text">{{ $message }}</div>
                    @enderror

                    @error('parent_id')
                        <div class="error-text">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-success" style="margin-top:12px;">
                        Pievienot komentāru
                    </button>
                </form>
            </div>
        @else
            <div class="comment-login-note">
                Lai pievienotu komentāru, nepieciešams pieslēgties.
            </div>
        @endauth

        @forelse($comments as $comment)
            <div class="comment-card">
                <div class="comment-top">
                    <div class="comment-user">{{ $comment->user->name ?? 'Nezināms lietotājs' }}</div>
                    <div class="comment-date">{{ $comment->created_at?->format('d.m.Y H:i') }}</div>
                </div>

                <div class="comment-text">
                    {{ $comment->body }}
                </div>

                @auth
                    <div class="comment-actions">
                        <button
                            type="button"
                            class="reply-toggle-btn"
                            onclick="toggleReplyForm({{ $comment->id }})">
                            Atbildēt
                        </button>
                    </div>

                    <div id="reply-form-{{ $comment->id }}" class="reply-form-wrap" style="display:none;">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                            <textarea
                                name="body"
                                rows="3"
                                class="reply-form-textarea"
                                placeholder="Uzraksti atbildi uz komentāru..."
                            ></textarea>

                            <button type="submit" class="btn btn-primary" style="margin-top:12px;">
                                Ievietot atbildi
                            </button>
                        </form>
                    </div>
                @endauth

                @if($comment->replies->count() > 0)
                    <div class="replies-wrap">
                        @foreach($comment->replies as $reply)
                            <div class="reply-card">
                                <div class="reply-top">
                                    <div class="reply-user">{{ $reply->user->name ?? 'Nezināms lietotājs' }}</div>
                                    <div class="reply-date">{{ $reply->created_at?->format('d.m.Y H:i') }}</div>
                                </div>

                                <div class="reply-text">
                                    {{ $reply->body }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="comment-card empty-comment">
                Šai receptei vēl nav komentāru.
            </div>
        @endforelse

        @if($comments->hasPages())
            <div class="comments-pagination-wrap">
                <div class="pagination-summary">
                    Rāda {{ $comments->firstItem() }}–{{ $comments->lastItem() }} no {{ $comments->total() }} komentāriem
                </div>

                {{ $comments->links() }}
            </div>
        @endif
    </div>

    <div class="section-block">
        <div class="page-actions">
            @if(Auth::id() === $recipe->user_id)
                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">
                    Rediģēt recepti
                </a>

                <form method="POST" action="{{ route('recipes.destroy', $recipe) }}"
                      onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti? Šo darbību nevar atsaukt.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Dzēst recepti
                    </button>
                </form>
            @endif

            <a href="{{ route('recipes.index') }}" class="btn btn-primary">
                Pārlūkot citas receptes
            </a>

            <a href="{{ route('recipes.create') }}" class="btn btn-success">
                Izveidot jaunu recepti
            </a>
        </div>
    </div>

    @if(isset($relatedRecipes) && $relatedRecipes->count() > 0)
        <div class="section-block related-card">
            <h3 class="section-title">🔍 Līdzīgas receptes</h3>

            <div class="related-grid">
                @foreach($relatedRecipes as $relatedRecipe)
                    <div class="related-item">
                        <h4>{{ $relatedRecipe->title }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($relatedRecipe->description, 80) }}</p>

                        <div class="related-meta">
                            <span>{{ $relatedRecipe->category }}</span>
                            <span>{{ $relatedRecipe->user->name }}</span>
                            <span>👁️ {{ number_format((int)($relatedRecipe->views ?? 0), 0, ',', ' ') }}</span>
                        </div>

                        <a href="{{ route('recipes.show', $relatedRecipe) }}" class="btn btn-primary" style="width: 100%;">
                            Skatīt recepti
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

<script>
(() => {
    const input = document.getElementById('servingsInput');
    if (!input) return;

    const servingsDisplay = document.getElementById('servingsDisplay');
    const prepEl  = document.getElementById('prepTime');
    const cookEl  = document.getElementById('cookTime');
    const totalEl = document.getElementById('totalTime');
    const pdfLinks = document.querySelectorAll('.pdf-link');

    const originalServings = Number(input.value) || 1;

    function num(v) {
        const n = Number(v);
        return Number.isFinite(n) ? n : 0;
    }

    function formatQty(n) {
        const rounded = Math.round(n * 100) / 100;
        return String(rounded)
            .replace(/\.0+$/, '')
            .replace(/(\.\d*[1-9])0+$/, '$1');
    }

    function recalc() {
        const newServings = Math.max(1, num(input.value) || 1);
        const k = newServings / originalServings;

        if (servingsDisplay) {
            servingsDisplay.textContent = String(newServings);
        }

        const origPrep = prepEl ? num(prepEl.dataset.original) : 0;
        const origCook = cookEl ? num(cookEl.dataset.original) : 0;

        const newPrep = Math.max(0, Math.round(origPrep * k));
        const newCook = Math.max(0, Math.round(origCook * k));
        const newTotal = newPrep + newCook;

        if (prepEl) prepEl.textContent = String(newPrep);
        if (cookEl) cookEl.textContent = String(newCook);
        if (totalEl) totalEl.textContent = String(newTotal);

        document.querySelectorAll('.ingredientQty').forEach(el => {
            const raw0 = (el.dataset.original ?? '').toString().trim();
            if (!raw0) return;

            const raw = raw0.replace(',', '.');

            let orig;

            if (raw.includes('/')) {
                const [a, b] = raw.split('/').map(s => Number(s.trim()));
                if (!Number.isFinite(a) || !Number.isFinite(b) || b === 0) return;
                orig = a / b;
            } else {
                orig = parseFloat(raw);
                if (!Number.isFinite(orig)) return;
            }

            el.textContent = formatQty(orig * k);
        });
    }

    pdfLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const servings = Math.max(1, parseInt(input.value || 1, 10));
            const url = new URL(this.href, window.location.origin);

            url.searchParams.set('servings', servings);

            window.open(url.toString(), '_blank');
        });
    });

    input.addEventListener('input', recalc);
    recalc();
})();

function toggleReplyForm(id) {
    const form = document.getElementById('reply-form-' + id);
    if (!form) return;

    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}
</script>
@endsection
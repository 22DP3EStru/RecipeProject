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
    if ($origServings <= 0) {
        $origServings = 1;
    }

    $origPrep = (int)($recipe->prep_time ?? 0);
    $origCook = (int)($recipe->cook_time ?? 0);
    $origTotal = $origPrep + $origCook;

    $ingredientsRel = collect();
    try {
        $ingredientsRel = $recipe->ingredientsItems;
    } catch (\Throwable $e) {
        $ingredientsRel = collect();
    }

    $recipeCategory = $recipe->category->name ?? $recipe->category ?? 'Nav norādīta';
    $recipeDifficulty = $recipe->difficulty ?? 'Nav norādīta';

    $avg = $recipe->reviews->avg('rating');
    $avgRounded = $avg ? round($avg, 1) : null;
    $count = $recipe->reviews->count();

    $imageUrl = null;
    if (!empty($recipe->image_url)) {
        $imageUrl = $recipe->image_url;
    } elseif (!empty($recipe->image_path)) {
        $imageUrl = asset('storage/' . $recipe->image_path);
    }

    $videoUrl = null;
    if (!empty($recipe->video_url)) {
        $videoUrl = $recipe->video_url;
    } elseif (!empty($recipe->video_path)) {
        $videoUrl = asset('storage/' . $recipe->video_path);
    }
@endphp

<style>
    .recipe-show-page {
        color: var(--text);
    }

    .recipe-show-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .recipe-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        overflow: hidden;
    }

    .recipe-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
    }

    .recipe-hero-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .recipe-hero-left {
        min-width: 0;
        flex: 1 1 560px;
    }

    .recipe-badge {
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

    .recipe-main-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.7rem;
        line-height: 1.08;
        font-weight: 500;
        margin: 0 0 12px;
        word-break: break-word;
    }

    .recipe-description {
        color: var(--muted);
        line-height: 1.85;
        font-size: 15px;
        max-width: 840px;
    }

    .recipe-fav-wrap {
        flex: 0 0 auto;
    }

    .heart-btn {
        background: #fffdfa;
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 16px;
        cursor: pointer;
        font-size: 28px;
        line-height: 1;
        padding: 12px 14px;
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .heart-btn:hover {
        transform: translateY(-1px);
        background: var(--surface-soft);
    }

    .recipe-top-meta {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .recipe-top-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 999px;
        border: 1px solid rgba(122, 90, 67, 0.10);
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        color: var(--accent);
        font-weight: 800;
        font-size: 13px;
    }

    .servings-card {
        margin-top: 22px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        padding: 18px;
    }

    .servings-control {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .servings-label {
        font-weight: 900;
        color: var(--accent);
    }

    .servings-input {
        width: 92px;
        padding: 12px 14px;
        border: 1px solid var(--line);
        border-radius: 14px;
        outline: none;
        font-weight: 800;
        text-align: center;
        background: #fffdfa;
        color: var(--text);
        font-family: inherit;
    }

    .servings-input:focus {
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
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

    .media-wrap {
        margin-top: 24px;
        display: grid;
        gap: 16px;
    }

    .media-card {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 20px;
        padding: 16px;
    }

    .media-img,
    .media-video {
        width: 100%;
        display: block;
        border: 1px solid var(--line);
        border-radius: 16px;
        overflow: hidden;
        background: #fffdfa;
    }

    .media-img {
        max-height: 520px;
        object-fit: cover;
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

    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 16px;
    }

    .meta-item {
        background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
        transition: 0.18s ease;
    }

    .meta-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(79, 59, 42, 0.08);
    }

    .meta-icon {
        font-size: 2.1rem;
        margin-bottom: 10px;
    }

    .meta-item h4 {
        color: var(--accent);
        margin-bottom: 6px;
        font-size: 16px;
        font-weight: 800;
    }

    .meta-item p {
        color: var(--muted);
        font-weight: 700;
        line-height: 1.6;
        word-break: break-word;
    }

    .content-inner {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 20px;
        padding: 24px;
    }

    .ingredient-list,
    .instruction-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .ingredient-list li,
    .instruction-list li {
        padding: 14px 0;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    .ingredient-list li:last-child,
    .instruction-list li:last-child {
        border-bottom: none;
    }

    .ingredient-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .ingredient-check {
        color: var(--success-text);
        font-weight: 900;
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
        line-height: 1.7;
        word-break: break-word;
    }

    .old-format-note {
        margin-bottom: 14px;
        color: var(--muted);
        font-weight: 700;
        line-height: 1.7;
    }

    .instruction-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .step-badge {
        background: var(--accent);
        color: #fffaf4;
        min-width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        flex-shrink: 0;
        margin-top: 2px;
        box-shadow: 0 8px 18px rgba(122, 90, 67, 0.20);
    }

    .instruction-text {
        color: var(--text);
        font-size: 16px;
        line-height: 1.8;
        word-break: break-word;
    }

    .author-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
    }

    .author-box {
        background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 18px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
    }

    .author-box h4 {
        color: var(--accent);
        margin-bottom: 6px;
        font-size: 15px;
    }

    .author-box p {
        color: var(--muted);
        font-weight: 700;
        line-height: 1.6;
        word-break: break-word;
    }

    .flash-success {
        background: var(--success-bg);
        color: var(--success-text);
        border: 1px solid #d8e1cf;
        border-radius: 18px;
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
        display: inline-flex;
        padding: 9px 14px;
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 999px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        color: var(--accent);
        font-weight: 800;
        text-align: center;
    }

    .review-card,
    .comment-card,
    .reply-card,
    .comment-form-box {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 20px;
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
        word-break: break-word;
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
        line-height: 1.8;
        word-break: break-word;
    }

    .stars {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 6px;
        flex-wrap: wrap;
    }

    .stars input {
        display: none;
    }

    .stars label {
        cursor: pointer;
        font-size: 26px;
        color: rgba(0,0,0,0.25);
        transition: 0.15s ease;
        line-height: 1;
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
        border-radius: 14px;
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
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
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
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 18px;
        padding: 20px;
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
        display: flex;
        flex-direction: column;
    }

    .related-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
    }

    .related-item h4 {
        color: var(--accent);
        margin-bottom: 10px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 1.4rem;
        font-weight: 500;
        word-break: break-word;
    }

    .related-item p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 15px;
        flex: 1 1 auto;
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
        line-height: 1.6;
    }

    .empty-review,
    .empty-comment,
    .comment-login-note {
        text-align: center;
        color: var(--muted);
    }

    .comment-form-title {
        font-weight: 800;
        margin-bottom: 12px;
        color: var(--text);
    }

    .review-info-grid {
        display: grid;
        gap: 14px;
        margin-top: 12px;
    }

    .review-info-box {
        background: #fffdfa;
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 16px;
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
        border-radius: 14px;
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
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 16px;
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
        border-radius: 12px;
        background: #fff;
        color: var(--text);
        font-weight: 700;
        transition: 0.2s ease;
        min-width: 44px;
        justify-content: center;
    }

    .comments-pagination-wrap a.relative.inline-flex.items-center:hover,
    .comments-pagination-wrap a.inline-flex.items-center:hover {
        background: var(--surface-soft);
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

    .inline-note-title {
        font-weight: 800;
        margin-bottom: 12px;
    }

    .section-action-btn {
        width: 100%;
    }
</style>

<div class="recipe-show-page">
    <div class="recipe-show-stack">

        <div class="recipe-section-card recipe-hero-card">
            <div class="recipe-hero-head">
                <div class="recipe-hero-left">
                    <div class="recipe-badge">Recepte</div>
                    <h2 class="recipe-main-title">{{ $recipe->title }}</h2>

                    @if(!empty($recipe->description))
                        <p class="recipe-description">
                            {{ $recipe->description }}
                        </p>
                    @endif
                </div>

                <div class="recipe-fav-wrap">
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
            </div>

            <div class="recipe-top-meta">
                <span class="recipe-top-badge">👁️ Skatījumi: {{ number_format((int)($recipe->views ?? 0), 0, ',', ' ') }}</span>
                <span class="recipe-top-badge">📅 Publicēta: {{ $recipe->created_at->format('d.m.Y') }}</span>
                <span class="recipe-top-badge">👨‍🍳 Autors: {{ $recipe->user->name }}</span>
            </div>

            <div class="servings-card">
                <div class="servings-control">
                    <span class="servings-label">Porcijas:</span>
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
                    <a href="{{ route('pdf.recipe.full', $recipe->id) }}" class="btn btn-secondary pdf-link" data-type="full">PDF pilns</a>
                    <a href="{{ route('pdf.recipe.ingredients', $recipe->id) }}" class="btn btn-secondary pdf-link" data-type="ingredients">Sastāvdaļas</a>
                    <a href="{{ route('pdf.recipe.steps', $recipe->id) }}" class="btn btn-secondary pdf-link" data-type="steps">Soļi</a>
                </div>
            </div>

            @if($imageUrl || $videoUrl)
                <div class="media-wrap">
                    @if($imageUrl)
                        <div class="media-card">
                            <img src="{{ $imageUrl }}" alt="Receptes attēls" class="media-img">
                        </div>
                    @endif

                    @if($videoUrl)
                        <div class="media-card">
                            <video controls class="media-video">
                                <source src="{{ $videoUrl }}">
                                Jūsu pārlūks neatbalsta video.
                            </video>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="recipe-section-card">
            <div class="section-head">
                <div class="section-kicker">Pamatinformācija</div>
                <h3 class="section-title">Receptes informācija</h3>
                <p class="section-subtext">
                    Šeit redzama galvenā informācija par recepti, tās grūtības līmeni, laiku, porcijām un kalorijām.
                </p>
            </div>

            <div class="meta-grid">
                <div class="meta-item">
                    <div class="meta-icon">📂</div>
                    <h4>Kategorija</h4>
                    <p>{{ $recipeCategory }}</p>
                </div>

                <div class="meta-item">
                    <div class="meta-icon">⭐</div>
                    <h4>Grūtība</h4>
                    <p>{{ $recipeDifficulty }}</p>
                </div>

                @if(!is_null($recipe->prep_time))
                    <div class="meta-item">
                        <div class="meta-icon">🔪</div>
                        <h4>Sagatavošana</h4>
                        <p><span id="prepTime" data-original="{{ $origPrep }}">{{ $origPrep }}</span> minūtes</p>
                    </div>
                @endif

                @if(!is_null($recipe->cook_time))
                    <div class="meta-item">
                        <div class="meta-icon">🔥</div>
                        <h4>Gatavošana</h4>
                        <p><span id="cookTime" data-original="{{ $origCook }}">{{ $origCook }}</span> minūtes</p>
                    </div>
                @endif

                <div class="meta-item">
                    <div class="meta-icon">⏱️</div>
                    <h4>Kopā laiks</h4>
                    <p><span id="totalTime" data-original="{{ $origTotal }}">{{ $origTotal }}</span> minūtes</p>
                </div>

                <div class="meta-item">
                    <div class="meta-icon">👥</div>
                    <h4>Porcijas</h4>
                    <p><span id="servingsDisplay" data-original="{{ $origServings }}">{{ $origServings }}</span> porcijas</p>
                </div>

                @if(!is_null($recipe->calories))
                    <div class="meta-item">
                        <div class="meta-icon">🔥</div>
                        <h4>Kalorijas</h4>
                        <p>{{ number_format((float)$recipe->calories, 0, ',', ' ') }} kcal</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="recipe-section-card">
            <div class="section-head">
                <div class="section-kicker">Sastāvdaļas</div>
                <h3 class="section-title">Kas būs nepieciešams</h3>
                <p class="section-subtext">
                    Pielāgojot porciju skaitu, sastāvdaļu daudzumi automātiski pārrēķināsies.
                </p>
            </div>

            <div class="content-inner">
                @if($ingredientsRel instanceof \Illuminate\Support\Collection && $ingredientsRel->count() > 0)
                    <ul class="ingredient-list">
                        @foreach($ingredientsRel as $ing)
                            <li>
                                <div class="ingredient-row">
                                    <span class="ingredient-check">✓</span>

                                    @php
                                        $q = $ing->quantity ?? null;
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
                        Šai receptei sastāvdaļas vēl ir vecajā formātā, tāpēc automātiska pārrēķināšana un kaloriju aprēķins var nebūt pieejams.
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

        <div class="recipe-section-card">
            <div class="section-head">
                <div class="section-kicker">Pagatavošana</div>
                <h3 class="section-title">Soli pa solim instrukcijas</h3>
                <p class="section-subtext">
                    Sekojiet norādījumiem, lai veiksmīgi pagatavotu recepti no sākuma līdz beigām.
                </p>
            </div>

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

        <div class="recipe-section-card">
            <div class="section-head">
                <div class="section-kicker">Autors</div>
                <h3 class="section-title">Par šo recepti</h3>
                <p class="section-subtext">
                    Papildu informācija par receptes autoru un publicēšanas laiku.
                </p>
            </div>

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

        <div class="recipe-section-card">
            <div class="section-head">
                <div class="section-kicker">Vērtējumi</div>
                <h3 class="section-title">Ko saka citi</h3>
                <p class="section-subtext">
                    Skatiet kopējo novērtējumu un, ja vēlaties, pievienojiet savu vērtējumu.
                </p>
            </div>

            <div class="review-summary">
                <span class="review-badge">
                    Vidējais vērtējums: {{ $avgRounded ?? 'Nav' }}@if($avgRounded) / 5 @endif ({{ $count }})
                </span>
            </div>

            @auth
                <div class="review-card" style="margin-bottom: 18px;">
                    @if(!$myReview)
                        <div class="inline-note-title">Tavs vērtējums</div>

                        <form method="POST" action="{{ route('recipes.reviews.store', $recipe) }}">
                            @csrf

                            <div style="margin-bottom:14px;">
                                <label class="review-label" style="margin-bottom:10px;">Vērtējums</label>

                                <div class="stars">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                        <label for="star{{ $i }}">★</label>
                                    @endfor
                                </div>

                                @error('rating')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success section-action-btn" style="margin-top:12px;">
                                Saglabāt vērtējumu
                            </button>
                        </form>
                    @else
                        <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap;">
                            <div>
                                <div class="inline-note-title" style="margin-bottom:0;">Tavs vērtējums</div>
                            </div>

                            <div class="review-actions">
                                <button
                                    class="btn btn-warning"
                                    type="button"
                                    onclick="document.getElementById('edit-review-form').style.display='block'; this.style.display='none';">
                                    Rediģēt
                                </button>

                                <form
                                    method="POST"
                                    action="{{ route('recipes.reviews.destroy', $recipe) }}"
                                    data-confirm-delete
                                    data-confirm-message="Vai tiešām vēlaties dzēst savu vērtējumu? Šī darbība ir neatgriezeniska."
                                >
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
                                        @for($s = 1; $s <= 5; $s++)
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
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="editStar{{ $i }}" name="rating" value="{{ $i }}"
                                               @checked((int)$myReview->rating === $i) required>
                                        <label for="editStar{{ $i }}">★</label>
                                    @endfor
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success section-action-btn" style="margin-top:12px;">
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
                                    @for($s = 1; $s <= 5; $s++)
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

        <div class="recipe-section-card">
            <div class="section-head">
                <div class="section-kicker">Komentāri</div>
                <h3 class="section-title">Saruna par recepti</h3>
                <p class="section-subtext">
                    Uzdodiet jautājumus, atstājiet atsauksmes un atbildiet citiem lietotājiem.
                </p>
            </div>

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

                        <button type="submit" class="btn btn-success section-action-btn" style="margin-top:12px;">
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

                                <button type="submit" class="btn btn-primary section-action-btn" style="margin-top:12px;">
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

        <div class="recipe-section-card">
            <div class="page-actions">
                @if(Auth::id() === $recipe->user_id)
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">
                        Rediģēt recepti
                    </a>

                    <form
                        method="POST"
                        action="{{ route('recipes.destroy', $recipe) }}"
                        data-confirm-delete
                        data-confirm-message="Vai tiešām vēlaties dzēst šo recepti? Šī darbība ir neatgriezeniska."
                    >
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
            <div class="recipe-section-card">
                <div class="section-head">
                    <div class="section-kicker">Ieteikumi</div>
                    <h3 class="section-title">Līdzīgas receptes</h3>
                    <p class="section-subtext">
                        Ja šī recepte jums patika, iespējams, patiks arī šīs līdzīgās idejas.
                    </p>
                </div>

                <div class="related-grid">
                    @foreach($relatedRecipes as $relatedRecipe)
                        @php
                            $relatedCategory = $relatedRecipe->category->name ?? $relatedRecipe->category ?? '';
                        @endphp

                        <div class="related-item">
                            <h4>{{ $relatedRecipe->title }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit($relatedRecipe->description, 80) }}</p>

                            <div class="related-meta">
                                <span>{{ $relatedCategory }}</span>
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
</div>

<script>
(() => {
    const input = document.getElementById('servingsInput');
    if (!input) return;

    const servingsDisplay = document.getElementById('servingsDisplay');
    const prepEl = document.getElementById('prepTime');
    const cookEl = document.getElementById('cookTime');
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
            const orig = parseFloat(raw);
            if (!Number.isFinite(orig)) return;

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
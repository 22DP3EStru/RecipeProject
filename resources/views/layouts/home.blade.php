@extends('layouts.app')

@section('title', 'Vecmāmiņas Receptes - Garšas, kas paliek atmiņā')

@section('content')
<style>
    .home-page {
        color: #2f241d;
    }

    .home-hero {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 28px;
        align-items: stretch;
        margin-bottom: 42px;
    }

    .home-hero-left {
        background: #fffdf9;
        border: 1px solid #ddcfc0;
        padding: 42px;
    }

    .home-hero-right {
        background: linear-gradient(180deg, #f8f1e8 0%, #f0e4d5 100%);
        border: 1px solid #ddcfc0;
        padding: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
    }

    .home-eyebrow {
        color: #7b6d61;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .home-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3.4rem;
        line-height: 1.05;
        color: #7a5a43;
        font-weight: 500;
        margin-bottom: 16px;
    }

    .home-text {
        color: #7b6d61;
        font-size: 16px;
        line-height: 1.85;
        max-width: 620px;
        margin-bottom: 26px;
    }

    .home-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .home-btn {
        display: inline-block;
        padding: 13px 18px;
        text-decoration: none;
        border: 1px solid #ddcfc0;
        font-size: 14px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .home-btn:hover {
        filter: brightness(0.98);
    }

    .home-btn-primary {
        background: #7a5a43;
        border-color: #7a5a43;
        color: #fffaf4;
    }

    .home-btn-secondary {
        background: #f6efe7;
        color: #2f241d;
    }

    .home-hero-card {
        width: 100%;
        max-width: 360px;
        background: #fffdf9;
        border: 1px solid #ddcfc0;
        padding: 26px;
    }

    .home-hero-card h3 {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: #7a5a43;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .home-hero-card p {
        color: #7b6d61;
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 18px;
    }

    .home-section {
        margin-bottom: 44px;
        padding: 34px;
        background: rgba(255, 253, 249, 0.75);
        border: 1px solid #ddcfc0;
    }

    .home-section-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.4rem;
        color: #7a5a43;
        font-weight: 500;
        text-align: center;
        margin-bottom: 10px;
    }

    .home-section-text {
        text-align: center;
        color: #7b6d61;
        max-width: 700px;
        margin: 0 auto 28px;
        line-height: 1.8;
        font-size: 15px;
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
    }

    .category-card {
        background: #fffdf9;
        border: 1px solid #ddcfc0;
        padding: 20px 16px;
        text-align: center;
        text-decoration: none;
        color: #2f241d;
        transition: 0.2s ease;
    }

    .category-card:hover {
        background: #f6efe7;
    }

    .category-image {
        width: 72px;
        height: 72px;
        margin: 0 auto 14px;
        border-radius: 999px;
        object-fit: cover;
        border: 1px solid #ddcfc0;
    }

    .category-name {
        font-weight: 700;
        margin-bottom: 6px;
        color: #2f241d;
    }

    .category-count {
        font-size: 13px;
        color: #7b6d61;
    }

    @media (max-width: 1100px) {
        .home-hero {
            grid-template-columns: 1fr;
        }

        .featured-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .categories-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .home-hero-left,
        .home-hero-right,
        .home-section {
            padding: 22px;
        }

        .home-title {
            font-size: 2.3rem;
        }

        .featured-grid,
        .categories-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<link rel="icon" href="{{ asset('favicon.ico') }}">
<div class="home-page">
    <section class="home-hero">
        <div class="home-hero-left">
            <div class="home-eyebrow">Vecmāmiņas Receptes</div>
            <h1 class="home-title">Atklāj gardas receptes ikvienai dienai</h1>
            <p class="home-text">
                No ātrām ikdienas vakariņām līdz īpašiem desertiem — atrodi iedvesmu, saglabā iecienītākās receptes un izbaudi mājīgu recepšu vidi.
            </p>

            <div class="home-actions">
                <a href="{{ route('recipes.index') }}" class="home-btn home-btn-primary">
                    Skatīt receptes
                </a>
                <a href="{{ route('categories.index') }}" class="home-btn home-btn-secondary">
                    Skatīt kategorijas
                </a>
            </div>
        </div>

        <div class="home-hero-right">
            <div class="home-hero-card">
                <h3>Mājas garša</h3>
                <p>
                    Vienkārša, skaista un pārskatāma vieta, kur atrast jaunus ēdienus, saglabāt favorītus un veidot savu personīgo recepšu kolekciju.
                </p>
                <a href="{{ route('recipes.index') }}" class="home-btn home-btn-primary">
                    Sākt pārlūkot
                </a>
            </div>
        </div>
    </section>

    <section class="home-section">
        <h2 class="home-section-title">Izceltās receptes</h2>
        <p class="home-section-text">
            Apskati populārākās un iedvesmojošākās receptes, ko šobrīd vērts izmēģināt.
        </p>

        <div class="featured-grid">
            @foreach($featuredRecipes as $recipe)
                @include('components.recipe-card', ['recipe' => $recipe])
            @endforeach
        </div>
    </section>

    <section class="home-section">
        <h2 class="home-section-title">Pārlūkot pēc kategorijām</h2>
        <p class="home-section-text">
            Izvēlies kategoriju un atrodi receptes, kas vislabāk atbilst tavai gaumei un šodienas noskaņai.
        </p>

        <div class="categories-grid">
            @foreach($categories as $category)
                <a href="{{ route('recipes.index', ['category' => $category->slug]) }}" class="category-card">
                    @if($category->image)
                        <img
                            src="{{ Storage::url($category->image) }}"
                            alt="{{ $category->name }}"
                            class="category-image">
                    @endif

                    <div class="category-name">{{ $category->name }}</div>
                    <div class="category-count">{{ $category->recipes_count }} receptes</div>
                </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
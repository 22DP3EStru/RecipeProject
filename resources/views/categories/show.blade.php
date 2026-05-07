{{--
    Kategorijas recepšu saraksta skats.

    Šis Blade fails nodrošina konkrētas recepšu kategorijas lapu tīmekļa vietnē
    “Vecmāmiņas Receptes”. Skats parāda visas receptes, kas pieder izvēlētajai
    kategorijai, kā arī sniedz lietotājam īsu informāciju par kategorijas saturu.

    Failā ir iekļauta kategorijas virsraksta informācija, navigācijas ceļš,
    recepšu kartīšu režģis, recepšu pamatinformācija, vērtējumu attēlošana,
    autora informācija un poga pilnas receptes atvēršanai. Ja kategorijā nav
    nevienas receptes, lietotājam tiek parādīts tukša saraksta paziņojums.

    Skatā iekļautais CSS nosaka kategorijas lapas struktūru, navigācijas ceļu,
    sadaļas kartītes, recepšu kartītes, metadatu blokus, vērtējumu rindu,
    autora informāciju un tukša saraksta paziņojumu.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', $categoryName . ' - Vecmāmiņas Receptes')

{{-- Norāda lapas meta aprakstu, izmantojot konkrētās kategorijas nosaukumu --}}
@section('meta_description', 'Apskatiet receptes kategorijā ' . $categoryName . '.')

{{-- Norāda hero sadaļas virsrakstu --}}
@section('hero_title', $categoryName)

{{-- Norāda hero sadaļas paskaidrojuma tekstu --}}
@section('hero_text', 'Apskatiet visas receptes šajā kategorijā.')

@section('content')

<style>
    /* Noformē kategorijas lapas pamatteksta krāsu */
    .categories-page {
        color: var(--text);
    }

    /* Sakārto kategorijas lapas galvenos blokus vertikālā izkārtojumā */
    .categories-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Noformē kopīgo sadaļu kartīšu izskatu */
    .categories-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    /* Noformē navigācijas ceļa kartīti */
    .breadcrumbs-card {
        padding: 16px 20px;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
    }

    /* Noformē navigācijas ceļa saites */
    .breadcrumbs-card a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 800;
    }

    /* Noformē navigācijas ceļa parasto tekstu */
    .breadcrumbs-card span {
        color: var(--muted);
    }

    /* Noformē sadaļas galvenes bloku */
    .section-head {
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    /* Noformē mazo kategorijas apzīmējumu virs virsraksta */
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

    /* Noformē sadaļas virsrakstu */
    .section-title {
        color: var(--accent);
        font-family: Georgia, serif;
        font-size: 2rem;
        margin-bottom: 8px;
    }

    /* Noformē sadaļas paskaidrojuma tekstu */
    .section-subtext {
        color: var(--muted);
        font-size: 14px;
    }

    /* Sakārto receptes kartītes režģī */
    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, 300px);
        gap: 22px;
        justify-content: start;
    }

    /* Noformē vienu receptes kartīti */
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

    /* Pievieno nelielu pacelšanas efektu, uzbraucot ar peli uz receptes kartītes */
    .recipe-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
    }

    /* Noformē receptes kartītes augšējo daļu */
    .recipe-card-top {
        padding: 24px 24px 16px;
        min-height: 150px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
    }

    /* Noformē receptes nosaukumu kartītē */
    .recipe-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.8rem;
        font-weight: 500;
        margin-bottom: 12px;
        line-height: 1.16;
        word-break: break-word;
    }

    /* Noformē receptes īso aprakstu kartītē */
    .recipe-description {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
    }

    /* Noformē receptes kartītes apakšējo daļu */
    .recipe-card-body {
        padding: 20px 24px 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    /* Sakārto receptes metadatus divās kolonnās */
    .recipe-meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    /* Noformē vienu receptes metadatu bloku */
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

    /* Noformē metadatu ikonu */
    .recipe-meta-icon {
        font-size: 1rem;
        flex-shrink: 0;
    }

    /* Noformē receptes vērtējuma rindu */
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

    /* Izceļ receptes vidējo vērtējumu */
    .rating-value {
        font-weight: 800;
        color: var(--text);
    }

    /* Noformē vērtējumu skaita tekstu */
    .rating-count {
        color: var(--muted);
    }

    /* Noformē zvaigžņu vizuālo attēlojumu */
    .rating-stars {
        margin-left: auto;
        color: #b9872f;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* Atdala autora informāciju no pārējās kartītes informācijas */
    .author-row {
        border-top: 1px solid rgba(221, 207, 192, 0.9);
        padding-top: 15px;
        margin-bottom: 18px;
    }

    /* Sakārto autora vārdu un receptes publicēšanas laiku */
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

    /* Nodrošina, ka receptes skatīšanas poga aizņem visu kartītes platumu */
    .recipe-card .btn {
        width: 100%;
    }

    /* Noformē paziņojumu, ja kategorijā nav recepšu */
    .empty-box {
        text-align: center;
        padding: 60px;
    }
</style>

{{-- Galvenais kategorijas lapas konteiners --}}
<div class="categories-page">

    {{-- Vertikāls izkārtojums visām kategorijas lapas sadaļām --}}
    <div class="categories-stack">

        {{-- Navigācijas ceļš līdz konkrētajai kategorijai --}}
        <div class="categories-section-card breadcrumbs-card">
            <a href="/dashboard">Vadības panelis</a>
            <span> / </span>
            <a href="/categories">Kategorijas</a>
            <span> / </span>
            <span>{{ $categoryName }}</span>
        </div>

        {{-- Galvenā kategorijas satura kartīte --}}
        <div class="categories-section-card">

            {{-- Kategorijas sadaļas galvene --}}
            <div class="section-head">
                <div class="section-kicker">Kategorija</div>
                <h3 class="section-title">{{ $categoryName }}</h3>
                <p class="section-subtext">
                    Visas receptes šajā kategorijā.
                </p>
            </div>

            {{-- Pārbauda, vai konkrētajā kategorijā ir pievienotas receptes --}}
            @if($recipes->count() > 0)

                {{-- Režģis ar visām kategorijas receptēm --}}
                <div class="recipes-grid">

                    {{-- Cikls izvada katru recepti kā atsevišķu kartīti --}}
                    @foreach($recipes as $recipe)

                        {{--
                            Aprēķina un sagatavo receptes kartītē attēlojamos datus.
                            Ja kāda vērtība nav norādīta, tiek izmantota noklusējuma vērtība.
                        --}}
                        @php
                            $recipeCategoryName = $recipe->category->name ?? $recipe->category ?? 'Nav kategorijas';
                            $recipeDifficultyName = $recipe->difficulty ?? 'Nav norādīta';
                            $totalTime = (int)($recipe->prep_time ?? 0) + (int)($recipe->cook_time ?? 0);
                            $roundedRating = (int) round($recipe->reviews_avg_rating ?? 0);
                        @endphp

                        {{-- Vienas receptes kartīte --}}
                        <div class="recipe-card">

                            {{-- Kartītes augšējā daļa ar nosaukumu un īso aprakstu --}}
                            <div class="recipe-card-top">

                                {{-- Receptes nosaukums --}}
                                <h3 class="recipe-title">{{ $recipe->title }}</h3>

                                {{-- Saīsināts receptes apraksts, lai kartītes saglabātu vienotu izmēru --}}
                                <p class="recipe-description">
                                    {{ \Illuminate\Support\Str::limit($recipe->description, 100) }}
                                </p>
                            </div>

                            {{-- Kartītes apakšējā daļa ar metadatiem un pogu --}}
                            <div class="recipe-card-body">

                                {{-- Receptes pamatinformācijas režģis --}}
                                <div class="recipe-meta-grid">

                                    {{-- Receptes kategorija --}}
                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">📂</span>
                                        <span>{{ $recipeCategoryName }}</span>
                                    </div>

                                    {{-- Receptes sarežģītības līmenis --}}
                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">⭐</span>
                                        <span>{{ $recipeDifficultyName }}</span>
                                    </div>

                                    {{-- Kopējais pagatavošanas laiks --}}
                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">⏱️</span>
                                        <span>{{ $totalTime > 0 ? $totalTime : 'N/A' }} min</span>
                                    </div>

                                    {{-- Porciju skaits --}}
                                    <div class="recipe-meta-item">
                                        <span class="recipe-meta-icon">👥</span>
                                        <span>{{ $recipe->servings ?? 'N/A' }} porcijas</span>
                                    </div>
                                </div>

                                {{-- Receptes vērtējuma informācija --}}
                                <div class="rating-row">

                                    {{-- Vidējais vērtējums vai paziņojums, ja vērtējumu nav --}}
                                    <span class="rating-value">
                                        {{ $recipe->reviews_avg_rating ? round($recipe->reviews_avg_rating, 1) : 'Nav vērtējumu' }} / 5
                                    </span>

                                    {{-- Kopējais vērtējumu skaits --}}
                                    <span class="rating-count">
                                        ({{ $recipe->reviews_count ?? 0 }})
                                    </span>

                                    {{-- Zvaigžņu attēlojums, pamatojoties uz noapaļoto vērtējumu --}}
                                    <span class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            {!! $i <= $roundedRating ? '★' : '☆' !!}
                                        @endfor
                                    </span>
                                </div>

                                {{-- Receptes autora un publicēšanas laika informācija --}}
                                <div class="author-row">
                                    <div class="author-meta">

                                        {{-- Receptes autora vārds --}}
                                        <span>Autors: {{ $recipe->user->name ?? 'Nezināms autors' }}</span>

                                        {{-- Relatīvs publicēšanas laiks, piemēram, “pirms 2 dienām” --}}
                                        <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                {{-- Saite uz pilnu receptes apskates lapu --}}
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                    Skatīt recepti
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            @else

                {{-- Paziņojums, kas tiek rādīts, ja kategorijā vēl nav nevienas receptes --}}
                <div class="empty-box">
                    <h3>Nav recepšu</h3>
                    <p>Šajā kategorijā vēl nav nevienas receptes.</p>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
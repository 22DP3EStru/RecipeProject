@extends('layouts.app')

{{--
    Sākumlapas skats.

    Šis Blade fails attēlo vietnes galveno sākumlapu.
    Tajā tiek parādīta:
    - ievadsadaļa ar galveno tekstu;
    - pogas uz recepšu un kategoriju lapām;
    - izceltās receptes;
    - recepšu kategoriju saraksts.

    Dati šajā skatā tiek saņemti no kontroliera:
    - $featuredRecipes satur izceltās receptes;
    - $categories satur kategorijas ar recepšu skaitu.
--}}

@section('title', 'Vecmāmiņas Receptes - Garšas, kas paliek atmiņā')
@section('meta_description', 'Atklāj gardas receptes ikvienai dienai, pārlūko kategorijas, saglabā favorītus un atrodi iedvesmu savai virtuvei.')

@section('content')
<style>
    /*
        Sākumlapas lokālie CSS stili.

        Šie stili attiecas tikai uz sākumlapu un nosaka:
        - galvenās ievadsadaļas izkārtojumu;
        - pogu izskatu;
        - izcelto recepšu režģi;
        - kategoriju kartīšu izkārtojumu.
    */

    /* Galvenais sākumlapas konteiners. */
    .home-page {
        color: #2f241d;
    }

    /*
        Sākumlapas galvenā hero sadaļa.

        Tā ir sadalīta divās kolonnās:
        - kreisajā pusē atrodas galvenais teksts un pogas;
        - labajā pusē atrodas informatīva kartīte.
    */
    .home-hero {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 28px;
        align-items: stretch;
        margin-bottom: 42px;
    }

    /* Kreisā hero sadaļas daļa ar galveno tekstu. */
    .home-hero-left {
        background: #fffdf9;
        border: 1px solid #ddcfc0;
        padding: 42px;
    }

    /* Labā hero sadaļas daļa ar dekoratīvu fonu un informatīvu kartīti. */
    .home-hero-right {
        background: linear-gradient(180deg, #f8f1e8 0%, #f0e4d5 100%);
        border: 1px solid #ddcfc0;
        padding: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
    }

    /* Neliels augšējais teksts virs galvenā virsraksta. */
    .home-eyebrow {
        color: #7b6d61;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    /* Sākumlapas galvenais virsraksts. */
    .home-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3.4rem;
        line-height: 1.05;
        color: #7a5a43;
        font-weight: 500;
        margin-bottom: 16px;
    }

    /* Galvenais ievadteksts zem virsraksta. */
    .home-text {
        color: #7b6d61;
        font-size: 16px;
        line-height: 1.85;
        max-width: 620px;
        margin-bottom: 26px;
    }

    /*
        Darbību pogu konteiners.

        flex-wrap ļauj pogām pāriet nākamajā rindā,
        ja ekrāna platums ir nepietiekams.
    */
    .home-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Kopējā sākumlapas pogu klase. */
    .home-btn {
        display: inline-block;
        padding: 13px 18px;
        text-decoration: none;
        border: 1px solid #ddcfc0;
        font-size: 14px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    /* Pogas hover efekts. */
    .home-btn:hover {
        filter: brightness(0.98);
    }

    /* Galvenā darbības poga. */
    .home-btn-primary {
        background: #7a5a43;
        border-color: #7a5a43;
        color: #fffaf4;
    }

    /* Sekundārā darbības poga. */
    .home-btn-secondary {
        background: #f6efe7;
        color: #2f241d;
    }

    /*
        Labās puses hero kartīte.

        Tā īsi paskaidro vietnes galveno ideju un satur saiti uz recepšu pārlūkošanu.
    */
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

    /*
        Sākumlapas sadaļas bloks.

        Šī klase tiek izmantota gan izcelto recepšu sadaļai,
        gan kategoriju sadaļai.
    */
    .home-section {
        margin-bottom: 44px;
        padding: 34px;
        background: rgba(255, 253, 249, 0.75);
        border: 1px solid #ddcfc0;
    }

    /* Sadaļas virsraksts. */
    .home-section-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.4rem;
        color: #7a5a43;
        font-weight: 500;
        text-align: center;
        margin-bottom: 10px;
    }

    /* Sadaļas paskaidrojošais teksts. */
    .home-section-text {
        text-align: center;
        color: #7b6d61;
        max-width: 700px;
        margin: 0 auto 28px;
        line-height: 1.8;
        font-size: 15px;
    }

    /*
        Izcelto recepšu režģis.

        Katra recepte tiek attēlota ar atsevišķu recipe-card komponentu.
    */
    .featured-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    /*
        Kategoriju režģis.

        Sākumlapā kategorijas tiek attēlotas sešās kolonnās,
        lai lietotājs varētu ātri izvēlēties sev interesējošo sadaļu.
    */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
    }

    /*
        Vienas kategorijas kartīte.

        Kartīte vienlaikus ir arī saite uz recepšu sarakstu,
        kas filtrēts pēc konkrētās kategorijas.
    */
    .category-card {
        background: #fffdf9;
        border: 1px solid #ddcfc0;
        padding: 20px 16px;
        text-align: center;
        text-decoration: none;
        color: #2f241d;
        transition: 0.2s ease;
    }

    /* Hover efekts kategorijas kartītei. */
    .category-card:hover {
        background: #f6efe7;
    }

    /* Kategorijas attēls, ja tas ir pievienots datubāzē. */
    .category-image {
        width: 72px;
        height: 72px;
        margin: 0 auto 14px;
        border-radius: 999px;
        object-fit: cover;
        border: 1px solid #ddcfc0;
    }

    /* Kategorijas nosaukums. */
    .category-name {
        font-weight: 700;
        margin-bottom: 6px;
        color: #2f241d;
    }

    /* Recepšu skaits konkrētajā kategorijā. */
    .category-count {
        font-size: 13px;
        color: #7b6d61;
    }
</style>

<div class="home-page">

    <!--
        Galvenā sākumlapas ievadsadaļa.

        Šī sadaļa lietotājam paskaidro vietnes pamatmērķi
        un piedāvā ātras darbības: skatīt receptes vai kategorijas.
    -->
    <section class="home-hero">
        <div class="home-hero-left">
            <div class="home-eyebrow">Vecmāmiņas Receptes</div>

            <h1 class="home-title">Atklāj gardas receptes ikvienai dienai</h1>

            <p class="home-text">
                No ātrām ikdienas vakariņām līdz īpašiem desertiem — atrodi iedvesmu, saglabā iecienītākās receptes un izbaudi mājīgu recepšu vidi.
            </p>

            <!-- Galvenās darbību pogas uz recepšu un kategoriju sadaļām. -->
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

    <!--
        Izcelto recepšu sadaļa.

        $featuredRecipes masīvs tiek padots no kontroliera.
        Katra recepte tiek attēlota, izmantojot atkārtoti lietojamu recipe-card komponentu.
    -->
    <section class="home-section">
        <h2 class="home-section-title">Izceltās receptes</h2>

        <p class="home-section-text">
            Apskati populārākās un iedvesmojošākās receptes, ko šobrīd vērts izmēģināt.
        </p>

        <div class="featured-grid">
            @foreach($featuredRecipes as $recipe)
                {{-- Atsevišķas receptes kartītes attēlošanai tiek izmantots kopīgs komponents. --}}
                @include('components.recipe-card', ['recipe' => $recipe])
            @endforeach
        </div>
    </section>

    <!--
        Kategoriju sadaļa.

        Šajā sadaļā lietotājs var izvēlēties kategoriju,
        pēc kuras tiks filtrēts recepšu saraksts.
    -->
    <section class="home-section">
        <h2 class="home-section-title">Pārlūkot pēc kategorijām</h2>

        <p class="home-section-text">
            Izvēlies kategoriju un atrodi receptes, kas vislabāk atbilst tavai gaumei un šodienas noskaņai.
        </p>

        <div class="categories-grid">
            @foreach($categories as $category)
                <!--
                    Kategorijas kartīte ved uz recepšu sarakstu,
                    kur tiek izmantots category parametrs ar kategorijas slug vērtību.
                -->
                <a href="{{ route('recipes.index', ['category' => $category->slug]) }}" class="category-card">
                    @if($category->image)
                        <!-- Ja kategorijai ir attēls, tas tiek ielādēts no storage mapes. -->
                        <img
                            src="{{ Storage::url($category->image) }}"
                            alt="{{ $category->name }}"
                            class="category-image">
                    @endif

                    <div class="category-name">{{ $category->name }}</div>

                    <!-- recipes_count rāda, cik receptes ir piesaistītas konkrētajai kategorijai. -->
                    <div class="category-count">{{ $category->recipes_count }} receptes</div>
                </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
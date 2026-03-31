@extends('layouts.app')

@section('title', 'Vadības panelis - Vecmāmiņas Receptes')
@section('meta_description', 'Jūsu kulinārais ceļojums turpinās — pārskatiet statistiku, jaunākās receptes un ātrās darbības vienuviet.')

@section('hero_title', 'Sveicināti atpakaļ!')
@section('hero_text', 'Jūsu kulinārais ceļojums turpinās, ' . Auth::user()->name . '.')

@section('content')
<style>
    .dashboard-page {
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
    .stats-box,
    .actions-box,
    .recipes-box,
    .empty-box,
    .tips-box {
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
    .section-title,
    .recipe-card h4,
    .my-recipe-card h4,
    .tip-card h4,
    .stat-number {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .intro-box h2 {
        font-size: 2.3rem;
        margin-bottom: 12px;
    }

    .intro-box p,
    .section-subtext,
    .muted-text {
        color: var(--muted);
        line-height: 1.8;
    }

    .section-title {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.9rem;
    }

    .section-subtext {
        margin-bottom: 22px;
    }

    .grid {
        display: grid;
        gap: 22px;
    }

    .grid-2 {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .grid-3 {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
    }

    .stat-box {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 26px 22px;
        text-align: center;
    }

    .stat-number {
        font-size: 2.8rem;
        display: block;
        margin-bottom: 10px;
        line-height: 1;
    }

    .stat-label {
        font-size: 15px;
        color: var(--muted);
        font-weight: 700;
        line-height: 1.6;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
    }

    .recipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .recipe-card,
    .my-recipe-card,
    .tip-card {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 22px;
        transition: 0.2s ease;
    }

    .recipe-card:hover,
    .my-recipe-card:hover,
    .tip-card:hover {
        background: #fffaf5;
    }

    .recipe-card h4,
    .my-recipe-card h4,
    .tip-card h4 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .recipe-description {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.7;
    }

    .recipe-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 16px;
        font-size: 13px;
        color: var(--muted);
    }

    .my-recipe-card {
        background: var(--success-bg);
        border-color: #d8e1cf;
    }

    .my-recipe-date {
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .my-recipe-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .my-recipe-actions .btn {
        flex: 1;
    }

    .empty-box {
        text-align: center;
        padding: 50px 28px;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .empty-box h4 {
        color: var(--accent);
        margin-bottom: 15px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
    }

    .tip-card {
        height: 100%;
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
        .stats-box,
        .actions-box,
        .recipes-box,
        .empty-box,
        .tips-box {
            padding: 20px;
        }

        .grid-2,
        .grid-3,
        .stats-grid,
        .actions-grid,
        .recipe-grid {
            grid-template-columns: 1fr;
        }

        .my-recipe-actions {
            flex-direction: column;
        }

        .actions-grid .btn,
        .recipe-card .btn,
        .my-recipe-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="dashboard-page">
    <div class="section-block intro-box">
        <div class="intro-icon">👨‍🍳</div>
        <h2>Sveicināti jūsu kulinārijas studijā</h2>
        <p>
            Esiet gatavi radīt, dalīties un atklāt brīnišķīgas receptes. Jūsu nākamā iecienītākā recepte ir tikai dažu klikšķu attālumā.
        </p>
    </div>

    @if(Auth::user()->is_admin)
        <div class="section-block actions-box">
            <h3 class="section-title">🛠 Administrācija</h3>
            <p class="section-subtext">
                Piekļuve administrācijas panelim un platformas pārvaldības statistikām.
            </p>

            <div class="actions-grid">
                <a href="{{ route('admin.index') }}" class="btn btn-primary">Atvērt administrācijas paneli</a>
            </div>
        </div>
    @endif

    <div class="section-block stats-box">
        <h3 class="section-title">📊 Jūsu kulinārijas statistika</h3>
        <p class="section-subtext">
            Īss pārskats par jūsu aktivitāti un kopējo platformas saturu.
        </p>

        <div class="stats-grid">
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\Recipe::where('user_id', Auth::id())->count() }}</span>
                <span class="stat-label">Jūsu receptes</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                <span class="stat-label">Kopā receptes</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\User::count() }}</span>
                <span class="stat-label">Kopienas dalībnieki</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', today())->count() }}</span>
                <span class="stat-label">Šodienas receptes</span>
            </div>
        </div>
    </div>

    <div class="section-block actions-box">
        <h3 class="section-title">🚀 Ātras darbības</h3>
        <p class="section-subtext">
            Ātrākā piekļuve biežāk izmantotajām sadaļām un darbībām.
        </p>

        <div class="actions-grid">
            <a href="/recipes/create" class="btn btn-success">Izveidot jaunu recepti</a>
            <a href="/recipes" class="btn btn-primary">Pārlūkot visas receptes</a>
            <a href="/categories" class="btn btn-warning">Apskatīt kategorijas</a>
            <a href="/profile/recipes" class="btn btn-danger">Manas receptes</a>
            <a href="/profile/favorites" class="btn btn-primary">Mani favorīti</a>
            <a href="{{ route('contact') }}" class="btn btn-secondary">Kontakti</a>
        </div>
    </div>

    @php
        $recentRecipes = \App\Models\Recipe::with('user')->latest()->limit(4)->get();
    @endphp

    @if($recentRecipes->count() > 0)
        <div class="section-block recipes-box">
            <h3 class="section-title">🕒 Jaunākās receptes</h3>
            <p class="section-subtext">
                Pēdējās pievienotās receptes no kopienas.
            </p>

            <div class="recipe-grid">
                @foreach($recentRecipes as $recipe)
                    <div class="recipe-card">
                        <h4>{{ $recipe->title }}</h4>
                        <p class="recipe-description">{{ Str::limit($recipe->description, 80) }}</p>
                        <div class="recipe-meta">
                            <span>Autors: {{ $recipe->user->name }}</span>
                            <span>{{ $recipe->created_at->diffForHumans() }}</span>
                        </div>
                        <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary">Skatīt recepti</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @php
        $myRecentRecipes = \App\Models\Recipe::where('user_id', Auth::id())->latest()->limit(3)->get();
    @endphp

    @if($myRecentRecipes->count() > 0)
        <div class="section-block recipes-box">
            <h3 class="section-title">📝 Jūsu jaunākās receptes</h3>
            <p class="section-subtext">
                Pēdējie jūsu izveidotie ieraksti ar ātru piekļuvi apskatei un rediģēšanai.
            </p>

            <div class="grid grid-3">
                @foreach($myRecentRecipes as $recipe)
                    <div class="my-recipe-card">
                        <h4>{{ $recipe->title }}</h4>
                        <p class="recipe-description">{{ Str::limit($recipe->description, 60) }}</p>
                        <div class="my-recipe-date">
                            Izveidots: {{ $recipe->created_at->diffForHumans() }}
                        </div>
                        <div class="my-recipe-actions">
                            <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary">Skatīt</a>
                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">Rediģēt</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="section-block empty-box">
            <div class="empty-icon">📝</div>
            <h4>Jūs vēl neesat izveidojis nevienu recepti</h4>
            <p class="muted-text" style="margin-bottom: 25px;">
                Sāciet savu kulinārijas ceļojumu, izveidojot savu pirmo recepti.
            </p>
            <a href="/recipes/create" class="btn btn-success">Izveidot pirmo recepti</a>
        </div>
    @endif

    <div class="section-block tips-box">
        <h3 class="section-title">💡 Padomi un ieteikumi</h3>
        <p class="section-subtext">
            Daži noderīgi ieteikumi ērtākai platformas izmantošanai.
        </p>

        <div class="grid grid-2">
            <div class="tip-card">
                <h4>Efektīva meklēšana</h4>
                <p class="muted-text">
                    Izmantojiet meklēšanas filtrus, lai atrastu receptes pēc kategorijas, grūtības līmeņa vai sastāvdaļām.
                </p>
            </div>

            <div class="tip-card">
                <h4>Recepšu rakstīšana</h4>
                <p class="muted-text">
                    Iekļaujiet detalizētas instrukcijas un precīzas sastāvdaļas, lai citi varētu viegli sekot jūsu receptei.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
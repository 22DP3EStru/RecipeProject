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

    .dashboard-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dashboard-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .dashboard-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .dashboard-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .dashboard-hero-icon-wrap {
        width: 108px;
        height: 108px;
        border-radius: 50%;
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        border: 4px solid #f0e5d8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.8rem;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        flex-shrink: 0;
    }

    .dashboard-badge {
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

    .dashboard-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
    }

    .dashboard-main-text {
        color: var(--muted);
        line-height: 1.85;
        font-size: 14px;
        max-width: 820px;
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 18px;
    }

    .stat-box {
        background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 20px;
        padding: 26px 22px;
        text-align: center;
        transition: 0.18s ease;
        box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
    }

    .stat-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(79, 59, 42, 0.08);
    }

    .stat-box.soft-green {
        background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
    }

    .stat-box.soft-pink {
        background: linear-gradient(180deg, #faf0f3 0%, #f6e8ed 100%);
    }

    .stat-box.soft-blue {
        background: linear-gradient(180deg, #edf3f6 0%, #e2ebf0 100%);
    }

    .stat-number {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.7rem;
        display: block;
        margin-bottom: 10px;
        line-height: 1;
        font-weight: 700;
    }

    .stat-label {
        font-size: 15px;
        color: var(--muted);
        font-weight: 700;
        line-height: 1.6;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    .action-card {
        display: block;
        text-decoration: none;
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 20px;
        padding: 20px;
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
        color: var(--text);
    }

    .action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
    }

    .action-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .action-title {
        color: var(--accent);
        font-size: 1.05rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .action-text {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .recipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .recipe-card,
    .my-recipe-card,
    .tip-card {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 20px;
        padding: 22px;
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .recipe-card:hover,
    .my-recipe-card:hover,
    .tip-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
    }

    .recipe-card h4,
    .my-recipe-card h4,
    .tip-card h4 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.5rem;
        margin-bottom: 10px;
        font-weight: 500;
        line-height: 1.2;
    }

    .recipe-description {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.75;
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
        line-height: 1.6;
    }

    .my-recipe-card {
        background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
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
        padding: 56px 28px;
        background: linear-gradient(180deg, #fbf5ee 0%, #f4eadf 100%);
        border: 1px dashed rgba(122, 90, 67, 0.24);
        border-radius: 24px;
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

    .muted-text {
        color: var(--muted);
        line-height: 1.8;
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 18px;
    }

    .tip-card {
        height: 100%;
    }

    @media (max-width: 980px) {
        .dashboard-section-card {
            padding: 22px;
        }

        .dashboard-hero-inner {
            grid-template-columns: 1fr;
        }

        .dashboard-hero-icon-wrap {
            width: 92px;
            height: 92px;
            font-size: 2.4rem;
        }
    }

    @media (max-width: 640px) {
        .dashboard-section-card {
            padding: 20px;
        }

        .stats-grid,
        .actions-grid,
        .recipe-grid,
        .tips-grid {
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

        .dashboard-main-title {
            font-size: 2rem;
        }
    }
</style>

<div class="dashboard-page">
    <div class="dashboard-stack">

        <div class="dashboard-section-card dashboard-hero-card">
            <div class="dashboard-hero-inner">
                <div class="dashboard-hero-icon-wrap">👨‍🍳</div>

                <div>
                    <div class="dashboard-badge">Jūsu panelis</div>
                    <h2 class="dashboard-main-title">Sveicināti jūsu kulinārijas studijā</h2>
                    <p class="dashboard-main-text">
                        Esiet gatavi radīt, dalīties un atklāt brīnišķīgas receptes. Jūsu nākamā iecienītākā recepte
                        ir tikai dažu klikšķu attālumā.
                    </p>
                </div>
            </div>
        </div>

        @if(Auth::user()->is_admin)
            <div class="dashboard-section-card">
                <div class="section-head">
                    <div class="section-kicker">Administrācija</div>
                    <h3 class="section-title">Pārvaldības piekļuve</h3>
                    <p class="section-subtext">
                        Piekļuve administrācijas panelim un platformas pārvaldības statistikām.
                    </p>
                </div>

                <div class="actions-grid">
                    <a href="{{ route('admin.index') }}" class="action-card">
                        <div class="action-icon">🛠</div>
                        <div class="action-title">Administrācijas panelis</div>
                        <div class="action-text">Pārvaldiet lietotājus, receptes un sistēmas saturu.</div>
                    </a>
                </div>
            </div>
        @endif

        <div class="dashboard-section-card">
            <div class="section-head">
                <div class="section-kicker">Statistika</div>
                <h3 class="section-title">Jūsu kulinārijas pārskats</h3>
                <p class="section-subtext">
                    Īss pārskats par jūsu aktivitāti un kopējo platformas saturu.
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::where('user_id', Auth::id())->count() }}</span>
                    <span class="stat-label">Jūsu receptes</span>
                </div>

                <div class="stat-box soft-green">
                    <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                    <span class="stat-label">Kopā receptes</span>
                </div>

                <div class="stat-box soft-blue">
                    <span class="stat-number">{{ \App\Models\User::count() }}</span>
                    <span class="stat-label">Kopienas dalībnieki</span>
                </div>

                <div class="stat-box soft-pink">
                    <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', today())->count() }}</span>
                    <span class="stat-label">Šodienas receptes</span>
                </div>
            </div>
        </div>

        <div class="dashboard-section-card">
            <div class="section-head">
                <div class="section-kicker">Ātrās darbības</div>
                <h3 class="section-title">Viss svarīgākais vienuviet</h3>
                <p class="section-subtext">
                    Ātrākā piekļuve biežāk izmantotajām sadaļām un darbībām.
                </p>
            </div>

            <div class="actions-grid">
                <a href="/recipes/create" class="action-card">
                    <div class="action-icon">➕</div>
                    <div class="action-title">Izveidot jaunu recepti</div>
                    <div class="action-text">Pievienojiet jaunu recepti savai kolekcijai.</div>
                </a>

                <a href="/recipes" class="action-card">
                    <div class="action-icon">📖</div>
                    <div class="action-title">Pārlūkot receptes</div>
                    <div class="action-text">Apskatiet visas kopienas receptes vienuviet.</div>
                </a>

                <a href="/categories" class="action-card">
                    <div class="action-icon">📂</div>
                    <div class="action-title">Apskatīt kategorijas</div>
                    <div class="action-text">Atrodiet receptes pēc jums interesējošām kategorijām.</div>
                </a>

                <a href="/profile/recipes" class="action-card">
                    <div class="action-icon">📝</div>
                    <div class="action-title">Manas receptes</div>
                    <div class="action-text">Pārskatiet un pārvaldiet savas publicētās receptes.</div>
                </a>

                <a href="/profile/favorites" class="action-card">
                    <div class="action-icon">❤️</div>
                    <div class="action-title">Mani favorīti</div>
                    <div class="action-text">Ātri piekļūstiet savām saglabātajām receptēm.</div>
                </a>
            </div>
        </div>

        @php
            $recentRecipes = \App\Models\Recipe::with('user')->latest()->limit(4)->get();
        @endphp

        @if($recentRecipes->count() > 0)
            <div class="dashboard-section-card">
                <div class="section-head">
                    <div class="section-kicker">Jaunākais saturs</div>
                    <h3 class="section-title">Jaunākās receptes</h3>
                    <p class="section-subtext">
                        Pēdējās pievienotās receptes no kopienas.
                    </p>
                </div>

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
            <div class="dashboard-section-card">
                <div class="section-head">
                    <div class="section-kicker">Jūsu saturs</div>
                    <h3 class="section-title">Jūsu jaunākās receptes</h3>
                    <p class="section-subtext">
                        Pēdējie jūsu izveidotie ieraksti ar ātru piekļuvi apskatei un rediģēšanai.
                    </p>
                </div>

                <div class="recipe-grid">
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
            <div class="dashboard-section-card empty-box">
                <div class="empty-icon">📝</div>
                <h4>Jūs vēl neesat izveidojis nevienu recepti</h4>
                <p class="muted-text" style="margin-bottom: 25px;">
                    Sāciet savu kulinārijas ceļojumu, izveidojot savu pirmo recepti.
                </p>
                <a href="/recipes/create" class="btn btn-success">Izveidot pirmo recepti</a>
            </div>
        @endif

        <div class="dashboard-section-card">
            <div class="section-head">
                <div class="section-kicker">Padomi</div>
                <h3 class="section-title">Noderīgi ieteikumi</h3>
                <p class="section-subtext">
                    Daži noderīgi ieteikumi ērtākai platformas izmantošanai.
                </p>
            </div>

            <div class="tips-grid">
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
</div>
@endsection
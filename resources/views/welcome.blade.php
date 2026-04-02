@extends('layouts.app')

@section('title', 'Sveicināti - Vecmāmiņas Receptes')
@section('meta_description', 'Atklāj, dalies un izveido brīnišķīgas receptes kopā ar citiem ēdiena mīļotājiem.')

@section('hero_title', 'Vecmāmiņas Receptes')
@section('hero_text', 'Atklāj, dalies un izveido brīnišķīgas receptes kopā ar citiem ēdiena mīļotājiem.')

@section('content')
<style>
    .welcome-page {
        color: var(--text);
    }

    .welcome-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .welcome-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .welcome-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
        text-align: center;
    }

    .welcome-badge {
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

    .welcome-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.75rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 16px;
        line-height: 1.08;
    }

    .welcome-main-text {
        color: var(--muted);
        line-height: 1.9;
        font-size: 15px;
        max-width: 860px;
        margin: 0 auto;
    }

    .hero-actions,
    .cta-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 28px;
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
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2rem;
        font-weight: 500;
        line-height: 1.1;
    }

    .section-subtext,
    .muted-text {
        color: var(--muted);
        line-height: 1.8;
    }

    .section-subtext {
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
        font-size: 2.8rem;
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

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .feature-card,
    .contact-card {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 22px;
        padding: 24px;
        transition: 0.2s ease;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .feature-card:hover,
    .contact-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
    }

    .feature-card {
        text-align: center;
    }

    .feature-icon,
    .contact-icon {
        font-size: 3.2rem;
        margin-bottom: 16px;
    }

    .feature-card h4,
    .contact-card h4,
    .cta-box h3 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .feature-card h4,
    .contact-card h4 {
        font-size: 1.5rem;
        margin-bottom: 12px;
        line-height: 1.15;
    }

    .about-content {
        text-align: center;
        max-width: 900px;
        margin: 0 auto;
    }

    .about-content p + p {
        margin-top: 18px;
    }

    .about-content .lead {
        font-size: 18px;
    }

    .contact-card {
        text-align: left;
    }

    .contact-link-row {
        text-align: center;
        margin-top: 24px;
    }

    .cta-box {
        text-align: center;
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
    }

    .cta-box h3 {
        margin-bottom: 18px;
        font-size: 2.2rem;
        line-height: 1.1;
    }

    @media (max-width: 980px) {
        .welcome-section-card {
            padding: 22px;
        }

        .welcome-main-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 640px) {
        .welcome-section-card {
            padding: 20px;
        }

        .stats-grid,
        .grid-3 {
            grid-template-columns: 1fr;
        }

        .hero-actions,
        .cta-actions {
            flex-direction: column;
        }

        .hero-actions .btn,
        .cta-actions .btn,
        .contact-link-row .btn {
            width: 100%;
        }
    }
</style>

<div class="welcome-page">
    <div class="welcome-stack">

        <div class="welcome-section-card welcome-hero-card">
            <div class="welcome-badge">Mājas garšas un iedvesma</div>
            <h2 class="welcome-main-title">Sveicināti kulinārijas pasaulē</h2>
            <p class="welcome-main-text">
                Pievienojieties ēdiena entuziastu kopienai, kas dalās ar savām mīļākajām receptēm.
                Atklājiet jaunas garšas, apgūstiet gatavošanas paņēmienus un saglabājiet savus favorītus vienuviet.
            </p>

            @auth
                <div class="hero-actions">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Uz vadības paneli</a>
                    <a href="/recipes/create" class="btn btn-success">Izveidot recepti</a>
                </div>
            @else
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-success">Sākt bez maksas</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">Ielogoties</a>
                </div>
            @endauth
        </div>

        <div class="welcome-section-card">
            <div class="section-head">
                <div class="section-kicker">Kopienas pārskats</div>
                <h3 class="section-title">Mūsu augošā kopiena</h3>
                <p class="section-subtext">
                    Īss pārskats par platformas saturu un kopienas aktivitāti.
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                    <span class="stat-label">Kopā receptes</span>
                </div>

                <div class="stat-box soft-green">
                    <span class="stat-number">{{ \App\Models\User::count() }}</span>
                    <span class="stat-label">Kopienas dalībnieki</span>
                </div>

                <div class="stat-box soft-blue">
                    <span class="stat-number">{{ \App\Models\Recipe::whereNotNull('category')->distinct('category')->count('category') }}</span>
                    <span class="stat-label">Recepšu kategorijas</span>
                </div>

                <div class="stat-box soft-pink">
                    <span class="stat-number">{{ \App\Models\Recipe::where('created_at', '>=', now()->subDays(7))->count() }}</span>
                    <span class="stat-label">Šīs nedēļas receptes</span>
                </div>
            </div>
        </div>

        <div id="features" class="welcome-section-card">
            <div class="section-head">
                <div class="section-kicker">Priekšrocības</div>
                <h3 class="section-title">Kāpēc izvēlēties Vecmāmiņas Receptes?</h3>
                <p class="section-subtext">
                    Platforma radīta, lai recepšu glabāšana un atklāšana būtu vienkārša, pārskatāma un iedvesmojoša.
                </p>
            </div>

            <div class="grid-3">
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h4>Vienkārša recepšu izveide</h4>
                    <p class="muted-text">
                        Izveido un dalies ar receptēm, pievienojot sastāvdaļas un gatavošanas soļus.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h4>Viedā meklēšana</h4>
                    <p class="muted-text">
                        Atrodi receptes pēc nosaukuma un pārlūko tās pēc kategorijām.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">❤️</div>
                    <h4>Favorīti</h4>
                    <p class="muted-text">
                        Saglabā receptes sirsniņā un ātri atrodi tās savā favorītu sarakstā.
                    </p>
                </div>
            </div>
        </div>

        <div id="about" class="welcome-section-card">
            <div class="section-head">
                <div class="section-kicker">Par mums</div>
                <h3 class="section-title">Kas ir Vecmāmiņas Receptes?</h3>
            </div>

            <div class="about-content">
                <p class="muted-text lead">
                    Vecmāmiņas Receptes ir recepšu platforma, kur ēdiena mīlētāji var dalīties ar saviem atradumiem,
                    saglabāt iecienītākās receptes un atklāt jaunas idejas.
                </p>
                <p class="muted-text">
                    Mūsu mērķis ir padarīt gatavošanu vienkāršu un iedvesmojošu — gan iesācējiem, gan pieredzējušiem pavāriem.
                </p>
            </div>
        </div>

        <div class="welcome-section-card">
            <div class="section-head">
                <div class="section-kicker">Kontakti</div>
                <h3 class="section-title">Galvenie kontakti</h3>
                <p class="section-subtext">
                    Ja rodas jautājumi, idejas vai nepieciešama palīdzība, sazinieties ar mums.
                </p>
            </div>

            <div class="grid-3">
                <div class="contact-card">
                    <div class="contact-icon">👤</div>
                    <h4>Galvenais kontakts</h4>
                    <p class="muted-text">
                        E-pasts: <strong>info@vecmaminasreceptes.lv</strong><br>
                        Tālrunis: <strong>+371 20000000</strong><br>
                        Darba laiks: <strong>P–Pk 09:00–18:00</strong>
                    </p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">🛠️</div>
                    <h4>Tehniskais atbalsts</h4>
                    <p class="muted-text">
                        E-pasts: <strong>support@vecmaminasreceptes.lv</strong><br>
                        Atbildes laiks: <strong>24–48h</strong>
                    </p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">💬</div>
                    <h4>Ieteikumi</h4>
                    <p class="muted-text">
                        E-pasts: <strong>ieteikumi@vecmaminasreceptes.lv</strong><br>
                        Raksti, ja ir idejas uzlabojumiem vai jaunām funkcijām.
                    </p>
                </div>
            </div>

            <div class="contact-link-row">
                <a href="{{ route('contact') }}" class="btn btn-primary">Atvērt kontaktu lapu</a>
            </div>
        </div>

        @guest
            <div class="welcome-section-card cta-box">
                <h3>Gatavi sākt gatavot?</h3>
                <p class="muted-text" style="font-size: 18px; margin-bottom: 28px;">
                    Pievienojieties mūsu kopienai un sāciet saglabāt favorītus un dalīties ar receptēm.
                </p>

                <div class="cta-actions">
                    <a href="{{ route('register') }}" class="btn btn-success">Izveidot bezmaksas kontu</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">Ielogoties tagad</a>
                </div>
            </div>
        @endguest

    </div>
</div>
@endsection
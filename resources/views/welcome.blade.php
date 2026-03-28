<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sveicināti - Vecmāmiņas Receptes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --card-bg: #fffdf9;
            --soft-bg: #f6efe7;
            --soft-bg-2: #efe4d6;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --success-bg: #edf3e7;
            --success-text: #667652;
            --warning-bg: #f3e8e3;
            --warning-text: #9a6b56;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --danger-border: #e3c9c2;
            --info-bg: #f2e7da;
            --info-text: #7a5a43;
            --shadow: 0 16px 40px rgba(79, 59, 42, 0.07);
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
            min-height: 100vh;
            color: var(--text);
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 20px 50px;
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

        .nav-bar {
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            flex-wrap: wrap;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            min-width: 240px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
        }

        .nav-right {
            display: flex;
            flex: 1;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
            min-width: 320px;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 14px;
        }

        .nav-links a:hover {
            background: var(--soft-bg);
            border-color: var(--line);
            color: var(--accent);
        }

        .nav-links a.active {
            color: var(--accent);
            background: var(--soft-bg);
            border-color: var(--line);
        }

        .main-content {
            background: rgba(255, 253, 249, 0.78);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .section-block + .section-block {
            margin-top: 28px;
        }

        .hero-box,
        .stats-box,
        .features-box,
        .about-box,
        .contact-box,
        .cta-box {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 28px;
        }

        .hero-box {
            text-align: center;
            background: var(--soft-bg);
        }

        .hero-box h2,
        .section-title,
        .feature-card h4,
        .contact-card h4,
        .cta-box h3,
        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-weight: 500;
        }

        .hero-box h2 {
            font-size: 2.5rem;
            margin-bottom: 18px;
        }

        .hero-box p,
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

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            text-align: center;
            font-family: inherit;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: #d8e1cf;
        }

        .btn-warning {
            background: var(--warning-bg);
            color: var(--warning-text);
            border-color: #e2ccc1;
        }

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
        }

        .hero-actions,
        .cta-actions {
            display: flex;
            gap: 18px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 18px;
        }

        .stat-box {
            background: var(--soft-bg);
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

        .feature-card,
        .contact-card {
            background: var(--soft-bg);
            border: 1px solid var(--line);
            padding: 24px;
            transition: 0.2s ease;
            text-align: center;
        }

        .feature-card:hover,
        .contact-card:hover {
            background: #fffaf5;
        }

        .feature-icon,
        .contact-icon {
            font-size: 3.5rem;
            margin-bottom: 18px;
        }

        .feature-card h4,
        .contact-card h4 {
            font-size: 1.5rem;
            margin-bottom: 14px;
        }

        .about-content {
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .about-content p + p {
            margin-top: 18px;
        }

        .contact-card {
            text-align: left;
        }

        .contact-card h4 {
            margin-bottom: 10px;
        }

        .contact-link-row {
            text-align: center;
            margin-top: 22px;
        }

        .cta-box {
            text-align: center;
        }

        .cta-box h3 {
            margin-bottom: 18px;
            font-size: 2.1rem;
        }

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
            }

            .hero-box h2 {
                font-size: 2.1rem;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 16px 12px 32px;
            }

            .hero {
                padding: 10px 8px 24px;
            }

            .hero-title {
                font-size: 2.3rem;
            }

            .nav-bar {
                padding: 16px;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-right {
                min-width: 100%;
                justify-content: flex-start;
            }

            .nav-links {
                justify-content: flex-start;
                width: 100%;
            }

            .main-content,
            .hero-box,
            .stats-box,
            .features-box,
            .about-box,
            .contact-box,
            .cta-box {
                padding: 20px;
            }

            .grid-2,
            .grid-3,
            .grid-4,
            .stats-grid,
            .contact-grid {
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
</head>
<body>
<div class="page">

    <div class="hero">
        <h1 class="hero-title">Vecmāmiņas Receptes</h1>
        <p class="hero-text">
            Atklāj, dalies un izveido brīnišķīgas receptes kopā ar citiem ēdiena mīļotājiem.
        </p>
    </div>

    <nav class="nav-bar">
        <div class="nav-left">
            <a href="/" class="nav-brand">Vecmāmiņas Receptes</a>
        </div>

        <div class="nav-right">
            <div class="nav-links">
                <a href="/" class="active">Sākums</a>
                <a href="#features">Iespējas</a>
                <a href="#about">Par mums</a>
            </div>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Vadības panelis</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Ielogoties</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-success">Reģistrēties</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="main-content">

        <div class="section-block hero-box">
            <h2>Sveicināti kulinārijas pasaulē</h2>
            <p>
                Pievienojieties ēdiena entuziastu kopienai, kas dalās ar savām mīļākajām receptēm.
                Atklājiet jaunas garšas, apgūstiet gatavošanas paņēmienus un saglabājiet savus favorītus.
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

        <div class="section-block stats-box">
            <h3 class="section-title">📊 Mūsu augošā kopiena</h3>
            <p class="section-subtext">
                Īss pārskats par platformas saturu un kopienas aktivitāti.
            </p>

            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                    <span class="stat-label">Kopā receptes</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\User::count() }}</span>
                    <span class="stat-label">Kopienas dalībnieki</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::whereNotNull('category')->distinct('category')->count('category') }}</span>
                    <span class="stat-label">Recepšu kategorijas</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::where('created_at', '>=', now()->subDays(7))->count() }}</span>
                    <span class="stat-label">Šīs nedēļas receptes</span>
                </div>
            </div>
        </div>

        <div id="features" class="section-block features-box">
            <h3 class="section-title">✨ Kāpēc izvēlēties Vecmāmiņas Receptes?</h3>
            <p class="section-subtext">
                Platforma radīta, lai recepšu glabāšana un atklāšana būtu vienkārša, pārskatāma un iedvesmojoša.
            </p>

            <div class="grid grid-3">
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

        <div id="about" class="section-block about-box">
            <h3 class="section-title">📖 Par mums</h3>

            <div class="about-content">
                <p class="muted-text" style="font-size: 18px;">
                    Vecmāmiņas Receptes ir recepšu platforma, kur ēdiena mīlētāji var dalīties ar saviem atradumiem,
                    saglabāt iecienītākās receptes un atklāt jaunas idejas.
                </p>
                <p class="muted-text" style="font-size: 16px;">
                    Mūsu mērķis ir padarīt gatavošanu vienkāršu un iedvesmojošu — gan iesācējiem, gan pieredzējušiem pavāriem.
                </p>
            </div>

            <div class="section-block contact-box" style="margin-top: 30px;">
                <h3 class="section-title">📞 Galvenie kontakti</h3>

                <div class="grid grid-3 contact-grid">
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
        </div>

        @guest
            <div class="section-block cta-box">
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
</body>
</html>
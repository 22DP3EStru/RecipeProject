<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakti - Vecmāmiņas Receptes</title>
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
            max-width: 1450px;
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
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .nav-bar {
            background: rgba(255, 253, 249, 0.95);
            border: 1px solid var(--line);
            padding: 16px 22px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
            white-space: nowrap;
        }

        .nav-center {
            min-width: 0;
            display: flex;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex-wrap: nowrap;
            min-width: 0;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 9px 11px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 13.5px;
            white-space: nowrap;
            line-height: 1.2;
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

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            white-space: nowrap;
        }

        .nav-user-name {
            color: var(--muted);
            font-size: 13.5px;
            font-weight: 700;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            white-space: nowrap;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
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

        .intro-box,
        .contact-card,
        .tip-box {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 28px;
            min-width: 0;
            overflow: hidden;
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
        .contact-card h3,
        .tip-box h3 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-weight: 500;
        }

        .intro-box h2 {
            font-size: 2.3rem;
            margin-bottom: 12px;
        }

        .intro-box p,
        .muted {
            color: var(--muted);
            line-height: 1.8;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .section-title {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.9rem;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .section-subtext {
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 22px;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .contact-card {
            background: var(--soft-bg);
            transition: 0.2s ease;
        }

        .contact-card:hover {
            background: #fffaf5;
        }

        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 14px;
        }

        .contact-card h3 {
            font-size: 1.6rem;
            margin-bottom: 12px;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .contact-card p,
        .contact-card div,
        .contact-card span,
        .contact-card strong,
        .tip-box p {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .contact-card strong {
            color: var(--text);
        }

        .contact-line {
            margin-bottom: 8px;
        }

        .contact-line:last-child {
            margin-bottom: 0;
        }

        .contact-value {
            display: inline;
            font-weight: 700;
            color: var(--text);
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .tip-box {
            background: var(--soft-bg);
        }

        @media (max-width: 1280px) {
            .nav-bar {
                grid-template-columns: 1fr;
                justify-items: center;
                text-align: center;
            }

            .nav-center {
                width: 100%;
            }

            .nav-links {
                flex-wrap: wrap;
            }

            .nav-right {
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-user-name {
                max-width: none;
            }
        }

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-links a {
                font-size: 13px;
                padding: 8px 10px;
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
                gap: 14px;
            }

            .main-content,
            .intro-box,
            .contact-card,
            .tip-box {
                padding: 20px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="page">

    <div class="hero">
        <h1 class="hero-title">Kontakti</h1>
        <p class="hero-text">
            Vecmāmiņas Receptes — sazinies ar mums, ja ir jautājumi, ieteikumi vai nepieciešama palīdzība.
        </p>
    </div>

    <nav class="nav-bar">
        <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

        <div class="nav-center">
            <div class="nav-links">
                <a href="/dashboard">Vadības panelis</a>
                <a href="/recipes">Receptes</a>
                <a href="/categories">Kategorijas</a>
                <a href="/profile/recipes">Manas receptes</a>
                <a href="/profile/favorites">Favorīti</a>
                <a href="/contact" class="active">Kontakti</a>
                <a href="{{ route('profile.edit') }}">Profils</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">Administrācija</a>
                @endif
            </div>
        </div>

        <div class="nav-right">
            <span class="nav-user-name">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Iziet</button>
            </form>
        </div>
    </nav>

    <div class="main-content">
        <div class="section-block intro-box">
            <div class="intro-icon">📞</div>
            <h2>Kā ar mums sazināties</h2>
            <p>
                Ja pamanīji kļūdu, vēlies ieteikt uzlabojumu vai ir jautājums par “Vecmāmiņas Receptes”, izmanto kādu no zemāk redzamajiem kontaktiem.
            </p>
        </div>

        <div class="section-block">
            <h3 class="section-title">📋 Kontaktinformācija</h3>
            <p class="section-subtext">
                Izvēlies atbilstošāko saziņas veidu atkarībā no jautājuma vai situācijas.
            </p>

            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">👤</div>
                    <h3>Galvenais kontakts</h3>
                    <div class="muted">
                        <div class="contact-line">E-pasts: <span class="contact-value">info@vecmaminasreceptes.lv</span></div>
                        <div class="contact-line">Tālrunis: <span class="contact-value">+371 20000000</span></div>
                        <div class="contact-line">Darba laiks: <span class="contact-value">P–Pk 09:00–18:00</span></div>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">🛠️</div>
                    <h3>Tehniskais atbalsts</h3>
                    <div class="muted">
                        <div class="contact-line">E-pasts: <span class="contact-value">support@vecmaminasreceptes.lv</span></div>
                        <div class="contact-line">Atbildes laiks: <span class="contact-value">24–48h</span></div>
                        <div class="contact-line">Iekļauj: <span class="contact-value">lietotājvārdu + īsu problēmas aprakstu</span></div>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">💬</div>
                    <h3>Ieteikumi / sadarbība</h3>
                    <div class="muted">
                        <div class="contact-line">E-pasts: <span class="contact-value">sadarbiba@vecmaminasreceptes.lv</span></div>
                        <div class="contact-line">Raksti, ja ir idejas jaunām funkcijām vai saturam.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-block tip-box">
            <h3>📌 Ātrais jautājums</h3>
            <p class="muted" style="margin-top: 10px;">
                Ja jautājums ir par konkrētu recepti, pievieno receptes nosaukumu un, ja iespējams, arī saiti uz to. Tas palīdzēs ātrāk saprast situāciju un sniegt precīzāku atbildi.
            </p>
        </div>
    </div>

</div>
</body>
</html>
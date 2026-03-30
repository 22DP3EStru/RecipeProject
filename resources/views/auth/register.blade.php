<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reģistrēties - Vecmāmiņas Receptes</title>
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
            --success-bg: #e8eee2;
            --success-text: #667652;
            --danger-bg: #f7ebe8;
            --danger-text: #a45f52;
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
            max-width: 1180px;
            margin: 0 auto;
            padding: 28px 20px 50px;
        }

        .nav-bar {
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            box-shadow: var(--shadow);
            margin-bottom: 38px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .nav-links {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
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

        .btn {
            display: inline-block;
            padding: 13px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
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
            border-color: #d7dfcc;
        }

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 34px;
            align-items: stretch;
        }

        .hero-left {
            background: var(--card-bg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 44px;
        }

        .hero-right {
            background: linear-gradient(180deg, #f8f1e8 0%, #f0e4d5 100%);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .eyebrow {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 12px;
            margin-bottom: 14px;
            font-weight: 700;
        }

        .hero-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 3.1rem;
            line-height: 1.1;
            color: var(--accent);
            margin-bottom: 16px;
            font-weight: 500;
        }

        .hero-text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            max-width: 560px;
        }

        .alert {
            padding: 16px 18px;
            margin: 26px 0 24px;
            border: 1px solid #e5cbc3;
            background: var(--danger-bg);
            color: var(--danger-text);
        }

        .alert h4 {
            margin-bottom: 12px;
            font-size: 15px;
        }

        .alert ul {
            margin-left: 20px;
            line-height: 1.7;
            font-size: 14px;
        }

        .form-area {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            font-weight: 700;
            color: var(--text);
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 15px 16px;
            border: 1px solid var(--line);
            font-size: 15px;
            background: #fffdfa;
            color: var(--text);
            transition: 0.2s ease;
        }

        .form-input::placeholder {
            color: #9a8d82;
        }

        .form-input:focus {
            outline: none;
            border-color: #bba692;
            background: #fff;
        }

        .field-error {
            color: var(--danger-text);
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .submit-btn {
            width: 100%;
            padding: 16px 18px;
            font-size: 16px;
        }

        .auth-links {
            padding-top: 22px;
            border-top: 1px solid var(--line);
            margin-top: 28px;
        }

        .auth-links h4 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 1.8rem;
            margin-bottom: 14px;
            font-weight: 500;
        }

        .auth-links p {
            color: var(--muted);
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 18px;
        }

        .feature-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2.2rem;
            margin-bottom: 14px;
            font-weight: 500;
        }

        .feature-text {
            color: var(--muted);
            line-height: 1.8;
            margin-bottom: 28px;
            font-size: 15px;
        }

        .feature-list {
            display: grid;
            gap: 18px;
        }

        .feature-item {
            padding: 18px 0;
            border-top: 1px solid rgba(122, 90, 67, 0.14);
        }

        .feature-item:first-child {
            border-top: none;
            padding-top: 0;
        }

        .feature-item h5 {
            color: var(--text);
            font-size: 1rem;
            margin-bottom: 6px;
            font-weight: 700;
        }

        .feature-item p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .emoji {
            font-size: 2rem;
            margin-bottom: 12px;
        }

        @media (max-width: 980px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .hero-left,
            .hero-right {
                padding: 30px;
            }

            .hero-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 16px 12px 32px;
            }

            .nav-bar {
                padding: 16px;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .hero-left,
            .hero-right {
                padding: 22px;
            }

            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div class="page">
        <nav class="nav-bar">
            <a href="/" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-links">
                <a href="/">Sākums</a>
                <a href="{{ route('login') }}">Ielogoties</a>
            </div>

            <div>
                <a href="/" class="btn btn-secondary">Atpakaļ uz sākumu</a>
            </div>
        </nav>

        <div class="hero">
            <div class="hero-left">
                <div class="eyebrow">Pievienojieties kopienai</div>
                <h1 class="hero-title">Izveidojiet savu kontu</h1>
                <p class="hero-text">
                    Reģistrējieties, lai saglabātu favorītus, publicētu savas receptes un izveidotu savu personīgo kulinārijas kolekciju.
                </p>

                @if($errors->any())
                    <div class="alert">
                        <h4>Lūdzu, izlabojiet šādas kļūdas:</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-area">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="name">Pilnais vārds</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-input @error('name') is-invalid @enderror"
                                placeholder="Ievadiet savu pilno vārdu"
                                required
                                autofocus
                                autocomplete="name">
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">E-pasta adrese</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-input @error('email') is-invalid @enderror"
                                placeholder="Ievadiet savu e-pasta adresi"
                                required
                                autocomplete="email">
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password">Parole</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input @error('password') is-invalid @enderror"
                                placeholder="Izveidojiet drošu paroli"
                                required
                                autocomplete="new-password">
                            @error('password')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Apstiprināt paroli</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-input"
                                placeholder="Atkārtoti ievadiet paroli"
                                required
                                autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-success submit-btn">
                            Izveidot kontu
                        </button>
                    </form>
                </div>

                <div class="auth-links">
                    <h4>Jau ir konts?</h4>
                    <p>
                        Ielogojieties, lai piekļūtu savām receptēm un turpinātu savu kulinārijas ceļojumu.
                    </p>

                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Ielogoties
                    </a>
                </div>
            </div>

            <div class="hero-right">
                <div class="emoji">🎉</div>
                <h2 class="feature-title">Ko iegūsiet pēc reģistrācijas</h2>
                <p class="feature-text">
                    Skaista un ērta vieta, kur glabāt savas receptes, atrast iedvesmu un veidot savu personīgo receptes pasauli.
                </p>

                <div class="feature-list">
                    <div class="feature-item">
                        <h5>Pievienot savas receptes</h5>
                        <p>Izveidojiet un publicējiet savus ēdienus vienotā, pārskatāmā formātā.</p>
                    </div>

                    <div class="feature-item">
                        <h5>Saglabāt iecienītākās receptes</h5>
                        <p>Veidojiet savu favorītu kolekciju, lai labākās receptes vienmēr būtu pa rokai.</p>
                    </div>

                    <div class="feature-item">
                        <h5>Atklāt jaunus ēdienus</h5>
                        <p>Pārlūkojiet citu lietotāju receptes un atrodiet idejas ikdienai un svētkiem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
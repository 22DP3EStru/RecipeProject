<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apstiprini e-pastu - Vecmāmiņas Receptes</title>
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
            max-width: 900px;
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

        .nav-links form {
            display: inline;
        }

        .nav-links button,
        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 14px;
            background: transparent;
            cursor: pointer;
        }

        .nav-links button:hover,
        .nav-links a:hover {
            background: var(--soft-bg);
            border-color: var(--line);
            color: var(--accent);
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 44px;
        }

        .eyebrow {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 12px;
            margin-bottom: 14px;
            font-weight: 700;
        }

        .title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.8rem;
            line-height: 1.1;
            color: var(--accent);
            margin-bottom: 18px;
            font-weight: 500;
        }

        .text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .alert-success {
            padding: 16px 18px;
            margin: 20px 0 24px;
            border: 1px solid #d7dfcc;
            background: var(--success-bg);
            color: var(--success-text);
        }

        .actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 26px;
        }

        .btn {
            display: inline-block;
            padding: 14px 18px;
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

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
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

            .card {
                padding: 24px;
            }

            .title {
                font-size: 2rem;
            }

            .actions {
                flex-direction: column;
            }

            .actions form {
                width: 100%;
            }

            .actions button {
                width: 100%;
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
                <a href="{{ route('dashboard') }}">Uz paneli</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Izrakstīties</button>
                </form>
            </div>
        </nav>

        <div class="card">
            <div class="eyebrow">E-pasta apstiprināšana</div>
            <h1 class="title">Apstiprini savu e-pastu</h1>

            <p class="text">
                Paldies par reģistrāciju. Pirms turpināt lietot sistēmu, lūdzu atver savu e-pastu un nospied
                uz saites, kuru tikko nosūtījām. Tikai pēc apstiprināšanas tavs konts tiks atzīmēts kā verificēts.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert-success">
                    Jauna verifikācijas saite ir veiksmīgi nosūtīta uz tavu e-pasta adresi.
                </div>
            @endif

            <div class="actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Nosūtīt verifikācijas e-pastu vēlreiz
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">
                        Izrakstīties
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
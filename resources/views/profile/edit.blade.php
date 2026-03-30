<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt profilu - Vecmāmiņas Receptes</title>
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
            --info-bg: #f3ece3;
            --info-text: #7a5a43;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --danger-soft: #fbefec;
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

        .main-content {
            background: rgba(255, 253, 249, 0.82);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 34px;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 24px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .pdf-actions {
            margin-bottom: 22px;
        }

        .profile-sections {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .profile-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            padding: 30px;
            box-shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 24px;
            padding-bottom: 14px;
            border-bottom: 1px solid #e3d6c8;
        }

        .card-icon {
            font-size: 1.8rem;
            line-height: 1;
            padding-top: 2px;
        }

        .card-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 500;
            color: var(--accent);
            margin-bottom: 4px;
        }

        .card-subtitle {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--text);
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--line);
            font-size: 15px;
            background: #fffdfa;
            color: var(--text);
            transition: 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #bba692;
            background: #fff;
        }

        .form-error {
            color: var(--danger-text);
            font-size: 13px;
            margin-top: 6px;
        }

        .actions-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
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
            white-space: nowrap;
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

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: #e3c9c2;
        }

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
        }

        .pdf-btn {
            display: inline-block;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            color: var(--accent);
            font-size: 14px;
            font-weight: 700;
        }

        .pdf-btn:hover {
            background: var(--soft-bg-2);
        }

        .alert {
            padding: 14px 18px;
            margin-bottom: 18px;
            border: 1px solid var(--line);
            font-weight: 600;
        }

        .alert-success {
            background: #f1f5ea;
            border-color: #d7ddcc;
            color: #607149;
        }

        .alert-info {
            background: var(--info-bg);
            border-color: #dfcfbf;
            color: var(--info-text);
        }

        .delete-section {
            background: var(--danger-soft);
            border-color: #e7d0ca;
        }

        .danger-box {
            background: rgba(255,255,255,0.4);
            border: 1px solid #e7d0ca;
            padding: 18px;
            margin-bottom: 20px;
        }

        .danger-box h4 {
            color: var(--danger-text);
            margin-bottom: 8px;
            font-size: 16px;
        }

        .danger-box p {
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        .quick-actions {
            margin-top: 38px;
            padding-top: 26px;
            border-top: 1px solid var(--line);
        }

        .quick-title {
            text-align: center;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 20px;
            font-weight: 500;
        }

        .quick-actions-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(47, 36, 29, 0.38);
            z-index: 1000;
            padding: 20px;
        }

        .modal-content {
            background: var(--card-bg);
            margin: 8% auto 0;
            padding: 30px;
            border: 1px solid var(--line);
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
        }

        .modal-head {
            text-align: center;
            margin-bottom: 24px;
        }

        .modal-icon {
            font-size: 3rem;
            margin-bottom: 12px;
        }

        .modal-head h3 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--danger-text);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .modal-head p {
            color: var(--muted);
            line-height: 1.7;
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

            .profile-card {
                padding: 22px;
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

            .main-content {
                padding: 20px;
            }

            .card-header {
                flex-direction: column;
            }

            .modal-content {
                margin-top: 20%;
                padding: 22px;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div class="page">

        <div class="hero">
            <h1 class="hero-title">Profila iestatījumi</h1>
            <p class="hero-text">
                Pārvaldiet sava konta informāciju, nomainiet paroli un kontrolējiet personīgos iestatījumus vienuviet.
            </p>
        </div>

        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-center">
                <div class="nav-links">
                    <a href="/dashboard">Vadības panelis</a>
                    <a href="/recipes">Receptes</a>
                    <a href="{{ route('categories.index') }}">Kategorijas</a>
                    <a href="/profile/recipes">Manas receptes</a>
                    <a href="/profile/favorites">Favorīti</a>
                    <a href="/contact">Kontakti</a>
                    <a href="{{ route('profile.edit') }}" class="active">Profils</a>
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
            <div class="breadcrumb">
                <a href="/dashboard">Vadības panelis</a>
                <span> / </span>
                <span style="font-weight: 700; color: var(--text);">Profila iestatījumi</span>
            </div>

            <div class="pdf-actions">
                <a href="{{ route('pdf.user.profile', $user->id) }}" class="pdf-btn">Profila PDF</a>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success">
                    Profils veiksmīgi atjaunināts.
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="alert alert-success">
                    Parole veiksmīgi nomainīta.
                </div>
            @endif

            <div class="profile-sections">
                <div class="profile-card">
                    <div class="card-header">
                        <div class="card-icon">👤</div>
                        <div>
                            <div class="card-title">Profila informācija</div>
                            <p class="card-subtitle">
                                Atjauniniet sava konta pamatinformāciju un e-pasta adresi.
                            </p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="name" class="form-label">Vārds</label>
                            <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">E-pasta adrese</label>
                            <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <div class="form-error">{{ $message }}</div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="alert alert-info" style="margin-top: 12px;">
                                    <p>Jūsu e-pasta adrese vēl nav verificēta.</p>
                                    <button form="send-verification" class="btn btn-secondary" style="margin-top: 10px;">
                                        Nosūtīt verificēšanas e-pastu atkārtoti
                                    </button>

                                    @if (session('status') === 'verification-link-sent')
                                        <p style="margin-top: 10px; color: #667652;">
                                            Jauna verificēšanas saite ir nosūtīta uz jūsu e-pasta adresi.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="actions-row">
                            <button type="submit" class="btn btn-primary">Saglabāt izmaiņas</button>
                        </div>
                    </form>
                </div>

                <div class="profile-card">
                    <div class="card-header">
                        <div class="card-icon">🔒</div>
                        <div>
                            <div class="card-title">Nomainīt paroli</div>
                            <p class="card-subtitle">
                                Izvēlieties drošu paroli, lai aizsargātu savu kontu.
                            </p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="update_password_current_password" class="form-label">Pašreizējā parole</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="form-input" autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="update_password_password" class="form-label">Jaunā parole</label>
                            <input id="update_password_password" name="password" type="password" class="form-input" autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="update_password_password_confirmation" class="form-label">Apstiprināt paroli</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="actions-row">
                            <button type="submit" class="btn btn-success">Nomainīt paroli</button>
                        </div>
                    </form>
                </div>

                <div class="profile-card delete-section">
                    <div class="card-header">
                        <div class="card-icon">⚠️</div>
                        <div>
                            <div class="card-title" style="color: var(--danger-text);">Dzēst kontu</div>
                            <p class="card-subtitle">
                                Konta dzēšana ir neatgriezeniska darbība.
                            </p>
                        </div>
                    </div>

                    <div class="danger-box">
                        <h4>Brīdinājums</h4>
                        <p>
                            Kad jūsu konts tiks dzēsts, visas jūsu receptes un personīgie dati tiks neatgriezeniski dzēsti.
                            Pirms konta dzēšanas lejupielādējiet visu informāciju, kuru vēlaties saglabāt.
                        </p>
                    </div>

                    <button onclick="openDeleteModal()" class="btn btn-danger">
                        Dzēst kontu
                    </button>
                </div>
            </div>

            <div class="quick-actions">
                <h3 class="quick-title">Ātras darbības</h3>
                <div class="quick-actions-row">
                    <a href="/profile/recipes" class="btn btn-primary">Manas receptes</a>
                    <a href="/recipes/create" class="btn btn-success">Izveidot jaunu recepti</a>
                    <a href="/recipes" class="btn btn-secondary">Pārlūkot receptes</a>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal-icon">⚠️</div>
                <h3>Dzēst kontu</h3>
                <p>Vai tiešām vēlaties dzēst savu kontu? Šī darbība ir neatgriezeniska.</p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="password" class="form-label">Ievadiet savu paroli, lai apstiprinātu</label>
                    <input id="password" name="password" type="password" class="form-input" placeholder="Jūsu parole" required>
                    @error('password', 'userDeletion')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions-row" style="justify-content: center; margin-top: 24px;">
                    <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                        Atcelt
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Dzēst kontu
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
            @csrf
        </form>
    @endif

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
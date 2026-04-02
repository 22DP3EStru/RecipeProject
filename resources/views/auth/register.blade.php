@extends('layouts.app')

@section('title', 'Reģistrēties - Vecmāmiņas Receptes')
@section('meta_description', 'Izveido kontu Vecmāmiņas Receptes, lai saglabātu favorītus, publicētu savas receptes un veidotu savu personīgo kulinārijas kolekciju.')

@section('content')
<style>
    .register-page {
        max-width: 1220px;
        margin: 0 auto;
    }

    .register-nav {
        background: rgba(255, 253, 249, 0.94);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 22px;
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        margin-bottom: 30px;
    }

    .register-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        letter-spacing: 0.02em;
    }

    .register-nav-brand::before {
        content: "📖";
        font-size: 1.1rem;
        line-height: 1;
    }

    .register-nav-links {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .register-nav-links a {
        color: var(--text);
        text-decoration: none;
        padding: 10px 14px;
        border: 1px solid transparent;
        border-radius: 999px;
        transition: 0.2s ease;
        font-weight: 700;
        font-size: 14px;
    }

    .register-nav-links a:hover {
        background: var(--surface-soft);
        border-color: var(--line);
        color: var(--accent);
        transform: translateY(-1px);
    }

    .register-hero {
        display: grid;
        grid-template-columns: 1.04fr 0.96fr;
        gap: 26px;
        align-items: stretch;
    }

    .register-panel {
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(79, 59, 42, 0.07);
        min-width: 0;
    }

    .register-hero-left {
        background: rgba(255, 253, 249, 0.97);
        padding: 40px;
    }

    .register-hero-right {
        background: linear-gradient(180deg, #fbf5ee 0%, #f3e8dc 100%);
        padding: 38px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    .register-hero-right::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.38) 0%, rgba(255,255,255,0) 24%),
            radial-gradient(circle at bottom left, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 26%);
        pointer-events: none;
    }

    .register-hero-right > * {
        position: relative;
        z-index: 1;
    }

    .register-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.12em;
        font-size: 12px;
        margin-bottom: 14px;
        font-weight: 800;
        padding: 7px 12px;
        border-radius: 999px;
        background: #f5ece2;
        border: 1px solid rgba(122, 90, 67, 0.12);
    }

    .register-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3rem;
        line-height: 1.08;
        color: var(--accent);
        margin-bottom: 16px;
        font-weight: 500;
    }

    .register-text {
        color: var(--muted);
        font-size: 16px;
        line-height: 1.8;
        max-width: 560px;
    }

    .form-area {
        margin-top: 30px;
        padding-top: 24px;
        border-top: 1px solid rgba(221, 207, 192, 0.9);
    }

    .form-grid {
        display: grid;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 0;
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
        border-radius: 16px;
        font-size: 15px;
        background: #fffdfa;
        color: var(--text);
        transition: 0.2s ease;
        box-shadow: inset 0 1px 2px rgba(79, 59, 42, 0.02);
    }

    .form-input::placeholder {
        color: #9a8d82;
    }

    .form-input:focus {
        outline: none;
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
    }

    .field-error {
        color: var(--danger-text);
        font-size: 13px;
        margin-top: 6px;
        display: block;
        font-weight: 600;
    }

    .submit-btn {
        width: 100%;
        padding: 16px 18px;
        font-size: 16px;
        margin-top: 8px;
    }

    .auth-links {
        padding-top: 24px;
        border-top: 1px solid rgba(221, 207, 192, 0.9);
        margin-top: 28px;
    }

    .auth-links h4 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.85rem;
        margin-bottom: 12px;
        font-weight: 500;
    }

    .auth-links p {
        color: var(--muted);
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 18px;
    }

    .login-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 253, 249, 0.72);
        border: 1px solid rgba(122, 90, 67, 0.12);
        font-size: 2rem;
        margin-bottom: 16px;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.05);
    }

    .feature-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.15rem;
        margin-bottom: 12px;
        font-weight: 500;
        line-height: 1.15;
    }

    .feature-text {
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 28px;
        font-size: 15px;
    }

    .feature-list {
        display: grid;
        gap: 14px;
    }

    .feature-item {
        padding: 16px 16px;
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        background: rgba(255, 253, 249, 0.56);
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.03);
    }

    .feature-item h5 {
        color: var(--text);
        font-size: 1rem;
        margin-bottom: 6px;
        font-weight: 800;
    }

    .feature-item p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
    }

    @media (max-width: 980px) {
        .register-hero {
            grid-template-columns: 1fr;
        }

        .register-hero-left,
        .register-hero-right {
            padding: 30px;
        }

        .register-title {
            font-size: 2.45rem;
        }
    }

    @media (max-width: 640px) {
        .register-nav {
            padding: 16px;
            border-radius: 18px;
        }

        .register-nav-brand {
            font-size: 1.7rem;
        }

        .register-hero-left,
        .register-hero-right {
            padding: 22px;
        }

        .register-title {
            font-size: 2rem;
        }

        .login-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .login-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="register-page">
    <nav class="register-nav">
        <a href="/" class="register-nav-brand">Vecmāmiņas Receptes</a>

        <div class="register-nav-links">
            <a href="/">Sākums</a>
            <a href="{{ route('login') }}">Ielogoties</a>
        </div>

        <div>
            <a href="/" class="btn btn-secondary">Atpakaļ uz sākumu</a>
        </div>
    </nav>

    <div class="register-hero">
        <div class="register-panel register-hero-left">
            <div class="register-eyebrow">Pievienojieties kopienai</div>
            <h1 class="register-title">Izveidojiet savu kontu</h1>
            <p class="register-text">
                Reģistrējieties, lai saglabātu favorītus, publicētu savas receptes un izveidotu savu personīgo kulinārijas kolekciju.
            </p>

            <div class="form-area">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-grid">
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

                <div class="login-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Ielogoties
                    </a>
                </div>
            </div>
        </div>

        <div class="register-panel register-hero-right">
            <div class="feature-icon">🎉</div>
            <h2 class="feature-title">Ko iegūsiet pēc reģistrācijas</h2>
            <p class="feature-text">
                Skaista, ērta un mājīga vieta, kur glabāt savas receptes, atrast iedvesmu un veidot savu personīgo recepšu pasauli.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <h5>Pievienot savas receptes</h5>
                    <p>Izveidojiet un publicējiet savus ēdienus vienotā, pārskatāmā un skaistā formātā.</p>
                </div>

                <div class="feature-item">
                    <h5>Saglabāt iecienītākās receptes</h5>
                    <p>Veidojiet savu favorītu kolekciju, lai labākās receptes vienmēr būtu ātri atrodamas.</p>
                </div>

                <div class="feature-item">
                    <h5>Atklāt jaunus ēdienus</h5>
                    <p>Pārlūkojiet citu lietotāju receptes un atrodiet idejas ikdienai, svētkiem un īpašām reizēm.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
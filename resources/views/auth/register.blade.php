@extends('layouts.app')

@section('title', 'Reģistrēties - Vecmāmiņas Receptes')
@section('meta_description', 'Izveido kontu Vecmāmiņas Receptes, lai saglabātu favorītus, publicētu savas receptes un veidotu savu personīgo kulinārijas kolekciju.')

@section('content')
<style>
    .register-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .register-nav {
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

    .register-nav-brand {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        letter-spacing: 0.02em;
    }

    .register-nav-links {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .register-nav-links a {
        color: var(--text);
        text-decoration: none;
        padding: 10px 14px;
        border: 1px solid transparent;
        transition: 0.2s ease;
        font-weight: 600;
        font-size: 14px;
    }

    .register-nav-links a:hover {
        background: var(--surface-soft);
        border-color: var(--line);
        color: var(--accent);
    }

    .register-hero {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 34px;
        align-items: stretch;
    }

    .register-hero-left {
        background: var(--surface);
        border: 1px solid var(--line);
        box-shadow: var(--shadow);
        padding: 44px;
    }

    .register-hero-right {
        background: linear-gradient(180deg, #f8f1e8 0%, #f0e4d5 100%);
        border: 1px solid var(--line);
        box-shadow: var(--shadow);
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .register-eyebrow {
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-size: 12px;
        margin-bottom: 14px;
        font-weight: 700;
    }

    .register-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3.1rem;
        line-height: 1.1;
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
        .register-hero {
            grid-template-columns: 1fr;
        }

        .register-hero-left,
        .register-hero-right {
            padding: 30px;
        }

        .register-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 640px) {
        .register-nav {
            padding: 16px;
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
        <div class="register-hero-left">
            <div class="register-eyebrow">Pievienojieties kopienai</div>
            <h1 class="register-title">Izveidojiet savu kontu</h1>
            <p class="register-text">
                Reģistrējieties, lai saglabātu favorītus, publicētu savas receptes un izveidotu savu personīgo kulinārijas kolekciju.
            </p>

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

        <div class="register-hero-right">
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
@endsection
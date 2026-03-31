@extends('layouts.app')

@section('title', 'Ielogoties - Vecmāmiņas Receptes')
@section('meta_description', 'Ielogojieties Vecmāmiņas Receptes, lai piekļūtu savām receptēm, favorītiem un personīgajai recepšu kolekcijai.')

@section('content')
<style>
    .login-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .login-nav {
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

    .login-nav-brand {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
        letter-spacing: 0.02em;
    }

    .login-nav-links {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .login-nav-links a {
        color: var(--text);
        text-decoration: none;
        padding: 10px 14px;
        border: 1px solid transparent;
        transition: 0.2s ease;
        font-weight: 600;
        font-size: 14px;
    }

    .login-nav-links a:hover {
        background: var(--surface-soft);
        border-color: var(--line);
        color: var(--accent);
    }

    .login-hero {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 34px;
        align-items: stretch;
    }

    .login-hero-left {
        background: var(--surface);
        border: 1px solid var(--line);
        box-shadow: var(--shadow);
        padding: 44px;
    }

    .login-hero-right {
        background: linear-gradient(180deg, #f8f1e8 0%, #f0e4d5 100%);
        border: 1px solid var(--line);
        box-shadow: var(--shadow);
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-eyebrow {
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.16em;
        font-size: 12px;
        margin-bottom: 14px;
        font-weight: 700;
    }

    .login-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3.1rem;
        line-height: 1.1;
        color: var(--accent);
        margin-bottom: 16px;
        font-weight: 500;
    }

    .login-text {
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

    .remember-row {
        margin-bottom: 24px;
    }

    .remember-label {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--muted);
        font-size: 14px;
    }

    .remember-label input {
        width: 16px;
        height: 16px;
        accent-color: var(--accent);
    }

    .submit-btn {
        width: 100%;
        padding: 16px 18px;
        font-size: 16px;
        margin-bottom: 28px;
    }

    .auth-links {
        padding-top: 22px;
        border-top: 1px solid var(--line);
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

    .secondary-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
    }

    .secondary-link:hover {
        text-decoration: underline;
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
        .login-hero {
            grid-template-columns: 1fr;
        }

        .login-hero-left,
        .login-hero-right {
            padding: 30px;
        }

        .login-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 640px) {
        .login-nav {
            padding: 16px;
        }

        .login-nav-brand {
            font-size: 1.7rem;
        }

        .login-hero-left,
        .login-hero-right {
            padding: 22px;
        }

        .login-title {
            font-size: 2rem;
        }
    }
</style>

<div class="login-page">
    <nav class="login-nav">
        <a href="/" class="login-nav-brand">Vecmāmiņas Receptes</a>

        <div class="login-nav-links">
            <a href="/">Sākums</a>
            <a href="{{ route('register') }}">Reģistrēties</a>
        </div>

        <div>
            <a href="/" class="btn btn-secondary">Atpakaļ uz sākumu</a>
        </div>
    </nav>

    <div class="login-hero">
        <div class="login-hero-left">
            <div class="login-eyebrow">Laipni lūdzam atpakaļ</div>
            <h1 class="login-title">Ielogojieties savā kontā</h1>
            <p class="login-text">
                Piekļūstiet savām receptēm, favorītiem un personīgajai recepšu kolekcijai vienotā, skaistā un ērtā vidē.
            </p>

            <div class="form-area">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                            autofocus
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
                            placeholder="Ievadiet savu paroli"
                            required
                            autocomplete="current-password">
                        @error('password')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="remember-row">
                        <label class="remember-label">
                            <input type="checkbox" name="remember">
                            <span>Atcerēties mani 30 dienas</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary submit-btn">
                        Ielogoties
                    </button>
                </form>
            </div>

            <div class="auth-links">
                <h4>Jauns lietotājs?</h4>
                <p>
                    Izveido kontu un sāc veidot savu receptes kolekciju, saglabāt favorītus un dalīties ar savām iecienītākajām garšām.
                </p>

                <div style="margin-bottom: 16px;">
                    <a href="{{ route('register') }}" class="btn btn-success">
                        Izveidot kontu
                    </a>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="secondary-link">
                        Aizmirsāt paroli?
                    </a>
                @endif
            </div>
        </div>

        <div class="login-hero-right">
            <div class="emoji">🍽️</div>
            <h2 class="feature-title">Kas jūs gaida iekšpusē</h2>
            <p class="feature-text">
                Vienkārša, skaista un mājīga recepšu vide, kur glabāt savus iecienītākos ēdienus un atrast jaunas idejas katrai dienai.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <h5>Izveidot receptes</h5>
                    <p>Dalieties ar savām receptēm un izveidojiet personīgu kulinārijas kolekciju.</p>
                </div>

                <div class="feature-item">
                    <h5>Atklāt jaunas idejas</h5>
                    <p>Pārlūkojiet receptes, meklējiet pēc kategorijām un atrodiet iedvesmu ikdienai.</p>
                </div>

                <div class="feature-item">
                    <h5>Saglabāt favorītus</h5>
                    <p>Atzīmējiet savas mīļākās receptes, lai tās vienmēr būtu ātri atrodamas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
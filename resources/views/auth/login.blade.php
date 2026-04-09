@extends('layouts.app')

@section('title', 'Ielogoties - Vecmāmiņas Receptes')
@section('meta_description', 'Ielogojieties Vecmāmiņas Receptes, lai piekļūtu savām receptēm, favorītiem un personīgajai recepšu kolekcijai.')

@section('content')
<style>
    .login-page {
        max-width: 1220px;
        margin: 0 auto;
    }

    .login-nav {
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

    .login-nav-brand {
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

    .login-nav-brand::before {
        content: "📖";
        font-size: 1.1rem;
        line-height: 1;
    }

    .login-nav-links {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .login-nav-links a {
        color: var(--text);
        text-decoration: none;
        padding: 10px 14px;
        border: 1px solid transparent;
        border-radius: 999px;
        transition: 0.2s ease;
        font-weight: 700;
        font-size: 14px;
    }

    .login-nav-links a:hover {
        background: var(--surface-soft);
        border-color: var(--line);
        color: var(--accent);
        transform: translateY(-1px);
    }

    .login-hero {
        display: grid;
        grid-template-columns: 1.04fr 0.96fr;
        gap: 26px;
        align-items: stretch;
    }

    .login-panel {
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(79, 59, 42, 0.07);
        min-width: 0;
    }

    .login-hero-left {
        background: rgba(255, 253, 249, 0.97);
        padding: 40px;
    }

    .login-hero-right {
        background: linear-gradient(180deg, #fbf5ee 0%, #f3e8dc 100%);
        padding: 38px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    .login-hero-right::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.38) 0%, rgba(255,255,255,0) 24%),
            radial-gradient(circle at bottom left, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 26%);
        pointer-events: none;
    }

    .login-hero-right > * {
        position: relative;
        z-index: 1;
    }

    .login-eyebrow {
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

    .login-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3rem;
        line-height: 1.08;
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

    .remember-row {
        margin-top: 2px;
        margin-bottom: 4px;
    }

    .remember-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--muted);
        font-size: 14px;
        font-weight: 600;
        padding: 10px 12px;
        background: #faf4ed;
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 14px;
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
        margin-top: 4px;
        margin-bottom: 26px;
    }

    .auth-links {
        padding-top: 24px;
        border-top: 1px solid rgba(221, 207, 192, 0.9);
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

    .secondary-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
    }

    .secondary-link:hover {
        text-decoration: underline;
    }

    .register-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 8px;
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
        <div class="login-panel login-hero-left">
            <div class="login-eyebrow">Laipni lūdzam atpakaļ</div>
            <h1 class="login-title">Ielogojieties savā kontā</h1>
            <p class="login-text">
                Piekļūstiet savām receptēm, favorītiem un personīgajai recepšu kolekcijai vienotā, siltā un ērtā vidē.
            </p>

            <div class="form-area">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-grid">
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
                    </div>

                    <button type="submit" class="btn btn-primary submit-btn">
                        Ielogoties
                    </button>
                </form>
            </div>

            <div class="auth-links">
                <h4>Jauns lietotājs?</h4>
                <p>
                    Izveido kontu un sāc veidot savu recepšu kolekciju, saglabāt favorītus un dalīties ar savām iecienītākajām garšām.
                </p>

                <div class="register-actions">
                    <a href="{{ route('register') }}" class="btn btn-success">
                        Izveidot kontu
                    </a>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="secondary-link">
                            Aizmirsāt paroli?
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="login-panel login-hero-right">
            <div class="feature-icon">🍽️</div>
            <h2 class="feature-title">Kas jūs gaida iekšpusē</h2>
            <p class="feature-text">
                Mājīga, pārskatāma un skaista recepšu vide, kur glabāt savus iecienītākos ēdienus un atrast jaunas idejas katrai dienai.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <h5>Izveidot receptes</h5>
                    <p>Dalieties ar savām receptēm un veidojiet personīgu kulinārijas kolekciju vienuviet.</p>
                </div>

                <div class="feature-item">
                    <h5>Atklāt jaunas idejas</h5>
                    <p>Pārlūkojiet receptes, meklējiet pēc kategorijām un atrodiet iedvesmu ikdienas maltītēm.</p>
                </div>

                <div class="feature-item">
                    <h5>Saglabāt favorītus</h5>
                    <p>Atzīmējiet savas iecienītākās receptes, lai tās vienmēr būtu ātri atrodamas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
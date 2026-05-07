{{--
    Ielogošanās lapas skats.

    Šis Blade fails nodrošina lietotāja ielogošanās lapu tīmekļa vietnē
    “Vecmāmiņas Receptes”. Skats paredzēts lietotājiem, kuriem jau ir izveidots
    konts un kuri vēlas piekļūt savām receptēm, favorītiem un personīgajai
    recepšu kolekcijai.

    Failā ir iekļauta pilna ielogošanās forma ar e-pasta un paroles ievades laukiem,
    “atcerēties mani” izvēles rūtiņu, validācijas kļūdu attēlošanu, saiti uz
    reģistrācijas lapu un saiti uz paroles atjaunošanas lapu, ja šāds maršruts
    sistēmā ir pieejams.

    Skatā iekļautais CSS nosaka lapas vizuālo noformējumu, navigācijas joslu,
    ielogošanās formas paneli, informatīvo labo paneli, pogas, ievades laukus,
    kļūdu paziņojumus un pielāgojumus mobilajām ierīcēm.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', 'Ielogoties - Vecmāmiņas Receptes')

{{-- Norāda lapas meta aprakstu meklētājprogrammām un pārlūkam --}}
@section('meta_description', 'Ielogojieties Vecmāmiņas Receptes, lai piekļūtu savām receptēm, favorītiem un personīgajai recepšu kolekcijai.')

@section('content')
<style>
    /* Ierobežo ielogošanās lapas maksimālo platumu */
    .login-page {
        max-width: 1220px;
        margin: 0 auto;
    }

    /* Noformē augšējo navigācijas joslu */
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

    /* Noformē vietnes nosaukumu navigācijā */
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

    /* Pievieno ikonu pirms vietnes nosaukuma */
    .login-nav-brand::before {
        content: "📖";
        font-size: 1.1rem;
        line-height: 1;
    }

    /* Sakārto navigācijas saites vienā rindā */
    .login-nav-links {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Noformē navigācijas saites */
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

    /* Pievieno hover efektu navigācijas saitēm */
    .login-nav-links a:hover {
        background: var(--surface-soft);
        border-color: var(--line);
        color: var(--accent);
        transform: translateY(-1px);
    }

    /* Izveido divu kolonnu hero izkārtojumu */
    .login-hero {
        display: grid;
        grid-template-columns: 1.04fr 0.96fr;
        gap: 26px;
        align-items: stretch;
    }

    /* Kopīgais abu paneļu noformējums */
    .login-panel {
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(79, 59, 42, 0.07);
        min-width: 0;
    }

    /* Noformē kreiso paneli ar ielogošanās formu */
    .login-hero-left {
        background: rgba(255, 253, 249, 0.97);
        padding: 40px;
    }

    /* Noformē labo informatīvo paneli */
    .login-hero-right {
        background: linear-gradient(180deg, #fbf5ee 0%, #f3e8dc 100%);
        padding: 38px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    /* Pievieno dekoratīvu fonu labajam panelim */
    .login-hero-right::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.38) 0%, rgba(255,255,255,0) 24%),
            radial-gradient(circle at bottom left, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 26%);
        pointer-events: none;
    }

    /* Nodrošina, ka labā paneļa saturs atrodas virs dekoratīvā fona */
    .login-hero-right > * {
        position: relative;
        z-index: 1;
    }

    /* Noformē mazo ievadteksta birku */
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

    /* Noformē galveno ielogošanās virsrakstu */
    .login-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3rem;
        line-height: 1.08;
        color: var(--accent);
        margin-bottom: 16px;
        font-weight: 500;
    }

    /* Noformē paskaidrojuma tekstu zem virsraksta */
    .login-text {
        color: var(--muted);
        font-size: 16px;
        line-height: 1.8;
        max-width: 560px;
    }

    /* Atdala formu no ievadteksta */
    .form-area {
        margin-top: 30px;
        padding-top: 24px;
        border-top: 1px solid rgba(221, 207, 192, 0.9);
    }

    /* Sakārto formas laukus vertikālā režģī */
    .form-grid {
        display: grid;
        gap: 20px;
    }

    /* Noņem noklusēto formas grupas apakšējo atstarpi */
    .form-group {
        margin-bottom: 0;
    }

    /* Noformē formas lauka nosaukumu */
    .form-label {
        display: block;
        margin-bottom: 9px;
        font-weight: 700;
        color: var(--text);
        font-size: 14px;
    }

    /* Noformē e-pasta un paroles ievades laukus */
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

    /* Noformē ievades lauku placeholder tekstu */
    .form-input::placeholder {
        color: #9a8d82;
    }

    /* Noformē ievades lauku fokusa stāvoklī */
    .form-input:focus {
        outline: none;
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
    }

    /* Noformē validācijas kļūdu tekstu */
    .field-error {
        color: var(--danger-text);
        font-size: 13px;
        margin-top: 6px;
        display: block;
        font-weight: 600;
    }

    /* Nosaka atstarpes “atcerēties mani” rindai */
    .remember-row {
        margin-top: 2px;
        margin-bottom: 4px;
    }

    /* Noformē “atcerēties mani” izvēles rūtiņas tekstu */
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

    /* Noformē izvēles rūtiņu */
    .remember-label input {
        width: 16px;
        height: 16px;
        accent-color: var(--accent);
    }

    /* Noformē ielogošanās pogu */
    .submit-btn {
        width: 100%;
        padding: 16px 18px;
        font-size: 16px;
        margin-top: 4px;
        margin-bottom: 26px;
    }

    /* Atdala reģistrācijas un paroles atjaunošanas saites */
    .auth-links {
        padding-top: 24px;
        border-top: 1px solid rgba(221, 207, 192, 0.9);
    }

    /* Noformē sadaļas “Jauns lietotājs?” virsrakstu */
    .auth-links h4 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.85rem;
        margin-bottom: 12px;
        font-weight: 500;
    }

    /* Noformē tekstu pie reģistrācijas sadaļas */
    .auth-links p {
        color: var(--muted);
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 18px;
    }

    /* Noformē sekundāro saiti, piemēram, paroles atjaunošanu */
    .secondary-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
    }

    /* Pievieno hover efektu sekundārajai saitei */
    .secondary-link:hover {
        text-decoration: underline;
    }

    /* Sakārto reģistrācijas pogu un paroles atjaunošanas saiti */
    .register-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 8px;
    }

    /* Noformē labā paneļa lielo ikonu */
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

    /* Noformē labā paneļa virsrakstu */
    .feature-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.15rem;
        margin-bottom: 12px;
        font-weight: 500;
        line-height: 1.15;
    }

    /* Noformē labā paneļa aprakstu */
    .feature-text {
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 28px;
        font-size: 15px;
    }

    /* Sakārto labā paneļa funkciju sarakstu */
    .feature-list {
        display: grid;
        gap: 14px;
    }

    /* Noformē vienu funkcijas kartīti */
    .feature-item {
        padding: 16px 16px;
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        background: rgba(255, 253, 249, 0.56);
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.03);
    }

    /* Noformē funkcijas kartītes virsrakstu */
    .feature-item h5 {
        color: var(--text);
        font-size: 1rem;
        margin-bottom: 6px;
        font-weight: 800;
    }

    /* Noformē funkcijas kartītes aprakstu */
    .feature-item p {
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
    }

    /* Mobilā dizaina pamata pielāgojumi */
    .login-page {
        width: 100%;
        max-width: 1220px;
        margin: 0 auto;
        overflow-x: hidden;
    }

    /* Novērš elementu pārplūšanu ārpus ekrāna */
    .login-nav,
    .login-hero,
    .login-panel,
    .form-area,
    .form-grid,
    .form-group,
    .auth-links,
    .feature-list,
    .feature-item,
    .login-nav-links,
    .register-actions {
        min-width: 0;
    }

    /* Pielāgo izkārtojumu mazākiem ekrāniem */
    @media (max-width: 980px) {
        .login-hero {
            grid-template-columns: 1fr;
        }

        .login-hero-left,
        .login-hero-right {
            padding: 30px 26px;
        }

        .login-title {
            font-size: 2.35rem;
        }

        .feature-title {
            font-size: 1.9rem;
        }
    }

    /* Pielāgo lapu planšetēm un telefoniem */
    @media (max-width: 768px) {
        .login-page {
            max-width: 100%;
        }

        .login-nav {
            padding: 16px;
            border-radius: 18px;
            gap: 14px;
            margin-bottom: 20px;
        }

        .login-nav-brand {
            width: 100%;
            font-size: 1.7rem;
            line-height: 1.2;
        }

        .login-nav-links {
            width: 100%;
            justify-content: flex-start;
            gap: 8px;
        }

        .login-nav-links a {
            padding: 9px 12px;
            font-size: 13px;
        }

        .login-nav > div:last-child {
            width: 100%;
        }

        .login-nav > div:last-child .btn {
            width: 100%;
            justify-content: center;
        }

        .login-hero {
            gap: 18px;
        }

        .login-panel {
            border-radius: 22px;
        }

        .login-hero-left,
        .login-hero-right {
            padding: 22px 18px;
        }

        .login-eyebrow {
            font-size: 11px;
            padding: 6px 10px;
            letter-spacing: 0.08em;
            margin-bottom: 12px;
            max-width: 100%;
            white-space: normal;
        }

        .login-title {
            font-size: 1.9rem;
            line-height: 1.15;
            margin-bottom: 12px;
        }

        .login-text,
        .feature-text,
        .auth-links p {
            font-size: 14px;
            line-height: 1.65;
        }

        .form-area {
            margin-top: 22px;
            padding-top: 18px;
        }

        .form-grid {
            gap: 16px;
        }

        .form-label {
            font-size: 13px;
            margin-bottom: 7px;
        }

        .form-input {
            padding: 13px 14px;
            font-size: 16px;
            border-radius: 14px;
        }

        .remember-row {
            margin-top: 0;
        }

        .remember-label {
            width: 100%;
            align-items: flex-start;
            padding: 10px 12px;
            font-size: 13px;
            line-height: 1.45;
            border-radius: 13px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px 16px;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .auth-links {
            padding-top: 18px;
        }

        .auth-links h4 {
            font-size: 1.45rem;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .register-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .register-actions .btn,
        .register-actions .secondary-link {
            width: 100%;
            text-align: center;
        }

        .feature-icon {
            width: 54px;
            height: 54px;
            font-size: 1.55rem;
            border-radius: 15px;
            margin-bottom: 14px;
        }

        .feature-title {
            font-size: 1.6rem;
            line-height: 1.18;
            margin-bottom: 10px;
        }

        .feature-list {
            gap: 10px;
        }

        .feature-item {
            padding: 14px;
            border-radius: 16px;
        }

        .feature-item h5 {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .feature-item p {
            font-size: 13px;
            line-height: 1.55;
        }
    }

    /* Pielāgo lapu ļoti maziem telefona ekrāniem */
    @media (max-width: 480px) {
        .login-nav {
            padding: 14px;
            border-radius: 16px;
        }

        .login-nav-brand {
            font-size: 1.45rem;
            gap: 10px;
        }

        .login-nav-brand::before {
            font-size: 1rem;
        }

        .login-nav-links {
            flex-direction: column;
            align-items: stretch;
        }

        .login-nav-links a {
            width: 100%;
            text-align: center;
        }

        .login-panel {
            border-radius: 18px;
        }

        .login-hero-left,
        .login-hero-right {
            padding: 18px 14px;
        }

        .login-title {
            font-size: 1.65rem;
        }

        .login-text {
            font-size: 13px;
        }

        .form-input {
            padding: 12px 13px;
            font-size: 16px;
        }

        .submit-btn {
            padding: 13px 14px;
            font-size: 14px;
        }

        .auth-links h4 {
            font-size: 1.28rem;
        }

        .feature-title {
            font-size: 1.4rem;
        }

        .feature-text,
        .auth-links p,
        .feature-item p {
            font-size: 13px;
        }
    }
</style>

{{-- Galvenais ielogošanās lapas konteiners --}}
<div class="login-page">

    {{-- Augšējā navigācija ar vietnes nosaukumu un saitēm --}}
    <nav class="login-nav">

        {{-- Saite uz sākumlapu ar vietnes nosaukumu --}}
        <a href="/" class="login-nav-brand">Vecmāmiņas Receptes</a>

        {{-- Navigācijas saites uz sākumlapu un reģistrāciju --}}
        <div class="login-nav-links">
            <a href="/">Sākums</a>
            <a href="{{ route('register') }}">Reģistrēties</a>
        </div>

        {{-- Atgriešanās poga uz sākumlapu --}}
        <div>
            <a href="/" class="btn btn-secondary">Atpakaļ uz sākumu</a>
        </div>
    </nav>

    {{-- Divu paneļu ielogošanās izkārtojums --}}
    <div class="login-hero">

        {{-- Kreisais panelis satur ielogošanās formu --}}
        <div class="login-panel login-hero-left">

            {{-- Mazais ievadteksts virs virsraksta --}}
            <div class="login-eyebrow">Laipni lūdzam atpakaļ</div>

            {{-- Galvenais lapas virsraksts --}}
            <h1 class="login-title">Ielogojieties savā kontā</h1>

            {{-- Īss paskaidrojums par ielogošanās nozīmi --}}
            <p class="login-text">
                Piekļūstiet savām receptēm, favorītiem un personīgajai recepšu kolekcijai vienotā, siltā un ērtā vidē.
            </p>

            {{-- Formas zona --}}
            <div class="form-area">

                {{-- Forma nosūta ielogošanās datus uz Laravel login maršrutu --}}
                <form method="POST" action="{{ route('login') }}">

                    {{-- CSRF aizsardzība pret neatļautiem pieprasījumiem --}}
                    @csrf

                    {{-- Formas ievades lauku režģis --}}
                    <div class="form-grid">

                        {{-- E-pasta ievades grupa --}}
                        <div class="form-group">

                            {{-- E-pasta lauka nosaukums --}}
                            <label class="form-label" for="email">E-pasta adrese</label>

                            {{-- 
                                E-pasta ievades lauks.
                                old('email') saglabā iepriekš ievadīto vērtību, ja validācija neizdodas.
                                @error pievieno kļūdas klasi, ja e-pasts nav pareizs.
                            --}}
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

                            {{-- Parāda e-pasta validācijas kļūdu --}}
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Paroles ievades grupa --}}
                        <div class="form-group">

                            {{-- Paroles lauka nosaukums --}}
                            <label class="form-label" for="password">Parole</label>

                            {{-- 
                                Paroles ievades lauks.
                                autocomplete="current-password" norāda pārlūkam, ka tiek ievadīta esošā parole.
                            --}}
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input @error('password') is-invalid @enderror"
                                placeholder="Ievadiet savu paroli"
                                required
                                autocomplete="current-password">

                            {{-- Parāda paroles validācijas kļūdu --}}
                            @error('password')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- “Atcerēties mani” izvēle --}}
                        <div class="remember-row">
                            <label class="remember-label">

                                {{-- Ja rūtiņa ir atzīmēta, Laravel var saglabāt lietotāja sesiju ilgāk --}}
                                <input type="checkbox" name="remember">

                                <span>Atcerēties mani 30 dienas</span>
                            </label>
                        </div>
                    </div>

                    {{-- Poga nosūta ielogošanās formu --}}
                    <button type="submit" class="btn btn-primary submit-btn">
                        Ielogoties
                    </button>
                </form>
            </div>

            {{-- Papildu autentifikācijas saites --}}
            <div class="auth-links">

                {{-- Reģistrācijas sadaļas virsraksts --}}
                <h4>Jauns lietotājs?</h4>

                {{-- Paskaidrojums lietotājam par konta izveidi --}}
                <p>
                    Izveido kontu un sāc veidot savu recepšu kolekciju, saglabāt favorītus un dalīties ar savām iecienītākajām garšām.
                </p>

                {{-- Reģistrācijas un paroles atjaunošanas darbības --}}
                <div class="register-actions">

                    {{-- Saite uz reģistrācijas lapu --}}
                    <a href="{{ route('register') }}" class="btn btn-success">
                        Izveidot kontu
                    </a>

                    {{-- Paroles atjaunošanas saite tiek parādīta tikai tad, ja maršruts eksistē --}}
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="secondary-link">
                            Aizmirsāt paroli?
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Labais panelis ar informatīvu aprakstu par sistēmas iespējām --}}
        <div class="login-panel login-hero-right">

            {{-- Dekoratīva ikona --}}
            <div class="feature-icon">🍽️</div>

            {{-- Labā paneļa virsraksts --}}
            <h2 class="feature-title">Kas jūs gaida iekšpusē</h2>

            {{-- Labā paneļa paskaidrojuma teksts --}}
            <p class="feature-text">
                Mājīga, pārskatāma un skaista recepšu vide, kur glabāt savus iecienītākos ēdienus un atrast jaunas idejas katrai dienai.
            </p>

            {{-- Sistēmas priekšrocību saraksts --}}
            <div class="feature-list">

                {{-- Paskaidro recepšu izveides iespēju --}}
                <div class="feature-item">
                    <h5>Izveidot receptes</h5>
                    <p>Dalieties ar savām receptēm un veidojiet personīgu kulinārijas kolekciju vienuviet.</p>
                </div>

                {{-- Paskaidro recepšu pārlūkošanas iespēju --}}
                <div class="feature-item">
                    <h5>Atklāt jaunas idejas</h5>
                    <p>Pārlūkojiet receptes, meklējiet pēc kategorijām un atrodiet iedvesmu ikdienas maltītēm.</p>
                </div>

                {{-- Paskaidro favorītu saglabāšanas iespēju --}}
                <div class="feature-item">
                    <h5>Saglabāt favorītus</h5>
                    <p>Atzīmējiet savas iecienītākās receptes, lai tās vienmēr būtu ātri atrodamas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
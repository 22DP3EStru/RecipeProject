{{--
    Administrācijas izkārtojuma skats.

    Šis Blade fails nodrošina kopējo administrācijas paneļa izkārtojumu
    tīmekļa vietnē “Vecmāmiņas Receptes”. Tas tiek izmantots administrācijas
    sadaļās, kurās nepieciešama lietotāju, recepšu un cita satura pārvaldība.

    Failā ir definēta HTML dokumenta struktūra, lapas meta dati, favicon ikonas,
    Vite resursu piesaiste, administrācijas navigācijas josla, autorizētā lietotāja
    e-pasta attēlošana, izrakstīšanās forma, paziņojumu komponente un galvenā
    satura vieta, kurā tiek ievietots konkrētās administrācijas lapas saturs.

    Skatā iekļautais CSS nosaka administrācijas paneļa fonu, augšējās navigācijas
    joslas noformējumu, saitēm un pogām izmantotos stilus, lietotāja informācijas
    attēlojumu, galvenā satura konteineru un paziņojumu vizuālo izskatu.
--}}

<!DOCTYPE html>
<html lang="lv">
<head>
    {{-- Norāda dokumenta rakstzīmju kodējumu --}}
    <meta charset="UTF-8">

    {{-- Nodrošina lapas pielāgošanos dažādiem ekrāna izmēriem --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Norāda lapas nosaukumu; ja konkrētā lapa to nenosaka, tiek izmantota noklusējuma vērtība --}}
    <title>@yield('title', 'Admin - Vecmāmiņas Receptes')</title>

    {{-- Norāda lapas meta aprakstu meklētājprogrammām un pārlūkam --}}
    <meta name="description" content="@yield('meta_description', 'Vecmāmiņas Receptes administrācijas panelis - lietotāju, recepšu un satura pārvaldība.')">

    {{-- Pievieno vietnes favicon ikonu pārlūkprogrammas cilnei --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">

    {{-- Pievieno alternatīvu favicon norādi vecākiem pārlūkiem --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    {{-- Pievieno Laravel Vite kompilētos CSS un JavaScript resursus --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Definē administrācijas paneļa galvenās krāsu, virsmu un ēnu vērtības */
        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --surface: #fffdf9;
            --surface-soft: #f6efe7;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --shadow: 0 14px 36px rgba(79, 59, 42, 0.06);
        }

        /* Nodrošina, ka HTML un body aizņem pilnu lapas augstumu */
        html, body {
            min-height: 100%;
        }

        /* Noformē administrācijas paneļa kopējo lapas fonu un tekstu */
        body.admin-layout {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
        }

        /* Nodrošina, ka administrācijas apvalks aizņem vismaz visu ekrāna augstumu */
        .admin-shell {
            min-height: 100vh;
        }

        /* Ierobežo augšējās joslas platumu un piešķir ārējās atstarpes */
        .admin-topbar-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 26px 20px 0;
        }

        /* Noformē administrācijas paneļa augšējo navigācijas joslu */
        .admin-topbar {
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        /* Sakārto navigācijas joslas kreisās un labās puses elementus */
        .admin-topbar-left,
        .admin-topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Noformē vietnes nosaukumu administrācijas joslā */
        .admin-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        /* Noformē administrācijas navigācijas saites */
        .admin-link {
            text-decoration: none;
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        /* Pievieno hover efektu administrācijas saitēm */
        .admin-link:hover {
            background: var(--surface-soft);
            border-color: var(--line);
            color: var(--accent);
        }

        /* Noformē autorizētā lietotāja e-pasta attēlojumu */
        .admin-user {
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        /* Noformē izrakstīšanās pogu administrācijas panelī */
        .admin-logout-btn {
            border: 1px solid var(--line);
            background: #f3e2de;
            color: #a45f52;
            padding: 11px 16px;
            font-weight: 700;
            cursor: pointer;
        }

        /* Ierobežo galvenā administrācijas satura platumu un piešķir atstarpes */
        .admin-main-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px 20px 42px;
        }

        /* Nosaka atstarpi zem paziņojumu bloka */
        .flash-messages {
            margin-bottom: 20px;
        }

        /* Noformē viena paziņojuma pamata izskatu */
        .flash-message {
            padding: 12px 16px;
            border: 1px solid;
            margin-bottom: 10px;
            font-weight: 600;
        }

        /* Noformē veiksmīgas darbības paziņojumu */
        .flash-message.success {
            background: #e8eee2;
            color: #667652;
            border-color: #d7dfcc;
        }

        /* Noformē kļūdas paziņojumu */
        .flash-message.error {
            background: #f7ebe8;
            color: #a45f52;
            border-color: #e3c9c2;
        }
    </style>

    {{-- Pievieno mobilajām ierīcēm paredzētos papildu stilus --}}
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
</head>

{{-- Body klase norāda, ka tiek izmantots administrācijas izkārtojums --}}
<body class="admin-layout">

{{-- Administrācijas paneļa kopējais apvalks --}}
<div class="admin-shell">

    {{-- Administrācijas augšējās joslas ārējais konteiners --}}
    <header class="admin-topbar-wrap">

        {{-- Administrācijas augšējā navigācijas josla --}}
        <div class="admin-topbar">

            {{-- Kreisā puse satur vietnes nosaukumu un navigācijas saites --}}
            <div class="admin-topbar-left">

                {{-- Saite uz administrācijas paneļa sākumlapu --}}
                <a href="{{ route('admin.index') }}" class="admin-brand">Vecmāmiņas Receptes</a>

                {{-- Saite uz administrācijas paneļa galveno sadaļu --}}
                <a href="{{ route('admin.index') }}" class="admin-link">Admin panelis</a>

                {{-- Saite uz parasto lietotāja sākumlapu vai paneli --}}
                <a href="{{ route('dashboard') }}" class="admin-link">Uz sākumlapu</a>
            </div>

            {{-- Labā puse satur autorizētā lietotāja informāciju un izrakstīšanos --}}
            <div class="admin-topbar-right">

                {{-- Parāda pašreiz autorizētā lietotāja e-pasta adresi --}}
                <span class="admin-user">{{ auth()->user()?->email }}</span>

                {{-- Izrakstīšanās forma izmanto POST metodi, kā to paredz Laravel autentifikācija --}}
                <form method="POST" action="{{ route('logout') }}">

                    {{-- CSRF aizsardzība pret neatļautiem pieprasījumiem --}}
                    @csrf

                    {{-- Poga izraksta administratoru no sistēmas --}}
                    <button type="submit" class="admin-logout-btn">Iziet</button>
                </form>
            </div>
        </div>
    </header>

    {{-- Galvenā administrācijas satura zona --}}
    <main class="admin-main-wrap">

        {{-- Iekļauj kopīgo paziņojumu komponenti veiksmīgām darbībām un kļūdām --}}
        @include('components.flash-messages')

        {{-- Šajā vietā tiek ievietots konkrētās administrācijas lapas saturs --}}
        @yield('content')
    </main>

</div>

</body>
</html>
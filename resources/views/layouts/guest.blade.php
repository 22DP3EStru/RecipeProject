<!--
    Autentifikācijas izkārtojuma fails.

    Šis Blade komponents tiek izmantots autentifikācijas lapām:
    - ielogošanās lapai;
    - reģistrācijas lapai;
    - paroles atjaunošanas lapām.

    Fails nosaka atsevišķu dizainu autentifikācijas sadaļai,
    lai lietotājam būtu vienkārša, pārskatāma un vizuāli nošķirta vide.
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Nosaka dokumenta rakstzīmju kodējumu. -->
        <meta charset="utf-8">

        <!-- Nodrošina pareizu attēlošanu mobilajās ierīcēs. -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF tokens aizsargā formas pret neatļautiem pieprasījumiem. -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Lapas nosaukums tiek veidots no lietotnes nosaukuma un konkrētās lapas virsraksta. -->
        <title>{{ config('app.name', 'Vecmāmiņas Receptes') }} - {{ $title ?? 'Autentifikācija' }}</title>

        <!-- Vite ielādē Laravel projekta galvenos CSS un JavaScript failus. -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /*
                Autentifikācijas lapas dizaina mainīgie.

                Šie mainīgie ļauj vienkārši uzturēt kopējo krāsu shēmu,
                teksta krāsas, līnijas un ēnas.
            */
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
                --shadow: 0 16px 40px rgba(79, 59, 42, 0.07);
            }

            /*
                box-sizing: border-box nodrošina, ka elementa platumā tiek iekļauta
                arī iekšējā atkāpe un apmale.
            */
            * {
                box-sizing: border-box;
            }

            /*
                HTML un body tiek atiestatīti, lai autentifikācijas izkārtojums
                varētu aizņemt visu ekrāna augstumu.
            */
            html, body {
                min-height: 100%;
                margin: 0;
                padding: 0;
            }

            /*
                Galvenais autentifikācijas lapas body stils.

                Klase auth-layout tiek izmantota tikai autentifikācijas lapās,
                tāpēc šie stili neietekmē pārējās vietnes lapas.
            */
            body.auth-layout {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                color: var(--text);
                background:
                    linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                    linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            /*
                Ārējais autentifikācijas lapas ietvars.

                Tas centrē autentifikācijas bloku gan vertikāli, gan horizontāli.
            */
            .auth-shell {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 28px 16px;
            }

            /*
                Galvenais autentifikācijas konteiners.

                Tas ir sadalīts divās kolonnās:
                - kreisajā pusē ir informatīvais apraksts;
                - labajā pusē ir forma, kas tiek ievietota ar {{ $slot }}.
            */
            .auth-wrap {
                width: 100%;
                max-width: 1080px;
                display: grid;
                grid-template-columns: 1fr 440px;
                border: 1px solid var(--line);
                background: rgba(255, 253, 249, 0.9);
                box-shadow: var(--shadow);
                overflow: hidden;
            }

            /*
                Kreisā informatīvā sadaļa.

                Tajā lietotājam tiek īsi paskaidrots, kādas iespējas piedāvā sistēma.
            */
            .auth-side {
                background: linear-gradient(180deg, #f8f1e8 0%, #f0e4d5 100%);
                padding: 48px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                border-right: 1px solid var(--line);
            }

            /* Neliels augšējais teksts ar vietnes nosaukumu. */
            .auth-eyebrow {
                color: var(--muted);
                text-transform: uppercase;
                letter-spacing: 0.16em;
                font-size: 12px;
                font-weight: 700;
                margin-bottom: 14px;
            }

            /*
                Autentifikācijas lapas galvenais zīmola teksts.

                Tas darbojas arī kā saite uz sākumlapu.
            */
            .auth-brand {
                font-family: Georgia, "Times New Roman", serif;
                font-size: 3rem;
                line-height: 1.05;
                color: var(--accent);
                font-weight: 500;
                text-decoration: none;
                display: inline-block;
                margin-bottom: 18px;
            }

            /*
                Īss paskaidrojošs teksts par vietnes funkcionalitāti.
            */
            .auth-side-text {
                color: var(--muted);
                font-size: 15px;
                line-height: 1.9;
                max-width: 500px;
                margin-bottom: 28px;
            }

            /*
                Funkcionalitāšu saraksts kreisajā pusē.
            */
            .auth-feature-list {
                display: grid;
                gap: 18px;
            }

            /*
                Viena funkcionalitātes apraksta bloks.
            */
            .auth-feature {
                padding-top: 18px;
                border-top: 1px solid rgba(122, 90, 67, 0.14);
            }

            /*
                Pirmajam funkcionalitātes blokam nav nepieciešama augšējā līnija.
            */
            .auth-feature:first-child {
                padding-top: 0;
                border-top: none;
            }

            .auth-feature h4 {
                margin: 0 0 6px;
                font-size: 1rem;
                color: var(--text);
                font-weight: 700;
            }

            .auth-feature p {
                margin: 0;
                color: var(--muted);
                font-size: 14px;
                line-height: 1.7;
            }

            /*
                Labās puses autentifikācijas kartīte.

                Tajā tiek attēlota konkrētā forma, piemēram,
                ielogošanās vai reģistrācijas forma.
            */
            .auth-card {
                background: var(--surface);
                padding: 42px 34px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            /*
                Iekšējais formas konteiners.
                Tas nodrošina, ka ievietotais slots aizņem visu pieejamo platumu.
            */
            .auth-card-inner {
                width: 100%;
            }

            /*
                Apakšējā saite atpakaļ uz sākumlapu.
            */
            .auth-back {
                margin-top: 24px;
                text-align: center;
            }

            .auth-back a {
                color: var(--accent);
                text-decoration: none;
                font-size: 14px;
                font-weight: 700;
            }

            .auth-back a:hover {
                text-decoration: underline;
            }
        </style>

        <!-- Papildu mobilā dizaina fails, kas pielāgo izkārtojumu mazākiem ekrāniem. -->
        <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    </head>

    <!-- auth-layout klase norāda, ka šī ir autentifikācijas izkārtojuma lapa. -->
    <body class="auth-layout">
        <!-- Ārējais ietvars centrē visu autentifikācijas bloku ekrānā. -->
        <div class="auth-shell">

            <!-- Galvenais divu kolonnu autentifikācijas bloks. -->
            <div class="auth-wrap">

                <!-- Kreisā puse ar vietnes aprakstu un galvenajām iespējām. -->
                <div class="auth-side">
                    <div class="auth-eyebrow">Vecmāmiņas Receptes</div>

                    <!-- Saite uz sākumlapu ar vietnes galveno saukli. -->
                    <a href="/" wire:navigate class="auth-brand">Garšas, kas paliek atmiņā</a>

                    <p class="auth-side-text">
                        Pievienojieties mājīgai recepšu videi, kur varat saglabāt favorītus, publicēt savas receptes un atrast iedvesmu ikdienai.
                    </p>

                    <!-- Īss sistēmas funkcionalitātes apraksts. -->
                    <div class="auth-feature-list">
                        <div class="auth-feature">
                            <h4>Saglabājiet savas receptes</h4>
                            <p>Veidojiet savu personīgo recepšu kolekciju vienuviet.</p>
                        </div>

                        <div class="auth-feature">
                            <h4>Atrodiet jaunas idejas</h4>
                            <p>Pārlūkojiet kategorijas un atklājiet jaunas garšas.</p>
                        </div>

                        <div class="auth-feature">
                            <h4>Glabājiet favorītus</h4>
                            <p>Jūsu iecienītākās receptes vienmēr būs ātri sasniedzamas.</p>
                        </div>
                    </div>
                </div>

                <!-- Labā puse, kur tiek ievietots konkrētās autentifikācijas lapas saturs. -->
                <div class="auth-card">
                    <div class="auth-card-inner">
                        <!--
                            {{ $slot }} ir Blade komponenta vietturis.

                            Šajā vietā Laravel ievieto konkrētās lapas saturu,
                            piemēram, ielogošanās, reģistrācijas vai paroles atjaunošanas formu.
                        -->
                        {{ $slot }}
                    </div>

                    <!-- Saite lietotājam, lai atgrieztos vietnes sākumlapā. -->
                    <div class="auth-back">
                        <a href="/" wire:navigate>← Atpakaļ uz Vecmāmiņas Receptes</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
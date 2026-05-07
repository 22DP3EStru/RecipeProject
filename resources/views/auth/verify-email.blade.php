{{--
    E-pasta apstiprināšanas lapas skats.

    Šis Blade fails nodrošina e-pasta apstiprināšanas lapu tīmekļa vietnē
    “Vecmāmiņas Receptes”. Skats tiek parādīts lietotājiem pēc reģistrācijas,
    ja lietotāja e-pasta adrese vēl nav verificēta.

    Failā ir iekļauts informatīvs paziņojums par nepieciešamību apstiprināt
    e-pasta adresi, poga atkārtotai verifikācijas e-pasta nosūtīšanai, poga
    lietotāja izrakstīšanai no sistēmas, kā arī nosacījums, kas parāda
    apstiprinājuma paziņojumu pēc jaunas verifikācijas saites nosūtīšanas.

    Skatā iekļautais CSS nosaka lapas fonu, navigācijas joslu, kartītes
    noformējumu, virsrakstus, informatīvo tekstu, pogas, paziņojumus un
    vispārējo e-pasta apstiprināšanas lapas vizuālo struktūru.
--}}

<!DOCTYPE html>
<html lang="lv">
<head>
    {{-- Norāda dokumenta rakstzīmju kodējumu --}}
    <meta charset="UTF-8">

    {{-- Nodrošina lapas pielāgošanos mobilajām ierīcēm --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
    <title>Apstiprini e-pastu - Vecmāmiņas Receptes</title>

    <style>
        /* Noņem noklusētās atstarpes un nodrošina ērtāku izmēru aprēķinu visiem elementiem */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Definē galvenās krāsu un ēnu vērtības, kas tiek izmantotas visā lapā */
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

        /* Noformē lapas pamatizskatu un fonu */
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
            min-height: 100vh;
            color: var(--text);
        }

        /* Ierobežo lapas satura platumu un piešķir ārējās atstarpes */
        .page {
            max-width: 900px;
            margin: 0 auto;
            padding: 28px 20px 50px;
        }

        /* Noformē augšējo navigācijas joslu */
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

        /* Noformē vietnes nosaukumu navigācijas joslā */
        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        /* Sakārto navigācijas saites un izrakstīšanās formu */
        .nav-links {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Nodrošina, ka izrakstīšanās forma atrodas vienā rindā ar saitēm */
        .nav-links form {
            display: inline;
        }

        /* Noformē navigācijas pogas un saites */
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

        /* Pievieno hover efektu navigācijas saitēm un pogām */
        .nav-links button:hover,
        .nav-links a:hover {
            background: var(--soft-bg);
            border-color: var(--line);
            color: var(--accent);
        }

        /* Noformē galveno e-pasta apstiprināšanas kartīti */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: 44px;
        }

        /* Noformē mazo sadaļas apzīmējumu virs virsraksta */
        .eyebrow {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 12px;
            margin-bottom: 14px;
            font-weight: 700;
        }

        /* Noformē galveno lapas virsrakstu */
        .title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.8rem;
            line-height: 1.1;
            color: var(--accent);
            margin-bottom: 18px;
            font-weight: 500;
        }

        /* Noformē paskaidrojošo tekstu kartītē */
        .text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        /* Noformē veiksmīgi nosūtītas verifikācijas saites paziņojumu */
        .alert-success {
            padding: 16px 18px;
            margin: 20px 0 24px;
            border: 1px solid #d7dfcc;
            background: var(--success-bg);
            color: var(--success-text);
        }

        /* Sakārto darbību pogas vienā rindā ar iespēju pāriet jaunā rindā */
        .actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 26px;
        }

        /* Noformē pogu pamata izskatu */
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

        /* Pievieno nelielu hover efektu pogām */
        .btn:hover {
            filter: brightness(0.98);
        }

        /* Noformē galveno darbības pogu */
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
        }

        /* Maina galvenās pogas fonu hover stāvoklī */
        .btn-primary:hover {
            background: var(--accent-dark);
        }

        /* Noformē sekundāro darbības pogu */
        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
        }
    </style>

    {{-- Pievieno vietnes favicon ikonu pārlūkprogrammas cilnei --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">

    {{-- Pievieno alternatīvu favicon norādi vecākiem pārlūkiem --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
</head>
<body>
    {{-- Galvenais lapas konteiners --}}
    <div class="page">

        {{-- Augšējā navigācija ar saiti uz paneli un izrakstīšanās iespēju --}}
        <nav class="nav-bar">

            {{-- Saite uz sākumlapu ar vietnes nosaukumu --}}
            <a href="/" class="nav-brand">Vecmāmiņas Receptes</a>

            {{-- Navigācijas darbības lietotājam --}}
            <div class="nav-links">

                {{-- Saite uz lietotāja paneli --}}
                <a href="{{ route('dashboard') }}">Uz paneli</a>

                {{-- Izrakstīšanās forma nosūta POST pieprasījumu uz logout maršrutu --}}
                <form method="POST" action="{{ route('logout') }}">

                    {{-- CSRF aizsardzība pret neatļautiem pieprasījumiem --}}
                    @csrf

                    {{-- Poga izraksta lietotāju no sistēmas --}}
                    <button type="submit">Izrakstīties</button>
                </form>
            </div>
        </nav>

        {{-- Galvenā e-pasta apstiprināšanas kartīte --}}
        <div class="card">

            {{-- Mazais sadaļas apzīmējums --}}
            <div class="eyebrow">E-pasta apstiprināšana</div>

            {{-- Galvenais lapas virsraksts --}}
            <h1 class="title">Apstiprini savu e-pastu</h1>

            {{-- Informatīvs teksts par e-pasta apstiprināšanas nepieciešamību --}}
            <p class="text">
                Paldies par reģistrāciju. Pirms turpināt lietot sistēmu, lūdzu atver savu e-pastu un nospied
                uz saites, kuru tikko nosūtījām. Tikai pēc apstiprināšanas tavs konts tiks atzīmēts kā verificēts.
            </p>

            {{-- Ja jauna verifikācijas saite ir nosūtīta, lietotājam tiek parādīts apstiprinājuma paziņojums --}}
            @if (session('status') == 'verification-link-sent')
                <div class="alert-success">
                    Jauna verifikācijas saite ir veiksmīgi nosūtīta uz tavu e-pasta adresi.
                </div>
            @endif

            {{-- Darbību zona ar verifikācijas saites atkārtotu nosūtīšanu un izrakstīšanos --}}
            <div class="actions">

                {{-- Forma atkārtoti nosūta e-pasta verifikācijas saiti --}}
                <form method="POST" action="{{ route('verification.send') }}">

                    {{-- CSRF aizsardzība verifikācijas saites nosūtīšanas pieprasījumam --}}
                    @csrf

                    {{-- Poga atkārtoti nosūta verifikācijas e-pastu --}}
                    <button type="submit" class="btn btn-primary">
                        Nosūtīt verifikācijas e-pastu vēlreiz
                    </button>
                </form>

                {{-- Forma ļauj lietotājam izrakstīties no sistēmas --}}
                <form method="POST" action="{{ route('logout') }}">

                    {{-- CSRF aizsardzība izrakstīšanās pieprasījumam --}}
                    @csrf

                    {{-- Sekundārā poga izraksta lietotāju no sistēmas --}}
                    <button type="submit" class="btn btn-secondary">
                        Izrakstīties
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
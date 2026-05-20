{{--
    Galvenais vietnes izkārtojuma skats.

    Šis Blade fails nodrošina kopējo tīmekļa vietnes “Vecmāmiņas Receptes”
    izkārtojumu. Tas tiek izmantots lielākajā daļā sistēmas lapu un nosaka
    kopīgo HTML struktūru, galvenes datus, favicon ikonas, navigāciju,
    hero sadaļu, paziņojumu attēlošanu, galveno satura vietu un globālo
    apstiprināšanas modālo logu.

    Failā ir iekļauta gan darbvirsmas navigācija, gan mobilā izvēlne.
    Navigācijas saturs mainās atkarībā no tā, vai lietotājs ir autorizēts,
    viesis vai administrators. Autorizētiem lietotājiem tiek rādītas saites
    uz vadības paneli, receptēm, kategorijām, profilu, favorītiem un citām
    sistēmas sadaļām.

    Skatā iekļautais CSS nosaka lapas fonu, navigāciju, hero sadaļu, pogas,
    kartītes, formas elementus, statistikas blokus, paziņojumus, tukša stāvokļa
    attēlojumu, mobilo izvēlni un apstiprināšanas modālo logu.

    Faila beigās iekļautais JavaScript nodrošina mobilās izvēlnes atvēršanu
    un aizvēršanu, kā arī pielāgotu apstiprināšanas logu dzēšanas, statusa
    maiņas un citām svarīgām darbībām.
--}}

<!DOCTYPE html>
<html lang="lv">
<head>
    {{-- Norāda dokumenta rakstzīmju kodējumu --}}
    <meta charset="UTF-8">

    {{-- Nodrošina korektu lapas mērogošanu mobilajās ierīcēs --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Norāda lapas nosaukumu; ja konkrētā lapa to nenorāda, tiek izmantota noklusējuma vērtība --}}
    <title>@yield('title', 'Vecmāmiņas Receptes')</title>

    {{-- Norāda lapas meta aprakstu meklētājprogrammām un pārlūkam --}}
    <meta name="description" content="@yield('meta_description', 'Vecmāmiņas Receptes - garšīgas mājās gatavotas receptes, favorīti, kategorijas un iedvesma katrai dienai.')">

    {{-- Pievieno vietnes favicon ikonu --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}?v=3">

    {{-- Pievieno alternatīvu favicon norādi vecākiem pārlūkiem --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    {{-- Pievieno mobilajām ierīcēm paredzēto CSS failu --}}
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}?v=9">

    <style>
        /* Noņem noklusētās atstarpes un nodrošina vienotu elementu izmēru aprēķinu */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Definē visas vietnes galvenās krāsas, ēnas un noapaļojuma vērtības */
        :root {
            --page-bg: #eee5da;
            --page-bg-2: #e8ddd0;
            --surface: rgba(255, 253, 249, 0.94);
            --surface-strong: #fffdf9;
            --surface-soft: #f6efe7;
            --surface-soft-2: #efe4d6;
            --line: #ddcfc0;
            --line-strong: #d4c2ae;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-dark: #634733;
            --accent-soft: #ebe0d2;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --danger-border: #e3c9c2;
            --success-bg: #e8eee2;
            --success-text: #667652;
            --success-border: #d7dfcc;
            --warning-bg: #f6eddc;
            --warning-text: #8a6a2f;
            --warning-border: #e3d3ae;
            --info-bg: #e7eff6;
            --info-text: #4d667d;
            --info-border: #c9d9e8;
            --shadow-sm: 0 10px 24px rgba(79, 59, 42, 0.05);
            --shadow: 0 18px 44px rgba(79, 59, 42, 0.07);
            --shadow-lg: 0 26px 60px rgba(79, 59, 42, 0.10);
            --radius-sm: 12px;
            --radius-md: 18px;
            --radius-lg: 26px;
        }

        /* Nodrošina pilnu lapas augstumu */
        html,
        body {
            min-height: 100%;
        }

        /* Noformē lapas pamata fontu, teksta krāsu un fonu */
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.46) 0%, rgba(255,255,255,0) 34%),
                radial-gradient(circle at top right, rgba(255,255,255,0.24) 0%, rgba(255,255,255,0) 28%),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
        }

        /* Bloķē lapas ritināšanu, kad ir atvērta mobilā izvēlne vai modālais logs */
        body.menu-open,
        body.confirm-modal-open {
            overflow: hidden;
        }

        /* Galvenais vietnes ārējais apvalks */
        .site-shell {
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Pievieno dekoratīvus fona elementus */
        .site-shell::before,
        .site-shell::after {
            content: "";
            position: fixed;
            z-index: 0;
            pointer-events: none;
            border-radius: 50%;
            filter: blur(18px);
            opacity: 0.45;
        }

        /* Kreisais dekoratīvais fona aplis */
        .site-shell::before {
            width: 280px;
            height: 280px;
            top: -80px;
            left: -80px;
            background: rgba(255, 248, 238, 0.7);
        }

        /* Labais dekoratīvais fona aplis */
        .site-shell::after {
            width: 340px;
            height: 340px;
            right: -110px;
            bottom: 40px;
            background: rgba(239, 228, 214, 0.65);
        }

        /* Ierobežo lapas satura platumu */
        .page {
            position: relative;
            z-index: 1;
            max-width: 1450px;
            margin: 0 auto;
            padding: 26px 20px 54px;
        }

        /* Noformē lapas hero sadaļu */
        .hero {
            position: relative;
            padding: 34px 24px 36px;
            margin-bottom: 22px;
            text-align: center;
            background: linear-gradient(180deg, rgba(255,253,249,0.72) 0%, rgba(255,250,244,0.52) 100%);
            border: 1px solid rgba(221, 207, 192, 0.85);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        /* Pievieno dekoratīvu fonu hero sadaļai */
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 20%, rgba(255,255,255,0.55) 0%, rgba(255,255,255,0) 22%),
                radial-gradient(circle at 85% 10%, rgba(239,228,214,0.55) 0%, rgba(239,228,214,0) 18%);
            pointer-events: none;
        }

        /* Nodrošina, ka hero saturs atrodas virs dekoratīvā fona */
        .hero > * {
            position: relative;
            z-index: 1;
        }

        /* Noformē hero virsrakstu */
        .hero-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 4rem;
            line-height: 1.06;
            color: var(--accent);
            font-weight: 500;
            margin-bottom: 12px;
            letter-spacing: 0.01em;
        }

        /* Noformē hero paskaidrojuma tekstu */
        .hero-text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
            max-width: 860px;
            margin: 0 auto;
        }

        /* Noformē galveno navigācijas joslu */
        .nav-bar {
            position: sticky;
            top: 14px;
            z-index: 40;
            background: rgba(255, 253, 249, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 194, 174, 0.75);
            border-radius: 22px;
            padding: 16px 20px;
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        /* Noformē vietnes nosaukumu navigācijā */
        .nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
            white-space: nowrap;
            transition: 0.2s ease;
        }

        /* Pievieno ikonu pirms vietnes nosaukuma */
        .nav-brand::before {
            content: "📖";
            font-size: 1.2rem;
            line-height: 1;
        }

        /* Pievieno hover efektu vietnes nosaukumam */
        .nav-brand:hover {
            color: var(--accent-dark);
            transform: translateY(-1px);
        }

        /* Centrē galvenās navigācijas saites */
        .nav-center {
            min-width: 0;
            display: flex;
            justify-content: center;
        }

        /* Sakārto navigācijas saites horizontāli */
        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-wrap: nowrap;
            min-width: 0;
        }

        /* Noformē navigācijas saites */
        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 13px;
            border: 1px solid transparent;
            border-radius: 999px;
            transition: 0.2s ease;
            font-weight: 700;
            font-size: 13.5px;
            white-space: nowrap;
            line-height: 1.2;
        }

        /* Pievieno hover efektu navigācijas saitēm */
        .nav-links a:hover {
            background: var(--surface-soft);
            border-color: var(--line);
            color: var(--accent);
            transform: translateY(-1px);
        }

        /* Izceļ aktīvo navigācijas saiti */
        .nav-links a.active {
            color: var(--accent);
            background: linear-gradient(180deg, #f8f1e9 0%, #f0e5d8 100%);
            border-color: var(--line-strong);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.45);
        }

        /* Sakārto navigācijas labo pusi ar lietotāja informāciju un pogām */
        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            white-space: nowrap;
        }

        /* Noformē autorizētā lietotāja informācijas bloku */
        .nav-user-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            max-width: 220px;
            padding: 8px 12px;
            background: var(--surface-soft);
            border: 1px solid var(--line);
            border-radius: 999px;
        }

        /* Noformē lietotāja iniciāļa apli */
        .nav-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(180deg, #f6efe7 0%, #ecdfd0 100%);
            border: 1px solid var(--line);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-dark);
            font-weight: 800;
            font-size: 14px;
            flex: 0 0 auto;
        }

        /* Noformē lietotāja vārdu navigācijā */
        .nav-user-name {
            color: var(--muted);
            font-size: 13.5px;
            font-weight: 700;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Noformē mobilās izvēlnes atvēršanas pogu */
        .nav-toggle {
            display: none;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, #fffdfa 0%, #f6efe7 100%);
            color: var(--accent-dark);
            border-radius: 14px;
            width: 48px;
            height: 48px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(79, 59, 42, 0.05);
            transition: 0.2s ease;
            font-size: 20px;
            font-weight: 700;
            font-family: inherit;
        }

        /* Pievieno hover efektu mobilās izvēlnes pogai */
        .nav-toggle:hover {
            transform: translateY(-1px);
            background: var(--surface-soft-2);
        }

        /* Izveido burgera ikonas vidējo līniju */
        .nav-toggle-icon {
            position: relative;
            display: block;
            width: 18px;
            height: 2px;
            border-radius: 999px;
            background: currentColor;
            transition: 0.25s ease;
        }

        /* Izveido burgera ikonas augšējo un apakšējo līniju */
        .nav-toggle-icon::before,
        .nav-toggle-icon::after {
            content: "";
            position: absolute;
            left: 0;
            width: 18px;
            height: 2px;
            border-radius: 999px;
            background: currentColor;
            transition: 0.25s ease;
        }

        .nav-toggle-icon::before {
            top: -6px;
        }

        .nav-toggle-icon::after {
            top: 6px;
        }

        /* Pārveido burgera ikonu par aizvēršanas ikonu, kad izvēlne ir atvērta */
        .menu-open .nav-toggle-icon {
            background: transparent;
        }

        .menu-open .nav-toggle-icon::before {
            top: 0;
            transform: rotate(45deg);
        }

        .menu-open .nav-toggle-icon::after {
            top: 0;
            transform: rotate(-45deg);
        }

        /* Mobilās izvēlnes panelis sākotnēji netiek rādīts */
        .nav-mobile-panel {
            display: none;
        }

        /* Noformē galveno satura kartīti */
        .main-content {
            background: rgba(255, 253, 249, 0.84);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(212, 194, 174, 0.85);
            border-radius: 30px;
            box-shadow: var(--shadow-lg);
            padding: 34px;
        }

        /* Pievieno atstarpi starp secīgiem satura blokiem */
        .section-block + .section-block {
            margin-top: 28px;
        }

        /* Noformē sadaļu virsrakstus */
        .section-title {
            color: var(--accent);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            font-weight: 500;
            line-height: 1.2;
        }

        /* Noformē sadaļu paskaidrojuma tekstu */
        .section-subtext {
            color: var(--muted);
            line-height: 1.75;
            margin-bottom: 22px;
        }

        /* Sakārto formas lauku grupu vertikāli */
        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Noformē formas lauka nosaukumu */
        .form-label {
            display: block;
            margin-bottom: 9px;
            font-weight: 700;
            color: var(--text);
            font-size: 15px;
        }

        /* Noformē teksta ievades laukus, teksta zonas un izvēlnes */
        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--line);
            border-radius: 14px;
            font-size: 15px;
            background: #fffdfa;
            color: var(--text);
            transition: 0.2s ease;
            font-family: inherit;
            box-shadow: inset 0 1px 2px rgba(79, 59, 42, 0.02);
        }

        /* Nosaka minimālo augstumu ievades laukiem un izvēlnēm */
        .form-input,
        .form-select {
            min-height: 50px;
        }

        /* Noformē daudzrindu teksta ievades lauku */
        .form-textarea {
            min-height: 140px;
            resize: vertical;
        }

        /* Noformē formas elementus fokusa stāvoklī */
        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #b79d84;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
        }

        /* Noformē paskaidrojuma tekstu zem formas laukiem */
        .help-text {
            color: var(--muted);
            margin-top: 7px;
            display: block;
            font-size: 13px;
            line-height: 1.55;
        }

        /* Sakārto formas laukus divās kolonnās */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        /* Noformē pogu pamata izskatu */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            text-align: center;
            white-space: nowrap;
            font-family: inherit;
            box-shadow: 0 6px 18px rgba(79, 59, 42, 0.04);
        }

        /* Pievieno hover efektu pogām */
        .btn:hover {
            transform: translateY(-1px);
            filter: brightness(0.99);
        }

        /* Noformē galveno pogu */
        .btn-primary {
            background: linear-gradient(180deg, #84624a 0%, #7a5a43 100%);
            border-color: var(--accent);
            color: #fffaf4;
            box-shadow: 0 10px 24px rgba(122, 90, 67, 0.22);
        }

        .btn-primary:hover {
            background: linear-gradient(180deg, #6e4f39 0%, #634733 100%);
        }

        /* Noformē veiksmīgas darbības pogu */
        .btn-success {
            background: linear-gradient(180deg, #eef3ea 0%, #e8eee2 100%);
            color: var(--success-text);
            border-color: var(--success-border);
        }

        .btn-success:hover {
            background: #dde6d3;
        }

        /* Noformē sekundāro pogu */
        .btn-secondary {
            background: linear-gradient(180deg, #faf6f0 0%, #f6efe7 100%);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: var(--surface-soft-2);
        }

        /* Noformē brīdinājuma pogu */
        .btn-warning {
            background: linear-gradient(180deg, #f8f0e2 0%, #f6eddc 100%);
            color: var(--warning-text);
            border-color: var(--warning-border);
        }

        .btn-warning:hover {
            background: #f0e3cc;
        }

        /* Noformē bīstamas darbības pogu */
        .btn-danger {
            background: linear-gradient(180deg, #f7e9e5 0%, #f3e2de 100%);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .btn-danger:hover {
            background: #eed6d1;
        }

        /* Noformē kopīgo kartīšu izskatu */
        .card {
            position: relative;
            background: var(--surface-strong);
            border: 1px solid rgba(221, 207, 192, 0.95);
            border-radius: 22px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        /* Pievieno kartītes augšējo dekoratīvo līniju */
        .card::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0.6), rgba(255,255,255,0));
            pointer-events: none;
        }

        /* Noformē kartītes virsrakstu */
        .card-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            margin-bottom: 18px;
            text-align: center;
            font-weight: 500;
        }

        /* Palīgklase teksta centrēšanai */
        .text-center {
            text-align: center;
        }

        /* Pamata režģa klase */
        .grid {
            display: grid;
            gap: 20px;
        }

        /* Divu kolonnu režģis */
        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        /* Trīs kolonnu režģis */
        .grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        /* Sakārto statistikas blokus četrās kolonnās */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-top: 18px;
        }

        /* Noformē vienu statistikas bloku */
        .stat-box {
            background: linear-gradient(180deg, #f9f2ea 0%, #efe2d2 100%);
            color: var(--text);
            padding: 24px 16px;
            text-align: center;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(90, 69, 52, 0.05);
            transition: 0.2s ease;
        }

        .stat-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(90, 69, 52, 0.08);
        }

        /* Noformē statistikas skaitlisko vērtību */
        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.4rem;
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
            color: var(--accent-dark);
            line-height: 1;
        }

        /* Noformē statistikas nosaukumu */
        .stat-label {
            font-size: 0.95rem;
            color: var(--muted);
        }

        /* Noformē saraksta rindu */
        .list-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--line);
        }

        .list-row:last-child {
            border-bottom: 0;
        }

        /* Noformē avatarus un emoji ikonu blokus */
        .avatar,
        .emoji-box {
            height: 48px;
            width: 48px;
            background: linear-gradient(180deg, #f6efe7 0%, #ecdfd0 100%);
            border: 1px solid var(--line);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--accent-dark);
            flex: 0 0 auto;
            box-shadow: 0 6px 16px rgba(79, 59, 42, 0.05);
        }

        /* Avataram izmanto apaļu formu */
        .avatar {
            border-radius: 50%;
        }

        /* Palīgklase sekundāram tekstam */
        .muted {
            color: var(--muted);
            font-size: 14px;
        }

        /* Palīgklase teksta nepārlaušanai jaunā rindā */
        .nowrap {
            white-space: nowrap;
        }

        /* Noformē hero sadaļas ikonu */
        .hero-icon {
            font-size: 3.7rem;
            margin-bottom: 12px;
        }

        /* Noformē sadaļas apakšvirsrakstu */
        .section-subtitle {
            color: var(--muted);
            line-height: 1.7;
            max-width: 720px;
            margin: 0 auto;
        }

        /* Noformē paneļu virsrakstus */
        .panel-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent-dark);
            margin-bottom: 10px;
            font-size: 2.3rem;
            font-weight: 500;
        }

        /* Sakārto rindas kreisās puses saturu */
        .row-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Noformē vienuma virsrakstu */
        .item-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        /* Nosaka atstarpi zem paziņojumu bloka */
        .flash-messages {
            margin-bottom: 24px;
        }

        /* Noformē kopīgo paziņojuma stilu */
        .flash-message {
            padding: 15px 18px;
            border: 1px solid;
            border-radius: 16px;
            margin-bottom: 12px;
            font-size: 14px;
            line-height: 1.6;
            font-weight: 600;
            box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
        }

        /* Noformē veiksmīgas darbības paziņojumu */
        .flash-message.success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: var(--success-border);
        }

        /* Noformē kļūdas paziņojumu */
        .flash-message.error {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        /* Noformē brīdinājuma paziņojumu */
        .flash-message.warning {
            background: var(--warning-bg);
            color: var(--warning-text);
            border-color: var(--warning-border);
        }

        /* Noformē informatīvu paziņojumu */
        .flash-message.info {
            background: var(--info-bg);
            color: var(--info-text);
            border-color: var(--info-border);
        }

        /* Noformē paziņojumos izmantotos sarakstus */
        .flash-message ul {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .flash-message li {
            margin-bottom: 4px;
        }

        /* Noformē tukša satura stāvokļa bloku */
        .empty-state {
            text-align: center;
            padding: 34px 20px;
            background: linear-gradient(180deg, #f9f3eb 0%, #f4eadf 100%);
            border: 1px dashed var(--line-strong);
            border-radius: 22px;
        }

        /* Noformē tukša stāvokļa virsrakstu */
        .empty-state-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 1.7rem;
            margin-bottom: 10px;
        }

        /* Noformē tukša stāvokļa paskaidrojuma tekstu */
        .empty-state-text {
            color: var(--muted);
            line-height: 1.7;
            max-width: 620px;
            margin: 0 auto;
        }

        /* Noformē apstiprināšanas modālā loga fonu */
        .confirm-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 100000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(47, 36, 29, 0.44);
            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);
        }

        /* Parāda modālo logu, kad tam piešķirta atvēršanas klase */
        .confirm-modal-backdrop.is-open {
            display: flex;
        }

        /* Noformē apstiprināšanas modālo logu */
        .confirm-modal {
            width: min(100%, 520px);
            position: relative;
            background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
            border: 1px solid rgba(122, 90, 67, 0.18);
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 30px 80px rgba(47, 36, 29, 0.26);
            overflow: hidden;
            animation: confirmModalIn 0.18s ease-out;
        }

        /* Pievieno modālajam logam dekoratīvu augšējo līniju */
        .confirm-modal::before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0.78), rgba(255,255,255,0));
            pointer-events: none;
        }

        /* Noformē modālā loga brīdinājuma ikonu */
        .confirm-modal-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: linear-gradient(180deg, #f7e9e5 0%, #f3e2de 100%);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 900;
            box-shadow: 0 10px 24px rgba(164, 95, 82, 0.12);
        }

        /* Noformē modālā loga virsrakstu */
        .confirm-modal-title {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2.05rem;
            font-weight: 500;
            line-height: 1.15;
            text-align: center;
            margin-bottom: 12px;
        }

        /* Noformē modālā loga tekstu */
        .confirm-modal-text {
            color: var(--muted);
            line-height: 1.75;
            font-size: 15px;
            text-align: center;
            margin: 0 auto 24px;
            max-width: 430px;
        }

        /* Sakārto modālā loga darbību pogas */
        .confirm-modal-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Nosaka minimālo pogas platumu modālajā logā */
        .confirm-modal-actions .btn {
            min-width: 150px;
        }

        /* Animē modālā loga parādīšanos */
        @keyframes confirmModalIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Pārslēdz navigāciju uz mobilo izkārtojumu šaurākiem ekrāniem */
        @media (max-width: 1500px) {
            .nav-bar {
                grid-template-columns: 1fr auto !important;
                align-items: center !important;
                gap: 10px !important;
                padding: 12px !important;
                border-radius: 16px !important;
                margin-bottom: 16px !important;
                top: 8px !important;
            }

            .nav-brand {
                font-size: 1.15rem !important;
                gap: 8px !important;
                min-width: 0 !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                white-space: nowrap !important;
            }

            .nav-brand::before {
                font-size: 1rem !important;
            }

            .nav-center,
            .nav-right {
                display: none !important;
            }

            .nav-toggle {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 42px !important;
                height: 42px !important;
                flex: 0 0 42px !important;
                border-radius: 12px !important;
                z-index: 60 !important;
            }

            .nav-mobile-panel {
                display: block !important;
                position: fixed !important;
                inset: 0 !important;
                z-index: 9999 !important;
                opacity: 0 !important;
                pointer-events: none !important;
                transition: opacity 0.22s ease !important;
            }

            body.menu-open .nav-mobile-panel {
                opacity: 1 !important;
                pointer-events: auto !important;
            }

            .nav-mobile-backdrop {
                position: absolute !important;
                inset: 0 !important;
                background: rgba(47, 36, 29, 0.34) !important;
                backdrop-filter: blur(4px) !important;
                -webkit-backdrop-filter: blur(4px) !important;
            }

            .nav-mobile-sheet {
                position: absolute !important;
                top: 0 !important;
                right: 0 !important;
                height: 100% !important;
                width: min(88vw, 360px) !important;
                background: rgba(255, 253, 249, 0.98) !important;
                border-left: 1px solid var(--line) !important;
                box-shadow: -10px 0 30px rgba(79, 59, 42, 0.12) !important;
                padding: 14px !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 12px !important;
                overflow-y: auto !important;
                transform: translateX(100%) !important;
                transition: transform 0.24s ease !important;
            }

            body.menu-open .nav-mobile-sheet {
                transform: translateX(0) !important;
            }

            .nav-mobile-header {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 10px !important;
                padding-bottom: 6px !important;
                border-bottom: 1px solid var(--line) !important;
            }

            .nav-mobile-title {
                font-family: Georgia, "Times New Roman", serif !important;
                font-size: 1.2rem !important;
                color: var(--accent) !important;
            }

            .nav-mobile-close {
                width: 40px !important;
                height: 40px !important;
                border-radius: 10px !important;
                border: 1px solid var(--line) !important;
                background: linear-gradient(180deg, #fffdfa 0%, #f6efe7 100%) !important;
                color: var(--accent-dark) !important;
                font-size: 24px !important;
                line-height: 1 !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
            }

            .nav-mobile-user {
                display: flex !important;
                align-items: center !important;
                gap: 10px !important;
                padding: 10px !important;
                background: var(--surface-soft) !important;
                border: 1px solid var(--line) !important;
                border-radius: 14px !important;
            }

            .nav-mobile-user-name {
                font-size: 13px !important;
                font-weight: 700 !important;
                color: var(--text) !important;
                line-height: 1.3 !important;
            }

            .nav-mobile-links {
                display: flex !important;
                flex-direction: column !important;
                gap: 6px !important;
            }

            .nav-mobile-links a {
                display: block !important;
                width: 100% !important;
                padding: 11px 12px !important;
                border-radius: 12px !important;
                text-decoration: none !important;
                color: var(--text) !important;
                font-size: 13px !important;
                font-weight: 700 !important;
                line-height: 1.25 !important;
                background: #fffdfa !important;
                border: 1px solid var(--line) !important;
            }

            .nav-mobile-links a.active {
                color: var(--accent) !important;
                background: linear-gradient(180deg, #f8f1e9 0%, #f0e5d8 100%) !important;
                border-color: var(--line-strong) !important;
            }

            .nav-mobile-actions {
                display: flex !important;
                flex-direction: column !important;
                gap: 8px !important;
                margin-top: auto !important;
                padding-top: 8px !important;
            }

            .nav-mobile-actions .btn,
            .nav-mobile-actions form,
            .nav-mobile-actions a,
            .nav-mobile-actions button {
                width: 100% !important;
            }
        }

        /* Pielāgo navigāciju un modālo logu ļoti maziem telefona ekrāniem */
        @media (max-width: 480px) {
            .nav-bar {
                padding: 10px !important;
                border-radius: 14px !important;
            }

            .nav-brand {
                font-size: 1.02rem !important;
            }

            .nav-toggle {
                width: 40px !important;
                height: 40px !important;
            }

            .nav-mobile-sheet {
                width: 100% !important;
                max-width: 100% !important;
                padding: 12px !important;
            }

            .confirm-modal {
                padding: 24px 18px;
                border-radius: 22px;
            }

            .confirm-modal-icon {
                width: 62px;
                height: 62px;
                font-size: 30px;
            }

            .confirm-modal-title {
                font-size: 1.65rem;
            }

            .confirm-modal-actions {
                flex-direction: column-reverse;
            }

            .confirm-modal-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

{{-- Body klase tiek papildināta pēc aktīvās lapas, lai vajadzības gadījumā varētu pielāgot konkrētu sadaļu stilus --}}
<body class="
    {{ request()->is('recipes') ? 'page-recipes' : '' }}
    {{ request()->is('profile') || request()->is('profile/*') ? 'page-profile' : '' }}
    {{ request()->is('admin') || request()->is('admin/*') ? 'page-admin' : '' }}
">

{{-- Galvenais vietnes apvalks --}}
<div class="site-shell">

    {{-- Galvenais lapas konteiners --}}
    <div class="page">

        {{--
            Nosaka, vai galvenā navigācija ir jāslēpj.
            Navigācija netiek rādīta ielogošanās, reģistrācijas un paroles atjaunošanas lapās.
        --}}
        @php
            $hideMainNavigation = request()->routeIs('login')
                || request()->routeIs('register')
                || request()->routeIs('password.request')
                || request()->routeIs('password.reset');
        @endphp

        {{-- Galvenā navigācija un hero sadaļa tiek rādīta tikai tad, ja tā nav jāslēpj --}}
        @unless($hideMainNavigation)

            {{-- Ja lietotājs atrodas administrācijas sadaļā, tiek rādīts administrācijas hero teksts --}}
            @if(request()->is('admin*'))
                <div class="hero">
                    <h1 class="hero-title">Administrācijas panelis</h1>
                    <p class="hero-text">Šeit vari pārvaldīt lietotājus, receptes un sistēmas saturu.</p>
                </div>
            @else

                {{-- Standarta hero sadaļa pārējām lapām --}}
                <div class="hero">
                    <h1 class="hero-title">
                        @yield('hero_title', 'Vecmāmiņas Receptes')
                    </h1>

                    <p class="hero-text">
                        @yield('hero_text', 'Garšas, kas paliek atmiņā')
                    </p>
                </div>
            @endif

            {{-- Galvenā navigācijas josla --}}
            <nav class="nav-bar">

                {{-- Vietnes nosaukums ved uz vadības paneli autorizētam lietotājam vai sākumlapu viesim --}}
                <a href="{{ Auth::check() ? url('/dashboard') : url('/') }}" class="nav-brand">Vecmāmiņas Receptes</a>

                {{-- Navigācijas centrālā daļa ar saitēm autorizētiem lietotājiem --}}
                <div class="nav-center">
                    @auth
                        <div class="nav-links">

                            {{-- Saite uz lietotāja vadības paneli --}}
                            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Vadības panelis</a>

                            {{-- Saite uz recepšu sarakstu --}}
                            <a href="{{ url('/recipes') }}" class="{{ request()->is('recipes') || request()->is('recipes/*') ? 'active' : '' }}">Receptes</a>

                            {{-- Saite uz kategoriju sarakstu --}}
                            <a href="{{ url('/categories') }}" class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">Kategorijas</a>

                            {{-- Saite uz lietotāja izveidotajām receptēm --}}
                            <a href="{{ url('/profile/recipes') }}" class="{{ request()->is('profile/recipes') ? 'active' : '' }}">Manas receptes</a>

                            {{-- Saite uz lietotāja favorītu sarakstu --}}
                            <a href="{{ url('/profile/favorites') }}" class="{{ request()->is('profile/favorites') ? 'active' : '' }}">Favorīti</a>

                            {{-- Saite uz kontaktu lapu --}}
                            <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Kontakti</a>

                            {{-- Saite uz profila rediģēšanas lapu --}}
                            <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">Profils</a>

                            {{-- Administratoram tiek parādīta papildu saite uz administrācijas paneli --}}
                            @if(Auth::user()->is_admin)
                                <a href="{{ url('/admin') }}" class="{{ request()->is('admin') || request()->is('admin/*') ? 'active' : '' }}">Administrācija</a>
                            @endif
                        </div>
                    @endauth
                </div>

                {{-- Navigācijas labā puse ar ielogošanās vai lietotāja darbībām --}}
                <div class="nav-right">

                    {{-- Viesim tiek parādītas ielogošanās un reģistrācijas pogas --}}
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-secondary">Ielogoties</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Reģistrēties</a>
                    @endguest

                    {{-- Autorizētam lietotājam tiek parādīts vārds un izrakstīšanās poga --}}
                    @auth
                        <div class="nav-user-chip">

                            {{-- Lietotāja iniciālis --}}
                            <span class="nav-user-avatar">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </span>

                            {{-- Lietotāja vārds --}}
                            <span class="nav-user-name">{{ Auth::user()->name }}</span>
                        </div>

                        {{-- Izrakstīšanās forma --}}
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Iziet</button>
                        </form>
                    @endauth
                </div>

                {{-- Mobilās izvēlnes atvēršanas poga --}}
                <button
                    type="button"
                    class="nav-toggle"
                    aria-label="Atvērt izvēlni"
                    aria-expanded="false"
                    aria-controls="mobileMenu"
                    onclick="toggleMobileMenu()"
                >
                    <span class="nav-toggle-icon"></span>
                </button>
            </nav>

            {{-- Mobilās izvēlnes panelis --}}
            <div class="nav-mobile-panel" id="mobileMenu" aria-hidden="true">

                {{-- Tumšais fons, uz kura nospiežot mobilā izvēlne tiek aizvērta --}}
                <div class="nav-mobile-backdrop" onclick="closeMobileMenu()"></div>

                {{-- Mobilās izvēlnes saturs --}}
                <div class="nav-mobile-sheet">

                    {{-- Mobilās izvēlnes galvene --}}
                    <div class="nav-mobile-header">
                        <div class="nav-mobile-title">Izvēlne</div>

                        {{-- Mobilās izvēlnes aizvēršanas poga --}}
                        <button type="button" class="nav-mobile-close" onclick="closeMobileMenu()" aria-label="Aizvērt izvēlni">
                            ×
                        </button>
                    </div>

                    {{-- Mobilās izvēlnes saturs autorizētam lietotājam --}}
                    @auth
                        <div class="nav-mobile-user">
                            <span class="nav-user-avatar">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </span>
                            <div class="nav-mobile-user-name">{{ Auth::user()->name }}</div>
                        </div>

                        {{-- Mobilās navigācijas saites --}}
                        <div class="nav-mobile-links">
                            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Vadības panelis</a>
                            <a href="{{ url('/recipes') }}" class="{{ request()->is('recipes') || request()->is('recipes/*') ? 'active' : '' }}">Receptes</a>
                            <a href="{{ url('/categories') }}" class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">Kategorijas</a>
                            <a href="{{ url('/profile/recipes') }}" class="{{ request()->is('profile/recipes') ? 'active' : '' }}">Manas receptes</a>
                            <a href="{{ url('/profile/favorites') }}" class="{{ request()->is('profile/favorites') ? 'active' : '' }}">Favorīti</a>
                            <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Kontakti</a>
                            <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">Profils</a>

                            {{-- Administratoram mobilajā izvēlnē tiek rādīta administrācijas saite --}}
                            @if(Auth::user()->is_admin)
                                <a href="{{ url('/admin') }}" class="{{ request()->is('admin') || request()->is('admin/*') ? 'active' : '' }}">Administrācija</a>
                            @endif
                        </div>

                        {{-- Mobilās izvēlnes izrakstīšanās darbība --}}
                        <div class="nav-mobile-actions">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Iziet</button>
                            </form>
                        </div>
                    @endauth

                    {{-- Mobilās izvēlnes saturs viesim --}}
                    @guest
                        <div class="nav-mobile-actions">
                            <a href="{{ route('login') }}" class="btn btn-secondary">Ielogoties</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Reģistrēties</a>
                        </div>
                    @endguest
                </div>
            </div>
        @endunless

        {{-- Galvenā satura zona, kur tiek ievietots konkrētās lapas saturs --}}
        <div class="main-content">

            {{-- Iekļauj kopīgo paziņojumu komponenti --}}
            @include('components.flash-messages')

            {{-- Šajā vietā tiek ievietots konkrētās lapas saturs --}}
            @yield('content')
        </div>
    </div>
</div>

{{-- Globālais apstiprināšanas modālais logs --}}
<div class="confirm-modal-backdrop" id="globalConfirmModal" aria-hidden="true">

    {{-- Modālā loga saturs --}}
    <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="globalConfirmTitle" aria-describedby="globalConfirmText">

        {{-- Brīdinājuma ikona --}}
        <div class="confirm-modal-icon">!</div>

        {{-- Modālā loga virsraksts --}}
        <h2 class="confirm-modal-title" id="globalConfirmTitle">
            Apstiprināt darbību
        </h2>

        {{-- Modālā loga paskaidrojuma teksts --}}
        <p class="confirm-modal-text" id="globalConfirmText">
            Vai tiešām vēlaties veikt šo darbību?
        </p>

        {{-- Modālā loga pogas --}}
        <div class="confirm-modal-actions">

            {{-- Poga aizver modālo logu bez darbības veikšanas --}}
            <button type="button" class="btn btn-secondary" id="globalConfirmCancel">
                Atcelt
            </button>

            {{-- Poga apstiprina darbību --}}
            <button type="button" class="btn btn-danger" id="globalConfirmSubmit">
                Apstiprināt
            </button>
        </div>
    </div>
</div>

<script>
    /* Atver vai aizver mobilo izvēlni */
    function toggleMobileMenu() {
        const body = document.body;
        const menu = document.getElementById('mobileMenu');
        const toggle = document.querySelector('.nav-toggle');

        body.classList.toggle('menu-open');

        const isOpen = body.classList.contains('menu-open');

        if (toggle) {
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        if (menu) {
            menu.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        }
    }

    /* Aizver mobilo izvēlni un atjauno pieejamības atribūtus */
    function closeMobileMenu() {
        const body = document.body;
        const menu = document.getElementById('mobileMenu');
        const toggle = document.querySelector('.nav-toggle');

        body.classList.remove('menu-open');

        if (toggle) {
            toggle.setAttribute('aria-expanded', 'false');
        }

        if (menu) {
            menu.setAttribute('aria-hidden', 'true');
        }
    }

    /* Aizver mobilo izvēlni, ja ekrāns tiek palielināts */
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            closeMobileMenu();
        }
    });

    /* Aizver mobilo izvēlni, ja lietotājs nospiež uz saites vai ārpus izvēlnes */
    document.addEventListener('click', function (event) {
        if (window.innerWidth > 768) {
            return;
        }

        const mobileMenu = document.getElementById('mobileMenu');
        const navToggle = document.querySelector('.nav-toggle');
        const clickedLink = event.target.closest('.nav-mobile-links a');

        if (clickedLink && mobileMenu) {
            closeMobileMenu();
        }

        if (
            document.body.classList.contains('menu-open') &&
            mobileMenu &&
            !event.target.closest('.nav-mobile-sheet') &&
            navToggle &&
            !event.target.closest('.nav-toggle')
        ) {
            closeMobileMenu();
        }
    });

    /* Saglabā darbību, kas jāizpilda pēc apstiprināšanas */
    let globalConfirmCallback = null;

    /* Nosaka modālā loga virsrakstu pēc apstiprinājuma teksta */
    function getConfirmTitle(message) {
        const text = String(message || '').toLowerCase();

        if (text.includes('status')) {
            return 'Mainīt lietotāja statusu';
        }

        if (text.includes('vērtēj')) {
            return 'Dzēst vērtējumu';
        }

        if (text.includes('favorīt')) {
            return 'Noņemt no favorītiem';
        }

        if (text.includes('lietotāj')) {
            return 'Dzēst lietotāju';
        }

        if (text.includes('recept')) {
            return 'Dzēst recepti';
        }

        if (text.includes('koment')) {
            return 'Dzēst komentāru';
        }

        return 'Apstiprināt darbību';
    }

    /* Nosaka apstiprināšanas pogas tekstu pēc darbības veida */
    function getConfirmButtonText(message) {
        const text = String(message || '').toLowerCase();

        if (text.includes('status')) {
            return 'Mainīt statusu';
        }

        if (text.includes('favorīt') || text.includes('noņemt')) {
            return 'Noņemt';
        }

        if (text.includes('dzēst')) {
            if (text.includes('lietotāj')) {
                return 'Dzēst lietotāju';
            }

            if (text.includes('recept')) {
                return 'Dzēst recepti';
            }

            if (text.includes('vērtēj')) {
                return 'Dzēst vērtējumu';
            }

            if (text.includes('koment')) {
                return 'Dzēst komentāru';
            }

            return 'Dzēst';
        }

        return 'Apstiprināt';
    }

    /* Atver globālo apstiprināšanas modālo logu */
    function openGlobalConfirmModal(message, callback) {
        const modal = document.getElementById('globalConfirmModal');
        const title = document.getElementById('globalConfirmTitle');
        const text = document.getElementById('globalConfirmText');
        const submit = document.getElementById('globalConfirmSubmit');

        if (!modal || !title || !text || !submit) {
            if (typeof callback === 'function') {
                callback();
            }

            return;
        }

        globalConfirmCallback = callback;

        title.textContent = getConfirmTitle(message);
        text.textContent = message || 'Vai tiešām vēlaties veikt šo darbību?';
        submit.textContent = getConfirmButtonText(message);

        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('confirm-modal-open');

        setTimeout(function () {
            submit.focus();
        }, 50);
    }

    /* Aizver globālo apstiprināšanas modālo logu */
    function closeGlobalConfirmModal() {
        const modal = document.getElementById('globalConfirmModal');

        if (!modal) {
            return;
        }

        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('confirm-modal-open');
        globalConfirmCallback = null;
    }

    /* Escape taustiņš aizver gan mobilo izvēlni, gan apstiprināšanas logu */
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMobileMenu();
            closeGlobalConfirmModal();
        }
    });

    /* Pārtver standarta confirm() izmantošanu onclick atribūtos un aizstāj to ar pielāgotu modālo logu */
    document.addEventListener('click', function (event) {
        const confirmTrigger = event.target.closest('[onclick*="confirm"]');

        if (!confirmTrigger) {
            return;
        }

        const onclickValue = confirmTrigger.getAttribute('onclick') || '';
        const confirmMatch = onclickValue.match(/confirm\((['"`])([\s\S]*?)\1\)/);

        if (!confirmMatch) {
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        const message = confirmMatch[2];

        openGlobalConfirmModal(message, function () {
            const form = confirmTrigger.closest('form');

            if (form) {
                form.submit();
                return;
            }

            if (confirmTrigger.tagName === 'A' && confirmTrigger.href) {
                window.location.href = confirmTrigger.href;
            }
        });
    }, true);

    /* Pārtver formas, kurām pievienots data-confirm-delete atribūts */
    document.addEventListener('submit', function (event) {
        const form = event.target;

        if (!form || form.dataset.confirmHandled === 'true') {
            return;
        }

        if (form.hasAttribute('data-confirm-delete')) {
            event.preventDefault();

            const message = form.dataset.confirmMessage || 'Vai tiešām vēlaties veikt šo darbību?';

            openGlobalConfirmModal(message, function () {
                form.dataset.confirmHandled = 'true';
                form.submit();
            });
        }
    }, true);

    /* Atcelšanas poga aizver apstiprināšanas logu */
    document.getElementById('globalConfirmCancel')?.addEventListener('click', function () {
        closeGlobalConfirmModal();
    });

    /* Apstiprināšanas poga aizver logu un izpilda saglabāto darbību */
    document.getElementById('globalConfirmSubmit')?.addEventListener('click', function () {
        const callback = globalConfirmCallback;

        closeGlobalConfirmModal();

        if (typeof callback === 'function') {
            callback();
        }
    });

    /* Klikšķis uz modālā loga fona aizver apstiprināšanas logu */
    document.getElementById('globalConfirmModal')?.addEventListener('click', function (event) {
        if (event.target === this) {
            closeGlobalConfirmModal();
        }
    });
</script>
</body>
</html>
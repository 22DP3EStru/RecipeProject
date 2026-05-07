{{-- 
    Recepšu pārvaldības administrācijas skats.

    Šis Blade fails ir paredzēts administratora recepšu pārvaldības lapai.
    Failā tiek izvadīts kopējais recepšu pārskats, statistikas kartītes,
    visu recepšu saraksts, katras receptes pamatinformācija un darbību pogas.

    Skats izmanto datus, kas tiek padoti no kontroliera:
    $recipesCount, $categoriesCount, $newRecipesThisWeekCount, $activeAuthorsCount un $recipes.
    Šie dati tiek izmantoti, lai administrators varētu ātri pārskatīt sistēmas saturu,
    rediģēt receptes, dzēst neatbilstošus ierakstus un pāriet uz citām administrācijas sadaļām.

    Failā ir iekļauts arī CSS noformējums, kas nosaka administrācijas lapas izkārtojumu,
    recepšu kartīšu dizainu, statistikas blokus, lapošanu un mobilo ierīču pielāgojumus.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu --}}
@section('title', 'Recepšu pārvaldība')

{{-- Norāda hero sadaļas virsrakstu --}}
@section('hero_title', 'Recepšu pārvaldība')

{{-- Norāda hero sadaļas paskaidrojuma tekstu --}}
@section('hero_text', 'Pārskati, rediģē un uzturi visas platformas receptes vienuviet.')

@section('content')
    <style>
        /* Nosaka galveno teksta krāsu recepšu pārvaldības lapai */
        .admin-recipes-page {
            color: var(--text);
        }

        /* Sakārto visas lapas sadaļas vertikāli ar atstarpēm */
        .admin-recipes-stack {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Noformē navigācijas ceļu virs lapas satura */
        .admin-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 16px 18px;
            background: linear-gradient(180deg, #faf4ed 0%, #f5ece2 100%);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 18px;
            color: var(--muted);
            font-size: 14px;
            box-shadow: 0 10px 24px rgba(79, 59, 42, 0.04);
        }

        /* Noformē navigācijas ceļa saites */
        .admin-breadcrumb a {
            text-decoration: none;
            color: var(--accent);
            font-weight: 700;
        }

        /* Izceļ pašreizējo lapu navigācijas ceļā */
        .admin-breadcrumb-current {
            color: var(--text);
            font-weight: 800;
        }

        /* Noformē galvenās administrācijas sadaļu kartītes */
        .admin-section-card {
            background: rgba(255, 253, 249, 0.96);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        }

        /* Sakārto sadaļas virsrakstu un darbību pogas vienā rindā */
        .admin-section-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        /* Ierobežo virsraksta un apraksta bloka platumu */
        .admin-section-title-wrap {
            max-width: 760px;
        }

        /* Noformē mazo sadaļas apzīmējumu virs virsraksta */
        .admin-section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            padding: 7px 12px;
            border-radius: 999px;
            background: #f5ece2;
            border: 1px solid rgba(122, 90, 67, 0.12);
            color: var(--accent);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        /* Noformē sadaļas galveno virsrakstu */
        .admin-section-title {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.2rem;
            line-height: 1.15;
            font-weight: 500;
            color: var(--accent);
        }

        /* Noformē sadaļas paskaidrojuma tekstu */
        .admin-section-text {
            margin-top: 10px;
            color: var(--muted);
            line-height: 1.75;
            font-size: 15px;
        }

        /* Sakārto pogas lapas augšējā sadaļā */
        .admin-header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Izvieto statistikas kartītes četrās kolonnās */
        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        /* Noformē vienu statistikas kartīti */
        .admin-stat-card {
            background: linear-gradient(180deg, #f9f2ea 0%, #efe3d5 100%);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 20px;
            padding: 22px 18px;
            text-align: center;
            transition: 0.2s ease;
            box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
        }

        /* Pievieno kustības efektu, kad kursors ir virs statistikas kartītes */
        .admin-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(79, 59, 42, 0.08);
        }

        /* Zaļš statistikas kartītes variants */
        .admin-stat-card.soft-green {
            background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
        }

        /* Zils statistikas kartītes variants */
        .admin-stat-card.soft-blue {
            background: linear-gradient(180deg, #edf4fa 0%, #e5eef7 100%);
        }

        /* Rozā statistikas kartītes variants */
        .admin-stat-card.soft-pink {
            background: linear-gradient(180deg, #faf0f3 0%, #f5e7ec 100%);
        }

        /* Noformē lielo statistikas skaitli */
        .admin-stat-number {
            display: block;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.5rem;
            line-height: 1;
            color: var(--accent-dark);
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* Noformē statistikas nosaukumu */
        .admin-stat-label {
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        /* Izvieto recepšu kartītes divās kolonnās */
        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        /* Noformē vienas receptes kartīti */
        .recipe-card {
            background: #fffdf9;
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
            transition: 0.2s ease;
        }

        /* Pievieno kustības efektu receptes kartītei */
        .recipe-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
        }

        /* Noformē receptes kartītes augšējo daļu */
        .recipe-card-header {
            padding: 24px 24px 18px;
            background: linear-gradient(180deg, #fcf8f3 0%, #f8f0e7 100%);
            border-bottom: 1px solid rgba(221, 207, 192, 0.9);
        }

        /* Sakārto receptes datumu un kategoriju vienā rindā */
        .recipe-topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

        /* Noformē receptes izveides laika birku */
        .recipe-created {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255, 253, 249, 0.88);
            border: 1px solid rgba(122, 90, 67, 0.12);
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        /* Noformē receptes nosaukumu */
        .recipe-title {
            margin: 0 0 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            line-height: 1.15;
            color: var(--accent);
            font-weight: 500;
        }

        /* Noformē receptes apraksta tekstu */
        .recipe-description {
            color: var(--muted);
            line-height: 1.75;
            font-size: 14px;
            margin: 0;
        }

        /* Noformē receptes kartītes apakšējo daļu */
        .recipe-card-body {
            padding: 22px 24px 24px;
        }

        /* Sakārto receptes pamatdatu rindas */
        .recipe-meta-grid {
            display: grid;
            gap: 10px;
            margin-bottom: 18px;
        }

        /* Izveido vienu receptes pamatdatu rindu */
        .recipe-meta-row {
            display: grid;
            grid-template-columns: 130px 1fr;
            gap: 12px;
            align-items: center;
            padding: 12px 14px;
            background: #f8f2ea;
            border: 1px solid rgba(122, 90, 67, 0.10);
            border-radius: 14px;
        }

        /* Noformē pamatdatu nosaukumu */
        .recipe-meta-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        /* Noformē pamatdatu vērtību */
        .recipe-meta-value {
            text-align: right;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        /* Sakārto kategorijas un grūtības birkas */
        .recipe-meta-badges {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Noformē receptes birku */
        .recipe-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 11px;
            border-radius: 999px;
            border: 1px solid rgba(122, 90, 67, 0.12);
            background: #f4e9dc;
            color: var(--accent);
            font-size: 12px;
            font-weight: 800;
        }

        /* Atsevišķi noformē grūtības birku */
        .recipe-badge.difficulty {
            background: #f4e4e1;
            color: #9a5e57;
        }

        /* Izvieto īsos receptes rādītājus trīs kolonnās */
        .recipe-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        /* Noformē vienu receptes rādītāja bloku */
        .recipe-stat-pill {
            padding: 12px 14px;
            border-radius: 16px;
            background: linear-gradient(180deg, #fbf6ef 0%, #f5ecdf 100%);
            border: 1px solid rgba(122, 90, 67, 0.10);
            text-align: center;
        }

        /* Noformē rādītāja nosaukumu */
        .recipe-stat-label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        /* Noformē rādītāja vērtību */
        .recipe-stat-value {
            display: block;
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        /* Sakārto receptes darbību pogas */
        .recipe-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 4px;
        }

        /* Pielāgo pogu platumu darbību rindā */
        .recipe-actions .btn {
            flex: 1 1 140px;
        }

        /* Noformē lapošanas sadaļu */
        .pagination-wrap {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(221, 207, 192, 0.9);
            text-align: center;
        }

        /* Noformē tekstu par pašreiz redzamajiem ierakstiem */
        .pagination-summary {
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Centrē lapošanas pogas */
        .pagination-wrap nav {
            display: flex;
            justify-content: center;
        }

        /* Paslēpj Laravel lapošanas noklusēto mazo tekstu */
        .pagination-wrap nav > div:first-child {
            display: none;
        }

        /* Nosaka lapošanas ikonu izmēru */
        .pagination-wrap svg {
            width: 18px;
            height: 18px;
        }

        /* Sakārto lapošanas pogas */
        .pagination-wrap .relative.z-0.inline-flex.shadow-sm.rounded-md,
        .pagination-wrap .inline-flex.-space-x-px.rounded-md.shadow-sm {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            box-shadow: none !important;
        }

        /* Noformē lapošanas pogas */
        .pagination-wrap .relative.inline-flex.items-center,
        .pagination-wrap .inline-flex.items-center {
            padding: 10px 14px;
            text-decoration: none;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #fff;
            color: var(--text);
            font-weight: 700;
            transition: 0.2s ease;
            min-width: 44px;
            justify-content: center;
        }

        /* Pievieno lapošanas pogu hover efektu */
        .pagination-wrap a.relative.inline-flex.items-center:hover,
        .pagination-wrap a.inline-flex.items-center:hover {
            background: var(--surface-soft);
            color: var(--accent);
            transform: translateY(-1px);
        }

        /* Noformē aktīvo lapošanas pogu */
        .pagination-wrap span[aria-current="page"] > span,
        .pagination-wrap .text-white {
            background: var(--accent) !important;
            border-color: var(--accent) !important;
            color: #fffaf4 !important;
        }

        /* Noformē neaktīvās lapošanas pogas */
        .pagination-wrap .text-gray-500,
        .pagination-wrap .text-gray-400 {
            color: var(--muted) !important;
        }

        /* Noformē tukša saraksta paziņojumu */
        .admin-empty-state {
            text-align: center;
            padding: 54px 24px;
            background: linear-gradient(180deg, #fbf5ee 0%, #f4eadf 100%);
            border: 1px dashed rgba(122, 90, 67, 0.24);
            border-radius: 24px;
        }

        /* Noformē tukša saraksta ikonu */
        .admin-empty-icon {
            font-size: 4rem;
            margin-bottom: 14px;
        }

        /* Noformē tukša saraksta virsrakstu */
        .admin-empty-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 10px;
            font-weight: 500;
        }

        /* Noformē tukša saraksta paskaidrojumu */
        .admin-empty-text {
            color: var(--muted);
            line-height: 1.75;
            max-width: 620px;
            margin: 0 auto;
        }

        /* Izvieto ātrās darbības četrās kolonnās */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        /* Noformē vienu ātrās darbības kartīti */
        .quick-action-card {
            display: block;
            text-decoration: none;
            padding: 18px;
            border-radius: 18px;
            background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
            border: 1px solid rgba(122, 90, 67, 0.14);
            color: var(--text);
            transition: 0.2s ease;
            box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
        }

        /* Pievieno ātrās darbības kartītes hover efektu */
        .quick-action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
        }

        /* Noformē ātrās darbības ikonu */
        .quick-action-icon {
            font-size: 24px;
            display: block;
            margin-bottom: 10px;
        }

        /* Noformē ātrās darbības virsrakstu */
        .quick-action-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 6px;
        }

        /* Noformē ātrās darbības paskaidrojumu */
        .quick-action-text {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Pielāgo lapu planšetēm un telefoniem */
        @media (max-width: 768px) {
            .admin-recipes-stack {
                gap: 16px;
            }

            .admin-breadcrumb {
                padding: 12px 14px;
                border-radius: 14px;
                font-size: 13px;
            }

            .admin-section-card {
                padding: 14px;
                border-radius: 18px;
            }

            .admin-section-head {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
                margin-bottom: 16px;
            }

            .admin-section-title-wrap {
                max-width: 100%;
            }

            .admin-section-kicker {
                font-size: 11px;
                padding: 6px 10px;
                margin-bottom: 8px;
            }

            .admin-section-title {
                font-size: 1.45rem;
                line-height: 1.12;
            }

            .admin-section-text {
                margin-top: 8px;
                font-size: 13px;
                line-height: 1.55;
            }

            .admin-header-actions {
                flex-direction: column;
                gap: 8px;
            }

            .admin-header-actions .btn {
                width: 100%;
            }

            .admin-stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .admin-stat-card {
                padding: 12px 8px;
                border-radius: 14px;
            }

            .admin-stat-number {
                font-size: 1.75rem;
                margin-bottom: 6px;
            }

            .admin-stat-label {
                font-size: 12px;
                line-height: 1.35;
            }

            .recipes-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .recipe-card {
                border-radius: 18px;
            }

            .recipe-card-header {
                padding: 14px 14px 12px;
            }

            .recipe-topline {
                gap: 8px;
                margin-bottom: 10px;
            }

            .recipe-created,
            .recipe-badge {
                font-size: 11px;
                padding: 5px 8px;
            }

            .recipe-title {
                font-size: 1.45rem;
                margin-bottom: 8px;
            }

            .recipe-description {
                font-size: 13px;
                line-height: 1.55;
            }

            .recipe-card-body {
                padding: 14px;
            }

            .recipe-meta-grid {
                gap: 8px;
                margin-bottom: 14px;
            }

            .recipe-meta-row {
                grid-template-columns: 1fr;
                gap: 6px;
                padding: 10px 12px;
                border-radius: 12px;
            }

            .recipe-meta-label {
                font-size: 12px;
            }

            .recipe-meta-value {
                text-align: left;
                font-size: 13px;
            }

            .recipe-meta-badges {
                justify-content: flex-start;
            }

            .recipe-stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 8px;
                margin-bottom: 14px;
            }

            .recipe-stat-pill {
                padding: 10px 6px;
                border-radius: 12px;
            }

            .recipe-stat-label {
                font-size: 10px;
                margin-bottom: 4px;
            }

            .recipe-stat-value {
                font-size: 12px;
                line-height: 1.35;
            }

            .recipe-actions {
                flex-direction: column;
                gap: 8px;
            }

            .recipe-actions .btn,
            .recipe-actions form {
                width: 100%;
                flex: none;
            }

            .pagination-wrap {
                margin-top: 18px;
                padding-top: 16px;
            }

            .pagination-summary {
                font-size: 12px;
                margin-bottom: 12px;
            }

            .admin-empty-state {
                padding: 28px 16px;
                border-radius: 18px;
            }

            .admin-empty-icon {
                font-size: 2.8rem;
                margin-bottom: 10px;
            }

            .admin-empty-title {
                font-size: 1.45rem;
                margin-bottom: 8px;
            }

            .admin-empty-text {
                font-size: 13px;
                line-height: 1.55;
            }

            .quick-actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .quick-action-card {
                padding: 12px;
                border-radius: 14px;
            }

            .quick-action-icon {
                font-size: 20px;
                margin-bottom: 8px;
            }

            .quick-action-title {
                font-size: 14px;
                margin-bottom: 4px;
            }

            .quick-action-text {
                font-size: 12px;
                line-height: 1.45;
            }
        }

        /* Pielāgo lapu ļoti maziem telefona ekrāniem */
        @media (max-width: 480px) {
            .admin-section-card {
                padding: 12px;
                border-radius: 16px;
            }

            .admin-section-title {
                font-size: 1.3rem;
            }

            .admin-stats-grid {
                gap: 6px;
            }

            .admin-stat-card {
                padding: 10px 6px;
            }

            .admin-stat-number {
                font-size: 1.45rem;
            }

            .admin-stat-label {
                font-size: 11px;
            }

            .recipe-title {
                font-size: 1.28rem;
            }

            .recipe-stats {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .recipe-stat-pill {
                padding: 9px 10px;
            }

            .quick-actions-grid {
                grid-template-columns: 1fr;
            }

            .quick-action-card {
                padding: 11px;
            }
        }
    </style>

    {{-- Galvenais lapas satura konteiners --}}
    <div class="admin-recipes-page">
        <div class="admin-recipes-stack">

            {{-- Navigācijas ceļš uzrāda, kurā administrācijas sadaļā lietotājs atrodas --}}
            <div class="admin-breadcrumb">
                <a href="{{ route('admin.index') }}">Admin panelis</a>
                <span>/</span>
                <span class="admin-breadcrumb-current">Recepšu pārvaldība</span>
            </div>

            {{-- Lapas kopsavilkuma sadaļa ar aprakstu un statistiku --}}
            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Administrācija · Receptes</div>

                        {{-- Izvada recepšu pārvaldības sadaļas virsrakstu --}}
                        <h2 class="admin-section-title">Pārskats par visām receptēm</h2>

                        {{-- Paskaidro, kādam nolūkam šī sadaļa paredzēta --}}
                        <p class="admin-section-text">
                            Šeit vari apskatīt platformā publicētās receptes, pārbaudīt autorus,
                            rediģēt saturu un dzēst ierakstus, ja tas ir nepieciešams.
                        </p>
                    </div>

                    {{-- Saites uz citām lapām, lai administrators var ātri pārvietoties --}}
                    <div class="admin-header-actions">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Atpakaļ uz admin paneli</a>
                        <a href="{{ route('recipes.index') }}" class="btn btn-primary">Skatīt publisko sarakstu</a>
                    </div>
                </div>

                {{-- Statistikas bloks izmanto kontrolierī sagatavotos skaitliskos datus --}}
                <div class="admin-stats-grid">
                    <div class="admin-stat-card">
                        {{-- Izvada kopējo recepšu skaitu --}}
                        <span class="admin-stat-number">{{ $recipesCount }}</span>
                        <span class="admin-stat-label">Kopā receptes</span>
                    </div>

                    <div class="admin-stat-card soft-green">
                        {{-- Izvada sistēmā izmantoto kategoriju skaitu --}}
                        <span class="admin-stat-number">{{ $categoriesCount }}</span>
                        <span class="admin-stat-label">Kategorijas</span>
                    </div>

                    <div class="admin-stat-card soft-blue">
                        {{-- Izvada pēdējo 7 dienu laikā pievienoto recepšu skaitu --}}
                        <span class="admin-stat-number">{{ $newRecipesThisWeekCount }}</span>
                        <span class="admin-stat-label">Jaunas šonedēļ</span>
                    </div>

                    <div class="admin-stat-card soft-pink">
                        {{-- Izvada autoru skaitu, kuri ir pievienojuši receptes --}}
                        <span class="admin-stat-number">{{ $activeAuthorsCount }}</span>
                        <span class="admin-stat-label">Aktīvie autori</span>
                    </div>
                </div>
            </div>

            {{-- Galvenā recepšu saraksta sadaļa --}}
            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Satura pārvaldība</div>

                        {{-- Recepšu saraksta virsraksts --}}
                        <h2 class="admin-section-title">Recepšu saraksts</h2>

                        {{-- Paskaidro, ka šeit administrators pārvalda katru recepti atsevišķi --}}
                        <p class="admin-section-text">
                            Šajā sadaļā vari pārskatīt receptes pa vienai, redzēt to pamata datus
                            un veikt nepieciešamās darbības.
                        </p>
                    </div>
                </div>

                {{-- Pārbauda, vai no kontroliera saņemtajā recepšu kolekcijā ir ieraksti --}}
                @if($recipes->count() > 0)
                    <div class="recipes-grid">

                        {{-- Cikls izvada katru recepti kā atsevišķu kartīti --}}
                        @foreach($recipes as $recipe)
                            <div class="recipe-card">
                                <div class="recipe-card-header">
                                    <div class="recipe-topline">

                                        {{-- Izvada relatīvu izveides laiku, piemēram, “pirms 2 stundām” --}}
                                        <span class="recipe-created">🕒 {{ $recipe->created_at->diffForHumans() }}</span>

                                        {{-- Kategorijas birka tiek parādīta tikai tad, ja kategorijas lauks nav tukšs --}}
                                        @if(!empty($recipe->category))
                                            <span class="recipe-badge">{{ $recipe->category }}</span>
                                        @endif
                                    </div>

                                    {{-- Izvada receptes nosaukumu no title lauka --}}
                                    <h3 class="recipe-title">{{ $recipe->title }}</h3>

                                    {{-- Izvada saīsinātu aprakstu, lai garš teksts nepārpildītu kartīti --}}
                                    <p class="recipe-description">
                                        {{ \Illuminate\Support\Str::limit($recipe->description, 120) }}
                                    </p>
                                </div>

                                <div class="recipe-card-body">
                                    <div class="recipe-meta-grid">

                                        {{-- Izvada receptes autora vārdu; ja autora nav, parāda noklusējuma tekstu --}}
                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Autors</div>
                                            <div class="recipe-meta-value">{{ $recipe->user->name ?? 'Nav norādīts' }}</div>
                                        </div>

                                        {{-- Izvada receptes kategoriju; ja tā nav norādīta, parāda aizvietojošu tekstu --}}
                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Kategorija</div>
                                            <div class="recipe-meta-value">
                                                <div class="recipe-meta-badges">
                                                    <span class="recipe-badge">{{ $recipe->category ?? 'Nav norādīta' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Izvada receptes sarežģītības līmeni --}}
                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Grūtība</div>
                                            <div class="recipe-meta-value">
                                                <div class="recipe-meta-badges">
                                                    <span class="recipe-badge difficulty">{{ $recipe->difficulty ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Izvada precīzu receptes izveides datumu un laiku --}}
                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Izveidots</div>
                                            <div class="recipe-meta-value">{{ $recipe->created_at->format('d.m.Y H:i') }}</div>
                                        </div>
                                    </div>

                                    {{-- Īsie receptes dati, kas palīdz ātri novērtēt recepti --}}
                                    <div class="recipe-stats">
                                        <div class="recipe-stat-pill">
                                            {{-- Izvada sagatavošanas laiku minūtēs --}}
                                            <span class="recipe-stat-label">Sagatavošana</span>
                                            <span class="recipe-stat-value">{{ $recipe->prep_time ?? 'N/A' }} min</span>
                                        </div>

                                        <div class="recipe-stat-pill">
                                            {{-- Izvada porciju skaitu --}}
                                            <span class="recipe-stat-label">Porcijas</span>
                                            <span class="recipe-stat-value">{{ $recipe->servings ?? 'N/A' }}</span>
                                        </div>

                                        <div class="recipe-stat-pill">
                                            {{-- Izvada receptes publicēšanas datumu --}}
                                            <span class="recipe-stat-label">Publicēta</span>
                                            <span class="recipe-stat-value">{{ $recipe->created_at->format('d.m.Y') }}</span>
                                        </div>
                                    </div>

                                    {{-- Darbību pogas konkrētās receptes apskatei, rediģēšanai un dzēšanai --}}
                                    <div class="recipe-actions">
                                        {{-- Atver konkrētās receptes publisko skatu --}}
                                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                            Skatīt
                                        </a>

                                        {{-- Rediģēšanas poga tiek rādīta administratoram vai pašam receptes autoram --}}
                                        @if(Auth::user()->is_admin || $recipe->user_id === Auth::id())
                                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-success">
                                                Rediģēt
                                            </a>
                                        @endif

                                        {{-- Forma nosūta pieprasījumu receptes dzēšanai --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.recipes.destroy', $recipe) }}"
                                            style="display: inline; flex: 1 1 140px;"
                                            data-confirm-delete
                                            data-confirm-message="Vai tiešām vēlaties dzēst šo recepti? Šī darbība ir neatgriezeniska."
                                        >
                                            {{-- CSRF tokens aizsargā formu pret neatļautiem pieprasījumiem --}}
                                            @csrf

                                            {{-- Laravel izmanto šo direktīvu, lai POST pieprasījums darbotos kā DELETE pieprasījums --}}
                                            @method('DELETE')

                                            {{-- Poga aktivizē dzēšanas formu --}}
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                style="width: 100%;">
                                                Dzēst
                                            </button>
                                        </form>

                                        {{-- Atver publisko recepšu sarakstu, filtrētu pēc konkrētā autora --}}
                                        <a href="{{ route('recipes.index', ['user' => $recipe->user->id]) }}" class="btn btn-secondary">
                                            Autora receptes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Lapošana tiek rādīta tikai tad, ja receptes sadalītas vairākās lapās --}}
                    @if($recipes->hasPages())
                        <div class="pagination-wrap">
                            {{-- Parāda, kuri recepšu ieraksti pašlaik tiek attēloti --}}
                            <div class="pagination-summary">
                                Rāda {{ $recipes->firstItem() }}–{{ $recipes->lastItem() }} no {{ $recipes->total() }} receptēm
                            </div>

                            {{-- Laravel automātiski ģenerē lapošanas saites --}}
                            {{ $recipes->links() }}
                        </div>
                    @endif
                @else
                    {{-- Šis bloks tiek parādīts, ja recepšu kolekcija ir tukša --}}
                    <div class="admin-empty-state">
                        <div class="admin-empty-icon">🍽️</div>
                        <h3 class="admin-empty-title">Nav recepšu</h3>
                        <p class="admin-empty-text">
                            Sistēmā pašlaik nav atrasta neviena recepte. Kad receptes tiks pievienotas,
                            tās parādīsies šeit administrācijas pārvaldības sadaļā.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Ātro saišu sadaļa uz svarīgākajām sistēmas lapām --}}
            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Ātrās darbības</div>

                        {{-- Sadaļas virsraksts --}}
                        <h2 class="admin-section-title">Noderīgas saites</h2>

                        {{-- Īss sadaļas paskaidrojums --}}
                        <p class="admin-section-text">
                            Ātra piekļuve svarīgākajām administrācijas un platformas sadaļām.
                        </p>
                    </div>
                </div>

                {{-- Ātrās darbības ļauj pāriet uz biežāk izmantotajām lapām --}}
                <div class="quick-actions-grid">
                    {{-- Saite uz galveno administrācijas paneli --}}
                    <a href="{{ route('admin.index') }}" class="quick-action-card">
                        <span class="quick-action-icon">🏠</span>
                        <div class="quick-action-title">Admin panelis</div>
                        <div class="quick-action-text">Atgriezties uz galveno administrācijas pārskatu.</div>
                    </a>

                    {{-- Saite uz lietotāju pārvaldības sadaļu --}}
                    <a href="{{ route('admin.users') }}" class="quick-action-card">
                        <span class="quick-action-icon">👤</span>
                        <div class="quick-action-title">Pārvaldīt lietotājus</div>
                        <div class="quick-action-text">Skatīt lietotājus, viņu statusus un aktivitāti.</div>
                    </a>

                    {{-- Saite uz publisko recepšu sarakstu --}}
                    <a href="{{ route('recipes.index') }}" class="quick-action-card">
                        <span class="quick-action-icon">📖</span>
                        <div class="quick-action-title">Visas receptes</div>
                        <div class="quick-action-text">Atvērt publisko recepšu sarakstu lietotāju skatā.</div>
                    </a>

                    {{-- Saite uz lietotāja vadības paneli --}}
                    <a href="{{ route('dashboard') }}" class="quick-action-card">
                        <span class="quick-action-icon">✨</span>
                        <div class="quick-action-title">Vadības panelis</div>
                        <div class="quick-action-text">Pāriet uz lietotāja vadības paneli un profila sadaļām.</div>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
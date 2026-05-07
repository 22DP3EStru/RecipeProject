{{-- 
    Lietotāju pārvaldības administrācijas skats.

    Šis Blade fails ir paredzēts administrācijas paneļa sadaļai, kurā administrators
    var pārskatīt visus sistēmā reģistrētos lietotājus, redzēt viņu lomas, konta
    statusu, reģistrācijas datumu, aktivitāti un pievienoto recepšu skaitu.

    Skats izmanto kontrolierī sagatavotos datus:
    $usersCount, $adminsCount, $regularUsersCount, $newUsersThisWeekCount un $users.
    Šie dati tiek izmantoti statistikas kartītēs un lietotāju sarakstā, lai administrators
    varētu ātri novērtēt platformas kopienas stāvokli un veikt nepieciešamās darbības.

    Failā ir iekļautas arī administrēšanas formas, kas ļauj mainīt lietotāja administratora
    statusu vai dzēst lietotāju, ja tas nav administrators un nav pašreizējais lietotājs.
    Papildus tam failā atrodas CSS noformējums, kas nosaka kartīšu, pogu, lapošanas,
    tukša saraksta paziņojuma un mobilo ierīču pielāgojumu izskatu.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', 'Lietotāju pārvaldība')

{{-- Norāda hero sadaļas virsrakstu --}}
@section('hero_title', 'Lietotāju pārvaldība')

{{-- Norāda hero sadaļas paskaidrojuma tekstu --}}
@section('hero_text', 'Pārskati lietotājus, pārvaldi statusus un uzturi platformas kopienu kārtībā.')

@section('content')
    <style>
        /* Nosaka galveno teksta krāsu lietotāju pārvaldības lapai */
        .admin-users-page {
            color: var(--text);
        }

        /* Sakārto lapas sadaļas vertikālā kolonnā */
        .admin-users-stack {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Noformē navigācijas ceļu virs satura */
        .admin-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 16px 18px;
            background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 18px;
            color: var(--muted);
            font-size: 14px;
            box-shadow: 0 10px 24px rgba(79, 59, 42, 0.04);
        }

        /* Noformē navigācijas ceļa saiti */
        .admin-breadcrumb a {
            text-decoration: none;
            color: var(--accent);
            font-weight: 700;
        }

        /* Izceļ pašreizējo navigācijas sadaļu */
        .admin-breadcrumb-current {
            color: var(--text);
            font-weight: 800;
        }

        /* Noformē administrācijas sadaļas kartīti */
        .admin-section-card {
            background: rgba(255, 253, 249, 0.96);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        }

        /* Sakārto sadaļas virsrakstu un pogas */
        .admin-section-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        /* Ierobežo virsraksta un apraksta platumu */
        .admin-section-title-wrap {
            max-width: 760px;
        }

        /* Noformē mazo sadaļas apzīmējumu */
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

        /* Sakārto augšējās darbību pogas */
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
            background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 20px;
            padding: 22px 18px;
            text-align: center;
            transition: 0.2s ease;
            box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
        }

        /* Pievieno hover efektu statistikas kartītei */
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
            background: linear-gradient(180deg, #edf4fa 0%, #e4eef7 100%);
        }

        /* Rozā statistikas kartītes variants */
        .admin-stat-card.soft-pink {
            background: linear-gradient(180deg, #faf0f3 0%, #f6e8ed 100%);
        }

        /* Noformē lielo statistikas skaitli */
        .admin-stat-number {
            display: block;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.5rem;
            line-height: 1;
            color: #6f472c;
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* Noformē statistikas paskaidrojuma tekstu */
        .admin-stat-label {
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        /* Izvieto lietotāju kartītes divās kolonnās */
        .users-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        /* Noformē vienu lietotāja kartīti */
        .user-card {
            background: #fffdf9;
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
            transition: 0.2s ease;
        }

        /* Pievieno lietotāja kartītei hover efektu */
        .user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
        }

        /* Noformē lietotāja kartītes augšējo daļu */
        .user-card-header {
            padding: 24px 24px 18px;
            background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
            border-bottom: 1px solid rgba(221, 207, 192, 0.9);
        }

        /* Sakārto lietotāja lomu un reģistrācijas datumu */
        .user-topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        /* Noformē lietotāja lomas birku */
        .user-role-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 11px;
            border-radius: 999px;
            border: 1px solid rgba(122, 90, 67, 0.12);
            background: #f5ece2;
            color: var(--accent);
            font-size: 12px;
            font-weight: 800;
        }

        /* Noformē parasta lietotāja lomas birku */
        .user-role-badge.user {
            background: #eef5ea;
            color: #667652;
            border-color: #d7dfcc;
        }

        /* Noformē administratora lomas birku */
        .user-role-badge.admin {
            background: #f5ece2;
            color: var(--accent);
        }

        /* Noformē reģistrācijas datuma birku */
        .user-created {
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

        /* Noformē lietotāja vārdu */
        .user-name {
            margin: 0 0 8px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            line-height: 1.15;
            color: var(--accent);
            font-weight: 500;
        }

        /* Noformē lietotāja e-pastu */
        .user-email {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin: 0 0 12px;
            word-break: break-word;
        }

        /* Sakārto īsos lietotāja kopsavilkuma rādītājus */
        .user-summary-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Noformē vienu kopsavilkuma birku */
        .user-summary-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 253, 249, 0.88);
            border: 1px solid rgba(122, 90, 67, 0.10);
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        /* Noformē lietotāja kartītes apakšējo daļu */
        .user-card-body {
            padding: 22px 24px 24px;
            background: #fffdf9;
        }

        /* Sakārto lietotāja metadatu rindas */
        .user-meta-grid {
            display: grid;
            gap: 10px;
            margin-bottom: 18px;
        }

        /* Noformē vienu lietotāja metadatu rindu */
        .user-meta-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 12px;
            align-items: center;
            padding: 12px 14px;
            background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
            border: 1px solid rgba(122, 90, 67, 0.10);
            border-radius: 14px;
        }

        /* Noformē metadatu nosaukumu */
        .user-meta-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        /* Noformē metadatu vērtību */
        .user-meta-value {
            text-align: right;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        /* Zaļa krāsa pozitīvam statusam */
        .user-meta-value.success {
            color: #667652;
        }

        /* Sarkana/brūna krāsa negatīvam statusam */
        .user-meta-value.danger {
            color: #a45f52;
        }

        /* Izvieto lietotāja statistiku divās kolonnās */
        .user-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        /* Noformē vienu lietotāja statistikas bloku */
        .user-stat-pill {
            padding: 12px 14px;
            border-radius: 16px;
            background: linear-gradient(180deg, #fbf6ef 0%, #f5ece2 100%);
            border: 1px solid rgba(122, 90, 67, 0.10);
            text-align: center;
        }

        /* Noformē statistikas nosaukumu */
        .user-stat-label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        /* Noformē statistikas vērtību */
        .user-stat-value {
            display: block;
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        /* Sakārto lietotāja darbību pogas */
        .user-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 4px;
        }

        /* Piešķir pogām un formām vienādu elastīgu platumu */
        .user-actions .btn,
        .user-actions form {
            flex: 1 1 180px;
        }

        /* Nodrošina, ka formas poga aizņem visu formas platumu */
        .user-actions form button {
            width: 100%;
        }

        /* Noformē neaktīvo pogu pašreizējam lietotājam */
        .btn-disabled {
            background: #ebe4da;
            color: #8f8378;
            cursor: not-allowed;
            opacity: 0.85;
            border-radius: 14px;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 700;
            border: 1px solid var(--line);
            box-shadow: 0 6px 18px rgba(79, 59, 42, 0.04);
        }

        /* Noformē lapošanas sadaļu */
        .pagination-wrap {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(221, 207, 192, 0.9);
            text-align: center;
        }

        /* Noformē lapošanas kopsavilkuma tekstu */
        .pagination-summary {
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Centrē lapošanas navigāciju */
        .pagination-wrap nav {
            display: flex;
            justify-content: center;
        }

        /* Paslēpj Laravel noklusēto mobilo lapošanas bloku */
        .pagination-wrap nav > div:first-child {
            display: none;
        }

        /* Nosaka lapošanas ikonu izmēru */
        .pagination-wrap svg {
            width: 18px;
            height: 18px;
        }

        /* Sakārto lapošanas pogas ar atstarpēm */
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

        /* Pievieno hover efektu lapošanas saitēm */
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

        /* Noformē neaktīvos lapošanas elementus */
        .pagination-wrap .text-gray-500,
        .pagination-wrap .text-gray-400 {
            color: var(--muted) !important;
        }

        /* Noformē tukša lietotāju saraksta paziņojumu */
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

        /* Izvieto ātrās darbības trīs kolonnās */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
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

        /* Pievieno hover efektu ātrās darbības kartītei */
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

        /* Noformē ātrās darbības aprakstu */
        .quick-action-text {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Pielāgo lapu planšetēm un telefoniem */
        @media (max-width: 768px) {
            .admin-users-stack {
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

            .users-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .user-card {
                border-radius: 18px;
            }

            .user-card-header {
                padding: 14px 14px 12px;
            }

            .user-topline {
                gap: 8px;
                margin-bottom: 10px;
            }

            .user-role-badge,
            .user-created,
            .user-summary-pill {
                font-size: 11px;
                padding: 5px 8px;
            }

            .user-name {
                font-size: 1.45rem;
                margin-bottom: 6px;
            }

            .user-email {
                font-size: 13px;
                line-height: 1.55;
                margin-bottom: 10px;
            }

            .user-summary-row {
                gap: 6px;
            }

            .user-card-body {
                padding: 14px;
            }

            .user-meta-grid {
                gap: 8px;
                margin-bottom: 14px;
            }

            .user-meta-row {
                grid-template-columns: 1fr;
                gap: 6px;
                padding: 10px 12px;
                border-radius: 12px;
            }

            .user-meta-label {
                font-size: 12px;
            }

            .user-meta-value {
                text-align: left;
                font-size: 13px;
            }

            .user-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
                margin-bottom: 14px;
            }

            .user-stat-pill {
                padding: 10px 8px;
                border-radius: 12px;
            }

            .user-stat-label {
                font-size: 10px;
                margin-bottom: 4px;
            }

            .user-stat-value {
                font-size: 12px;
                line-height: 1.35;
            }

            .user-actions {
                flex-direction: column;
                gap: 8px;
            }

            .user-actions .btn,
            .user-actions form,
            .btn-disabled {
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

            .user-name {
                font-size: 1.28rem;
            }

            .user-stats {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .user-stat-pill {
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

    {{-- Galvenais lietotāju pārvaldības lapas konteiners --}}
    <div class="admin-users-page">
        <div class="admin-users-stack">

            {{-- Navigācijas ceļš ļauj atgriezties uz galveno administrācijas paneli --}}
            <div class="admin-breadcrumb">
                <a href="{{ route('admin.index') }}">Admin panelis</a>
                <span>/</span>
                <span class="admin-breadcrumb-current">Lietotāju pārvaldība</span>
            </div>

            {{-- Kopsavilkuma sadaļa ar lapas aprakstu un lietotāju statistiku --}}
            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Administrācija · Lietotāji</div>

                        {{-- Izvada lietotāju pārvaldības sadaļas virsrakstu --}}
                        <h2 class="admin-section-title">Pārskats par lietotājiem</h2>

                        {{-- Paskaidro, kādam nolūkam paredzēta lietotāju pārvaldības sadaļa --}}
                        <p class="admin-section-text">
                            Šeit vari redzēt visus platformas lietotājus, pārvaldīt administratora statusu,
                            pārskatīt viņu aktivitāti un vajadzības gadījumā dzēst kontus.
                        </p>
                    </div>

                    {{-- Saites uz citām administrācijas sadaļām --}}
                    <div class="admin-header-actions">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Atpakaļ uz admin paneli</a>
                        <a href="{{ route('admin.recipes') }}" class="btn btn-primary">Pārvaldīt receptes</a>
                    </div>
                </div>

                {{-- Statistikas kartītes izmanto kontrolierī sagatavotos lietotāju skaitļus --}}
                <div class="admin-stats-grid">
                    <div class="admin-stat-card">
                        {{-- Izvada kopējo lietotāju skaitu --}}
                        <span class="admin-stat-number">{{ $usersCount }}</span>
                        <span class="admin-stat-label">Kopā lietotāju</span>
                    </div>

                    <div class="admin-stat-card soft-pink">
                        {{-- Izvada administratoru skaitu --}}
                        <span class="admin-stat-number">{{ $adminsCount }}</span>
                        <span class="admin-stat-label">Administratori</span>
                    </div>

                    <div class="admin-stat-card soft-green">
                        {{-- Izvada parasto lietotāju skaitu --}}
                        <span class="admin-stat-number">{{ $regularUsersCount }}</span>
                        <span class="admin-stat-label">Parastie lietotāji</span>
                    </div>

                    <div class="admin-stat-card soft-blue">
                        {{-- Izvada pēdējo 7 dienu laikā reģistrēto lietotāju skaitu --}}
                        <span class="admin-stat-number">{{ $newUsersThisWeekCount }}</span>
                        <span class="admin-stat-label">Jauni šonedēļ</span>
                    </div>
                </div>
            </div>

            {{-- Lietotāju saraksta sadaļa --}}
            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Kopienas pārvaldība</div>

                        {{-- Lietotāju saraksta virsraksts --}}
                        <h2 class="admin-section-title">Lietotāju saraksts</h2>

                        {{-- Paskaidro, ka sadaļā tiek attēloti lietotāji un administrācijas darbības --}}
                        <p class="admin-section-text">
                            Pārskati lietotājus pa vienam, redzi viņu statusu, receptes un pieejamās administrācijas darbības.
                        </p>
                    </div>
                </div>

                {{-- Pārbauda, vai no kontroliera saņemtajā lietotāju kolekcijā ir ieraksti --}}
                @if($users->count() > 0)
                    <div class="users-grid">

                        {{-- Cikls izvada katru lietotāju kā atsevišķu kartīti --}}
                        @foreach($users as $user)
                            <div class="user-card">
                                <div class="user-card-header">
                                    <div class="user-topline">

                                        {{-- Pārbauda lietotāja lomu un piešķir atbilstošu birkas klasi --}}
                                        <span class="user-role-badge {{ $user->is_admin ? 'admin' : 'user' }}">
                                            {{ $user->is_admin ? 'Administrators' : 'Lietotājs' }}
                                        </span>

                                        {{-- Izvada lietotāja reģistrācijas datumu --}}
                                        <span class="user-created">🕒 Reģ. {{ $user->created_at->format('d.m.Y') }}</span>
                                    </div>

                                    {{-- Izvada lietotāja vārdu --}}
                                    <h3 class="user-name">{{ $user->name }}</h3>

                                    {{-- Izvada lietotāja e-pasta adresi --}}
                                    <p class="user-email">{{ $user->email }}</p>

                                    {{-- Īsais lietotāja aktivitātes kopsavilkums --}}
                                    <div class="user-summary-row">
                                        {{-- Izvada lietotāja pievienoto recepšu skaitu --}}
                                        <span class="user-summary-pill">{{ $user->recipes->count() }} receptes</span>

                                        {{-- Izvada, cik sen lietotājs pēdējo reizi tika atjaunināts --}}
                                        <span class="user-summary-pill">{{ $user->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="user-card-body">
                                    {{-- Lietotāja papildu informācijas bloks --}}
                                    <div class="user-meta-grid">
                                        <div class="user-meta-row">
                                            <div class="user-meta-label">E-pasts apstiprināts</div>

                                            {{-- Parāda, vai lietotājs ir apstiprinājis e-pastu --}}
                                            <div class="user-meta-value {{ $user->email_verified_at ? 'success' : 'danger' }}">
                                                {{ $user->email_verified_at ? 'Jā' : 'Nē' }}
                                            </div>
                                        </div>

                                        <div class="user-meta-row">
                                            <div class="user-meta-label">Pēdējā aktivitāte</div>

                                            {{-- Izvada relatīvu pēdējās aktivitātes laiku --}}
                                            <div class="user-meta-value">
                                                {{ $user->updated_at->diffForHumans() }}
                                            </div>
                                        </div>

                                        <div class="user-meta-row">
                                            <div class="user-meta-label">Loma sistēmā</div>

                                            {{-- Izvada lietotāja lomu tekstuālā veidā --}}
                                            <div class="user-meta-value">
                                                {{ $user->is_admin ? 'Administrators' : 'Parastais lietotājs' }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Lietotāja īsie statistikas dati --}}
                                    <div class="user-stats">
                                        <div class="user-stat-pill">
                                            {{-- Izvada lietotāja recepšu skaitu --}}
                                            <span class="user-stat-label">Receptes</span>
                                            <span class="user-stat-value">{{ $user->recipes->count() }}</span>
                                        </div>

                                        <div class="user-stat-pill">
                                            {{-- Izvada konta izveides datumu --}}
                                            <span class="user-stat-label">Konts izveidots</span>
                                            <span class="user-stat-value">{{ $user->created_at->format('d.m.Y') }}</span>
                                        </div>
                                    </div>

                                    {{-- Lietotāja administrēšanas darbības --}}
                                    <div class="user-actions">

                                        {{-- Pārbauda, vai attēlotais lietotājs nav pašreiz pieslēgtais lietotājs --}}
                                        @if($user->id !== Auth::id())

                                            {{-- Forma maina lietotāja administratora statusu --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.toggle-admin', $user) }}"
                                                data-confirm-delete
                                                data-confirm-message="Vai tiešām vēlaties mainīt šī lietotāja administratora statusu?"
                                            >
                                                {{-- CSRF aizsardzība pret neatļautiem pieprasījumiem --}}
                                                @csrf

                                                {{-- Laravel izmanto PATCH metodi statusa maiņai --}}
                                                @method('PATCH')

                                                {{-- Pogas teksts un klase mainās atkarībā no pašreizējās lietotāja lomas --}}
                                                <button
                                                    type="submit"
                                                    class="btn {{ $user->is_admin ? 'btn-warning' : 'btn-success' }}">
                                                    {{ $user->is_admin ? 'Noņemt admin' : 'Padarīt par admin' }}
                                                </button>
                                            </form>

                                            {{-- Dzēšanas iespēja tiek rādīta tikai parastiem lietotājiem --}}
                                            @if(!$user->is_admin)
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.users.destroy', $user) }}"
                                                    data-confirm-delete
                                                    data-confirm-message="Vai tiešām vēlaties dzēst šo lietotāju? Šī darbība ir neatgriezeniska."
                                                >
                                                    {{-- CSRF aizsardzība dzēšanas formai --}}
                                                    @csrf

                                                    {{-- Laravel izmanto DELETE metodi lietotāja dzēšanai --}}
                                                    @method('DELETE')

                                                    {{-- Poga nosūta lietotāja dzēšanas pieprasījumu --}}
                                                    <button
                                                        type="submit"
                                                        class="btn btn-danger">
                                                        Dzēst
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            {{-- Pašreizējais lietotājs nevar mainīt vai dzēst pats sevi --}}
                                            <span class="btn-disabled">Jūs pats</span>
                                        @endif

                                        {{-- Ja lietotājam ir receptes, tiek parādīta saite uz šī autora receptēm --}}
                                        @if($user->recipes->count() > 0)
                                            <a href="/recipes?user={{ $user->id }}" class="btn btn-primary">
                                                Skatīt receptes ({{ $user->recipes->count() }})
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Lapošana tiek parādīta tikai tad, ja lietotāji sadalīti vairākās lapās --}}
                    @if($users->hasPages())
                        <div class="pagination-wrap">
                            {{-- Parāda, kuri lietotāji pašlaik tiek attēloti --}}
                            <div class="pagination-summary">
                                Rāda {{ $users->firstItem() }}–{{ $users->lastItem() }} no {{ $users->total() }} lietotājiem
                            </div>

                            {{-- Laravel automātiski ģenerē lapošanas saites --}}
                            {{ $users->links() }}
                        </div>
                    @endif
                @else
                    {{-- Tukša stāvokļa paziņojums, ja sistēmā nav neviena lietotāja --}}
                    <div class="admin-empty-state">
                        <div class="admin-empty-icon">👥</div>
                        <h3 class="admin-empty-title">Nav lietotāju</h3>
                        <p class="admin-empty-text">
                            Sistēmā pašlaik nav atrasts neviens lietotājs. Kad lietotāji reģistrēsies,
                            tie parādīsies šajā administrācijas sadaļā.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Ātro darbību sadaļa --}}
            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Ātrās darbības</div>

                        {{-- Ātro saišu sadaļas virsraksts --}}
                        <h2 class="admin-section-title">Noderīgas saites</h2>

                        {{-- Ātro saišu paskaidrojums --}}
                        <p class="admin-section-text">
                            Ātra piekļuve galvenajām administrācijas sadaļām un platformas pārskatam.
                        </p>
                    </div>
                </div>

                {{-- Saites uz biežāk izmantotajām administrācijas sadaļām --}}
                <div class="quick-actions-grid">
                    {{-- Saite uz galveno administrācijas paneli --}}
                    <a href="{{ route('admin.index') }}" class="quick-action-card">
                        <span class="quick-action-icon">🏠</span>
                        <div class="quick-action-title">Admin panelis</div>
                        <div class="quick-action-text">Atgriezties uz galveno administrācijas pārskatu.</div>
                    </a>

                    {{-- Saite uz recepšu pārvaldības sadaļu --}}
                    <a href="{{ route('admin.recipes') }}" class="quick-action-card">
                        <span class="quick-action-icon">🍽️</span>
                        <div class="quick-action-title">Pārvaldīt receptes</div>
                        <div class="quick-action-text">Skatīt visas receptes un pārvaldīt publicēto saturu.</div>
                    </a>

                    {{-- Saite uz lietotāja vadības paneli --}}
                    <a href="{{ route('dashboard') }}" class="quick-action-card">
                        <span class="quick-action-icon">✨</span>
                        <div class="quick-action-title">Vadības panelis</div>
                        <div class="quick-action-text">Pāriet uz lietotāja vadības paneli un citām sadaļām.</div>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
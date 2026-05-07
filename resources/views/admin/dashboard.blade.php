{{-- 
    Administrācijas paneļa skats.

    Šis Blade fails nodrošina administratora paneli recepšu sistēmā.
    Panelī tiek attēlota sistēmas statistika, ātrās darbības,
    sistēmas pārskats, brīdinājumi, jaunākie lietotāji,
    jaunākās receptes, populārākās receptes un PDF eksporti.
--}}

@extends('layouts.app')

{{-- Norāda lapas nosaukumu pārlūkprogrammas cilnē --}}
@section('title', 'Administrācijas panelis')

{{-- Sāk galveno lapas satura sekciju --}}
@section('content')

<style>
    /* Galvenais administrācijas paneļa konteiners */
    .admin-dashboard {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /* Paziņojumu bloks veiksmīgām un kļūdainām darbībām */
    .admin-alert {
        padding: 18px 20px;
        border-radius: 18px;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 10px 30px rgba(60, 40, 20, 0.04);
    }

    /* Administrācijas sadaļas kartīte */
    .admin-section {
        background: #fff;
        border: 1px solid rgba(120, 84, 52, 0.12);
        border-radius: 22px;
        padding: 26px;
        box-shadow: 0 14px 34px rgba(91, 62, 35, 0.05);
    }

    /* Administrācijas sadaļas virsraksts */
    .admin-section-title {
        margin: 0 0 18px;
        font-size: 32px;
        font-weight: 800;
        color: #7a5a43;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Administrācijas sadaļas paskaidrojuma teksts */
    .admin-subtitle {
        margin: -6px 0 0;
        color: #7d6b5d;
        font-size: 15px;
    }

    /* Statistikas kartīšu režģis */
    .dashboard-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-top: 22px;
    }

    /* Vienas statistikas kartītes noformējums */
    .dashboard-stat-card {
        background: linear-gradient(180deg, #f8f2ea 0%, #f2e8dc 100%);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 18px;
        padding: 22px 18px;
        text-align: center;
    }

    /* Zaļās statistikas kartītes variants */
    .dashboard-stat-card.soft-green {
        background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
    }

    /* Zilās statistikas kartītes variants */
    .dashboard-stat-card.soft-blue {
        background: linear-gradient(180deg, #edf4fa 0%, #e4eef7 100%);
    }

    /* Rozā statistikas kartītes variants */
    .dashboard-stat-card.soft-pink {
        background: linear-gradient(180deg, #faf0f3 0%, #f6e8ed 100%);
    }

    /* Lielais statistikas skaitlis */
    .dashboard-stat-number {
        display: block;
        font-size: 42px;
        line-height: 1;
        font-weight: 900;
        color: #6f472c;
        margin-bottom: 10px;
    }

    /* Statistikas kartītes nosaukums */
    .dashboard-stat-label {
        display: block;
        font-size: 15px;
        color: #7b6d61;
        font-weight: 700;
    }

    /* Ātro darbību kartīšu režģis */
    .dashboard-actions-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-top: 18px;
    }

    /* Vienas ātrās darbības kartīte */
    .dashboard-action-card {
        display: block;
        text-decoration: none;
        padding: 18px;
        border-radius: 18px;
        background: #fcf9f5;
        border: 1px solid rgba(122, 90, 67, 0.14);
        color: #2f241d;
        transition: 0.2s ease;
    }

    /* Ātrās darbības kartītes hover efekts */
    .dashboard-action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(91, 62, 35, 0.08);
    }

    /* Ātrās darbības ikona */
    .dashboard-action-icon {
        font-size: 24px;
        margin-bottom: 10px;
        display: block;
    }

    /* Ātrās darbības virsraksts */
    .dashboard-action-title {
        font-weight: 800;
        font-size: 16px;
        margin-bottom: 6px;
    }

    /* Ātrās darbības apraksts */
    .dashboard-action-text {
        font-size: 14px;
        color: #7b6d61;
        line-height: 1.5;
    }

    /* Divu kolonnu izkārtojums sistēmas pārskatam un brīdinājumiem */
    .dashboard-mini-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 18px;
    }

    /* Vienāda platuma divu kolonnu izkārtojums */
    .dashboard-columns-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    /* Saraksta galvenais konteiners */
    .dashboard-list {
        display: flex;
        flex-direction: column;
    }

    /* Viena saraksta ieraksta izkārtojums */
    .dashboard-list-item {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    /* Noņem apakšējo līniju pēdējam saraksta ierakstam */
    .dashboard-list-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    /* Saraksta ieraksta kreisās puses izkārtojums */
    .dashboard-item-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    /* Kopējie izmēri avatāram un ikonas blokam */
    .dashboard-avatar,
    .dashboard-icon-box {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Lietotāja avatāra noformējums */
    .dashboard-avatar {
        border-radius: 50%;
        background: rgba(102,126,234,0.14);
        color: #667eea;
        font-weight: 900;
    }

    /* Receptes ikonas bloka noformējums */
    .dashboard-icon-box {
        border-radius: 14px;
        background: rgba(240,147,251,0.16);
        font-size: 19px;
    }

    /* Saraksta ieraksta virsraksts */
    .dashboard-item-title {
        font-weight: 800;
        color: #2f241d;
        font-size: 16px;
    }

    /* Saraksta ieraksta papildu informācija */
    .dashboard-item-meta {
        color: #7b6d61;
        font-size: 14px;
        line-height: 1.45;
    }

    /* Saraksta ieraksta laika informācija */
    .dashboard-item-time {
        font-size: 14px;
        color: #8e8175;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* Statusa birkas pamata noformējums */
    .dashboard-badge {
        display: inline-block;
        margin-top: 6px;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    /* Administratora statusa birka */
    .dashboard-badge.admin {
        background: rgba(245,87,108,0.12);
        color: #d45066;
    }

    /* Brīdinājumu un informācijas sarakstu izkārtojums */
    .dashboard-warning-list,
    .dashboard-info-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 10px;
    }

    /* Brīdinājuma un informācijas bloka pamata noformējums */
    .dashboard-warning-item,
    .dashboard-info-item {
        border-radius: 16px;
        padding: 14px 16px;
        border: 1px solid rgba(122, 90, 67, 0.12);
        background: #fcfaf7;
    }

    /* Brīdinājuma un informācijas bloka virsraksts */
    .dashboard-warning-item strong,
    .dashboard-info-item strong {
        display: block;
        margin-bottom: 4px;
        color: #2f241d;
    }

    /* Brīdinājuma un informācijas bloka apraksts */
    .dashboard-warning-item span,
    .dashboard-info-item span {
        font-size: 14px;
        color: #7b6d61;
    }

    /* Brīdinājuma statusa bloks */
    .dashboard-warning-item.warning {
        background: #fff7ec;
        border-color: rgba(201, 128, 39, 0.18);
    }

    /* Bīstamības statusa bloks */
    .dashboard-warning-item.danger {
        background: #fff0f1;
        border-color: rgba(220, 76, 100, 0.15);
    }

    /* Veiksmīga statusa bloks */
    .dashboard-warning-item.success {
        background: #f2f8ef;
        border-color: rgba(86, 171, 47, 0.18);
    }

    /* Populārāko recepšu saraksta izkārtojums */
    .dashboard-top-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 10px;
    }

    /* Vienas populārās receptes ieraksts */
    .dashboard-top-item {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        background: #fcf8f3;
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 16px;
        padding: 14px 16px;
    }

    /* Receptes vietas numurs top sarakstā */
    .dashboard-top-rank {
        min-width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #7a5a43;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 14px;
    }

    /* Populārās receptes galvenās informācijas bloks */
    .dashboard-top-main {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        flex: 1;
    }

    /* Populārās receptes nosaukums */
    .dashboard-top-title {
        font-weight: 800;
        color: #2f241d;
    }

    /* Populārās receptes papildu informācija */
    .dashboard-top-meta {
        font-size: 14px;
        color: #7b6d61;
    }

    /* Populārās receptes skatījumu vērtība */
    .dashboard-top-value {
        font-weight: 900;
        color: #7a5a43;
        white-space: nowrap;
    }

    /* PDF eksportu pogu konteiners */
    .dashboard-pdf-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* PDF eksportēšanas pogas noformējums */
    .dashboard-outline-btn {
        display: inline-block;
        padding: 11px 16px;
        background: #fff;
        color: #5e4635;
        border: 1px solid rgba(122, 90, 67, 0.18);
        border-radius: 12px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    /* PDF eksportēšanas pogas hover efekts */
    .dashboard-outline-btn:hover {
        background: #f8f2ea;
    }

    /* Mobilā skata pielāgojumi */
    @media (max-width: 768px) {
        .admin-dashboard {
            gap: 16px;
        }

        .admin-alert {
            padding: 12px 14px;
            border-radius: 14px;
        }

        .admin-section {
            padding: 14px;
            border-radius: 18px;
        }

        .admin-section-title {
            font-size: 1.45rem;
            line-height: 1.15;
            gap: 8px;
            margin-bottom: 10px;
        }

        .admin-subtitle {
            font-size: 13px;
            line-height: 1.55;
            margin-top: 0;
        }

        .dashboard-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            margin-top: 16px;
        }

        .dashboard-stat-card {
            padding: 12px 8px;
            border-radius: 14px;
        }

        .dashboard-stat-number {
            font-size: 1.75rem;
            margin-bottom: 6px;
        }

        .dashboard-stat-label {
            font-size: 12px;
            line-height: 1.35;
        }

        .dashboard-actions-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            margin-top: 14px;
        }

        .dashboard-action-card {
            padding: 12px;
            border-radius: 14px;
        }

        .dashboard-action-icon {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .dashboard-action-title {
            font-size: 14px;
            margin-bottom: 4px;
        }

        .dashboard-action-text {
            font-size: 12px;
            line-height: 1.45;
        }

        .dashboard-mini-grid,
        .dashboard-columns-2 {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .dashboard-list-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 12px 0;
        }

        .dashboard-item-left {
            width: 100%;
            align-items: flex-start;
        }

        .dashboard-avatar,
        .dashboard-icon-box {
            width: 38px;
            height: 38px;
        }

        .dashboard-icon-box {
            font-size: 16px;
            border-radius: 12px;
        }

        .dashboard-item-title {
            font-size: 14px;
            line-height: 1.35;
        }

        .dashboard-item-meta {
            font-size: 12px;
            line-height: 1.45;
        }

        .dashboard-item-time {
            font-size: 12px;
            white-space: normal;
        }

        .dashboard-badge {
            font-size: 11px;
            padding: 4px 8px;
        }

        .dashboard-warning-list,
        .dashboard-info-list,
        .dashboard-top-list {
            gap: 10px;
            margin-top: 8px;
        }

        .dashboard-warning-item,
        .dashboard-info-item {
            padding: 12px;
            border-radius: 14px;
        }

        .dashboard-warning-item strong,
        .dashboard-info-item strong {
            margin-bottom: 4px;
            font-size: 14px;
        }

        .dashboard-warning-item span,
        .dashboard-info-item span {
            font-size: 12px;
            line-height: 1.5;
        }

        .dashboard-top-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding: 12px;
            border-radius: 14px;
        }

        .dashboard-top-main {
            width: 100%;
            align-items: flex-start;
        }

        .dashboard-top-rank {
            min-width: 30px;
            width: 30px;
            height: 30px;
            font-size: 12px;
        }

        .dashboard-top-title {
            font-size: 14px;
            line-height: 1.35;
        }

        .dashboard-top-meta {
            font-size: 12px;
            line-height: 1.45;
        }

        .dashboard-top-value {
            font-size: 13px;
            white-space: normal;
        }

        .dashboard-pdf-actions {
            flex-direction: column;
            gap: 8px;
        }

        .dashboard-outline-btn {
            width: 100%;
            text-align: center;
            padding: 10px 12px;
            font-size: 13px;
            border-radius: 12px;
        }
    }

    /* Ļoti mazu ekrānu pielāgojumi */
    @media (max-width: 480px) {
        .admin-section {
            padding: 12px;
            border-radius: 16px;
        }

        .admin-section-title {
            font-size: 1.3rem;
        }

        .dashboard-stats-grid {
            gap: 6px;
        }

        .dashboard-stat-card {
            padding: 10px 6px;
        }

        .dashboard-stat-number {
            font-size: 1.45rem;
        }

        .dashboard-stat-label {
            font-size: 11px;
        }

        .dashboard-actions-grid {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .dashboard-action-card {
            padding: 11px;
        }

        .dashboard-top-item,
        .dashboard-warning-item,
        .dashboard-info-item {
            padding: 10px;
        }
    }
</style>

{{-- Galvenais administrācijas paneļa konteiners --}}
<div class="admin-dashboard">

    {{-- Attēlo veiksmīgas darbības paziņojumu, ja tāds ir saglabāts sesijā --}}
    @if(session('success'))
        <div class="admin-alert" style="border-left: 6px solid #56ab2f;">
            <div style="font-weight: 700; color: #2f855a;">✅ {{ session('success') }}</div>
        </div>
    @endif

    {{-- Attēlo kļūdas paziņojumu, ja tāds ir saglabāts sesijā --}}
    @if(session('error'))
        <div class="admin-alert" style="border-left: 6px solid #f5576c;">
            <div style="font-weight: 700; color: #c53030;">❌ {{ session('error') }}</div>
        </div>
    @endif

    {{-- Administrācijas kopsavilkuma sadaļa ar galvenajiem sistēmas rādītājiem --}}
    <div class="admin-section">
        <h2 class="admin-section-title">📊 Administrācijas kopsavilkums</h2>
        <p class="admin-subtitle">Pārskats par lietotājiem, receptēm un platformas aktivitāti vienuviet.</p>

        {{-- Statistikas kartītes ar kopējiem lietotāju, recepšu, administratoru un aktivitātes datiem --}}
        <div class="dashboard-stats-grid">
            <div class="dashboard-stat-card">
                <span class="dashboard-stat-number">{{ $usersCount }}</span>
                <span class="dashboard-stat-label">Kopā lietotāji</span>
            </div>

            <div class="dashboard-stat-card soft-green">
                <span class="dashboard-stat-number">{{ $recipesCount }}</span>
                <span class="dashboard-stat-label">Kopā receptes</span>
            </div>

            <div class="dashboard-stat-card soft-blue">
                <span class="dashboard-stat-number">{{ $adminsCount }}</span>
                <span class="dashboard-stat-label">Admini</span>
            </div>

            <div class="dashboard-stat-card soft-pink">
                <span class="dashboard-stat-number">{{ $todayRecipesCount ?? 0 }}</span>
                <span class="dashboard-stat-label">Šodien pievienotas receptes</span>
            </div>

            <div class="dashboard-stat-card">
                <span class="dashboard-stat-number">{{ $newUsersThisWeekCount ?? 0 }}</span>
                <span class="dashboard-stat-label">Jauni lietotāji 7 dienās</span>
            </div>

            <div class="dashboard-stat-card soft-green">
                <span class="dashboard-stat-number">{{ $newRecipesThisWeekCount ?? 0 }}</span>
                <span class="dashboard-stat-label">Jaunas receptes 7 dienās</span>
            </div>

            <div class="dashboard-stat-card soft-blue">
                <span class="dashboard-stat-number">{{ $activeAuthorsCount ?? 0 }}</span>
                <span class="dashboard-stat-label">Aktīvie autori</span>
            </div>

            <div class="dashboard-stat-card soft-pink">
                <span class="dashboard-stat-number">{{ $categoriesCount ?? 0 }}</span>
                <span class="dashboard-stat-label">Kategorijas</span>
            </div>
        </div>
    </div>

    {{-- Ātro darbību sadaļa ar saitēm uz biežāk izmantotajām administrācijas funkcijām --}}
    <div class="admin-section">
        <h2 class="admin-section-title">⚡ Ātrās darbības</h2>

        <div class="dashboard-actions-grid">
            <a href="{{ route('admin.users') }}" class="dashboard-action-card">
                <span class="dashboard-action-icon">👤</span>
                <div class="dashboard-action-title">Pārvaldīt lietotājus</div>
                <div class="dashboard-action-text">Skatīt, rediģēt un dzēst lietotāju kontus.</div>
            </a>

            <a href="{{ route('admin.recipes') }}" class="dashboard-action-card">
                <span class="dashboard-action-icon">🍽️</span>
                <div class="dashboard-action-title">Pārvaldīt receptes</div>
                <div class="dashboard-action-text">Apskatīt visas receptes un uzturēt saturu kārtībā.</div>
            </a>

            <a href="{{ route('pdf.admin.statistics') }}" class="dashboard-action-card">
                <span class="dashboard-action-icon">📄</span>
                <div class="dashboard-action-title">Statistikas PDF</div>
                <div class="dashboard-action-text">Ģenerēt sistēmas kopsavilkuma dokumentu PDF formātā.</div>
            </a>

            <a href="{{ route('pdf.popular.recipes') }}" class="dashboard-action-card">
                <span class="dashboard-action-icon">⭐</span>
                <div class="dashboard-action-title">Top recepšu PDF</div>
                <div class="dashboard-action-text">Lejupielādēt populārāko recepšu pārskatu.</div>
            </a>
        </div>
    </div>

    {{-- Sistēmas pārskata un brīdinājumu sadaļa --}}
    <div class="dashboard-mini-grid">
        <div class="admin-section">
            <h2 class="admin-section-title">📌 Sistēmas pārskats</h2>

            {{-- Tekstveida pārskats par galvenajiem sistēmas datiem --}}
            <div class="dashboard-info-list">
                <div class="dashboard-info-item">
                    <strong>Reģistrētie lietotāji</strong>
                    <span>Platformā pašlaik ir {{ $usersCount }} lietotāji, no kuriem {{ $adminsCount }} ir administratori.</span>
                </div>

                <div class="dashboard-info-item">
                    <strong>Publicētais saturs</strong>
                    <span>Kopumā publicētas {{ $recipesCount }} receptes, bet pēdējo 7 dienu laikā pievienotas {{ $newRecipesThisWeekCount ?? 0 }} jaunas receptes.</span>
                </div>

                <div class="dashboard-info-item">
                    <strong>Autoru aktivitāte</strong>
                    <span>{{ $activeAuthorsCount ?? 0 }} lietotāji jau ir publicējuši vismaz vienu recepti.</span>
                </div>

                <div class="dashboard-info-item">
                    <strong>Kategoriju pārklājums</strong>
                    <span>Pašlaik sistēmā izmantotas {{ $categoriesCount ?? 0 }} kategorijas.</span>
                </div>
            </div>
        </div>

        <div class="admin-section">
            <h2 class="admin-section-title">🚨 Brīdinājumi</h2>

            {{-- Brīdinājumi palīdz administratoram ātri pamanīt nepilnīgus vai jaunus sistēmas datus --}}
            <div class="dashboard-warning-list">
                <div class="dashboard-warning-item warning">
                    <strong>Šodien pievienotas receptes</strong>
                    <span>{{ $todayRecipesCount ?? 0 }} receptes pievienotas šodien.</span>
                </div>

                <div class="dashboard-warning-item {{ ($recipesWithoutImageCount ?? 0) > 0 ? 'danger' : 'success' }}">
                    <strong>Receptes bez attēla</strong>
                    <span>
                        @if(($recipesWithoutImageCount ?? 0) > 0)
                            Sistēmā ir {{ $recipesWithoutImageCount }} receptes bez attēla.
                        @else
                            Visām receptēm ir pievienots attēls.
                        @endif
                    </span>
                </div>

                <div class="dashboard-warning-item {{ ($recipesWithoutCategoryCount ?? 0) > 0 ? 'danger' : 'success' }}">
                    <strong>Receptes bez kategorijas</strong>
                    <span>
                        @if(($recipesWithoutCategoryCount ?? 0) > 0)
                            Atrastas {{ $recipesWithoutCategoryCount }} receptes bez kategorijas.
                        @else
                            Visām receptēm ir norādīta kategorija.
                        @endif
                    </span>
                </div>

                <div class="dashboard-warning-item {{ ($newUsersThisWeekCount ?? 0) > 0 ? 'warning' : 'success' }}">
                    <strong>Jaunie lietotāji</strong>
                    <span>Pēdējo 7 dienu laikā reģistrējušies {{ $newUsersThisWeekCount ?? 0 }} lietotāji.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Jaunāko lietotāju un jaunāko recepšu sadaļa --}}
    <div class="dashboard-columns-2">
        <div class="admin-section">
            <h2 class="admin-section-title">👤 Jaunākie lietotāji</h2>

            {{-- Cikls attēlo pēdējos reģistrētos lietotājus --}}
            <div class="dashboard-list">
                @forelse($latestUsers as $user)
                    <div class="dashboard-list-item">
                        <div class="dashboard-item-left">
                            <div class="dashboard-avatar">
                                {{ strtoupper(substr($user->name ?? '—', 0, 1)) }}
                            </div>

                            <div>
                                <div class="dashboard-item-title">{{ $user->name ?? '—' }}</div>
                                <div class="dashboard-item-meta">{{ $user->email }}</div>

                                {{-- Ja lietotājs ir administrators, tiek parādīta administratora statusa birka --}}
                                @if($user->is_admin)
                                    <span class="dashboard-badge admin">Admin</span>
                                @endif
                            </div>
                        </div>

                        <div class="dashboard-item-time">
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="dashboard-item-meta">Nav lietotāju.</div>
                @endforelse
            </div>
        </div>

        <div class="admin-section">
            <h2 class="admin-section-title">🍽️ Jaunākās receptes</h2>

            {{-- Cikls attēlo pēdējās sistēmā pievienotās receptes --}}
            <div class="dashboard-list">
                @forelse($latestRecipes as $recipe)
                    <div class="dashboard-list-item">
                        <div class="dashboard-item-left">
                            <div class="dashboard-icon-box">🍽️</div>

                            <div>
                                <div class="dashboard-item-title">{{ $recipe->title }}</div>
                                <div class="dashboard-item-meta">
                                    Autors: {{ optional($recipe->user)->name ?? '—' }}
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-item-time">
                            {{ $recipe->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="dashboard-item-meta">Nav recepšu.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Populārāko recepšu un PDF eksportu sadaļa --}}
    <div class="dashboard-columns-2">
        <div class="admin-section">
            <h2 class="admin-section-title">🏆 Populārākās receptes</h2>

            {{-- Cikls attēlo receptes, kurām ir lielākais skatījumu skaits --}}
            <div class="dashboard-top-list">
                @forelse($topRecipes as $index => $recipe)
                    <div class="dashboard-top-item">
                        <div class="dashboard-top-main">
                            <div class="dashboard-top-rank">{{ $index + 1 }}</div>
                            <div>
                                <div class="dashboard-top-title">{{ $recipe->title }}</div>
                                <div class="dashboard-top-meta">
                                    Autors: {{ optional($recipe->user)->name ?? '—' }}
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-top-value">
                            {{ $recipe->views ?? 0 }} skatījumi
                        </div>
                    </div>
                @empty
                    <div class="dashboard-item-meta">Nav datu par populārākajām receptēm.</div>
                @endforelse
            </div>
        </div>

        <div class="admin-section">
            <h2 class="admin-section-title">📄 Eksporti</h2>

            {{-- Saites uz PDF dokumentu ģenerēšanas funkcijām --}}
            <div class="dashboard-pdf-actions">
                <a href="{{ route('pdf.admin.statistics') }}" class="dashboard-outline-btn">Statistikas PDF</a>
                <a href="{{ route('pdf.popular.recipes') }}" class="dashboard-outline-btn">Populārākās receptes PDF</a>
            </div>

            <div class="dashboard-info-list" style="margin-top:18px;">
                <div class="dashboard-info-item">
                    <strong>Statistikas pārskats</strong>
                    <span>Lejupielādē administrācijas paneļa statistiku PDF formātā.</span>
                </div>

                <div class="dashboard-info-item">
                    <strong>Populārāko recepšu pārskats</strong>
                    <span>Izveido PDF dokumentu ar populārākajām receptēm un to datiem.</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    :root {
        --page-bg: #eee5da;
        --page-bg-2: #e8ddd0;
        --card-bg: #fffdf9;
        --soft-bg: #f6efe7;
        --soft-bg-2: #efe4d6;
        --line: #ddcfc0;
        --text: #2f241d;
        --muted: #7b6d61;
        --accent: #7a5a43;
        --accent-dark: #634733;
        --success-bg: #edf3e7;
        --success-text: #667652;
        --warning-bg: #f3e8e3;
        --warning-text: #9a6b56;
        --danger-bg: #f3e2de;
        --danger-text: #a45f52;
        --danger-border: #e3c9c2;
        --info-bg: #f2e7da;
        --info-text: #7a5a43;
        --shadow: 0 16px 40px rgba(79, 59, 42, 0.07);
    }

    body {
        background:
            linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
            linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
        color: var(--text);
    }

    .admin-page {
        max-width: 1280px;
        margin: 0 auto;
        padding: 28px 20px 50px;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero {
        padding: 18px 20px 32px;
        text-align: center;
    }

    .hero-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 4rem;
        line-height: 1.08;
        color: var(--accent);
        font-weight: 400;
        margin-bottom: 12px;
    }

    .hero-text {
        color: var(--muted);
        font-size: 16px;
        line-height: 1.7;
        max-width: 820px;
        margin: 0 auto;
    }

    .main-content {
        background: rgba(255, 253, 249, 0.78);
        border: 1px solid var(--line);
        box-shadow: var(--shadow);
        padding: 34px;
    }

    .section-block + .section-block {
        margin-top: 28px;
    }

    .intro-box,
    .stats-box,
    .table-box {
        background: var(--card-bg);
        border: 1px solid var(--line);
        padding: 28px;
    }

    .intro-box {
        text-align: center;
    }

    .intro-icon {
        font-size: 3.5rem;
        margin-bottom: 16px;
    }

    .intro-box h2,
    .section-title,
    .stat-number {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-weight: 500;
    }

    .intro-box h2 {
        font-size: 2.3rem;
        margin-bottom: 12px;
    }

    .intro-box p,
    .section-subtext {
        color: var(--muted);
        line-height: 1.8;
    }

    .section-title {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.9rem;
    }

    .section-subtext {
        margin-bottom: 22px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
    }

    .stat-card {
        background: var(--soft-bg);
        border: 1px solid var(--line);
        padding: 24px;
        text-align: center;
    }

    .stat-icon {
        font-size: 2.2rem;
        margin-bottom: 10px;
    }

    .stat-label {
        color: var(--muted);
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .stat-number {
        font-size: 2.4rem;
        line-height: 1;
    }

    .table-wrap {
        overflow-x: auto;
        border: 1px solid var(--line);
        background: var(--soft-bg);
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 760px;
    }

    .admin-table thead tr {
        background: var(--soft-bg-2);
    }

    .admin-table th,
    .admin-table td {
        padding: 16px 18px;
        text-align: left;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
    }

    .admin-table th {
        color: var(--accent);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 800;
    }

    .admin-table td {
        color: var(--text);
        font-size: 15px;
    }

    .recipe-title {
        font-weight: 700;
        color: var(--text);
    }

    .muted {
        color: var(--muted);
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .action-link,
    .action-btn {
        display: inline-block;
        text-decoration: none;
        border: 1px solid var(--line);
        background: #fff;
        color: var(--text);
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
        font-family: inherit;
    }

    .action-link:hover,
    .action-btn:hover {
        filter: brightness(0.98);
    }

    .action-link.edit {
        background: var(--warning-bg);
        color: var(--warning-text);
        border-color: #e2ccc1;
    }

    .action-btn.delete {
        background: var(--danger-bg);
        color: var(--danger-text);
        border-color: var(--danger-border);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--muted);
    }

    @media (max-width: 900px) {
        .hero-title {
            font-size: 2.8rem;
        }

        .main-content {
            padding: 24px;
        }
    }

    @media (max-width: 640px) {
        .admin-page {
            padding: 16px 12px 32px;
        }

        .hero {
            padding: 10px 8px 24px;
        }

        .hero-title {
            font-size: 2.3rem;
        }

        .main-content,
        .intro-box,
        .stats-box,
        .table-box {
            padding: 20px;
        }

        .actions {
            flex-direction: column;
            align-items: stretch;
        }

        .action-link,
        .action-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="admin-page">
    <div class="hero">
        <h1 class="hero-title">Administrācijas panelis</h1>
        <p class="hero-text">
            Pārskatiet sistēmas galvenos rādītājus, jaunākās receptes un veiciet administratīvās darbības vienuviet.
        </p>
    </div>

    <div class="main-content">
        <div class="section-block intro-box">
            <div class="intro-icon">⚙️</div>
            <h2>Pārvaldības centrs</h2>
            <p>
                Šeit iespējams ātri apskatīt kopējo recepšu, lietotāju, komentāru un kategoriju skaitu, kā arī pārvaldīt jaunākos ierakstus.
            </p>
        </div>

        <div class="section-block stats-box">
            <h3 class="section-title">📊 Kopsavilkuma statistika</h3>
            <p class="section-subtext">
                Aktuālie sistēmas dati, kas palīdz ātri novērtēt platformas saturu un aktivitāti.
            </p>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">🍽️</div>
                    <div class="stat-label">Receptes kopā</div>
                    <div class="stat-number">{{ $recipeCount }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-label">Lietotāju skaits</div>
                    <div class="stat-number">{{ $userCount }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">💬</div>
                    <div class="stat-label">Komentāri</div>
                    <div class="stat-number">{{ $commentCount }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📂</div>
                    <div class="stat-label">Kategorijas</div>
                    <div class="stat-number">{{ $categoryCount }}</div>
                </div>
            </div>
        </div>

        <div class="section-block table-box">
            <h3 class="section-title">📝 Pēdējās pievienotās receptes</h3>
            <p class="section-subtext">
                Jaunākie ieraksti sistēmā ar iespējām tos rediģēt vai dzēst.
            </p>

            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nosaukums</th>
                            <th>Kategorija</th>
                            <th>Autors</th>
                            <th>Datums</th>
                            <th>Darbības</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestRecipes as $recipe)
                            <tr>
                                <td class="recipe-title">{{ $recipe->title }}</td>
                                <td>{{ $recipe->category->name ?? 'Bez kategorijas' }}</td>
                                <td>{{ $recipe->user->name ?? 'Nezināms' }}</td>
                                <td class="muted">{{ $recipe->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="action-link edit">
                                            Rediģēt
                                        </a>

                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete">
                                                Dzēst
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        Pašlaik nav pievienota neviena recepte.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
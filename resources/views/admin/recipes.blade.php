@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Recepšu pārvaldība - Vecmāmiņas Receptes') }}
        </h2>
    </x-slot>

    <style>
        :root {
            --page-bg: #efe7dc;
            --section-bg: #f8f3ed;
            --card-bg: #fffdf9;
            --soft-bg: #f2ebe2;
            --line: #ddcfc0;
            --text: #2f241d;
            --muted: #7b6d61;
            --accent: #7a5a43;
            --accent-soft: #ebe0d2;
            --success-bg: #e8eee2;
            --success-text: #667652;
            --danger-bg: #f3e2de;
            --danger-text: #a45f52;
            --shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
        }

        .admin-recipes-page {
            background: var(--page-bg);
            min-height: 100vh;
            padding: 36px 24px 60px;
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-recipes-wrap {
            max-width: 1280px;
            margin: 0 auto;
        }

        .page-shell {
            background: var(--section-bg);
            border: 1px solid var(--line);
            padding: 36px;
            box-shadow: var(--shadow);
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 28px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 34px;
        }

        .stat-box {
            background: var(--accent-soft);
            border: 1px solid var(--line);
            padding: 24px 18px;
            text-align: center;
        }

        .stat-number {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.4rem;
            color: var(--accent);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
        }

        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
        }

        .recipe-card {
            background: var(--card-bg);
            border: 1px solid var(--line);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .recipe-header {
            padding: 26px 26px 18px;
            border-bottom: 1px solid #e8ddd1;
            background: #fcf9f4;
        }

        .recipe-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 10px;
            font-weight: 500;
            line-height: 1.2;
        }

        .recipe-description {
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        .recipe-body {
            padding: 22px 26px 24px;
        }

        .meta-table {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--soft-bg);
            margin-bottom: 18px;
        }

        .meta-row {
            display: grid;
            grid-template-columns: 140px 1fr;
            padding: 12px 14px;
            border-bottom: 1px solid #e2d6c9;
            gap: 12px;
            align-items: center;
            font-size: 14px;
        }

        .meta-row:last-child {
            border-bottom: none;
        }

        .meta-label {
            color: var(--muted);
        }

        .meta-value {
            color: var(--text);
            font-weight: 600;
            text-align: right;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border: 1px solid var(--line);
            background: #f6eee4;
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
        }

        .badge-difficulty {
            background: #f2e3df;
            color: #9f5f56;
        }

        .recipe-stats {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
        }

        .btn-success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: #d7dfcc;
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: #e3c9c2;
        }

        .btn-secondary {
            background: #f5eee5;
            color: var(--text);
        }

        .pagination-wrap {
            display: flex;
            justify-content: center;
            margin-top: 36px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }

        .empty-state {
            text-align: center;
            padding: 70px 20px;
            background: var(--card-bg);
            border: 1px solid var(--line);
        }

        .empty-state .icon {
            font-size: 4rem;
            margin-bottom: 18px;
        }

        .empty-state h3 {
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .empty-state p {
            color: var(--muted);
        }

        .quick-actions {
            margin-top: 40px;
            padding-top: 28px;
            border-top: 1px solid var(--line);
        }

        .quick-actions h3 {
            text-align: center;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--accent);
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 22px;
        }

        .quick-actions-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 1100px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .recipes-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .admin-recipes-page {
                padding: 20px 12px 40px;
            }

            .page-shell {
                padding: 20px;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .meta-row {
                grid-template-columns: 1fr;
            }

            .meta-value {
                text-align: left;
            }
        }
    </style>

    <div class="admin-recipes-page">
        <div class="admin-recipes-wrap">
            <div class="page-shell">
                <div class="breadcrumb">
                    <a href="{{ route('admin.index') }}">Admin panelis</a>
                    <span> / </span>
                    <span style="font-weight: 700; color: var(--text);">Recepšu pārvaldība</span>
                </div>

                @php
                    $categories = \App\Models\Recipe::distinct('category')->pluck('category')->filter();
                    $difficulties = \App\Models\Recipe::distinct('difficulty')->pluck('difficulty')->filter();
                @endphp

                <div class="stats-row">
                    <div class="stat-box">
                        <div class="stat-number">{{ $recipes->total() }}</div>
                        <div class="stat-label">Kopā recepšu</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $categories->count() }}</div>
                        <div class="stat-label">Kategorijas</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ $recipes->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                        <div class="stat-label">Jaunas šonedēļ</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number">{{ \App\Models\User::has('recipes')->count() }}</div>
                        <div class="stat-label">Aktīvi autori</div>
                    </div>
                </div>

                @if($recipes->count() > 0)
                    <div class="recipes-grid">
                        @foreach($recipes as $recipe)
                            <div class="recipe-card">
                                <div class="recipe-header">
                                    <h3 class="recipe-title">{{ $recipe->title }}</h3>
                                    <p class="recipe-description">
                                        {{ Str::limit($recipe->description, 100) }}
                                    </p>
                                </div>

                                <div class="recipe-body">
                                    <div class="meta-table">
                                        <div class="meta-row">
                                            <div class="meta-label">Autors</div>
                                            <div class="meta-value">{{ $recipe->user->name }}</div>
                                        </div>
                                        <div class="meta-row">
                                            <div class="meta-label">Kategorija</div>
                                            <div class="meta-value">
                                                <span class="badge">{{ $recipe->category ?? 'Nav norādīta' }}</span>
                                            </div>
                                        </div>
                                        <div class="meta-row">
                                            <div class="meta-label">Grūtība</div>
                                            <div class="meta-value">
                                                <span class="badge badge-difficulty">{{ $recipe->difficulty ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="meta-row">
                                            <div class="meta-label">Izveidots</div>
                                            <div class="meta-value">{{ $recipe->created_at->format('d.m.Y H:i') }}</div>
                                        </div>
                                    </div>

                                    <div class="recipe-stats">
                                        <span>{{ $recipe->prep_time ?? 'N/A' }} min</span>
                                        <span>{{ $recipe->servings ?? 'N/A' }} porcijas</span>
                                        <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                    </div>

                                    <div class="actions">
                                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                            Skatīt
                                        </a>

                                        @if(Auth::user()->is_admin || $recipe->user_id === Auth::id())
                                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-success">
                                                Rediģēt
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                onclick="return confirm('Vai tiešām dzēst šo recepti? Šī darbība ir neatgriezeniska!')">
                                                Dzēst
                                            </button>
                                        </form>

                                        <a href="/recipes?user={{ $recipe->user->id }}" class="btn btn-secondary">
                                            Autora receptes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrap">
                        {{ $recipes->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="icon">🍽️</div>
                        <h3>Nav recepšu</h3>
                        <p>Nav atrasta neviena recepte sistēmā.</p>
                    </div>
                @endif

                <div class="quick-actions">
                    <h3>Ātras darbības</h3>
                    <div class="quick-actions-row">
                        <a href="{{ route('admin.index') }}" class="btn btn-primary">Admin panelis</a>
                        <a href="{{ route('admin.users') }}" class="btn btn-success">Pārvaldīt lietotājus</a>
                        <a href="/recipes" class="btn btn-secondary">Skatīt visas receptes</a>
                        <a href="/dashboard" class="btn btn-secondary">Vadības panelis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
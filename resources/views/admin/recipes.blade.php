@extends('layouts.app')

@section('title', 'Recepšu pārvaldība')
@section('hero_title', 'Recepšu pārvaldība')
@section('hero_text', 'Pārskati, rediģē un uzturi visas platformas receptes vienuviet.')

@section('content')
    <style>
        .admin-recipes-page {
            color: var(--text);
        }

        .admin-recipes-stack {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

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

        .admin-breadcrumb a {
            text-decoration: none;
            color: var(--accent);
            font-weight: 700;
        }

        .admin-breadcrumb-current {
            color: var(--text);
            font-weight: 800;
        }

        .admin-section-card {
            background: rgba(255, 253, 249, 0.96);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
        }

        .admin-section-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .admin-section-title-wrap {
            max-width: 760px;
        }

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

        .admin-section-title {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.2rem;
            line-height: 1.15;
            font-weight: 500;
            color: var(--accent);
        }

        .admin-section-text {
            margin-top: 10px;
            color: var(--muted);
            line-height: 1.75;
            font-size: 15px;
        }

        .admin-header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .admin-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .admin-stat-card {
            background: linear-gradient(180deg, #f9f2ea 0%, #efe3d5 100%);
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 20px;
            padding: 22px 18px;
            text-align: center;
            transition: 0.2s ease;
            box-shadow: 0 8px 20px rgba(79, 59, 42, 0.04);
        }

        .admin-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(79, 59, 42, 0.08);
        }

        .admin-stat-card.soft-green {
            background: linear-gradient(180deg, #eef5ea 0%, #e5efdf 100%);
        }

        .admin-stat-card.soft-blue {
            background: linear-gradient(180deg, #edf4fa 0%, #e5eef7 100%);
        }

        .admin-stat-card.soft-pink {
            background: linear-gradient(180deg, #faf0f3 0%, #f5e7ec 100%);
        }

        .admin-stat-number {
            display: block;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.5rem;
            line-height: 1;
            color: var(--accent-dark);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .admin-stat-label {
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .recipe-card {
            background: #fffdf9;
            border: 1px solid rgba(122, 90, 67, 0.14);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 12px 26px rgba(79, 59, 42, 0.05);
            transition: 0.2s ease;
        }

        .recipe-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 34px rgba(79, 59, 42, 0.08);
        }

        .recipe-card-header {
            padding: 24px 24px 18px;
            background: linear-gradient(180deg, #fcf8f3 0%, #f8f0e7 100%);
            border-bottom: 1px solid rgba(221, 207, 192, 0.9);
        }

        .recipe-topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }

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

        .recipe-title {
            margin: 0 0 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            line-height: 1.15;
            color: var(--accent);
            font-weight: 500;
        }

        .recipe-description {
            color: var(--muted);
            line-height: 1.75;
            font-size: 14px;
            margin: 0;
        }

        .recipe-card-body {
            padding: 22px 24px 24px;
        }

        .recipe-meta-grid {
            display: grid;
            gap: 10px;
            margin-bottom: 18px;
        }

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

        .recipe-meta-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .recipe-meta-value {
            text-align: right;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        .recipe-meta-badges {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

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

        .recipe-badge.difficulty {
            background: #f4e4e1;
            color: #9a5e57;
        }

        .recipe-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .recipe-stat-pill {
            padding: 12px 14px;
            border-radius: 16px;
            background: linear-gradient(180deg, #fbf6ef 0%, #f5ecdf 100%);
            border: 1px solid rgba(122, 90, 67, 0.10);
            text-align: center;
        }

        .recipe-stat-label {
            display: block;
            font-size: 12px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .recipe-stat-value {
            display: block;
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .recipe-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 4px;
        }

        .recipe-actions .btn {
            flex: 1 1 140px;
        }

        .pagination-wrap {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(221, 207, 192, 0.9);
            text-align: center;
        }

        .pagination-summary {
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .pagination-wrap nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrap nav > div:first-child {
            display: none;
        }

        .pagination-wrap svg {
            width: 18px;
            height: 18px;
        }

        .pagination-wrap .relative.z-0.inline-flex.shadow-sm.rounded-md,
        .pagination-wrap .inline-flex.-space-x-px.rounded-md.shadow-sm {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            box-shadow: none !important;
        }

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

        .pagination-wrap a.relative.inline-flex.items-center:hover,
        .pagination-wrap a.inline-flex.items-center:hover {
            background: var(--surface-soft);
            color: var(--accent);
            transform: translateY(-1px);
        }

        .pagination-wrap span[aria-current="page"] > span,
        .pagination-wrap .text-white {
            background: var(--accent) !important;
            border-color: var(--accent) !important;
            color: #fffaf4 !important;
        }

        .pagination-wrap .text-gray-500,
        .pagination-wrap .text-gray-400 {
            color: var(--muted) !important;
        }

        .admin-empty-state {
            text-align: center;
            padding: 54px 24px;
            background: linear-gradient(180deg, #fbf5ee 0%, #f4eadf 100%);
            border: 1px dashed rgba(122, 90, 67, 0.24);
            border-radius: 24px;
        }

        .admin-empty-icon {
            font-size: 4rem;
            margin-bottom: 14px;
        }

        .admin-empty-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 10px;
            font-weight: 500;
        }

        .admin-empty-text {
            color: var(--muted);
            line-height: 1.75;
            max-width: 620px;
            margin: 0 auto;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

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

        .quick-action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 26px rgba(79, 59, 42, 0.08);
        }

        .quick-action-icon {
            font-size: 24px;
            display: block;
            margin-bottom: 10px;
        }

        .quick-action-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 6px;
        }

        .quick-action-text {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        @media (max-width: 1180px) {
            .admin-stats-grid,
            .quick-actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .recipes-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 760px) {
            .admin-section-card {
                padding: 20px;
                border-radius: 20px;
            }

            .admin-section-title {
                font-size: 1.8rem;
            }

            .admin-stats-grid,
            .quick-actions-grid,
            .recipe-stats {
                grid-template-columns: 1fr;
            }

            .recipe-meta-row {
                grid-template-columns: 1fr;
            }

            .recipe-meta-value {
                text-align: left;
            }

            .recipe-meta-badges {
                justify-content: flex-start;
            }

            .recipe-actions .btn {
                flex-basis: 100%;
            }
        }
    </style>

    <div class="admin-recipes-page">
        <div class="admin-recipes-stack">

            <div class="admin-breadcrumb">
                <a href="{{ route('admin.index') }}">Admin panelis</a>
                <span>/</span>
                <span class="admin-breadcrumb-current">Recepšu pārvaldība</span>
            </div>

            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Administrācija · Receptes</div>
                        <h2 class="admin-section-title">Pārskats par visām receptēm</h2>
                        <p class="admin-section-text">
                            Šeit vari apskatīt platformā publicētās receptes, pārbaudīt autorus,
                            rediģēt saturu un dzēst ierakstus, ja tas ir nepieciešams.
                        </p>
                    </div>

                    <div class="admin-header-actions">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Atpakaļ uz admin paneli</a>
                        <a href="{{ route('recipes.index') }}" class="btn btn-primary">Skatīt publisko sarakstu</a>
                    </div>
                </div>

                <div class="admin-stats-grid">
                    <div class="admin-stat-card">
                        <span class="admin-stat-number">{{ $recipesCount }}</span>
                        <span class="admin-stat-label">Kopā receptes</span>
                    </div>

                    <div class="admin-stat-card soft-green">
                        <span class="admin-stat-number">{{ $categoriesCount }}</span>
                        <span class="admin-stat-label">Kategorijas</span>
                    </div>

                    <div class="admin-stat-card soft-blue">
                        <span class="admin-stat-number">{{ $newRecipesThisWeekCount }}</span>
                        <span class="admin-stat-label">Jaunas šonedēļ</span>
                    </div>

                    <div class="admin-stat-card soft-pink">
                        <span class="admin-stat-number">{{ $activeAuthorsCount }}</span>
                        <span class="admin-stat-label">Aktīvie autori</span>
                    </div>
                </div>
            </div>

            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Satura pārvaldība</div>
                        <h2 class="admin-section-title">Recepšu saraksts</h2>
                        <p class="admin-section-text">
                            Šajā sadaļā vari pārskatīt receptes pa vienai, redzēt to pamata datus
                            un veikt nepieciešamās darbības.
                        </p>
                    </div>
                </div>

                @if($recipes->count() > 0)
                    <div class="recipes-grid">
                        @foreach($recipes as $recipe)
                            <div class="recipe-card">
                                <div class="recipe-card-header">
                                    <div class="recipe-topline">
                                        <span class="recipe-created">🕒 {{ $recipe->created_at->diffForHumans() }}</span>

                                        @if(!empty($recipe->category))
                                            <span class="recipe-badge">{{ $recipe->category }}</span>
                                        @endif
                                    </div>

                                    <h3 class="recipe-title">{{ $recipe->title }}</h3>

                                    <p class="recipe-description">
                                        {{ \Illuminate\Support\Str::limit($recipe->description, 120) }}
                                    </p>
                                </div>

                                <div class="recipe-card-body">
                                    <div class="recipe-meta-grid">
                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Autors</div>
                                            <div class="recipe-meta-value">{{ $recipe->user->name ?? 'Nav norādīts' }}</div>
                                        </div>

                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Kategorija</div>
                                            <div class="recipe-meta-value">
                                                <div class="recipe-meta-badges">
                                                    <span class="recipe-badge">{{ $recipe->category ?? 'Nav norādīta' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Grūtība</div>
                                            <div class="recipe-meta-value">
                                                <div class="recipe-meta-badges">
                                                    <span class="recipe-badge difficulty">{{ $recipe->difficulty ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="recipe-meta-row">
                                            <div class="recipe-meta-label">Izveidots</div>
                                            <div class="recipe-meta-value">{{ $recipe->created_at->format('d.m.Y H:i') }}</div>
                                        </div>
                                    </div>

                                    <div class="recipe-stats">
                                        <div class="recipe-stat-pill">
                                            <span class="recipe-stat-label">Sagatavošana</span>
                                            <span class="recipe-stat-value">{{ $recipe->prep_time ?? 'N/A' }} min</span>
                                        </div>

                                        <div class="recipe-stat-pill">
                                            <span class="recipe-stat-label">Porcijas</span>
                                            <span class="recipe-stat-value">{{ $recipe->servings ?? 'N/A' }}</span>
                                        </div>

                                        <div class="recipe-stat-pill">
                                            <span class="recipe-stat-label">Publicēta</span>
                                            <span class="recipe-stat-value">{{ $recipe->created_at->format('d.m.Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="recipe-actions">
                                        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                            Skatīt
                                        </a>

                                        @if(Auth::user()->is_admin || $recipe->user_id === Auth::id())
                                            <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-success">
                                                Rediģēt
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}" style="display: inline; flex: 1 1 140px;">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                style="width: 100%;"
                                                onclick="return confirm('Vai tiešām dzēst šo recepti? Šī darbība ir neatgriezeniska!')">
                                                Dzēst
                                            </button>
                                        </form>

                                        <a href="{{ route('recipes.index', ['user' => $recipe->user->id]) }}" class="btn btn-secondary">
                                            Autora receptes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($recipes->hasPages())
                        <div class="pagination-wrap">
                            <div class="pagination-summary">
                                Rāda {{ $recipes->firstItem() }}–{{ $recipes->lastItem() }} no {{ $recipes->total() }} receptēm
                            </div>

                            {{ $recipes->links() }}
                        </div>
                    @endif
                @else
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

            <div class="admin-section-card">
                <div class="admin-section-head">
                    <div class="admin-section-title-wrap">
                        <div class="admin-section-kicker">Ātrās darbības</div>
                        <h2 class="admin-section-title">Noderīgas saites</h2>
                        <p class="admin-section-text">
                            Ātra piekļuve svarīgākajām administrācijas un platformas sadaļām.
                        </p>
                    </div>
                </div>

                <div class="quick-actions-grid">
                    <a href="{{ route('admin.index') }}" class="quick-action-card">
                        <span class="quick-action-icon">🏠</span>
                        <div class="quick-action-title">Admin panelis</div>
                        <div class="quick-action-text">Atgriezties uz galveno administrācijas pārskatu.</div>
                    </a>

                    <a href="{{ route('admin.users') }}" class="quick-action-card">
                        <span class="quick-action-icon">👤</span>
                        <div class="quick-action-title">Pārvaldīt lietotājus</div>
                        <div class="quick-action-text">Skatīt lietotājus, viņu statusus un aktivitāti.</div>
                    </a>

                    <a href="{{ route('recipes.index') }}" class="quick-action-card">
                        <span class="quick-action-icon">📖</span>
                        <div class="quick-action-title">Visas receptes</div>
                        <div class="quick-action-text">Atvērt publisko recepšu sarakstu lietotāju skatā.</div>
                    </a>

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
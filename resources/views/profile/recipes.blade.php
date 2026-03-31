@extends('layouts.app')

@section('title', 'Manas receptes - Vecmāmiņas Receptes')
@section('meta_description', 'Pārvaldi visas savas izveidotās receptes, rediģē tās un pievieno jaunas Vecmāmiņas Receptes profilā.')

@section('hero_title', 'Manas receptes')
@section('hero_text', 'Pārvaldi savas izveidotās receptes un papildini savu kolekciju')

@section('content')
<style>
    .my-recipes-page {
        color: var(--text);
    }

    .section-wrap {
        background: rgba(255, 253, 249, 0.78);
        border: 1px solid var(--line);
        box-shadow: var(--shadow);
        padding: 34px;
    }

    .section-block + .section-block {
        margin-top: 28px;
    }

    .profile-intro {
        background: var(--surface);
        border: 1px solid var(--line);
        padding: 30px;
        text-align: center;
    }

    .profile-icon {
        font-size: 3.5rem;
        margin-bottom: 16px;
    }

    .profile-intro h2 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.3rem;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .profile-intro p {
        color: var(--muted);
        line-height: 1.8;
        max-width: 760px;
        margin: 0 auto;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--line);
        padding: 24px;
        text-align: center;
    }

    .stat-number {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.6rem;
        color: var(--accent);
        margin-bottom: 8px;
        line-height: 1;
    }

    .stat-label {
        color: var(--muted);
        font-size: 14px;
        font-weight: 600;
    }

    .actions-bar {
        text-align: center;
    }

    .actions-row {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .recipe-card {
        background: var(--surface);
        border: 1px solid var(--line);
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(79, 59, 42, 0.05);
    }

    .recipe-top {
        padding: 24px 24px 16px;
        border-bottom: 1px solid #e8ddd1;
        background: #fcf9f4;
    }

    .recipe-title {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 1.8rem;
        line-height: 1.2;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .recipe-desc {
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
    }

    .recipe-body {
        padding: 20px 24px 24px;
    }

    .recipe-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
        color: var(--muted);
        font-size: 14px;
    }

    .recipe-footer {
        border-top: 1px solid var(--line);
        padding-top: 14px;
        margin-bottom: 18px;
        text-align: center;
        font-size: 13px;
        color: var(--muted);
    }

    .recipe-actions {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 8px;
    }

    .recipe-actions form {
        margin: 0;
    }

    .recipe-actions .btn,
    .recipe-actions button {
        width: 100%;
        padding: 10px;
        font-size: 13px;
    }

    .pagination-wrap {
        margin-top: 36px;
        padding-top: 24px;
        border-top: 1px solid var(--line);
        display: flex;
        justify-content: center;
    }

    .empty-state {
        text-align: center;
        padding: 70px 20px;
        background: var(--surface);
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
        margin-bottom: 12px;
        font-weight: 500;
    }

    .empty-state p {
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 26px;
        max-width: 760px;
        margin-left: auto;
        margin-right: auto;
    }

    .tips-box {
        background: var(--surface);
        border: 1px solid var(--line);
        padding: 28px;
    }

    .tips-box h3 {
        text-align: center;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2rem;
        margin-bottom: 24px;
        font-weight: 500;
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 18px;
    }

    .tip-card {
        border: 1px solid var(--line);
        padding: 20px;
        background: var(--surface-soft);
    }

    .tip-card h4 {
        color: var(--accent);
        margin-bottom: 10px;
        font-size: 16px;
    }

    .tip-card p {
        color: var(--muted);
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 900px) {
        .section-wrap {
            padding: 24px;
        }
    }

    @media (max-width: 640px) {
        .section-wrap {
            padding: 20px;
        }

        .recipes-grid {
            grid-template-columns: 1fr;
        }

        .recipe-actions {
            grid-template-columns: 1fr;
        }

        .recipe-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="my-recipes-page">
    <div class="section-wrap">

        <div class="section-block profile-intro">
            <div class="profile-icon">👨‍🍳</div>
            <h2>{{ Auth::user()->name }} kulinārais profils</h2>
            <p>
                Šeit ir visas jūsu izveidotās receptes. Pārvaldiet savu kolekciju, atjauniniet esošās receptes
                un dalieties ar saviem kulinārijas meistardarbiem.
            </p>
        </div>

        <div class="section-block stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ method_exists($recipes, 'total') ? $recipes->total() : $recipes->count() }}</div>
                <div class="stat-label">Kopā receptes</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">
                    {{ $recipes->filter(function($recipe) { return $recipe->created_at && $recipe->created_at >= now()->subDays(30); })->count() }}
                </div>
                <div class="stat-label">Šajā mēnesī</div>
            </div>

            <div class="stat-card">
                <div class="stat-number">
                    {{ $recipes->filter(function($recipe) { return !empty($recipe->category_id) || !empty($recipe->category); })->unique('category_id')->count() }}
                </div>
                <div class="stat-label">Kategorijas</div>
            </div>
        </div>

        <div class="section-block actions-bar">
            <div class="actions-row">
                <a href="{{ route('recipes.create') }}" class="btn btn-success">
                    Izveidot jaunu recepti
                </a>
                <a href="/recipes" class="btn btn-primary">
                    Pārlūkot visas receptes
                </a>
            </div>
        </div>

        @if($recipes->count() > 0)
            <div class="section-block">
                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <div class="recipe-top">
                                <h3 class="recipe-title">{{ $recipe->title }}</h3>
                                <p class="recipe-desc">{{ Str::limit($recipe->description, 100) }}</p>
                            </div>

                            <div class="recipe-body">
                                <div class="recipe-info-grid">
                                    <div>📂 {{ $recipe->category->name ?? $recipe->category ?? 'Nav kategorijas' }}</div>
                                    <div>⭐ {{ $recipe->difficulty ?? 'Nav norādīta' }}</div>

                                    @if($recipe->prep_time || $recipe->cook_time)
                                        <div>⏱️ {{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} min</div>
                                    @endif

                                    @if($recipe->servings)
                                        <div>👥 {{ $recipe->servings }} porcijas</div>
                                    @endif
                                </div>

                                <div class="recipe-footer">
                                    Izveidots: {{ $recipe->created_at ? $recipe->created_at->format('d.m.Y H:i') : '-' }}
                                </div>

                                <div class="recipe-actions">
                                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                        Skatīt
                                    </a>

                                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning">
                                        Rediģēt
                                    </a>

                                    <form method="POST" action="{{ route('recipes.destroy', $recipe) }}"
                                          onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Dzēst
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $recipes->links() }}
                </div>
            </div>
        @else
            <div class="section-block empty-state">
                <div class="icon">📝</div>
                <h3>Jūs vēl neesat izveidojis nevienu recepti</h3>
                <p>
                    Sāciet savu kulinārijas ceļojumu, izveidojot savu pirmo recepti un papildinot savu personīgo recepšu kolekciju.
                </p>
                <a href="{{ route('recipes.create') }}" class="btn btn-success">
                    Izveidot pirmo recepti
                </a>
            </div>
        @endif

        @if((method_exists($recipes, 'total') ? $recipes->total() : $recipes->count()) < 5)
            <div class="section-block tips-box">
                <h3>Padomi recepšu izveidošanai</h3>
                <div class="tips-grid">
                    <div class="tip-card">
                        <h4>📸 Pievienojiet fotogrāfijas</h4>
                        <p>Vizuāli pievilcīgas fotogrāfijas palīdz receptei izskatīties daudz pievilcīgākai un noderīgākai.</p>
                    </div>

                    <div class="tip-card">
                        <h4>📝 Detalizēti apraksti</h4>
                        <p>Iekļaujiet precīzas sastāvdaļas un skaidras instrukcijas, lai citiem būtu viegli recepti atkārtot.</p>
                    </div>

                    <div class="tip-card">
                        <h4>⏱️ Norādiet laikus</h4>
                        <p>Precīzs sagatavošanas un gatavošanas laiks palīdz citiem labāk plānot maltītes pagatavošanu.</p>
                    </div>

                    <div class="tip-card">
                        <h4>💡 Pievienojiet savu stāstu</h4>
                        <p>Īss personīgs komentārs vai pasniegšanas ieteikums padara recepti daudz interesantāku citiem.</p>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
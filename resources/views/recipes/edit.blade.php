@extends('layouts.app')

@section('title', 'Rediģēt recepti - Vecmāmiņas Receptes')
@section('hero_title', 'Rediģēt recepti')
@section('hero_text', 'Atjauniniet recepti, uzlabojiet detaļas un papildiniet saturu')

@section('content')
@php
    $oldNames = old('ingredient_name');
    $oldQtys  = old('ingredient_qty');
    $oldUnits = old('ingredient_unit');
    $useOld = is_array($oldNames) || is_array($oldQtys) || is_array($oldUnits);

    $ingredientsRel = $recipe->ingredientsItems ?? collect();

    $selectedCategory = old('category', $recipe->category->name ?? $recipe->category ?? '');
@endphp

<style>
    .edit-recipe-page {
        color: var(--text);
    }

    .edit-recipe-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .edit-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .edit-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .edit-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .edit-hero-icon-wrap {
        width: 108px;
        height: 108px;
        border-radius: 50%;
        background: linear-gradient(135deg, #efe3d5 0%, #e7d5c3 100%);
        border: 4px solid #f0e5d8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.8rem;
        box-shadow: 0 10px 24px rgba(122, 90, 67, 0.12);
        flex-shrink: 0;
    }

    .edit-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid rgba(122, 90, 67, 0.12);
        background: #f5ece2;
        color: var(--accent);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .edit-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
    }

    .edit-main-text {
        color: var(--muted);
        line-height: 1.85;
        font-size: 14px;
        max-width: 760px;
    }

    .error-summary {
        padding: 20px 22px;
        border: 1px solid #e7cfc9;
        border-radius: 20px;
        background: linear-gradient(180deg, #fcf2ef 0%, #f8ebe7 100%);
        color: var(--danger-text);
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .error-summary h4 {
        margin-bottom: 12px;
        font-size: 16px;
    }

    .error-summary ul {
        margin-left: 20px;
        line-height: 1.7;
    }

    .form-section-head {
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(221, 207, 192, 0.9);
    }

    .section-kicker {
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

    .section-title {
        color: var(--accent);
        margin-bottom: 8px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
        line-height: 1.1;
    }

    .section-subtext {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
        max-width: 760px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: var(--text);
        font-size: 14px;
    }

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

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #b79d84;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(122, 90, 67, 0.10);
    }

    .form-textarea {
        min-height: 140px;
        resize: vertical;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .help-text {
        color: var(--muted);
        margin-top: 7px;
        display: block;
        font-size: 13px;
        line-height: 1.6;
    }

    .field-error {
        margin-top: 7px;
        color: var(--danger-text);
        font-size: 13px;
        line-height: 1.5;
        font-weight: 600;
    }

    .form-input.is-invalid,
    .form-textarea.is-invalid,
    .form-select.is-invalid {
        border-color: #e7cfc9;
        background: #fff7f6;
    }

    .ingredients-wrap {
        display: grid;
        gap: 12px;
    }

    .ingredient-item {
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        padding: 14px;
    }

    .ing-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .ing-row.has-error {
        padding: 0;
        border: none;
        background: transparent;
    }

    .ing-qty {
        width: 130px;
    }

    .ing-unit {
        width: 160px;
    }

    .ing-name {
        flex: 1;
        min-width: 220px;
    }

    .ing-errors {
        margin-top: 8px;
    }

    .current-media-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 20px;
    }

    .current-media-box,
    .media-box,
    .meta-box {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        padding: 18px;
    }

    .current-media-title,
    .meta-title {
        color: var(--accent);
        font-weight: 800;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .media-preview-img {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        display: block;
        margin-top: 10px;
        border: 1px solid var(--line);
        border-radius: 14px;
    }

    .media-preview-video {
        width: 100%;
        display: block;
        margin-top: 10px;
        border: 1px solid var(--line);
        border-radius: 14px;
        overflow: hidden;
    }

    .pill {
        display: inline-flex;
        align-items: center;
        padding: 7px 12px;
        background: var(--info-bg);
        color: var(--info-text);
        font-weight: 700;
        font-size: 12px;
        border: 1px solid var(--line);
        border-radius: 999px;
        margin-top: 8px;
    }

    .meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        font-size: 14px;
        color: var(--muted);
        line-height: 1.7;
    }

    .actions-card {
        text-align: center;
    }

    .actions-row {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 4px;
    }

    .delete-card {
        background: linear-gradient(180deg, #fcf2ef 0%, #f8ebe7 100%);
        border-color: #e7d0ca;
    }

    .delete-head {
        margin-bottom: 18px;
    }

    .delete-title {
        color: var(--danger-text);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2rem;
        font-weight: 500;
        margin-bottom: 8px;
        line-height: 1.1;
    }

    .delete-text {
        color: var(--muted);
        line-height: 1.75;
        font-size: 14px;
        max-width: 760px;
    }

    .delete-row {
        display: flex;
        justify-content: center;
        margin-top: 6px;
    }

    .tips-box h3 {
        text-align: center;
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2rem;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .tips-subtitle {
        text-align: center;
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
    }

    .tip-card {
        border: 1px solid rgba(122, 90, 67, 0.12);
        border-radius: 18px;
        padding: 20px;
        background: linear-gradient(180deg, #fcf8f3 0%, #f6ede3 100%);
        text-align: center;
        box-shadow: 0 8px 18px rgba(79, 59, 42, 0.04);
    }

    .tip-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .tip-card h5 {
        color: var(--accent);
        margin-bottom: 8px;
        font-size: 15px;
    }

    .tip-card p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    @media (max-width: 900px) {
        .edit-section-card {
            padding: 22px;
        }

        .edit-hero-inner,
        .form-row,
        .current-media-grid {
            grid-template-columns: 1fr;
        }

        .edit-hero-icon-wrap {
            width: 92px;
            height: 92px;
            font-size: 2.4rem;
        }
    }

    @media (max-width: 640px) {
        .edit-section-card {
            padding: 20px;
        }

        .ing-row {
            flex-direction: column;
            align-items: stretch;
        }

        .ing-qty,
        .ing-unit,
        .ing-name {
            width: 100%;
            min-width: unset;
        }

        .actions-row {
            flex-direction: column;
        }

        .actions-row .btn,
        .actions-row button,
        .delete-row .btn,
        .delete-row button {
            width: 100%;
        }

        .edit-main-title {
            font-size: 2rem;
        }
    }
</style>

<div class="edit-recipe-page">
    <div class="edit-recipe-stack">

        <div class="edit-section-card edit-hero-card">
            <div class="edit-hero-inner">
                <div class="edit-hero-icon-wrap">✏️</div>

                <div>
                    <div class="edit-badge">Rediģēšana</div>
                    <h2 class="edit-main-title">Uzlabojiet savu recepti</h2>
                    <p class="edit-main-text">
                        Atjauniniet informāciju, pievienojiet precizējumus, uzlabojiet instrukcijas
                        un nomainiet attēlu vai video, ja tas ir nepieciešams.
                    </p>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="error-summary">
                <h4>Lūdzu, izlabojiet šādas kļūdas:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="edit-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">1. Pamata informācija</div>
                    <h3 class="section-title">Receptes apraksts</h3>
                    <p class="section-subtext">
                        Atjauniniet receptes nosaukumu, kategoriju, grūtības līmeni un aprakstu,
                        lai saturs būtu skaidrs, pievilcīgs un pārskatāms.
                    </p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="title">Receptes nosaukums</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $recipe->title) }}"
                        class="form-input @error('title') is-invalid @enderror"
                        placeholder="Piemēram: Mājas biezpiens ar ievārījumu"
                        required
                    >
                    @error('title')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Apraksts</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-textarea @error('description') is-invalid @enderror"
                        placeholder="Īss apraksts par recepti - kas padara to īpašu?"
                        required
                    >{{ old('description', $recipe->description) }}</textarea>
                    @error('description')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Kategorija</label>
                        <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">Izvēlieties kategoriju</option>
                            <option value="Brokastis" {{ $selectedCategory == 'Brokastis' ? 'selected' : '' }}>Brokastis</option>
                            <option value="Pusdienas" {{ $selectedCategory == 'Pusdienas' ? 'selected' : '' }}>Pusdienas</option>
                            <option value="Vakariņas" {{ $selectedCategory == 'Vakariņas' ? 'selected' : '' }}>Vakariņas</option>
                            <option value="Deserti" {{ $selectedCategory == 'Deserti' ? 'selected' : '' }}>Deserti</option>
                            <option value="Uzkodas" {{ $selectedCategory == 'Uzkodas' ? 'selected' : '' }}>Uzkodas</option>
                            <option value="Dzērieni" {{ $selectedCategory == 'Dzērieni' ? 'selected' : '' }}>Dzērieni</option>
                            <option value="Salāti" {{ $selectedCategory == 'Salāti' ? 'selected' : '' }}>Salāti</option>
                            <option value="Zupas" {{ $selectedCategory == 'Zupas' ? 'selected' : '' }}>Zupas</option>
                            <option value="Veģetārās" {{ $selectedCategory == 'Veģetārās' ? 'selected' : '' }}>Veģetārās</option>
                            <option value="Vegānās" {{ $selectedCategory == 'Vegānās' ? 'selected' : '' }}>Vegānās</option>
                            <option value="Bezglutēna" {{ $selectedCategory == 'Bezglutēna' ? 'selected' : '' }}>Bezglutēna</option>
                            <option value="Ātras receptes" {{ $selectedCategory == 'Ātras receptes' ? 'selected' : '' }}>Ātras receptes</option>
                        </select>
                        @error('category')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="difficulty">Grūtības līmenis</label>
                        <select id="difficulty" name="difficulty" class="form-select @error('difficulty') is-invalid @enderror" required>
                            <option value="">Izvēlieties grūtību</option>
                            <option value="Viegla" {{ old('difficulty', $recipe->difficulty) == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                            <option value="Vidēja" {{ old('difficulty', $recipe->difficulty) == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                            <option value="Grūta" {{ old('difficulty', $recipe->difficulty) == 'Grūta' ? 'selected' : '' }}>Grūta</option>
                        </select>
                        @error('difficulty')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="edit-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">2. Laiks un porcijas</div>
                    <h3 class="section-title">Gatavošanas informācija</h3>
                    <p class="section-subtext">
                        Atjauniniet laiku un porciju skaitu, lai recepte citiem būtu ērtāk izmantojama.
                    </p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="prep_time">Sagatavošanas laiks (minūtēs)</label>
                        <input
                            type="number"
                            id="prep_time"
                            name="prep_time"
                            value="{{ old('prep_time', $recipe->prep_time) }}"
                            class="form-input @error('prep_time') is-invalid @enderror"
                            placeholder="15"
                            min="0"
                        >
                        @error('prep_time')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cook_time">Gatavošanas laiks (minūtēs)</label>
                        <input
                            type="number"
                            id="cook_time"
                            name="cook_time"
                            value="{{ old('cook_time', $recipe->cook_time) }}"
                            class="form-input @error('cook_time') is-invalid @enderror"
                            placeholder="30"
                            min="0"
                        >
                        @error('cook_time')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="servings">Porciju skaits</label>
                    <input
                        type="number"
                        id="servings"
                        name="servings"
                        value="{{ old('servings', $recipe->servings) }}"
                        class="form-input @error('servings') is-invalid @enderror"
                        placeholder="4"
                        min="1"
                    >
                    @error('servings')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="edit-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">3. Sastāvdaļas</div>
                    <h3 class="section-title">Sastāvdaļu saraksts</h3>
                    <p class="section-subtext">
                        Rediģējiet sastāvdaļu sarakstu ar daudzumu, mērvienību un nosaukumu.
                    </p>
                </div>

                <div class="form-group">
                    <label class="form-label">Sastāvdaļas</label>

                    <div id="ingredientsWrap" class="ingredients-wrap">
                        @if($useOld)
                            @php
                                $names = is_array($oldNames) ? $oldNames : [];
                                $qtys  = is_array($oldQtys) ? $oldQtys : [];
                                $units = is_array($oldUnits) ? $oldUnits : [];
                                $rows = max(count($names), count($qtys), count($units));
                                if($rows < 1) $rows = 1;
                            @endphp

                            @for($i = 0; $i < $rows; $i++)
                                <div class="ingredient-item">
                                    <div class="ing-row {{ $errors->has('ingredient_name.' . $i) || $errors->has('ingredient_qty.' . $i) || $errors->has('ingredient_unit.' . $i) ? 'has-error' : '' }}">
                                        <input class="form-input ing-qty @error('ingredient_qty.' . $i) is-invalid @enderror" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                               value="{{ $qtys[$i] ?? '' }}" placeholder="Daudzums">
                                        <input class="form-input ing-unit @error('ingredient_unit.' . $i) is-invalid @enderror" name="ingredient_unit[]" type="text"
                                               value="{{ $units[$i] ?? '' }}" placeholder="Mērv. (g, ml, gab)">
                                        <input class="form-input ing-name @error('ingredient_name.' . $i) is-invalid @enderror" name="ingredient_name[]" type="text" required
                                               value="{{ $names[$i] ?? '' }}" placeholder="Sastāvdaļa">
                                        <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
                                    </div>

                                    <div class="ing-errors">
                                        @error('ingredient_qty.' . $i)
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                        @error('ingredient_unit.' . $i)
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                        @error('ingredient_name.' . $i)
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endfor

                        @elseif($ingredientsRel instanceof \Illuminate\Support\Collection && $ingredientsRel->count() > 0)
                            @foreach($ingredientsRel as $i => $ing)
                                <div class="ingredient-item">
                                    <div class="ing-row {{ $errors->has('ingredient_name.' . $i) || $errors->has('ingredient_qty.' . $i) || $errors->has('ingredient_unit.' . $i) ? 'has-error' : '' }}">
                                        <input class="form-input ing-qty @error('ingredient_qty.' . $i) is-invalid @enderror" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                               value="{{ old('ingredient_qty.' . $i, is_null($ing->quantity) ? '' : (float) $ing->quantity) }}" placeholder="Daudzums">
                                        <input class="form-input ing-unit @error('ingredient_unit.' . $i) is-invalid @enderror" name="ingredient_unit[]" type="text"
                                               value="{{ old('ingredient_unit.' . $i, $ing->unit) }}" placeholder="Mērv. (g, ml, gab)">
                                        <input class="form-input ing-name @error('ingredient_name.' . $i) is-invalid @enderror" name="ingredient_name[]" type="text" required
                                               value="{{ old('ingredient_name.' . $i, $ing->name) }}" placeholder="Sastāvdaļa">
                                        <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
                                    </div>

                                    <div class="ing-errors">
                                        @error('ingredient_qty.' . $i)
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                        @error('ingredient_unit.' . $i)
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                        @error('ingredient_name.' . $i)
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                        @else
                            <div class="ingredient-item">
                                <div class="ing-row {{ $errors->has('ingredient_name.0') || $errors->has('ingredient_qty.0') || $errors->has('ingredient_unit.0') ? 'has-error' : '' }}">
                                    <input class="form-input ing-qty @error('ingredient_qty.0') is-invalid @enderror" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                           value="{{ old('ingredient_qty.0') }}" placeholder="Daudzums">
                                    <input class="form-input ing-unit @error('ingredient_unit.0') is-invalid @enderror" name="ingredient_unit[]" type="text"
                                           value="{{ old('ingredient_unit.0') }}" placeholder="Mērv. (g, ml, gab)">
                                    <input class="form-input ing-name @error('ingredient_name.0') is-invalid @enderror" name="ingredient_name[]" type="text" required
                                           value="{{ old('ingredient_name.0') }}" placeholder="Sastāvdaļa">
                                    <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
                                </div>

                                <div class="ing-errors">
                                    @error('ingredient_qty.0')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                    @error('ingredient_unit.0')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                    @error('ingredient_name.0')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>

                    @error('ingredient_name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror

                    <button type="button" class="btn btn-success" onclick="addIngRow()" style="margin-top: 12px;">
                        Pievienot sastāvdaļu
                    </button>
                </div>
            </div>

            <div class="edit-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">4. Pagatavošana</div>
                    <h3 class="section-title">Gatavošanas instrukcijas</h3>
                    <p class="section-subtext">
                        Aprakstiet vai precizējiet pagatavošanas procesu soli pa solim.
                    </p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="instructions">Soli pa solim instrukcijas</label>
                    <textarea
                        id="instructions"
                        name="instructions"
                        class="form-textarea @error('instructions') is-invalid @enderror"
                        style="min-height: 300px;"
                        placeholder="Aprakstiet gatavošanas procesu soli pa solim..."
                        required
                    >{{ old('instructions', $recipe->instructions) }}</textarea>
                    <small class="help-text">
                        Iekļaujiet temperatūras, laikus un īpašus paņēmienus, ja tie ir svarīgi.
                    </small>
                    @error('instructions')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="edit-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">5. Attēli un video</div>
                    <h3 class="section-title">Esošais un jaunais saturs</h3>
                    <p class="section-subtext">
                        Vari paturēt esošos failus vai aizvietot tos ar jauniem.
                    </p>
                </div>

                <div class="current-media-grid">
                    <div class="current-media-box">
                        <div class="current-media-title">Esošais attēls</div>
                        @if($recipe->image_path)
                            <span class="pill">Attēls</span>
                            <img src="{{ asset('storage/' . $recipe->image_path) }}" class="media-preview-img" alt="Pašreizējais attēls">
                        @else
                            <div style="margin-top: 8px; color: var(--muted);">Nav attēla</div>
                        @endif
                    </div>

                    <div class="current-media-box">
                        <div class="current-media-title">Esošais video</div>
                        @if($recipe->video_path)
                            <span class="pill">Video</span>
                            <video controls class="media-preview-video">
                                <source src="{{ asset('storage/' . $recipe->video_path) }}">
                            </video>
                        @else
                            <div style="margin-top: 8px; color: var(--muted);">Nav video</div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="media-box">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" for="image">Nomainīt attēlu</label>
                            <input id="image" type="file" name="image" accept="image/*" class="form-input @error('image') is-invalid @enderror">
                            <small class="help-text">Ja izvēlies jaunu failu, tas aizstās esošo attēlu.</small>
                            @error('image')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="media-box">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" for="video">Nomainīt video</label>
                            <input id="video" type="file" name="video" accept="video/*" class="form-input @error('video') is-invalid @enderror">
                            <small class="help-text">Ja izvēlies jaunu video failu, tas aizstās esošo video.</small>
                            @error('video')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <span class="pill">Vari atstāt laukus tukšus, ja negribi mainīt attēlu vai video.</span>
            </div>

            <div class="edit-section-card meta-box">
                <div class="meta-title">Receptes informācija</div>
                <div class="meta-row">
                    <span>Recepte izveidota: {{ $recipe->created_at->format('d.m.Y H:i') }}</span>
                    <span>Pēdējās izmaiņas: {{ $recipe->updated_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>

            <div class="edit-section-card actions-card">
                <div class="actions-row">
                    <button type="submit" class="btn btn-success">
                        Saglabāt izmaiņas
                    </button>
                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-warning">
                        Atcelt
                    </a>
                </div>
            </div>
        </form>

        <div class="edit-section-card delete-card">
            <div class="delete-head">
                <div class="section-kicker">Bīstamā zona</div>
                <h3 class="delete-title">Dzēst recepti</h3>
                <p class="delete-text">
                    Ja vairs nevēlaties saglabāt šo recepti, to var pilnībā dzēst. Šo darbību nevar atsaukt.
                </p>
            </div>

            <div class="delete-row">
                <form method="POST" action="{{ route('recipes.destroy', $recipe) }}"
                      onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti? Šo darbību nevar atsaukt.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Dzēst recepti
                    </button>
                </form>
            </div>
        </div>

        <div class="edit-section-card tips-box">
            <h3>Padomi recepšu uzlabošanai</h3>
            <p class="tips-subtitle">
                Daži vienkārši ieteikumi, lai tava recepte kļūtu vēl skaidrāka, kvalitatīvāka un noderīgāka citiem.
            </p>

            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">📝</div>
                    <h5>Regulāri atjauniniet</h5>
                    <p>Uzlabojiet receptes, balstoties uz atsauksmēm un savu pieredzi gatavošanas procesā.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">🎯</div>
                    <h5>Precizējiet detaļas</h5>
                    <p>Pievienojiet temperatūras, laikus un nianses, kas palīdzēs citiem recepti veiksmīgi atkārtot.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">💬</div>
                    <h5>Pievienojiet padomus</h5>
                    <p>Dalieties ar saviem īpašajiem trikiem, alternatīvām sastāvdaļām vai pasniegšanas idejām.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function addIngRow() {
    const wrap = document.getElementById('ingredientsWrap');
    const rowIndex = wrap.querySelectorAll('.ingredient-item').length;

    const item = document.createElement('div');
    item.className = 'ingredient-item';
    item.innerHTML = `
        <div class="ing-row">
            <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0" value="" placeholder="Daudzums">
            <input class="form-input ing-unit" name="ingredient_unit[]" type="text" value="" placeholder="Mērv. (g, ml, gab)">
            <input class="form-input ing-name" name="ingredient_name[]" type="text" required value="" placeholder="Sastāvdaļa">
            <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
        </div>
        <div class="ing-errors" data-index="${rowIndex}"></div>
    `;
    wrap.appendChild(item);
}

function removeIngRow(btn) {
    const wrap = document.getElementById('ingredientsWrap');
    const rows = wrap.querySelectorAll('.ingredient-item');
    if (rows.length <= 1) return;
    const row = btn.closest('.ingredient-item');
    if (row) row.remove();
}
</script>
@endsection
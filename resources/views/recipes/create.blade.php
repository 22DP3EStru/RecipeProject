@extends('layouts.app')

@section('title', 'Izveidot recepti - Vecmāmiņas Receptes')
@section('meta_description', 'Pievienojiet jaunu recepti, aprakstiet sastāvdaļas, instrukcijas un dalieties ar savu kulināro pieredzi Vecmāmiņas Receptes platformā.')

@section('hero_title', 'Izveidot recepti')
@section('hero_text', 'Dalieties ar savu kulināro pieredzi un pievienojiet jaunu recepti')

@section('content')
@php
    $oldNames = old('ingredient_name');
    $oldQtys  = old('ingredient_qty');
    $oldUnits = old('ingredient_unit');
    $useOld = is_array($oldNames) || is_array($oldQtys) || is_array($oldUnits);
@endphp

<style>
    .create-recipe-page {
        color: var(--text);
    }

    .create-recipe-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .create-section-card {
        background: rgba(255, 253, 249, 0.96);
        border: 1px solid rgba(122, 90, 67, 0.14);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(79, 59, 42, 0.06);
    }

    .create-hero-card {
        background: linear-gradient(180deg, #fffdf9 0%, #fbf5ee 100%);
        overflow: hidden;
    }

    .create-hero-inner {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .create-hero-icon-wrap {
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

    .create-badge {
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

    .create-main-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.55rem;
        font-weight: 500;
        color: var(--accent);
        margin: 0 0 10px;
        line-height: 1.08;
    }

    .create-main-text {
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

    .time-summary-card {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        padding: 18px;
        margin-top: 10px;
    }

    .time-summary-title {
        color: var(--accent);
        font-weight: 800;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .note-pill {
        display: inline-flex;
        align-items: center;
        padding: 7px 12px;
        background: #f2e7da;
        color: #7a5a43;
        font-weight: 700;
        font-size: 12px;
        border: 1px solid var(--line);
        border-radius: 999px;
        margin-top: 10px;
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

    .media-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .media-box {
        background: linear-gradient(180deg, #faf4ed 0%, #f4eadf 100%);
        border: 1px solid rgba(122, 90, 67, 0.10);
        border-radius: 18px;
        padding: 18px;
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
        .create-section-card {
            padding: 22px;
        }

        .create-hero-inner,
        .form-row,
        .media-grid {
            grid-template-columns: 1fr;
        }

        .create-hero-icon-wrap {
            width: 92px;
            height: 92px;
            font-size: 2.4rem;
        }
    }

    @media (max-width: 640px) {
        .create-section-card {
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
        .actions-row button {
            width: 100%;
        }

        .create-main-title {
            font-size: 2rem;
        }
    }
</style>

<div class="create-recipe-page">
    <div class="create-recipe-stack">

        <div class="create-section-card create-hero-card">
            <div class="create-hero-inner">
                <div class="create-hero-icon-wrap">👨‍🍳</div>

                <div>
                    <div class="create-badge">Jauna recepte</div>
                    <h2 class="create-main-title">Izveidojiet savu recepti</h2>
                    <p class="create-main-text">
                        Dalieties ar savām mīļākajām receptēm ar kopienu. Iekļaujiet sastāvdaļas,
                        precīzas instrukcijas, gatavošanas laikus un savus personīgos ieteikumus.
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

        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="create-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">1. Pamata informācija</div>
                    <h3 class="section-title">Receptes apraksts</h3>
                    <p class="section-subtext">
                        Norādiet receptes nosaukumu, kategoriju, grūtības līmeni un īsu aprakstu, kas palīdzēs citiem saprast, kāpēc šī recepte ir īpaša.
                    </p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="title">Receptes nosaukums</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
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
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Kategorija</label>
                        <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">Izvēlieties kategoriju</option>
                            <option value="Brokastis" {{ old('category') == 'Brokastis' ? 'selected' : '' }}>Brokastis</option>
                            <option value="Pusdienas" {{ old('category') == 'Pusdienas' ? 'selected' : '' }}>Pusdienas</option>
                            <option value="Vakariņas" {{ old('category') == 'Vakariņas' ? 'selected' : '' }}>Vakariņas</option>
                            <option value="Deserti" {{ old('category') == 'Deserti' ? 'selected' : '' }}>Deserti</option>
                            <option value="Uzkodas" {{ old('category') == 'Uzkodas' ? 'selected' : '' }}>Uzkodas</option>
                            <option value="Dzērieni" {{ old('category') == 'Dzērieni' ? 'selected' : '' }}>Dzērieni</option>
                            <option value="Salāti" {{ old('category') == 'Salāti' ? 'selected' : '' }}>Salāti</option>
                            <option value="Zupas" {{ old('category') == 'Zupas' ? 'selected' : '' }}>Zupas</option>
                            <option value="Veģetārās" {{ old('category') == 'Veģetārās' ? 'selected' : '' }}>Veģetārās</option>
                            <option value="Vegānās" {{ old('category') == 'Vegānās' ? 'selected' : '' }}>Vegānās</option>
                            <option value="Bezglutēna" {{ old('category') == 'Bezglutēna' ? 'selected' : '' }}>Bezglutēna</option>
                            <option value="Ātras receptes" {{ old('category') == 'Ātras receptes' ? 'selected' : '' }}>Ātras receptes</option>
                        </select>
                        @error('category')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="difficulty">Grūtības līmenis</label>
                        <select id="difficulty" name="difficulty" class="form-select @error('difficulty') is-invalid @enderror" required>
                            <option value="">Izvēlieties grūtību</option>
                            <option value="Viegla" {{ old('difficulty') == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                            <option value="Vidēja" {{ old('difficulty') == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                            <option value="Grūta" {{ old('difficulty') == 'Grūta' ? 'selected' : '' }}>Grūta</option>
                        </select>
                        @error('difficulty')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="create-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">2. Laiks un porcijas</div>
                    <h3 class="section-title">Gatavošanas informācija</h3>
                    <p class="section-subtext">
                        Norādiet sagatavošanas laiku, gatavošanas laiku un porciju skaitu, lai recepte būtu vēl pārskatāmāka un vieglāk izmantojama.
                    </p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="prep_time">Sagatavošanas laiks (minūtēs)</label>
                        <input
                            type="number"
                            id="prep_time"
                            name="prep_time"
                            value="{{ old('prep_time') }}"
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
                            value="{{ old('cook_time') }}"
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
                        value="{{ old('servings') }}"
                        class="form-input @error('servings') is-invalid @enderror"
                        placeholder="4"
                        min="1"
                    >
                    @error('servings')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="time-summary-card">
                    <div class="time-summary-title">Kopējais laiks</div>
                    <input
                        type="text"
                        id="total_time"
                        name="total_time"
                        value="{{ old('total_time') }}"
                        class="form-input"
                        placeholder="—"
                        readonly
                    >
                    <small class="help-text">
                        Automātiski aprēķināts no sagatavošanas un gatavošanas laikiem.
                    </small>
                </div>
            </div>

            <div class="create-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">3. Sastāvdaļas</div>
                    <h3 class="section-title">Sastāvdaļu saraksts</h3>
                    <p class="section-subtext">
                        Pievienojiet sastāvdaļas ar daudzumu, mērvienību un nosaukumu.
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
                        @else
                            <div class="ingredient-item">
                                <div class="ing-row {{ $errors->has('ingredient_name.0') || $errors->has('ingredient_qty.0') || $errors->has('ingredient_unit.0') ? 'has-error' : '' }}">
                                    <input class="form-input ing-qty @error('ingredient_qty.0') is-invalid @enderror" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                           value="" placeholder="Daudzums">
                                    <input class="form-input ing-unit @error('ingredient_unit.0') is-invalid @enderror" name="ingredient_unit[]" type="text"
                                           value="" placeholder="Mērv. (g, ml, gab)">
                                    <input class="form-input ing-name @error('ingredient_name.0') is-invalid @enderror" name="ingredient_name[]" type="text" required
                                           value="" placeholder="Sastāvdaļa">
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

            <div class="create-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">4. Pagatavošana</div>
                    <h3 class="section-title">Gatavošanas instrukcijas</h3>
                    <p class="section-subtext">
                        Aprakstiet pagatavošanas procesu soli pa solim, iekļaujot temperatūras, laikus un svarīgākās nianses.
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
                    >{{ old('instructions') }}</textarea>
                    <small class="help-text">
                        Būt skaidram un precīzam. Iekļaujiet temperatūras, laikus un īpašus paņēmienus.
                    </small>
                    @error('instructions')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="create-section-card">
                <div class="form-section-head">
                    <div class="section-kicker">5. Attēli un video</div>
                    <h3 class="section-title">Papildu saturs</h3>
                    <p class="section-subtext">
                        Pievienojiet attēlu vai video, lai recepte izskatītos vēl pievilcīgāka un informatīvāka.
                    </p>
                </div>

                <div class="media-grid">
                    <div class="media-box">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" for="image">Receptes attēls (nav obligāts)</label>
                            <input id="image" type="file" name="image" accept="image/*" class="form-input @error('image') is-invalid @enderror">
                            <small class="help-text">Atļauts: JPG, PNG, WEBP, GIF. Max ~4MB.</small>
                            @error('image')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="media-box">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" for="video">Video fails (nav obligāts)</label>
                            <input id="video" type="file" name="video" accept="video/*" class="form-input @error('video') is-invalid @enderror">
                            <small class="help-text">Atļauts: mp4, webm, mov.</small>
                            @error('video')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <span class="note-pill">Vari pievienot tikai attēlu, tikai video, vai abus.</span>
            </div>

            <div class="create-section-card actions-card">
                <div class="actions-row">
                    <button type="submit" class="btn btn-success">
                        Publicēt recepti
                    </button>
                    <a href="/profile/recipes" class="btn btn-warning">
                        Atcelt
                    </a>
                </div>
            </div>
        </form>

        <div class="create-section-card tips-box">
            <h3>Padomi labai receptei</h3>
            <p class="tips-subtitle">
                Daži vienkārši ieteikumi, lai tava recepte būtu pārskatāma, skaista un viegli izmantojama citiem.
            </p>

            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">📸</div>
                    <h5>Vizuāli pievilcīgs saturs</h5>
                    <p>Attēli un skaidrs apraksts palīdz receptei izskatīties daudz pievilcīgākai.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">⏱️</div>
                    <h5>Precīzi laiki</h5>
                    <p>Norādiet precīzu sagatavošanas un gatavošanas laiku, lai citi var plānot ēst gatavošanu.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">📋</div>
                    <h5>Skaidras instrukcijas</h5>
                    <p>Sadaliet procesu vienkāršos un saprotamos soļos, lai recepti būtu viegli atkārtot.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">🧂</div>
                    <h5>Personīgais pieskāriens</h5>
                    <p>Pievienojiet savus ieteikumus, variācijas vai pasniegšanas idejas.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function updateTotalTime() {
    const prepEl = document.getElementById('prep_time');
    const cookEl = document.getElementById('cook_time');
    const totalField = document.getElementById('total_time');
    if (!prepEl || !cookEl || !totalField) return;

    const prep = parseInt(prepEl.value) || 0;
    const cook = parseInt(cookEl.value) || 0;
    const total = prep + cook;

    totalField.value = total > 0 ? (total + ' min') : '';
}

const prepInput = document.getElementById('prep_time');
const cookInput = document.getElementById('cook_time');

if (prepInput) prepInput.addEventListener('input', updateTotalTime);
if (cookInput) cookInput.addEventListener('input', updateTotalTime);
document.addEventListener('DOMContentLoaded', updateTotalTime);

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
@extends('layouts.app')

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

    .section-block + .section-block {
        margin-top: 28px;
    }

    .intro-box,
    .form-section,
    .tips-box,
    .meta-box {
        background: var(--surface);
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

    .intro-box h2 {
        font-family: Georgia, "Times New Roman", serif;
        color: var(--accent);
        font-size: 2.3rem;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .intro-box p {
        color: var(--muted);
        line-height: 1.8;
        max-width: 760px;
        margin: 0 auto;
    }

    .section-title {
        color: var(--accent);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 1.9rem;
        font-weight: 500;
    }

    .section-subtext {
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 22px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        margin-bottom: 9px;
        font-weight: 700;
        color: var(--text);
        font-size: 15px;
    }

    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid var(--line);
        font-size: 15px;
        background: #fffdfa;
        color: var(--text);
        transition: 0.2s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #bba692;
        background: #fff;
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
        line-height: 1.5;
    }

    .alert {
        padding: 18px 20px;
        margin-bottom: 24px;
        border: 1px solid var(--danger-border);
        background: #fbf3f1;
        color: var(--danger-text);
    }

    .alert h4 {
        margin-bottom: 12px;
        font-size: 16px;
    }

    .alert ul {
        margin-left: 20px;
        line-height: 1.7;
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
        border-color: var(--danger-border);
        background: #fff7f6;
    }

    .current-media {
        background: var(--surface-soft);
        border: 1px solid var(--line);
        padding: 16px;
        margin-bottom: 20px;
    }

    .media-preview-img {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        display: block;
        margin-top: 10px;
        border: 1px solid var(--line);
    }

    .media-preview-video {
        width: 100%;
        display: block;
        margin-top: 10px;
        border: 1px solid var(--line);
    }

    .pill {
        display: inline-block;
        padding: 6px 10px;
        background: var(--info-bg);
        color: var(--info-text);
        font-weight: 700;
        font-size: 12px;
        border: 1px solid var(--line);
        margin-top: 8px;
    }

    .ing-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 10px;
    }

    .ing-row.has-error {
        padding: 10px;
        border: 1px solid var(--danger-border);
        background: #fff8f7;
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
        margin-top: -2px;
        margin-bottom: 10px;
    }

    .ing-errors .field-error {
        margin-top: 4px;
    }

    .meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        font-size: 14px;
        color: var(--muted);
    }

    .actions-row {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .delete-row {
        display: flex;
        justify-content: center;
        margin-top: 20px;
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
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
    }

    .tip-card {
        border: 1px solid var(--line);
        padding: 20px;
        background: var(--surface-soft);
        text-align: center;
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
        line-height: 1.6;
    }

    @media (max-width: 900px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .intro-box,
        .form-section,
        .tips-box,
        .meta-box {
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
    }
</style>

<div class="edit-recipe-page">

    <div class="section-block intro-box">
        <div class="intro-icon">✏️</div>
        <h2>Uzlabojiet savu recepti</h2>
        <p>
            Atjauniniet informāciju, pievienojiet precizējumus, uzlabojiet instrukcijas un nomainiet attēlu vai video, ja nepieciešams.
        </p>
    </div>

    @if($errors->any())
        <div class="section-block alert">
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

        <div class="section-block form-section">
            <h3 class="section-title">📋 Pamata informācija</h3>

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

        <div class="section-block form-section">
            <h3 class="section-title">⏱️ Laiks un porcijas</h3>

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

        <div class="section-block form-section">
            <h3 class="section-title">🥕 Sastāvdaļas</h3>
            <p class="section-subtext">
                Rediģējiet sastāvdaļu sarakstu ar daudzumu, mērvienību un nosaukumu.
            </p>

            <div class="form-group">
                <label class="form-label">Sastāvdaļu saraksts</label>

                <div id="ingredientsWrap">
                    @if($useOld)
                        @php
                            $names = is_array($oldNames) ? $oldNames : [];
                            $qtys  = is_array($oldQtys)  ? $oldQtys  : [];
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

                <button type="button" class="btn btn-success" onclick="addIngRow()" style="margin-top: 10px;">
                    Pievienot sastāvdaļu
                </button>

                <small class="help-text">
                    Ja nav jēgas daudzumu norādīt, piemēram “pēc garšas”, atstāj daudzumu tukšu.
                </small>
            </div>
        </div>

        <div class="section-block form-section">
            <h3 class="section-title">👩‍🍳 Gatavošanas instrukcijas</h3>

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

        <div class="section-block form-section">
            <h3 class="section-title">📸 Attēls / Video</h3>

            <div class="current-media">
                <div style="font-weight: 700; color: var(--text);">Esošie faili</div>

                @if($recipe->image_path)
                    <span class="pill">Attēls</span>
                    <img src="{{ asset('storage/' . $recipe->image_path) }}" class="media-preview-img" alt="Pašreizējais attēls">
                @else
                    <div style="margin-top: 8px; color: var(--muted);">Nav attēla</div>
                @endif

                @if($recipe->video_path)
                    <div style="margin-top: 14px;">
                        <span class="pill">Video</span>
                        <video controls class="media-preview-video">
                            <source src="{{ asset('storage/' . $recipe->video_path) }}">
                        </video>
                    </div>
                @else
                    <div style="margin-top: 14px; color: var(--muted);">Nav video</div>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Nomainīt attēlu</label>
                <input id="image" type="file" name="image" accept="image/*" class="form-input @error('image') is-invalid @enderror">
                <small class="help-text">Ja izvēlies jaunu failu, tas aizstās esošo attēlu.</small>
                @error('image')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="video">Nomainīt video</label>
                <input id="video" type="file" name="video" accept="video/*" class="form-input @error('video') is-invalid @enderror">
                <small class="help-text">Ja izvēlies jaunu video failu, tas aizstās esošo video.</small>
                @error('video')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <span class="pill">Vari atstāt laukus tukšus, ja negribi mainīt attēlu vai video.</span>
        </div>

        <div class="section-block meta-box">
            <div class="meta-row">
                <span>Recepte izveidota: {{ $recipe->created_at->format('d.m.Y H:i') }}</span>
                <span>Pēdējās izmaiņas: {{ $recipe->updated_at->format('d.m.Y H:i') }}</span>
            </div>
        </div>

        <div class="section-block">
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

    <div class="section-block tips-box">
        <h3>Padomi recepšu uzlabošanai</h3>
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
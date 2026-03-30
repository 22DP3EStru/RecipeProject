<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt recepti - {{ $recipe->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
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
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0)),
                linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 100%);
            min-height: 100vh;
            color: var(--text);
        }

        .page {
            max-width: 1450px;
            margin: 0 auto;
            padding: 28px 20px 50px;
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

        .nav-bar {
            background: rgba(255, 253, 249, 0.95);
            border: 1px solid var(--line);
            padding: 16px 22px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.9rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
            white-space: nowrap;
        }

        .nav-center {
            min-width: 0;
            display: flex;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            flex-wrap: nowrap;
            min-width: 0;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 9px 11px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 13.5px;
            white-space: nowrap;
            line-height: 1.2;
        }

        .nav-links a:hover {
            background: var(--soft-bg);
            border-color: var(--line);
            color: var(--accent);
        }

        .nav-links a.active {
            color: var(--accent);
            background: var(--soft-bg);
            border-color: var(--line);
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            white-space: nowrap;
        }

        .nav-user-name {
            color: var(--muted);
            font-size: 13.5px;
            font-weight: 700;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            text-decoration: none;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            text-align: center;
            font-family: inherit;
            white-space: nowrap;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fffaf4;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-success {
            background: var(--success-bg);
            color: var(--success-text);
            border-color: #d8e1cf;
        }

        .btn-warning {
            background: var(--warning-bg);
            color: var(--warning-text);
            border-color: #e2ccc1;
        }

        .btn-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border-color: var(--danger-border);
        }

        .btn-secondary {
            background: var(--soft-bg);
            color: var(--text);
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
        .form-section,
        .tips-box,
        .meta-box {
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

        .current-media {
            background: var(--soft-bg);
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
            background: var(--soft-bg);
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

        @media (max-width: 1280px) {
            .nav-bar {
                grid-template-columns: 1fr;
                justify-items: center;
                text-align: center;
            }

            .nav-center {
                width: 100%;
            }

            .nav-links {
                flex-wrap: wrap;
            }

            .nav-right {
                justify-content: center;
                flex-wrap: wrap;
            }

            .nav-user-name {
                max-width: none;
            }
        }

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-links a {
                font-size: 13px;
                padding: 8px 10px;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 16px 12px 32px;
            }

            .hero {
                padding: 10px 8px 24px;
            }

            .hero-title {
                font-size: 2.3rem;
            }

            .nav-bar {
                padding: 16px;
                gap: 14px;
            }

            .main-content,
            .intro-box,
            .form-section,
            .tips-box,
            .meta-box {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
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
    <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
@php
    $oldNames = old('ingredient_name');
    $oldQtys  = old('ingredient_qty');
    $oldUnits = old('ingredient_unit');
    $useOld = is_array($oldNames) || is_array($oldQtys) || is_array($oldUnits);

    $ingredientsRel = $recipe->ingredientsItems ?? collect();

    $selectedCategory = old('category', $recipe->category->name ?? $recipe->category ?? '');
@endphp

<div class="page">

    <div class="hero">
        <h1 class="hero-title">Rediģēt recepti</h1>
        <p class="hero-text">
            Atjauniniet recepti “{{ $recipe->title }}”, uzlabojiet instrukcijas, sastāvdaļas un pievienoto saturu.
        </p>
    </div>

    <nav class="nav-bar">
        <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

        <div class="nav-center">
            <div class="nav-links">
                <a href="/dashboard">Vadības panelis</a>
                <a href="/recipes">Receptes</a>
                <a href="/categories">Kategorijas</a>
                <a href="/profile/recipes" class="active">Manas receptes</a>
                <a href="/profile/favorites">Favorīti</a>
                <a href="/contact">Kontakti</a>
                <a href="{{ route('profile.edit') }}">Profils</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">Administrācija</a>
                @endif
            </div>
        </div>

        <div class="nav-right">
            <span class="nav-user-name">{{ Auth::user()->name }}</span>
            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-warning">Atpakaļ</a>
        </div>
    </nav>

    <div class="main-content">

        <div class="section-block intro-box">
            <div class="intro-icon">✏️</div>
            <h2>Uzlabojiet savu recepti</h2>
            <p>
                Atjauniniet informāciju, pievienojiet precizējumus, uzlabojiet instrukcijas un nomainiet attēlu vai video, ja nepieciešams.
            </p>
        </div>

        @if($errors->any())
            <div class="section-block alert">
                <h4>Izlabojiet šādas kļūdas:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data">
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
                        class="form-input"
                        placeholder="Piemēram: Mājas biezpiens ar ievārījumu"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Apraksts</label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-textarea"
                        placeholder="Īss apraksts par recepti - kas padara to īpašu?"
                        required
                    >{{ old('description', $recipe->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Kategorija</label>
                        <select id="category" name="category" class="form-select" required>
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
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="difficulty">Grūtības līmenis</label>
                        <select id="difficulty" name="difficulty" class="form-select" required>
                            <option value="">Izvēlieties grūtību</option>
                            <option value="Viegla" {{ old('difficulty', $recipe->difficulty) == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                            <option value="Vidēja" {{ old('difficulty', $recipe->difficulty) == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                            <option value="Grūta" {{ old('difficulty', $recipe->difficulty) == 'Grūta' ? 'selected' : '' }}>Grūta</option>
                        </select>
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
                            class="form-input"
                            placeholder="15"
                            min="0"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cook_time">Gatavošanas laiks (minūtēs)</label>
                        <input
                            type="number"
                            id="cook_time"
                            name="cook_time"
                            value="{{ old('cook_time', $recipe->cook_time) }}"
                            class="form-input"
                            placeholder="30"
                            min="0"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="servings">Porciju skaits</label>
                    <input
                        type="number"
                        id="servings"
                        name="servings"
                        value="{{ old('servings', $recipe->servings) }}"
                        class="form-input"
                        placeholder="4"
                        min="1"
                    >
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
                                <div class="ing-row">
                                    <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                           value="{{ $qtys[$i] ?? '' }}" placeholder="Daudzums">
                                    <input class="form-input ing-unit" name="ingredient_unit[]" type="text"
                                           value="{{ $units[$i] ?? '' }}" placeholder="Mērv. (g, ml, gab)">
                                    <input class="form-input ing-name" name="ingredient_name[]" type="text" required
                                           value="{{ $names[$i] ?? '' }}" placeholder="Sastāvdaļa">
                                    <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
                                </div>
                            @endfor

                        @elseif($ingredientsRel instanceof \Illuminate\Support\Collection && $ingredientsRel->count() > 0)
                            @foreach($ingredientsRel as $ing)
                                <div class="ing-row">
                                    <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                           value="{{ is_null($ing->quantity) ? '' : (float)$ing->quantity }}" placeholder="Daudzums">
                                    <input class="form-input ing-unit" name="ingredient_unit[]" type="text"
                                           value="{{ $ing->unit }}" placeholder="Mērv. (g, ml, gab)">
                                    <input class="form-input ing-name" name="ingredient_name[]" type="text" required
                                           value="{{ $ing->name }}" placeholder="Sastāvdaļa">
                                    <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
                                </div>
                            @endforeach

                        @else
                            <div class="ing-row">
                                <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                       value="" placeholder="Daudzums">
                                <input class="form-input ing-unit" name="ingredient_unit[]" type="text"
                                       value="" placeholder="Mērv. (g, ml, gab)">
                                <input class="form-input ing-name" name="ingredient_name[]" type="text" required
                                       value="" placeholder="Sastāvdaļa">
                                <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
                            </div>
                        @endif
                    </div>

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
                        class="form-textarea"
                        style="min-height: 300px;"
                        placeholder="Aprakstiet gatavošanas procesu soli pa solim..."
                        required
                    >{{ old('instructions', $recipe->instructions) }}</textarea>
                    <small class="help-text">
                        Iekļaujiet temperatūras, laikus un īpašus paņēmienus, ja tie ir svarīgi.
                    </small>
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
                    <input id="image" type="file" name="image" accept="image/*" class="form-input">
                    <small class="help-text">Ja izvēlies jaunu failu, tas aizstās esošo attēlu.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video">Nomainīt video</label>
                    <input id="video" type="file" name="video" accept="video/*" class="form-input">
                    <small class="help-text">Ja izvēlies jaunu video failu, tas aizstās esošo video.</small>
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
</div>

<script>
function addIngRow() {
    const wrap = document.getElementById('ingredientsWrap');
    const row = document.createElement('div');
    row.className = 'ing-row';
    row.innerHTML = `
        <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0" value="" placeholder="Daudzums">
        <input class="form-input ing-unit" name="ingredient_unit[]" type="text" value="" placeholder="Mērv. (g, ml, gab)">
        <input class="form-input ing-name" name="ingredient_name[]" type="text" required value="" placeholder="Sastāvdaļa">
        <button type="button" class="btn btn-danger" onclick="removeIngRow(this)">✖</button>
    `;
    wrap.appendChild(row);
}

function removeIngRow(btn) {
    const wrap = document.getElementById('ingredientsWrap');
    const rows = wrap.querySelectorAll('.ing-row');
    if (rows.length <= 1) return;
    const row = btn.closest('.ing-row');
    if (row) row.remove();
}
</script>
</body>
</html>
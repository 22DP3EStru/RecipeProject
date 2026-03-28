<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izveidot recepti - Vecmāmiņas Receptes</title>
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
            max-width: 1100px;
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
            background: rgba(255, 253, 249, 0.92);
            border: 1px solid var(--line);
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            flex-wrap: wrap;
            box-shadow: var(--shadow);
            margin-bottom: 34px;
        }

        .nav-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            min-width: 240px;
        }

        .nav-brand {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            letter-spacing: 0.02em;
            line-height: 1.1;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 14px;
            font-weight: 600;
        }

        .nav-right {
            display: flex;
            flex: 1;
            justify-content: flex-end;
            align-items: flex-start;
            min-width: 320px;
        }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
        }

        .nav-links a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border: 1px solid transparent;
            transition: 0.2s ease;
            font-weight: 600;
            font-size: 14px;
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
        .tips-box {
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

        .note-pill {
            display: inline-block;
            padding: 6px 10px;
            background: var(--info-bg);
            color: var(--info-text);
            font-weight: 700;
            font-size: 12px;
            border: 1px solid var(--line);
            margin-top: 10px;
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

        .actions-row {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 10px;
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

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .main-content {
                padding: 24px;
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
            }

            .nav-brand {
                font-size: 1.7rem;
            }

            .nav-right {
                min-width: 100%;
                justify-content: flex-start;
            }

            .nav-links {
                justify-content: flex-start;
            }

            .main-content,
            .intro-box,
            .form-section,
            .tips-box {
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
            .actions-row button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
@php
    $oldNames = old('ingredient_name');
    $oldQtys  = old('ingredient_qty');
    $oldUnits = old('ingredient_unit');
    $useOld = is_array($oldNames) || is_array($oldQtys) || is_array($oldUnits);
@endphp

<div class="page">

    <div class="hero">
        <h1 class="hero-title">Izveidot recepti</h1>
        <p class="hero-text">
            Pievienojiet jaunu recepti, aprakstiet sastāvdaļas, instrukcijas un dalieties ar savu kulināro pieredzi.
        </p>
    </div>

    <nav class="nav-bar">
        <div class="nav-left">
            <a href="/dashboard" class="nav-brand">Vecmāmiņas Receptes</a>

            <div class="nav-user">
                <span>{{ Auth::user()->name }}</span>
                <a href="/profile/recipes" class="btn btn-warning">Atpakaļ uz manām receptēm</a>
            </div>
        </div>

        <div class="nav-right">
            <div class="nav-links">
                <a href="/dashboard">Vadības panelis</a>
                <a href="/recipes">Receptes</a>
                <a href="/categories">Kategorijas</a>
                <a href="/profile/recipes" class="active">Manas receptes</a>
                <a href="{{ route('profile.edit') }}">Profils</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">Administrācija</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="main-content">

        <div class="section-block intro-box">
            <div class="intro-icon">👨‍🍳</div>
            <h2>Izveidojiet savu recepti</h2>
            <p>
                Dalieties ar savām mīļākajām receptēm ar kopienu. Iekļaujiet sastāvdaļas, precīzas instrukcijas,
                gatavošanas laikus un papildu padomus.
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

        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="section-block form-section">
                <h3 class="section-title">📋 Pamata informācija</h3>

                <div class="form-group">
                    <label class="form-label" for="title">Receptes nosaukums</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
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
                    >{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Kategorija</label>
                        <select id="category" name="category" class="form-select" required>
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
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="difficulty">Grūtības līmenis</label>
                        <select id="difficulty" name="difficulty" class="form-select" required>
                            <option value="">Izvēlieties grūtību</option>
                            <option value="Viegla" {{ old('difficulty') == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                            <option value="Vidēja" {{ old('difficulty') == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                            <option value="Grūta" {{ old('difficulty') == 'Grūta' ? 'selected' : '' }}>Grūta</option>
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
                            value="{{ old('prep_time') }}"
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
                            value="{{ old('cook_time') }}"
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
                        value="{{ old('servings') }}"
                        class="form-input"
                        placeholder="4"
                        min="1"
                    >
                </div>

                <div class="form-group" style="margin-top:10px;">
                    <label class="form-label" for="total_time">Kopējais laiks</label>
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

            <div class="section-block form-section">
                <h3 class="section-title">🥕 Sastāvdaļas</h3>
                <p class="section-subtext">
                    Pievienojiet sastāvdaļas ar daudzumu, mērvienību un nosaukumu.
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

                            @for($i=0; $i<$rows; $i++)
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

                <textarea name="ingredients" style="display:none;">{{ old('ingredients') }}</textarea>
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
                    >{{ old('instructions') }}</textarea>
                    <small class="help-text">
                        Būt skaidram un precīzam. Iekļaujiet temperatūras, laikus un īpašus paņēmienus.
                    </small>
                </div>
            </div>

            <div class="section-block form-section">
                <h3 class="section-title">📸 Attēls / Video</h3>

                <div class="form-group">
                    <label class="form-label" for="image">Receptes attēls (nav obligāts)</label>
                    <input id="image" type="file" name="image" accept="image/*" class="form-input">
                    <small class="help-text">Atļauts: JPG, PNG, WEBP, GIF. Max ~4MB.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image_url">Attēla links</label>
                    <input
                        id="image_url"
                        type="url"
                        name="image_url"
                        value="{{ old('image_url') }}"
                        class="form-input"
                        placeholder="https://...jpg / .png"
                    >
                    <small class="help-text">
                        Ielīmē tiešu bildes linku. Ja augšupielādē failu, links netiks izmantots.
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video">Video fails (nav obligāts)</label>
                    <input id="video" type="file" name="video" accept="video/*" class="form-input">
                    <small class="help-text">Atļauts: mp4, webm, mov.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video_url">Video links</label>
                    <input
                        id="video_url"
                        type="url"
                        name="video_url"
                        value="{{ old('video_url') }}"
                        class="form-input"
                        placeholder="https://youtube.com/..."
                    >
                    <small class="help-text">
                        Ielīmē pilnu video linku. Ja pievienosi video failu, šo var atstāt tukšu.
                    </small>
                </div>

                <span class="note-pill">Vari pievienot tikai attēlu, tikai video, vai abus.</span>
            </div>

            <div class="section-block">
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

        <div class="section-block tips-box">
            <h3>Padomi labai receptei</h3>
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
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt recepti - {{ $recipe->title }}</title>
    <style>
        /* Dashboard Style Design */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container { max-width: 800px; margin: 0 auto; padding: 20px; }

        .header { text-align: center; color: white; margin-bottom: 40px; padding: 40px 0; }
        .header h1 { font-size: 3rem; margin-bottom: 15px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        .header p { font-size: 1.3rem; opacity: 0.9; }

        .nav-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-brand { font-size: 24px; font-weight: bold; color: #667eea; text-decoration: none; }

        .nav-links { display: flex; gap: 20px; flex-wrap: wrap; }
        .nav-links a {
            color: #333; text-decoration: none; padding: 8px 16px; border-radius: 8px;
            transition: all 0.3s ease; font-weight: 500;
        }
        .nav-links a:hover { background: #667eea; color: white; transform: translateY(-2px); }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-group { margin-bottom: 25px; }
        .form-label { display: block; margin-bottom: 10px; font-weight: 600; color: #333; font-size: 16px; }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            font-family: inherit;
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-textarea { min-height: 120px; resize: vertical; }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); color: white; }
        .btn-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .btn-danger { background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); color: white; }

        .alert { padding: 20px; border-radius: 12px; margin-bottom: 25px; border: 1px solid transparent; }
        .alert-error {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.1) 0%, rgba(255, 75, 43, 0.1) 100%);
            border-color: rgba(255, 65, 108, 0.2);
            color: #c62828;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .form-row { grid-template-columns: 1fr; }
        }

        /* ✅ MEDIA box */
        .media-box{
            background: rgba(102, 126, 234, 0.05);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .help-text{
            color:#666;
            margin-top: 6px;
            display:block;
            font-size: 13px;
            line-height: 1.4;
        }
        .current-media{
            background: rgba(255,255,255,0.75);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 18px;
        }
        .media-preview-img{
            width: 100%;
            max-height: 260px;
            object-fit: cover;
            border-radius: 12px;
            display:block;
            margin-top: 10px;
        }
        .media-preview-video{
            width: 100%;
            border-radius: 12px;
            display:block;
            margin-top: 10px;
        }
        .pill{
            display:inline-block;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(102,126,234,0.12);
            color:#667eea;
            font-weight:800;
            font-size: 12px;
            margin-top: 8px;
        }

        /* ✅ INGREDIENTS ROWS */
        .ing-row{
            display:flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 10px;
        }
        .ing-qty{ width: 130px; }
        .ing-unit{ width: 160px; }
        .ing-name{ flex: 1; min-width: 220px; }
    </style>
</head>
<body>
@php
    // old() masīvi validācijas gadījumā
    $oldNames = old('ingredient_name');
    $oldQtys  = old('ingredient_qty');
    $oldUnits = old('ingredient_unit');
    $useOld = is_array($oldNames) || is_array($oldQtys) || is_array($oldUnits);

    // ✅ ņemam no pareizā relationship: ingredientsItems
    $ingredientsRel = $recipe->ingredientsItems ?? collect();
@endphp

<div class="container">
    <div class="header">
        <h1>✏️ Rediģēt recepti</h1>
        <p>Atjauniniet savu recepti "{{ $recipe->title }}"</p>
    </div>

    <nav class="nav-bar">
        <a href="/dashboard" class="nav-brand">🍽️ Vecmāmiņas Receptes</a>
        <div class="nav-links">
            <a href="/dashboard">🏠 Vadības panelis</a>
            <a href="/recipes">🍽️ Receptes</a>
            <a href="/categories">📂 Kategorijas</a>
            <a href="/profile/recipes">📝 Manas receptes</a>
        </div>
        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span>
            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">← Atpakaļ uz recepti</a>
        </div>
    </nav>

    <div class="main-content">

        <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%); border-radius: 15px;">
            <div style="font-size: 4rem; margin-bottom: 20px;">✏️</div>
            <h2 style="color: #f093fb; margin-bottom: 15px;">Uzlabojiet savu recepti!</h2>
            <p style="color: #666; line-height: 1.6;">
                Atjauniniet informāciju, pievienojiet jaunas detaļas vai uzlabojiet instrukcijas.
            </p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <h4 style="margin-bottom: 15px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">❌</span>
                    Lūdzu, izlabojiet šādas kļūdas:
                </h4>
                <ul style="margin-left: 30px; line-height: 1.6;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom: 5px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="background: rgba(102, 126, 234, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                <h3 style="color: #667eea; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">📋</span>
                    Pamata informācija
                </h3>

                <div class="form-group">
                    <label class="form-label" for="title">🍽️ Receptes nosaukums</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $recipe->title) }}"
                           class="form-input" placeholder="Piemēram: Mājas biezpiens ar ievārījumu" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">📖 Apraksts</label>
                    <textarea id="description" name="description" class="form-textarea"
                              placeholder="Īss apraksts par recepti - kas padara to īpašu?"
                              required>{{ old('description', $recipe->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">📂 Kategorija</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="">Izvēlieties kategoriju</option>
                            <option value="Brokastis" {{ old('category', $recipe->category) == 'Brokastis' ? 'selected' : '' }}>🥞 Brokastis</option>
                            <option value="Pusdienas" {{ old('category', $recipe->category) == 'Pusdienas' ? 'selected' : '' }}>🥗 Pusdienas</option>
                            <option value="Vakariņas" {{ old('category', $recipe->category) == 'Vakariņas' ? 'selected' : '' }}>🍽️ Vakariņas</option>
                            <option value="Deserti" {{ old('category', $recipe->category) == 'Deserti' ? 'selected' : '' }}>🍰 Deserti</option>
                            <option value="Uzkodas" {{ old('category', $recipe->category) == 'Uzkodas' ? 'selected' : '' }}>🥨 Uzkodas</option>
                            <option value="Dzērieni" {{ old('category', $recipe->category) == 'Dzērieni' ? 'selected' : '' }}>🥤 Dzērieni</option>
                            <option value="Salāti" {{ old('category', $recipe->category) == 'Salāti' ? 'selected' : '' }}>🥙 Salāti</option>
                            <option value="Zupas" {{ old('category', $recipe->category) == 'Zupas' ? 'selected' : '' }}>🍲 Zupas</option>
                            <option value="Veģetārās" {{ old('category', $recipe->category) == 'Veģetārās' ? 'selected' : '' }}>🥬 Veģetārās</option>
                            <option value="Vegānās" {{ old('category', $recipe->category) == 'Vegānās' ? 'selected' : '' }}>🌱 Vegānās</option>
                            <option value="Bezglutēna" {{ old('category', $recipe->category) == 'Bezglutēna' ? 'selected' : '' }}>🌾 Bezglutēna</option>
                            <option value="Ātras receptes" {{ old('category', $recipe->category) == 'Ātras receptes' ? 'selected' : '' }}>⚡ Ātras receptes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="difficulty">⭐ Grūtības līmenis</label>
                        <select id="difficulty" name="difficulty" class="form-select" required>
                            <option value="">Izvēlieties grūtību</option>
                            <option value="Viegla" {{ old('difficulty', $recipe->difficulty) == 'Viegla' ? 'selected' : '' }}>🟢 Viegla</option>
                            <option value="Vidēja" {{ old('difficulty', $recipe->difficulty) == 'Vidēja' ? 'selected' : '' }}>🟡 Vidēja</option>
                            <option value="Grūta" {{ old('difficulty', $recipe->difficulty) == 'Grūta' ? 'selected' : '' }}>🔴 Grūta</option>
                        </select>
                    </div>
                </div>
            </div>

            <div style="background: rgba(240, 147, 251, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                <h3 style="color: #f093fb; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">⏱️</span>
                    Laiks un porcijas
                </h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="prep_time">🔪 Sagatavošanas laiks (minūtēs)</label>
                        <input type="number" id="prep_time" name="prep_time" value="{{ old('prep_time', $recipe->prep_time) }}"
                               class="form-input" placeholder="15" min="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cook_time">🔥 Gatavošanas laiks (minūtēs)</label>
                        <input type="number" id="cook_time" name="cook_time" value="{{ old('cook_time', $recipe->cook_time) }}"
                               class="form-input" placeholder="30" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="servings">👥 Porciju skaits</label>
                    <input type="number" id="servings" name="servings" value="{{ old('servings', $recipe->servings) }}"
                           class="form-input" placeholder="4" min="1">
                </div>
            </div>

            <!-- ✅ Ingredients -->
            <div style="background: rgba(86, 171, 47, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                <h3 style="color: #56ab2f; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">🥕</span>
                    Sastāvdaļas
                </h3>

                <div class="form-group">
                    <label class="form-label">🧾 Sastāvdaļu saraksts (daudzums / mērv. / nosaukums)</label>

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
                                           value="{{ $qtys[$i] ?? '' }}" placeholder="Daudzums (piem. 200)">
                                    <input class="form-input ing-unit" name="ingredient_unit[]" type="text"
                                           value="{{ $units[$i] ?? '' }}" placeholder="Mērv. (g, ml, gab)">
                                    <input class="form-input ing-name" name="ingredient_name[]" type="text" required
                                           value="{{ $names[$i] ?? '' }}" placeholder="Sastāvdaļa (piem. Milti)">
                                    <button type="button" class="btn btn-danger" onclick="removeIngRow(this)" style="padding:12px 14px;">✖</button>
                                </div>
                            @endfor

                        @elseif($ingredientsRel instanceof \Illuminate\Support\Collection && $ingredientsRel->count() > 0)
                            @foreach($ingredientsRel as $ing)
                                <div class="ing-row">
                                    <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                           value="{{ is_null($ing->quantity) ? '' : (float)$ing->quantity }}" placeholder="Daudzums (piem. 200)">
                                    <input class="form-input ing-unit" name="ingredient_unit[]" type="text"
                                           value="{{ $ing->unit }}" placeholder="Mērv. (g, ml, gab)">
                                    <input class="form-input ing-name" name="ingredient_name[]" type="text" required
                                           value="{{ $ing->name }}" placeholder="Sastāvdaļa (piem. Milti)">
                                    <button type="button" class="btn btn-danger" onclick="removeIngRow(this)" style="padding:12px 14px;">✖</button>
                                </div>
                            @endforeach

                        @else
                            <div class="ing-row">
                                <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0"
                                       value="" placeholder="Daudzums (piem. 200)">
                                <input class="form-input ing-unit" name="ingredient_unit[]" type="text"
                                       value="" placeholder="Mērv. (g, ml, gab)">
                                <input class="form-input ing-name" name="ingredient_name[]" type="text" required
                                       value="" placeholder="Sastāvdaļa (piem. Milti)">
                                <button type="button" class="btn btn-danger" onclick="removeIngRow(this)" style="padding:12px 14px;">✖</button>
                            </div>
                        @endif
                    </div>

                    <button type="button" class="btn btn-success" onclick="addIngRow()" style="padding:12px 18px; font-size:14px; margin-top:10px;">
                        ➕ Pievienot sastāvdaļu
                    </button>

                    <small style="color: #666; margin-top: 10px; display: block;">
                        💡 Padoms: Ja nav jēgas daudzumu norādīt (piem. “pēc garšas”), atstāj “Daudzums” tukšu.
                    </small>
                </div>
            </div>

            <!-- Instructions -->
            <div style="background: rgba(255, 193, 7, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                <h3 style="color: #ffc107; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">👩‍🍳</span>
                    Gatavošanas instrukcijas
                </h3>

                <div class="form-group">
                    <label class="form-label" for="instructions">📋 Soli pa solim instrukcijas</label>
                    <textarea id="instructions" name="instructions" class="form-textarea" style="min-height: 300px;"
                              placeholder="Aprakstiet gatavošanas procesu soli pa solim..."
                              required>{{ old('instructions', $recipe->instructions) }}</textarea>
                    <small style="color: #666; margin-top: 5px; display: block;">
                        💡 Padoms: Būt precīzs un skaidrs. Iekļaujiet temperatūras, laikus un īpašus paņēmienus
                    </small>
                </div>
            </div>

            <!-- ✅ MEDIA -->
            <div class="media-box">
                <h3 style="color: #667eea; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">📸</span>
                    Attēls / Video
                </h3>

                <div class="current-media">
                    <div style="font-weight:800; color:#333;">Esošie faili / linki</div>

                    @if($recipe->image_path)
                        <span class="pill">Attēls (fails)</span>
                        <img src="{{ asset('storage/' . $recipe->image_path) }}" class="media-preview-img" alt="Pašreizējais attēls">
                    @elseif($recipe->image_url)
                        <span class="pill">Attēls (links)</span>
                        <img src="{{ $recipe->image_url }}" class="media-preview-img" alt="Pašreizējais attēls (links)">
                    @else
                        <div style="margin-top:8px; color:#777;">Nav attēla</div>
                    @endif

                    @if($recipe->video_path)
                        <div style="margin-top:14px;">
                            <span class="pill">Video (fails)</span>
                            <video controls class="media-preview-video">
                                <source src="{{ asset('storage/' . $recipe->video_path) }}">
                            </video>
                        </div>
                    @elseif($recipe->video_url)
                        <div style="margin-top:14px;">
                            <span class="pill">Video (links)</span>
                            <div style="margin-top:8px;">
                                <a href="{{ $recipe->video_url }}" target="_blank" rel="noopener" style="color:#667eea; font-weight:800; text-decoration:underline;">
                                    Atvērt video linku
                                </a>
                            </div>
                        </div>
                    @else
                        <div style="margin-top:14px; color:#777;">Nav video</div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label" for="image">🖼️ Nomainīt attēlu (fails)</label>
                    <input id="image" type="file" name="image" accept="image/*" class="form-input">
                    <small class="help-text">Ja izvēlies failu, tas aizstās esošo attēlu un ignorēs attēla linku.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image_url">🔗 Nomainīt attēlu (links no interneta)</label>
                    <input id="image_url" type="url" name="image_url" value="{{ old('image_url', $recipe->image_url) }}"
                           class="form-input" placeholder="https://...jpg / .png">
                    <small class="help-text">Ielīmē tiešu bildes linku. Ja uploadosi failu, links netiks izmantots.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video">🎥 Nomainīt video (fails)</label>
                    <input id="video" type="file" name="video" accept="video/*" class="form-input">
                    <small class="help-text">Ja izvēlies video failu, tas aizstās esošo video un notīrīs video linku.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video_url">🔗 Nomainīt video (links)</label>
                    <input id="video_url" type="url" name="video_url" value="{{ old('video_url', $recipe->video_url) }}"
                           class="form-input" placeholder="https://youtube.com/...">
                    <small class="help-text">Ja uploadosi video failu, links netiks izmantots.</small>
                </div>

                <span class="pill">💡 Vari atstāt tukšu, ja negribi mainīt media.</span>
            </div>

            <div style="background: rgba(102, 126, 234, 0.05); padding: 20px; border-radius: 12px; margin-bottom: 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #666; flex-wrap:wrap; gap:10px;">
                    <span>Recepte izveidota: {{ $recipe->created_at->format('d.m.Y H:i') }}</span>
                    <span>Pēdējās izmaiņas: {{ $recipe->updated_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>

            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                    💾 Saglabāt izmaiņas
                </button>
                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-warning" style="font-size: 18px; padding: 20px 40px;">
                    ❌ Atcelt
                </a>
            </div>
        </form>

        <div style="display: flex; gap: 20px; justify-content: center; margin-top: 20px;">
            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}"
                  onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti? Šo darbību nevar atsaukt.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="font-size: 18px; padding: 20px 40px;">
                    🗑️ Dzēst recepti
                </button>
            </form>
        </div>

        <div style="background: rgba(102, 126, 234, 0.05); padding: 25px; border-radius: 15px; margin-top: 40px;">
            <h3 style="color: #667eea; margin-bottom: 20px; text-align: center;">💡 Padomi recepšu uzlabošanai</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">📝</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Regulāri atjauniniet</h5>
                    <p style="color: #666; font-size: 13px;">Uzlabojiet receptes, balstoties uz atsauksmēm</p>
                </div>
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">🎯</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Precizējiet detaļas</h5>
                    <p style="color: #666; font-size: 13px;">Pievienojiet temperatūras un laikus</p>
                </div>
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">💬</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Pievienojiet padomus</h5>
                    <p style="color: #666; font-size: 13px;">Dalieties ar saviem īpašajiem trikiem</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function addIngRow(){
    const wrap = document.getElementById('ingredientsWrap');
    const row = document.createElement('div');
    row.className = 'ing-row';
    row.innerHTML = `
        <input class="form-input ing-qty" name="ingredient_qty[]" type="number" step="0.01" min="0" value="" placeholder="Daudzums (piem. 200)">
        <input class="form-input ing-unit" name="ingredient_unit[]" type="text" value="" placeholder="Mērv. (g, ml, gab)">
        <input class="form-input ing-name" name="ingredient_name[]" type="text" required value="" placeholder="Sastāvdaļa (piem. Milti)">
        <button type="button" class="btn btn-danger" onclick="removeIngRow(this)" style="padding:12px 14px;">✖</button>
    `;
    wrap.appendChild(row);
}

function removeIngRow(btn){
    const wrap = document.getElementById('ingredientsWrap');
    const rows = wrap.querySelectorAll('.ing-row');
    if (rows.length <= 1) return; // atstāj vismaz 1 rindu
    const row = btn.closest('.ing-row');
    if (row) row.remove();
}
</script>
</body>
</html>
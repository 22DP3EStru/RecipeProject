<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izveidot recepti - Vecmāmiņas Receptes</title>
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
        .btn-danger  { background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); color: white; }

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

        /* ✅ MEDIA FIELDS */
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
        .note-pill{
            display:inline-block;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(102,126,234,0.12);
            color:#667eea;
            font-weight:800;
            font-size: 12px;
            margin-top: 10px;
        }

        /* ✅ INGREDIENTS ROWS (JAUNS) */
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
    $oldNames = old('ingredient_name');
    $oldQtys  = old('ingredient_qty');
    $oldUnits = old('ingredient_unit');
    $useOld = is_array($oldNames) || is_array($oldQtys) || is_array($oldUnits);
@endphp

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>📝 Izveidot jaunu recepti</h1>
        <p>Dalieties ar savu kulinārijas meistarišķumu</p>
    </div>

    <!-- Navigation -->
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
            <a href="/profile/recipes" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">← Atpakaļ uz manām receptēm</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Message -->
        <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); border-radius: 15px;">
            <div style="font-size: 4rem; margin-bottom: 20px;">👨‍🍳</div>
            <h2 style="color: #56ab2f; margin-bottom: 15px;">Izveidojiet savu recepti!</h2>
            <p style="color: #666; line-height: 1.6;">
                Dalieties ar savām mīļākajām receptēm ar kopienu. Iekļaujiet detalizētas instrukcijas un padomes!
            </p>
        </div>

        <!-- Error Messages -->
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

        <!-- Recipe Form -->
        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information -->
            <div style="background: rgba(102, 126, 234, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                <h3 style="color: #667eea; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">📋</span>
                    Pamata informācija
                </h3>

                <div class="form-group">
                    <label class="form-label" for="title">🍽️ Receptes nosaukums</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                           class="form-input" placeholder="Piemēram: Mājas biezpiens ar ievārījumu" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">📖 Apraksts</label>
                    <textarea id="description" name="description" class="form-textarea"
                              placeholder="Īss apraksts par recepti - kas padara to īpašu?"
                              required>{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">📂 Kategorija</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="">Izvēlieties kategoriju</option>
                            <option value="Brokastis" {{ old('category') == 'Brokastis' ? 'selected' : '' }}>🥞 Brokastis</option>
                            <option value="Pusdienas" {{ old('category') == 'Pusdienas' ? 'selected' : '' }}>🥗 Pusdienas</option>
                            <option value="Vakariņas" {{ old('category') == 'Vakariņas' ? 'selected' : '' }}>🍽️ Vakariņas</option>
                            <option value="Deserti" {{ old('category') == 'Deserti' ? 'selected' : '' }}>🍰 Deserti</option>
                            <option value="Uzkodas" {{ old('category') == 'Uzkodas' ? 'selected' : '' }}>🥨 Uzkodas</option>
                            <option value="Dzērieni" {{ old('category') == 'Dzērieni' ? 'selected' : '' }}>🥤 Dzērieni</option>
                            <option value="Salāti" {{ old('category') == 'Salāti' ? 'selected' : '' }}>🥙 Salāti</option>
                            <option value="Zupas" {{ old('category') == 'Zupas' ? 'selected' : '' }}>🍲 Zupas</option>
                            <option value="Veģetārās" {{ old('category') == 'Veģetārās' ? 'selected' : '' }}>🥬 Veģetārās</option>
                            <option value="Vegānās" {{ old('category') == 'Vegānās' ? 'selected' : '' }}>🌱 Vegānās</option>
                            <option value="Bezglutēna" {{ old('category') == 'Bezglutēna' ? 'selected' : '' }}>🌾 Bezglutēna</option>
                            <option value="Ātras receptes" {{ old('category') == 'Ātras receptes' ? 'selected' : '' }}>⚡ Ātras receptes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="difficulty">⭐ Grūtības līmenis</label>
                        <select id="difficulty" name="difficulty" class="form-select" required>
                            <option value="">Izvēlieties grūtību</option>
                            <option value="Viegla" {{ old('difficulty') == 'Viegla' ? 'selected' : '' }}>🟢 Viegla</option>
                            <option value="Vidēja" {{ old('difficulty') == 'Vidēja' ? 'selected' : '' }}>🟡 Vidēja</option>
                            <option value="Grūta"  {{ old('difficulty') == 'Grūta'  ? 'selected' : '' }}>🔴 Grūta</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Time and Servings -->
            <div style="background: rgba(240, 147, 251, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                <h3 style="color: #f093fb; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">⏱️</span>
                    Laiks un porcijas
                </h3>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="prep_time">🔪 Sagatavošanas laiks (minūtēs)</label>
                        <input type="number" id="prep_time" name="prep_time" value="{{ old('prep_time') }}"
                               class="form-input" placeholder="15" min="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cook_time">🔥 Gatavošanas laiks (minūtēs)</label>
                        <input type="number" id="cook_time" name="cook_time" value="{{ old('cook_time') }}"
                               class="form-input" placeholder="30" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="servings">👥 Porciju skaits</label>
                    <input type="number" id="servings" name="servings" value="{{ old('servings') }}"
                           class="form-input" placeholder="4" min="1">
                </div>

                <div class="form-group" style="margin-top:10px;">
                    <label class="form-label" for="total_time">⏲️ Kopējais laiks</label>
                    <input type="text" id="total_time" name="total_time" value="{{ old('total_time') }}"
                           class="form-input" placeholder="—" readonly>
                    <small style="color:#666; display:block; margin-top:6px;">Automātiski aprēķināts no sagatavošanas un gatavošanas laikiem</small>
                </div>
            </div>

            <!-- ✅ Ingredients (PAREIZAIS variants: quantity + unit + name) -->
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
                        @else
                            {{-- Pirmā rinda tukša --}}
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
                        💡 Ja nav jēgas daudzumu norādīt (piem. “pēc garšas”), atstāj “Daudzums” tukšu.
                    </small>
                </div>

                {{-- ✅ Legacy textarea (paslēpts). Ja controller vairs neprasa "ingredients", vari šo izdzēst. --}}
                <textarea name="ingredients" style="display:none;">{{ old('ingredients') }}</textarea>
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
                              required>{{ old('instructions') }}</textarea>
                    <small style="color: #666; margin-top: 5px; display: block;">
                        💡 Padoms: Būt precīzs un skaidrs. Iekļaujiet temperatūras, laikus un īpašus paņēmienus
                    </small>
                </div>
            </div>

            <!-- ✅ MEDIA UPLOADS -->
            <div class="media-box">
                <h3 style="color: #667eea; margin-bottom: 20px; display: flex; align-items: center;">
                    <span style="margin-right: 10px;">📸</span>
                    Attēls / Video
                </h3>

                <div class="form-group">
                    <label class="form-label" for="image">🖼️ Receptes attēls (nav obligāts)</label>
                    <input id="image" type="file" name="image" accept="image/*" class="form-input">
                    <small class="help-text">Atļauts: JPG, PNG, WEBP, GIF. Max ~4MB.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image_url">🔗 Attēla links (no interneta)</label>
                    <input id="image_url" type="url" name="image_url" value="{{ old('image_url') }}"
                           class="form-input" placeholder="https://...jpg / .png">
                    <small class="help-text">Ielīmē tiešu bildes linku. Ja uploadosi failu, links netiks izmantots.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video">🎥 Video fails (nav obligāts)</label>
                    <input id="video" type="file" name="video" accept="video/*" class="form-input">
                    <small class="help-text">Atļauts: mp4/webm/mov. Ja augšupielādē video failu, video links netiks izmantots.</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="video_url">🔗 Video links (YouTube u.c.)</label>
                    <input id="video_url" type="url" name="video_url" value="{{ old('video_url') }}"
                           class="form-input" placeholder="https://youtube.com/...">
                    <small class="help-text">Ielīmē pilnu linku. Ja pievienosi video failu, šo var atstāt tukšu.</small>
                </div>

                <span class="note-pill">💡 Vari pievienot tikai attēlu, tikai video, vai abus.</span>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                    🎉 Publicēt recepti
                </button>
                <a href="/profile/recipes" class="btn btn-warning" style="font-size: 18px; padding: 20px 40px;">
                    ❌ Atcelt
                </a>
            </div>
        </form>

        <!-- Tips -->
        <div style="background: rgba(102, 126, 234, 0.05); padding: 25px; border-radius: 15px; margin-top: 40px;">
            <h3 style="color: #667eea; margin-bottom: 20px; text-align: center;">💡 Padomi labai receptei</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">📸</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Vizuāli pievilcīgs</h5>
                    <p style="color: #666; font-size: 13px;">Aprakstiet ēdiena izskatu un faktūru</p>
                </div>
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">⏱️</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Precīzi laiki</h5>
                    <p style="color: #666; font-size: 13px;">Norādiet precīzus sagatavošanas un gatavošanas laikus</p>
                </div>
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">📋</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Skaidras instrukcijas</h5>
                    <p style="color: #666; font-size: 13px;">Sadaliet procesu skaidros, viegli sekojamajos pasos</p>
                </div>
                <div style="text-align: center; padding: 15px;">
                    <div style="font-size: 2rem; margin-bottom: 10px;">🧂</div>
                    <h5 style="color: #667eea; margin-bottom: 8px;">Pievienojiet personīgo pieskārienu</h5>
                    <p style="color: #666; font-size: 13px;">Dalieties ar īpašiem padomiem, variācijām vai pasniegšanas idejām</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/* total time */
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

/* ingredients rows */
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
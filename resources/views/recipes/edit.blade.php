<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt recepti - {{ $recipe->title }}</title>
    <style>
        /* Dashboard Style Design */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            padding: 40px 0;
        }

        .header h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.3rem;
            opacity: 0.9;
        }

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

        .nav-brand {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-links a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

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

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

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

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }

        .alert {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid transparent;
        }

        .alert-error {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.1) 0%, rgba(255, 75, 43, 0.1) 100%);
            border-color: rgba(255, 65, 108, 0.2);
            color: #c62828;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✏️ Rediģēt recepti</h1>
            <p>Atjauniniet savu recepti "{{ $recipe->title }}"</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
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

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Message -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%); border-radius: 15px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">✏️</div>
                <h2 style="color: #f093fb; margin-bottom: 15px;">Uzlabojiet savu recepti!</h2>
                <p style="color: #666; line-height: 1.6;">
                    Atjauniniet informāciju, pievienojiet jaunas detaļas vai uzlabojiet instrukcijas.
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
            <form method="POST" action="{{ route('recipes.update', $recipe) }}">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
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

                <!-- Time and Servings -->
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

                <!-- Ingredients -->
                <div style="background: rgba(86, 171, 47, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                    <h3 style="color: #56ab2f; margin-bottom: 20px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">🥕</span>
                        Sastāvdaļas
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="ingredients">📝 Sastāvdaļu saraksts</label>
                        <textarea id="ingredients" name="ingredients" class="form-textarea" style="min-height: 200px;" 
                                  placeholder="Uzskaitiet visas sastāvdaļas, katru jaunā rindā..."
                                  required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                        <small style="color: #666; margin-top: 5px; display: block;">
                            💡 Padoms: Uzskaitiet katru sastāvdaļu jaunā rindā ar precīzu daudzumu
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

                <!-- Recipe Info -->
                <div style="background: rgba(102, 126, 234, 0.05); padding: 20px; border-radius: 12px; margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #666;">
                        <span>Recepte izveidota: {{ $recipe->created_at->format('d.m.Y H:i') }}</span>
                        <span>Pēdējās izmaiņas: {{ $recipe->updated_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                    <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                        💾 Saglabāt izmaiņas
                    </button>
                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-warning" style="font-size: 18px; padding: 20px 40px;">
                        ❌ Atcelt
                    </a>
                </div>
            </form>

            <!-- Delete form moved OUTSIDE the edit form -->
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

            <!-- Tips -->
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
</body>
</html>
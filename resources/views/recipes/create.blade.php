<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izveidot recepti - RecepÅu AplikÄcija</title>
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
            <h1>š“¯ Izveidot jaunu recepti</h1>
            <p>Dalieties ar savu kulinÄrijas meistariÅÄ·umu</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">š¨½ļø¸ RecepÅu AplikÄcija</a>
            <div class="nav-links">
                <a href="/dashboard">š¸  VadÄ«bas panelis</a>
                <a href="/recipes">š¨½ļø¸ Receptes</a>
                <a href="/categories">š“‚ Kategorijas</a>
                <a href="/profile/recipes">š“¯ Manas receptes</a>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="color: #666; font-weight: 500;">š‘¤ {{ Auth::user()->name }}</span>
                <a href="/profile/recipes" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">ā† AtpakaÄ¼ uz manÄm receptÄ“m</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Message -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); border-radius: 15px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">š‘Øā€¨š¨³</div>
                <h2 style="color: #56ab2f; margin-bottom: 15px;">Izveidojiet savu recepti!</h2>
                <p style="color: #666; line-height: 1.6;">
                    Dalieties ar savÄm mÄ«Ä¼ÄkajÄm receptÄ“m ar kopienu. IekÄ¼aujiet detalizÄ“tas instrukcijas un padomes!
                </p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-error">
                    <h4 style="margin-bottom: 15px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">ā¯</span>
                        LÅ«dzu, izlabojiet ÅÄdas kÄ¼Å«das:
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
                        <span style="margin-right: 10px;">š“‹</span>
                        Pamata informÄcija
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="title">š¨½ļø¸ Receptes nosaukums</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="form-input" placeholder="PiemÄ“ram: MÄjas biezpiens ar ievÄrÄ«jumu" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">š“– Apraksts</label>
                        <textarea id="description" name="description" class="form-textarea" 
                                  placeholder="ÄŖss apraksts par recepti - kas padara to Ä«paÅu?"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="category">š“‚ Kategorija</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="">IzvÄ“lieties kategoriju</option>
                                <option value="Brokastis" {{ old('category') == 'Brokastis' ? 'selected' : '' }}>š˛ Brokastis</option>
                                <option value="Pusdienas" {{ old('category') == 'Pusdienas' ? 'selected' : '' }}>š— Pusdienas</option>
                                <option value="VakariÅ†as" {{ old('category') == 'VakariÅ†as' ? 'selected' : '' }}>š¨½ļø¸ VakariÅ†as</option>
                                <option value="Deserti" {{ old('category') == 'Deserti' ? 'selected' : '' }}>š¨° Deserti</option>
                                <option value="Uzkodas" {{ old('category') == 'Uzkodas' ? 'selected' : '' }}>šØ Uzkodas</option>
                                <option value="DzÄ“rieni" {{ old('category') == 'DzÄ“rieni' ? 'selected' : '' }}>š¤ DzÄ“rieni</option>
                                <option value="SalÄti" {{ old('category') == 'SalÄti' ? 'selected' : '' }}>š™ SalÄti</option>
                                <option value="Zupas" {{ old('category') == 'Zupas' ? 'selected' : '' }}>š¨² Zupas</option>
                                <option value="VeÄ£etÄrÄs" {{ old('category') == 'VeÄ£etÄrÄs' ? 'selected' : '' }}>š¬ VeÄ£etÄrÄs</option>
                                <option value="VegÄnÄs" {{ old('category') == 'VegÄnÄs' ? 'selected' : '' }}>š± VegÄnÄs</option>
                                <option value="BezglutÄ“na" {{ old('category') == 'BezglutÄ“na' ? 'selected' : '' }}>š¾ BezglutÄ“na</option>
                                <option value="Ä€tras receptes" {{ old('category') == 'Ä€tras receptes' ? 'selected' : '' }}>ā Ä€tras receptes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="difficulty">ā­ GrÅ«tÄ«bas lÄ«menis</label>
                            <select id="difficulty" name="difficulty" class="form-select" required>
                                <option value="">IzvÄ“lieties grÅ«tÄ«bu</option>
                                <option value="Viegla" {{ old('difficulty') == 'Viegla' ? 'selected' : '' }}>š¢ Viegla</option>
                                <option value="VidÄ“ja" {{ old('difficulty') == 'VidÄ“ja' ? 'selected' : '' }}>š VidÄ“ja</option>
                                <option value="GrÅ«ta" {{ old('difficulty') == 'GrÅ«ta' ? 'selected' : '' }}>š”´ GrÅ«ta</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Time and Servings -->
                <div style="background: rgba(240, 147, 251, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                    <h3 style="color: #f093fb; margin-bottom: 20px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">ā¸±ļø¸</span>
                        Laiks un porcijas
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="prep_time">š”Ŗ SagatavoÅanas laiks (minÅ«tÄ“s)</label>
                            <input type="number" id="prep_time" name="prep_time" value="{{ old('prep_time') }}" 
                                   class="form-input" placeholder="15" min="0">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="cook_time">š” GatavoÅanas laiks (minÅ«tÄ“s)</label>
                            <input type="number" id="cook_time" name="cook_time" value="{{ old('cook_time') }}" 
                                   class="form-input" placeholder="30" min="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="servings">š‘ Porciju skaits</label>
                        <input type="number" id="servings" name="servings" value="{{ old('servings') }}" 
                               class="form-input" placeholder="4" min="1">
                    </div>

                    <!-- Added read-only total time field to avoid JS error and show total -->
                    <div class="form-group" style="margin-top:10px;">
                        <label class="form-label" for="total_time">ā¸²ļø¸ KopÄ“jais laiks</label>
                        <input type="text" id="total_time" name="total_time" value="{{ old('total_time') }}" 
                               class="form-input" placeholder="ā€”" readonly>
                        <small style="color:#666; display:block; margin-top:6px;">AutomÄtiski aprÄ“Ä·inÄts no sagatavoÅanas un gatavoÅanas laikiem</small>
                    </div>
                </div>

                <!-- Ingredients -->
                <div style="background: rgba(86, 171, 47, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                    <h3 style="color: #56ab2f; margin-bottom: 20px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">š•</span>
                        SastÄvdaÄ¼as
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="ingredients">š“¯ SastÄvdaÄ¼u saraksts</label>
                        <textarea id="ingredients" name="ingredients" class="form-textarea" style="min-height: 200px;" 
                                  placeholder="Uzskaitiet visas sastÄvdaÄ¼as, katru jaunÄ rindÄ:

200g miltiem
3 olas
500ml piena
2 Ä“d. k. cukura
1 t. k. sÄls
2 Ä“d. k. sviesta"
                                  required>{{ old('ingredients') }}</textarea>
                        <small style="color: #666; margin-top: 5px; display: block;">
                            š’ Padoms: Uzskaitiet katru sastÄvdaÄ¼u jaunÄ rindÄ ar precÄ«zu daudzumu
                        </small>
                    </div>
                </div>

                <!-- Instructions -->
                <div style="background: rgba(255, 193, 7, 0.05); padding: 25px; border-radius: 15px; margin-bottom: 30px;">
                    <h3 style="color: #ffc107; margin-bottom: 20px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">š‘©ā€¨š¨³</span>
                        GatavoÅanas instrukcijas
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label" for="instructions">š“‹ Soli pa solim instrukcijas</label>
                        <textarea id="instructions" name="instructions" class="form-textarea" style="min-height: 300px;" 
                                  placeholder="Aprakstiet gatavoÅanas procesu soli pa solim:

1. Sagatavojiet visas sastÄvdaÄ¼as
2. SakarsÄ“jiet cepeÅkrÄsni lÄ«dz 180Ā°C
3. Samaisiet sausÄs sastÄvdaÄ¼as bÄ¼odÄ
4. Pievienojiet mitrÄs sastÄvdaÄ¼as un rÅ«pÄ«gi samaisiet
5. Ielieciet cepeÅkrÄsnÄ« uz 25-30 minÅ«tÄ“m

Pievienojiet jebkÄdus Ä«paÅus padomus vai brÄ«dinÄjumus!"
                                  required>{{ old('instructions') }}</textarea>
                        <small style="color: #666; margin-top: 5px; display: block;">
                            š’ Padoms: BÅ«t precÄ«zs un skaidrs. IekÄ¼aujiet temperatÅ«ras, laikus un Ä«paÅus paÅ†Ä“mienus
                        </small>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                    <button type="submit" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                        šˇ‰ PublicÄ“t recepti
                    </button>
                    <a href="/profile/recipes" class="btn btn-warning" style="font-size: 18px; padding: 20px 40px;">
                        ā¯ Atcelt
                    </a>
                </div>
            </form>

            <!-- Tips -->
            <div style="background: rgba(102, 126, 234, 0.05); padding: 25px; border-radius: 15px; margin-top: 40px;">
                <h3 style="color: #667eea; margin-bottom: 20px; text-align: center;">š’ Padomi labai receptei</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div style="text-align: center; padding: 15px;">
                        <div style="font-size: 2rem; margin-bottom: 10px;">š“ø</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">VizuÄli pievilcÄ«gs</h5>
                        <p style="color: #666; font-size: 13px;">Aprakstiet Ä“diena izskatu un faktÅ«ru</p>
                    </div>
                    <div style="text-align: center; padding: 15px;">
                        <div style="font-size: 2rem; margin-bottom: 10px;">ā¸±ļø¸</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">PrecÄ«zi laiki</h5>
                        <p style="color: #666; font-size: 13px;">NorÄdiet precÄ«zus sagatavoÅanas un gatavoÅanas laikus</p>
                    </div>
                    <div style="text-align: center; padding: 15px;">
                        <div style="font-size: 2rem; margin-bottom: 10px;">š“‹</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">Skaidras instrukcijas</h5>
                        <p style="color: #666; font-size: 13px;">Sadaliet procesu skaidros, viegli sekojamajos pasos</p>
                    </div>
                    <div style="text-align: center; padding: 15px;">
                        <div style="font-size: 2rem; margin-bottom: 10px;">š§‚</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">Pievienojiet personÄ«go pieskÄrienu</h5>
                        <p style="color: #666; font-size: 13px;">Dalieties ar Ä«paÅiem padomiem, variÄcijÄm vai pasniegÅanas idejÄm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Safe auto-calculate total time: check elements before using them
        function updateTotalTime() {
            const prepEl = document.getElementById('prep_time');
            const cookEl = document.getElementById('cook_time');
            const totalField = document.getElementById('total_time');

            if (!prepEl || !cookEl || !totalField) return;

            const prep = parseInt(prepEl.value) || 0;
            const cook = parseInt(cookEl.value) || 0;
            const total = prep + cook;

            if (total > 0) {
                totalField.value = total + ' min';
            } else {
                totalField.value = '';
            }
        }

        // Attach listeners only if inputs exist
        const prepInput = document.getElementById('prep_time');
        const cookInput = document.getElementById('cook_time');

        if (prepInput) prepInput.addEventListener('input', updateTotalTime);
        if (cookInput) cookInput.addEventListener('input', updateTotalTime);

        // Run once on load to initialize total_time if old values present
        document.addEventListener('DOMContentLoaded', updateTotalTime);
    </script>
</body>
</html>


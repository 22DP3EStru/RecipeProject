<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manas receptes - Recepšu Aplikācija</title>
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
            max-width: 1200px;
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

        .card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
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

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .recipe-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .recipe-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .recipe-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📝 Manas receptes</h1>
            <p>Jūsu personīgā recepšu kolekcija</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Vadības panelis</a>
                <a href="/recipes">🍽️ Receptes</a>
                <a href="/categories">📂 Kategorijas</a>
                <a href="/profile/recipes">📝 Manas receptes</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">🔧 Administrācija</a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 10px 20px; font-size: 14px;">Iziet</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Header -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); border-radius: 15px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">👨‍🍳</div>
                <h2 style="color: #56ab2f; margin-bottom: 15px;">{{ Auth::user()->name }} kulinārais profils</h2>
                <p style="color: #666; line-height: 1.6;">
                    Šeit ir visas jūsu izveidotās receptes. Dalieties ar saviem kulinārijas meistarišķumiem ar pasauli!
                </p>
            </div>

            <!-- Statistics -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 15px; text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">{{ $recipes->total() }}</div>
                    <div style="opacity: 0.9;">Kopā receptes</div>
                </div>
                <div style="background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); color: white; padding: 25px; border-radius: 15px; text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">{{ $recipes->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                    <div style="opacity: 0.9;">Šajā mēnesī</div>
                </div>
                <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 25px; border-radius: 15px; text-align: center;">
                    <div style="font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">{{ $recipes->unique('category')->count() }}</div>
                    <div style="opacity: 0.9;">Kategorijas</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="text-align: center; margin-bottom: 40px;">
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('recipes.create') }}" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                        📝 Izveidot jaunu recepti
                    </a>
                    <a href="/recipes" class="btn btn-primary" style="font-size: 18px; padding: 20px 40px;">
                        🔍 Pārlūkot visas receptes
                    </a>
                </div>
            </div>

            <!-- Recipes -->
            @if($recipes->count() > 0)
                <div class="recipe-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <h3 style="color: #56ab2f; margin-bottom: 15px; font-size: 1.3rem;">{{ $recipe->title }}</h3>
                            <p style="color: #666; margin-bottom: 15px; line-height: 1.5;">{{ Str::limit($recipe->description, 100) }}</p>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px; font-size: 14px; color: #888;">
                                <div>📂 {{ $recipe->category ?? 'Nav kategorijas' }}</div>
                                <div>⭐ {{ $recipe->difficulty ?? 'Nav norādīta' }}</div>
                                @if($recipe->prep_time || $recipe->cook_time)
                                    <div>⏱️ {{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} min</div>
                                @endif
                                @if($recipe->servings)
                                    <div>👥 {{ $recipe->servings }} porcijas</div>
                                @endif
                            </div>
                            
                            <div style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 15px; margin-bottom: 20px;">
                                <div style="font-size: 13px; color: #999; text-align: center;">
                                    Izveidots: {{ $recipe->created_at->format('d.m.Y H:i') }}
                                </div>
                            </div>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px;">
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="padding: 10px; font-size: 13px;">
                                    👁️ Skatīt
                                </a>
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning" style="padding: 10px; font-size: 13px;">
                                    ✏️ Rediģēt
                                </a>
                                <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" style="display: inline;" 
                                      onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 10px; font-size: 13px; width: 100%;">
                                        🗑️ Dzēst
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="display: flex; justify-content: center; margin-top: 40px;">
                    {{ $recipes->links() }}
                </div>
            @else
                <div class="card" style="text-align: center; padding: 60px;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">📝</div>
                    <h3 style="color: #56ab2f; margin-bottom: 15px;">Jūs vēl neesat izveidojis nevienu recepti</h3>
                    <p style="color: #666; margin-bottom: 30px; line-height: 1.6;">
                        Sāciet savu kulinārijas ceļojumu, izveidojot savu pirmo recepti! Dalieties ar savām mīļākajām receptēm ar kopienu.
                    </p>
                    <a href="{{ route('recipes.create') }}" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                        📝 Izveidot pirmo recepti
                    </a>
                </div>
            @endif

            <!-- Tips for Recipe Creation -->
            @if($recipes->count() < 5)
                <div class="card">
                    <h3 style="text-align: center; color: #333; margin-bottom: 25px;">💡 Padomi recepšu izveidošanai</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        <div style="background: rgba(102, 126, 234, 0.1); padding: 20px; border-radius: 12px;">
                            <h4 style="color: #667eea; margin-bottom: 10px;">📸 Pievienojiet fotogrāfijas</h4>
                            <p style="color: #666; line-height: 1.5; font-size: 14px;">Vizuāli pievilcīgas fotogrāfijas palielina receptes popularitāti.</p>
                        </div>
                        <div style="background: rgba(86, 171, 47, 0.1); padding: 20px; border-radius: 12px;">
                            <h4 style="color: #56ab2f; margin-bottom: 10px;">📝 Detalizēti apraksti</h4>
                            <p style="color: #666; line-height: 1.5; font-size: 14px;">Iekļaujiet precīzas sastāvdaļas un skaidras instrukcijas.</p>
                        </div>
                        <div style="background: rgba(240, 147, 251, 0.1); padding: 20px; border-radius: 12px;">
                            <h4 style="color: #f093fb; margin-bottom: 10px;">⏱️ Norādiet laikus</h4>
                            <p style="color: #666; line-height: 1.5; font-size: 14px;">Palīdziet citiem plānot ar precīziem gatavošanas laikiem.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

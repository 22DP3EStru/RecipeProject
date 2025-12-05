<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - Recepšu Aplikācija</title>
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
            max-width: 1000px;
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

        .recipe-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .meta-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .ingredients-list {
            background: rgba(86, 171, 47, 0.1);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .instructions-list {
            background: rgba(255, 193, 7, 0.1);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .recipe-meta { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🍽️ {{ $recipe->title }}</h1>
            <p>Autors: {{ $recipe->user->name }}</p>
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
                <a href="/recipes" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">← Atpakaļ uz receptēm</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Recipe Header -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 15px;">
                <h1 style="color: #667eea; margin-bottom: 15px; font-size: 2.5rem;">{{ $recipe->title }}</h1>
                <p style="color: #666; font-size: 18px; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                    {{ $recipe->description }}
                </p>
            </div>

            <!-- Recipe Meta Information -->
            <div class="recipe-meta">
                <div class="meta-item">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📂</div>
                    <h4 style="color: #667eea; margin-bottom: 5px;">Kategorija</h4>
                    <p style="color: #666; font-weight: 600;">{{ $recipe->category ?? 'Nav norādīta' }}</p>
                </div>
                
                <div class="meta-item">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">⭐</div>
                    <h4 style="color: #667eea; margin-bottom: 5px;">Grūtība</h4>
                    <p style="color: #666; font-weight: 600;">{{ $recipe->difficulty ?? 'Nav norādīta' }}</p>
                </div>
                
                @if($recipe->prep_time)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">🔪</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Sagatavošana</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->prep_time }} minūtes</p>
                    </div>
                @endif
                
                @if($recipe->cook_time)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">🔥</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Gatavošana</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->cook_time }} minūtes</p>
                    </div>
                @endif
                
                @if($recipe->prep_time && $recipe->cook_time)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">⏱️</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Kopā laiks</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->prep_time + $recipe->cook_time }} minūtes</p>
                    </div>
                @endif
                
                @if($recipe->servings)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">👥</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Porcijas</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->servings }} porcijas</p>
                    </div>
                @endif
            </div>

            <!-- Ingredients -->
            <div class="card">
                <div class="ingredients-list">
                    <h3 style="color: #56ab2f; margin-bottom: 20px; display: flex; align-items: center; font-size: 1.8rem;">
                        <span style="margin-right: 15px;">🥕</span>
                        Sastāvdaļas
                    </h3>
                    <div style="background: rgba(255, 255, 255, 0.7); padding: 25px; border-radius: 12px; border-left: 4px solid #56ab2f;">
                        @php
                            $ingredients = explode("\n", $recipe->ingredients);
                        @endphp
                        <ul style="list-style: none; padding: 0;">
                            @foreach($ingredients as $ingredient)
                                @if(trim($ingredient))
                                    <li style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.1); display: flex; align-items: center;">
                                        <span style="color: #56ab2f; margin-right: 10px; font-weight: bold;">✓</span>
                                        <span style="color: #333; font-size: 16px;">{{ trim($ingredient) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="card">
                <div class="instructions-list">
                    <h3 style="color: #ffc107; margin-bottom: 20px; display: flex; align-items: center; font-size: 1.8rem;">
                        <span style="margin-right: 15px;">👩‍🍳</span>
                        Gatavošanas instrukcijas
                    </h3>
                    <div style="background: rgba(255, 255, 255, 0.7); padding: 25px; border-radius: 12px; border-left: 4px solid #ffc107;">
                        @php
                            $instructions = explode("\n", $recipe->instructions);
                            $stepNumber = 1;
                        @endphp
                        <ol style="padding-left: 0; counter-reset: step-counter;">
                            @foreach($instructions as $instruction)
                                @if(trim($instruction))
                                    <li style="padding: 15px 0; border-bottom: 1px solid rgba(0,0,0,0.1); display: flex; align-items: flex-start; counter-increment: step-counter;">
                                        <span style="background: #ffc107; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; flex-shrink: 0; margin-top: 2px;">
                                            {{ $stepNumber++ }}
                                        </span>
                                        <span style="color: #333; font-size: 16px; line-height: 1.6;">{{ trim($instruction) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Recipe Author & Date -->
            <div class="card">
                <h3 style="color: #333; margin-bottom: 20px; text-align: center;">👨‍🍳 Par šo recepti</h3>
                <div style="background: rgba(102, 126, 234, 0.1); padding: 25px; border-radius: 12px; text-align: center;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                        <div>
                            <h4 style="color: #667eea; margin-bottom: 5px;">Receptes autors</h4>
                            <p style="color: #666; font-size: 18px; font-weight: 600;">{{ $recipe->user->name }}</p>
                        </div>
                        <div>
                            <h4 style="color: #667eea; margin-bottom: 5px;">Publicēts</h4>
                            <p style="color: #666; font-size: 16px;">{{ $recipe->created_at->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <h4 style="color: #667eea; margin-bottom: 5px;">Pēdējās izmaiņas</h4>
                            <p style="color: #666; font-size: 16px;">{{ $recipe->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                @if(Auth::id() === $recipe->user_id)
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning" style="font-size: 16px; padding: 15px 30px;">
                        ✏️ Rediģēt recepti
                    </a>
                    <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" style="display: inline;" 
                          onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti? Šo darbību nevar atsaukt.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 16px; padding: 15px 30px;">
                            🗑️ Dzēst recepti
                        </button>
                    </form>
                @endif
                
                <a href="/recipes" class="btn btn-primary" style="font-size: 16px; padding: 15px 30px;">
                    🔍 Pārlūkot citas receptes
                </a>
                
                <a href="{{ route('recipes.create') }}" class="btn btn-success" style="font-size: 16px; padding: 15px 30px;">
                    📝 Izveidot jaunu recepti
                </a>
            </div>

            <!-- Related Recipes -->
            @if(isset($relatedRecipes) && $relatedRecipes->count() > 0)
                <div class="card" style="margin-top: 40px;">
                    <h3 style="color: #333; margin-bottom: 25px; text-align: center;">🔍 Līdzīgas receptes</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        @foreach($relatedRecipes as $relatedRecipe)
                            <div style="background: rgba(102, 126, 234, 0.1); padding: 20px; border-radius: 12px; transition: transform 0.3s ease;" 
                                 onmouseover="this.style.transform='translateY(-5px)'" 
                                 onmouseout="this.style.transform='translateY(0)'">
                                <h4 style="color: #667eea; margin-bottom: 10px;">{{ $relatedRecipe->title }}</h4>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">{{ Str::limit($relatedRecipe->description, 80) }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #888; margin-bottom: 15px;">
                                    <span>{{ $relatedRecipe->category }}</span>
                                    <span>{{ $relatedRecipe->user->name }}</span>
                                </div>
                                <a href="{{ route('recipes.show', $relatedRecipe) }}" class="btn btn-primary" style="width: 100%; padding: 8px; font-size: 14px;">
                                    Skatīt recepti →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
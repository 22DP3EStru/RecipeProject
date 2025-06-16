<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manas iecienītākās receptes - Recepšu Aplikācija</title>
    <style>
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

        .recipes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .recipe-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
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

        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .recipes-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>❤️ Manas iecienītākās receptes</h1>
            <p>Jūsu saglabātās un iecienītākās receptes</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Vadības panelis</a>
                <a href="/recipes">🍽️ Receptes</a>
                <a href="{{ route('categories.index') }}">📂 Kategorijas</a>
                <a href="/profile/recipes">📝 Manas receptes</a>
                <a href="{{ route('profile.favorites') }}">❤️ Iecienītākās</a>
                <a href="{{ route('profile.edit') }}">⚙️ Profils</a>
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
            <!-- Breadcrumb -->
            <div style="margin-bottom: 30px; padding: 15px; background: rgba(255, 65, 108, 0.1); border-radius: 10px;">
                <a href="{{ route('profile.edit') }}" style="color: #ff416c; text-decoration: none;">⚙️ Profils</a> 
                <span style="color: #666;"> / </span>
                <span style="color: #333; font-weight: 600;">❤️ Iecienītākās receptes</span>
            </div>

            <!-- Favorites Info -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(255, 65, 108, 0.1) 0%, rgba(255, 75, 43, 0.1) 100%); border-radius: 15px;">
                <div style="font-size: 4rem; margin-bottom: 20px;">❤️</div>
                <h2 style="color: #ff416c; margin-bottom: 15px;">{{ $recipes->total() }} {{ $recipes->total() == 1 ? 'iecienītā recepte' : 'iecienītās receptes' }}</h2>
                <p style="color: #666; line-height: 1.6;">
                    Šeit ir visas jūsu iecienītākās un saglabātās receptes vienuviet.
                </p>
            </div>

            <!-- Recipes Grid -->
            @if($recipes->count() > 0)
                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h3 style="color: #667eea; font-size: 1.3rem;">
                                    {{ $recipe->title }}
                                </h3>
                                <button style="background: none; border: none; font-size: 1.5rem; color: #ff416c; cursor: pointer;" title="Noņemt no iecienītājiem">
                                    ❤️
                                </button>
                            </div>
                            
                            <p style="color: #666; margin-bottom: 15px; line-height: 1.5;">
                                {{ Str::limit($recipe->description, 100) }}
                            </p>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 14px; color: #999;">
                                <span>📂 {{ $recipe->category ?? 'Nav norādīta' }}</span>
                                <span>⏱️ {{ $recipe->prep_time ?? 'N/A' }} min</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                <span style="background: rgba(255, 65, 108, 0.1); color: #ff416c; padding: 5px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                                    {{ $recipe->difficulty ?? 'N/A' }}
                                </span>
                                <span style="color: #999; font-size: 12px;">
                                    {{ $recipe->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="flex: 1;">
                                    Skatīt recepti
                                </a>
                                <a href="{{ route('recipes.edit', $recipe) }}" class="btn" style="background: #6c757d; color: white; padding: 12px 20px;">
                                    ✏️
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="margin-top: 40px; display: flex; justify-content: center;">
                    {{ $recipes->links() }}
                </div>
            @else
                <!-- No Favorites -->
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">💔</div>
                    <h3 style="color: #666; margin-bottom: 15px;">Jums vēl nav iecienīto recepšu</h3>
                    <p style="color: #999; margin-bottom: 30px;">
                        Sāciet pārlūkot receptes un pievienojiet tās saviem iecienītajiem!
                    </p>
                    <div>
                        <a href="/recipes" class="btn btn-primary" style="margin-right: 15px;">
                            🔍 Pārlūkot receptes
                        </a>
                        <a href="/recipes/create" class="btn" style="background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); color: white;">
                            📝 Izveidot jaunu recepti
                        </a>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div style="margin-top: 40px; padding: 30px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;">
                <h3 style="text-align: center; color: #667eea; margin-bottom: 25px;">🚀 Ātras darbības</h3>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="/recipes" class="btn btn-primary">
                        🔍 Meklēt jaunas receptes
                    </a>
                    <a href="/profile/recipes" class="btn" style="background: #6c757d; color: white;">
                        📝 Manas receptes
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn" style="background: linear-gradient(135deg, #240b36 0%, #c31432 100%); color: white;">
                        📂 Kategorijas
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

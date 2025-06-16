<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepšu pārvaldība - Recepšu Aplikācija</title>
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
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
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
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 13px;
            margin: 2px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%);
            color: #56ab2f;
            border: 1px solid rgba(86, 171, 47, 0.2);
        }

        .stats-bar {
            display: flex;
            justify-content: space-around;
            background: rgba(102, 126, 234, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            margin: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .recipes-grid { grid-template-columns: 1fr; }
            .stats-bar { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🍽️ Recepšu pārvaldība</h1>
            <p>Pārvaldiet visas sistēmas receptes</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="{{ route('admin.index') }}">🔧 Admin panelis</a>
                <a href="{{ route('admin.users') }}">👥 Lietotāji</a>
                <a href="{{ route('admin.recipes') }}">🍽️ Receptes</a>
                <a href="/dashboard">🏠 Vadības panelis</a>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 12px;">Iziet</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Breadcrumb -->
            <div style="margin-bottom: 30px; padding: 15px; background: rgba(102, 126, 234, 0.1); border-radius: 10px;">
                <a href="{{ route('admin.index') }}" style="color: #667eea; text-decoration: none;">🔧 Admin panelis</a> 
                <span style="color: #666;"> / </span>
                <span style="color: #333; font-weight: 600;">🍽️ Recepšu pārvaldība</span>
            </div>

            <!-- Success Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Statistics -->
            <div class="stats-bar">
                @php
                    $categories = \App\Models\Recipe::distinct('category')->pluck('category')->filter();
                    $difficulties = \App\Models\Recipe::distinct('difficulty')->pluck('difficulty')->filter();
                @endphp
                <div class="stat-item">
                    <div class="stat-number">{{ $recipes->total() }}</div>
                    <div class="stat-label">Kopā recepšu</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $categories->count() }}</div>
                    <div class="stat-label">Kategorijas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $recipes->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                    <div class="stat-label">Jaunas šonedēļ</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ \App\Models\User::has('recipes')->count() }}</div>
                    <div class="stat-label">Aktīvi autori</div>
                </div>
            </div>

            <!-- Recipes Grid -->
            @if($recipes->count() > 0)
                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <!-- Recipe Header -->
                            <div style="margin-bottom: 15px;">
                                <h3 style="color: #667eea; margin-bottom: 8px; font-size: 1.3rem;">
                                    {{ $recipe->title }}
                                </h3>
                                <p style="color: #666; line-height: 1.5; margin-bottom: 10px;">
                                    {{ Str::limit($recipe->description, 100) }}
                                </p>
                            </div>

                            <!-- Recipe Meta -->
                            <div style="background: rgba(102, 126, 234, 0.05); padding: 15px; border-radius: 10px; margin-bottom: 15px;">
                                <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 8px;">
                                    <span style="color: #666;">👨‍🍳 Autors:</span>
                                    <span style="font-weight: 600;">{{ $recipe->user->name }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 8px;">
                                    <span style="color: #666;">📂 Kategorija:</span>
                                    <span style="background: rgba(102, 126, 234, 0.1); color: #667eea; padding: 2px 8px; border-radius: 10px; font-size: 12px;">
                                        {{ $recipe->category ?? 'Nav norādīta' }}
                                    </span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 8px;">
                                    <span style="color: #666;">📊 Grūtība:</span>
                                    <span style="background: rgba(255, 65, 108, 0.1); color: #ff416c; padding: 2px 8px; border-radius: 10px; font-size: 12px;">
                                        {{ $recipe->difficulty ?? 'N/A' }}
                                    </span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                    <span style="color: #666;">📅 Izveidots:</span>
                                    <span>{{ $recipe->created_at->format('d.m.Y H:i') }}</span>
                                </div>
                            </div>

                            <!-- Recipe Stats -->
                            <div style="display: flex; justify-content: space-between; font-size: 13px; color: #999; margin-bottom: 20px;">
                                <span>⏱️ {{ $recipe->prep_time ?? 'N/A' }} min</span>
                                <span>👥 {{ $recipe->servings ?? 'N/A' }} porcijas</span>
                                <span>🕒 {{ $recipe->created_at->diffForHumans() }}</span>
                            </div>

                            <!-- Action Buttons -->
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <!-- View Recipe -->
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary">
                                    👁️ Skatīt
                                </a>

                                <!-- Edit Recipe (if admin or owner) -->
                                @if(Auth::user()->is_admin || $recipe->user_id === Auth::id())
                                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-success">
                                        ✏️ Rediģēt
                                    </a>
                                @endif

                                <!-- Delete Recipe -->
                                <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Vai tiešām dzēst šo recepti? Šī darbība ir neatgriezeniska!')">
                                        🗑️ Dzēst
                                    </button>
                                </form>

                                <!-- View Author -->
                                <a href="/recipes?user={{ $recipe->user->id }}" class="btn btn-secondary">
                                    👤 Autora receptes
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
                <!-- No Recipes -->
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">🍽️</div>
                    <h3 style="color: #666; margin-bottom: 15px;">Nav recepšu</h3>
                    <p style="color: #999;">Nav atrasta neviena recepte sistēmā.</p>
                </div>
            @endif

            <!-- Quick Actions -->
            <div style="margin-top: 40px; padding: 30px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;">
                <h3 style="text-align: center; color: #667eea; margin-bottom: 25px;">🚀 Ātras darbības</h3>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">
                        🔧 Admin panelis
                    </a>
                    <a href="{{ route('admin.users') }}" class="btn btn-success">
                        👥 Pārvaldīt lietotājus
                    </a>
                    <a href="/recipes" class="btn btn-secondary">
                        🔍 Skatīt visas receptes
                    </a>
                    <a href="/dashboard" class="btn btn-secondary">
                        🏠 Vadības panelis
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
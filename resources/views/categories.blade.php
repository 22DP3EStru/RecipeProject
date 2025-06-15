<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Categories - Recipe App</title>
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

        .nav-user {
            color: #666;
            font-weight: 500;
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

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .grid {
            display: grid;
            gap: 25px;
        }

        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }

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

        .btn-logout {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
            padding: 10px 20px;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .recipe-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .text-center { text-align: center; }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📂 Recipe Categories</h1>
            <p>Explore recipes by category and discover new flavors</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recipe App</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Dashboard</a>
                <a href="/recipes">🍽️ Recipes</a>
                <a href="/categories">📂 Categories</a>
                <a href="/profile/recipes">📝 My Recipes</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">🔧 Admin</a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span class="nav-user">👤 {{ Auth::user()->name }}</span>
                <a href="/recipes/create" class="btn btn-success">+ Create Recipe</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Categories Statistics -->
            <div class="card">
                <h3 class="card-title">📊 Category Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">12</span>
                        <span class="stat-label">Total Categories</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                        <span class="stat-label">Total Recipes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::distinct('category')->count() }}</span>
                        <span class="stat-label">Categories Used</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', today())->count() }}</span>
                        <span class="stat-label">Recipes Today</span>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="card">
                <h3 class="card-title">🎯 Browse by Category</h3>
                @php
                    $categoryData = [
                        'Breakfast' => ['icon' => '🥞', 'description' => 'Start your day right'],
                        'Lunch' => ['icon' => '🥗', 'description' => 'Midday fuel for energy'],
                        'Dinner' => ['icon' => '🍽️', 'description' => 'Perfect evening meals'],
                        'Desserts' => ['icon' => '🍰', 'description' => 'Sweet treats & indulgences'],
                        'Appetizers' => ['icon' => '🥨', 'description' => 'Perfect party starters'],
                        'Main Dishes' => ['icon' => '🍖', 'description' => 'Hearty centerpiece meals'],
                        'Side Dishes' => ['icon' => '🥔', 'description' => 'Perfect accompaniments'],
                        'Beverages' => ['icon' => '🥤', 'description' => 'Refreshing drinks'],
                        'Snacks' => ['icon' => '🍿', 'description' => 'Quick bites & munchies'],
                        'Vegetarian' => ['icon' => '🥬', 'description' => 'Plant-based delights'],
                        'Vegan' => ['icon' => '🌱', 'description' => 'Completely plant-based'],
                        'Gluten-Free' => ['icon' => '🌾', 'description' => 'Safe for celiac diets']
                    ];
                @endphp

                <div class="grid grid-3">
                    @foreach($categoryData as $category => $data)
                        @php
                            $count = \App\Models\Recipe::where('category', $category)->count();
                        @endphp
                        <div class="recipe-card" style="text-align: center;">
                            <div style="font-size: 4rem; margin-bottom: 15px;">{{ $data['icon'] }}</div>
                            <h4 style="color: #667eea; margin-bottom: 10px; font-size: 1.3rem;">{{ $category }}</h4>
                            <p style="color: #666; margin-bottom: 15px; font-size: 14px;">{{ $data['description'] }}</p>
                            <div style="background: rgba(102, 126, 234, 0.05); padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                                <strong style="color: #667eea;">{{ $count }} recipes</strong>
                            </div>
                            @if($count > 0)
                                <a href="/recipes?category={{ urlencode($category) }}" class="btn btn-primary" style="width: 100%;">
                                    Explore {{ $category }}
                                </a>
                            @else
                                <a href="/recipes/create" class="btn btn-success" style="width: 100%;">
                                    Be the first!
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Popular Categories -->
            <div class="card">
                <h3 class="card-title">🔥 Most Popular Categories</h3>
                @php
                    $popularCategories = \App\Models\Recipe::select('category', \DB::raw('count(*) as total'))
                        ->groupBy('category')
                        ->orderBy('total', 'desc')
                        ->limit(6)
                        ->get();
                @endphp

                @if($popularCategories->count() > 0)
                    <div class="grid grid-3">
                        @foreach($popularCategories as $popular)
                            <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 20px; border-radius: 12px; text-align: center;">
                                <div style="font-size: 2.5rem; margin-bottom: 10px;">
                                    {{ $categoryData[$popular->category]['icon'] ?? '🍽️' }}
                                </div>
                                <h5 style="color: #667eea; margin-bottom: 8px;">{{ $popular->category }}</h5>
                                <div style="background: white; padding: 8px; border-radius: 6px; margin-bottom: 15px;">
                                    <strong style="color: #667eea;">{{ $popular->total }} recipes</strong>
                                </div>
                                <a href="/recipes?category={{ urlencode($popular->category) }}" class="btn btn-primary" style="font-size: 13px; padding: 8px 16px;">
                                    Explore →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">📂</div>
                        <p style="color: #666;">No recipes have been created yet.</p>
                        <a href="/recipes/create" class="btn btn-success" style="margin-top: 15px;">Create First Recipe</a>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <h3 class="card-title">🚀 Quick Actions</h3>
                <div class="grid grid-3">
                    <a href="/recipes/create" class="btn btn-success">📝 Create Recipe</a>
                    <a href="/recipes" class="btn btn-primary">🍽️ All Recipes</a>
                    <a href="/dashboard" class="btn btn-warning">🏠 Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
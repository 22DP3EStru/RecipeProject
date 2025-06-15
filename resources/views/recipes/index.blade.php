<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Recipes - Recipe App</title>
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

        .difficulty-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .difficulty-easy { background: #c8e6c9; color: #2e7d32; }
        .difficulty-medium { background: #fff3c4; color: #f57c00; }
        .difficulty-hard { background: #ffcdd2; color: #c62828; }

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
            <h1>🍽️ Browse Recipes</h1>
            <p>Discover amazing recipes from our community</p>
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
            <!-- Search and Filters -->
            <div class="card">
                <h3 class="card-title">🔍 Find Your Perfect Recipe</h3>
                <form method="GET" action="{{ route('recipes.index') }}">
                    <div class="grid grid-4" style="margin-bottom: 25px;">
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="form-label">Search Recipes</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-input" placeholder="Search recipes...">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Difficulty</label>
                            <select name="difficulty" class="form-select">
                                <option value="">All Difficulties</option>
                                <option value="Easy" {{ request('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                                <option value="Medium" {{ request('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Hard" {{ request('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <button type="submit" class="btn btn-primary">🔍 Search</button>
                        <a href="{{ route('recipes.index') }}" class="btn btn-danger">Clear</a>
                    </div>
                </form>
            </div>

            <!-- Recipe Statistics -->
            <div class="card">
                <h3 class="card-title">📊 Recipe Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">{{ $recipes->total() }}</span>
                        <span class="stat-label">Total Recipes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ count($categories) }}</span>
                        <span class="stat-label">Categories</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', '>=', now()->subDays(7))->count() }}</span>
                        <span class="stat-label">This Week</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', today())->count() }}</span>
                        <span class="stat-label">Today</span>
                    </div>
                </div>
            </div>

            <!-- Recipes -->
            @if($recipes->count() > 0)
                <div class="card">
                    <h3 class="card-title">🍽️ All Recipes ({{ $recipes->total() }})</h3>
                    <div class="grid grid-3">
                        @foreach($recipes as $recipe)
                            <div class="recipe-card">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                    <h4 style="margin: 0; color: #667eea; font-size: 1.1rem;">{{ $recipe->title }}</h4>
                                    <span class="difficulty-badge difficulty-{{ strtolower($recipe->difficulty) }}">
                                        {{ $recipe->difficulty }}
                                    </span>
                                </div>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">{{ Str::limit($recipe->description, 80) }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 13px; color: #999;">
                                    <span>By {{ $recipe->user->name }}</span>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="width: 100%; padding: 10px;">View Recipe →</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="card text-center">
                    <div style="padding: 40px;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">🔍</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">No recipes found</h4>
                        <p style="color: #666; margin-bottom: 25px;">Try adjusting your search or create a new recipe!</p>
                        <a href="/recipes/create" class="btn btn-success">Create Recipe</a>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="card">
                <h3 class="card-title">🚀 Quick Actions</h3>
                <div class="grid grid-3">
                    <a href="/recipes/create" class="btn btn-success">📝 Create Recipe</a>
                    <a href="/categories" class="btn btn-warning">📂 Categories</a>
                    <a href="/dashboard" class="btn btn-primary">🏠 Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
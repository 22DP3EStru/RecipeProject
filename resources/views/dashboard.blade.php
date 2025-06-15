<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('test-dashboard');
})->middleware(['auth'])->name('dashboard');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Recipe App</title>
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

        /* Header */
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

        /* Navigation */
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

        /* Main Content */
        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Cards */
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

        /* Grid */
        .grid {
            display: grid;
            gap: 25px;
        }

        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }

        /* Buttons */
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

        .btn-logout {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
            padding: 10px 20px;
            font-size: 14px;
        }

        /* Stats */
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

        /* Admin Alert */
        .admin-alert {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            text-align: center;
            box-shadow: 0 8px 25px rgba(255, 65, 108, 0.3);
        }

        /* Recipe Cards */
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

        /* Responsive */
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
            <h1>🍽️ Recipe App Dashboard</h1>
            <p>Welcome back, {{ Auth::user()->name }}!</p>
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
                <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-logout">Logout</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Admin Alert -->
            @if(Auth::user()->is_admin)
                <div class="admin-alert">
                    <h3 style="margin-bottom: 15px;">🔥 ADMINISTRATOR ACCESS</h3>
                    <p style="margin-bottom: 20px;">You have full administrative privileges to manage the platform.</p>
                    <a href="{{ route('admin.index') }}" class="btn btn-warning">🔧 Admin Panel</a>
                </div>
            @endif

            <!-- User Info -->
            <div class="card">
                <h3 class="card-title">👤 Account Information</h3>
                <div class="grid grid-2">
                    <div>
                        <p style="margin-bottom: 10px;"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p style="margin-bottom: 10px;"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <p style="margin-bottom: 10px;"><strong>Member Since:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
                        <p style="margin-bottom: 10px;"><strong>Account Type:</strong> 
                            @if(Auth::user()->is_admin)
                                <span style="color: #ff4b2b; font-weight: bold;">🔧 Administrator</span>
                            @else
                                <span style="color: #56ab2f; font-weight: bold;">👤 Regular User</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions - Removed one button -->
            <div class="card">
                <h3 class="card-title">🚀 Quick Actions</h3>
                <div class="grid grid-3">
                    <a href="/recipes/create" class="btn btn-success">📝 Create Recipe</a>
                    <a href="/recipes" class="btn btn-primary">🍽️ Browse Recipes</a>
                    <a href="/profile/recipes" class="btn btn-warning">📋 My Recipes</a>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card">
                <h3 class="card-title">📊 Platform Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::count() }}</span>
                        <span class="stat-label">Total Users</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                        <span class="stat-label">Total Recipes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::where('user_id', Auth::id())->count() }}</span>
                        <span class="stat-label">Your Recipes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::whereDate('created_at', today())->count() }}</span>
                        <span class="stat-label">New Today</span>
                    </div>
                </div>
            </div>

            <!-- Recent Recipes -->
            <div class="card">
                <h3 class="card-title">🆕 Latest Recipes</h3>
                @php
                    $recentRecipes = \App\Models\Recipe::with('user')->latest()->take(6)->get();
                @endphp
                
                @if($recentRecipes->count() > 0)
                    <div class="grid grid-3">
                        @foreach($recentRecipes as $recipe)
                            <div class="recipe-card">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                    <h4 style="margin: 0; color: #667eea; font-size: 1.1rem;">{{ $recipe->title }}</h4>
                                    <span class="difficulty-badge difficulty-{{ strtolower($recipe->difficulty) }}">
                                        {{ $recipe->difficulty }}
                                    </span>
                                </div>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px; line-height: 1.4;">{{ Str::limit($recipe->description, 80) }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 13px; color: #999;">
                                    <span>By {{ $recipe->user->name }}</span>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary" style="width: 100%; padding: 10px;">View Recipe →</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">🍽️</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">No recipes created yet</h4>
                        <p style="color: #666; margin-bottom: 25px;">Be the first to share a delicious recipe!</p>
                        <a href="/recipes/create" class="btn btn-success">Create First Recipe</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Logout Form -->
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>

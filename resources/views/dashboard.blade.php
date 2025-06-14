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
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 20px; 
            background: #f5f5f5; 
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header { 
            border-bottom: 2px solid #007cba; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px; 
            margin: 20px 0; 
        }
        .card { 
            background: #f9f9f9; 
            padding: 20px; 
            border-radius: 8px; 
            border: 1px solid #ddd; 
        }
        .btn { 
            display: inline-block; 
            background: #007cba; 
            color: white; 
            padding: 12px 24px; 
            text-decoration: none; 
            border-radius: 5px; 
            margin: 5px; 
            transition: background 0.3s; 
        }
        .btn:hover { 
            background: #005a8b; 
        }
        .btn-green { background: #28a745; }
        .btn-green:hover { background: #218838; }
        .btn-red { background: #dc3545; }
        .btn-red:hover { background: #c82333; }
        .btn-purple { background: #6f42c1; }
        .btn-purple:hover { background: #5a2d91; }
        .stats { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
            gap: 15px; 
            margin: 20px 0; 
        }
        .stat-box { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; 
            padding: 20px; 
            border-radius: 8px; 
            text-align: center; 
        }
        .stat-number { 
            font-size: 2rem; 
            font-weight: bold; 
            display: block; 
        }
        .admin-alert {
            background: #ffebee;
            border: 2px solid #f44336;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .admin-alert h3 {
            color: #d32f2f;
            margin: 0 0 10px 0;
        }
        .navigation {
            background: #333;
            padding: 15px;
            margin: -30px -30px 30px -30px;
            border-radius: 10px 10px 0 0;
        }
        .navigation a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .navigation a:hover {
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <div class="navigation">
            <a href="/dashboard">🏠 Dashboard</a>
            <a href="/recipes">🍽️ All Recipes</a>
            <a href="/categories">📂 Categories</a>
            <a href="/profile/recipes">📝 My Recipes</a>
            @if(Auth::user()->is_admin)
                <a href="/admin">🔧 Admin Panel</a>
            @endif
            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="float: right;">🚪 Logout</a>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
            <p>Your Recipe Dashboard</p>
        </div>

        <!-- User Info -->
        <div class="card">
            <h3>Your Account Information</h3>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Member Since:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
            <p><strong>Account Type:</strong> 
                @if(Auth::user()->is_admin)
                    <span style="color: red; font-weight: bold;">🔧 ADMINISTRATOR</span>
                @else
                    <span style="color: green;">👤 Regular User</span>
                @endif
            </p>
        </div>

        <!-- Admin Alert -->
        @if(Auth::user()->is_admin)
            <div class="admin-alert">
                <h3>🔥 ADMIN ACCESS DETECTED</h3>
                <p>You have administrator privileges. You can manage users, recipes, and access the admin panel.</p>
                <a href="/admin" class="btn btn-red">🔧 Go to Admin Panel</a>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="card">
            <h3>Quick Actions</h3>
            <div style="text-align: center;">
                <a href="/recipes/create" class="btn btn-green">📝 Create New Recipe</a>
                <a href="/recipes" class="btn">🍽️ Browse All Recipes</a>
                <a href="/categories" class="btn btn-purple">📂 Browse Categories</a>
                <a href="/profile/recipes" class="btn">📋 My Recipes</a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats">
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\User::count() }}</span>
                <span>Total Users</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                <span>Total Recipes</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\Recipe::where('user_id', Auth::id())->count() }}</span>
                <span>Your Recipes</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ \App\Models\User::whereDate('created_at', today())->count() }}</span>
                <span>New Users Today</span>
            </div>
        </div>

        <!-- Recent Recipes -->
        <div class="card">
            <h3>Latest Recipes on the Site</h3>
            @php
                $recentRecipes = \App\Models\Recipe::with('user')->latest()->take(5)->get();
            @endphp
            
            @if($recentRecipes->count() > 0)
                @foreach($recentRecipes as $recipe)
                    <div style="border-bottom: 1px solid #eee; padding: 10px 0; margin: 10px 0;">
                        <h4 style="margin: 0; color: #007cba;">{{ $recipe->title }}</h4>
                        <p style="margin: 5px 0; color: #666; font-size: 14px;">{{ Str::limit($recipe->description, 100) }}</p>
                        <p style="margin: 5px 0; font-size: 12px; color: #999;">
                            By {{ $recipe->user->name }} • {{ $recipe->created_at->diffForHumans() }} • {{ $recipe->category }}
                        </p>
                        <a href="/recipes/{{ $recipe->id }}" style="color: #007cba; text-decoration: none; font-size: 14px;">View Recipe →</a>
                    </div>
                @endforeach
            @else
                <p style="text-align: center; color: #666; padding: 20px;">
                    No recipes created yet. <a href="/recipes/create" style="color: #007cba;">Be the first to create one!</a>
                </p>
            @endif
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666;">
            <p>Recipe App Dashboard • {{ now()->format('Y') }}</p>
        </div>

        <!-- Logout Form -->
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Recipe App</title>
    <link rel="stylesheet" href="/css/welcome-style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔧 Admin Panel</h1>
            <p>Manage users, recipes, and platform settings</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recipe App</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Dashboard</a>
                <a href="/recipes">🍽️ Recipes</a>
                <a href="/categories">📂 Categories</a>
                <a href="/profile/recipes">📝 My Recipes</a>
                <a href="{{ route('admin.index') }}">🔧 Admin</a>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span class="nav-user">👤 {{ Auth::user()->name }} (Admin)</span>
                <a href="/dashboard" class="btn btn-logout">← Dashboard</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Admin Warning -->
            <div class="admin-alert">
                <h3 style="margin-bottom: 15px;">⚠️ ADMINISTRATOR ACCESS</h3>
                <p style="margin: 0;">You have full administrative privileges. Use these tools responsibly to manage the Recipe App platform.</p>
            </div>

            <!-- Platform Overview -->
            <div class="card">
                <h3 class="card-title">📊 Platform Overview</h3>
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
                        <span class="stat-number">{{ \App\Models\User::where('is_admin', true)->count() }}</span>
                        <span class="stat-label">Administrators</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::whereDate('created_at', today())->count() }}</span>
                        <span class="stat-label">New Users Today</span>
                    </div>
                </div>
            </div>

            <!-- Management Tools -->
            <div class="card">
                <h3 class="card-title">🛠️ Management Tools</h3>
                <div class="grid grid-2">
                    <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 30px; border-radius: 15px; text-align: center;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">👥</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">User Management</h4>
                        <p style="color: #666; margin-bottom: 20px; line-height: 1.5;">View, edit, and manage user accounts. Monitor user activity and handle account issues.</p>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary" style="width: 100%;">Manage Users</a>
                    </div>
                    
                    <div style="background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); padding: 30px; border-radius: 15px; text-align: center;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">🍽️</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">Recipe Management</h4>
                        <p style="color: #666; margin-bottom: 20px; line-height: 1.5;">Moderate and manage all recipes. Review content and handle inappropriate submissions.</p>
                        <a href="{{ route('admin.recipes') }}" class="btn btn-success" style="width: 100%;">Manage Recipes</a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-2">
                <!-- Recent Users -->
                <div class="card">
                    <h3 class="card-title">🆕 Recent Users</h3>
                    @php
                        $recentUsers = \App\Models\User::latest()->take(5)->get();
                    @endphp
                    
                    @if($recentUsers->count() > 0)
                        <div>
                            @foreach($recentUsers as $user)
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: rgba(102, 126, 234, 0.05); border-radius: 10px; margin-bottom: 12px;">
                                    <div>
                                        <strong style="color: #667eea;">{{ $user->name }}</strong>
                                        @if($user->is_admin)
                                            <span style="color: #ff4b2b; font-size: 12px; font-weight: 600;">(Admin)</span>
                                        @endif
                                        <br>
                                        <small style="color: #666;">{{ $user->email }}</small>
                                    </div>
                                    <div style="text-align: right; font-size: 12px; color: #999;">
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('admin.users') }}" class="btn btn-primary">View All Users</a>
                        </div>
                    @else
                        <div style="text-align: center; padding: 30px;">
                            <p style="color: #666;">No users found</p>
                        </div>
                    @endif
                </div>

                <!-- Recent Recipes -->
                <div class="card">
                    <h3 class="card-title">🍽️ Recent Recipes</h3>
                    @php
                        $recentRecipes = \App\Models\Recipe::with('user')->latest()->take(5)->get();
                    @endphp
                    
                    @if($recentRecipes->count() > 0)
                        <div>
                            @foreach($recentRecipes as $recipe)
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: rgba(86, 171, 47, 0.05); border-radius: 10px; margin-bottom: 12px;">
                                    <div>
                                        <strong style="color: #667eea;">{{ Str::limit($recipe->title, 30) }}</strong>
                                        <br>
                                        <small style="color: #666;">By {{ $recipe->user->name }}</small>
                                    </div>
                                    <div style="text-align: right; font-size: 12px; color: #999;">
                                        {{ $recipe->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('admin.recipes') }}" class="btn btn-success">View All Recipes</a>
                        </div>
                    @else
                        <div style="text-align: center; padding: 30px;">
                            <p style="color: #666;">No recipes found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- System Information -->
            <div class="card">
                <h3 class="card-title">ℹ️ System Information</h3>
                <div style="background: rgba(102, 126, 234, 0.05); padding: 25px; border-radius: 12px;">
                    <div class="grid grid-3">
                        <div style="text-align: center;">
                            <strong style="color: #667eea;">Laravel Version</strong><br>
                            <span style="color: #666; font-size: 18px;">{{ app()->version() }}</span>
                        </div>
                        <div style="text-align: center;">
                            <strong style="color: #667eea;">PHP Version</strong><br>
                            <span style="color: #666; font-size: 18px;">{{ PHP_VERSION }}</span>
                        </div>
                        <div style="text-align: center;">
                            <strong style="color: #667eea;">Environment</strong><br>
                            <span style="color: #666; font-size: 18px;">{{ app()->environment() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

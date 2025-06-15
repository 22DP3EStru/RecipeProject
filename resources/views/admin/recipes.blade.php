<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Recipes - Admin Panel</title>
    <link rel="stylesheet" href="/css/welcome-style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🍽️ Recipe Management</h1>
            <p>Moderate and manage all recipes on the platform</p>
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
                <a href="{{ route('admin.index') }}" class="btn btn-logout">← Admin Panel</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Admin Warning -->
            <div class="admin-alert">
                <h3 style="margin-bottom: 15px;">⚠️ RECIPE MANAGEMENT PANEL</h3>
                <p style="margin: 0;">You are managing all recipes on the platform. Use caution when deleting recipes as this action is permanent.</p>
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
                        <span class="stat-number">{{ \App\Models\Recipe::distinct('category')->count() }}</span>
                        <span class="stat-label">Categories Used</span>
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

            <!-- Recipes List -->
            @if($recipes->count() > 0)
                <div class="card">
                    <h3 class="card-title">📋 All Recipes ({{ $recipes->total() }} total)</h3>
                    
                    <div class="grid grid-2">
                        @foreach($recipes as $recipe)
                            <div style="background: rgba(102, 126, 234, 0.05); padding: 20px; border-radius: 12px; border-left: 4px solid #667eea;">
                                <!-- Recipe Header -->
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                    <div>
                                        <h4 style="margin: 0; color: #667eea; font-size: 1.2rem;">{{ $recipe->title }}</h4>
                                        <span class="difficulty-badge difficulty-{{ strtolower($recipe->difficulty) }}" style="margin-top: 8px; display: inline-block;">
                                            {{ $recipe->difficulty }}
                                        </span>
                                    </div>
                                    <div style="text-align: right; font-size: 12px; color: #999;">
                                        ID: {{ $recipe->id }}
                                    </div>
                                </div>

                                <!-- Recipe Description -->
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px; line-height: 1.4;">
                                    {{ Str::limit($recipe->description, 120) }}
                                </p>

                                <!-- Recipe Info -->
                                <div style="background: white; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                                    <div class="grid grid-2" style="gap: 10px; font-size: 13px;">
                                        <div><strong>Category:</strong> {{ $recipe->category }}</div>
                                        <div><strong>Author:</strong> {{ $recipe->user->name }}</div>
                                        @if($recipe->servings)
                                            <div><strong>Servings:</strong> {{ $recipe->servings }}</div>
                                        @endif
                                        @if($recipe->prep_time || $recipe->cook_time)
                                            <div><strong>Total Time:</strong> {{ $recipe->totalTime() }} min</div>
                                        @endif
                                        <div><strong>Created:</strong> {{ $recipe->created_at->format('M j, Y') }}</div>
                                        <div><strong>Updated:</strong> {{ $recipe->updated_at->diffForHumans() }}</div>
                                    </div>
                                </div>

                                <!-- Admin Actions -->
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                    <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary" style="flex: 1; font-size: 12px; padding: 8px;">
                                        👁️ View
                                    </a>
                                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning" style="flex: 1; font-size: 12px; padding: 8px;">
                                        ✏️ Edit
                                    </a>
                                    <button onclick="deleteRecipe('{{ $recipe->id }}', '{{ e($recipe->title) }}')" class="btn btn-danger" style="flex: 1; font-size: 12px; padding: 8px;">
                                        🗑️ Delete
                                    </button>
                                </div>

                                <!-- Delete Form (Hidden) -->
                                <form id="delete-recipe-form-{{ $recipe->id }}" method="POST" action="{{ route('admin.delete-recipe', $recipe->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($recipes->hasPages())
                        <div style="margin-top: 30px;">
                            <div style="display: flex; justify-content: center; align-items: center; gap: 15px;">
                                @if($recipes->onFirstPage())
                                    <span class="btn btn-danger" style="opacity: 0.5;">← Previous</span>
                                @else
                                    <a href="{{ $recipes->previousPageUrl() }}" class="btn btn-primary">← Previous</a>
                                @endif

                                <span style="color: #666; font-weight: 500; margin: 0 20px;">
                                    Page {{ $recipes->currentPage() }} of {{ $recipes->lastPage() }}
                                </span>

                                @if($recipes->hasMorePages())
                                    <a href="{{ $recipes->nextPageUrl() }}" class="btn btn-primary">Next →</a>
                                @else
                                    <span class="btn btn-danger" style="opacity: 0.5;">Next →</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="card text-center">
                    <div style="padding: 60px;">
                        <div style="font-size: 6rem; margin-bottom: 25px;">🍽️</div>
                        <h3 style="color: #667eea; margin-bottom: 15px;">No recipes found</h3>
                        <p style="color: #666; margin-bottom: 25px;">No recipes have been created yet. Encourage users to start sharing their culinary creations!</p>
                        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                            <a href="/recipes/create" class="btn btn-success">📝 Create First Recipe</a>
                            <a href="{{ route('admin.index') }}" class="btn btn-primary">← Back to Admin Panel</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Category Breakdown -->
            <div class="card">
                <h3 class="card-title">📂 Recipes by Category</h3>
                @php
                    $categoryStats = \App\Models\Recipe::select('category', \DB::raw('count(*) as total'))
                        ->groupBy('category')
                        ->orderBy('total', 'desc')
                        ->get();
                @endphp
                
                @if($categoryStats->count() > 0)
                    <div class="grid grid-4">
                        @foreach($categoryStats as $stat)
                            <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 20px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 2rem; margin-bottom: 10px;">
                                    @switch($stat->category)
                                        @case('Breakfast') 🥞 @break
                                        @case('Lunch') 🥗 @break
                                        @case('Dinner') 🍽️ @break
                                        @case('Desserts') 🍰 @break
                                        @case('Appetizers') 🥨 @break
                                        @case('Beverages') 🥤 @break
                                        @default 🍽️ @break
                                    @endswitch
                                </div>
                                <h5 style="margin: 0; color: #667eea; font-size: 14px;">{{ $stat->category }}</h5>
                                <p style="color: #666; font-size: 18px; font-weight: bold; margin: 10px 0;">{{ $stat->total }}</p>
                                <a href="/recipes?category={{ urlencode($stat->category) }}" class="btn btn-primary" style="font-size: 11px; padding: 6px 12px;">
                                    View All
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 30px;">
                        <p style="color: #666;">No recipes available for category breakdown.</p>
                    </div>
                @endif
            </div>

            <!-- Admin Actions -->
            <div class="card">
                <h3 class="card-title">🛠️ Admin Actions</h3>
                <div class="grid grid-3">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">🔧 Admin Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="btn btn-warning">👥 Manage Users</a>
                    <a href="/dashboard" class="btn btn-success">🏠 Main Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteRecipe(recipeId, recipeTitle) {
            if (confirm(`Are you sure you want to delete the recipe "${recipeTitle}"? This action cannot be undone.`)) {
                document.getElementById('delete-recipe-form-' + recipeId).submit();
            }
        }
    </script>
</body>
</html>
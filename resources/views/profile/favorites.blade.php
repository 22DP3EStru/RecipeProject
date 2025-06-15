<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites - Recipe App</title>
    <link rel="stylesheet" href="/css/welcome-style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>❤️ My Favorites</h1>
            <p>Your saved recipe collection</p>
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
                <a href="/dashboard" class="btn btn-logout">← Dashboard</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Coming Soon Info -->
            <div class="alert alert-info">
                <h4 style="margin-bottom: 15px;">💡 Coming Soon: Favorites System</h4>
                <p style="margin: 0; line-height: 1.6;">
                    The favorites feature is currently under development. Soon you'll be able to save your favorite recipes 
                    for quick access and create personalized collections. In the meantime, check out all available recipes 
                    or create your own!
                </p>
            </div>

            @if(isset($favorites) && $favorites->count() > 0)
                <div class="grid grid-3">
                    @foreach($favorites as $favorite)
                        <div class="recipe-card">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <h4 style="margin: 0; color: #667eea;">{{ $favorite->recipe->title }}</h4>
                                <span class="difficulty-badge difficulty-{{ strtolower($favorite->recipe->difficulty) }}">
                                    {{ $favorite->recipe->difficulty }}
                                </span>
                            </div>
                            
                            <p style="color: #666; font-size: 14px; margin-bottom: 15px; line-height: 1.4;">
                                {{ Str::limit($favorite->recipe->description, 100) }}
                            </p>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 13px; color: #999;">
                                <span>By {{ $favorite->recipe->user->name }}</span>
                                <span>Added {{ $favorite->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <a href="/recipes/{{ $favorite->recipe->id }}" class="btn btn-primary" style="width: 100%;">
                                🍽️ View Recipe
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card text-center">
                    <div style="padding: 60px;">
                        <div style="font-size: 8rem; margin-bottom: 30px;">💔</div>
                        <h3 style="color: #667eea; margin-bottom: 20px;">No favorite recipes yet</h3>
                        <p style="color: #666; margin-bottom: 35px; line-height: 1.8; font-size: 16px;">
                            Start exploring our amazing collection of recipes and save your favorites!<br>
                            Discover new flavors, cooking techniques, and culinary inspiration from our community.
                        </p>
                        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                            <a href="/recipes" class="btn btn-primary" style="font-size: 16px; padding: 15px 30px;">🍽️ Browse All Recipes</a>
                            <a href="/categories" class="btn btn-warning" style="font-size: 16px; padding: 15px 30px;">📂 Browse Categories</a>
                            <a href="/recipes/create" class="btn btn-success" style="font-size: 16px; padding: 15px 30px;">📝 Create Recipe</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Discover Recipes Section -->
            <div class="card">
                <h3 class="card-title">🚀 Discover More Recipes</h3>
                <p style="text-align: center; color: #666; margin-bottom: 25px;">
                    Explore our recipe collection and find your next culinary adventure
                </p>
                <div class="grid grid-4">
                    <a href="/recipes?category=Breakfast" class="btn btn-primary">🥞 Breakfast</a>
                    <a href="/recipes?category=Lunch" class="btn btn-success">🥗 Lunch</a>
                    <a href="/recipes?category=Dinner" class="btn btn-warning">🍽️ Dinner</a>
                    <a href="/recipes?category=Desserts" class="btn btn-danger">🍰 Desserts</a>
                </div>
            </div>

            <!-- Recent Recipes Suggestions -->
            <div class="card">
                <h3 class="card-title">🆕 Latest Recipes You Might Like</h3>
                @php
                    $suggestedRecipes = \App\Models\Recipe::with('user')->where('user_id', '!=', Auth::id())->latest()->take(6)->get();
                @endphp
                
                @if($suggestedRecipes->count() > 0)
                    <div class="grid grid-3">
                        @foreach($suggestedRecipes as $recipe)
                            <div class="recipe-card">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
                                    <h5 style="margin: 0; color: #667eea; font-size: 16px;">{{ Str::limit($recipe->title, 35) }}</h5>
                                    <span class="difficulty-badge difficulty-{{ strtolower($recipe->difficulty) }}" style="font-size: 10px; padding: 4px 8px;">
                                        {{ $recipe->difficulty }}
                                    </span>
                                </div>
                                <p style="color: #666; font-size: 13px; margin-bottom: 12px; line-height: 1.4;">{{ Str::limit($recipe->description, 80) }}</p>
                                <div style="background: rgba(102, 126, 234, 0.05); padding: 8px; border-radius: 6px; margin-bottom: 12px; font-size: 12px;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span><strong>Category:</strong> {{ $recipe->category }}</span>
                                        <span><strong>By:</strong> {{ Str::limit($recipe->user->name, 15) }}</span>
                                    </div>
                                </div>
                                <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 13px;">
                                    View Recipe →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px;">
                        <p style="color: #666;">No recipes available yet. Be the first to create one!</p>
                        <a href="/recipes/create" class="btn btn-success" style="margin-top: 15px;">Create First Recipe</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

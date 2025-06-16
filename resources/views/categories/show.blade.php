<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $categoryName ?? 'Kategorija' }} - Recepšu Aplikācija</title>
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
            <h1>📂 {{ $categoryName ?? 'Kategorija' }}</h1>
            <p>Receptes kategorijā "{{ $categoryName ?? 'Nezināma kategorija' }}"</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Vadības panelis</a>
                <a href="/recipes">🍽️ Receptes</a>
                <a href="{{ route('categories.index') }}">📂 Kategorijas</a>
                <a href="/profile/recipes">📝 Manas receptes</a>
                <a href="{{ route('profile.edit') }}">⚙️ Profils</a>
                @if(Auth::user() && Auth::user()->is_admin)
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
            <div style="margin-bottom: 30px; padding: 15px; background: rgba(102, 126, 234, 0.1); border-radius: 10px;">
                <a href="{{ route('categories.index') }}" style="color: #667eea; text-decoration: none;">📂 Kategorijas</a> 
                <span style="color: #666;"> / </span>
                <span style="color: #333; font-weight: 600;">{{ $categoryName ?? 'Kategorija' }}</span>
            </div>

            <!-- Category Info -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); border-radius: 15px;">
                <h2 style="color: #56ab2f; margin-bottom: 15px;">
                    {{ isset($recipes) ? $recipes->total() : 0 }} 
                    {{ isset($recipes) && $recipes->total() == 1 ? 'recepte' : 'receptes' }}
                </h2>
                <p style="color: #666; line-height: 1.6;">
                    Atklājiet visas receptes kategorijā "{{ $categoryName ?? 'Nezināma kategorija' }}"
                </p>
            </div>

            <!-- Recipes Grid -->
            @if(isset($recipes) && $recipes->count() > 0)
                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <h3 style="color: #667eea; margin-bottom: 15px; font-size: 1.3rem;">
                                {{ $recipe->title }}
                            </h3>
                            <p style="color: #666; margin-bottom: 15px; line-height: 1.5;">
                                {{ Str::limit($recipe->description, 100) }}
                            </p>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 14px; color: #999;">
                                <span>👨‍🍳 {{ $recipe->user->name ?? 'Nezināms' }}</span>
                                <span>⏱️ {{ $recipe->prep_time ?? 'N/A' }} min</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                <span style="background: rgba(102, 126, 234, 0.1); color: #667eea; padding: 5px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                                    {{ $recipe->difficulty ?? 'N/A' }}
                                </span>
                                <span style="color: #999; font-size: 12px;">
                                    {{ $recipe->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="width: 100%;">
                                Skatīt recepti →
                            </a>
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
                    <h3 style="color: #666; margin-bottom: 15px;">Nav recepšu šajā kategorijā</h3>
                    <p style="color: #999; margin-bottom: 30px;">
                        Kategorijā "{{ $categoryName ?? 'Nezināma kategorija' }}" vēl nav pievienota neviena recepte.
                    </p>
                    <div>
                        <a href="/recipes/create" class="btn btn-primary" style="margin-right: 15px;">
                            📝 Izveidot jaunu recepti
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn" style="background: #6c757d; color: white;">
                            ← Atpakaļ uz kategorijām
                        </a>
                    </div>
                </div>
            @endif

            <!-- Other Categories -->
            @if(isset($allCategories) && $allCategories->count() > 1)
                <div style="margin-top: 50px; padding: 30px; background: rgba(240, 147, 251, 0.1); border-radius: 15px;">
                    <h3 style="text-align: center; color: #f093fb; margin-bottom: 25px;">🔍 Citas kategorijas</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
                        @foreach($allCategories as $cat)
                            @if($cat !== ($categoryName ?? ''))
                                <a href="{{ route('categories.show', urlencode($cat)) }}" 
                                   style="background: rgba(240, 147, 251, 0.2); color: #f093fb; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.3s ease;"
                                   onmouseover="this.style.background='rgba(240, 147, 251, 0.3)'"
                                   onmouseout="this.style.background='rgba(240, 147, 251, 0.2)'">
                                    {{ $cat }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @auth
    <script>
    function toggleFavorite(recipeId) {
        fetch(`/favorites/${recipeId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the heart icon
                const button = event.target.closest('button');
                const svg = button.querySelector('svg');
                if (data.favorited) {
                    svg.classList.add('text-red-500', 'fill-current');
                    svg.classList.remove('text-gray-600');
                } else {
                    svg.classList.remove('text-red-500', 'fill-current');
                    svg.classList.add('text-gray-600');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
    @endauth
</body>
</html>

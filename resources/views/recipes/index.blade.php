<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pārlūkot receptes - Recepšu Aplikācija</title>
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

        .search-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .recipe-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .recipe-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .pagination a, .pagination span {
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .pagination .current {
            background: #667eea;
            color: white;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .recipe-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔍 Pārlūkot receptes</h1>
            <p>Atklājiet brīnišķīgas receptes no mūsu kopienas</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Vadības panelis</a>
                <a href="/recipes">🍽️ Receptes</a>
                <a href="/categories">📂 Kategorijas</a>
                <a href="/profile/recipes">📝 Manas receptes</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">🔧 Administrācija</a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span class="nav-user">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 10px 20px; font-size: 14px;">Iziet</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Search and Filter -->
            <div class="search-form">
                <form method="GET" action="{{ route('recipes.index') }}">
                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 15px; align-items: end;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">🔍 Meklēt receptes</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-input" placeholder="Meklēt pēc nosaukuma, apraksta vai sastāvdaļām...">
                        </div>
                        
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">📂 Kategorija</label>
                            <select name="category" class="form-input">
                                <option value="">Visas kategorijas</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">⭐ Grūtība</label>
                            <select name="difficulty" class="form-input">
                                <option value="">Jebkura</option>
                                <option value="Viegla" {{ request('difficulty') == 'Viegla' ? 'selected' : '' }}>Viegla</option>
                                <option value="Vidēja" {{ request('difficulty') == 'Vidēja' ? 'selected' : '' }}>Vidēja</option>
                                <option value="Grūta" {{ request('difficulty') == 'Grūta' ? 'selected' : '' }}>Grūta</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="padding: 12px 25px;">Meklēt</button>
                    </div>
                    
                    @if(request()->hasAny(['search', 'category', 'difficulty']))
                        <div style="margin-top: 15px;">
                            <a href="{{ route('recipes.index') }}" class="btn btn-warning" style="padding: 8px 16px; font-size: 14px;">
                                Notīrīt filtrus
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Results Summary -->
            <div style="background: rgba(102, 126, 234, 0.1); padding: 20px; border-radius: 12px; margin-bottom: 30px; text-align: center;">
                <h3 style="color: #667eea; margin-bottom: 10px;">
                    📊 Atrasts {{ $recipes->total() }} recepšu rezultāts
                </h3>
                @if(request()->hasAny(['search', 'category', 'difficulty']))
                    <p style="color: #666;">
                        Filtrēti rezultāti: 
                        @if(request('search')) meklēšana "{{ request('search') }}" @endif
                        @if(request('category')) | kategorija "{{ request('category') }}" @endif
                        @if(request('difficulty')) | grūtība "{{ request('difficulty') }}" @endif
                    </p>
                @endif
            </div>

            <!-- Quick Action -->
            <div style="text-align: center; margin-bottom: 30px;">
                <a href="{{ route('recipes.create') }}" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                    📝 Pievienot jaunu recepti
                </a>
            </div>

            <!-- Recipes Grid -->
            @if($recipes->count() > 0)
                <div class="recipe-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card">
                            <h3 style="color: #667eea; margin-bottom: 15px; font-size: 1.3rem;">{{ $recipe->title }}</h3>
                            <p style="color: #666; margin-bottom: 15px; line-height: 1.5;">{{ Str::limit($recipe->description, 100) }}</p>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 15px; font-size: 14px; color: #888;">
                                <div>📂 {{ $recipe->category ?? 'Nav kategorijas' }}</div>
                                <div>⭐ {{ $recipe->difficulty ?? 'Nav norādīta' }}</div>
                                @if($recipe->prep_time || $recipe->cook_time)
                                    <div>⏱️ {{ ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0) }} min</div>
                                @endif
                                @if($recipe->servings)
                                    <div>👥 {{ $recipe->servings }} porcijas</div>
                                @endif
                            </div>

                            {{-- ✅ Vērtējums (iekš kartītes) --}}
                            <div style="margin: 6px 0 14px; display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                                <span style="font-weight:700; color:#666;">
                                    {{ $recipe->reviews_avg_rating ? round($recipe->reviews_avg_rating, 1) : 'Nav vērtējumu' }} / 5
                                </span>

                                <span style="color:#888;">
                                    ({{ $recipe->reviews_count }})
                                </span>

                                <span style="margin-left:auto; color:#ffc107; font-weight:800;">
                                    @php $r = (int) round($recipe->reviews_avg_rating ?? 0); @endphp
                                    @for($i=1; $i<=5; $i++)
                                        {!! $i <= $r ? '★' : '☆' !!}
                                    @endfor
                                </span>
                            </div>
                            
                            <div style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 15px; margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #999;">
                                    <span>Autors: {{ $recipe->user->name }}</span>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="width: 100%; padding: 12px;">
                                Skatīt recepti →
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $recipes->links() }}
                </div>
            @else
                <div class="card" style="text-align: center; padding: 60px;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">🔍</div>
                    <h3 style="color: #667eea; margin-bottom: 15px;">Nav atrasta neviena recepte</h3>
                    <p style="color: #666; margin-bottom: 30px; line-height: 1.6;">
                        Mēģiniet mainīt meklēšanas kritērijus vai izveidojiet jaunu recepti!
                    </p>
                    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ route('recipes.index') }}" class="btn btn-warning">Skatīt visas receptes</a>
                        <a href="{{ route('recipes.create') }}" class="btn btn-success">Izveidot jaunu recepti</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorijas - RecepÅu AplikÄcija</title>
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

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--category-color, linear-gradient(135deg, #667eea 0%, #764ba2 100%));
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .category-breakfast { --category-color: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%); }
        .category-lunch { --category-color: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%); }
        .category-dinner { --category-color: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .category-dessert { --category-color: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .category-drinks { --category-color: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .category-snacks { --category-color: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .category-salads { --category-color: linear-gradient(135deg, #96e6a1 0%, #d4fc79 100%); }
        .category-soups { --category-color: linear-gradient(135deg, #ffa751 0%, #ffe259 100%); }
        .category-default { --category-color: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }

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

        .category-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.1));
        }

        .category-description {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 20px;
            min-height: 60px;
        }

        .category-stats {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .stats-row:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .categories-grid { grid-template-columns: 1fr; }
            .recipes-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>š“‚ Kategorijas</h1>
            <p>AtklÄjiet daudzveidÄ«go recepÅu pasauli</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">š¨½ļø¸ RecepÅu AplikÄcija</a>
            <div class="nav-links">
                <a href="/dashboard">š¸  VadÄ«bas panelis</a>
                <a href="/recipes">š¨½ļø¸ Receptes</a>
                <a href="{{ route('categories.index') }}">š“‚ Kategorijas</a>
                <a href="/profile/recipes">š“¯ Manas receptes</a>
                <a href="{{ route('profile.edit') }}">ā™ļø¸ Profils</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.index') }}">š”§ AdministrÄcija</a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="color: #666; font-weight: 500;">š‘¤ {{ Auth::user()->name }}</span>
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
                <a href="/dashboard" style="color: #667eea; text-decoration: none;">š¸  VadÄ«bas panelis</a> 
                <span style="color: #666;"> / </span>
                <span style="color: #333; font-weight: 600;">š“‚ Kategorijas</span>
            </div>

            <!-- Categories Overview -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); border-radius: 15px;">
                @php
                    $categories = \App\Models\Recipe::distinct('category')->pluck('category')->filter();
                    $totalRecipes = \App\Models\Recipe::count();
                @endphp
                <h2 style="color: #56ab2f; margin-bottom: 15px;">{{ $categories->count() }} kategorijas pieejamas</h2>
                <p style="color: #666; line-height: 1.6;">
                    KopÄ {{ $totalRecipes }} receptes sadalÄ«tas {{ $categories->count() }} daÅ¾ÄdÄs kategorijÄs. 
                    IzvÄ“lieties kategoriju, lai atklÄtu garÅÄ«gas receptes!
                </p>
            </div>

            <!-- Categories Grid -->
            @if($categories->count() > 0)
                <div class="categories-grid">
                    @foreach($categories as $category)
                        @php
                            $categoryRecipes = \App\Models\Recipe::where('category', $category);
                            $totalCategoryRecipes = $categoryRecipes->count();
                            $recentRecipes = $categoryRecipes->where('created_at', '>=', now()->subDays(7))->count();
                            $popularAuthors = $categoryRecipes->with('user')->get()->groupBy('user_id')->count();
                            
                            // Determine category class
                            $categoryClass = match(strtolower($category)) {
                                'brokastis' => 'category-breakfast',
                                'pusdienas' => 'category-lunch', 
                                'vakariÅ†as' => 'category-dinner',
                                'deserti' => 'category-dessert',
                                'dzÄ“rieni' => 'category-drinks',
                                'uzkodas' => 'category-snacks',
                                'salÄti' => 'category-salads',
                                'zupas' => 'category-soups',
                                default => 'category-default'
                            };
                            
                            // Category descriptions
                            $descriptions = [
                                'Brokastis' => 'SÄciet dienu ar garÅÄ«gÄm un barojoÅÄm brokastÄ«m',
                                'Pusdienas' => 'SÄtÄ«gi Ä“dieni dienas vidum un enerÄ£ijas uzpildÄ«Åanai',
                                'VakariÅ†as' => 'Eleganti vakariÅ†u Ä“dieni romantiski vai Ä£imenes vakariem',
                                'Deserti' => 'Saldi kÄrumi un deserti Ä«paÅiem brÄ«Å¾iem',
                                'DzÄ“rieni' => 'AtspirdzinoÅie dzÄ“rieni un kokteiÄ¼i visÄm gaumÄ“m',
                                'Uzkodas' => 'Ä€tri un garÅÄ«gi uzkoÅ¾amie visos dzÄ«ves brÄ«Å¾os',
                                'SalÄti' => 'Svaigi un veselÄ«gi salÄti pilni ar vitamÄ«niem',
                                'Zupas' => 'Siltas un mÄjÄ«gas zupas aukstajiem vakariem'
                            ];
                        @endphp
                        
                        <div class="category-card {{ $categoryClass }}">
                            <div class="category-icon">
                                @switch($category)
                                    @case('Brokastis')
                                        š¨³
                                        @break
                                    @case('Pusdienas')
                                        š¨½ļø¸
                                        @break
                                    @case('VakariÅ†as')
                                        š™
                                        @break
                                    @case('Deserti')
                                        š¨°
                                        @break
                                    @case('DzÄ“rieni')
                                        š¤
                                        @break
                                    @case('Uzkodas')
                                        šØ
                                        @break
                                    @case('SalÄti')
                                        š—
                                        @break
                                    @case('Zupas')
                                        š¨²
                                        @break
                                    @default
                                        š¨´
                                @endswitch
                            </div>
                            
                            <h3 style="color: #667eea; margin-bottom: 15px; font-size: 1.4rem; font-weight: bold;">
                                {{ $category }}
                            </h3>
                            
                            <p class="category-description">
                                {{ $descriptions[$category] ?? "AtklÄjiet garÅÄ«gas $category receptes ÅajÄ sadaÄ¼Ä" }}
                            </p>
                            
                            <div class="category-stats">
                                <div class="stats-row">
                                    <span style="color: #666;">š“ KopÄ recepÅu:</span>
                                    <span style="font-weight: bold; color: #667eea;">{{ $totalCategoryRecipes }}</span>
                                </div>
                                <div class="stats-row">
                                    <span style="color: #666;">š†• Jaunas ÅonedÄ“Ä¼:</span>
                                    <span style="font-weight: bold; color: #56ab2f;">{{ $recentRecipes }}</span>
                                </div>
                                <div class="stats-row">
                                    <span style="color: #666;">š‘ DaÅ¾Ädi autori:</span>
                                    <span style="font-weight: bold; color: #f093fb;">{{ $popularAuthors }}</span>
                                </div>
                                <div class="stats-row">
                                    <span style="color: #666;">š“ PopularitÄte:</span>
                                    <span style="font-weight: bold;">
                                        @if($totalCategoryRecipes >= 20)
                                            š” Ä»oti populÄra
                                        @elseif($totalCategoryRecipes >= 10)
                                            ā­ PopulÄra
                                        @elseif($totalCategoryRecipes >= 5)
                                            š‘¨ AktÄ«va
                                        @else
                                            š± AugoÅÄ
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('categories.show', urlencode($category)) }}" class="btn btn-primary" style="width: 100%; font-size: 15px;">
                                SkatÄ«t {{ $totalCategoryRecipes }} {{ $totalCategoryRecipes == 1 ? 'recepti' : 'receptes' }} ā†’
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Categories -->
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">š“‚</div>
                    <h3 style="color: #666; margin-bottom: 15px;">Nav kategoriju</h3>
                    <p style="color: #999; margin-bottom: 30px;">
                        VÄ“l nav izveidota neviena recepte ar kategoriju.
                    </p>
                    <div>
                        <a href="/recipes/create" class="btn btn-primary">
                            š“¯ Izveidot pirmo recepti
                        </a>
                    </div>
                </div>
            @endif

            <!-- Recent Recipes from All Categories -->
            @if($recipes->count() > 0)
                <div style="margin-top: 50px;">
                    <h3 style="text-align: center; color: #667eea; margin-bottom: 25px; font-size: 1.8rem;">š•’ JaunÄkÄs receptes no visÄm kategorijÄm</h3>
                    <div class="recipes-grid">
                        @foreach($recipes->sortByDesc('created_at')->take(6) as $recipe)
                            <div class="recipe-card">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <h3 style="color: #667eea; font-size: 1.3rem;">
                                        {{ $recipe->title }}
                                    </h3>
                                    <span style="background: rgba(102, 126, 234, 0.1); color: #667eea; padding: 5px 10px; border-radius: 12px; font-size: 11px; font-weight: bold;">
                                        JAUNA
                                    </span>
                                </div>
                                
                                <p style="color: #666; margin-bottom: 15px; line-height: 1.5;">
                                    {{ Str::limit($recipe->description, 100) }}
                                </p>
                                
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 14px; color: #999;">
                                    <span style="background: rgba(240, 147, 251, 0.1); color: #f093fb; padding: 4px 8px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                        š“‚ {{ $recipe->category ?? 'Nav norÄdÄ«ta' }}
                                    </span>
                                    <span>š‘Øā€¨š¨³ {{ $recipe->user->name }}</span>
                                </div>
                                
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <span style="background: rgba(255, 65, 108, 0.1); color: #ff416c; padding: 5px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                                        {{ $recipe->difficulty ?? 'N/A' }}
                                    </span>
                                    <span style="color: #56ab2f; font-size: 12px; font-weight: 600;">
                                        āØ {{ $recipe->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-primary" style="width: 100%;">
                                    SkatÄ«t recepti ā†’
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <div style="text-align: center; margin-top: 30px;">
                        <a href="/recipes" class="btn btn-primary" style="padding: 15px 30px; font-size: 16px;">
                            š”¨ SkatÄ«t visas {{ $totalRecipes }} receptes ā†’
                        </a>
                    </div>
                </div>
            @endif

            <!-- Category Statistics -->
            <div style="margin-top: 50px; padding: 30px; background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%); border-radius: 15px;">
                <h3 style="text-align: center; color: #f093fb; margin-bottom: 25px; font-size: 1.6rem;">š“ Kategoriju statistika</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div style="text-align: center; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">š¸†</div>
                        <div style="font-size: 1.5rem; font-weight: bold; color: #667eea;">
                            @php
                                $topCategory = $categories->map(function($cat) {
                                    return [
                                        'name' => $cat,
                                        'count' => \App\Models\Recipe::where('category', $cat)->count()
                                    ];
                                })->sortByDesc('count')->first();
                            @endphp
                            {{ $topCategory['name'] ?? 'Nav' }}
                        </div>
                        <div style="color: #666; font-size: 14px;">PopulÄrÄkÄ kategorija</div>
                        <div style="color: #56ab2f; font-weight: bold; margin-top: 5px;">{{ $topCategory['count'] ?? 0 }} receptes</div>
                    </div>
                    
                    <div style="text-align: center; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">š“</div>
                        <div style="font-size: 1.5rem; font-weight: bold; color: #667eea;">{{ $totalRecipes }}</div>
                        <div style="color: #666; font-size: 14px;">KopÄ receptes</div>
                        <div style="color: #56ab2f; font-weight: bold; margin-top: 5px;">VisÄs kategorijÄs</div>
                    </div>
                    
                    <div style="text-align: center; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">š‘</div>
                        <div style="font-size: 1.5rem; font-weight: bold; color: #667eea;">{{ \App\Models\User::has('recipes')->count() }}</div>
                        <div style="color: #666; font-size: 14px;">AktÄ«vi autori</div>
                        <div style="color: #56ab2f; font-weight: bold; margin-top: 5px;">KopÅ sÄkuma</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


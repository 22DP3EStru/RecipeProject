<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - Recepšu Aplikācija</title>
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
            max-width: 1000px;
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

        .card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
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

        .recipe-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .meta-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

        .ingredients-list {
            background: rgba(86, 171, 47, 0.1);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .instructions-list {
            background: rgba(255, 193, 7, 0.1);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .recipe-meta { grid-template-columns: 1fr; }
        }

        .review-card {
            background: rgba(255,255,255,0.8);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 1px solid rgba(255,255,255,0.3);
            margin-bottom: 20px;
        }

        .stars { display: inline-flex; flex-direction: row-reverse; gap: 6px; }
        .stars input { display: none; }
        .stars label { cursor: pointer; font-size: 26px; color: rgba(0,0,0,0.25); transition: transform .15s ease; }
        .stars label:hover { transform: translateY(-2px); }
        .stars input:checked ~ label,
        .stars label:hover,
        .stars label:hover ~ label { color: #ffc107; }

        .flash-success {
            background: rgba(86,171,47,0.12);
            border-left: 4px solid #56ab2f;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 16px;
            color: #2f6b1b;
            font-weight: 700;
        }

        /* FAVORITES (HEART) */
        .heart-btn{
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 28px;
            line-height: 1;
            padding: 8px 10px;
            border-radius: 12px;
            transition: transform .15s ease, background .15s ease;
        }
        .heart-btn:hover{
            transform: translateY(-2px);
            background: rgba(102,126,234,0.12);
        }
        .heart-wrap{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:10px;
            margin-top: 12px;
        }
    </style>
</head>
<body>
    @php
        $isFav = false;
        if(Auth::check()){
            $isFav = Auth::user()
                ->favoriteRecipes()
                ->where('recipe_id', $recipe->id)
                ->exists();
        }
    @endphp

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🍽️ {{ $recipe->title }}</h1>
            <p>Autors: {{ $recipe->user->name }}</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Vadības panelis</a>
                <a href="/recipes">🍽️ Receptes</a>
                <a href="/categories">📂 Kategorijas</a>
                <a href="/profile/recipes">📝 Manas receptes</a>
                @auth
                    <a href="{{ route('profile.favorites') }}">❤️ Favorīti</a>
                @endauth
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                @auth
                    <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span>
                @endauth
                <a href="/recipes" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">← Atpakaļ uz receptēm</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Recipe Header -->
            <div style="text-align: center; margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 15px;">

                <div class="heart-wrap">
                    <h1 style="color: #667eea; margin: 0; font-size: 2.5rem;">{{ $recipe->title }}</h1>

                    @auth
                        <form method="POST" action="{{ route('recipes.favorite.toggle', $recipe) }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="heart-btn" aria-label="Pievienot favorītiem">
                                {!! $isFav ? '❤️' : '🤍' !!}
                            </button>
                        </form>
                    @endauth

                    @guest
                        <span title="Pieslēdzies, lai pievienotu favorītiem" style="font-size:28px; opacity:.6;">🤍</span>
                    @endguest
                </div>

                <p style="color: #666; font-size: 18px; line-height: 1.6; max-width: 800px; margin: 10px auto 0;">
                    {{ $recipe->description }}
                </p>
            </div>

            <!-- Recipe Meta Information -->
            <div class="recipe-meta">
                <div class="meta-item">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📂</div>
                    <h4 style="color: #667eea; margin-bottom: 5px;">Kategorija</h4>
                    <p style="color: #666; font-weight: 600;">{{ $recipe->category ?? 'Nav norādīta' }}</p>
                </div>

                <div class="meta-item">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">⭐</div>
                    <h4 style="color: #667eea; margin-bottom: 5px;">Grūtība</h4>
                    <p style="color: #666; font-weight: 600;">{{ $recipe->difficulty ?? 'Nav norādīta' }}</p>
                </div>

                @if($recipe->prep_time)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">🔪</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Sagatavošana</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->prep_time }} minūtes</p>
                    </div>
                @endif

                @if($recipe->cook_time)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">🔥</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Gatavošana</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->cook_time }} minūtes</p>
                    </div>
                @endif

                @if($recipe->prep_time && $recipe->cook_time)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">⏱️</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Kopā laiks</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->prep_time + $recipe->cook_time }} minūtes</p>
                    </div>
                @endif

                @if($recipe->servings)
                    <div class="meta-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">👥</div>
                        <h4 style="color: #667eea; margin-bottom: 5px;">Porcijas</h4>
                        <p style="color: #666; font-weight: 600;">{{ $recipe->servings }} porcijas</p>
                    </div>
                @endif
            </div>

            <!-- Ingredients -->
            <div class="card">
                <div class="ingredients-list">
                    <h3 style="color: #56ab2f; margin-bottom: 20px; display: flex; align-items: center; font-size: 1.8rem;">
                        <span style="margin-right: 15px;">🥕</span>
                        Sastāvdaļas
                    </h3>
                    <div style="background: rgba(255, 255, 255, 0.7); padding: 25px; border-radius: 12px; border-left: 4px solid #56ab2f;">
                        @php
                            $ingredients = explode("\n", $recipe->ingredients);
                        @endphp
                        <ul style="list-style: none; padding: 0;">
                            @foreach($ingredients as $ingredient)
                                @if(trim($ingredient))
                                    <li style="padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,0.1); display: flex; align-items: center;">
                                        <span style="color: #56ab2f; margin-right: 10px; font-weight: bold;">✓</span>
                                        <span style="color: #333; font-size: 16px;">{{ trim($ingredient) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="card">
                <div class="instructions-list">
                    <h3 style="color: #ffc107; margin-bottom: 20px; display: flex; align-items: center; font-size: 1.8rem;">
                        <span style="margin-right: 15px;">👩‍🍳</span>
                        Gatavošanas instrukcijas
                    </h3>
                    <div style="background: rgba(255, 255, 255, 0.7); padding: 25px; border-radius: 12px; border-left: 4px solid #ffc107;">
                        @php
                            $instructions = explode("\n", $recipe->instructions);
                            $stepNumber = 1;
                        @endphp
                        <ol style="padding-left: 0; counter-reset: step-counter;">
                            @foreach($instructions as $instruction)
                                @if(trim($instruction))
                                    <li style="padding: 15px 0; border-bottom: 1px solid rgba(0,0,0,0.1); display: flex; align-items: flex-start; counter-increment: step-counter;">
                                        <span style="background: #ffc107; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; flex-shrink: 0; margin-top: 2px;">
                                            {{ $stepNumber++ }}
                                        </span>
                                        <span style="color: #333; font-size: 16px; line-height: 1.6;">{{ trim($instruction) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Recipe Author & Date -->
            <div class="card">
                <h3 style="color: #333; margin-bottom: 20px; text-align: center;">👨‍🍳 Par šo recepti</h3>
                <div style="background: rgba(102, 126, 234, 0.1); padding: 25px; border-radius: 12px; text-align: center;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                        <div>
                            <h4 style="color: #667eea; margin-bottom: 5px;">Receptes autors</h4>
                            <p style="color: #666; font-size: 18px; font-weight: 600;">{{ $recipe->user->name }}</p>
                        </div>
                        <div>
                            <h4 style="color: #667eea; margin-bottom: 5px;">Publicēts</h4>
                            <p style="color: #666; font-size: 16px;">{{ $recipe->created_at->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <h4 style="color: #667eea; margin-bottom: 5px;">Pēdējās izmaiņas</h4>
                            <p style="color: #666; font-size: 16px;">{{ $recipe->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            @php
                $avg = $recipe->reviews->avg('rating');
                $avgRounded = $avg ? round($avg, 1) : null;
                $count = $recipe->reviews->count();
            @endphp

            <div class="card">
                <h3 style="color: #333; margin-bottom: 20px; text-align: center;">⭐ Atsauksmes</h3>

                @if(session('success'))
                    <div class="flash-success">{{ session('success') }}</div>
                @endif

                <div style="text-align:center; margin-bottom: 15px;">
                    <span style="display:inline-block; padding:6px 10px; border-radius:999px; background: rgba(102,126,234,0.12); color:#667eea; font-weight:800;">
                        Vidējais: {{ $avgRounded ?? 'Nav' }}@if($avgRounded) / 5 @endif ({{ $count }})
                    </span>
                </div>

                @auth
                    <div class="review-card">
                        {{-- JA NAV ATSAUKSMES --}}
                        @if(!$myReview)
                            <div style="font-weight:800; margin-bottom:10px;">Tava atsauksme</div>

                            <form method="POST" action="{{ route('recipes.reviews.store', $recipe) }}">
                                @csrf

                                <div style="margin-bottom:10px;">
                                    <div class="stars">
                                        @for($i=5; $i>=1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                            <label for="star{{ $i }}">★</label>
                                        @endfor
                                    </div>
                                    @error('rating') <div style="color:#ff4b2b; font-weight:800; margin-top:8px;">{{ $message }}</div> @enderror
                                </div>

                                <textarea name="comment" rows="4" maxlength="2000"
                                        style="width:100%; padding:12px; border-radius:12px; border:1px solid rgba(0,0,0,0.15);"
                                        placeholder="Uzraksti savu viedokli..."></textarea>
                                @error('comment') <div style="color:#ff4b2b; font-weight:800; margin-top:8px;">{{ $message }}</div> @enderror

                                <button type="submit" class="btn btn-success" style="margin-top:10px; padding:12px 22px; font-size:14px;">
                                    ✅ Pievienot atsauksmi
                                </button>
                            </form>

                        {{-- JA ATSAUKSME IR: RĀDĀM + EDIT + DELETE --}}
                        @else
                            <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap;">
                                <div>
                                    <div style="font-weight:800;">Tava atsauksme</div>
                                    <div style="margin-top:5px;">
                                        @for($s=1; $s<=5; $s++)
                                            {!! $s <= $myReview->rating
                                                ? '<span style="color:#ffc107;">★</span>'
                                                : '<span style="color:rgba(0,0,0,0.2);">★</span>' !!}
                                        @endfor
                                    </div>
                                </div>

                                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                    <button class="btn btn-warning"
                                            type="button"
                                            onclick="document.getElementById('edit-review-form').style.display='block'; this.style.display='none';">
                                        ✏️ Rediģēt manu atsauksmi
                                    </button>

                                    <form method="POST" action="{{ route('recipes.reviews.destroy', $recipe) }}"
                                        onsubmit="return confirm('Dzēst savu atsauksmi?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            🗑️ Dzēst manu atsauksmi
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if($myReview->comment)
                                <div style="margin-top:10px; color:#555;">{{ $myReview->comment }}</div>
                            @endif

                            {{-- SLĒPTĀ REDIĢĒŠANAS FORMA --}}
                            <form id="edit-review-form"
                                method="POST"
                                action="{{ route('recipes.reviews.store', $recipe) }}"
                                style="display:none; margin-top:15px;">
                                @csrf

                                <div class="stars" style="margin-bottom:10px;">
                                    @for($i=5; $i>=1; $i--)
                                        <input type="radio" id="editStar{{ $i }}" name="rating" value="{{ $i }}"
                                            @checked((int)$myReview->rating === $i) required>
                                        <label for="editStar{{ $i }}">★</label>
                                    @endfor
                                </div>

                                <textarea name="comment" rows="4" maxlength="2000"
                                        style="width:100%; padding:12px; border-radius:12px; border:1px solid rgba(0,0,0,0.15);">{{ $myReview->comment }}</textarea>

                                <button type="submit" class="btn btn-success" style="margin-top:10px; padding:12px 22px; font-size:14px;">
                                    💾 Saglabāt izmaiņas
                                </button>
                            </form>
                        @endif
                    </div>
                @endauth

                {{-- VISU ATSauksmju saraksts --}}
                @forelse($recipe->reviews as $review)
                    <div class="review-card">
                        <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-bottom:8px;">
                            <div style="font-weight:800;">
                                {{ $review->user->name }}
                                <span style="margin-left:10px;">
                                    @for($s=1; $s<=5; $s++)
                                        {!! $s <= $review->rating ? '<span style="color:#ffc107;">★</span>' : '<span style="color:rgba(0,0,0,0.2);">★</span>' !!}
                                    @endfor
                                </span>
                            </div>
                            <div style="color:#888; font-size:13px;">{{ $review->created_at->format('d.m.Y H:i') }}</div>
                        </div>

                        @if($review->comment)
                            <div style="line-height:1.6;">{{ $review->comment }}</div>
                        @endif
                    </div>
                @empty
                    <div class="review-card" style="text-align:center;">
                        Šai receptei vēl nav atsauksmju.
                    </div>
                @endforelse
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin-top: 40px;">
                @if(Auth::id() === $recipe->user_id)
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning" style="font-size: 16px; padding: 15px 30px;">
                        ✏️ Rediģēt recepti
                    </a>
                    <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" style="display: inline;"
                          onsubmit="return confirm('Vai tiešām vēlaties dzēst šo recepti? Šo darbību nevar atsaukt.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="font-size: 16px; padding: 15px 30px;">
                            🗑️ Dzēst recepti
                        </button>
                    </form>
                @endif

                <a href="/recipes" class="btn btn-primary" style="font-size: 16px; padding: 15px 30px;">
                    🔍 Pārlūkot citas receptes
                </a>

                <a href="{{ route('recipes.create') }}" class="btn btn-success" style="font-size: 16px; padding: 15px 30px;">
                    📝 Izveidot jaunu recepti
                </a>
            </div>

            <!-- Related Recipes -->
            @if(isset($relatedRecipes) && $relatedRecipes->count() > 0)
                <div class="card" style="margin-top: 40px;">
                    <h3 style="color: #333; margin-bottom: 25px; text-align: center;">🔍 Līdzīgas receptes</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                        @foreach($relatedRecipes as $relatedRecipe)
                            <div style="background: rgba(102, 126, 234, 0.1); padding: 20px; border-radius: 12px; transition: transform 0.3s ease;"
                                 onmouseover="this.style.transform='translateY(-5px)'"
                                 onmouseout="this.style.transform='translateY(0)'">
                                <h4 style="color: #667eea; margin-bottom: 10px;">{{ $relatedRecipe->title }}</h4>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">{{ Str::limit($relatedRecipe->description, 80) }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #888; margin-bottom: 15px;">
                                    <span>{{ $relatedRecipe->category }}</span>
                                    <span>{{ $relatedRecipe->user->name }}</span>
                                </div>
                                <a href="{{ route('recipes.show', $relatedRecipe) }}" class="btn btn-primary" style="width: 100%; padding: 8px; font-size: 14px;">
                                    Skatīt recepti →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

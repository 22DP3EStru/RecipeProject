<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('test-dashboard');
})->middleware(['auth'])->name('dashboard');

?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VadÄ«bas panelis - RecepÅu AplikÄcija</title>
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
            <h1>š¨½ļø¸ SveicinÄti atpakaÄ¼!</h1>
            <p>JÅ«su kulinÄrais ceÄ¼ojums turpinÄs, {{ Auth::user()->name }}!</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">š¨½ļø¸ RecepÅu AplikÄcija</a>
            <div class="nav-links">
                <a href="/dashboard">š¸  VadÄ«bas panelis</a>
                <a href="/recipes">š¨½ļø¸ Receptes</a>
                <a href="/categories">š“‚ Kategorijas</a>
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
            <!-- Welcome Message -->
            <div class="card text-center">
                <div style="font-size: 4rem; margin-bottom: 20px;">š‘Øā€¨š¨³</div>
                <h2 style="color: #667eea; margin-bottom: 15px;">SveicinÄti jÅ«su kulinÄrijas studijÄ!</h2>
                <p style="color: #666; margin-bottom: 30px; line-height: 1.6;">
                    Esiet gatavi radÄ«t, dalÄ«ties un atklÄt brÄ«niÅÄ·Ä«gas receptes. JÅ«su nÄkamÄ mÄ«Ä¼ÄkÄ recepte gaida tikai daÅ¾us klikÅÄ·us attÄlumÄ!
                </p>
            </div>

            <!-- Statistics -->
            <div class="card">
                <h3 class="card-title">š“ JÅ«su kulinÄrijas statistika</h3>
                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::where('user_id', Auth::id())->count() }}</span>
                        <span class="stat-label">JÅ«su receptes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                        <span class="stat-label">KopÄ receptes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::count() }}</span>
                        <span class="stat-label">Kopienas dalÄ«bnieki</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', today())->count() }}</span>
                        <span class="stat-label">Å odienas receptes</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <h3 class="card-title">š€ Ä€tras darbÄ«bas</h3>
                <div class="grid grid-2">
                    <a href="/recipes/create" class="btn btn-success">š“¯ Izveidot jaunu recepti</a>
                    <a href="/recipes" class="btn btn-primary">š”¨ PÄrlÅ«kot visas receptes</a>
                    <a href="/categories" class="btn btn-warning">š“‚ ApskatÄ«t kategorijas</a>
                    <a href="/profile/recipes" class="btn btn-danger">š“‹ Manas receptes</a>
                </div>
            </div>

            <!-- Recent Recipes -->
            @php
                $recentRecipes = \App\Models\Recipe::with('user')->latest()->limit(4)->get();
            @endphp

            @if($recentRecipes->count() > 0)
                <div class="card">
                    <h3 class="card-title">š•’ JaunÄkÄs receptes</h3>
                    <div class="grid grid-2">
                        @foreach($recentRecipes as $recipe)
                            <div style="background: rgba(255, 255, 255, 0.6); padding: 20px; border-radius: 12px; border: 1px solid rgba(102, 126, 234, 0.1);">
                                <h4 style="color: #667eea; margin-bottom: 10px;">{{ $recipe->title }}</h4>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">{{ Str::limit($recipe->description, 80) }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-size: 13px; color: #999;">
                                    <span>Autors: {{ $recipe->user->name }}</span>
                                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 14px;">SkatÄ«t recepti ā†’</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Your Recent Recipes -->
            @php
                $myRecentRecipes = \App\Models\Recipe::where('user_id', Auth::id())->latest()->limit(3)->get();
            @endphp

            @if($myRecentRecipes->count() > 0)
                <div class="card">
                    <h3 class="card-title">š“¯ JÅ«su jaunÄkÄs receptes</h3>
                    <div class="grid grid-3">
                        @foreach($myRecentRecipes as $recipe)
                            <div style="background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%); padding: 20px; border-radius: 12px;">
                                <h4 style="color: #56ab2f; margin-bottom: 10px;">{{ $recipe->title }}</h4>
                                <p style="color: #666; font-size: 14px; margin-bottom: 15px;">{{ Str::limit($recipe->description, 60) }}</p>
                                <div style="font-size: 13px; color: #999; margin-bottom: 15px;">
                                    Izveidots: {{ $recipe->created_at->diffForHumans() }}
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary" style="flex: 1; padding: 8px; font-size: 13px;">SkatÄ«t</a>
                                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-warning" style="flex: 1; padding: 8px; font-size: 13px;">RediÄ£Ä“t</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="card text-center">
                    <div style="padding: 40px;">
                        <div style="font-size: 4rem; margin-bottom: 20px;">š“¯</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">JÅ«s vÄ“l neesat izveidojis nevienu recepti</h4>
                        <p style="color: #666; margin-bottom: 25px;">SÄciet savu kulinÄrijas ceÄ¼ojumu, izveidojot savu pirmo recepti!</p>
                        <a href="/recipes/create" class="btn btn-success">Izveidot pirmo recepti</a>
                    </div>
                </div>
            @endif

            <!-- Tips Section -->
            <div class="card">
                <h3 class="card-title">š’ Padomi un ieteikumi</h3>
                <div class="grid grid-2">
                    <div style="background: rgba(102, 126, 234, 0.1); padding: 25px; border-radius: 12px;">
                        <h4 style="color: #667eea; margin-bottom: 15px;">š”¨ EfektÄ«va meklÄ“Åana</h4>
                        <p style="color: #666; line-height: 1.6;">Izmantojiet meklÄ“Åanas filtrus, lai atrastu receptes pÄ“c kategorijas, grÅ«tÄ«bas lÄ«meÅ†a vai sastÄvdaÄ¼Äm.</p>
                    </div>
                    <div style="background: rgba(86, 171, 47, 0.1); padding: 25px; border-radius: 12px;">
                        <h4 style="color: #56ab2f; margin-bottom: 15px;">š“¯ RecepÅu rakstÄ«Åana</h4>
                        <p style="color: #666; line-height: 1.6;">IekÄ¼aujiet detalizÄ“tas instrukcijas un precÄ«zas sastÄvdaÄ¼as, lai citi varÄ“tu viegli sekot jÅ«su receptei.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


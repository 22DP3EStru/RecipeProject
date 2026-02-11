<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sveicināti - Vecmāmiņas Receptes</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }

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

        .header p { font-size: 1.3rem; opacity: 0.9; }

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
            gap: 12px;
        }

        .nav-brand {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links { display: flex; gap: 20px; flex-wrap: wrap; }

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
            transition: transform 0.3s ease;
        }

        .card:hover { transform: translateY(-5px); }

        .card-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .grid { display: grid; gap: 25px; }

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

        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-success { background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%); color: white; }
        .btn-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }

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

        .stat-number { font-size: 3rem; font-weight: bold; display: block; margin-bottom: 10px; }
        .stat-label { font-size: 1rem; opacity: 0.9; }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .text-center { text-align: center; }

        .hero-section {
            text-align: center;
            padding: 60px 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 20px;
            margin-bottom: 40px;
        }

        .hero-section h2 { font-size: 2.5rem; color: #333; margin-bottom: 20px; }
        .hero-section p { font-size: 1.2rem; color: #666; margin-bottom: 40px; line-height: 1.6; }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .hero-section h2 { font-size: 2rem; }
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
        <h1>🍽️ Vecmāmiņas Receptes</h1>
        <p>Atklāj, dalies un izveido brīnišķīgas receptes</p>
    </div>

    <!-- Navigation -->
    <nav class="nav-bar">
        <a href="/" class="nav-brand">🍽️ Vecmāmiņas Receptes</a>

        <div class="nav-links">
            <a href="/">🏠 Sākums</a>
            <a href="#features">✨ Iespējas</a>
            <a href="#about">📖 Par mums</a>

        <div style="display: flex; gap: 15px;">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Vadības panelis</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Ielogoties</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-success">Reģistrēties</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Hero Section -->
        <div class="hero-section">
            <h2>Sveicināti kulinārijas pasaulē! 👨‍🍳</h2>
            <p>
                Pievienojieties ēdiena entuziastu kopienai, kas dalās ar savām mīļākajām receptēm.<br>
                Atklājiet jaunas garšas, apgūstiet gatavošanas paņēmienus un saglabājiet savus favorītus.
            </p>

            @auth
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary" style="font-size: 18px; padding: 20px 40px;">
                        🏠 Uz vadības paneli
                    </a>
                    <a href="/recipes/create" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                        📝 Izveidot recepti
                    </a>
                </div>
            @else
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('register') }}" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                        🚀 Sākt bez maksas
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-primary" style="font-size: 18px; padding: 20px 40px;">
                        🔐 Ielogoties
                    </a>
                </div>
            @endauth
        </div>

        <!-- Platform Statistics -->
        <div class="card">
            <h3 class="card-title">📊 Mūsu augošā kopiena</h3>
            <div class="stats-grid">
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::count() }}</span>
                    <span class="stat-label">Kopā receptes</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\User::count() }}</span>
                    <span class="stat-label">Kopienas dalībnieki</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::whereNotNull('category')->distinct('category')->count('category') }}</span>
                    <span class="stat-label">Recepšu kategorijas</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ \App\Models\Recipe::where('created_at', '>=', now()->subDays(7))->count() }}</span>
                    <span class="stat-label">Šīs nedēļas receptes</span>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="card">
            <h3 class="card-title">✨ Kāpēc izvēlēties Vecmāmiņas Receptes?</h3>
            <div class="grid grid-3">
                <div class="feature-card">
                    <div style="font-size: 4rem; margin-bottom: 20px;">📝</div>
                    <h4 style="color: #667eea; margin-bottom: 15px;">Vienkārša recepšu izveide</h4>
                    <p style="color: #666; line-height: 1.6;">
                        Izveido un dalies ar receptēm, pievienojot sastāvdaļas un gatavošanas soļus.
                    </p>
                </div>

                <div class="feature-card">
                    <div style="font-size: 4rem; margin-bottom: 20px;">🔍</div>
                    <h4 style="color: #667eea; margin-bottom: 15px;">Viedā meklēšana</h4>
                    <p style="color: #666; line-height: 1.6;">
                        Atrodi receptes pēc nosaukuma un pārlūko pēc kategorijām.
                    </p>
                </div>

                <div class="feature-card">
                    <div style="font-size: 4rem; margin-bottom: 20px;">❤️</div>
                    <h4 style="color: #667eea; margin-bottom: 15px;">Favorīti</h4>
                    <p style="color: #666; line-height: 1.6;">
                        Saglabā receptes sirsniņā un ātri atrodi tās savā favorītu sarakstā.
                    </p>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div id="about" class="card">
            <h3 class="card-title">📖 Par mums</h3>
            <div style="text-align: center; max-width: 900px; margin: 0 auto;">
                <p style="color: #666; font-size: 18px; line-height: 1.8; margin-bottom: 20px;">
                    Vecmāmiņas Receptes ir recepšu platforma, kur ēdiena mīlētāji var dalīties ar saviem atradumiem,
                    saglabāt iecienītākās receptes un atklāt jaunas idejas.
                </p>
                <p style="color: #666; font-size: 16px; line-height: 1.6;">
                    Mūsu mērķis ir padarīt gatavošanu vienkāršu un iedvesmojošu — gan iesācējiem, gan pieredzējušiem pavāriem.
                </p>
            </div>

            <!-- ✅ Galvenie kontakti tieši zem "Par mums" (publiski) -->
            <div style="margin-top: 30px;">
                <h4 style="text-align:center; font-size: 1.3rem; margin-bottom: 15px;">📞 Galvenie kontakti</h4>

                <div class="contact-grid">
                    <div class="feature-card" style="text-align:left;">
                        <h4 style="color:#667eea; margin-bottom:10px;">👤 Galvenais kontakts</h4>
                        <p style="color:#666; line-height:1.7;">
                            E-pasts: <strong>info@vecmaminasreceptes.lv</strong><br>
                            Tālrunis: <strong>+371 20000000</strong><br>
                            Darba laiks: <strong>P–Pk 09:00–18:00</strong>
                        </p>
                    </div>

                    <div class="feature-card" style="text-align:left;">
                        <h4 style="color:#667eea; margin-bottom:10px;">🛠️ Tehniskais atbalsts</h4>
                        <p style="color:#666; line-height:1.7;">
                            E-pasts: <strong>support@vecmaminasreceptes.lv</strong><br>
                            Atbildes laiks: <strong>24–48h</strong>
                        </p>
                    </div>

                    <div class="feature-card" style="text-align:left;">
                        <h4 style="color:#667eea; margin-bottom:10px;">💬 Ieteikumi</h4>
                        <p style="color:#666; line-height:1.7;">
                            E-pasts: <strong>ieteikumi@vecmaminasreceptes.lv</strong><br>
                            Raksti, ja ir idejas uzlabojumiem vai jaunām funkcijām.
                        </p>
                    </div>
                </div>

                <div style="text-align:center; margin-top: 20px;">
                    <a href="{{ route('contact') }}" class="btn btn-primary">Atvērt kontaktu lapu</a>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        @guest
            <div class="card text-center">
                <div style="padding: 40px;">
                    <h3 style="color: #667eea; margin-bottom: 20px; font-size: 2rem;">Gatavi sākt gatavot? 🍳</h3>
                    <p style="color: #666; margin-bottom: 30px; font-size: 18px; line-height: 1.6;">
                        Pievienojieties mūsu kopienai un sāciet saglabāt favorītus un dalīties ar receptēm!
                    </p>
                    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ route('register') }}" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                            🚀 Izveidot bezmaksas kontu
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-primary" style="font-size: 18px; padding: 20px 40px;">
                            🔐 Ielogoties tagad
                        </a>
                    </div>
                </div>
            </div>
        @endguest

    </div>
</div>
</body>
</html>

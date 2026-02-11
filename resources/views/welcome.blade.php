<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sveicināti - Vecmāmiņas Receptes</title>
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

        .hero-section h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.6;
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
                <a href="#contact">📞 Kontakti</a>
            </div>
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
                <p>Pievienojieties tūkstošiem ēdiena entuziastu, kas dalās ar savām mīļākajām receptēm.<br>
                   Atklājiet jaunas garšas, apgūstiet gatavošanas paņēmienus un sazinieties ar citiem ēdiena mīlētājiem.</p>
                @auth
                    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary" style="font-size: 18px; padding: 20px 40px;">
                            🏠 Uz vadības paneli
                        </a>
                        <a href="/recipes/create" class="btn btn-success" style="font-size: 18px; padding: 20px 40px;">
                            📝 Izveidot pirmo recepti
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
                        <span class="stat-label">Kopā recepes</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::count() }}</span>
                        <span class="stat-label">Kopienas dalībnieki</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::distinct('category')->count() }}</span>
                        <span class="stat-label">Recepšu kategorijas</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\Recipe::whereDate('created_at', '>=', now()->subDays(7))->count() }}</span>
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
                            Izveidojiet un dalieties ar savām receptēm, izmantojot mūsu intuitīvo formu. 
                            Pievienojiet sastāvdaļas, instrukcijas, gatavošanas laikus un grūtības līmeņus.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div style="font-size: 4rem; margin-bottom: 20px;">🔍</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">Viedā meklēšana</h4>
                        <p style="color: #666; line-height: 1.6;">
                            Atrodiet ideālo recepti ar mūsu uzlaboto meklēšanas un filtrēšanas sistēmu. 
                            Meklējiet pēc sastāvdaļām, kategorijas vai grūtības līmeņa.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div style="font-size: 4rem; margin-bottom: 20px;">👥</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">Kopienas vadīta</h4>
                        <p style="color: #666; line-height: 1.6;">
                            Pievienojieties dzīvajai ēdiena entuziastu kopienai. 
                            Dalieties ar saviem kulinārijas radījumiem un atklājiet jaunus favorītus.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div style="font-size: 4rem; margin-bottom: 20px;">📂</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">Organizētas kategorijas</h4>
                        <p style="color: #666; line-height: 1.6;">
                            Pārlūkojiet receptes pēc kategorijām: brokastis, vakariņas, deserti, 
                            veģetārās, vegānās un citas.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div style="font-size: 4rem; margin-bottom: 20px;">⏱️</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">Gatavošanas laiki</h4>
                        <p style="color: #666; line-height: 1.6;">
                            Zināt precīzi, cik ilgi prasīs katra recepte ar detalizētu 
                            sagatavošanas un gatavošanas laika informāciju.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div style="font-size: 4rem; margin-bottom: 20px;">📱</div>
                        <h4 style="color: #667eea; margin-bottom: 15px;">Mobilajām ierīcēm draudzīga</h4>
                        <p style="color: #666; line-height: 1.6;">
                            Piekļūstiet savām receptēm jebkur, jebkurā laikā. Mūsu adaptīvais dizains 
                            lieliski darbojas visās ierīcēs.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Popular Categories Preview -->
            @if(\App\Models\Recipe::count() > 0)
                <div class="card">
                    <h3 class="card-title">🔥 Populārākās recepšu kategorijas</h3>
                    @php
                        $popularCategories = \App\Models\Recipe::select('category', \DB::raw('count(*) as total'))
                            ->groupBy('category')
                            ->orderBy('total', 'desc')
                            ->limit(4)
                            ->get();
                    @endphp

                    <div class="grid grid-4">
                        @foreach($popularCategories as $category)
                            <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 20px; border-radius: 12px; text-align: center;">
                                <div style="font-size: 3rem; margin-bottom: 10px;">
                                    @switch($category->category)
                                        @case('Brokastis') 🥞 @break
                                        @case('Pusdienas') 🥗 @break
                                        @case('Vakariņas') 🍽️ @break
                                        @case('Deserti') 🍰 @break
                                        @case('Uzkodas') 🥨 @break
                                        @case('Dzērieni') 🥤 @break
                                        @default 🍽️ @break
                                    @endswitch
                                </div>
                                <h5 style="color: #667eea; margin-bottom: 8px;">{{ $category->category }}</h5>
                                <p style="color: #666; font-size: 18px; font-weight: bold;">{{ $category->total }} receptes</p>
                            </div>
                        @endforeach
                    </div>

                    <div style="text-align: center; margin-top: 30px;">
                        @auth
                            <a href="/categories" class="btn btn-primary">🍽️ Apskatīt visas kategorijas</a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-success">🚀 Pievienojies, lai apskatītu kategorijas</a>
                        @endauth
                    </div>
                </div>
            @endif

            <!-- About Section -->
            <div id="about" class="card">
                <h3 class="card-title">📖 Par Vecmāmiņas Receptes</h3>
                <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                    <p style="color: #666; font-size: 18px; line-height: 1.8; margin-bottom: 30px;">
                        Vecmāmiņas Receptes ir vairāk nekā tikai recepšu koplietošanas platforma – tā ir kopiena, kurā 
                        ēdiena mīlētāji sanāk kopā, lai svinētu kulinārijas mākslu. Neatkarīgi no tā, vai esat profesionāls 
                        pavārs vai mājas gatavošanas entuziasts, jūs atradīsiet iedvesmu, paņēmienus un garšīgas receptes, ko izmēģināt.
                    </p>
                    <p style="color: #666; font-size: 16px; line-height: 1.6;">
                        Mūsu misija ir padarīt gatavošanu pieejamu, patīkamu un sociālu. Pievienojieties mums, lai izveidotu 
                        pasaules visaptverošāko un draudzīgāko recepšu kolekciju!
                    </p>
                </div>
            </div>

            <!-- Call to Action -->
            @guest
                <div class="card text-center">
                    <div style="padding: 40px;">
                        <h3 style="color: #667eea; margin-bottom: 20px; font-size: 2rem;">Gatavi sākt gatavot? 🍳</h3>
                        <p style="color: #666; margin-bottom: 30px; font-size: 18px; line-height: 1.6;">
                            Pievienojieties mūsu kopienai šodien un sāciet dalīties ar saviem kulinārijas meistarišķumiem!
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

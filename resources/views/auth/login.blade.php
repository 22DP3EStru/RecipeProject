<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ielogoties - Recepšu Aplikācija</title>
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
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
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

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .alert {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid transparent;
        }

        .alert-error {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.1) 0%, rgba(255, 75, 43, 0.1) 100%);
            border-color: rgba(255, 65, 108, 0.2);
            color: #c62828;
        }

        .welcome-back {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .auth-links {
            text-align: center;
            padding: 25px;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 12px;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 25px; }
            .container { padding: 15px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🍽️ Laipni lūdzam atpakaļ!</h1>
            <p>Ielogojieties savā Recepšu Aplikācijas kontā</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="/">🏠 Sākums</a>
                <a href="{{ route('register') }}">📝 Reģistrēties</a>
            </div>
            <div>
                <a href="/" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">← Atpakaļ uz sākumu</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Message -->
            <div class="welcome-back">
                <div style="font-size: 4rem; margin-bottom: 20px;">👨‍🍳</div>
                <h2 style="color: #667eea; margin-bottom: 10px;">Gatavi gatavot?</h2>
                <p style="color: #666; font-size: 16px;">Ielogojieties, lai piekļūtu savām receptēm un atklātu jaunus kulinārijas piedzīvojumus!</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-error">
                    <h4 style="margin-bottom: 15px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">❌</span>
                        Lūdzu, izlabojiet šādas kļūdas:
                    </h4>
                    <ul style="margin-left: 30px; line-height: 1.6;">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 5px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="email">📧 E-pasta adrese</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="form-input" placeholder="Ievadiet savu e-pasta adresi" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">🔒 Parole</label>
                    <input type="password" id="password" name="password" 
                           class="form-input" placeholder="Ievadiet savu paroli" required>
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center; color: #666; font-size: 16px;">
                        <input type="checkbox" name="remember" style="margin-right: 12px; transform: scale(1.3);">
                        Atcerēties mani 30 dienas
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 30px; font-size: 18px; padding: 18px;">
                    🔐 Ielogoties Recepšu Aplikācijā
                </button>
            </form>

            <!-- Auth Links -->
            <div class="auth-links">
                <h4 style="color: #667eea; margin-bottom: 20px;">Jauns Recepšu Aplikācijā?</h4>
                <p style="color: #666; margin-bottom: 20px; line-height: 1.6;">
                    Pievienojieties tūkstošiem ēdiena entuziastu, kas dalās ar savām mīļākajām receptēm un atklāj jaunus kulinārijas piedzīvojumus!
                </p>
                
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-bottom: 25px;">
                    <a href="{{ route('register') }}" class="btn btn-success" style="font-size: 16px;">
                        🚀 Izveidot bezmaksas kontu
                    </a>
                </div>
                
                @if (Route::has('password.request'))
                    <p style="margin: 0;">
                        <a href="{{ route('password.request') }}" style="color: #667eea; text-decoration: none; font-weight: 600; font-size: 15px;">
                            🔑 Aizmirsāt paroli? Atjaunojiet to šeit
                        </a>
                    </p>
                @endif
            </div>

            <!-- Features Preview -->
            <div class="card">
                <h3 style="text-align: center; color: #333; margin-bottom: 25px;">✨ Kas jūs gaida iekšpusē</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">📝</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">Izveidot receptes</h5>
                        <p style="color: #666; font-size: 13px;">Dalieties ar saviem kulinārijas meistarišķumiem</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">🔍</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">Atklāt receptes</h5>
                        <p style="color: #666; font-size: 13px;">Atrodiet jaunus mīļākos ēdienus</p>
                    </div>
                    <div style="text-align: center; padding: 20px;">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">👥</div>
                        <h5 style="color: #667eea; margin-bottom: 8px;">Pievienoties kopienai</h5>
                        <p style="color: #666; font-size: 13px;">Sazināties ar ēdiena mīlētājiem</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

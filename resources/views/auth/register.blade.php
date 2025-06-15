<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Recipe App</title>
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

        .text-center { text-align: center; }

        .welcome-section {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%);
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .auth-links {
            text-align: center;
            padding: 25px;
            background: rgba(86, 171, 47, 0.05);
            border-radius: 12px;
            margin-top: 30px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }

        .benefit-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
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
            <h1>🍽️ Join Recipe App!</h1>
            <p>Create your account and start sharing recipes</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/" class="nav-brand">🍽️ Recipe App</a>
            <div class="nav-links">
                <a href="/">🏠 Home</a>
                <a href="{{ route('login') }}">🔐 Login</a>
            </div>
            <div>
                <a href="/" class="btn btn-warning" style="padding: 10px 20px; font-size: 14px;">← Back to Home</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div style="font-size: 4rem; margin-bottom: 20px;">🎉</div>
                <h2 style="color: #667eea; margin-bottom: 10px;">Welcome to Our Community!</h2>
                <p style="color: #666; font-size: 16px;">Join thousands of food enthusiasts sharing their culinary creations</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-error">
                    <h4 style="margin-bottom: 15px; display: flex; align-items: center;">
                        <span style="margin-right: 10px;">❌</span>
                        Please fix the following errors:
                    </h4>
                    <ul style="margin-left: 30px; line-height: 1.6;">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 5px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">👤 Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                           class="form-input" placeholder="Enter your full name" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">📧 Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="form-input" placeholder="Enter your email address" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">🔒 Password</label>
                    <input type="password" id="password" name="password" 
                           class="form-input" placeholder="Create a strong password (min 8 characters)" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">🔒 Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="form-input" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 30px; font-size: 18px; padding: 18px;">
                    🎉 Create My Account
                </button>
            </form>

            <!-- What You Get -->
            <div class="card">
                <h3 style="text-align: center; color: #333; margin-bottom: 25px;">🌟 What you get with your free account</h3>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">📝</div>
                        <h5 style="color: #56ab2f; margin-bottom: 8px;">Create Recipes</h5>
                        <p style="color: #666; font-size: 13px; line-height: 1.4;">Share unlimited recipes with detailed ingredients and instructions</p>
                    </div>
                    <div class="benefit-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">🔍</div>
                        <h5 style="color: #56ab2f; margin-bottom: 8px;">Smart Search</h5>
                        <p style="color: #666; font-size: 13px; line-height: 1.4;">Find recipes by ingredients, categories, or difficulty levels</p>
                    </div>
                    <div class="benefit-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">❤️</div>
                        <h5 style="color: #56ab2f; margin-bottom: 8px;">Save Favorites</h5>
                        <p style="color: #666; font-size: 13px; line-height: 1.4;">Bookmark your favorite recipes for quick access</p>
                    </div>
                    <div class="benefit-item">
                        <div style="font-size: 2.5rem; margin-bottom: 10px;">👥</div>
                        <h5 style="color: #56ab2f; margin-bottom: 8px;">Join Community</h5>
                        <p style="color: #666; font-size: 13px; line-height: 1.4;">Connect with fellow food enthusiasts worldwide</p>
                    </div>
                </div>
            </div>

            <!-- Auth Links -->
            <div class="auth-links">
                <h4 style="color: #56ab2f; margin-bottom: 20px;">Already have an account?</h4>
                <p style="color: #666; margin-bottom: 20px; line-height: 1.6;">
                    Sign in to access your recipes and continue your culinary journey!
                </p>
                
                <a href="{{ route('login') }}" class="btn btn-primary" style="font-size: 16px;">
                    🔐 Sign In to Your Account
                </a>
            </div>

            <!-- Community Stats -->
            <div class="card">
                <h3 style="text-align: center; color: #333; margin-bottom: 25px;">📊 Join Our Growing Community</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; text-align: center;">
                    <div style="padding: 20px;">
                        <div style="font-size: 2.5rem; color: #56ab2f; font-weight: bold; margin-bottom: 5px;">{{ \App\Models\User::count() }}+</div>
                        <p style="color: #666; font-size: 14px;">Active Members</p>
                    </div>
                    <div style="padding: 20px;">
                        <div style="font-size: 2.5rem; color: #56ab2f; font-weight: bold; margin-bottom: 5px;">{{ \App\Models\Recipe::count() }}+</div>
                        <p style="color: #666; font-size: 14px;">Shared Recipes</p>
                    </div>
                    <div style="padding: 20px;">
                        <div style="font-size: 2.5rem; color: #56ab2f; font-weight: bold; margin-bottom: 5px;">{{ \App\Models\Recipe::distinct('category')->count() }}+</div>
                        <p style="color: #666; font-size: 14px;">Categories</p>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 25px; padding: 20px; background: rgba(86, 171, 47, 0.1); border-radius: 10px;">
                    <p style="color: #666; font-style: italic; margin: 0;">
                        "The best recipes come from passionate home cooks sharing their family secrets!"
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

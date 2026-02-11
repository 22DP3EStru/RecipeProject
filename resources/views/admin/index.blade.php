<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrācijas panelis - Vecmāmiņas Receptes</title>
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

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
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

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔧 Administrācijas panelis</h1>
            <p>Pārvaldiet lietotājus un receptes</p>
        </div>

        <div class="main-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>👥 Lietotāji</h3>
                    <p style="font-size: 2rem; color: #667eea; margin: 10px 0;">{{ $totalUsers }}</p>
                    <a href="{{ route('admin.users') }}" class="btn btn-primary">Pārvaldīt</a>
                </div>

                <div class="stat-card">
                    <h3>🍽️ Receptes</h3>
                    <p style="font-size: 2rem; color: #667eea; margin: 10px 0;">{{ $totalRecipes }}</p>
                    <a href="{{ route('admin.recipes') }}" class="btn btn-primary">Pārvaldīt</a>
                </div>

                <div class="stat-card">
                    <h3>🔧 Administratori</h3>
                    <p style="font-size: 2rem; color: #667eea; margin: 10px 0;">{{ $totalAdmins }}</p>
                </div>
            </div>

            <a href="/dashboard" class="btn btn-primary">← Atpakaļ uz vadības paneli</a>
        </div>
    </div>
</body>
</html>

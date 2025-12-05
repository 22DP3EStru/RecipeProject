<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotāju pārvaldība - Recepšu Aplikācija</title>
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

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .user-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .admin-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .user-badge {
            background: rgba(86, 171, 47, 0.1);
            color: #56ab2f;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 13px;
            margin: 2px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(86, 171, 47, 0.1) 0%, rgba(168, 230, 207, 0.1) 100%);
            color: #56ab2f;
            border: 1px solid rgba(86, 171, 47, 0.2);
        }

        .alert-error {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.1) 0%, rgba(255, 75, 43, 0.1) 100%);
            color: #ff416c;
            border: 1px solid rgba(255, 65, 108, 0.2);
        }

        .stats-bar {
            display: flex;
            justify-content: space-around;
            background: rgba(102, 126, 234, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            margin: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header p { font-size: 1rem; }
            .nav-bar { flex-direction: column; gap: 15px; }
            .main-content { padding: 20px; }
            .users-grid { grid-template-columns: 1fr; }
            .stats-bar { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>👥 Lietotāju pārvaldība</h1>
            <p>Pārvaldiet visus sistēmas lietotājus</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recepšu Aplikācija</a>
            <div class="nav-links">
                <a href="{{ route('admin.index') }}">🔧 Admin panelis</a>
                <a href="{{ route('admin.users') }}">👥 Lietotāji</a>
                <a href="{{ route('admin.recipes') }}">🍽️ Receptes</a>
                <a href="/dashboard">🏠 Vadības panelis</a>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span style="color: #666; font-weight: 500;">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 12px;">Iziet</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Breadcrumb -->
            <div style="margin-bottom: 30px; padding: 15px; background: rgba(102, 126, 234, 0.1); border-radius: 10px;">
                <a href="{{ route('admin.index') }}" style="color: #667eea; text-decoration: none;">🔧 Admin panelis</a> 
                <span style="color: #666;"> / </span>
                <span style="color: #333; font-weight: 600;">👥 Lietotāju pārvaldība</span>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <!-- Statistics -->
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-number">{{ $users->total() }}</div>
                    <div class="stat-label">Kopā lietotāju</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $users->where('is_admin', true)->count() }}</div>
                    <div class="stat-label">Administratori</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $users->where('is_admin', false)->count() }}</div>
                    <div class="stat-label">Parastie lietotāji</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                    <div class="stat-label">Jauni šonedēļ</div>
                </div>
            </div>

            <!-- Users Grid -->
            @if($users->count() > 0)
                <div class="users-grid">
                    @foreach($users as $user)
                        <div class="user-card">
                            <!-- User Badge -->
                            @if($user->is_admin)
                                <div class="admin-badge">🔧 Administrators</div>
                            @else
                                <div class="user-badge">👤 Lietotājs</div>
                            @endif

                            <!-- User Info -->
                            <div style="margin-bottom: 20px;">
                                <h3 style="color: #667eea; margin-bottom: 8px; font-size: 1.3rem;">
                                    {{ $user->name }}
                                </h3>
                                <p style="color: #666; margin-bottom: 8px;">
                                    📧 {{ $user->email }}
                                </p>
                                <div style="display: flex; justify-content: space-between; font-size: 14px; color: #999;">
                                    <span>📅 Reģ: {{ $user->created_at->format('d.m.Y') }}</span>
                                    <span>🍽️ {{ $user->recipes->count() }} receptes</span>
                                </div>
                            </div>

                            <!-- User Stats -->
                            <div style="background: rgba(102, 126, 234, 0.05); padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; font-size: 13px;">
                                    <span>📧 E-pasts apstiprināts:</span>
                                    <span style="color:{!! $user->email_verified_at ? '#56ab2f' : '#ff416c' !!};">
                                        {{ $user->email_verified_at ? '✅ Jā' : '❌ Nē' }}
                                    </span>
                                </div>
                                <div style="display: flex; justify-content: space-between; font-size: 13px; margin-top: 8px;">
                                    <span>🕒 Pēdējā aktivitāte:</span>
                                    <span>{{ $user->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <!-- Toggle Admin Status -->
                                @if($user->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn {{ $user->is_admin ? 'btn-warning' : 'btn-success' }}" 
                                                onclick="return confirm('Vai tiešām mainīt lietotāja statusu?')">
                                            {{ $user->is_admin ? '🔻 Noņemt admin' : '🔺 Padarīt par admin' }}
                                        </button>
                                    </form>

                                    <!-- Delete User -->
                                    @if(!$user->is_admin)
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Vai tiešām dzēst šo lietotāju? Šī darbība ir neatgriezeniska!')">
                                                🗑️ Dzēst
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <span class="btn btn-secondary" style="cursor: not-allowed; opacity: 0.6;">
                                        👑 Jūs pats
                                    </span>
                                @endif

                                <!-- View User Recipes -->
                                @if($user->recipes->count() > 0)
                                    <a href="/recipes?user={{ $user->id }}" class="btn btn-primary">
                                        👁️ Skatīt receptes ({{ $user->recipes->count() }})
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="margin-top: 40px; display: flex; justify-content: center;">
                    {{ $users->links() }}
                </div>
            @else
                <!-- No Users -->
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="font-size: 4rem; margin-bottom: 20px; opacity: 0.5;">👥</div>
                    <h3 style="color: #666; margin-bottom: 15px;">Nav lietotāju</h3>
                    <p style="color: #999;">Nav atrasts neviens lietotājs sistēmā.</p>
                </div>
            @endif

            <!-- Quick Actions -->
            <div style="margin-top: 40px; padding: 30px; background: rgba(102, 126, 234, 0.05); border-radius: 15px;">
                <h3 style="text-align: center; color: #667eea; margin-bottom: 25px;">🚀 Ātras darbības</h3>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">
                        🔧 Admin panelis
                    </a>
                    <a href="{{ route('admin.recipes') }}" class="btn btn-success">
                        🍽️ Pārvaldīt receptes
                    </a>
                    <a href="/dashboard" class="btn btn-secondary">
                        🏠 Vadības panelis
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
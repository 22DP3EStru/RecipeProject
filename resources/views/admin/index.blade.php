<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 20px; 
            background: #f5f5f5; 
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { 
            color: #333; 
            border-bottom: 3px solid #007cba; 
            padding-bottom: 10px; 
        }
        .stats { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 20px; 
            margin: 20px 0; 
        }
        .stat-box { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; 
            padding: 20px; 
            border-radius: 10px; 
            text-align: center; 
        }
        .stat-number { 
            font-size: 2rem; 
            font-weight: bold; 
            display: block; 
        }
        .stat-label { 
            font-size: 0.9rem; 
            opacity: 0.9; 
        }
        .section { 
            background: #f9f9f9; 
            padding: 20px; 
            margin: 20px 0; 
            border-radius: 8px; 
            border-left: 4px solid #007cba; 
        }
        .btn { 
            display: inline-block; 
            background: #007cba; 
            color: white; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 5px; 
            margin: 5px; 
            transition: background 0.3s; 
        }
        .btn:hover { 
            background: #005a8b; 
        }
        .btn-danger { 
            background: #dc3545; 
        }
        .btn-danger:hover { 
            background: #c82333; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background: #f8f9fa; 
            font-weight: bold; 
        }
        tr:nth-child(even) { 
            background: #f8f9fa; 
        }
        .alert { 
            padding: 15px; 
            margin: 15px 0; 
            border-radius: 5px; 
        }
        .alert-success { 
            background: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
        }
        .alert-error { 
            background: #f8d7da; 
            color: #721c24; 
            border: 1px solid #f5c6cb; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Admin Panel Dashboard</h1>
        
        <p><strong>Welcome:</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
        
        <!-- Alerts -->
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
        <div class="stats">
            <div class="stat-box">
                <span class="stat-number">{{ App\Models\User::count() }}</span>
                <span class="stat-label">Total Users</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ App\Models\Recipe::count() }}</span>
                <span class="stat-label">Total Recipes</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ App\Models\User::where('is_admin', true)->count() }}</span>
                <span class="stat-label">Admin Users</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ App\Models\User::whereDate('created_at', today())->count() }}</span>
                <span class="stat-label">New Users Today</span>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="section">
            <h3>🚀 Quick Actions</h3>
            <a href="{{ route('admin.users') }}" class="btn">👥 Manage Users</a>
            <a href="{{ route('admin.recipes') }}" class="btn">🍽️ Manage Recipes</a>
            <a href="{{ route('dashboard') }}" class="btn">← Back to Dashboard</a>
        </div>
        
        <!-- Recent Users -->
        <div class="section">
            <h3>👥 Latest Users (Last 10)</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\User::latest()->take(10)->get() as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span style="color: red; font-weight: bold;">✅ YES</span>
                            @else
                                <span style="color: green;">❌ NO</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($user->id !== Auth::id())
                                <a href="{{ route('admin.delete-user', $user->id) }}" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Delete {{ $user->name }}?')">
                                   Delete
                                </a>
                            @else
                                <span style="color: gray; font-style: italic;">You</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Recent Recipes -->
        <div class="section">
            <h3>🍽️ Latest Recipes (Last 10)</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\Recipe::with('user')->latest()->take(10)->get() as $recipe)
                    <tr>
                        <td>{{ $recipe->id }}</td>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ optional($recipe->user)->name ?? 'Unknown' }}</td>
                        <td>{{ $recipe->category ?? 'None' }}</td>
                        <td>{{ $recipe->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="/admin/delete-recipe/{{ $recipe->id }}" 
                               class="btn btn-danger" 
                               onclick="return confirm('Delete {{ $recipe->title }}?')">
                               Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- System Info -->
        <div class="section">
            <h3>📊 System Information</h3>
            <p><strong>Laravel Version:</strong> {{ app()->version() }}</p>
            <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
            <p><strong>Current Time:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>
            <p><strong>Server:</strong> {{ $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' }}</p>
        </div>
    </div>
</body>
</html>

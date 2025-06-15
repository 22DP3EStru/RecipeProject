<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin Panel</title>
    <link rel="stylesheet" href="/css/welcome-style.css">
    <style>
        .user-card.admin-border { border-left: 4px solid #ff4b2b; }
        .user-card.user-border { border-left: 4px solid #667eea; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>👥 User Management</h1>
            <p>Manage all user accounts and permissions</p>
        </div>

        <!-- Navigation -->
        <nav class="nav-bar">
            <a href="/dashboard" class="nav-brand">🍽️ Recipe App</a>
            <div class="nav-links">
                <a href="/dashboard">🏠 Dashboard</a>
                <a href="/recipes">🍽️ Recipes</a>
                <a href="/categories">📂 Categories</a>
                <a href="/profile/recipes">📝 My Recipes</a>
                <a href="{{ route('admin.index') }}">🔧 Admin</a>
            </div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <span class="nav-user">👤 {{ Auth::user()->name }} (Admin)</span>
                <a href="{{ route('admin.index') }}" class="btn btn-logout">← Admin Panel</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Admin Warning -->
            <div class="admin-alert">
                <h3 style="margin-bottom: 15px;">⚠️ USER MANAGEMENT PANEL</h3>
                <p style="margin: 0;">You are managing user accounts. Exercise caution when deleting users as this action is permanent.</p>
            </div>

            <!-- User Statistics -->
            <div class="card">
                <h3 class="card-title">📊 User Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-box">
                        <span class="stat-number">{{ $users->total() }}</span>
                        <span class="stat-label">Total Users</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::where('is_admin', true)->count() }}</span>
                        <span class="stat-label">Administrators</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::where('is_admin', false)->count() }}</span>
                        <span class="stat-label">Regular Users</span>
                    </div>
                    <div class="stat-box">
                        <span class="stat-number">{{ \App\Models\User::whereDate('created_at', today())->count() }}</span>
                        <span class="stat-label">Joined Today</span>
                    </div>
                </div>
            </div>

            <!-- Users List -->
            @if($users->count() > 0)
                <div class="card">
                    <div class="grid grid-2">
                        @foreach($users as $user)
                            <div class="user-card {{ $user->is_admin ? 'admin-border' : 'user-border' }}" style="background: rgba(102, 126, 234, 0.05); padding: 20px; border-radius: 12px;">
                                <!-- User Header -->
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                    <div>
                                        <h4 style="margin: 0; color: #667eea; font-size: 1.2rem;">{{ $user->name }}</h4>
                                        @if($user->is_admin)
                                            <span style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); color: white; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">
                                                🔧 ADMINISTRATOR
                                            </span>
                                        @else
                                            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">
                                                👤 USER
                                            </span>
                                        @endif
                                    </div>
                                    <div style="text-align: right; font-size: 12px; color: #999;">
                                        ID: {{ $user->id }}
                                    </div>
                                </div>

                                <!-- User Info -->
                                <div style="margin-bottom: 15px;">
                                    <p style="margin: 5px 0; color: #666; font-size: 14px;">
                                        <strong>Email:</strong> {{ $user->email }}
                                    </p>
                                    <p style="margin: 5px 0; color: #666; font-size: 14px;">
                                        <strong>Member Since:</strong> {{ $user->created_at->format('M j, Y') }} ({{ $user->created_at->diffForHumans() }})
                                    </p>
                                    <p style="margin: 5px 0; color: #666; font-size: 14px;">
                                        <strong>Recipes Created:</strong> {{ \App\Models\Recipe::where('user_id', $user->id)->count() }}
                                    </p>
                                </div>

                                <!-- User Actions -->
                                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <a href="/profile/recipes?user_id={{ $user->id }}" class="btn btn-primary" style="flex: 1; font-size: 12px; padding: 8px;">
                                        📝 View Recipes
                                    </a>
                                    
                                    @if($user->id !== Auth::id())
                                        <button onclick="deleteUser('{{ $user->id }}', '{{ addslashes($user->name) }}')" class="btn btn-danger" style="flex: 1; font-size: 12px; padding: 8px;">
                                            🗑️ Delete User
                                        </button>
                                    @else
                                        <span style="flex: 1; font-size: 12px; padding: 8px; text-align: center; color: #999; background: rgba(0,0,0,0.1); border-radius: 8px;">
                                            👤 You
                                        </span>
                                    @endif
                                </div>

                                <!-- Delete Form (Hidden) -->
                                @if($user->id !== Auth::id())
                                    <form id="delete-user-form-{{ $user->id }}" method="POST" action="{{ route('admin.delete-user', $user->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                        <div style="margin-top: 30px;">
                            <div style="display: flex; justify-content: center; align-items: center; gap: 15px;">
                                @if($users->onFirstPage())
                                    <span class="btn btn-danger" style="opacity: 0.5;">← Previous</span>
                                @else
                                    <a href="{{ $users->previousPageUrl() }}" class="btn btn-primary">← Previous</a>
                                @endif

                                <span style="color: #666; font-weight: 500; margin: 0 20px;">
                                    Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                                </span>

                                @if($users->hasMorePages())
                                    <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary">Next →</a>
                                @else
                                    <span class="btn btn-danger" style="opacity: 0.5;">Next →</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="card text-center">
                    <div style="padding: 60px;">
                        <div style="font-size: 6rem; margin-bottom: 25px;">👥</div>
                        <h3 style="color: #667eea; margin-bottom: 15px;">No users found</h3>
                        <p style="color: #666; margin-bottom: 25px;">This shouldn't happen! There should be at least your admin account.</p>
                        <a href="{{ route('admin.index') }}" class="btn btn-primary">← Back to Admin Panel</a>
                    </div>
                </div>
            @endif

            <!-- Recent User Activity -->
            <div class="card">
                <h3 class="card-title">📈 Recent User Activity</h3>
                @php
                    $recentUsers = \App\Models\User::latest()->take(8)->get();
                @endphp
                
                @if($recentUsers->count() > 0)
                    <div class="grid grid-4">
                        @foreach($recentUsers as $recentUser)
                            <div style="background: white; padding: 15px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); text-align: center;">
                                <div style="font-size: 2rem; margin-bottom: 10px;">
                                    {{ $recentUser->is_admin ? '🔧' : '👤' }}
                                </div>
                                <h5 style="margin: 0; color: #667eea; font-size: 14px;">{{ Str::limit($recentUser->name, 20) }}</h5>
                                <p style="color: #666; font-size: 11px; margin: 5px 0;">{{ $recentUser->created_at->diffForHumans() }}</p>
                                <div style="font-size: 11px; color: #999;">
                                    {{ \App\Models\Recipe::where('user_id', $recentUser->id)->count() }} recipes
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Admin Actions -->
            <div class="card">
                <h3 class="card-title">🛠️ Admin Actions</h3>
                <div class="grid grid-3">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">🔧 Admin Dashboard</a>
                    <a href="{{ route('admin.recipes') }}" class="btn btn-success">🍽️ Manage Recipes</a>
                    <a href="/dashboard" class="btn btn-warning">🏠 Main Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteUser(userId, userName) {
            if (confirm(`Are you sure you want to delete user "${userName}"? This will also delete all their recipes and cannot be undone.`)) {
                document.getElementById('delete-user-form-' + userId).submit();
            }
        }
    </script>
</body>
</html>
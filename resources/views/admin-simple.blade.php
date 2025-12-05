<!DOCTYPE html>
<html>
<head>
    <title>ADMIN PANEL</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f0f0; }
        .container { background: white; padding: 30px; border-radius: 10px; }
        h1 { color: red; }
        .stat-box { background: #e0e0e0; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .user-list { background: #f5f5f5; padding: 15px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #ddd; }
        .btn { background: #007cba; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-danger { background: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1>š”§ ADMIN PANEL - SUCCESS!</h1>
        
        <p><strong>Logged in as:</strong> {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
        
        <div class="stat-box">
            <h3>š“ Statistics</h3>
            <p>Total Users: <strong>{{ App\Models\User::count() }}</strong></p>
            <p>Total Recipes: <strong>{{ App\Models\Recipe::count() }}</strong></p>
            <p>Total Admins: <strong>{{ App\Models\User::where('is_admin', true)->count() }}</strong></p>
        </div>
        
        <div class="user-list">
            <h3>š‘ All Users</h3>
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
                    @foreach(App\Models\User::all() as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'ā… YES' : 'ā¯ NO' }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($user->id !== Auth::id())
                                <a href="/admin/delete-user/{{ $user->id }}" class="btn btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                            @else
                                <span style="color: gray;">You</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="user-list">
            <h3>š¨½ļø¸ All Recipes</h3>
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
                    @foreach(App\Models\Recipe::with('user')->get() as $recipe)
                    <tr>
                        <td>{{ $recipe->id }}</td>
                        <td>{{ $recipe->title }}</td>
                        <td>{{ optional($recipe->user)->name ?? 'Unknown' }}</td>
                        <td>{{ $recipe->category ?? 'None' }}</td>
                        <td>{{ $recipe->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="/admin/delete-recipe/{{ $recipe->id }}" class="btn btn-danger" onclick="return confirm('Delete this recipe?')">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <br>
        <a href="/dashboard" class="btn">ā† Back to Dashboard</a>
    </div>
</body>
</html>


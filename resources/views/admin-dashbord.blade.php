@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    {{-- Tab navigācija --}}
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab">Overview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="recipes-tab" data-bs-toggle="tab" href="#recipes" role="tab">Recipes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="analytics-tab" data-bs-toggle="tab" href="#analytics" role="tab">Analytics</a>
        </li>
    </ul>

    {{-- Tab saturs --}}
    <div class="tab-content mt-3" id="dashboardTabsContent">
        {{-- OVERVIEW --}}
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Total Recipes</h5>
                            <p class="display-6">{{ $totalRecipes }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Total Users</h5>
                            <p class="display-6">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Site Visits</h5>
                            <p class="display-6">{{ $siteVisits }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RECIPES --}}
    <div class="tab-pane fade" id="recipes" role="tabpanel">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Recipe List</h5>
            <input type="text" class="form-control w-25" placeholder="Search recipes..." id="recipeSearch">
        </div>

        <div class="list-group" id="recipeList">
            @foreach ($recipes as $recipe)
                <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <strong>{{ $recipe->title }}</strong>
                        <p class="mb-0">{{ Str::limit($recipe->description, 80) }}</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

        {{-- USERS --}}
        <div class="tab-pane fade" id="users" role="tabpanel">
            <h5 class="mb-3">User List</h5>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                {{-- Aizliegts dzēst sevi vai adminus (piemērs) --}}
                                @if (auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                                @else
                                    <em class="text-muted">—</em>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ANALYTICS --}}
        <div class="tab-pane fade" id="analytics" role="tabpanel">
            <h5 class="mb-3">Analytics Overview</h5>
            {{-- Placeholder --}}
            <div class="alert alert-info">Analytics charts coming soon!</div>
        </div>
    </div>
</div>

<script>
    // Vienkārša receptes meklēšana (klienta pusē)
    document.getElementById('recipeSearch').addEventListener('input', function () {
        let searchValue = this.value.toLowerCase();
        document.querySelectorAll('#recipeList .list-group-item').forEach(item => {
            let title = item.querySelector('strong').innerText.toLowerCase();
            item.style.display = title.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Administrācijas panelis</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-2">Lietotāji</h2>
            <ul>
                @foreach (\App\Models\User::all() as $user)
                    <li class="mb-1">
                        {{ $user->name }} ({{ $user->email }})
                        @if (!$user->is_admin)
                            <form action="{{ route('admin.deleteUser', $user) }}" method="POST" class="inline ml-2">
                                @csrf @method('DELETE')
                                <button class="text-red-500 text-sm hover:underline">Dzēst</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-2">Receptes</h2>
            <ul>
                @foreach (\App\Models\Recipe::latest()->take(10)->get() as $recipe)
                    <li class="mb-1">
                        {{ $recipe->title }} — {{ $recipe->user->name }}
                        <form action="{{ route('admin.deleteRecipe', $recipe) }}" method="POST" class="inline ml-2">
                            @csrf @method('DELETE')
                            <button class="text-red-500 text-sm hover:underline">Dzēst</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">All Recipes</h1>

    @if ($recipes->isEmpty())
        <p class="text-gray-600">No recipes found. <a href="{{ route('recipes.create') }}" class="text-indigo-600 hover:underline">Add one</a>!</p>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($recipes as $recipe)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-indigo-800 mb-2">{{ $recipe->title }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($recipe->description, 100) }}</p>
                        <a href="{{ route('recipes.show', $recipe) }}" class="inline-block mt-auto text-sm font-medium text-indigo-600 hover:underline">View Recipe</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

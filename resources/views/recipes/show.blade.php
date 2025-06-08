@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold text-indigo-800 mb-4">{{ $recipe->title }}</h1>

        <div class="mb-6 text-gray-700 whitespace-pre-line">
            {{ $recipe->description }}
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Ingredients</h2>
        @if ($recipe->ingredients->isEmpty())
            <p class="text-gray-500">No ingredients listed.</p>
        @else
            <ul class="list-disc pl-5 space-y-1 text-gray-700">
                @foreach ($recipe->ingredients as $ingredient)
                    <li>{{ $ingredient->quantity ? $ingredient->quantity . ' - ' : '' }}{{ $ingredient->name }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('recipes.edit', $recipe) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Edit</a>
            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
            </form>
        </div>
    </div>
@endsection

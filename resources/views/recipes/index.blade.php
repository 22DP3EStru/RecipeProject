@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Visas receptes</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($recipes as $recipe)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                @if ($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $recipe->title }}</h2>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($recipe->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('recipes.show', $recipe) }}" class="text-red-500 hover:underline">Skatīt</a>
                        <span class="text-xs text-gray-500">autors: {{ $recipe->user->name }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

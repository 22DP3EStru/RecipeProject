@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Receptes</h1>

{{-- kategoriju filtri --}}
<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('recipes.index') }}"
       class="px-3 py-1 rounded-full border {{ request('category') ? 'border-gray-300' : 'bg-indigo-600 text-white' }}">
        Visas
    </a>
    @foreach ($categories as $cat)
        <a href="{{ route('recipes.index', ['category' => $cat->slug]) }}"
           class="px-3 py-1 rounded-full border
                  {{ request('category') === $cat->slug ? 'bg-indigo-600 text-white' : 'border-gray-300' }}">
            {{ $cat->name }}
        </a>
    @endforeach
</div>

{{-- recepšu režģis --}}
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
@forelse ($recipes as $recipe)
    <a href="{{ route('recipes.show', $recipe->slug) }}" class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
        <img src="{{ $recipe->image ?? 'https://placehold.co/600x400?text=No+Image' }}"
             alt="{{ $recipe->title }}" class="rounded-lg mb-4 aspect-[3/2] object-cover">
        <h2 class="font-semibold text-lg mb-1">{{ $recipe->title }}</h2>
        <p class="text-sm text-gray-600 line-clamp-2 flex-grow">{{ $recipe->description }}</p>
        <div class="text-xs text-gray-400 mt-2">— {{ $recipe->author->name }}</div>
    </a>
@empty
    <p>Nav atrasta neviena recepte 😢</p>
@endforelse
</div>

{{ $recipes->links() }}
@endsection

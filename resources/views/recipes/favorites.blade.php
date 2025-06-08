@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Mani favorīti</h1>

@if ($recipes->isEmpty())
    <p>Te vēl nav nevienas receptes. Pievieno kādu!</p>
@else
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($recipes as $recipe)
        <a href="{{ route('recipes.show', $recipe->slug) }}"
           class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
            <img src="{{ $recipe->image ?? 'https://placehold.co/600x400?text=No+Image' }}"
                 alt="{{ $recipe->title }}" class="rounded-lg mb-4 aspect-[3/2] object-cover">
            <h2 class="font-semibold text-lg mb-1">{{ $recipe->title }}</h2>
            <p class="text-xs text-gray-500 mt-auto">— {{ $recipe->author->name }}</p>
        </a>
    @endforeach
    </div>

    {{ $recipes->links() }}
@endif
@endsection

@extends('layouts.app')

@section('content')
<article class="max-w-3xl mx-auto prose prose-indigo">
    <img src="{{ $recipe->image ?? 'https://placehold.co/800x500?text=No+Image' }}"
         class="rounded-lg mb-6 w-full aspect-[3/2] object-cover" alt="{{ $recipe->title }}">

    <h1 class="text-4xl font-bold mb-4">{{ $recipe->title }}</h1>

    {{-- favorīts --}}
    @auth
        <form action="{{ route('recipes.favorite', $recipe) }}" method="post" class="inline-block mb-6">
            @csrf
            <button class="px-4 py-2 rounded-lg
                           {{ $recipe->favorites->where('user_id', auth()->id())->count() ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
                {{ $recipe->favorites->where('user_id', auth()->id())->count() ? 'Noņemt no favorītiem' : 'Pievienot favorītos' }}
            </button>
        </form>
    @endauth

    <h2 class="text-2xl font-semibold mt-8 mb-2">Sastāvdaļas</h2>
    <pre class="bg-gray-100 rounded-lg p-4 whitespace-pre-wrap">{{ $recipe->ingredients }}</pre>

    <h2 class="text-2xl font-semibold mt-8 mb-2">Pagatavošana</h2>
    <pre class="bg-gray-100 rounded-lg p-4 whitespace-pre-wrap">{{ $recipe->steps }}</pre>
</article>
@endsection

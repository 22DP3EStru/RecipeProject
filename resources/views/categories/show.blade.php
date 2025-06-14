@extends('layouts.app')

@section('title', $category->name . ' - Kategorijas - RecipeHub')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <!-- Category Header -->
    <div class="mb-8">
        <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-orange-600">Sākums</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('categories.index') }}" class="hover:text-orange-600">Kategorijas</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900">{{ $category->name }}</span>
        </nav>

        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @switch($category->name)
                        @case('Zupas')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                            @break
                        @case('Pamatēdieni')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            @break
                        @case('Deserti')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                            @break
                        @case('Uzkodas')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @break
                        @case('Dzērieni')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            @break
                        @default
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    @endswitch
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
                <p class="text-gray-600">{{ $recipes->total() }} {{ $recipes->total() === 1 ? 'recepte' : 'receptes' }}</p>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold mb-2">{{ $category->name }} receptes</h3>
                    <p class="text-gray-600">{{ $recipes->total() }} {{ Str::plural('recepte', $recipes->total()) }} atrastas</p>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('categories.index') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        ← Visas kategorijas
                    </a>
                    <a href="{{ route('recipes.index') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Visas receptes
                    </a>
                    @auth
                        <a href="{{ route('recipes.create') }}" 
                           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Izveidot recepti
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Recipes Grid -->
    @if($recipes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recipes as $recipe)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $recipe->title }}</h3>
                            <span class="text-xs px-2 py-1 rounded-full 
                                @if($recipe->difficulty == 'Easy') bg-green-100 text-green-800
                                @elseif($recipe->difficulty == 'Medium') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $recipe->difficulty }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($recipe->description, 100) }}</p>
                        
                        <div class="flex justify-between items-center text-xs text-gray-500 mb-3">
                            <span>Autors: {{ $recipe->user->name }}</span>
                            <span>{{ $recipe->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                            @if($recipe->prep_time || $recipe->cook_time)
                                <span>⏱️ {{ $recipe->totalTime() }} min kopā</span>
                            @endif
                            @if($recipe->servings)
                                <span>🍽️ {{ $recipe->servings }} porcijas</span>
                            @endif
                        </div>
                        
                        <div class="text-right">
                            <a href="{{ route('recipes.show', $recipe) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Skatīt recepti →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-center">
                <div class="text-6xl mb-4">🍽️</div>
                <h3 class="text-lg font-semibold mb-2">Nav recepšu šajā kategorijā</h3>
                <p class="text-gray-600 mb-4">Esi pirmais, kas dalās ar {{ strtolower($category->name) }} recepti!</p>
                @auth
                    <a href="{{ route('recipes.create') }}" 
                       class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Izveidot {{ $category->name }} recepti
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Pieteikties, lai izveidotu recepti
                    </a>
                @endauth
            </div>
        </div>
    @endif
</div>

@auth
<script>
function toggleFavorite(recipeId) {
    fetch(`/favorites/${recipeId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the heart icon
            const button = event.target.closest('button');
            const svg = button.querySelector('svg');
            if (data.favorited) {
                svg.classList.add('text-red-500', 'fill-current');
                svg.classList.remove('text-gray-600');
            } else {
                svg.classList.remove('text-red-500', 'fill-current');
                svg.classList.add('text-gray-600');
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endauth
@endsection

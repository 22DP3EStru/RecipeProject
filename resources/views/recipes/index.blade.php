@extends('layouts.app')

@section('title', 'Visas receptes - RecipeHub')

@section('content')
<div class="content-container">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold mb-2">Visas receptes</h1>
            <p class="text-gray-600">Atklājiet mūsu plašo receptes kolekciju</p>
        </div>
        @auth
            <a href="{{ route('recipes.create') }}" class="btn-primary">
                Pievienot recepti
            </a>
        @endauth
    </div>

    @if($recipes->count() > 0)
        <div class="recipe-grid">
            @foreach ($recipes as $recipe)
                <div class="recipe-card">
                    <div class="relative">
                        @if ($recipe->image)
                            <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                                 class="recipe-image">
                        @else
                            <div class="recipe-image bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        @auth
                            <button onclick="toggleFavorite('{{ $recipe->id }}')" 
                                    class="absolute top-2 right-2 bg-white/80 hover:bg-white rounded-full p-2 transition-colors">
                                <svg class="w-5 h-5 {{ auth()->user()->favoriteRecipes->contains($recipe->id) ? 'text-red-500 fill-current' : 'text-gray-600' }}" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        @endauth

                        <span class="badge-orange absolute top-2 left-2">
                            {{ $recipe->category->name }}
                        </span>
                    </div>
                    
                    <div class="p-4">
                        <a href="{{ route('recipes.show', $recipe) }}" class="block">
                            <h2 class="text-xl font-semibold mb-2 hover:text-orange-600 transition-colors">{{ $recipe->title }}</h2>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($recipe->description, 100) }}</p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $recipe->cooking_time }} min
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    {{ number_format($recipe->avgRating(), 1) }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="mt-2 text-lg font-medium">Nav atrasta neviena recepte</h3>
            <p class="mt-1 text-gray-500">Sāciet pievienojot savu pirmo recepti!</p>
            @auth
                <div class="mt-6">
                    <a href="{{ route('recipes.create') }}" class="btn-primary">
                        Pievienot recepti
                    </a>
                </div>
            @endauth
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

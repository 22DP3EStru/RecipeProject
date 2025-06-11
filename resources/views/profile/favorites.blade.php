@extends('layouts.app')

@section('title', 'Iemīļotās receptes - RecipeHub')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Iemīļotās receptes</h1>
        <p class="text-gray-600">Šeit ir visas jūsu iemīļotās receptes</p>
    </div>

    @if($recipes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($recipes as $recipe)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="relative">
                        @if($recipe->image)
                            <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <button onclick="toggleFavorite('{{ $recipe->id }}')" 
                                class="absolute top-2 right-2 bg-white/80 hover:bg-white rounded-full p-2 transition-colors">
                            <svg class="w-5 h-5 text-red-500 fill-current" 
                                 fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>

                        <span class="absolute top-2 left-2 bg-orange-500 text-white px-2 py-1 rounded text-sm">
                            {{ $recipe->category->name }}
                        </span>
                    </div>
                    
                    <div class="p-4">
                        <a href="{{ route('recipes.show', $recipe) }}">
                            <h3 class="font-bold text-lg mb-2 hover:text-orange-500 transition-colors">
                                {{ $recipe->title }}
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {{ Str::limit($recipe->description, 100) }}
                        </p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $recipe->user->name }}</span>
                            <span>{{ $recipe->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nav iemīļoto recepšu</h3>
            <p class="mt-2 text-gray-500">Sāciet pievienot receptes saviem favorītiem!</p>
            <div class="mt-6">
                <a href="{{ route('recipes.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition duration-200">
                    Pārlūkot receptes
                </a>
            </div>
        </div>
    @endif
</div>

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
            if (!data.favorited) {
                // Recipe was unfavorited, remove from page
                location.reload();
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection

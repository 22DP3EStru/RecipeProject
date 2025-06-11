@extends('layouts.app')

@section('title', 'Meklēšanas rezultāti - RecipeHub')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Meklēšanas rezultāti</h1>
        @if($query)
            <p class="text-gray-600">
                Atrasti {{ $recipes->total() }} rezultāti meklējot 
                <span class="font-semibold text-orange-600">"{{ $query }}"</span>
            </p>
        @endif
    </div>

    <!-- Search Bar -->
    <div class="mb-8">
        <form action="{{ route('recipes.search') }}" method="GET" class="max-w-2xl">
            <div class="relative">
                <input type="text" name="q" placeholder="Meklēt receptes..." 
                       value="{{ $query }}"
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <span class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-r-lg transition duration-200">
                        Meklēt
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Results -->
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

                        <span class="absolute top-2 left-2 bg-orange-500 text-white px-2 py-1 rounded text-sm">
                            {{ $recipe->category->name }}
                        </span>
                    </div>
                    
                    <div class="p-4">
                        <a href="{{ route('recipes.show', $recipe) }}">
                            <h3 class="font-bold text-lg mb-2 hover:text-orange-500 transition-colors">
                                {!! $query ? highlightSearchTerms($recipe->title, $query) : $recipe->title !!}
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {!! $query ? highlightSearchTerms(Str::limit($recipe->description, 100), $query) : Str::limit($recipe->description, 100) !!}
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
            {{ $recipes->appends(['q' => $query])->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nav atrasti rezultāti</h3>
            @if($query)
                <p class="mt-2 text-gray-500">Neizdevās atrast receptes, kas atbilstu meklējumam "{{ $query }}"</p>
                <div class="mt-6">
                    <a href="{{ route('recipes.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition duration-200">
                        Skatīt visas receptes
                    </a>
                </div>
            @else
                <p class="mt-2 text-gray-500">Ievadiet meklēšanas frāzi, lai atrastu receptes</p>
            @endif
        </div>
    @endif

    @if($query && $recipes->count() > 0)
        <!-- Search Suggestions -->
        <div class="mt-12 bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Meklēšanas padomi:</h3>
            <ul class="text-sm text-gray-600 space-y-2">
                <li>• Izmantojiet īsākus meklēšanas vārdus</li>
                <li>• Meklējiet pēc sastāvdaļām (piemēram, "vista", "rīsi", "siers")</li>
                <li>• Mēģiniet meklēt pēc ēdiena veida (piemēram, "zupa", "salāti", "deserts")</li>
                <li>• Pārbaudiet pareizrakstību</li>
            </ul>
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

@php
    function highlightSearchTerms($text, $searchTerm) {
        if (empty($searchTerm)) return $text;
        
        $pattern = '/(' . preg_quote($searchTerm, '/') . ')/i';
        return preg_replace($pattern, '<mark class="bg-yellow-200 px-1 rounded">$1</mark>', $text);
    }
@endphp
@endsection

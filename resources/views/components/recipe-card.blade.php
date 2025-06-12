<div class="recipe-card animate-fade-in">
    <div class="relative">
        <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
             class="recipe-image">
        
        @auth
            <button onclick="toggleFavorite('{{ $recipe->id }}')" 
                    class="absolute top-2 right-2 bg-white/80 hover:bg-white rounded-full p-2 transition-colors">
                <svg class="w-5 h-5 {{ auth()->user()->favorites->contains($recipe->id) ? 'text-red-500 fill-current' : 'text-gray-600' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>
        @endauth        <span class="badge-orange absolute top-2 left-2">
            {{ $recipe->category->name }}
        </span>
    </div>
    
    <div class="p-4">
        <a href="{{ route('recipes.show', $recipe) }}">
            <h3 class="font-bold text-lg mb-2 hover:text-orange-500 transition-colors">
                {{ $recipe->title }}
            </h3>
        </a>
        
        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($recipe->description, 100) }}</p>
        
        <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                    <span>{{ $recipe->cook_time }}m</span>
                </div>
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span>{{ $recipe->servings }}</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="font-medium">{{ number_format($recipe->average_rating, 1) }}</span>
            </div>
        </div>
        
        <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
            {{ $recipe->difficulty }}
        </span>
    </div>
</div>

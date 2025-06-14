<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Browse Recipes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('recipes.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div class="md:col-span-2">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search recipes, ingredients, or descriptions..."
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            
                            <!-- Category Filter -->
                            <div>
                                <select name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Difficulty Filter -->
                            <div>
                                <select name="difficulty" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">All Difficulties</option>
                                    <option value="Easy" {{ request('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                                    <option value="Medium" {{ request('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="Hard" {{ request('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    🔍 Search
                                </button>
                                <a href="{{ route('recipes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                    Clear
                                </a>
                            </div>
                            
                            @auth
                                <a href="{{ route('recipes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    + Create Recipe
                                </a>
                            @endauth
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="mb-4">
                <p class="text-gray-600">
                    Showing {{ $recipes->count() }} of {{ $recipes->total() }} recipes
                    @if(request('search'))
                        for "{{ request('search') }}"
                    @endif
                </p>
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
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $recipe->category }}</span>
                                    <span>By {{ $recipe->user->name }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                    @if($recipe->prep_time || $recipe->cook_time)
                                        <span>⏱️ {{ $recipe->totalTime() }} min total</span>
                                    @endif
                                    @if($recipe->servings)
                                        <span>🍽️ {{ $recipe->servings }} servings</span>
                                    @endif
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400">{{ $recipe->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('recipes.show', $recipe) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View Recipe →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $recipes->withQueryString()->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-lg font-semibold mb-2">No recipes found</h3>
                        <p class="text-gray-600 mb-4">
                            @if(request('search') || request('category') || request('difficulty'))
                                Try adjusting your search criteria or filters.
                            @else
                                Be the first to share a recipe with the community!
                            @endif
                        </p>
                        @auth
                            <a href="{{ route('recipes.create') }}" 
                               class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                                Create First Recipe
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                                Login to Create Recipe
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
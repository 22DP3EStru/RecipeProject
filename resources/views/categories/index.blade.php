<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Recipe Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Browse by Category</h3>
                            <p class="text-gray-600">Discover recipes organized by category</p>
                        </div>
                        <div class="space-x-2">
                            <a href="{{ route('recipes.index') }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                All Recipes
                            </a>
                            @auth
                                <a href="{{ route('recipes.create') }}" 
                                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Create Recipe
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            @if($categories && count($categories) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category['name']) }}" 
                           class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                            <div class="p-6 text-center">
                                <!-- Category Icon -->
                                <div class="text-4xl mb-4">
                                    @switch($category['name'])
                                        @case('Breakfast')
                                            🥞
                                            @break
                                        @case('Lunch')
                                            🥗
                                            @break
                                        @case('Dinner')
                                            🍽️
                                            @break
                                        @case('Desserts')
                                            🍰
                                            @break
                                        @case('Appetizers')
                                            🥨
                                            @break
                                        @case('Main Dishes')
                                            🍖
                                            @break
                                        @case('Side Dishes')
                                            🥔
                                            @break
                                        @case('Beverages')
                                            🥤
                                            @break
                                        @case('Snacks')
                                            🍿
                                            @break
                                        @case('Vegetarian')
                                            🥬
                                            @break
                                        @case('Vegan')
                                            🌱
                                            @break
                                        @case('Gluten-Free')
                                            🌾
                                            @break
                                        @default
                                            🍳
                                    @endswitch
                                </div>
                                
                                <!-- Category Name -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $category['name'] }}</h3>
                                
                                <!-- Recipe Count -->
                                <p class="text-sm text-gray-600">
                                    {{ $category['count'] }} {{ Str::plural('recipe', $category['count']) }}
                                </p>
                                
                                <!-- View Button -->
                                <div class="mt-4">
                                    <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
                                        View Recipes →
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-6xl mb-4">📂</div>
                        <h3 class="text-lg font-semibold mb-2">No categories found</h3>
                        <p class="text-gray-600 mb-4">Be the first to create a recipe and establish categories!</p>
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

            <!-- Popular Categories Info -->
            <div class="bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h4 class="text-md font-semibold mb-3">💡 Popular Recipe Categories</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-700">
                        <div>• Breakfast & Brunch</div>
                        <div>• Main Dishes</div>
                        <div>• Desserts & Sweets</div>
                        <div>• Appetizers & Snacks</div>
                        <div>• Vegetarian & Vegan</div>
                        <div>• Quick & Easy</div>
                        <div>• Healthy Options</div>
                        <div>• International Cuisine</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

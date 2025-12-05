@extends('layouts.app')

@section('title', 'TastyClone - Delicious Recipes for Everyone')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-400 to-red-500 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Discover Amazing Recipes</h1>
        <p class="text-xl mb-8">From quick weeknight dinners to show-stopping desserts</p>
        <a href="{{ route('recipes.index') }}" class="bg-white text-orange-500 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            Browse Recipes
        </a>
    </div>
</section>

<!-- Featured Recipes -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Featured Recipes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredRecipes as $recipe)
                @include('components.recipe-card', ['recipe' => $recipe])
            @endforeach
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('recipes.index', ['category' => $category->slug]) }}" 
                   class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition-shadow">
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" 
                             class="w-16 h-16 mx-auto mb-4 rounded-full object-cover">
                    @endif
                    <h3 class="font-semibold">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->recipes_count }} recipes</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', $recipe->title . ' - TastyClone')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Recipe Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-orange-500">Home</a>
                <span>/</span>
                <a href="{{ route('recipes.index') }}" class="hover:text-orange-500">Recipes</a>
                <span>/</span>
                <span>{{ $recipe->title }}</span>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $recipe->title }}</h1>
            <p class="text-xl text-gray-600 mb-6">{{ $recipe->description }}</p>
            
            <!-- Recipe Meta -->
            <div class="flex flex-wrap items-center gap-6 text-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                    <span><strong>Cook Time:</strong> {{ $recipe->cook_time }} minutes</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span><strong>Servings:</strong> {{ $recipe->servings }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="bg-{{ $recipe->difficulty === 'Easy' ? 'green' : ($recipe->difficulty === 'Medium' ? 'yellow' : 'red') }}-100 text-{{ $recipe->difficulty === 'Easy' ? 'green' : ($recipe->difficulty === 'Medium' ? 'yellow' : 'red') }}-800 px-3 py-1 rounded-full text-xs font-medium">
                        {{ $recipe->difficulty }}
                    </span>
                </div>
                @if($recipe->calories)
                    <div class="flex items-center space-x-2">
                        <span><strong>Calories:</strong> {{ $recipe->calories }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recipe Image/Video -->
        <div class="mb-8">
            @if($recipe->video)
                <video controls class="w-full rounded-lg shadow-lg" poster="{{ Storage::url($recipe->image) }}">
                    <source src="{{ Storage::url($recipe->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                     class="w-full rounded-lg shadow-lg">
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Ingredients -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-2xl font-bold mb-4">Ingredients</h2>
                    <ul class="space-y-3">
                        @foreach($recipe->ingredients as $ingredient)
                            <li class="flex items-center">
                                <input type="checkbox" class="mr-3 rounded text-orange-500">
                                <span>{{ $ingredient->quantity }} {{ $ingredient->unit }} {{ $ingredient->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Instructions -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-6">Instructions</h2>
                    <div class="space-y-6">
                        @foreach($recipe->instructions as $instruction)
                            <div class="flex">
                                <div class="flex-shrink-0 w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold mr-4">
                                    {{ $instruction->step_number }}
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $instruction->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Recipes -->
        @if($relatedRecipes->count() > 0)
            <div class="mt-16">
                <h2 class="text-3xl font-bold mb-8">Related Recipes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedRecipes as $related)
                        @include('components.recipe-card', ['recipe' => $related])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

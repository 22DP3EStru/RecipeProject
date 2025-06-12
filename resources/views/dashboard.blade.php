<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="recipe-card mb-6">
                <div class="p-6">
                    <h2 class="font-semibold text-xl mb-4">{{ __("Sveicināti, ") }} {{ Auth::user()->name }}!</h2>
                    <p>Šeit varēsiet pārvaldīt savas receptes un skatīt jaunāko saturu.</p>
                </div>
            </div>

            <!-- Newest Recipes Section -->
            <div class="recipe-card">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">Jaunākās receptes</h2>
                    
                    <div class="recipe-grid">
                        @foreach($featuredRecipes as $recipe)
                            <div class="recipe-card animate-fade-in">
                                <div class="relative">
                                    @if($recipe->image)
                                        <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                                             class="recipe-image">
                                    @else
                                        <div class="recipe-image bg-gray-100 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <span class="badge-orange absolute top-2 left-2">
                                        {{ $recipe->category->name }}
                                    </span>
                                </div>
                                
                                <div class="p-4">
                                    <a href="{{ route('recipes.show', $recipe) }}" class="block">
                                        <h3 class="font-bold text-lg mb-2 hover:text-orange-600 transition-colors">
                                            {{ $recipe->title }}
                                        </h3>
                                    </a>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($recipe->description, 100) }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $recipe->cooking_time }} min
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            {{ number_format($recipe->avgRating(), 1) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('recipes.create') }}" class="btn-primary">
                            Pievienot jaunu recepti
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

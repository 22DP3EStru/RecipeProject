@extends('layouts.app')

@section('title', 'Manas receptes - RecipeHub')

@section('content')
<div class="content-container">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold mb-2">Manas receptes</h1>
            <p class="text-gray-600">Šeit ir visas jūsu izveidotās receptes</p>
        </div>
        <a href="{{ route('recipes.create') }}" class="btn-primary">
            Pievienot jaunu recepti
        </a>
    </div>

    @if($recipes->count() > 0)
        <div class="recipe-grid">
            @foreach($recipes as $recipe)
                <div class="recipe-card animate-fade-in">
                    <div class="relative">
                        @if($recipe->image)
                            <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                                 class="recipe-image">
                        @else
                            <div class="recipe-image bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <span class="badge-orange absolute top-2 left-2">
                            {{ $recipe->category->name }}
                        </span>
                        
                        <!-- Recipe Actions -->
                        <div class="absolute top-2 right-2 flex space-x-1">
                            <a href="{{ route('recipes.edit', $recipe) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button onclick="deleteRecipe('{{ $recipe->id }}')" 
                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
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

        <div class="mt-8">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="mt-2 text-lg font-medium">Nav atrasta neviena recepte</h3>
            <p class="mt-1 text-gray-500">Sāciet ar savas pirmās receptes pievienošanu!</p>
            <div class="mt-6">
                <a href="{{ route('recipes.create') }}" class="btn-primary">
                    Pievienot jaunu recepti
                </a>
            </div>
        </div>
    @endif
</div>

@if(auth()->check())
<script>
function deleteRecipe(id) {
    if (confirm('Vai tiešām vēlaties dzēst šo recepti?')) {
        fetch(`/recipes/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        }).then(response => {
            if (response.ok) {
                window.location.reload();
            }
        });
    }
}
</script>
@endif
@endsection

@extends('layouts.app')

@section('title', 'Manas receptes - RecipeHub')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Manas receptes</h1>
            <p class="text-gray-600">Šeit ir visas jūsu izveidotās receptes</p>
        </div>
        <a href="{{ route('recipes.create') }}" 
           class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200 shadow-sm">
            Pievienot jaunu recepti
        </a>
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
                        
                        <span class="absolute top-2 left-2 bg-orange-500 text-white px-2 py-1 rounded text-sm">
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
                        <a href="{{ route('recipes.show', $recipe) }}">
                            <h3 class="font-bold text-lg mb-2 hover:text-orange-500 transition-colors">
                                {{ $recipe->title }}
                            </h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            {{ Str::limit($recipe->description, 100) }}
                        </p>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $recipe->comments->count() }} komentāri</span>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Nav izveidoto recepšu</h3>
            <p class="mt-2 text-gray-500">Sāciet dalīties ar savām receptēm!</p>
            <div class="mt-6">
                <a href="{{ route('recipes.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition duration-200">
                    Izveidot pirmo recepti
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Dzēst recepti?</h3>
            <p class="text-gray-500 mb-6">Vai tiešām vēlaties dzēst šo recepti? Šo darbību nevarēs atsaukt.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Atcelt
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        Dzēst
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function deleteRecipe(recipeId) {
    document.getElementById('deleteForm').action = `/recipes/${recipeId}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endsection

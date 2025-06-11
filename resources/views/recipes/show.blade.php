@extends('layouts.app')

@section('title', $recipe->title . ' - RecipeHub')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-orange-600">Sākums</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('recipes.index') }}" class="hover:text-orange-600">Receptes</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900">{{ $recipe->title }}</span>
    </nav>

    <!-- Recipe Header -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        @if ($recipe->image)
            <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                 class="w-full h-80 object-cover">
        @endif

        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="inline-block bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $recipe->category->name }}
                </span>
                @auth
                    <button onclick="toggleFavorite('{{ $recipe->id }}')" 
                            class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 {{ auth()->user()->favoriteRecipes->contains($recipe->id) ? 'text-red-500 fill-current' : 'text-gray-600' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-sm font-medium">Pievienot favorītiem</span>
                    </button>
                @endauth
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $recipe->title }}</h1>
            
            <div class="flex items-center text-gray-600 mb-6">
                <div class="flex items-center mr-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>{{ $recipe->user->name }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $recipe->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <div class="prose max-w-none">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">Apraksts:</h2>
                <p class="text-gray-700 leading-relaxed">{{ $recipe->description }}</p>
            </div>
        </div>
    </div>

    <!-- Rating and Comments Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        @auth
            <!-- Rating Form -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Novērtējiet šo recepti</h3>
                <form action="{{ route('ratings.store') }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    <select name="rating" id="rating" class="rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500" required>
                        <option value="">Izvēlieties vērtējumu</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'zvaigzne' : 'zvaigznes' }}</option>
                        @endfor
                    </select>
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                        Novērtēt
                    </button>
                </form>
            </div>

            <!-- Comment Form -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pievienot komentāru</h3>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <textarea name="body" id="body" rows="4" 
                              class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500" 
                              placeholder="Dalieties ar savām domām par šo recepti..." required></textarea>
                    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                    <button type="submit" class="mt-3 bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                        Pievienot komentāru
                    </button>
                </form>
            </div>
        @else
            <div class="text-center py-8 bg-gray-50 rounded-lg mb-8">
                <p class="text-gray-600 mb-4">Piesakieties, lai novērtētu un komentētu šo recepti</p>
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                        Pieslēgties
                    </a>
                    <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                        Reģistrēties
                    </a>
                </div>
            </div>
        @endauth

        <!-- Comments Display -->
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-6">
                Komentāri ({{ $recipe->comments->count() }})
            </h3>
            
            @if($recipe->comments->count() > 0)
                <div class="space-y-6">
                    @foreach ($recipe->comments as $comment)
                        <div class="border-b border-gray-200 pb-6 last:border-b-0">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <span class="text-orange-600 font-medium text-sm">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700">{{ $comment->body }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="mt-4 text-gray-500">Vēl nav komentāru. Esiet pirmais, kas komentē!</p>
                </div>
            @endif
        </div>
    </div>
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
            const button = event.target.closest('button');
            const svg = button.querySelector('svg');
            const text = button.querySelector('span');
            if (data.favorited) {
                svg.classList.add('text-red-500', 'fill-current');
                svg.classList.remove('text-gray-600');
                text.textContent = 'Noņemt no favorītiem';
            } else {
                svg.classList.remove('text-red-500', 'fill-current');
                svg.classList.add('text-gray-600');
                text.textContent = 'Pievienot favorītiem';
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endauth
@endsection

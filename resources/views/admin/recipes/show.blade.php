@extends('layouts.app')

@section('title', $recipe->title . ' - RecipeHub')

@section('content')
<div class="content-container max-w-4xl">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm mb-6">
        <a href="{{ route('home') }}" class="nav-link">Sākums</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('recipes.index') }}" class="nav-link">Receptes</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="font-medium">{{ $recipe->title }}</span>
    </nav>

    <!-- Recipe Header -->
    <div class="recipe-card mb-8">
        @if ($recipe->image)
            <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->title }}" 
                 class="w-full h-80 object-cover">
        @endif

        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="badge-orange">
                    {{ $recipe->category->name }}
                </span>
                @auth
                    <button onclick="toggleFavorite('{{ $recipe->id }}')" 
                            class="btn-secondary flex items-center space-x-2">
                        <svg class="w-5 h-5 {{ auth()->user()->favoriteRecipes->contains($recipe->id) ? 'text-red-500 fill-current' : 'text-gray-600' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-sm font-medium">Pievienot favorītiem</span>
                    </button>
                @endauth
            </div>

            <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>
            
            <div class="flex items-center text-gray-600 mb-6">
                <div class="flex items-center mr-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $recipe->user->name }}
                </div>
                <div class="flex items-center mr-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $recipe->cooking_time }} min
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                    {{ number_format($recipe->avgRating(), 1) }}
                </div>
            </div>

            <p class="text-gray-700 mb-8">{{ $recipe->description }}</p>

            <!-- Recipe Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Ingredients -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Sastāvdaļas</h2>
                    <ul class="space-y-2">
                        @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                            @if(!empty(trim($ingredient)))
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 text-orange-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    {{ $ingredient }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <!-- Instructions -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Pagatavošanas soļi</h2>
                    <ol class="space-y-4">
                        @foreach(explode("\n", $recipe->instructions) as $index => $instruction)
                            @if(!empty(trim($instruction)))
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 bg-orange-100 text-orange-800 rounded-full flex items-center justify-center mr-3 font-medium text-sm">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="text-gray-700">{{ $instruction }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-6">Komentāri</h2>

        @auth
            <form action="{{ route('comments.store', $recipe) }}" method="POST" class="mb-8">
                @csrf
                <div class="mb-4">
                    <label for="content" class="form-label">Tavs komentārs</label>
                    <textarea name="content" id="content" rows="3" class="form-input" placeholder="Dalies ar savām pārdomām..."></textarea>
                    @error('content')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn-primary">Pievienot komentāru</button>
            </form>
        @else
            <div class="bg-gray-50 rounded-lg p-4 mb-8">
                <p class="text-center text-gray-600">
                    Lai pievienotu komentāru,
                    <a href="{{ route('login') }}" class="text-orange-600 hover:underline">piesakies</a>
                    vai
                    <a href="{{ route('register') }}" class="text-orange-600 hover:underline">reģistrējies</a>
                </p>
            </div>
        @endauth

        <div class="space-y-6">
            @forelse ($recipe->comments as $comment)
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
                            <span class="text-orange-800 font-medium">{{ substr($comment->user->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-medium">{{ $comment->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Pagaidām nav neviena komentāra. Esi pirmais, kas komentē!</p>
            @endforelse
        </div>
    </div>
</div>

@if(auth()->check())
<script>
function toggleFavorite(recipeId) {
    fetch(`/recipes/${recipeId}/favorite`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    });
}
</script>
@endif
@endsection

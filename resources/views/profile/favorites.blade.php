<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Favorite Recipes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Your Favorite Recipes</h3>
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">
                            ← Back to Dashboard
                        </a>
                    </div>

                    @if($favorites && $favorites->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($favorites as $favorite)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-semibold text-lg mb-2">{{ $favorite->recipe->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ Str::limit($favorite->recipe->description, 100) }}
                                    </p>
                                    <p class="text-xs text-gray-500 mb-3">
                                        By: {{ $favorite->recipe->user->name }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <a href="/recipes/{{ $favorite->recipe->id }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                            View Recipe →
                                        </a>
                                        <span class="text-xs text-gray-400">
                                            Added {{ $favorite->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $favorites->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-6xl mb-4">💔</div>
                            <h4 class="text-lg font-semibold mb-2">No favorite recipes yet</h4>
                            <p class="text-gray-600 mb-4">Start exploring recipes and add them to your favorites!</p>
                            <a href="/recipes" 
                               class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                                Browse Recipes
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

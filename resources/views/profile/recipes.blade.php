<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manas receptes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Jūsu receptes ({{ $recipes->total() }})</h3>
                        <div class="space-x-2">
                            <a href="{{ route('recipes.create') }}" 
                               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Izveidot jaunu recepti
                            </a>
                            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">
                                ← Atpakaļ uz paneli
                            </a>
                        </div>
                    </div>

                    @if($recipes->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($recipes as $recipe)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <h4 class="font-semibold text-lg mb-2">{{ $recipe->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ Str::limit($recipe->description, 100) }}
                                    </p>
                                    <p class="text-xs text-gray-500 mb-3">
                                        <strong>Kategorija:</strong> {{ $recipe->category ?? 'Bez kategorijas' }}
                                    </p>
                                    <p class="text-xs text-gray-500 mb-3">
                                        Izveidots {{ $recipe->created_at->diffForHumans() }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <a href="/recipes/{{ $recipe->id }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                            Skatīt recepti →
                                        </a>
                                        <div class="space-x-2">
                                            <a href="{{ route('recipes.edit', $recipe) }}" 
                                               class="text-green-600 hover:text-green-800 text-sm">
                                                Rediģēt
                                            </a>
                                            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" 
                                                  class="inline" 
                                                  onsubmit="return confirm('Dzēst šo recepti?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 text-sm">
                                                    Dzēst
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $recipes->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-6xl mb-4">📝</div>
                            <h4 class="text-lg font-semibold mb-2">Nav izveidotas receptes</h4>
                            <p class="text-gray-600 mb-4">Dalieties ar savām iecienītākajām receptēm ar kopienu!</p>
                            <a href="{{ route('recipes.create') }}" 
                               class="inline-block bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                                Izveidot savu pirmo recepti
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

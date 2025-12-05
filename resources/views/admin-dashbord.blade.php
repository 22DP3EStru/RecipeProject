@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold mb-6">Administrācijas panelis</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="bg-blue-100 border border-blue-300 shadow rounded-lg p-6">
            <h3 class="text-md font-medium text-blue-900">Receptes kopā</h3>
            <p class="text-3xl font-bold text-blue-800">{{ $recipeCount }}</p>
        </div>
        <div class="bg-green-100 border border-green-300 shadow rounded-lg p-6">
            <h3 class="text-md font-medium text-green-900">Lietotāju skaits</h3>
            <p class="text-3xl font-bold text-green-800">{{ $userCount }}</p>
        </div>
        <div class="bg-yellow-100 border border-yellow-300 shadow rounded-lg p-6">
            <h3 class="text-md font-medium text-yellow-900">Komentāri</h3>
            <p class="text-3xl font-bold text-yellow-800">{{ $commentCount }}</p>
        </div>
        <div class="bg-purple-100 border border-purple-300 shadow rounded-lg p-6">
            <h3 class="text-md font-medium text-purple-900">Kategorijas</h3>
            <p class="text-3xl font-bold text-purple-800">{{ $categoryCount }}</p>
        </div>
    </div>

    <div class="mt-10">
        <h3 class="text-2xl font-semibold mb-4">Pēdējās pievienotās receptes</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm uppercase tracking-wider">
                        <th class="px-4 py-3">Nosaukums</th>
                        <th class="px-4 py-3">Kategorija</th>
                        <th class="px-4 py-3">Autors</th>
                        <th class="px-4 py-3">Datums</th>
                        <th class="px-4 py-3">Darbības</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestRecipes as $recipe)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $recipe->title }}</td>
                            <td class="px-4 py-3">{{ $recipe->category->name ?? 'Bez kategorijas' }}</td>
                            <td class="px-4 py-3">{{ $recipe->user->name ?? 'Nezināms' }}</td>
                            <td class="px-4 py-3">{{ $recipe->created_at->format('d.m.Y') }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="text-blue-600 hover:underline">Rediģēt</a>
                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Dzēst</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

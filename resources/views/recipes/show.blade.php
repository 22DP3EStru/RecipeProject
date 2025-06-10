@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow-md">
        @if ($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-64 object-cover rounded-xl mb-4">
        @endif

        <h1 class="text-3xl font-bold mb-2">{{ $recipe->title }}</h1>
        <p class="text-sm text-gray-600 mb-4">autors: {{ $recipe->user->name }}</p>

        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Apraksts:</h2>
            <p>{{ $recipe->description }}</p>
        </div>

        @auth
            <form action="{{ route('ratings.store') }}" method="POST" class="mb-6">
                @csrf
                <label for="rating" class="block mb-1 font-medium">Vērtē recepte:</label>
                <select name="rating" id="rating" class="rounded-lg border-gray-300" required>
                    <option value="">Izvēlies</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} zvaigznes</option>
                    @endfor
                </select>
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <button class="ml-2 bg-red-500 text-white px-4 py-1 rounded-xl hover:bg-red-600">Sniegt vērtējumu</button>
            </form>

            <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                @csrf
                <label for="body" class="block mb-1 font-medium">Komentārs:</label>
                <textarea name="body" id="body" rows="3" class="w-full rounded-lg border-gray-300" required></textarea>
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <button class="mt-2 bg-gray-800 text-white px-4 py-2 rounded-xl hover:bg-gray-900">Pievienot komentāru</button>
            </form>
        @endauth

        <div>
            <h2 class="text-lg font-semibold mb-2">Komentāri:</h2>
            @foreach ($recipe->comments as $comment)
                <div class="mb-3 border-b pb-2">
                    <p class="text-sm text-gray-700">{{ $comment->body }}</p>
                    <p class="text-xs text-gray-500">— {{ $comment->user->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

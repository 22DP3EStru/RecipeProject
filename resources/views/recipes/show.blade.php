@extends('layouts.app')

@section('content')
<article class="max-w-3xl mx-auto bg-white rounded-xl shadow">
    @if ($recipe->image_path)
        <img src="{{ Storage::url($recipe->image_path) }}" alt="{{ $recipe->title }}" class="w-full h-64 object-cover rounded-t-xl">
    @endif
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>
        <p class="mb-6 text-gray-700">{{ $recipe->description }}</p>

        <h2 class="text-xl font-semibold mb-2">Ingredients</h2>
        <ul class="list-disc list-inside mb-6">
            @foreach ($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->quantity }} {{ $ingredient->name }}</li>
            @endforeach
        </ul>

        <h2 class="text-xl font-semibold mb-2">Steps</h2>
        <ol class="list-decimal list-inside space-y-2">
            @foreach ($recipe->steps as $step)
                <li>{{ $step->body }}</li>
            @endforeach
        </ol>
    </div>
</article>
@endsection

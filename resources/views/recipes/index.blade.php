@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Latest Recipes</h1>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach ($recipes as $recipe)
    <a href="{{ route('recipes.show', $recipe) }}" class="block bg-white rounded-xl shadow hover:shadow-md transition">
        @if ($recipe->image_path)
            <img src="{{ Storage::url($recipe->image_path) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover rounded-t-xl">
        @endif
        <div class="p-4">
            <h2 class="text-lg font-semibold">{{ $recipe->title }}</h2>
            <p class="text-sm text-gray-600">{{ Str::limit($recipe->description, 80) }}</p>
            <div class="mt-2 text-yellow-500">
                ★ {{ $recipe->averageRating() }}/5
            </div>
        </div>
    </a>
@endforeach
</div>

<div class="mt-8">
    {{ $recipes->links() }}
</div>
@endsection

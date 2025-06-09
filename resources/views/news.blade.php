@extends('layouts.app')

@section('content')
<h1 class="mb-4">Aktualitātes / Jaunumi</h1>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
    @foreach($latest as $recipe)
        <div class="col">
            <a href="{{ route('recipes.show', $recipe) }}" class="card h-100 text-decoration-none text-dark">
                <img src="{{ $recipe->image ?? 'https://placehold.co/600x400?text=Nav+bildes' }}"
                     class="card-img-top" alt="{{ $recipe->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $recipe->title }}</h5>
                    <p class="card-text text-truncate">{{ Str::limit($recipe->description, 80) }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection

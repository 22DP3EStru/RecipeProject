@extends('layouts.app')

@section('content')
<h1>Manas favorītās receptes</h1>

@foreach($recipes as $recipe)
    <div class="recipe-card">
        <h2>{{ $recipe->title }}</h2>
        <p>{{ $recipe->description }}</p>
        <p>Kategorijas: {{ $recipe->categories->pluck('name')->join(', ') }}</p>
        <p>Reitings: {{ $recipe->ratings->avg('rating') ?? 'Nav vērtējumu' }}</p>
    </div>
@endforeach

{{ $recipes->links() }}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ __('Latest Recipes') }}</h1>

    @if($recipes->isEmpty())
        <p>{{ __('No recipes found.') }}</p>
    @else
        <div class="row">
            @foreach($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                            <a href="{{ route('recipe.show', $recipe->id) }}" class="btn btn-primary">{{ __('View Recipe') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

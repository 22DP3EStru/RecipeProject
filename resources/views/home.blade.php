@extends('layouts.app')

@section('content')
<div class="bg-light py-5 text-center">
    <div class="container">
        <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow p-4">
                <i class="bi bi-egg-fried fs-1 text-warning"></i>
            </div>
        </div>
        <h1 class="display-4 fw-bold text-dark">Discover Amazing <span class="text-warning d-block">Recipes</span></h1>
        <p class="lead text-muted mt-3 mb-4">Join our community of food lovers and explore thousands of delicious recipes from around the world. Cook, share, and discover your next favorite dish.</p>
        <div class="d-flex justify-content-center gap-2 flex-column flex-sm-row">
            <a href="{{ route('recipes.index') }}" class="btn btn-warning btn-lg">Explore Recipes <i class="bi bi-arrow-right ms-2"></i></a>
            <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">Join Community</a>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Why Choose Our Platform?</h2>
        <p class="text-muted">We're more than just a recipe site - we're a community of passionate cooks and food lovers.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-book fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Thousands of Recipes</h5>
                    <p class="text-muted">Discover amazing recipes from around the world, from quick meals to gourmet dishes.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-people fs-1 text-primary"></i>
                    <h5 class="card-title mt-3">Community Driven</h5>
                    <p class="text-muted">Share your own recipes and connect with fellow cooking enthusiasts.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-heart fs-1 text-danger"></i>
                    <h5 class="card-title mt-3">Save Favorites</h5>
                    <p class="text-muted">Keep track of your favorite recipes and create your personal cookbook.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-warning text-white py-5">
    <div class="container text-center">
        <div class="row g-4">
            <div class="col-md-3">
                <h3 class="fw-bold">10,000+</h3>
                <p>Recipes</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">50,000+</h3>
                <p>Active Users</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">500,000+</h3>
                <p>Recipe Views</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">25,000+</h3>
                <p>Favorites Saved</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">What Our Users Say</h2>
        <div class="row g-4">
            @foreach ([
                ['name' => 'Sarah Johnson', 'comment' => 'Amazing platform! I\'ve discovered so many delicious recipes here.'],
                ['name' => 'Mike Chen', 'comment' => 'The community is fantastic and the recipes are always detailed and easy to follow.'],
                ['name' => 'Emily Davis', 'comment' => 'I love how I can save my favorite recipes and share my own creations.']
            ] as $testimonial)
            <div class="col-md-4">
                <div class="card p-4 shadow-sm h-100">
                    <div class="mb-3 text-warning">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <p class="text-muted fst-italic">"{{ $testimonial['comment'] }}"</p>
                    <h6 class="mt-3 fw-bold">{{ $testimonial['name'] }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-dark text-white py-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Ready to Start Cooking?</h2>
        <p class="lead text-light mb-4">Join our community today and discover your next favorite recipe. It's free and takes less than a minute!</p>
        <div class="d-flex justify-content-center gap-2 flex-column flex-sm-row">
            <a href="{{ route('register') }}" class="btn btn-warning btn-lg">Get Started Free</a>
            <a href="{{ route('recipes.index') }}" class="btn btn-outline-light btn-lg">Browse Recipes</a>
        </div>
    </div>
</div>
@endsection

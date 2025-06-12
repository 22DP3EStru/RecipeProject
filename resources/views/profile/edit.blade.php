@extends('layouts.app')

@section('title', 'Rediģēt profilu - RecipeHub')

@section('content')
<div class="content-container">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Profila iestatījumi</h1>
        <p class="text-gray-600">Pārvaldiet sava konta informāciju un iestatījumus</p>
    </div>

    <div class="space-y-6">
        <div class="recipe-card p-6 animate-fade-in">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="recipe-card p-6 animate-fade-in">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="recipe-card p-6 animate-fade-in">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
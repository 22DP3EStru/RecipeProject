@extends('layouts.app')

@section('title', 'Rediģēt profilu - RecipeHub')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Profila iestatījumi</h1>
        <p class="text-gray-600">Pārvaldiet sava konta informāciju un iestatījumus</p>
    </div>

    <div class="space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
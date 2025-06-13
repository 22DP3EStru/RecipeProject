@extends('layouts.app')
@section('title', 'Dashboard - RecipeHub')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Welcome {{ Auth::user()->name }}!</h3>
                    
                    <p>Your email: {{ Auth::user()->email }}</p>
                    
                    <p>Admin status: {{ Auth::user()->is_admin ? 'YES - YOU ARE ADMIN' : 'NO - NOT ADMIN' }}</p>
                    
                    @if(Auth::user()->is_admin)
                        <div style="background: red; color: white; padding: 20px; margin: 20px 0; font-size: 18px; font-weight: bold;">
                            🔥 ADMIN ACCESS DETECTED 🔥
                            <br><br>
                            <a href="/admin" style="color: yellow; text-decoration: underline; font-size: 20px;">
                                CLICK HERE FOR ADMIN PANEL
                            </a>
                        </div>
                    @else
                        <div style="background: blue; color: white; padding: 20px; margin: 20px 0;">
                            You are not an admin user.
                        </div>
                    @endif
                    
                    @if(isset($featuredRecipes) && $featuredRecipes->count() > 0)
                        <h4>Featured Recipes:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($featuredRecipes as $recipe)
                                <div class="border rounded-lg p-4">
                                    <h4 class="font-semibold">{{ $recipe->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ Str::limit($recipe->description, 100) }}</p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        By: {{ optional($recipe->user)->name ?? 'Unknown' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

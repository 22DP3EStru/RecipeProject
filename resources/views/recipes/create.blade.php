@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">New Recipe</h1>

<form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white rounded-xl p-6 shadow">
    @csrf
    <div>
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" required class="w-full border-gray-300 rounded-lg shadow-sm">
    </div>
    <div>
        <label class="block font-medium mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description') }}</textarea>
    </div>
    <div>
        <label class="block font-medium mb-1">Image</label>
        <input type="file" name="image" class="w-full">
    </div>
    <div class="grid sm:grid-cols-3 gap-4">
        <div>
            <label class="block font-medium mb-1">Prep Time (min)</label>
            <input type="number" name="prep_time" class="w-full border-gray-300 rounded-lg shadow-sm" value="{{ old('prep_time') }}">
        </div>
        <div>
            <label class="block font-medium mb-1">Cook Time (min)</label>
            <input type="number" name="cook_time" class="w-full border-gray-300 rounded-lg shadow-sm" value="{{ old('cook_time') }}">
        </div>
        <div>
            <label class="block font-medium mb-1">Servings</label>
            <input type="number" name="servings" class="w-full border-gray-300 rounded-lg shadow-sm" value="{{ old('servings') }}">
        </div>
    </div>

    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">Save</button>
</form>
@endsection

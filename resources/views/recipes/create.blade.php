@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-md">
        <h1 class="text-2xl font-bold mb-4">Pievieno jaunu recepti</h1>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block font-medium mb-1">Nosaukums</label>
                <input type="text" name="title" id="title" class="w-full rounded-lg border-gray-300" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium mb-1">Apraksts</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-300"></textarea>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block font-medium mb-1">Kategorija</label>
                <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300" required>
                    <option value="">Izvēlies kategoriju</option>
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium mb-1">Attēls</label>
                <input type="file" name="image" id="image" class="w-full">
            </div>

            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-xl hover:bg-red-600">Saglabāt</button>
        </form>
    </div>
@endsection

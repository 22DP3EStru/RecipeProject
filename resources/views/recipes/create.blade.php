@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">Pievienot jaunu recepti</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-md space-y-6">
        @csrf

        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Nosaukums</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Apraksts</label>
            <textarea id="description" name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Create Recipe</button>
        </div>
    </form>
@endsection

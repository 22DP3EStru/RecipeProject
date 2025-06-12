@extends('layouts.app')

@section('content')
<div class="content-container">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Pievieno jaunu recepti</h1>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="form-label">Nosaukums</label>
                <input type="text" name="title" id="title" class="form-input" required>
                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="form-label">Apraksts</label>
                <textarea name="description" id="description" rows="4" class="form-input"></textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="ingredients" class="form-label">Sastāvdaļas</label>
                <textarea name="ingredients" id="ingredients" rows="6" class="form-input" placeholder="1 kg kartupeļu&#10;2 olas&#10;2 sīpoli&#10;3 ēd.k. kviešu milti&#10;"></textarea>
                <p class="text-sm text-gray-500 mt-1">Rakstiet katru sastāvdaļu jaunā rindā.</p>
                @error('ingredients')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="instructions" class="form-label">Pagatavošanas soļi</label>
                <textarea name="instructions" id="instructions" rows="8" class="form-input" placeholder="1. Nomizo un sarīvē kartupeļus.&#10;2. Sajauc visas sastāvdaļas.&#10;3. Cep pannā ar eļļu līdz zeltainai krāsai."></textarea>
                <p class="text-sm text-gray-500 mt-1">Aprakstiet pagatavošanas soļus, katru rakstot jaunā rindā.</p>
                @error('instructions')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="form-label">Kategorija</label>
                <select name="category_id" id="category_id" class="form-input" required>
                    <option value="">Izvēlies kategoriju</option>
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="form-label">Attēls</label>
                <input type="file" name="image" id="image" class="form-input">
                @error('image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Saglabāt recepti</button>
            </div>
        </form>
    </div>
</div>
@endsection

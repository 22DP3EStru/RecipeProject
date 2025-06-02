<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mans profils
            </h2>
            <a href="{{ url('/') }}" class="px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600 transition">Uz sākumlapu</a>
        </div>
    </x-slot>

    <div class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Sveicināts, {{ Auth::user()->name }}!</h3>
                    <p class="mb-6">Šeit vari pārvaldīt savas receptes, saglabāt iecienītākās un sekot līdzi jaunumiem.</p>
                    
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        <div class="flex-1 bg-pink-100 p-4 rounded">
                            <h4 class="font-semibold mb-2">Manas receptes</h4>
                            <a href="#my-recipes" class="inline-block mb-3 px-4 py-2 bg-pink-500 text-white rounded hover:bg-pink-600 transition">Apskatīt savas receptes</a>
                            <ul class="list-disc list-inside text-sm" id="my-recipes">
                                <li>Nav pievienotu recepšu.</li>
                                <!-- Šeit var dinamiski izvadīt lietotāja receptes -->
                            </ul>
                        </div>
                        <div class="flex-1 bg-yellow-100 p-4 rounded">
                            <h4 class="font-semibold mb-2">Pievienot jaunu recepti</h4>
                            <button id="show-add-form" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition mb-3">Pievienot recepti</button>
                            <form id="add-recipe-form" class="hidden flex flex-col gap-3" enctype="multipart/form-data">
                                <input type="text" name="title" placeholder="Receptes nosaukums" class="border rounded px-3 py-2" required>
                                <textarea name="description" placeholder="Apraksts un sastāvdaļas" class="border rounded px-3 py-2" required></textarea>
                                <input type="file" name="image" accept="image/*" class="border rounded px-3 py-2">
                                <button type="submit" class="px-4 py-2 bg-pink-500 text-black rounded hover:bg-pink-600 transition">Saglabāt recepti</button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-semibold mb-2">Aktualitātes</h4>
                        <ul class="list-disc list-inside text-sm">
                            <li>🍰 Jauna funkcija: tagad vari vērtēt receptes!</li>
                            <li>🥗 Pievienota sadaļa “Veselīgie salāti”.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Parāda/paslēpj receptes pievienošanas formu
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('show-add-form');
            const form = document.getElementById('add-recipe-form');
            btn.addEventListener('click', function() {
                form.classList.toggle('hidden');
            });
        });
    </script>
</x-app-layout>
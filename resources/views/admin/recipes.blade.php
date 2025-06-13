<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            Manage Recipes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Back to Dashboard -->
            <div class="mb-6">
                <a href="{{ route('/admin') }}" class="text-blue-600 hover:text-blue-800">
                    ← Back to Admin Dashboard
                </a>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-black">All Recipes ({{ $recipes->total() }})</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Recipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recipes as $recipe)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-lg bg-orange-100 flex items-center justify-center text-orange-800 mr-3">
                                                🍽️
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-black">{{ $recipe->title }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($recipe->description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {{ optional($recipe->user)->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {{ $recipe->category ?? 'No category' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {{ $recipe->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form method="POST" action="{{ route('admin.delete-recipe', $recipe) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this recipe?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $recipes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
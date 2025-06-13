<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 mr-4">
                                <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Users</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $usersCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.users') }}" class="text-orange-600 hover:text-orange-700 text-sm font-medium">View all users →</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 mr-4">
                                <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Recipes</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $recipesCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.recipes') }}" class="text-orange-600 hover:text-orange-700 text-sm font-medium">View all recipes →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

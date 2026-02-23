@extends("layouts.app")

@section("content")
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold text-gray-900 mb-8">
        Admin Dashboard
    </h1>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">Lietotāji</p>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">Receptes</p>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $totalRecipes }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">Admini</p>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $totalAdmins }}</p>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white rounded-xl shadow mb-8">
        <div class="px-6 py-4 border-b font-semibold text-gray-800">
            Jaunākie lietotāji
        </div>
        <div class="p-6">
            @forelse($recentUsers as $user)
                <div class="flex justify-between py-3 border-b last:border-0">
                    <div>
                        <div class="font-medium">{{ $user->name ?? "—" }}</div>
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </div>
                    <div class="text-sm text-gray-400">
                        {{ $user->created_at->format("d.m.Y H:i") }}
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Nav lietotāju.</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Recipes -->
    <div class="bg-white rounded-xl shadow">
        <div class="px-6 py-4 border-b font-semibold text-gray-800">
            Jaunākās receptes
        </div>
        <div class="p-6">
            @forelse($recentRecipes as $recipe)
                <div class="flex justify-between py-3 border-b last:border-0">
                    <div>
                        <div class="font-medium">{{ $recipe->title ?? $recipe->name ?? "—" }}</div>
                        <div class="text-sm text-gray-500">
                            Autors: {{ $recipe->user->name ?? "—" }}
                        </div>
                    </div>
                    <div class="text-sm text-gray-400">
                        {{ $recipe->created_at->format("d.m.Y H:i") }}
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Nav recepšu.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection

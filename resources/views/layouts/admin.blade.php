<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Admin - Vecmāmiņas Receptes")</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route("admin.index") }}" class="font-semibold">Admin panelis</a>
            <a href="{{ route("dashboard") }}" class="text-sm text-gray-600 hover:text-gray-900">Uz sākumlapu</a>
        </div>

        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">{{ auth()->user()?->email }}</span>
            <form method="POST" action="{{ route("logout") }}">
                @csrf
                <button class="px-3 py-2 text-sm bg-gray-900 text-white rounded hover:opacity-90">Iziet</button>
            </form>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">
    @yield("content")
</main>

</body>
</html>

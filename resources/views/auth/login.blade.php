@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md shadow-xl bg-white rounded-xl">
        <div class="text-center space-y-4 p-6 border-b">
            <div class="flex justify-center">
                <div class="p-3 bg-orange-100 rounded-full">
                    <x-lucide-chef-hat class="h-8 w-8 text-orange-600" />
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
            <p class="text-gray-600">Sign in to your account to continue</p>
        </div>

        <div class="p-6">
            @if (session('error'))
                <div class="mb-4 text-red-600">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <label for="email">Email Address</label>
                    <div class="relative">
                        <x-lucide-mail class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
                        <input id="email" name="email" type="email" class="form-input pl-10 w-full" required autofocus>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password">Password</label>
                    <div class="relative">
                        <x-lucide-lock class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
                        <input id="password" name="password" type="password" class="form-input pl-10 pr-10 w-full" required>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-orange-600">
                        <label for="remember" class="text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-orange-600 hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="btn w-full bg-orange-600 text-white hover:bg-orange-700">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-orange-600 hover:underline font-medium">Create one now</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

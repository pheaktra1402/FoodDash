<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            <!-- 🌐 Custom Navigation Bar -->
            <nav class="flex items-center justify-between p-4 px-6 bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
                <div class="flex items-center gap-8">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="bg-emerald-600 text-white p-1.5 rounded-lg group-hover:bg-emerald-700 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <span class="text-xl font-black tracking-tight text-slate-900">FoodDash</span>
                    </a>

                    <!-- Links សម្រាប់ Visitor និង User ទាំងអស់មើលឃើញ -->
                    <div class="hidden md:flex gap-6 font-semibold text-slate-500 text-sm">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-emerald-600' : 'hover:text-slate-900' }} transition">Home</a>
                        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'text-emerald-600' : 'hover:text-slate-900' }} transition">Products</a>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-emerald-600' : 'hover:text-slate-900' }} transition">About Us</a>
                    </div>
                </div>

                <!-- ផ្នែកស្តាំដៃ (Login / Profile) -->
                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="font-semibold text-sm text-slate-700 hover:text-emerald-600 transition">Log in</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition shadow-sm">Sign up</a>
                    @endguest

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="/admin/dashboard" class="text-xs bg-rose-100 text-rose-700 px-3 py-1.5 rounded-full font-bold hover:bg-rose-200 transition">Admin Panel</a>
                        @endif

                        <div class="flex items-center gap-3 border-l border-slate-200 pl-4 ml-2">
                            <span class="text-sm font-semibold text-slate-800">Hi, {{ auth()->user()->name }}</span>
                            
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-rose-500 transition">Logout</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter (UI mockup) -->
            <div class="bg-white p-4 rounded-2xl shadow-sm mb-8 flex flex-col sm:flex-row items-center justify-between gap-4 border border-slate-100">
                <div class="w-full sm:w-96 relative">
                    <input type="text" placeholder="Search for food..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-full focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition outline-none">
                    <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="flex gap-2 w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
                    <button class="px-4 py-1.5 bg-slate-900 text-white rounded-full text-sm font-medium whitespace-nowrap">All</button>
                    <button class="px-4 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-full text-sm font-medium transition whitespace-nowrap">Burgers</button>
                    <button class="px-4 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-full text-sm font-medium transition whitespace-nowrap">Pizza</button>
                    <button class="px-4 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-full text-sm font-medium transition whitespace-nowrap">Pasta</button>
                    <button class="px-4 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-full text-sm font-medium transition whitespace-nowrap">Drinks</button>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1599&q=80" alt="Burger" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Classic Cheeseburger</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$8.99</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Pizza" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Margherita Pizza</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$12.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-1.2.1&auto=format&fit=crop&w=774&q=80" alt="Pasta" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Spicy Garlic Pasta</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$10.99</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>
                <div class="flex flex-col border border-slate-100 rounded-3xl p-5 shadow-sm bg-white hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full rounded-2xl overflow-hidden mb-4 relative group">
                        <img src="https://images.unsplash.com/photo-1579954115545-a95591f28bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" alt="Drink" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">Fresh Berry Smoothie</h3>
                    <p class="text-emerald-600 font-extrabold text-lg mt-1 mb-4">$5.50</p>
                    <div class="mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition">Log in to Order</a>
                        @endguest
                        @auth
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-semibold hover:bg-emerald-700 transition">Add to Cart</button>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

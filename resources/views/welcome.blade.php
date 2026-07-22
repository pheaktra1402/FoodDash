<x-app-layout>
    <!-- 🚀 Hero Section -->
    <div class="relative bg-slate-950 overflow-hidden">
        <!-- Background Decorative Glows -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full overflow-hidden pointer-events-none opacity-30">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -right-20 w-80 h-80 bg-teal-500 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-12 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-6">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-24">
                    <div class="sm:text-center lg:text-left">
                        <!-- Top Tag Badges -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold uppercase tracking-wider mb-6">
                            <span>🚀 Super Fast Delivery</span>
                        </div>

                        <h1 class="text-4xl tracking-tight font-black text-white sm:text-5xl md:text-6xl leading-tight">
                            <span class="block">Delicious food delivered</span>
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">
                                straight to your door
                            </span>
                        </h1>
                        
                        <p class="mt-4 text-base text-slate-300 sm:mt-6 sm:text-lg sm:max-w-xl sm:mx-auto md:text-xl lg:mx-0 leading-relaxed">
                            Experience the best meals from top local restaurants. Fast delivery, hot food, and the most delicious flavors guaranteed.
                        </p>
                        
                        <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start gap-4">
                            <div>
                                <a href="{{ route('products.index') }}" 
                                   class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-emerald-500 hover:bg-emerald-600 shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 md:text-lg">
                                    View Menu
                                </a>
                            </div>
                            @guest
                            <div class="mt-3 sm:mt-0">
                                <a href="{{ route('register') }}" 
                                   class="w-full flex items-center justify-center px-8 py-4 border border-slate-700 text-base font-bold rounded-2xl text-white bg-slate-900/80 hover:bg-slate-800 hover:border-slate-600 backdrop-blur-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 md:text-lg">
                                    Sign Up Now
                                </a>
                            </div>
                            @endguest
                        </div>
                    </div>
                </main>
            </div>
        </div>
        
        <!-- Hero Image with Gradient Mask -->
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-64 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full opacity-85" 
                 src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=2070&q=80" 
                 alt="Delicious Food">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent lg:bg-gradient-to-r lg:from-slate-950 lg:via-transparent lg:to-transparent"></div>
        </div>
    </div>

    <!-- 🍕 Featured Section -->
    <div class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest bg-emerald-100 px-3 py-1 rounded-full">
                    Featured Specials
                </span>
                <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl md:text-5xl">
                    Our Popular Dishes
                </h2>
                <p class="mt-3 text-lg text-slate-600">
                    Check out what everyone is loving right now. Fresh ingredients, cooked to perfection.
                </p>
            </div>

            <div class="mt-14">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- 🍔 Product 1 -->
                    <div class="group flex flex-col bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 hover:shadow-2xl hover:shadow-emerald-500/10 hover:border-emerald-200 hover:-translate-y-1.5 transition-all duration-300">
                        <div class="relative h-52 w-full rounded-2xl overflow-hidden mb-5 bg-slate-100">
                            <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1599&q=80" 
                                 alt="Burger" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full">
                                🔥 Popular
                            </span>
                        </div>
                        
                        <h3 class="font-extrabold text-xl text-slate-900 group-hover:text-emerald-600 transition-colors">
                            Classic Cheeseburger
                        </h3>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed flex-grow">
                            Juicy beef patty, melted cheddar, fresh lettuce, and our secret sauce on a toasted brioche bun.
                        </p>
                        
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-medium">Price</span>
                                <p class="text-emerald-600 font-black text-2xl">$8.99</p>
                            </div>
                            @guest
                                <a href="{{ route('login') }}" 
                                   class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-colors duration-200">
                                    Log in to Order
                                </a>
                            @endguest
                            @auth
                                <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:shadow-emerald-600/40 transition-all duration-200">
                                    Order Now
                                </button>
                            @endauth
                        </div>
                    </div>

                    <!-- 🍕 Product 2 -->
                    <div class="group flex flex-col bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 hover:shadow-2xl hover:shadow-emerald-500/10 hover:border-emerald-200 hover:-translate-y-1.5 transition-all duration-300">
                        <div class="relative h-52 w-full rounded-2xl overflow-hidden mb-5 bg-slate-100">
                            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1770&q=80" 
                                 alt="Pizza" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full">
                                🍕 Chef Special
                            </span>
                        </div>
                        
                        <h3 class="font-extrabold text-xl text-slate-900 group-hover:text-emerald-600 transition-colors">
                            Margherita Pizza
                        </h3>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed flex-grow">
                            Wood-fired crust topped with San Marzano tomato sauce, fresh mozzarella, and basil leaves.
                        </p>
                        
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-medium">Price</span>
                                <p class="text-emerald-600 font-black text-2xl">$12.50</p>
                            </div>
                            @guest
                                <a href="{{ route('login') }}" 
                                   class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-colors duration-200">
                                    Log in to Order
                                </a>
                            @endguest
                            @auth
                                <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:shadow-emerald-600/40 transition-all duration-200">
                                    Order Now
                                </button>
                            @endauth
                        </div>
                    </div>

                    <!-- 🍝 Product 3 -->
                    <div class="group flex flex-col bg-white rounded-3xl p-5 shadow-sm border border-slate-200/80 hover:shadow-2xl hover:shadow-emerald-500/10 hover:border-emerald-200 hover:-translate-y-1.5 transition-all duration-300">
                        <div class="relative h-52 w-full rounded-2xl overflow-hidden mb-5 bg-slate-100">
                            <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-1.2.1&auto=format&fit=crop&w=774&q=80" 
                                 alt="Pasta" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <h3 class="font-extrabold text-xl text-slate-900 group-hover:text-emerald-600 transition-colors">
                            Spicy Garlic Pasta
                        </h3>
                        <p class="text-slate-500 mt-2 text-sm leading-relaxed flex-grow">
                            Al dente pasta tossed in olive oil, toasted garlic, chili flakes, and topped with parmesan.
                        </p>
                        
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-medium">Price</span>
                                <p class="text-emerald-600 font-black text-2xl">$10.99</p>
                            </div>
                            @guest
                                <a href="{{ route('login') }}" 
                                   class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-colors duration-200">
                                    Log in to Order
                                </a>
                            @endguest
                            @auth
                                <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 shadow-md shadow-emerald-600/20 hover:shadow-emerald-600/40 transition-all duration-200">
                                    Order Now
                                </button>
                            @endauth
                        </div>
                    </div>

                </div>
                
                <!-- Bottom View All Button -->
                <div class="mt-14 text-center">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white border border-slate-200 font-bold text-slate-700 hover:text-emerald-600 hover:border-emerald-300 shadow-sm hover:shadow-md transition-all duration-200">
                        <span>View all products</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
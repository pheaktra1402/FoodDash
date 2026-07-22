<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-5xl mx-auto px-4 py-8">
        
        <!-- Main Container Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-6 sm:p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center border border-slate-100">
            
            <!-- LEFT SIDE: Register Form -->
            <div class="w-full max-w-md mx-auto">
                
                <!-- Title Header -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Create Account
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 mt-2">
                        Get started with your new account today.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name"
                               placeholder="Full Name" 
                               class="w-full rounded-full border border-slate-300 bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="username"
                               placeholder="Email Address" 
                               class="w-full rounded-full border border-slate-300 bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Password -->
                    <div>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Password" 
                               class="w-full rounded-full border border-slate-300 bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Confirm Password" 
                               class="w-full rounded-full border border-slate-300 bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Register Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 bg-black hover:bg-slate-800 text-white font-semibold text-sm rounded-full shadow-lg transition-all duration-200">
                            Register
                        </button>
                    </div>

                    <!-- Login Navigation Link -->
                    <div class="text-center pt-4">
                        <p class="text-xs text-slate-500">
                            Already registered? 
                            <a href="{{ route('login') }}" class="font-bold text-slate-900 hover:underline">
                                Login Here
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- RIGHT SIDE: Banner Image -->
            <div class="hidden lg:block relative h-full min-h-[550px] rounded-2xl overflow-hidden bg-slate-100">
                <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&q=80&w=1000" 
                     alt="Register Banner" 
                     class="absolute inset-0 w-full h-full object-cover">
            </div>

        </div>
    </div>
</x-guest-layout>
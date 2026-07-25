<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" class="w-full max-w-md mx-auto px-4 text-center">
            <x-auth-session-status class="!text-emerald-600 !font-semibold !bg-transparent !border-0 !shadow-none !p-0" :status="session('status')" />
        </div>
    @endif

    <div class="w-full max-w-5xl mx-auto px-4 py-8">
        
        <!-- Main Container Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-6 sm:p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center border border-slate-100">
            
            <!-- LEFT SIDE: Register Form -->
            <div class="w-full max-w-md mx-auto" 
                 x-data="{ 
                    showPass: false, 
                    showConfirmPass: false,
                    password: '', 
                    password_confirmation: '',
                    
                    get strength() {
                        let score = 0;
                        if (this.password.length >= 8) score++;
                        if (/[A-Z]/.test(this.password)) score++;
                        if (/[0-9]/.test(this.password)) score++;
                        if (/[^A-Za-z0-9]/.test(this.password)) score++;
                        return score;
                    }
                 }">
                
                <!-- Title Header -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Create Account
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 mt-2">
                        Get started with your new account today.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
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
                               class="w-full rounded-full border @error('name') border-rose-500 @else border-slate-300 @enderror bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
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
                               class="w-full rounded-full border @error('email') border-rose-500 @else border-slate-300 @enderror bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Password Input with Toggle Eye Icon -->
                    <div>
                        <div class="relative">
                            <input id="password" 
                                   :type="showPass ? 'text' : 'password'" 
                                   name="password" 
                                   x-model="password"
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Password" 
                                   class="w-full rounded-full border @error('password') border-rose-500 @else border-slate-300 @enderror bg-white pl-5 pr-12 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                            
                            <!-- Toggle Show/Hide Button -->
                            <button type="button" @click="showPass = !showPass" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg x-show="showPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <div class="relative">
                            <input id="password_confirmation" 
                                   :type="showConfirmPass ? 'text' : 'password'" 
                                   name="password_confirmation" 
                                   x-model="password_confirmation"
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Confirm Password" 
                                   class="w-full rounded-full border @error('password_confirmation') border-rose-500 @else border-slate-300 @enderror bg-white pl-5 pr-12 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition" />
                            
                            <button type="button" @click="showConfirmPass = !showConfirmPass" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg x-show="showConfirmPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                <svg x-show="!showConfirmPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>

                        <!-- Real-time Live Match Alert (Only shows if NO backend error exists) -->
                        @if (!$errors->has('password_confirmation'))
                            <div x-show="password_confirmation.length > 0 && password !== password_confirmation" class="px-4 mt-1" x-cloak>
                                <span class="text-xs text-rose-600">Confirm password does not match.</span>
                            </div>
                        @endif

                        <!-- Backend Server Validation Error -->
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
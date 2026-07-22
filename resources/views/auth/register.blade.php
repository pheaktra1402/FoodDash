<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
                                <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.98 8.98 0 013.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21f-3-3m-3-3l-3-3m-2-2l-3-3"/></svg>
                            </button>
                        </div>

                        <!-- Real-time Password Strength Meter Bar -->
                        <!-- <div x-show="password.length > 0" class="mt-2 px-4 transition-all" x-cloak> -->
                            <!-- <div class="flex gap-1 h-1">
                                <div class="h-full flex-1 rounded-full transition-all" :class="strength >= 1 ? 'bg-rose-500' : 'bg-slate-200'"></div> -->
                                <!-- <div class="h-full flex-1 rounded-full transition-all" :class="strength >= 2 ? 'bg-amber-500' : 'bg-slate-200'"></div>
                                <div class="h-full flex-1 rounded-full transition-all" :class="strength >= 3 ? 'bg-emerald-400' : 'bg-slate-200'"></div>
                                <div class="h-full flex-1 rounded-full transition-all" :class="strength >= 4 ? 'bg-emerald-600' : 'bg-slate-200'"></div> -->
                            <!-- </div>
                            <p class="text-[10px] text-slate-400 mt-1"> -->
                                <!-- Must contain 8+ characters -->
                                <!-- , uppercase, numbers & symbols. -->
                            <!-- </p>
                        </div> -->

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
                                <svg x-show="!showConfirmPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showConfirmPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.98 8.98 0 013.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21f-3-3m-3-3l-3-3m-2-2l-3-3"/></svg>
                            </button>
                        </div>

                        <!-- Real-time Live Match Alert -->
                        <div x-show="password_confirmation.length > 0 && password !== password_confirmation" class="px-4 mt-1" x-cloak>
                            <span class="text-xs text-rose-600">Passwords do not match!</span>
                        </div>

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
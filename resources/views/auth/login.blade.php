<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-5xl mx-auto px-4">
        
        <!-- Main Card Container -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6 sm:p-8 lg:p-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            
            <!-- LEFT COLUMN: Form -->
            <div class="w-full max-w-md mx-auto" x-data="{ showPass: false }">
                
                <!-- Header -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-slate-900">
                        Welcome Back!
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">
                        Sign in with your Email and Password.
                    </p>
                </div>

                <!-- novalidate បិទ Browser Alert ដើម ដើម្បីប្រើ Styled Error របស់ Tailwind វិញ -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4" novalidate>
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <input id="email" 
                            class="w-full rounded-full border @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-slate-300 focus:border-slate-900 focus:ring-slate-900 @enderror bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-colors" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            placeholder="Email" />
                        
                        <!-- បង្ហាញ Validation Error -->
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Password Input (មាន Eye Icon មើល/លាក់ Password) -->
                    <div>
                        <div class="relative">
                            <input id="password" 
                                :type="showPass ? 'text' : 'password'" 
                                name="password" 
                                required 
                                placeholder="Password" 
                                class="w-full rounded-full border @error('password') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-slate-300 focus:border-slate-900 focus:ring-slate-900 @enderror bg-white pl-5 pr-12 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none transition-colors" />
                            
                            <!-- Toggle Button -->
                            <!-- Toggle Button -->
        <button type="button" @click="showPass = !showPass" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition-colors focus:outline-none">
            
            <!-- 👁️ 1. EYE OPEN ICON (បង្ហាញពេល showPass == true) -->
            <svg x-show="showPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

            <!-- 🙈 2. EYE SLASH ICON (Icon ដែលអ្នកផ្ញើមក - បង្ហាញពេល showPass == false) -->
            <svg x-show="!showPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>

        </button>
                        </div>

                        <!-- បង្ហាញ Validation Error -->
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-600 px-4" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between px-2">
                        <!-- <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-slate-900" name="remember">
                            <span class="ms-2 text-xs text-slate-600">Remember me</span>
                        </label> -->

                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-slate-900 hover:underline" href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full py-3.5 bg-black hover:bg-slate-800 text-white font-medium text-sm rounded-full shadow transition-colors">
                        Login
                    </button>

                    <!-- Divider -->
                    <div class="relative flex items-center justify-center my-4">
                        <div class="border-t border-slate-200 w-full"></div>
                        <span class="bg-white px-3 text-xs text-slate-400 absolute">or login with</span>
                    </div>

                    <!-- Social Buttons -->
                    <div class="space-y-2.5">
                        <a href="#" class="w-full py-2.5 border border-slate-300 rounded-full flex items-center justify-center gap-2 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                            </svg>
                            <span class="text-xs font-semibold text-slate-700">Login with Google</span>
                        </a>

                        <a href="#" class="w-full py-2.5 border border-slate-300 rounded-full flex items-center justify-center gap-2 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4 fill-[#1877F2]" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="text-xs font-semibold text-slate-700">Login with Facebook</span>
                        </a>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center pt-4">
                        <p class="text-xs text-slate-500">
                            Did not have any account? 
                            <a href="{{ route('register') }}" class="font-bold text-slate-900 hover:underline">
                                Register Now
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- RIGHT COLUMN: Image -->
            <div class="hidden lg:block relative h-full min-h-[480px] rounded-2xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&q=80&w=1000" 
                     alt="Login Banner" 
                     class="absolute inset-0 w-full h-full object-cover">
            </div>

        </div>
    </div>
</x-guest-layout>
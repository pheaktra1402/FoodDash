<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-md mx-auto px-4 py-8">
        
        <!-- Main Card Container -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6 sm:p-8">
            
            <!-- Icon & Header -->
            <div class="text-center mb-6">
                <!-- Lock Icon Badge -->
                <div class="w-12 h-12 bg-slate-100 text-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                    Reset Password
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">
                    Please enter your new password below.
                </p>
            </div>

            <!-- 📍 Added novalidate -->
            <form method="POST" action="{{ route('password.store') }}" class="space-y-4" novalidate>
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email', $request->email) }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="Email Address" 
                           class="w-full rounded-full border @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-slate-300 focus:border-slate-900 focus:ring-slate-900 @enderror bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:ring-1 focus:outline-none transition duration-200" />
                    
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-600 px-4" />
                </div>

                <!-- Password -->
                <div>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           placeholder="New Password" 
                           class="w-full rounded-full border @error('password') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-slate-300 focus:border-slate-900 focus:ring-slate-900 @enderror bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:ring-1 focus:outline-none transition duration-200" />
                    
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-600 px-4" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Confirm New Password" 
                           class="w-full rounded-full border border-slate-300 bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-slate-900 focus:ring-1 focus:ring-slate-900 focus:outline-none transition duration-200" />
                    
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-rose-600 px-4" />
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-black hover:bg-slate-800 text-white font-semibold text-sm rounded-full shadow-lg transition-all duration-200">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-guest-layout>
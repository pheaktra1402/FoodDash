<x-guest-layout>
    <!-- Session Status -->
 @if (session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="w-full max-w-md mx-auto px-4 text-center">
            <x-auth-session-status class="!text-emerald-600 !font-semibold !bg-transparent !border-0 !shadow-none !p-0" :status="session('status')" />
        </div>
    @endif

    <div class="w-full max-w-md mx-auto px-4 py-8">
        
        <!-- White Card Container -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6 sm:p-8">
            
            <!-- Icon & Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-slate-100 text-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                    Forgot Password?
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4" novalidate>
                @csrf

                <!-- Email Address -->
                <div>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           placeholder="Enter your registered email" 
                           class="w-full rounded-full border @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-slate-300 focus:border-slate-900 focus:ring-slate-900 @enderror bg-white px-5 py-3 text-sm text-slate-800 placeholder-slate-400 focus:ring-1 focus:outline-none transition duration-200" />
                    
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-600 px-4" />
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-black hover:bg-slate-800 text-white font-semibold text-sm rounded-full shadow-lg transition-all duration-200">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center pt-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Login
                    </a>
                </div>
            </form>

        </div>

    </div>
</x-guest-layout>
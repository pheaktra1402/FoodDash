<nav class="flex items-center justify-between p-4 bg-slate-900 text-white">
    <!-- 1. Logo Website (អ្នកណាក៏មើលឃើញដែរ) -->
    <a href="/" class="text-lg font-bold">Food Delivery</a>

    <!-- 2. Menu ឬ Buttons ស្ដាំដៃ -->
    <div class="flex items-center gap-4">

        <!-- ------------------------------------------------------------- -->
        <!-- ករណីទី ១៖ ប្រសិនបើជា Visitor (មិនទាន់បាន Login ចូលប្រព័ន្ធ) -->
        <!-- ------------------------------------------------------------- -->
        @guest
            <a href="{{ route('login') }}" class="text-sm hover:underline">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                Register
            </a>
        @endguest

        <!-- ------------------------------------------------------------- -->
        <!-- ករណីទី ២៖ ប្រសិនបើជា User ដែលបាន Login រួចហើយ -->
        <!-- ------------------------------------------------------------- -->
        @auth
            <!-- បើគាត់ជា Admin ឱ្យបង្ហាញប៊ូតុងមួយនេះបន្ថែម -->
            @if(auth()->user()->role === 'admin')
                <a href="/admin/dashboard" class="bg-rose-600 text-white px-3 py-1 rounded.full text-xs font-bold">
                    ⚙️ Admin Panel
                </a>
            @endif

            <!-- បង្ហាញឈ្មោះ User ដែលកំពុងប្រើប្រាស់ -->
            <span class="text-sm font-medium text-slate-300">
                Hi, {{ auth()->user()->name }}
            </span>

            <!-- ប៊ូតុង Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-xs text-rose-400 hover:underline">
                    Logout
                </button>
            </form>
        @endauth

    </div>
</nav>
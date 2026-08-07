<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodDash Shop</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #FFF5F7; /* Soft pinkish-gray background matching the home view */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
        }

        main {
            flex: 1;
        }

        /* Pink Accent Customizations for Navbar Elements */
        .text-custom-pink {
            color: #F43F5E !important;
        }

        .bg-custom-pink {
            background-color: #F43F5E !important;
        }

        .btn-custom-pink {
            background-color: #F43F5E;
            color: #fff;
            border-radius: 50px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-custom-pink:hover {
            background-color: #E11D48;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline-custom-pink {
            color: #F43F5E;
            border-color: #F43F5E;
            border-radius: 50px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-outline-custom-pink:hover {
            background-color: #FFF1F2;
            color: #E11D48;
            border-color: #E11D48;
        }

        .navbar-nav .nav-link.active {
            color: #F43F5E !important;
        }
    </style>
</head>

<body>

    <!-- NAVBAR (Clean Modern Style with Pink Accents) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-custom-pink d-flex align-items-center gap-2" href="{{ url('/') }}">
                <i class="fa-solid fa-cart-shopping fs-4"></i> FoodDash
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-custom-pink' : 'text-secondary' }}"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products*') ? 'active fw-bold text-custom-pink' : 'text-secondary' }}"
                            href="{{ url('/products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about*') ? 'active fw-bold text-custom-pink' : 'text-secondary' }}"
                            href="{{ url('/about') }}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active fw-bold text-custom-pink' : 'text-secondary' }}"
                            href="{{ url('/contact') }}">Contact us</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->role === 'admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="btn btn-danger btn-sm rounded-pill px-3 fw-semibold opacity-75">
                            Admin Panel
                        </a>
                    @endif

                    @auth
                        <span class="small fw-bold text-dark">
                            Hello, {{ auth()->user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link text-secondary p-0 small text-decoration-none">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-custom-pink btn-sm px-3">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-custom-pink btn-sm px-3">Register</a>
                    @endauth
                    
                    @php
                        // Calculate total quantity of items in session cart
                        $cartCount = 0;
                        if (session('cart')) {
                            foreach (session('cart') as $details) {
                                $cartCount += $details['quantity'];
                            }
                        }
                    @endphp

                    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark position-relative me-2 border-0 bg-light rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-cart-shopping text-secondary"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-custom-pink cart-badge-count">
                            {{ $cartCount }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main class="py-0">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>&copy; {{ date('Y') }} FoodDash. All rights reserved.</small>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast-notification" style="position: fixed; bottom: 24px; right: 24px; background: #0F172A; color: #fff; padding: 14px 24px; border-radius: 14px; font-size: 14px; font-weight: 600; box-shadow: 0 12px 30px rgba(0,0,0,0.2); opacity: 0; transition: opacity 0.3s ease, transform 0.3s ease; transform: translateY(20px); pointer-events: none; z-index: 9999;">
        Product added to cart successfully!
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-notification');
        if (!toast) return;

        function showToast(message) {
            toast.innerText = message;
            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
            }, 2000);
        }

        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const url = this.action;
                const token = this.querySelector('input[name="_token"]').value;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartBadge = document.querySelector('.cart-badge-count');
                        if (cartBadge) {
                            cartBadge.innerText = data.cartCount;
                        }
                        showToast(data.success);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
    </script>
</body>

</html>
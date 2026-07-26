<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodDash Shop</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>

    <!-- NAVBAR (Clean White Style) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success d-flex align-items-center gap-2" href="{{ url('/') }}">
                <i class="fa-solid fa-cart-shopping fs-4"></i> FoodDash
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-success' : 'text-secondary' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products*') ? 'active fw-bold text-success' : 'text-secondary' }}" href="{{ url('/products') }}">Products</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->role === 'admin'))
                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger btn-sm rounded-pill px-3 fw-semibold opacity-75">
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
                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm px-3 rounded-pill">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-success btn-sm px-3 rounded-pill">Register</a>
                    @endauth
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>
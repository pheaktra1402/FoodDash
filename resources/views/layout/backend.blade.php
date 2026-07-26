<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FoodDash</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables & jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- jQuery UI for Dialog -->
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 220px;
            min-height: calc(100vh - 56px);
            background-color: #212529;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
        }
        .sidebar .sidebar-heading {
            font-size: 0.65rem;
            font-weight: 700;
            color: #6c757d;
            letter-spacing: 1px;
            padding: 1rem 1rem 0.25rem;
        }
        .table-dark-header th {
            background-color: #212529 !important;
            color: #fff !important;
            font-weight: 600;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
        <div class="container-fluid px-3">
            <div class="d-flex align-items-center gap-3">
                <a class="navbar-brand me-3 fs-6" href="{{ route('home') }}">Admin Panel</a>
                <button class="btn btn-link text-secondary p-0 me-3" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Search Bar -->
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <button class="btn btn-primary" type="button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <a class="nav-link text-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user"></i>
                        <span class="ms-1 small text-white">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="d-flex">

        <!-- SIDEBAR -->
        <div class="sidebar shrink-0">
            <div class="sidebar-heading">CORE</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-tachograph-digital me-2"></i> Dashboard
                    </a>
                </li>
            </ul>

            <div class="sidebar-heading">MANAGEMENT</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.orders.index') }}">
                        <i class="fa-solid fa-cart-shopping me-2"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.products.index') }}">
                        <i class="fa-solid fa-box-archive me-2"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-list me-2"></i> Categories
                    </a>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow-1 p-4">
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    @yield('content')

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>

@extends('layouts.frontend')

@section('content')
<style>
    /* Ensures container takes full viewport height */
    .admin-layout-wrapper {
        min-height: 100vh;
    }

    /* Full-height dark sidebar */
    .admin-sidebar {
        width: 220px;
        min-height: 100vh;
        background-color: #212529;
    }

    /* Section Headings (CORE, MANAGEMENT) */
    .admin-sidebar .sidebar-heading {
        font-size: 0.65rem;
        font-weight: 700;
        color: #6c757d;
        letter-spacing: 1px;
        padding: 1.25rem 1rem 0.35rem;
        text-transform: uppercase;
    }

    /* Navigation Links */
    .admin-sidebar .nav-link {
        color: #adb5bd;
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 0; /* Keeps rectangular alignment */
        transition: color 0.15s ease-in-out;
    }

    /* Hover effect */
    .admin-sidebar .nav-link:hover {
        color: #ffffff;
    }

    /* Active link style matching Dashboard (Image 2) */
    .admin-sidebar .nav-link.active {
        color: #ffffff !important;
        font-weight: 700;
        background-color: transparent !important; /* Removes blue pill background */
    }

    /* Table dark header class */
    .table-dark-header th {
        background-color: #212529 !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.85rem;
    }
</style>

<div class="d-flex admin-layout-wrapper">
    <!-- SIDEBAR -->
    <div class="admin-sidebar flex-shrink-0">
        <div class="sidebar-heading">CORE</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-tachograph-digital me-2"></i> Dashboard
                </a>
            </li>
        </ul>

        <div class="sidebar-heading">MANAGEMENT</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" 
                   href="{{ route('admin.orders.index') }}">
                    <i class="fa-solid fa-cart-shopping me-2"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" 
                   href="{{ route('admin.products.index') }}">
                    <i class="fa-solid fa-box-archive me-2"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                   href="{{ route('admin.categories.index') }}">
                    <i class="fa-solid fa-list me-2"></i> Categories
                </a>
            </li>
        </ul>
    </div>

    <!-- PAGE CONTENT -->
    <div class="flex-grow-1 p-4 bg-light">
        @yield('admin-content')
    </div>
</div>
@endsection
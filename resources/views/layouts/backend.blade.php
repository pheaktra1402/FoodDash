@extends('layouts.frontend')

@section('content')
<style>
    /* Ensures container takes full viewport height */
    .admin-layout-wrapper {
        min-height: 100vh;
        background-color: #F8FAFC;
    }

    /* Full-height sleek sidebar */
    .admin-sidebar {
        width: 240px;
        min-height: 100vh;
        background-color: #1E293B;
        border-right: 1px solid #334155;
    }

    /* Section Headings (CORE, MANAGEMENT) */
    .admin-sidebar .sidebar-heading {
        font-size: 0.65rem;
        font-weight: 700;
        color: #94A3B8;
        letter-spacing: 1px;
        padding: 1.5rem 1.25rem 0.5rem;
        text-transform: uppercase;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Navigation Links */
    .admin-sidebar .nav-link {
        color: #CBD5E1;
        font-size: 0.875rem;
        padding: 0.75rem 1.25rem;
        margin: 0.2rem 0.75rem;
        border-radius: 10px;
        transition: all 0.2s ease-in-out;
        font-weight: 500;
    }

    /* Hover effect */
    .admin-sidebar .nav-link:hover {
        color: #FFFFFF;
        background-color: rgba(255, 255, 255, 0.05);
    }

    /* Active link style matching modern aesthetic */
    .admin-sidebar .nav-link.active {
        color: #FFFFFF !important;
        font-weight: 700;
        background-color: #F43F5E !important;
        box-shadow: 0 4px 12px rgba(244, 63, 94, 0.3);
    }

    /* Table dark header class */
    .table-dark-header th {
        background-color: #1E293B !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.85rem;
    }
</style>

<div class="d-flex admin-layout-wrapper">
    <!-- SIDEBAR -->
    <div class="admin-sidebar flex-shrink-0 d-flex flex-column">
        <!-- Sidebar Brand/Logo Header -->
        <div class="p-3.5 px-4 border-bottom border-secondary border-opacity-25 d-flex align-items-center" style="height: 70px;">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-bold fs-5 d-flex align-items-center gap-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                <span class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px; background-color: #F43F5E;">
                    <i class="fa-solid fa-utensils fs-6"></i>
                </span>
                <span>Admin Panel</span>
            </a>
        </div>

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
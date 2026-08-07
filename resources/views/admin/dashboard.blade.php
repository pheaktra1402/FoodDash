@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Dashboard</h2>
        <span class="text-muted small">Welcome back, <strong class="text-dark">{{ auth()->user()->name ?? 'Admin' }}</strong>!</span>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Orders -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <div class="text-muted small fw-semibold">TOTAL ORDERS</div>
                        <div class="fs-4 fw-bold text-dark mt-1">{{ $totalOrders ?? 0 }}</div>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <div class="text-muted small fw-semibold">TOTAL PRODUCTS</div>
                        <div class="fs-4 fw-bold text-dark mt-1">{{ $totalProducts ?? 0 }}</div>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-box-archive fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <div class="text-muted small fw-semibold">CATEGORIES</div>
                        <div class="fs-4 fw-bold text-dark mt-1">{{ $totalCategories ?? 0 }}</div>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-list fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <div class="text-muted small fw-semibold">TOTAL REVENUE</div>
                        <div class="fs-4 fw-bold mt-1" style="color: #F43F5E;">${{ number_format($totalRevenue ?? 0, 2) }}</div>
                    </div>
                    <div class="rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #FFF1F2; color: #F43F5E;">
                        <i class="fa-solid fa-dollar-sign fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #E2E8F0 !important;">
            <h5 class="card-title mb-0 fw-bold text-dark" style="font-family: 'Plus Jakarta Sans', sans-serif;">Recent Orders</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm px-3 rounded-pill fw-semibold text-white" style="background-color: #F43F5E;">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle small mb-0">
                    <thead class="table-light text-uppercase text-secondary" style="background-color: #F8FAFC; font-size: 0.75rem;">
                        <tr>
                            <th class="py-3 px-4">Order ID</th>
                            <th class="py-3">Customer</th>
                            <th class="py-3">Amount</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 px-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td class="py-3 px-4 fw-bold text-dark">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-3 text-secondary">{{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}</td>
                                <td class="py-3 fw-bold" style="color: #F43F5E;">${{ number_format($order->total_price ?? 0, 2) }}</td>
                                <td class="py-3">
                                    <span class="badge px-3 py-2 fw-semibold {{ $order->status === 'completed' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                        {{ ucfirst($order->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-muted">{{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">No recent orders to show.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
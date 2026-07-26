@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-dark fw-bold">Dashboard</h2>
        <span class="text-muted small">Welcome back, {{ auth()->user()->name ?? 'Admin' }}!</span>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Orders -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <div class="text-muted small fw-semibold">TOTAL ORDERS</div>
                        <div class="fs-4 fw-bold text-dark mt-1">{{ $totalOrders ?? 0 }}</div>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                        <i class="fa-solid fa-cart-shopping fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <div class="text-muted small fw-semibold">TOTAL PRODUCTS</div>
                        <div class="fs-4 fw-bold text-dark mt-1">{{ $totalProducts ?? 0 }}</div>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded p-3">
                        <i class="fa-solid fa-box-archive fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <div class="text-muted small fw-semibold">CATEGORIES</div>
                        <div class="fs-4 fw-bold text-dark mt-1">{{ $totalCategories ?? 0 }}</div>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded p-3">
                        <i class="fa-solid fa-list fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <div class="text-muted small fw-semibold">TOTAL REVENUE</div>
                        <div class="fs-4 fw-bold text-dark mt-1">${{ number_format($totalRevenue ?? 0, 2) }}</div>
                    </div>
                    <div class="bg-info bg-opacity-10 text-info rounded p-3">
                        <i class="fa-solid fa-dollar-sign fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table / Quick Action Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 fw-bold">Recent Orders</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle small mb-0">
                    <thead class="table-dark-header">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->customer_name ?? $order->user->name ?? 'Guest' }}</td>
                                <td class="fw-bold">${{ number_format($order->total_price ?? 0, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No recent orders to show.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
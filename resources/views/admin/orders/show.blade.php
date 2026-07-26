@extends('layouts.backend')

@section('admin-content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-dark fw-bold">Order Details #{{ sprintf('%05d', $order->id) }}</h2>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Orders
            </a>
        </div>

        <div class="row g-4 mb-4">
            <!-- Customer Info -->
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                    <h6 class="fw-bold mb-2">Customer Information</h6>
                    <p class="mb-1"><strong>Name:</strong> {{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone ?? $order->user?->phone ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Address:</strong> {{ $order->address ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Summary Info -->
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                    <h6 class="fw-bold mb-2">Order Summary</h6>
                    <p class="mb-1"><strong>Order Date:</strong> {{ $order->created_at ? $order->created_at->format('M d, Y h:i A') : 'N/A' }}</p>
                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-secondary">{{ ucfirst($order->status ?? 'pending') }}</span></p>
                    <p class="mb-0"><strong>Total Amount:</strong> <span class="fw-bold text-success">${{ number_format($order->total_price ?? 0, 2) }}</span></p>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <h5 class="fw-bold mb-3">Items Ordered</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle small">
                <thead class="table-dark-header">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items ?? [] as $item)
                        <tr>
                            <td>{{ $item->product_name ?? $item->product?->name ?? 'Product Item' }}</td>
                            <td class="text-center">${{ number_format($item->price, 2) }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">No item details available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
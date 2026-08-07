@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Order Details #{{ sprintf('%05d', $order->id) }}</h2>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold border-2">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Orders
                </a>
            </div>

            {{-- Success Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 rounded-4 shadow-sm border-0" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4 mb-4">
                <!-- Customer Info -->
                <div class="col-md-6">
                    <div class="p-4 border rounded-4 bg-light h-100" style="border-color: #E2E8F0 !important;">
                        <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="font-family: 'Plus Jakarta Sans', sans-serif; color: #F43F5E;">
                            <i class="fa-solid fa-user"></i> Customer Information
                        </h6>
                        <p class="mb-2 text-secondary"><strong>Name:</strong> <span class="text-dark">{{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}</span></p>
                        <p class="mb-2 text-secondary"><strong>Phone:</strong> <span class="text-dark">{{ $order->phone ?? $order->user?->phone ?? 'N/A' }}</span></p>
                        <p class="mb-0 text-secondary"><strong>Address:</strong> <span class="text-dark">{{ $order->shipping_address ?? $order->address ?? 'N/A' }}</span></p>
                    </div>
                </div>

                <!-- Summary Info & Payment Action -->
                <div class="col-md-6">
                    <div class="p-4 border rounded-4 bg-light h-100 d-flex flex-column justify-content-between" style="border-color: #E2E8F0 !important;">
                        <div>
                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2" style="font-family: 'Plus Jakarta Sans', sans-serif; color: #F43F5E;">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Order Summary
                            </h6>
                            <p class="mb-2 text-secondary"><strong>Order Date:</strong> <span class="text-dark">{{ $order->created_at ? $order->created_at->format('M d, Y h:i A') : 'N/A' }}</span></p>
                            <p class="mb-2 text-secondary">
                                <strong>Status:</strong>
                                <span class="badge px-3 py-2 fw-semibold {{ $order->status === 'completed' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($order->status ?? 'pending') }}
                                </span>
                            </p>
                            <p class="mb-2 text-secondary">
                                <strong>Payment Status:</strong>
                                @if(($order->payment_status ?? '') === 'paid' || $order->status === 'completed')
                                    <span class="badge bg-success px-3 py-2 fw-semibold"><i class="fa-solid fa-check-circle me-1"></i> Paid</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2 fw-semibold"><i class="fa-solid fa-clock me-1"></i> Unverified / Pending</span>
                                @endif
                            </p>
                            <p class="mb-0 text-secondary"><strong>Total Amount:</strong> <span class="fw-bold fs-5" style="color: #F43F5E;">${{ number_format($order->total_price ?? 0, 2) }}</span></p>
                        </div>

                        <!-- Payment Confirmation Button -->
                        <div class="mt-4 pt-3 border-top" style="border-color: #E2E8F0 !important;">
                            @if(($order->payment_status ?? '') !== 'paid' && $order->status !== 'completed')
                                <form action="{{ route('admin.orders.confirm-payment', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm w-100 py-3 fw-bold shadow-sm rounded-3 text-white border-0"
                                        style="background-color: #F43F5E;"
                                        onclick="return confirm('Have you checked your bank app and verified receipt of ${{ number_format($order->total_price ?? 0, 2) }}?')">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Confirm Payment & Send Telegram Alert
                                    </button>
                                </form>
                            @else
                                <div class="text-success small fw-bold d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-circle-check"></i> Payment verified & Telegram notified.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <h5 class="fw-bold mb-3 text-dark" style="font-family: 'Plus Jakarta Sans', sans-serif;">Items Ordered</h5>
            <div class="table-responsive rounded-4 border" style="border-color: #E2E8F0 !important;">
                <table class="table table-hover align-middle small mb-0">
                    <thead class="table-light text-uppercase text-secondary" style="background-color: #F8FAFC; font-size: 0.75rem;">
                        <tr>
                            <th class="py-3 px-4">Product</th>
                            <th class="text-center py-3">Price</th>
                            <th class="text-center py-3">Quantity</th>
                            <th class="text-end py-3 px-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td class="py-3 px-4 fw-semibold text-dark">{{ $item->product->product_name ?? 'Product Name' }}</td>
                                <td class="text-center py-3 text-secondary">${{ number_format($item->price, 2) }}</td>
                                <td class="text-center py-3 text-secondary">{{ $item->quantity }}</td>
                                <td class="text-end py-3 px-4 fw-bold" style="color: #F43F5E;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
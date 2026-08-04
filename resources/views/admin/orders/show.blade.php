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

            {{-- Success Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4 mb-4">
                <!-- Customer Info -->
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light h-100">
                        <h6 class="fw-bold mb-2 text-primary"><i class="fa-solid fa-user me-1"></i> Customer Information
                        </h6>
                        <p class="mb-1"><strong>Name:</strong> {{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}
                        </p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->phone ?? $order->user?->phone ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Address:</strong> {{ $order->shipping_address ?? $order->address ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <!-- Summary Info & Payment Action -->
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-2 text-primary"><i class="fa-solid fa-file-invoice-dollar me-1"></i> Order
                                Summary</h6>
                            <p class="mb-1"><strong>Order Date:</strong>
                                {{ $order->created_at ? $order->created_at->format('M d, Y h:i A') : 'N/A' }}</p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                <span
                                    class="badge {{ $order->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($order->status ?? 'pending') }}
                                </span>
                            </p>
                            <p class="mb-1">
                                <strong>Payment Status:</strong>
                                @if(($order->payment_status ?? '') === 'paid' || $order->status === 'completed')
                                    <span class="badge bg-success"><i class="fa-solid fa-check-circle me-1"></i> Paid</span>
                                @else
                                    <span class="badge bg-danger"><i class="fa-solid fa-clock me-1"></i> Unverified /
                                        Pending</span>
                                @endif
                            </p>
                            <p class="mb-2"><strong>Total Amount:</strong> <span
                                    class="fw-bold text-success fs-5">${{ number_format($order->total_price ?? 0, 2) }}</span>
                            </p>
                        </div>

                        <!-- Payment Confirmation Button -->
                        <div class="mt-3 pt-2 border-top">
                            @if(($order->payment_status ?? '') !== 'paid' && $order->status !== 'completed')
                                <form action="{{ route('admin.orders.confirm-payment', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100 fw-bold shadow-sm"
                                        onclick="return confirm('Have you checked your bank app and verified receipt of ${{ number_format($order->total_price ?? 0, 2) }}?')">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Confirm Payment & Send Telegram Alert
                                    </button>
                                </form>
                            @else
                                <div class="text-success small fw-bold">
                                    <i class="fa-solid fa-circle-check me-1"></i> Payment verified & Telegram notified.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <h5 class="fw-bold mb-3">Items Ordered</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle small">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->product_name ?? 'Product Name' }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@extends('layouts.frontend')

@section('content')
    <div class="container my-5 text-center">
        <div class="card shadow-sm p-4 mx-auto" style="max-width: 600px; border-radius: 12px;">
            <div class="text-success mb-3">
                <i class="fa-solid fa-circle-check fa-4x"></i>
            </div>
            <h2 class="fw-bold mb-2">Order Placed Successfully!</h2>
            <p class="text-muted">Thank you for your order. We have received your delivery details and are processing it now.</p>

            <hr class="my-4">

            <div class="text-start mb-4">
                <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                <p class="mb-1"><strong>Total Amount:</strong> ${{ number_format($order->total_price, 2) }}</p>
                <p class="mb-1"><strong>Delivery Address:</strong> {{ $order->shipping_address }}</p>
                <p class="mb-0"><strong>Status:</strong> <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></p>
            </div>

            <a href="{{ url('/') }}" class="btn btn-primary btn-lg w-100">Continue Shopping</a>
        </div>
    </div>
@endsection
@extends('layouts.frontend')

@section('content')
<style>
    .btn-custom-pink {
        background-color: #F43F5E;
        color: #fff;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-custom-pink:hover {
        background-color: #E11D48;
        color: #fff;
        transform: translateY(-1px);
    }
</style>

<div class="bg-light py-5">
    <div class="container py-3">

        <!-- Progress Steps -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div class="progress position-absolute w-100" style="height: 3px; top: 50%; z-index: 1; background-color: #E2E8F0;">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-color: #F43F5E;"></div>
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                        4
                    </div>
                </div>
                <div class="d-flex justify-content-between text-muted small mt-2 fw-semibold">
                    <span style="color: #F43F5E !important;">Cart</span>
                    <span style="color: #F43F5E !important;">Checkout</span>
                    <span style="color: #F43F5E !important;">Pay QR</span>
                    <span class="fw-bold" style="color: #F43F5E !important;">Complete</span>
                </div>
            </div>
        </div>

        <div class="container my-5 text-center">
            <div class="card shadow-sm p-4 mx-auto bg-white border-0 rounded-4" style="max-width: 600px; border: 1px solid #E2E8F0 !important;">
                <div class="text-success mb-3">
                    <i class="fa-solid fa-circle-check fa-4x"></i>
                </div>
                <h2 class="fw-bold mb-2 text-dark" style="font-family: 'Plus Jakarta Sans', sans-serif;">Order Placed Successfully!</h2>
                <p class="text-muted">Thank you for your order. We have received your delivery details and are processing it now.</p>

                <hr class="my-4" style="border-color: #E2E8F0;">

                <div class="text-start mb-4 bg-light p-4 rounded-4 border" style="border-color: #E2E8F0 !important;">
                    <p class="mb-2 text-secondary"><strong>Order ID:</strong> <span class="text-dark">#{{ $order->id }}</span></p>
                    <p class="mb-2 text-secondary"><strong>Payment Method:</strong> <span class="text-dark">{{ $order->payment_method }}</span></p>
                    <p class="mb-2 text-secondary"><strong>Total Amount:</strong> <span class="fw-bold" style="color: #F43F5E;">${{ number_format($order->total_price, 2) }}</span></p>
                    <p class="mb-2 text-secondary"><strong>Delivery Address:</strong> <span class="text-dark">{{ $order->shipping_address }}</span></p>
                    <p class="mb-0 text-secondary"><strong>Status:</strong> <span class="badge bg-warning text-dark px-3 py-2">{{ ucfirst($order->status) }}</span></p>
                </div>

                <a href="{{ url('/') }}" class="btn btn-custom-pink btn-lg w-100 py-3 shadow-sm">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection
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
                        <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #F43F5E;"></div>
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                        1
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #CBD5E1 !important;">
                        2
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #CBD5E1 !important;">
                        3
                    </div>
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #CBD5E1 !important;">
                        4
                    </div>
                </div>
                <div class="d-flex justify-content-between text-muted small mt-2 fw-semibold">
                    <span class="fw-bold" style="color: #F43F5E !important;">Cart</span>
                    <span class="text-secondary">Checkout</span>
                    <span class="text-secondary">Pay QR</span>
                    <span class="text-secondary">Complete</span>
                </div>
            </div>
        </div>

        <h2 class="h3 fw-bold mb-4 text-dark" style="font-family: 'Plus Jakarta Sans', sans-serif;">Shopping Cart</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $cart = session()->get('cart', []);
            $total = 0;
        @endphp

        @if(count($cart) > 0)
            <div class="row g-4">
                <!-- Cart Items Table -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white" style="border: 1px solid #E2E8F0 !important;">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light" style="background-color: #F8FAFC;">
                                        <tr>
                                            <th class="py-3 px-4 text-secondary small text-uppercase fw-bold">Product</th>
                                            <th class="py-3 text-secondary small text-uppercase fw-bold">Price</th>
                                            <th class="py-3 text-secondary small text-uppercase fw-bold" style="width: 120px;">Quantity</th>
                                            <th class="py-3 text-secondary small text-uppercase fw-bold">Subtotal</th>
                                            <th class="py-3 px-4 text-center text-secondary small text-uppercase fw-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $id => $details)
                                            @php 
                                                $subtotal = $details['price'] * $details['quantity'];
                                                $total += $subtotal; 
                                            @endphp
                                            <tr>
                                                <td class="py-3 px-4">
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if(isset($details['image']))
                                                            <img src="{{ product_image_url($details['image']) }}" class="border rounded-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light border rounded-3 d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 50px; height: 50px; font-size: 10px;">No img</div>
                                                        @endif
                                                        <span class="fw-semibold text-dark">{{ $details['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 text-secondary">${{ number_format($details['price'], 2) }}</td>
                                                <td class="py-3">
                                                    <span class="badge px-3 py-2 fw-bold text-dark bg-light border" style="border-color: #E2E8F0 !important;">{{ $details['quantity'] }}</span>
                                                </td>
                                                <td class="py-3 fw-bold" style="color: #F43F5E;">${{ number_format($subtotal, 2) }}</td>
                                                <td class="py-3 px-4 text-center">
                                                    <!-- Remove button form -->
                                                    <form action="{{ route('cart.remove') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $id }}">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-3 rounded-pill fw-semibold border-2">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary & Checkout Box -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3 text-dark" style="font-family: 'Plus Jakarta Sans', sans-serif;">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>Subtotal</span>
                                <span class="fw-semibold text-dark">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Shipping</span>
                                <span class="fw-semibold text-success">Free</span>
                            </div>
                            <hr style="border-color: #E2E8F0;">
                            <div class="d-flex justify-content-between mb-4 fs-5 fw-bold text-dark">
                                <span>Total</span>
                                <span style="color: #F43F5E;">${{ number_format($total, 2) }}</span>
                            </div>

                            <!-- Checkout Form -->
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <a href="{{ route('checkout') }}" class="btn btn-custom-pink btn-lg w-100 py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <span>Proceed to Checkout</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5 bg-white shadow-sm rounded-4 border-0" style="border: 1px solid #E2E8F0 !important;">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle text-muted bg-light" style="width: 70px; height: 70px;">
                        <i class="fa-solid fa-cart-shopping fs-3"></i>
                    </div>
                </div>
                <p class="text-muted mb-3 fw-semibold">Your shopping cart is empty.</p>
                <a href="{{ route('products.index') }}" class="btn btn-custom-pink px-4 py-2 shadow-sm">Start Shopping</a>
            </div>
        @endif
    </div>
</div>
@endsection
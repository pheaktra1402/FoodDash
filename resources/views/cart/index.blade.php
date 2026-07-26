@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="h3 fw-bold mb-4">Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th style="width: 120px;">Quantity</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $details)
                                        @php 
                                            $subtotal = $details['price'] * $details['quantity'];
                                            $total += $subtotal; 
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if(isset($details['image']))
                                                        <img src="{{ asset('storage/' . $details['image']) }}" class="border rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px; font-size: 10px;">No img</div>
                                                    @endif
                                                    <span class="fw-semibold text-dark">{{ $details['name'] }}</span>
                                                </div>
                                            </td>
                                            <td>${{ number_format($details['price'], 2) }}</td>
                                            <td>
                                                <span class="badge bg-secondary px-2 py-1">{{ $details['quantity'] }}</span>
                                            </td>
                                            <td class="fw-bold text-success">${{ number_format($subtotal, 2) }}</td>
                                            <td class="text-center">
                                                <!-- Remove button form -->
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2">Remove</button>
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
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2 text-muted">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4 fs-5 fw-bold text-dark">
                            <span>Total</span>
                            <span class="text-success">${{ number_format($total, 2) }}</span>
                        </div>

                        <!-- Checkout Form -->
                        <form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    <a href="{{ route('checkout') }}" class="btn btn-primary">
    Proceed to Checkout
</a>
</form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5 bg-white shadow-sm rounded border-0">
            <p class="text-muted mb-3">Your shopping cart is empty.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm px-4">Start Shopping</a>
        </div>
    @endif
</div>
@endsection
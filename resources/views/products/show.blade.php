@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        
        <!-- Back Button -->
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm mb-4">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Products
        </a>

        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    
                    <!-- Product Image -->
                    <div class="col-md-5 text-center">
                        <div class="bg-light p-3 rounded border d-flex align-items-center justify-content-center" style="min-height: 300px; max-height: 400px;">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->product_name }}" 
                                     class="img-fluid rounded object-fit-contain" 
                                     style="max-height: 350px;">
                            @else
                                <div class="text-muted py-5">
                                    <i class="fa-regular fa-image fa-4x mb-2"></i>
                                    <p class="m-0">No Image Available</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-7">
                        @if($product->product_code)
                            <span class="badge bg-secondary font-monospace mb-2">Code: {{ $product->product_code }}</span>
                        @endif

                        <h2 class="fw-bold text-dark mb-3">{{ $product->product_name }}</h2>

                        <h3 class="fw-bold text-success mb-4">
                            ${{ number_format($product->selling_price, 2) }}
                        </h3>

                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase text-muted small">Description</h6>
                            <p class="text-secondary lead fs-6">
                                {{ $product->description ?? 'No description available for this product.' }}
                            </p>
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3">
                            <button class="btn btn-primary px-4 py-2 fw-semibold">
                                <i class="fa-solid fa-cart-shopping me-2"></i> Add to Cart
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-light px-4 py-2 border">
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
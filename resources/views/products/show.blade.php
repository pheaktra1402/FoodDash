@extends('layouts.frontend')

@section('content')
    <style>
        .product-detail-page {
            background-color: #FCFCFD;
            min-height: 85vh;
            padding: 40px 0 80px;
        }

        .btn-custom-pink {
            background-color: #F43F5E;
            color: #fff;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-custom-pink:hover {
            background-color: #E11D48;
            color: #fff;
            transform: translateY(-1px);
        }

        .detail-card {
            border-radius: 24px;
            border: 1px solid #E2E8F0;
            background: #FFFFFF;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        .image-preview-box {
            background: #F8FAFC;
            border-radius: 20px;
            border: 1px solid #E2E8F0;
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }
    </style>

    <div class="product-detail-page">
        <div class="container">

            <!-- Back Button -->
            <a href="{{ route('products.index') }}"
                class="btn btn-outline-secondary btn-sm mb-4 rounded-pill px-3 py-2 fw-semibold">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Products
            </a>

            <div class="card detail-card overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-5 align-items-center">

                        <!-- Product Image -->
                        <div class="col-md-5 text-center">
                            <div class="image-preview-box">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}"
                                        class="w-100 h-100 object-fit-contain"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                    <div class="align-items-center justify-content-center h-100 text-muted"
                                        style="display:none;">
                                        <i class="fa-regular fa-image fa-2x"></i>
                                    </div>

                                @else
                                    <div class="text-muted py-5">
                                        <i class="fa-regular fa-image fa-4x mb-2 opacity-50"></i>
                                        <p class="m-0 small fw-semibold">No Image Available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="col-md-7">
                            @if($product->product_code)
                                <span class="badge bg-light text-secondary border font-monospace mb-3 px-3 py-2 rounded-pill">
                                    Code: {{ $product->product_code }}
                                </span>
                            @endif

                            <h1 class="fw-bold text-dark mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                                {{ $product->product_name }}
                            </h1>

                            <div class="fs-3 fw-extrabold text-dark mb-4" style="font-weight: 800; color: #0F172A;">
                                ${{ number_format($product->selling_price, 2) }}
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-uppercase text-muted small mb-2 tracking-wider">Description</h6>
                                <p class="text-secondary lead fs-6" style="line-height: 1.6;">
                                    {{ $product->description ?? 'No description available for this product.' }}
                                </p>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Action Form -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                class="add-to-cart-form d-flex align-items-center gap-3 flex-wrap">
                                @csrf

                                <!-- Optional Quantity Selector -->
                                <div class="input-group" style="width: 130px;">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                                    <input type="number" name="quantity" class="form-control text-center fw-bold" value="1"
                                        min="1" max="99">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                                </div>

                                <button type="submit" class="btn btn-custom-pink px-4 py-2.5 fw-semibold shadow-sm">
                                    <i class="fa-solid fa-cart-shopping me-2"></i> Add to Cart
                                </button>

                                <a href="{{ route('products.index') }}"
                                    class="btn btn-light px-4 py-2.5 border rounded-pill fw-semibold text-secondary">
                                    Continue Shopping
                                </a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
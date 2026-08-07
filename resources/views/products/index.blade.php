@extends('layouts.frontend')

@section('content')
<style>
    .products-page {
        background-color: #FCFCFD;
        min-height: 80vh;
        padding-bottom: 80px;
    }

    /* Custom Pink Theme Variables & Classes */
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

    .btn-outline-custom-pink {
        color: #F43F5E;
        border-color: #F43F5E;
        border-radius: 50px;
        font-weight: 600;
        background: transparent;
        transition: all 0.2s ease;
    }

    .btn-outline-custom-pink:hover {
        background-color: #FFF1F2;
        color: #E11D48;
        border-color: #E11D48;
    }

    .product-card {
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        background: #FFFFFF;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px -10px rgba(244, 63, 94, 0.1) !important;
        border-color: #FDA4AF;
    }

    /* Reduced image container height to make card shorter */
    .product-img-wrap {
        height: 180px;
        background: #F8FAFC;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    /* Custom Pagination Styling */
    .pagination {
        gap: 6px;
    }

    .pagination .page-item .page-link {
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        color: #0F172A;
        font-weight: 600;
        padding: 8px 16px;
        transition: all 0.2s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: #F43F5E;
        border-color: #F43F5E;
        color: #fff;
        box-shadow: 0 4px 12px rgba(244, 63, 94, 0.3);
    }

    .pagination .page-item .page-link:hover {
        background-color: #FFF1F2;
        color: #E11D48;
        border-color: #FDA4AF;
    }

    .pagination .page-item.disabled .page-link {
        color: #94A3B8;
        background-color: #F8FAFC;
        border-color: #E2E8F0;
    }

    .search-input-group {
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-radius: 50px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        background: #fff;
    }

    .search-input-group .form-control {
        border: none;
        padding-left: 20px;
        box-shadow: none !important;
    }
</style>

<div class="products-page pt-4">
    <div class="container my-4">

        <!-- Header & Search Row -->
        <div class="row mb-5 align-items-center g-3">
            <div class="col-md-7">
                <h2 class="fw-bold text-dark mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif;">Our Products</h2>
                <p class="text-muted m-0">Explore our latest collection of delicious items and essentials</p>
            </div>
            
            <div class="col-md-5">
                <form action="{{ route('products.index') }}" method="GET" class="input-group search-input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search products or categories..."
                        value="{{ request('search') }}">
                    <button class="btn btn-custom-pink px-4 m-1 rounded-pill" type="submit">
                        <i class="fa-solid fa-search me-1"></i> Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        @if (count($products) > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card product-card h-100 shadow-sm">

                            <!-- Product Image -->
                            <div class="product-img-wrap">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}"
                                        class="w-100 h-100 object-fit-contain transition">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                        <i class="fa-regular fa-image fa-2x"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Body (Reduced padding and text lengths) -->
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title fw-bold text-dark text-truncate mb-1" title="{{ $product->product_name }}">
                                    {{ $product->product_name }}
                                </h6>

                                <p class="card-text text-muted small mb-3 flex-grow-1 text-truncate" style="font-size: 0.85rem;">
                                    {{ $product->description }}
                                </p>

                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fs-6 fw-extrabold text-dark" style="font-weight: 800;">
                                        ${{ number_format($product->selling_price, 2) }}
                                    </span>
                                </div>

                                <!-- Action Buttons Footer -->
                                <div class="d-flex align-items-center gap-2 pt-2 border-top">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-outline-custom-pink btn-sm flex-grow-1 py-1.5" style="font-size: 0.85rem;">
                                        View Details
                                    </a>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form m-0">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-custom-pink btn-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%;">
                                            <i class="fa-solid fa-cart-plus" style="font-size: 0.8rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>

        @else
            <div class="text-center py-5">
                <div class="mb-3 text-muted opacity-50">
                    <i class="fa-solid fa-box-open fa-4x"></i>
                </div>
                <h4 class="text-dark fw-bold">No Products Found</h4>
                <p class="text-secondary">Please check back later or try searching for something else.</p>
            </div>
        @endif

    </div>
</div>
@endsection
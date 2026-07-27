@extends('layouts.frontend')

@section('content')
    
    <div class="container my-5">

        <!-- Section Header -->
        <div class="row mb-4 align-items-center">
            <div class="col">
                <h2 class="fw-bold text-dark m-0">Our Products</h2>
                <p class="text-muted m-0">Explore our latest collection of items</p>
            </div>
        </div>
        <!-- Search Form on the Right -->
    <div class="row mb-4 justify-content-end ad">
        <div class="col-md-4 col-sm-6">
            <form action="{{ route('products.index') }}" method="GET" class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search products or categories..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
        <!-- Products Grid -->
        @if (count($products) > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 hover-shadow transition">

                            <!-- Product Image -->
                            <div class="position-relative overflow-hidden bg-light rounded-top" style="height: 220px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}"
                                        class="w-100 h-100 object-fit-contain p-2">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                        <i class="fa-regular fa-image fa-2x"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title fw-bold text-dark text-truncate mb-2" title="{{ $product->product_name }}">
                                    {{ $product->product_name }}
                                </h5>

                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($product->description, 60) }}
                                </p>

                                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                    <span class="fs-5 fw-bold text-success">
                                        ${{ number_format($product->selling_price, 2) }}
                                    </span>

                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        View Details
                                    </a>
                                </div>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-2">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (ប្រសិនបើមាន) -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>

        @else
            <div class="text-center py-5">
                <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No Products Found</h4>
                <p class="text-secondary">Please check back later for new updates.</p>
            </div>
        @endif

    </div>
@endsection
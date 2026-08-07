@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Product Details</h2>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold border-2">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Products
                </a>
            </div>

            <div class="row g-4 align-items-center">
                <!-- Product Image Column -->
                <div class="col-md-5">
                    <div class="p-3 border rounded-4 bg-light text-center" style="border-color: #E2E8F0 !important;">
                        <div class="rounded-4 overflow-hidden shadow-sm bg-white d-flex align-items-center justify-content-center" style="min-height: 250px;">
                            {!! Html::img('/img/'.$product->image, $product->name)->attributes(['style'=>'width:100%; height:250px; object-fit:cover;']) !!}
                        </div>
                    </div>
                </div>

                <!-- Product Information Column -->
                <div class="col-md-7">
                    <div class="p-4 border rounded-4 bg-light h-100 d-flex flex-column justify-content-between" style="border-color: #E2E8F0 !important;">
                        <div>
                            <span class="badge px-3 py-2 fw-semibold mb-3" style="background-color: #FFF1F2; color: #F43F5E;">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                            <h3 class="fw-bold text-dark mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $product->name }}</h3>
                            <div class="fs-4 fw-bold mb-4" style="color: #F43F5E;">${{ number_format($product->price ?? 0, 2) }}</div>
                            <hr class="text-secondary opacity-25">
                            <h6 class="fw-bold mb-2 text-secondary" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Description</h6>
                            <p class="text-secondary mb-0" style="line-height: 1.6;">{{ $product->description ?? 'No description available for this product.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
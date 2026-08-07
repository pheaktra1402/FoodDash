@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-body p-4">

            <!-- Title & Back Button -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Category Details</h2>
                <a href="{{ route('category.list') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold border-2">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Categories
                </a>
            </div>

            <div class="p-4 border rounded-4 bg-light" style="border-color: #E2E8F0 !important;">
                <div class="mb-4">
                    <span class="d-block text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing: 0.5px;">Category Name</span>
                    <h3 class="fw-bold text-dark mb-0" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $category->name ?? $category->category_name }}</h3>
                </div>

                <hr class="text-secondary opacity-25">

                <div>
                    <span class="d-block text-muted small fw-semibold text-uppercase mb-1" style="letter-spacing: 0.5px;">Description</span>
                    <p class="text-secondary mb-0" style="line-height: 1.6;">{{ $category->description ?? 'No description available for this category.' }}</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
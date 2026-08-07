@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body p-4">

                    <!-- Title & Back Button -->
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                        <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Create New Product</h2>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold border-2">
                            <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4" style="background-color: #FFF1F2; color: #F43F5E;">
                            <ul class="mb-0 small fw-semibold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <!-- Product Code -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Product Code <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="product_code" 
                                       class="form-control rounded-3 shadow-none border-2 @error('product_code') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;" 
                                       value="{{ old('product_code') }}"
                                       placeholder="e.g. PRD-001" 
                                       required>
                                @error('product_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Product Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="product_name" 
                                       class="form-control rounded-3 shadow-none border-2 @error('product_name') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;" 
                                       value="{{ old('product_name') }}"
                                       placeholder="e.g. Angkor Milk" 
                                       required>
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Dropdown -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select rounded-3 shadow-none border-2 @error('category_id') is-invalid @enderror" style="border-color: #E2E8F0 !important;" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name ?? $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Description</label>
                                <textarea name="description" 
                                          class="form-control rounded-3 shadow-none border-2 @error('description') is-invalid @enderror" 
                                          style="border-color: #E2E8F0 !important;" 
                                          rows="4" 
                                          placeholder="Enter product description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Price ($) <span class="text-danger">*</span></label>
                                <input type="number" 
                                       step="0.01" 
                                       name="selling_price" 
                                       class="form-control rounded-3 shadow-none border-2 @error('selling_price') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;" 
                                       value="{{ old('selling_price') }}"
                                       placeholder="0.00" 
                                       required>
                                @error('selling_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Product Image</label>
                                <input type="file" 
                                       name="image" 
                                       class="form-control rounded-3 shadow-none border-2 @error('image') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: #E2E8F0 !important;">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4 rounded-pill fw-semibold border-2">Cancel</a>
                            <button type="submit" class="btn px-4 rounded-pill fw-semibold text-white shadow-sm border-0" style="background-color: #F43F5E;">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
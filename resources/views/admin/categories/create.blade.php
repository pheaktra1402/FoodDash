@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body p-4">

                    <!-- Title & Back Button -->
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                        <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Create New Category</h2>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold border-2">
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

                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Category Code -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Category Code <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="category_code" 
                                       class="form-control rounded-3 shadow-none border-2 @error('category_code') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;" 
                                       value="{{ old('category_code') }}"
                                       placeholder="e.g. CAT001 or DRK" 
                                       required>
                                @error('category_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Category Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="category_name" 
                                       class="form-control rounded-3 shadow-none border-2 @error('category_name') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;" 
                                       value="{{ old('category_name') }}"
                                       placeholder="e.g. Drinks, Fast Food" 
                                       required>
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Description <span class="text-danger">*</span></label>
                                <textarea name="description" 
                                          class="form-control rounded-3 shadow-none border-2 @error('description') is-invalid @enderror" 
                                          style="border-color: #E2E8F0 !important;" 
                                          rows="4" 
                                          placeholder="Enter category description"
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: #E2E8F0 !important;">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary px-4 rounded-pill fw-semibold border-2">Cancel</a>
                            <button type="submit" class="btn px-4 rounded-pill fw-semibold text-white shadow-sm border-0" style="background-color: #F43F5E;">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Category
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
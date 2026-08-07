@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
                <div class="card-body p-4">

                    <!-- Title & Back Button -->
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                        <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Edit Category</h2>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold border-2">
                            <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Category Name -->
                            <div class="col-md-12">
                                <label for="name" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Category Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control rounded-3 shadow-none border-2 @error('name') is-invalid @enderror" 
                                       style="border-color: #E2E8F0 !important;"
                                       value="{{ old('name', $category->name ?? $category->category_name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="description" class="form-label fw-semibold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Description</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="4" 
                                          class="form-control rounded-3 shadow-none border-2 @error('description') is-invalid @enderror" 
                                          style="border-color: #E2E8F0 !important;"
                                          placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: #E2E8F0 !important;">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary px-4 rounded-pill fw-semibold border-2">Cancel</a>
                            <button type="submit" class="btn px-4 rounded-pill fw-semibold text-white shadow-sm border-0" style="background-color: #F43F5E;">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Update Category
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
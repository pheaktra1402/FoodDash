@extends('layouts.backend')

@section('admin-content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-dark fw-bold">Edit Product</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Product Name -->
                <div class="col-md-8">
                    <label for="name" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $product->name ?? $product->product_name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="col-md-4">
                    <label for="price" class="form-label fw-semibold">Price ($) <span class="text-danger">*</span></label>
                    <input type="number" 
                           step="0.01" 
                           name="price" 
                           id="price" 
                           class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price', $product->price ?? $product->selling_price) }}" 
                           required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category Selection -->
                <div class="col-md-12">
                    <label for="category_id" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <textarea name="description" 
                              id="description" 
                              rows="3" 
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Image Upload & Preview -->
                <div class="col-md-12 mb-3">
                    <label for="image" class="form-label fw-semibold">Product Image</label>
                    
                    @if($product->image)
                        <div class="mb-2">
                            <span class="d-block text-muted small mb-1">Current Image:</span>
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="Current Product Image" 
                                 class="img-thumbnail" 
                                 style="max-height: 100px;">
                        </div>
                    @endif

                    <input type="file" 
                           name="image" 
                           id="image" 
                           class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*">
                    <div class="form-text">Leave blank if you do not want to change the image.</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-light border px-4">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Update Product
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
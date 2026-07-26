@extends('layout.frontend')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create New Product</h5>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                    <div class="card-body p-4">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Code</label>
                                <input type="text" name="product_code" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Name</label>
                                <input type="text" name="product_name" class="form-control" required
                                    placeholder="e.g. Angkor Milk">
                            </div>

                            <!-- Category Dropdown -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name ?? $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="Enter product description"></textarea>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price ($)</label>
                                <input type="number" step="0.01" name="selling_price" class="form-control" required
                                    placeholder="0.00">
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 mt-3">
                                <i class="fa-solid fa-save me-1"></i> Save Product
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
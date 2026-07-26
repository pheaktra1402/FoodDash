@extends('layouts.frontend')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create New Category</h5>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-sm">Back</a>
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

                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Category Code</label>
                                <input type="text" name="category_code" class="form-control" required
                                    placeholder="e.g. CAT001 or DRK">
                            </div>

                            <!-- Category Name -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category Name</label>
                                <input type="text" name="category_name" class="form-control" required
                                    placeholder="e.g. Drinks, Fast Food, Desserts">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 mt-2">
                                <i class="fa-solid fa-save me-1"></i> Save Category
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
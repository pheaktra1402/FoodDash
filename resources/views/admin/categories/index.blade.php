@extends('layouts.frontend')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            
            <!-- Header & Create Button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Category List</h3>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm px-3">
                    <i class="fa-solid fa-plus me-1"></i> Create New
                </a>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle small mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th>Category Code</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                            <th class="text-center" style="width: 140px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                            <tr>
                                <td class="fw-bold">{{ $key + 1 }}</td>
                                <td>
                                    <span class="badge bg-secondary font-monospace">{{ $category->category_code }}</span>
                                </td>
                                <td class="fw-semibold text-dark">{{ $category->category_name }}</td>
                                <td class="text-muted">{{ $category->created_at ? $category->created_at->format('M d, Y') : 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-primary btn-sm py-0 px-2">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
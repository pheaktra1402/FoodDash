@extends('.layouts.frontend')

@section('content')
    <div class="container my-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0">Product List</h3>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm px-3">
                        <i class="fa-solid fa-plus me-1"></i> Create New
                    </a>
                </div>

                <!-- Delete Flash Message -->
                @if(session('product_delete') || session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('product_delete') ?? session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Product Table -->
                @if (count($products) > 0)
                    <div class="table-responsive">
                        <table id="productTable" class="table table-bordered table-hover align-middle task-table mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <!-- Code -->
                                        <td>
                                            <span
                                                class="badge bg-secondary font-monospace">{{ $product->product_code ?? 'N/A' }}</span>
                                        </td>

                                        <!-- Image -->
                                        <td class="text-center" style="width: 80px;">
                                            @if($product->image)
                                                <!-- UPDATE THIS: -->
                                                <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <span class="text-muted small">No Image</span>
                                            @endif
                                        </td>

                                        <!-- Product Name -->
                                        <td class="fw-bold text-dark">
                                            {{ $product->product_name }}
                                        </td>

                                        <!-- Description -->
                                        <td class="text-muted small">
                                            {{ Str::limit($product->description, 50) }}
                                        </td>

                                        <!-- Price -->
                                        <td class="fw-semibold text-success">
                                            ${{ number_format($product->selling_price, 2) }}
                                        </td>

                                        <!-- Actions -->
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Edit -->
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="btn btn-outline-primary btn-sm py-1 px-2">
                                                    Edit
                                                </a>

                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-2">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center mb-0">
                        No products available. Click <strong>Create New</strong> to add one!
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- DataTables Script Initializer -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof DataTable !== 'undefined') {
                new DataTable('#productTable');
            }
        });
    </script>
@endsection
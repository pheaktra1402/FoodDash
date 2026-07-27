@extends('layouts.backend')

@section('admin-content')

<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <!-- Title & Create Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-dark font-weight-bold">Product List</h2>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm px-3">
                <i class="fa-solid fa-plus me-1"></i> Create New
            </a>
        </div>

        <!-- Entries dropdown & Search -->
        <div class="d-flex justify-content-between align-items-center mb-3 text-muted small">
            <div class="d-flex align-items-center gap-2">
                <span>Show</span>
                <select id="entriesSelect" class="form-select form-select-sm" style="width: auto;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span>entries</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span>Search:</span>
                <input type="text" id="searchInput" class="form-control form-control-sm" style="width: 150px;" placeholder="Search...">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle small mb-0" id="productsTable">
                <thead>
                    <tr class="table-dark-header">
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center">Image</th>
                        <th>Price</th>
                        <th class="text-center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="product-row">
                            <!-- Code -->
                            <td>
                                <span class="badge bg-secondary text-white font-monospace">
                                    {{ $product->code ?? str_pad($product->id, 6, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <!-- Name -->
                            <td>
                                <span class="fw-semibold text-primary">
                                    {{ $product->name ?? $product->title ?? $product->product_name ?? 'N/A' }}
                                </span>
                            </td>

                            <!-- Description -->
                            <td class="text-muted">
                                {{ Str::limit($product->description, 60) }}
                            </td>

                            <!-- Image -->
                            <td class="text-center">
                                <div style="width: 48px; height: 48px; margin: 0 auto;" class="d-flex align-items-center justify-content-center bg-light border rounded overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" style="max-height: 48px; object-fit: cover;">
                                    @else
                                        <span class="text-muted" style="font-size: 10px;">No image</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Price -->
                            <td class="fw-bold text-success">
                                ${{ number_format($product->price ?? $product->selling_price ?? 0, 2) }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm py-0 px-2">Edit</a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No products found in the database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        @if(method_exists($products, 'links'))
            <div class="mt-4 d-flex justify-content-end">
                {{ $products->links() }}
            </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const entriesSelect = document.getElementById('entriesSelect');
        const rows = document.querySelectorAll('.product-row');

        function filterTable() {
            const query = searchInput.value.toLowerCase().trim();
            const limit = parseInt(entriesSelect.value);
            let visibleCount = 0;

            rows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                if (text.includes(query) && visibleCount < limit) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (entriesSelect) entriesSelect.addEventListener('change', filterTable);
    });
</script>
@endsection
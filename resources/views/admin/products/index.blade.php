@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-body p-4">

            <!-- Title & Create Button -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Product List</h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm px-3 rounded-pill fw-semibold text-white shadow-sm border-0" style="background-color: #F43F5E;">
                    <i class="fa-solid fa-plus me-1"></i> Create New
                </a>
            </div>

            <!-- Entries dropdown & Search -->
            <div class="d-flex justify-content-between align-items-center mb-4 text-muted small">
                <div class="d-flex align-items-center gap-2">
                    <span>Show</span>
                    <select id="entriesSelect" class="form-select form-select-sm rounded-3 shadow-none border-2" style="width: auto; border-color: #E2E8F0 !important;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entries</span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span>Search:</span>
                    <input type="text" id="searchInput" class="form-control form-control-sm rounded-3 shadow-none border-2" style="width: 200px; border-color: #E2E8F0 !important;" placeholder="Search products...">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive rounded-4 border" style="border-color: #E2E8F0 !important;">
                <table class="table table-hover align-middle small mb-0" id="productsTable">
                    <thead class="table-light text-uppercase text-secondary" style="background-color: #F8FAFC; font-size: 0.75rem;">
                        <tr>
                            <th class="py-3 px-4">Code</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Description</th>
                            <th class="text-center py-3">Image</th>
                            <th class="py-3">Price</th>
                            <th class="text-center py-3 px-4" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="product-row">
                                <!-- Code -->
                                <td class="py-3 px-4">
                                    <span class="badge px-2.5 py-1.5 fw-semibold font-monospace" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0;">
                                        {{ $product->code ?? str_pad($product->id, 6, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                <!-- Name -->
                                <td class="py-3 fw-semibold text-dark">
                                    {{ $product->name ?? $product->title ?? $product->product_name ?? 'N/A' }}
                                </td>

                                <!-- Description -->
                                <td class="py-3 text-secondary" style="max-width: 250px;">
                                    {{ Str::limit($product->description, 60) }}
                                </td>

                                <!-- Image -->
                                <td class="text-center py-3">
                                    <div style="width: 44px; height: 44px; margin: 0 auto;" class="d-flex align-items-center justify-content-center bg-light border rounded-3 overflow-hidden shadow-sm" style="border-color: #E2E8F0 !important;">
                                        @if($product->image)
                                            <img src="{{ $product->image_url }}" class="img-fluid w-100 h-100 object-fit-cover">
                                        @else
                                            <span class="text-muted" style="font-size: 9px;">No image</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="py-3 fw-bold" style="color: #F43F5E;">
                                    ${{ number_format($product->price ?? $product->selling_price ?? 0, 2) }}
                                </td>

                                <!-- Action Buttons -->
                                <td class="text-center py-3 px-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm py-1 px-3 rounded-pill fw-semibold border-2" style="font-size: 0.75rem;">Edit</a>
                                        
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-3 rounded-pill fw-semibold border-2" style="font-size: 0.75rem;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">No products found in the database.</td>
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
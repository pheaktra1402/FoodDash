@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-body p-4">

            <!-- Title & Create Button -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Category List</h2>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-sm px-3 rounded-pill fw-semibold text-white shadow-sm border-0" style="background-color: #F43F5E;">
                    <i class="fa-solid fa-plus me-1"></i> Create New
                </a>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert" style="background-color: #ECFDF5; color: #065F46;">
                    {{ session('success') }}
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                    <input type="text" id="searchInput" class="form-control form-control-sm rounded-3 shadow-none border-2" style="width: 200px; border-color: #E2E8F0 !important;" placeholder="Search categories...">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive rounded-4 border" style="border-color: #E2E8F0 !important;">
                <table class="table table-hover align-middle small mb-0" id="categoriesTable">
                    <thead class="table-light text-uppercase text-secondary" style="background-color: #F8FAFC; font-size: 0.75rem;">
                        <tr>
                            <th class="py-3 px-4" style="width: 80px;">#</th>
                            <th class="py-3">Category Code</th>
                            <th class="py-3">Category Name</th>
                            <th class="py-3">Created At</th>
                            <th class="text-center py-3 px-4" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                            <tr class="category-row">
                                <!-- Index -->
                                <td class="py-3 px-4 fw-bold text-secondary">
                                    {{ $key + 1 }}
                                </td>

                                <!-- Category Code -->
                                <td class="py-3">
                                    <span class="badge px-2.5 py-1.5 fw-semibold font-monospace" style="background-color: #F1F5F9; color: #475569; border: 1px solid #E2E8F0;">
                                        {{ $category->category_code }}
                                    </span>
                                </td>

                                <!-- Category Name -->
                                <td class="py-3 fw-semibold text-dark">
                                    {{ $category->category_name }}
                                </td>

                                <!-- Created At -->
                                <td class="py-3 text-secondary">
                                    {{ $category->created_at ? $category->created_at->format('M d, Y') : 'N/A' }}
                                </td>

                                <!-- Action Buttons -->
                                <td class="text-center py-3 px-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-primary btn-sm py-1 px-3 rounded-pill fw-semibold border-2" style="font-size: 0.75rem;">Edit</a>
                                        
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-3 rounded-pill fw-semibold border-2" style="font-size: 0.75rem;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">No categories found in the database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if(method_exists($categories, 'links'))
                <div class="mt-4 d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const entriesSelect = document.getElementById('entriesSelect');
        const rows = document.querySelectorAll('.category-row');

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
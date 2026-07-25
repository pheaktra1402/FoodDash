<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4" x-data="{ addModal: false, editModal: false, editData: {} }">

        <!-- Header Bar -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Products Management</h1>
                <p class="text-xs text-slate-500">Manage your inventory, prices, and product categories.</p>
            </div>
            
            <button @click="addModal = true" class="bg-black hover:bg-slate-800 text-white text-xs font-semibold px-5 py-3 rounded-full transition flex items-center gap-2 shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Product
            </button>
        </div>

        <!-- 🟢 Auto-hiding Session Alert -->
        @if (session('status'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="mb-4 text-center text-sm font-semibold text-emerald-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Product Table -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-100">
                        <tr>
                            <th class="p-4 px-6">Image</th>
                            <th class="p-4 px-6">Product Details</th>
                            <th class="p-4 px-6">Category</th>
                            <th class="p-4 px-6">Prices</th>
                            <th class="p-4 px-6">Stock</th>
                            <th class="p-4 px-6">Status</th>
                            <th class="p-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50/50">
                                <!-- Image -->
                                <td class="p-4 px-6">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="w-10 h-10 rounded-2xl object-cover border border-slate-200">
                                    @else
                                        <div class="w-10 h-10 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center text-xs">N/A</div>
                                    @endif
                                </td>

                                <!-- Product Name & Code -->
                                <td class="p-4 px-6">
                                    <div class="font-bold text-slate-900">{{ $product->product_name }}</div>
                                    <div class="text-xs text-slate-400 font-mono">Code: {{ $product->product_code }} | {{ $product->barcode }}</div>
                                </td>

                                <!-- Category -->
                                <td class="p-4 px-6 font-medium text-slate-700">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </td>

                                <!-- Prices -->
                                <td class="p-4 px-6">
                                    <div class="font-bold text-emerald-600">${{ number_format($product->selling_price, 2) }}</div>
                                    <div class="text-xs text-slate-400 line-through">${{ number_format($product->cost_price, 2) }}</div>
                                </td>

                                <!-- Stock Quantity -->
                                <td class="p-4 px-6">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $product->stock_qty > 10 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                        {{ $product->stock_qty }} in stock
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="p-4 px-6">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold tracking-wide uppercase {{ $product->status === 'active' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $product->status }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="p-4 px-6 text-right space-x-3">
                                    <button @click="editModal = true; editData = {{ json_encode($product) }}" class="text-xs font-semibold text-slate-700 hover:underline">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-rose-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ➕ ADD PRODUCT MODAL -->
        <div x-show="addModal" x-cloak class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-2xl w-full shadow-2xl overflow-y-auto max-h-[90vh]" @click.away="addModal = false">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Add New Product</h3>
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Product Name</label>
                            <input type="text" name="product_name" required placeholder="e.g. Coca Cola 330ml" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Category</label>
                            <select name="category_id" required class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Product Code</label>
                            <input type="text" name="product_code" required placeholder="PRD-001" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Barcode</label>
                            <input type="text" name="barcode" placeholder="1234567890" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Cost Price ($)</label>
                            <input type="number" step="0.01" name="cost_price" required placeholder="0.50" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Selling Price ($)</label>
                            <input type="number" step="0.01" name="selling_price" required placeholder="1.00" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Stock Quantity</label>
                            <input type="number" name="stock_qty" required placeholder="100" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Status</label>
                            <select name="status" class="w-full rounded-full border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Description</label>
                        <textarea name="description" rows="2" placeholder="Product details..." class="w-full rounded-2xl border border-slate-300 px-5 py-2.5 text-sm focus:outline-none focus:border-slate-900"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1 px-4">Product Image</label>
                        <input type="file" name="image" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" />
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" @click="addModal = false" class="px-5 py-2.5 text-xs font-semibold text-slate-500">Cancel</button>
                        <button type="submit" class="bg-black text-white px-6 py-2.5 rounded-full text-xs font-semibold hover:bg-slate-800 transition">Save Product</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
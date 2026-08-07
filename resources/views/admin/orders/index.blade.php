@php
    $orders = $orders ?? collect();
@endphp
@extends('layouts.backend')

@section('admin-content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-4 bg-white" style="border: 1px solid #E2E8F0 !important;">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom" style="border-color: #E2E8F0 !important;">
                <h2 class="h3 mb-0 text-dark fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Orders List</h2>
            </div>

            <!-- Filter / Search Header -->
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
                    <input type="text" id="searchInput" class="form-control form-control-sm rounded-3 shadow-none border-2" style="width: 200px; border-color: #E2E8F0 !important;" placeholder="Search orders...">
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive rounded-4 border" style="border-color: #E2E8F0 !important;">
                <table class="table table-hover align-middle small mb-0">
                    <thead class="table-light text-uppercase text-secondary" style="background-color: #F8FAFC; font-size: 0.75rem;">
                        <tr>
                            <th class="py-3 px-4">Order ID</th>
                            <th class="py-3">Customer</th>
                            <th class="py-3">Total Price</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Date</th>
                            <th class="text-center py-3 px-4" style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="order-row">
                                <td class="py-3 px-4">
                                    <span class="fw-bold text-dark">
                                        #{{ sprintf('%05d', $order->id) }}
                                    </span>
                                </td>
                                <td class="py-3 text-secondary">
                                    {{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}
                                </td>
                                <td class="py-3 fw-bold" style="color: #F43F5E;">
                                    ${{ number_format($order->total_price ?? $order->total ?? 0, 2) }}
                                </td>
                                <td class="py-3">
                                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm fw-semibold shadow-none py-1 px-3 rounded-pill border-0 text-white
                                            {{ $order->status === 'completed' ? 'bg-success' : ($order->status === 'cancelled' ? 'bg-danger' : 'bg-warning text-dark') }}"
                                            style="width: auto; font-size: 0.75rem;">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="text-center py-3 px-4">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm px-3 rounded-pill fw-semibold text-white border-0 shadow-sm" style="background-color: #F43F5E; font-size: 0.75rem;">View Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($orders, 'links'))
                <div class="mt-4 d-flex justify-content-end">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
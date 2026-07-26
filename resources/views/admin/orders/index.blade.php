@php
    $orders = $orders ?? collect();
@endphp
@extends('layouts.backend')

@section('admin-content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-dark fw-bold">Orders List</h2>
        </div>

        <!-- Filter / Search Header -->
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
                <input type="text" id="searchInput" class="form-control form-control-sm" style="width: 150px;" placeholder="Search orders...">
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle small mb-0">
                <thead>
                    <tr class="table-dark-header">
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center" style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="order-row">
                            <td>
                                <span class="fw-bold text-dark">
                                    #{{ sprintf('%05d', $order->id) }}
                                </span>
                            </td>
                            <td>
                                {{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}
                            </td>
                            <td class="fw-bold text-success">
                                ${{ number_format($order->total_price ?? $order->total ?? 0, 2) }}
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm fw-semibold border-0 bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }} text-white py-0 px-2" style="width: auto;">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-muted">
                                {{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm py-0 px-2">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No orders found.</td>
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
@endsection
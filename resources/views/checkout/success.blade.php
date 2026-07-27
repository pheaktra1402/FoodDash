@extends('layouts.frontend')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="card text-center p-5 shadow-sm border-0 w-100" style="max-width: 500px;">
        <div class="card-body">
            <h1 class="text-success mb-3">🎉 Success!</h1>
            <p class="lead text-dark">Your order has been placed successfully.</p>
            <p class="text-muted small mb-4">We are processing your order and will deliver it to your pinned location soon.</p>
            <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2">Back to Home</a>
        </div>
    </div>
</div>
@endsection
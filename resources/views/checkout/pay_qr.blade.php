@extends('layouts.frontend')

@section('content')
<div class="bg-light py-5">
    <div class="container">

        <!-- Progress Steps -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center position-relative">
                    <div class="progress position-absolute w-100" style="height: 3px; top: 50%; z-index: 1;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"></div>
                    </div>
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2;">
                        3
                    </div>
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2;">
                        4
                    </div>
                </div>
                <div class="d-flex justify-content-between text-muted small mt-2 fw-semibold">
                    <span class="text-success">Cart</span>
                    <span class="text-success">Checkout</span>
                    <span class="text-primary fw-bold">Pay QR</span>
                    <span>Complete</span>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10">
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                        <strong>Error submitting receipt:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center g-4">
            <!-- Left Column: Order Summary & How to Pay -->
            <div class="col-lg-5 col-md-6">
                <!-- Order Summary Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-dark text-white p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-warning text-dark mb-1 font-monospace">Order #{{ $order->id }}</span>
                                <h4 class="mb-0 fw-bold text-white">Order Details</h4>
                            </div>
                            <i class="fa-solid fa-receipt fs-1 opacity-25"></i>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                            <span class="text-muted">Total Amount Due</span>
                            <span class="fs-2 fw-bolder text-danger">${{ number_format($order->total_price, 2) }}</span>
                        </div>

                        <div class="vstack gap-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="fa-regular fa-user me-2"></i>Customer:</span>
                                <span class="fw-semibold">{{ $order->customer_name ?? auth()->user()->name }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="fa-regular fa-clock me-2"></i>Date:</span>
                                <span class="fw-semibold">{{ $order->created_at ? $order->created_at->format('M d, Y H:i') : date('M d, Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted"><i class="fa-solid fa-credit-card me-2"></i>Payment Method:</span>
                                <span class="badge bg-primary-subtle text-primary fw-bold">{{ $order->payment_method ?? 'Scan QR Code' }}</span>
                            </div>
                            @if($order->shipping_address)
                                <div class="mt-2 pt-2 border-top">
                                    <span class="text-muted d-block mb-1"><i class="fa-solid fa-location-dot me-2 text-danger"></i>Delivery Address:</span>
                                    <small class="fw-semibold text-dark">{{ $order->shipping_address }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Step-by-Step Instructions -->
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-info text-primary"></i> How to Pay with KHQR
                    </h5>
                    <div class="vstack gap-3">
                        <div class="d-flex align-items-start gap-3">
                            <div class="badge bg-primary rounded-circle p-2 px-3 fw-bold fs-6">1</div>
                            <div>
                                <strong class="d-block text-dark">Open Mobile Banking App</strong>
                                <small class="text-muted">Launch ABA Mobile, Bakong, Wing, ACLEDA, or any KHQR supported app.</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <div class="badge bg-primary rounded-circle p-2 px-3 fw-bold fs-6">2</div>
                            <div>
                                <strong class="d-block text-dark">Scan the QR Code</strong>
                                <small class="text-muted">Point your app camera at the KHQR code shown on the right.</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <div class="badge bg-primary rounded-circle p-2 px-3 fw-bold fs-6">3</div>
                            <div>
                                <strong class="d-block text-dark">Confirm & Upload Receipt</strong>
                                <small class="text-muted">Confirm <strong>${{ number_format($order->total_price, 2) }}</strong> transfer, save the transaction screenshot, and upload it below.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: QR Code & Receipt Upload -->
            <div class="col-lg-5 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden text-center bg-white">
                    <!-- KHQR Header Banner -->
                    <div class="bg-danger text-white py-3 px-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-qrcode fs-3"></i>
                            <span class="fw-bold tracking-wide text-uppercase fs-5">KHQR Payment</span>
                        </div>
                        <span class="badge bg-white text-danger fw-bold rounded-pill px-3 py-1">Instant Pay</span>
                    </div>

                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Scan with any Cambodian Mobile Banking App</p>

                        <!-- QR Code Container -->
                        <div class="position-relative d-inline-block p-3 bg-light rounded-4 border mb-3 shadow-sm" style="max-width: 280px;">
                            @if(file_exists(public_path('img/qr_pay.jpg')))
                                <img src="{{ asset('img/qr_pay.jpg') }}" alt="KHQR Payment Code" class="img-fluid rounded-3" style="max-height: 250px; width: 100%; object-fit: contain;">
                            @else
                                <div class="bg-white p-4 text-center rounded-3 border">
                                    <i class="fa-solid fa-qrcode fa-5x text-secondary mb-2"></i>
                                    <p class="small text-muted mb-0">QR Code Image</p>
                                </div>
                            @endif
                            <div class="mt-2 pt-2 border-top">
                                <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill shadow-sm">
                                    Total: ${{ number_format($order->total_price, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Upload Receipt Form -->
                        <div class="bg-light p-4 rounded-4 border text-start mt-3">
                            <h6 class="fw-bold mb-2 text-dark d-flex align-items-center gap-2">
                                <i class="fa-solid fa-cloud-arrow-up text-success fs-5"></i>
                                Upload Payment Receipt
                            </h6>
                            <p class="text-muted small mb-3">Upload your transfer screenshot so we can verify your payment quickly.</p>

                            <form action="{{ route('payment.submit_proof', $order->id) }}" method="POST" enctype="multipart/form-data" id="upload-form">
                                @csrf
                                <div class="mb-3">
                                    <label for="payment_proof" class="form-label fw-semibold small">Choose Receipt File / Photo:</label>
                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control form-control-lg border-2" accept="image/*" required onchange="previewImage(event)">
                                </div>

                                <!-- Image Preview Container -->
                                <div id="preview-container" class="mb-3 text-center d-none">
                                    <p class="small text-muted mb-1">Receipt Preview:</p>
                                    <img id="image-preview" src="#" alt="Receipt Preview" class="img-thumbnail rounded-3 shadow-sm" style="max-height: 180px; object-fit: contain;">
                                </div>

                                <button type="submit" id="btn-completed" class="btn btn-success btn-lg w-100 py-3 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span>Submit Payment Proof & Complete</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 py-3 text-muted small">
                        <i class="fa-solid fa-lock me-1 text-success"></i> Secure 256-bit Encrypted Payment
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('image-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('d-none');
        }
    }

    document.getElementById('upload-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('btn-completed');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting Proof...';
        btn.classList.add('disabled');
    });
</script>
@endsection
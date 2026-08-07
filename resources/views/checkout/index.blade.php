@extends('layouts.frontend')

@section('content')
    <!-- Leaflet CSS for proper map rendering -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        .btn-custom-pink {
            background-color: #F43F5E;
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-custom-pink:hover {
            background-color: #E11D48;
            color: #fff;
            transform: translateY(-1px);
        }

        .checkout-card {
            border: 1px solid #E2E8F0 !important;
            background: #FFFFFF;
        }
    </style>

    <div class="bg-light py-5">
        <div class="container py-3">

            <!-- Progress Steps -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center position-relative">
                        <div class="progress position-absolute w-100" style="height: 3px; top: 50%; z-index: 1; background-color: #E2E8F0;">
                            <div class="progress-bar" role="progressbar" style="width: 50%; background-color: #F43F5E;"></div>
                        </div>
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #F43F5E;">
                            2
                        </div>
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #CBD5E1 !important;">
                            3
                        </div>
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; z-index: 2; background-color: #CBD5E1 !important;">
                            4
                        </div>
                    </div>
                    <div class="d-flex justify-content-between text-muted small mt-2 fw-semibold">
                        <span style="color: #F43F5E !important;">Cart</span>
                        <span class="fw-bold" style="color: #F43F5E !important;">Checkout</span>
                        <span class="text-secondary">Pay QR</span>
                        <span class="text-secondary">Complete</span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="fw-bold text-dark" style="font-family: 'Plus Jakarta Sans', sans-serif;">Checkout Page</h2>
                <p class="text-muted mb-0">Welcome back, <strong class="text-dark">{{ $user->name }}</strong>!</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-4 rounded-4 shadow-sm border-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- Left Side: Map & Address Information -->
                    <div class="col-lg-7">
                        <div class="card checkout-card border-0 shadow-sm p-4 rounded-4 h-100">
                            <h4 class="fw-bold text-dark mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">Delivery Location</h4>
                            
                            <!-- Map Section -->
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">Pin your Delivery Location on the Map:</label>
                                <div id="map" style="height: 350px; width: 100% !important; border-radius: 12px;" class="mb-2 border"></div>
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    <i class="fa-solid fa-circle-info me-1"></i>Click anywhere on the map to automatically pin your delivery coordinates and update your address.
                                </small>
                            </div>

                            <!-- Hidden Coordinates -->
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">

                            <!-- Shipping Address -->
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label small fw-semibold text-secondary">Selected Address / Street Details</label>
                                <input type="text" class="form-control rounded-3 py-2 shadow-none border-2" id="shipping_address" name="shipping_address"
                                    placeholder="Click on the map or type address..." required style="border-color: #E2E8F0 !important;">
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Payment Methods & Order Placement -->
                    <div class="col-lg-5">
                        <div class="card checkout-card border-0 shadow-sm p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="fw-bold text-dark mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">Payment Details</h4>

                                <!-- Payment Method Selection -->
                                <div class="mb-4">
                                    <label for="payment_method" class="form-label small fw-semibold text-secondary">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-select rounded-3 py-2 shadow-none border-2"
                                        onchange="togglePaymentSection(this.value)" required style="border-color: #E2E8F0 !important;">
                                        <option value="Cash on Delivery">Cash on Delivery</option>
                                        <option value="QR Code">Scan QR Code to Pay</option>
                                    </select>
                                </div>

                                <!-- QR Code Section -->
                                <div id="qr-section" class="mb-4 alert rounded-4 p-3 border-0 shadow-sm" style="display: none; background-color: #FFF1F2; color: #E11D48; border: 1px solid #FDA4AF !important;">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-qrcode fs-5 mt-1"></i>
                                        <div class="small">
                                            You will be redirected to scan the dynamic KHQR code for your order after clicking <strong class="text-dark">Place Order</strong>.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-custom-pink btn-lg w-100 py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Place Order</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([11.5564, 104.9282], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = null;

        map.whenReady(function () {
            setTimeout(function () {
                map.invalidateSize();
            }, 200);
        });

        map.on('click', function (e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`, {
                headers: { 'User-Agent': 'FoodDeliveryApp/1.0' }
            })
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        document.getElementById('shipping_address').value = data.display_name;
                    } else {
                        document.getElementById('shipping_address').value = `Lat: ${lat}, Lng: ${lng}`;
                    }
                })
                .catch(error => {
                    console.error('Geocoding error:', error);
                    document.getElementById('shipping_address').value = `Lat: ${lat}, Lng: ${lng}`;
                });
        });

        function togglePaymentSection(value) {
            var qrSection = document.getElementById('qr-section');
            var receiptInput = document.getElementById('payment_receipt');

            if (value === 'QR Code') {
                qrSection.style.display = 'block';
                if (receiptInput) receiptInput.setAttribute('required', 'required');
            } else {
                qrSection.style.display = 'none';
                if (receiptInput) {
                    receiptInput.removeAttribute('required');
                    receiptInput.value = '';
                }
            }
        }
    </script>
@endsection
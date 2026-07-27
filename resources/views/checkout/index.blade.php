@extends('layouts.frontend')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Checkout Page</h2>
        <p class="text-muted">Welcome, <strong>{{ $user->name }}</strong>!</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Map Section -->
            <div class="mb-3">
                <label class="form-label fw-bold">Pin your Delivery Location on the Map:</label>
                <div id="map" style="height: 400px; width: 100% !important; border-radius: 8px;" class="mb-2 border"></div>
                <small class="text-muted">Click anywhere on the map to automatically pin your delivery coordinates and update your address.</small>
            </div>

            <!-- Hidden Coordinates -->
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

            <!-- Shipping Address -->
            <div class="mb-3">
                <label for="shipping_address" class="form-label fw-bold">Selected Address / Street Details</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                    placeholder="Click on the map or type address..." required>
            </div>

            <!-- Payment Method Selection -->
            <div class="mb-3">
                <label for="payment_method" class="form-label fw-bold">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-select"
                    onchange="togglePaymentSection(this.value)" required>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="QR Code">Scan QR Code to Pay</option>
                </select>
            </div>

            <!-- QR Code Section (Hidden by default) -->
            <div id="qr-section" class="mb-4 text-center p-3 bg-white border rounded shadow-sm" style="display: none;">
                <p class="fw-bold mb-2">Scan this QR Code with your Banking App:</p>
                <img src="{{ asset('img/qr_pay.jpg') }}" alt="Payment QR Code" style="max-width: 180px; height: auto;"
                    class="mb-3 border p-1">
                <p class="text-muted small mb-2">Upload payment receipt screenshot after transfer:</p>
                <input type="file" name="payment_receipt" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Place Order</button>
        </form>
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
            if (value === 'QR Code') {
                qrSection.style.display = 'block';
                setTimeout(function () {
                    map.invalidateSize();
                }, 100);
            } else {
                qrSection.style.display = 'none';
            }
        }
    </script>
@endsection
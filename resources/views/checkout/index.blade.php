<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1>Checkout Page</h1>
    <p>Welcome, {{ $user->name }}!</p>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
        </div>
        
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <input type="text" class="form-control" id="payment_method" name="payment_method" value="Cash on Delivery" required>
        </div>
        <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Pin your Delivery Location on the Map:</label>
        <!-- Map Element -->
        <div id="map" style="height: 400px; width: 100%; border-radius: 8px;" class="mb-2"></div>
        <small class="text-muted">Click anywhere on the map to set your location.</small>
    </div>

    <!-- Hidden inputs to send coordinates to your controller -->
    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">

    <div class="mb-3">
        <label for="shipping_address" class="form-label">Selected Address / Details</label>
        <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Click map or type street info" required>
    </div>
    
    <div class="mb-3">
        <label for="payment_method" class="form-label">Payment Method</label>
        <input type="text" class="form-control" id="payment_method" name="payment_method" value="Cash on Delivery" required>
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
</form>
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</body>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</html>
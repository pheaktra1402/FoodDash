<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
// Controllers
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TelegramWebhookController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes (Accessible by everyone)
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    $featuredProducts = Product::take(4)->get();
    return view('welcome', compact('featuredProducts'));
})->name('home');

// About & Contact
Route::get('/about', function () {
    return view('profile.about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public Product Views
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('checkout.process');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Checkout, Profile & Orders)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Redirect
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->middleware('verified')->name('dashboard');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/buy', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Payment & QR Code Routes
    Route::get('/checkout/pay-qr/{order}', [PaymentController::class, 'showQrPage'])->name('payment.qr');
    Route::get('/checkout/check-status/{order}', [PaymentController::class, 'checkStatus'])->name('payment.check-status');
    Route::post('/payment/submit-proof/{order}', [OrderController::class, 'submitPaymentProof'])->name('payment.submit_proof');

    // User Orders & Status
    Route::get('/orders/success/{id}', [OrderController::class, 'orderSuccess'])->name('orders.success');
    Route::get('/orders/{id}/check-payment-status', [OrderController::class, 'checkPaymentStatus']);
    Route::get('/orders/{id}/pay', [OrderController::class, 'showPaymentQr']);
});


/*
|--------------------------------------------------------------------------
| Telegram Webhook Route (Exempt from CSRF)
|--------------------------------------------------------------------------
*/
Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handleWebhook']);


/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products Management
    Route::resource('products', AdminProductController::class);

    // Category Routes
    Route::resource('categories', CategoryController::class);

    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{id}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('admin.orders.confirm-payment');
});

Route::prefix('admin')->name('admin.')->group(function () {
  
    Route::post('/orders/{id}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirm-payment');
});

require __DIR__ . '/auth.php';
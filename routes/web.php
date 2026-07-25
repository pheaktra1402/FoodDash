<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;


Route::get('/dashboard', function () {
    return redirect()-> route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// -------------------------------------------------------------
// 🌐 PUBLIC ROUTES (Visitor ចូលមើលបានទាំងអស់ ដោយមិនបាច់ Login)
// -------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::get('/about', function () {
    return view('about');
})->name('about');
// -------------------------------------------------------------
// 🔒 PROTECTED ROUTES (ទាមទារឱ្យ Login ជាមុនសិន)
// -------------------------------------------------------------
// Route::middleware(['auth'])->group(function () {

//     // បើ Visitor ព្យាយាមចុច Link ទាំងអស់នេះ វានឹងរត់ទៅ Login Page ដោយស្វ័យប្រវត្តិ
//     Route::post('/cart/add/{id}', [CheckoutController::class, 'addToCart'])->name('cart.add');
//     Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
//     Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders');

// });




Route::middleware(['auth', 'CheckAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
});

require __DIR__ . '/auth.php';

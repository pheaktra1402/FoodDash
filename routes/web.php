<?php
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProductController;

/*
|--------------------------------------------------------------------------
| Public Routes (Accessible by everyone)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('profile.about');
})->name('about');
Route::get('/contact', function () {
    return view('profile.contact');
})->name('contact');

// User Product Views
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard (/admin and /admin/dashboard)
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [AdminProductController::class, 'dashboard'])->name('dashboard');

    // Products Management (/admin/products)
    Route::resource('products', AdminProductController::class);


    // Orders Management (/admin/orders)
    Route::get('/orders', function () {
        return view('admin.orders.index');
    })->name('orders.index');

    // Category Routes
    Route::resource('categories', CategoryController::class);

    //order


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::patch('admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    });
});

require __DIR__ . '/auth.php';
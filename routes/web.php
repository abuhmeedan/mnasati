<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect root to products list
Route::get('/', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        // Replace with your actual admin route
        return redirect()->route('admin.orders.index');
    }

    return redirect('/products');
});

// Public route: product listing
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Auth routes (login, registration, password reset)
require __DIR__.'/auth.php';

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');

    // Checkout routes
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.process');

    // Order confirmation page
    Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');
});

// Admin routes protected by auth and admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [OrderAdminController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/refund', [OrderAdminController::class, 'refund'])->name('orders.refund');
});


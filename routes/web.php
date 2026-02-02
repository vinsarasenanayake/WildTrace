<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::middleware(['redirectAdmin'])->group(function () {

    // Publicly accessible pages for all visitors
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/journey', [PageController::class, 'journey'])->name('journey');
    Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
    Route::get('/product/{id}', [PageController::class, 'product'])->name('product.show');

    // Shopping cart and checkout process routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CartController::class, 'cancel'])->name('checkout.cancel');

    // Routes requiring user authentication
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/order/{order}/repay', [CartController::class, 'repay'])->name('order.repay');
    });
});

// Administrative panel routes for managing system content
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/photographers', [AdminController::class, 'photographers'])->name('photographers.index');
    Route::get('/photographers/create', [AdminController::class, 'photographersCreate'])->name('photographers.create');
    Route::get('/photographers/{photographer}/edit', [
        AdminController::class,
        'photographersEdit'
    ])->name('photographers.edit');

    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers.index');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/milestones', [AdminController::class, 'milestones'])->name('milestones.index');
    Route::get('/milestones/create', [AdminController::class, 'milestonesCreate'])->name('milestones.create');
    Route::get('/milestones/{milestone}/edit', [AdminController::class, 'milestonesEdit'])->name('milestones.edit');
});
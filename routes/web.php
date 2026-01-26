<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

// Public Routes
Route::middleware(['redirectAdmin'])->group(function () {

    // Pages
    Route::get('/', \App\Livewire\Home::class)->name('home');
    Route::get('/journey', \App\Livewire\Journey::class)->name('journey');
    Route::get('/gallery', \App\Livewire\Gallery::class)->name('gallery');
    Route::get('/product/{id}', \App\Livewire\ProductShow::class)->name('product.show');

    // Cart & Checkout
    Route::get('/cart', \App\Livewire\Cart::class)->name('cart.index');
    Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout.index');
    Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CartController::class, 'cancel'])->name('checkout.cancel');

    // User Dashboard
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
        Route::get('/order/{order}/repay', [CartController::class, 'repay'])->name('order.repay');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('dashboard');

    // Resources
    Route::get('/photographers', \App\Livewire\Admin\Photographers\Index::class)->name('photographers.index');
    Route::get('/photographers/create', \App\Livewire\Admin\Photographers\Create::class)->name('photographers.create');
    Route::get('/photographers/{photographer}/edit', \App\Livewire\Admin\Photographers\Edit::class)->name('photographers.edit');

    Route::get('/users', \App\Livewire\Admin\Users\Index::class)->name('users.index');

    Route::get('/subscribers', \App\Livewire\Admin\Subscribers\Index::class)->name('subscribers.index');

    Route::get('/orders', \App\Livewire\Admin\Orders\Index::class)->name('orders.index');

    Route::get('/products', \App\Livewire\Admin\Products\Index::class)->name('products.index');
    Route::get('/products/create', \App\Livewire\Admin\Products\Create::class)->name('products.create');
    Route::get('/products/{product}/edit', \App\Livewire\Admin\Products\Edit::class)->name('products.edit');

    Route::get('/milestones', \App\Livewire\Admin\Milestones\Index::class)->name('milestones.index');
    Route::get('/milestones/create', \App\Livewire\Admin\Milestones\Create::class)->name('milestones.create');
    Route::get('/milestones/{milestone}/edit', \App\Livewire\Admin\Milestones\Edit::class)->name('milestones.edit');
});

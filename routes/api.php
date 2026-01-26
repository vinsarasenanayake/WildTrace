<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Order;

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API endpoints
Route::get('/products', function () {
    return Product::all();
});

Route::get('/products/{id}', function ($id) {
    return Product::findOrFail($id);
});

// Protected API endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', function (Request $request) {
        return Order::where('user_id', $request->user()->id)->get();
    });
});

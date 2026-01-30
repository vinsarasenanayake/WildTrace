<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // List Items
    public function index(Request $request)
    {
        $cartItems = Cart::where('user_id', $request->user()->id)
            ->with('product.photographer')
            ->get();

        return response()->json($this->transformCartItems($cartItems));
    }

    // Add Item
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $request->quantity]);
        } else {
            $cartItem = Cart::create([
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id,
                'size' => $request->size,
                'quantity' => $request->quantity,
            ]);
        }

        $cartItem->load('product.photographer');

        // Transform Item
        $transformed = $this->transformCartItems(collect([$cartItem]))->first();

        return response()->json([
            'message' => 'Item added to cart',
            'cart_item' => $transformed
        ], 201);
    }

    // Update Quantity
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->update(['quantity' => $request->quantity]);
        $cartItem->load('product.photographer');

        $transformed = $this->transformCartItems(collect([$cartItem]))->first();

        return response()->json([
            'message' => 'Cart updated',
            'cart_item' => $transformed
        ]);
    }

    // Remove Item
    public function destroy(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

    // Clear Cart
    public function clear(Request $request)
    {
        Cart::where('user_id', $request->user()->id)->delete();

        return response()->json(['message' => 'Cart cleared']);
    }

    // Sync Cart
    public function sync(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.size' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $userId = $request->user()->id;

        // Clear Old
        Cart::where('user_id', $userId)->delete();

        // Add New
        foreach ($request->items as $item) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'size' => $item['size'] ?? null,
            ]);
        }

        $cartItems = Cart::where('user_id', $userId)
            ->with('product.photographer')
            ->get();

        return response()->json([
            'message' => 'Cart synced successfully',
            'cart' => $this->transformCartItems($cartItems)
        ]);
    }

    // Transform Collection
    private function transformCartItems($items)
    {
        return $items->map(function ($item) {
            $price = $item->product->price; // Base Price

            // Check Variant
            if ($item->size && isset($item->product->options['frames'])) {
                foreach ($item->product->options['frames'] as $frame) {
                    if ($frame['size'] === $item->size) {
                        $price = $frame['price'];
                        break;
                    }
                }
            }

            // Set Price
            $item->price = $price;
            return $item;
        });
    }
}

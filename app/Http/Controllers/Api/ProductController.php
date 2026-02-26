<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['data' => Product::with('photographer')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'photographer' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image_url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = Product::with('photographer')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'photographer' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'image_url' => 'sometimes|url',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function getPrice(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $size = $request->query('size');
        if (!$size) {
            return response()->json(['price' => $product->price]);
        }

        $options = $product->options;
        if (isset($options['frames'])) {
            foreach ($options['frames'] as $frame) {
                if ($frame['size'] === $size) {
                    return response()->json(['price' => $frame['price']]);
                }
            }
        }

        return response()->json(['price' => $product->price]);
    }
}

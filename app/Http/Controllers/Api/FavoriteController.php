<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    // Get Favorites
    public function index(Request $request)
    {
        $products = Favorite::where('user_id', $request->user()->id)
            ->with(['product.photographer'])
            ->get()
            ->pluck('product')
            ->filter();

        return response()->json(['data' => $products]);
    }

    // Toggle Favorite
    public function toggle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $userId = $request->user()->id;
        $productId = $request->product_id;

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            // Remove
            $favorite->delete();
            return response()->json([
                'message' => 'Removed from favorites',
                'is_favorite' => false
            ]);
        } else {
            // Add
            $favorite = Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            $favorite->load('product.photographer');

            return response()->json([
                'message' => 'Added to favorites',
                'is_favorite' => true,
                'favorite' => $favorite
            ], 201);
        }
    }

    // Check Status
    public function check(Request $request, $productId)
    {
        $isFavorite = Favorite::where('user_id', $request->user()->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['is_favorite' => $isFavorite]);
    }

    // Remove Item
    public function destroy(Request $request, $id)
    {
        $favorite = Favorite::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Removed from favorites']);
    }
}

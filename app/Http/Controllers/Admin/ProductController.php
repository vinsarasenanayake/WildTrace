<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('photographer')->latest()->get();
        return view('admin.dashboard', compact('products'))->with('title', 'Admin Dashboard');
    }

    public function create()
    {
        $photographers = \App\Models\Photographer::all();
        return view('admin.products.create', compact('photographers'))->with('title', 'Add Artifact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'photographer_id' => 'required|exists:photographers,id',
            'image_file' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'description' => 'nullable',
            'long_description' => 'nullable',
            'location' => 'nullable',
            'aperture' => 'nullable',
            'shutter_speed' => 'nullable',
            'iso' => 'nullable',
            'focal_length' => 'nullable',
            'frame_price_1' => 'required|numeric|min:0',
            'frame_price_2' => 'required|numeric|min:0',
            'frame_price_3' => 'required|numeric|min:0',
            'frame_price_4' => 'required|numeric|min:0',
        ]);

        $imagePath = $request->file('image_file')->store('images/products', 'supabase');
        $validated['image_url'] = env('SUPABASE_PUBLIC_URL') . '/' . env('SUPABASE_BUCKET') . '/' . $imagePath;

        $validated['price'] = (float) $validated['frame_price_1'];

        $validated['options'] = [
            'frames' => [
                ['size' => '12 x 18 in', 'price' => (float) $validated['frame_price_1']],
                ['size' => '18 x 24 in', 'price' => (float) $validated['frame_price_2']],
                ['size' => '24 x 36 in', 'price' => (float) $validated['frame_price_3']],
                ['size' => '40 x 60 in', 'price' => (float) $validated['frame_price_4']],
            ],
        ];

        unset(
            $validated['frame_price_1'],
            $validated['frame_price_2'],
            $validated['frame_price_3'],
            $validated['frame_price_4'],
            $validated['image_file']
        );

        Product::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $photographers = \App\Models\Photographer::all();
        return view('admin.products.edit', compact('product', 'photographers'))->with('title', 'Edit Artifact');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'photographer_id' => 'required|exists:photographers,id',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'existing_image_url' => 'nullable|string',
            'description' => 'nullable',
            'long_description' => 'nullable',
            'location' => 'nullable',
            'aperture' => 'nullable',
            'shutter_speed' => 'nullable',
            'iso' => 'nullable',
            'focal_length' => 'nullable',
            'frame_price_1' => 'required|numeric|min:0',
            'frame_price_2' => 'required|numeric|min:0',
            'frame_price_3' => 'required|numeric|min:0',
            'frame_price_4' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('images/products', 'supabase');
            $validated['image_url'] = env('SUPABASE_PUBLIC_URL') . '/' . env('SUPABASE_BUCKET') . '/' . $imagePath;
        } else {
            $validated['image_url'] = $validated['existing_image_url'] ?? $product->image_url;
        }

        $validated['price'] = (float) $validated['frame_price_1'];

        $validated['options'] = [
            'frames' => [
                ['size' => '12 x 18 in', 'price' => (float) $validated['frame_price_1']],
                ['size' => '18 x 24 in', 'price' => (float) $validated['frame_price_2']],
                ['size' => '24 x 36 in', 'price' => (float) $validated['frame_price_3']],
                ['size' => '40 x 60 in', 'price' => (float) $validated['frame_price_4']],
            ],
        ];

        unset(
            $validated['frame_price_1'],
            $validated['frame_price_2'],
            $validated['frame_price_3'],
            $validated['frame_price_4'],
            $validated['image_file'],
            $validated['existing_image_url']
        );

        $product->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}

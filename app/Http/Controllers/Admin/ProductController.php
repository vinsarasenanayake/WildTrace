<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a complete list of all artifacts in the system
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.dashboard', compact('products'))->with('title', 'Admin Dashboard');
    }

    // Open the creation form for a new artifact
    public function create()
    {
        $photographers = \App\Models\Photographer::all();
        return view('admin.products.create', compact('photographers'))->with('title', 'Add Artifact');
    }

    // Validate and persist a new artifact record to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'photographer_id' => 'required|exists:photographers,id',
            'image_url' => 'required',
            'description' => 'nullable',
            'long_description' => 'nullable',
            'location' => 'nullable',
            'aperture' => 'nullable',
            'shutter_speed' => 'nullable',
            'iso' => 'nullable',
            'focal_length' => 'nullable',
            'options' => 'nullable',
        ]);

        if (is_null($validated['options'])) {
            $validated['options'] = [
                'frames' => [
                    ['size' => '12 x 18 in', 'price' => 90],
                    ['size' => '18 x 24 in', 'price' => 135],
                    ['size' => '24 x 36 in', 'price' => 180],
                    ['size' => '40 x 60 in', 'price' => 315]
                ]
            ];
        }

        Product::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    // Access the editing interface for an existing artifact
    public function edit(Product $product)
    {
        $photographers = \App\Models\Photographer::all();
        return view('admin.products.edit', compact('product', 'photographers'))->with('title', 'Edit Artifact');
    }

    // Apply updates to an existing artifact's information
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'photographer_id' => 'required|exists:photographers,id',
            'image_url' => 'required',
            'description' => 'nullable',
            'long_description' => 'nullable',
            'location' => 'nullable',
            'aperture' => 'nullable',
            'shutter_speed' => 'nullable',
            'iso' => 'nullable',
            'focal_length' => 'nullable',
            'options' => 'nullable',
        ]);

        $product->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }

    // Permanently remove an artifact from the inventory
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}

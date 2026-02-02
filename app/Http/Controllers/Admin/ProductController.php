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
        return view('admin.products.create')->with('title', 'Add Artifact');
    }

    // Validate and persist a new artifact record to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'photographer' => 'required',
            'image_url' => 'required|url',
            'description' => 'nullable',
        ]);

        Product::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    // Access the editing interface for an existing artifact
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'))->with('title', 'Edit Artifact');
    }

    // Apply updates to an existing artifact's information
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'photographer' => 'required',
            'image_url' => 'required|url',
            'description' => 'nullable',
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

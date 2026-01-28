<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.dashboard', compact('products'))->with('title', 'Admin Dashboard');
    }

    public function create()
    {
        return view('admin.products.create')->with('title', 'Add Artifact');
    }

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

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'))->with('title', 'Edit Artifact');
    }

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

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}

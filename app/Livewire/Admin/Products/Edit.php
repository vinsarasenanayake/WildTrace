<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Photographer;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    public Product $product;

    public $title;
    public $description;
    public $long_description;
    public $price;
    public $image; // Changed to simple string
    public $category;
    public $location;
    public $photographer_id;

    // Technical Specs
    public $aperture;
    public $shutter_speed;
    public $iso;
    public $focal_length;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'long_description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'required|string|max:255',
        'category' => 'required|string',
        'location' => 'nullable|string',
        'photographer_id' => 'required|exists:photographers,id',
        'aperture' => 'nullable|string',
        'shutter_speed' => 'nullable|string',
        'iso' => 'nullable|string',
        'focal_length' => 'nullable|string',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->long_description = $product->long_description;
        $this->price = $product->price;
        $this->image = $product->image_url;
        $this->category = $product->category;
        $this->location = $product->location;
        $this->photographer_id = $product->photographer_id;
        $this->aperture = $product->aperture;
        $this->shutter_speed = $product->shutter_speed;
        $this->iso = $product->iso;
        $this->focal_length = $product->focal_length;
    }

    public function save()
    {
        $this->validate();

        $this->product->title = $this->title;
        $this->product->description = $this->description;
        $this->product->long_description = $this->long_description;
        $this->product->price = $this->price;
        $this->product->image_url = $this->image;
        $this->product->category = $this->category;
        $this->product->location = $this->location;
        $this->product->photographer_id = $this->photographer_id;
        $this->product->aperture = $this->aperture;
        $this->product->shutter_speed = $this->shutter_speed;
        $this->product->iso = $this->iso;
        $this->product->focal_length = $this->focal_length;

        $this->product->save();

        return redirect()->route('admin.products.index')->with('message', 'Product updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.products.edit', [
            'photographers' => Photographer::orderBy('name')->get()
        ])->layout('layouts.admin');
    }
}

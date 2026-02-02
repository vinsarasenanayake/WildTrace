<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Photographer;

class Create extends Component
{
    // Public properties for product basic information
    public $title;
    public $description;
    public $long_description;
    public $price;
    public $image;
    public $category;
    public $location;
    public $photographer_id;

    // Technical specifications for the photography product
    public $aperture;
    public $shutter_speed;
    public $iso;
    public $focal_length;

    // Validation rules for product creation
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

    // Save the product to the database after validation
    public function save()
    {
        $this->validate();

        Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'long_description' => $this->long_description,
            'price' => $this->price,
            'image_url' => $this->image,
            'category' => $this->category,
            'location' => $this->location,
            'photographer_id' => $this->photographer_id,
            'aperture' => $this->aperture,
            'shutter_speed' => $this->shutter_speed,
            'iso' => $this->iso,
            'focal_length' => $this->focal_length,
        ]);

        return redirect()->route('admin.products.index')->with('message', 'Product created successfully.');
    }

    // Render the Livewire component view with the admin layout
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.create', [
            'photographers' => Photographer::orderBy('name')->get()
        ]);
    }
}

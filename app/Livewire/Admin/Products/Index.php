<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
    // Search query for filtering products
    public $search = '';

    // Remove a product from the database
    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }

    // Render the product list with search filtering
    #[Layout('layouts.admin')]
    public function render()
    {
        $products = Product::with('photographer')
            ->where('title', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.admin.products.index', [
            'products' => $products
        ]);
    }
}

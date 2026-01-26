<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
    public $search = '';

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }

    public function render()
    {
        $products = Product::with('photographer')
            ->where('title', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.admin.products.index', [
            'products' => $products
        ])->layout('layouts.admin');
    }
}

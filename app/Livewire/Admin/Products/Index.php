<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
    public $search = '';

    public function delete($id)
    {
        Product::find($id)->delete();
        $this->dispatch('notify', message: 'Product deleted successfully.', type: 'success');
    }

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

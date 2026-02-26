<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Layout;

class Home extends Component
{

    #[Layout('layouts.guest', ['title' => 'Home', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        $featuredProducts = \App\Models\Product::orderBy('price', 'desc')
            ->take(5)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'img' => asset($product->image_url),
                    'cat' => $product->category,
                    'loc' => $product->location,
                    'price' => $product->price,
                ];
            });

        return view('livewire.home', [
            'featuredProducts' => $featuredProducts
        ]);
    }
}

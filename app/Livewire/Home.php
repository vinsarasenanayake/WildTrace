<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email|unique:subscribers,email',
    ];

    public function subscribe()
    {
        $this->validate();

        \App\Models\Subscriber::create([
            'email' => $this->email
        ]);

        session()->flash('newsletter_success', 'Welcome to the pack! You are now subscribed.');
        $this->reset('email');
    }

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
        ])->layout('layouts.guest', ['title' => 'Home', 'hasFooter' => false, 'fullWidth' => true]);
    }
}

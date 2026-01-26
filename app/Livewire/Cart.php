<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function increment($id)
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity']++;
            session()->put('cart', $this->cart);
        }
    }

    public function decrement($id)
    {
        if (isset($this->cart[$id])) {
            if ($this->cart[$id]['quantity'] > 1) {
                $this->cart[$id]['quantity']--;
            }
            session()->put('cart', $this->cart);
        }
    }

    public function remove($id)
    {
        if (isset($this->cart[$id])) {
            unset($this->cart[$id]);
            session()->put('cart', $this->cart);
        }
    }

    public function clearCart()
    {
        $this->cart = [];
        session()->forget('cart');
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('gallery');
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.guest', ['title' => 'Cart', 'hasFooter' => false, 'fullWidth' => true]);
    }
}
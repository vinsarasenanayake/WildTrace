<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->refreshCart();
    }

    protected function refreshCart()
    {
        if (Auth::check()) {
            $dbCart = \App\Models\Cart::where('user_id', Auth::id())->with('product.photographer')->get();
            $sessionCart = [];
            foreach ($dbCart as $item) {
                if ($item->product) {
                    $cartKey = $item->product_id . '-' . \Illuminate\Support\Str::slug($item->size);


                    $variantPrice = $item->product->price;
                    if ($item->size && isset($item->product->options['frames'])) {
                        foreach ($item->product->options['frames'] as $frame) {
                            if ($frame['size'] === $item->size) {
                                $variantPrice = $frame['price'];
                                break;
                            }
                        }
                    }


                    $sessionCart[$cartKey] = [
                        "product_id" => $item->product_id,
                        "title" => $item->product->title . ($item->size ? ' (' . $item->size . ')' : ''),
                        "quantity" => $item->quantity,
                        "price" => $variantPrice,
                        "image" => asset($item->product->image_url),
                        "photographer" => $item->product->photographer ? ucwords(strtolower($item->product->photographer->name)) : 'Unknown',
                        "size" => $item->size
                    ];
                }
            }
            session()->put('cart', $sessionCart);
            $this->cart = $sessionCart;
        } else {
            $this->cart = session()->get('cart', []);
        }
    }

    public function increment($id)
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity']++;
            session()->put('cart', $this->cart);
            $this->syncItemWithDb($id);
        }
    }

    public function decrement($id)
    {
        if (isset($this->cart[$id])) {
            if ($this->cart[$id]['quantity'] > 1) {
                $this->cart[$id]['quantity']--;
                session()->put('cart', $this->cart);
                $this->syncItemWithDb($id);
            }
        }
    }

    public function remove($id)
    {
        if (isset($this->cart[$id])) {
            if (Auth::check()) {
                \App\Models\Cart::where('user_id', Auth::id())
                    ->where('product_id', $this->cart[$id]['product_id'])
                    ->where('size', $this->cart[$id]['size'])
                    ->delete();
            }
            unset($this->cart[$id]);
            session()->put('cart', $this->cart);
        }
    }

    public function clearCart()
    {
        if (Auth::check()) {
            \App\Models\Cart::where('user_id', Auth::id())->delete();
        }
        $this->cart = [];
        session()->forget('cart');
    }

    protected function syncItemWithDb($id)
    {
        if (Auth::check() && isset($this->cart[$id])) {
            $item = $this->cart[$id];
            \App\Models\Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $item['product_id'],
                    'size' => $item['size'] ?? null,
                ],
                ['quantity' => $item['quantity']]
            );
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('gallery');
    }

    #[Layout('layouts.guest', ['title' => 'Cart', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        return view('livewire.cart');
    }
}
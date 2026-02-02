<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Cart extends Component
{
    public $cart = [];

    // Load cart data from database or session on initialization
    public function mount()
    {
        $this->refreshCart();
    }

    // Refresh cart items and calculate totals
    protected function refreshCart()
    {
        if (Auth::check()) {
            // Pull from DB for authenticated users
            $dbCart = \App\Models\Cart::where('user_id', Auth::id())->with('product.photographer')->get();
            $sessionCart = [];
            foreach ($dbCart as $item) {
                if ($item->product) {
                    $cartKey = $item->product_id . '-' . \Illuminate\Support\Str::slug($item->size);

                    // START: Calculate variant price
                    $variantPrice = $item->product->price;
                    if ($item->size && isset($item->product->options['frames'])) {
                        foreach ($item->product->options['frames'] as $frame) {
                            if ($frame['size'] === $item->size) {
                                $variantPrice = $frame['price'];
                                break;
                            }
                        }
                    }
                    // END: Calculate variant price

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

    // Increase item quantity by one
    public function increment($id)
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity']++;
            session()->put('cart', $this->cart);
            $this->syncItemWithDb($id);
        }
    }

    // Decrease item quantity by one
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

    // Remove item from cart and database
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

    // Clear all items from cart
    public function clearCart()
    {
        if (Auth::check()) {
            \App\Models\Cart::where('user_id', Auth::id())->delete();
        }
        $this->cart = [];
        session()->forget('cart');
    }

    // Synchronize cart item with database for authenticated users
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

    // Log out user and redirect to gallery
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('gallery');
    }

    // Render the cart view with guest layout
    #[Layout('layouts.guest', ['title' => 'Cart', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        return view('livewire.cart');
    }
}
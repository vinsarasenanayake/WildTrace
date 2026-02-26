<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductShow extends Component
{

    public $product;

    #[Url(keep: true)]
    public $selectedSize;

    public $currentPrice;
    public $isFavorite = false;
    public $showLoginModal = false;
    public $relatedArtifacts = [];
    public $quantity = 1;


    public $loginEmail = '';
    public $loginPassword = '';
    public $showPassword = false;

    public function performLogin()
    {
        $this->validate([
            'loginEmail' => 'required|email',
            'loginPassword' => 'required',
        ]);

        if (Auth::validate(['email' => $this->loginEmail, 'password' => $this->loginPassword])) {
            $user = \App\Models\User::where('email', $this->loginEmail)->first();

            if ($user->is_admin) {
                $this->addError('loginEmail', 'Please use the admin portal to log in.');
                return;
            }

            Auth::login($user);
            session()->regenerate();
            return redirect()->to(request()->header('Referer'));
        } else {
            $this->addError('loginEmail', 'These credentials do not match our records.');
        }
    }

    public function closeLoginModal()
    {
        $this->showLoginModal = false;
        $this->reset(['loginEmail', 'loginPassword', 'showPassword']);
        $this->resetValidation();
    }

    public function mount($id)
    {
        $this->product = Product::with('photographer')->findOrFail($id);

        $defaultOption = $this->product->options['frames'][0] ?? ['size' => 'Default', 'price' => $this->product->price];

        if ($this->selectedSize) {
            $foundOption = null;
            foreach ($this->product->options['frames'] ?? [] as $option) {
                if ($option['size'] === $this->selectedSize) {
                    $foundOption = $option;
                    break;
                }
            }
            if ($foundOption) {
                $this->currentPrice = $foundOption['price'];
            } else {
                $this->selectedSize = $defaultOption['size'];
                $this->currentPrice = $defaultOption['price'];
            }
        } else {
            $this->selectedSize = $defaultOption['size'];
            $this->currentPrice = $defaultOption['price'];
        }

        if (Auth::check()) {
            $this->isFavorite = \App\Models\Favorite::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->exists();
        }

        $this->relatedArtifacts = Product::where('id', '!=', $this->product->id)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    public function selectSize($size, $price)
    {
        $this->selectedSize = $size;
        $this->currentPrice = $price;
        $this->quantity = 1;
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function toggleFavorite()
    {
        if (!Auth::check()) {
            $this->showLoginModal = true;
            return;
        }

        $fav = \App\Models\Favorite::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($fav) {
            $fav->delete();
            $this->isFavorite = false;
        } else {
            \App\Models\Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id
            ]);
            $this->isFavorite = true;
        }
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            $this->showLoginModal = true;
            return;
        }

        $id = $this->product->id;
        $cart = session()->get('cart', []);

        $cartKey = $id . '-' . Str::slug($this->selectedSize);

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $this->quantity;
        } else {
            $cart[$cartKey] = [
                "product_id" => $id,
                "title" => $this->product->title . ' (' . $this->selectedSize . ')',
                "quantity" => $this->quantity,
                "price" => $this->currentPrice,
                "image" => asset($this->product->image_url),
                "photographer" => $this->product->photographer ? ucwords(strtolower($this->product->photographer->name)) : 'Unknown',
                "size" => $this->selectedSize
            ];
        }

        session()->put('cart', $cart);

        if (Auth::check()) {
            $dbCart = \App\Models\Cart::firstOrNew([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'size' => $this->selectedSize,
            ]);
            $dbCart->quantity = ($dbCart->exists ? $dbCart->quantity : 0) + $this->quantity;
            $dbCart->save();
        }

        $this->dispatch('cartUpdated');

        return redirect()->route('cart.index')->with('success', 'Masterpiece added to your collection! Ready to proceed?');
    }

    #[Layout('layouts.guest', ['title' => 'Product Details', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        return view('livewire.product-show');
    }
}
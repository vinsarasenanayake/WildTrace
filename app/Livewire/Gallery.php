<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Gallery extends Component
{
    use WithPagination;

    public $photographer = '';
    public $category = '';
    public $sort = 'newest';
    public $email = '';

    public function mount()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
    }

    protected $rules = [
        'email' => 'required|email',
    ];

    public function subscribe()
    {
        $this->validate();
        session()->flash('newsletter_success', 'Welcome to the pack! You are now subscribed.');
        $this->reset('email');
    }

    // Reset pagination when filters update
    public function updatedPhotographer()
    {
        $this->resetPage();
    }
    public function updatedCategory()
    {
        $this->resetPage();
    }
    public function updatedSort()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['photographer', 'category', 'sort']);
        $this->resetPage();
    }

    public $showLoginModal = false;
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

    public function addToCart($productId)
    {
        if (!auth()->check()) {
            $this->showLoginModal = true;
            return;
        }

        // Add to DB Cart
        $cartItem = \App\Models\Cart::firstOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $productId],
            ['quantity' => 0]
        );
        $cartItem->increment('quantity');

        // Update Session Cart for Navbar Compatibility
        $cart = session()->get('cart', []);
        $product = Product::find($productId);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "product_id" => $productId,
                "title" => $product->title,
                "quantity" => 1,
                "price" => $product->options['frames'][0]['price'] ?? 0,
                "image" => $product->image_url,
                "photographer" => $product->photographer ? ucwords(strtolower($product->photographer->name)) : 'Unknown'
            ];
        }
        session()->put('cart', $cart);
    }

    public function toggleFavorite($productId)
    {
        if (!auth()->check()) {
            $this->showLoginModal = true;
            return;
        }

        $fav = \App\Models\Favorite::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($fav) {
            $fav->delete();
        } else {
            \App\Models\Favorite::create([
                'user_id' => auth()->id(),
                'product_id' => $productId
            ]);
        }
    }

    #[Layout('layouts.guest', ['title' => 'Gallery', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        $query = Product::with('photographer');

        if ($this->photographer) {
            $query->whereHas('photographer', function ($q) {
                $q->where('name', $this->photographer);
            });
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        switch ($this->sort) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            default: // newest
                $query->latest();
                break;
        }

        $userFavorites = auth()->check()
            ? \App\Models\Favorite::where('user_id', auth()->id())->pluck('product_id')->toArray()
            : [];

        return view('livewire.gallery', [
            'products' => $query->paginate(9),
            'userFavorites' => $userFavorites
        ]);
    }
}

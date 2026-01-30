<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Url;

use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Url(history: true)]
    public $activeTab = 'favorites';

    public function mount()
    {
        // Redirect admins to admin dashboard
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
    }

    #[Layout('layouts.guest', ['title' => 'Dashboard', 'hasFooter' => true, 'fullWidth' => true])]
    public function render()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->with('product.photographer')->get();
        $orders = $user->orders()->with('items.product')->latest()->get();

        return view('livewire.dashboard', [
            'favorites' => $favorites,
            'orders' => $orders,
            'user' => $user
        ]);
    }

    // Toggle Tab Logic
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    // Remove item from favorites
    public function removeFavorite($favoriteId)
    {
        $fav = \App\Models\Favorite::where('id', $favoriteId)->where('user_id', Auth::id())->first();
        if ($fav) {
            $fav->delete();
        }
    }

    // Cancel a pending order
    public function cancelOrder($orderId)
    {
        $order = \App\Models\Order::where('id', $orderId)->where('user_id', Auth::id())->first();
        if ($order && in_array($order->payment_status, ['pending', 'declined'])) {
            $order->status = 'declined';
            $order->save();
        }
    }
}

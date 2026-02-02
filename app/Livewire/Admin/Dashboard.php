<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Photographer;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    // Gather and return statistics for the dashboard
    #[Layout('layouts.admin')]
    public function render()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'subscribers' => \App\Models\Subscriber::count(),
            'revenue' => Order::where('payment_status', 'confirmed')->sum('total_price'),
            'recent_orders' => Order::with('user')->latest()->take(5)->get()
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats
        ]);
    }
}

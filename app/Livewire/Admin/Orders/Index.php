<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Order;

class Index extends Component
{
    use WithPagination;

    // Delete an order record
    public function delete($id)
    {
        Order::find($id)->delete();
        session()->flash('message', 'Order deleted successfully.');
    }

    // Render the order management table with latest orders first
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => Order::latest()->paginate(10)
        ]);
    }
}

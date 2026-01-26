<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        Order::find($id)->delete();
        session()->flash('message', 'Order deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => Order::latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}

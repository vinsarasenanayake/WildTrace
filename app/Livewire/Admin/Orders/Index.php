<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Order;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        Order::find($id)->delete();
        $this->dispatch('notify', message: 'The order record has been permanently removed from the system.', type: 'success');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => Order::latest()->paginate(10)
        ]);
    }
}

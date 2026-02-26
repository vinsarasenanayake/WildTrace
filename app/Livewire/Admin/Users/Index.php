<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        if ($id == Auth::id()) {
            return;
        }

        $user = User::findOrFail($id);

        foreach ($user->orders as $order) {
            $order->items()->delete();
            $order->delete();
        }

        $user->favorites()->delete();

        $user->delete();

        $this->dispatch('notify', message: 'User and all related data deleted successfully.', type: 'success');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::latest()->paginate(10)
        ]);
    }
}

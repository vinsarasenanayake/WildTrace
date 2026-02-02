<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    // Delete a user account, ensuring they aren't deleting themselves
    public function delete($id)
    {
        // Add logic to prevent deleting self or super admin
        if ($id == auth()->id()) {
            return;
        }

        $user = User::findOrFail($id);

        // Manually delete related data to fix foreign key constraint
        // Delete Orders and their items
        foreach ($user->orders as $order) {
            $order->items()->delete(); // Delete Order Items first
            $order->delete();          // Then delete the Order
        }

        // Delete Favorites
        $user->favorites()->delete();

        // Finally, delete the User
        $user->delete();

        session()->flash('message', 'User and all related data deleted successfully.');
    }

    // Render the user management list with pagination
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::latest()->paginate(10)
        ]);
    }
}

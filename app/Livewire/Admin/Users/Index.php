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
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
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

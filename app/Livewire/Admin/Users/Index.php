<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        // Add logic to prevent deleting self or super admin
        if ($id == auth()->id()) {
            return;
        }
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}

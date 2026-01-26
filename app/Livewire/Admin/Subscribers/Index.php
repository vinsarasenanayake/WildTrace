<?php

namespace App\Livewire\Admin\Subscribers;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Subscriber;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.subscribers.index', [
            'subscribers' => Subscriber::latest()->paginate(10)
        ])->layout('layouts.admin');
    }

    public function delete($id)
    {
        $subscriber = Subscriber::find($id);
        if ($subscriber) {
            $subscriber->delete();
            session()->flash('message', 'Subscriber removed successfully.');
        }
    }
}

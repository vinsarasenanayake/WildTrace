<?php

namespace App\Livewire\Admin\Milestones;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Milestone;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        Milestone::find($id)->delete();
        session()->flash('message', 'Milestone deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.milestones.index', [
            'milestones' => Milestone::paginate(10)
        ])->layout('layouts.admin');
    }
}

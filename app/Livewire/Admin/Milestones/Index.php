<?php

namespace App\Livewire\Admin\Milestones;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Milestone;

class Index extends Component
{
    use WithPagination;

    // Remove a milestone from the database
    public function delete($id)
    {
        Milestone::find($id)->delete();
        session()->flash('message', 'Milestone deleted successfully.');
    }

    // Render the list of milestones with pagination
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.milestones.index', [
            'milestones' => Milestone::paginate(10)
        ]);
    }
}

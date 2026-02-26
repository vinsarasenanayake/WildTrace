<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Journey extends Component
{
    #[Layout('layouts.guest', ['title' => 'Journey', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        return view('livewire.journey', [
            'photographers' => \App\Models\Photographer::all(),
            'milestones' => \App\Models\Milestone::orderBy('year', 'asc')->get()
        ]);
    }
}

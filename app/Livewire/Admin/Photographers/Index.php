<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Photographer;

class Index extends Component
{


    // Delete a photographer from the database
    public function delete($id)
    {
        $photographer = Photographer::find($id);
        if ($photographer) {
            $photographer->delete();
            session()->flash('message', 'Photographer deleted successfully.');
        }
    }

    // Render the list of all photographers
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.photographers.index', [
            'photographers' => Photographer::all()
        ]);
    }
}

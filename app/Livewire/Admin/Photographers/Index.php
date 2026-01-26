<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Photographer;

class Index extends Component
{


    public function delete($id)
    {
        $photographer = Photographer::find($id);
        if ($photographer) {
            $photographer->delete();
            session()->flash('message', 'Photographer deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.photographers.index', [
            'photographers' => Photographer::all()
        ])->layout('layouts.admin');
    }
}

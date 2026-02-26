<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Photographer;

class Index extends Component
{


    public function delete($id)
    {
        $photographer = Photographer::find($id);
        if ($photographer) {
            $photographer->delete();
            $this->dispatch('notify', message: 'Photographer deleted successfully.', type: 'success');
        }
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.photographers.index', [
            'photographers' => Photographer::all()
        ]);
    }
}

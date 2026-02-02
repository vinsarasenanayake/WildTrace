<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Photographer;

class Create extends Component
{
    public $name;
    public $profession;
    public $achievement;
    public $quote;
    public $post;
    public $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'profession' => 'required|string|max:255',
        'achievement' => 'nullable|string|max:255',
        'quote' => 'nullable|string|max:255',
        'post' => 'nullable|string|max:255',
        'image' => 'required|string|max:255',
    ];

    // Create a new photographer entry in the database
    public function save()
    {
        $this->validate();

        Photographer::create([
            'name' => $this->name,
            'profession' => $this->profession,
            'achievement' => $this->achievement,
            'quote' => $this->quote,
            'post' => $this->post,
            'image' => $this->image,
        ]);

        return redirect()->route('admin.photographers.index')->with('message', 'Photographer created successfully.');
    }

    // Render the create photographer form view
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.photographers.create');
    }
}

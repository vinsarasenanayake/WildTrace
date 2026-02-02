<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Photographer;

class Edit extends Component
{
    public Photographer $photographer;
    public $name;
    public $profession;
    public $achievement;
    public $quote;
    public $post;
    public $image; // Changed to simple string

    protected $rules = [
        'name' => 'required|string|max:255',
        'profession' => 'required|string|max:255',
        'achievement' => 'required|string|max:255',
        'quote' => 'required|string|max:255',
        'post' => 'required|string|max:255',
        'image' => 'required|string|max:255',
    ];

    // Initialize photographer data for editing
    public function mount(Photographer $photographer)
    {
        $this->photographer = $photographer;
        $this->name = $photographer->name;
        $this->profession = $photographer->profession;
        $this->achievement = $photographer->achievement;
        $this->quote = $photographer->quote;
        $this->post = $photographer->post;
        $this->image = $photographer->image;
    }

    // Update photographer details in the database
    public function save()
    {
        $this->validate();

        $this->photographer->name = $this->name;
        $this->photographer->profession = $this->profession;
        $this->photographer->achievement = $this->achievement;
        $this->photographer->quote = $this->quote;
        $this->photographer->post = $this->post;
        $this->photographer->image = $this->image;
        $this->photographer->save();

        return redirect()->route('admin.photographers.index')->with('message', 'Photographer updated successfully.');
    }

    // Render the edit photographer form view
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.photographers.edit');
    }
}

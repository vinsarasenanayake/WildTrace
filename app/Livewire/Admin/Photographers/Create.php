<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Photographer;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $profession;
    public $achievement;
    public $quote;
    public $post;
    public $photo;
    public $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'profession' => 'required|string|max:255',
        'achievement' => 'required|string|max:255',
        'quote' => 'required|string|max:255',
        'post' => 'required|string|max:255',
        'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->photo->store('images/photographers', 'public');

        Photographer::create([
            'name' => $this->name,
            'profession' => $this->profession,
            'achievement' => $this->achievement,
            'quote' => $this->quote,
            'post' => $this->post,
            'image' => 'storage/' . $path,
        ]);

        return redirect()->route('admin.photographers.index')->with('message', 'Photographer created successfully.');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.photographers.create');
    }
}

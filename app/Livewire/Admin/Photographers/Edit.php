<?php

namespace App\Livewire\Admin\Photographers;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Photographer;

class Edit extends Component
{
    use WithFileUploads;

    public Photographer $photographer;
    public $name;
    public $profession;
    public $achievement;
    public $quote;
    public $post;
    public $image;
    public $photo;

    protected $rules = [
        'name' => 'required|string|max:255',
        'profession' => 'required|string|max:255',
        'achievement' => 'required|string|max:255',
        'quote' => 'required|string|max:255',
        'post' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
    ];

    public function mount(Photographer $photographer)
    {
        $this->photographer = $photographer;
        $this->name = $photographer->name;
        $this->profession = $photographer->profession;
        $this->achievement = $photographer->achievement;
        $this->quote = $photographer->quote;
        $this->post = $photographer->post;
        $this->image = $photographer->image; // existing path for preview
    }

    public function save()
    {
        $this->validate();

        if ($this->photo) {
            $path = $this->photo->store('images/photographers', 'supabase');
            $this->photographer->image = env('SUPABASE_PUBLIC_URL') . '/' . env('SUPABASE_BUCKET') . '/' . $path;
        }

        $this->photographer->name = $this->name;
        $this->photographer->profession = $this->profession;
        $this->photographer->achievement = $this->achievement;
        $this->photographer->quote = $this->quote;
        $this->photographer->post = $this->post;
        $this->photographer->save();

        return redirect()->route('admin.photographers.index')->with('message', 'Photographer updated successfully.');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.photographers.edit');
    }
}

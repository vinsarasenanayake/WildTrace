<?php

namespace App\Livewire\Admin\Milestones;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Milestone;

class Edit extends Component
{
    public Milestone $milestone;
    public $year;
    public $title;
    public $description;

    protected $rules = [
        'year' => 'required|string|max:4',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function mount(Milestone $milestone)
    {
        $this->milestone = $milestone;
        $this->year = $milestone->year;
        $this->title = $milestone->title;
        $this->description = $milestone->description;
    }

    public function save()
    {
        $this->validate();

        $this->milestone->update([
            'year' => $this->year,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return redirect()->route('admin.milestones.index')->with('message', 'Milestone updated successfully.');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.milestones.edit');
    }
}

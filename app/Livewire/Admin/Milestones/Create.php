<?php

namespace App\Livewire\Admin\Milestones;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Milestone;

class Create extends Component
{
    public $year;
    public $title;
    public $description;

    protected $rules = [
        'year' => 'required|string|max:4', // simple year validation
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    // Save a new milestone to the database
    public function save()
    {
        $this->validate();

        Milestone::create([
            'year' => $this->year,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        return redirect()->route('admin.milestones.index')->with('message', 'Milestone created successfully.');
    }

    // Render the create milestone form view
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.milestones.create');
    }
}

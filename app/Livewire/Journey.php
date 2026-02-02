<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Journey extends Component
{
    // Newsletter Logic
    public $email = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    // Enroll new users in the newsletter
    public function subscribe()
    {
        $this->validate();
        session()->flash('newsletter_success', 'Welcome to the pack! You are now subscribed.');
        $this->reset('email');
    }
    // Display the journey page with photographer bios and project milestones
    #[Layout('layouts.guest', ['title' => 'Journey', 'hasFooter' => false, 'fullWidth' => true])]
    public function render()
    {
        return view('livewire.journey', [
            'photographers' => \App\Models\Photographer::all(),
            'milestones' => \App\Models\Milestone::orderBy('year', 'asc')->get()
        ]);
    }
}

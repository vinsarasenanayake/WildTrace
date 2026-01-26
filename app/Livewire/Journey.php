<?php

namespace App\Livewire;

use Livewire\Component;

class Journey extends Component
{
    // Newsletter Logic
    public $email = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function subscribe()
    {
        $this->validate();
        session()->flash('newsletter_success', 'Welcome to the pack! You are now subscribed.');
        $this->reset('email');
    }
    public function render()
    {
        return view('livewire.journey', [
            'photographers' => \App\Models\Photographer::all(),
            'milestones' => \App\Models\Milestone::orderBy('year', 'asc')->get()
        ])->layout('layouts.guest', ['title' => 'Journey', 'hasFooter' => false, 'fullWidth' => true]);
    }
}

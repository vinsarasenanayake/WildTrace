<?php

namespace App\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public $isAdmin = false;

    // Use Livewire's query string handling instead of x-init
    protected $queryString = ['admin' => ['except' => '']];

    // Initialize the login form and check if it's the admin entrance
    public function mount()
    {
        $this->isAdmin = request()->has('admin');
    }

    // Switch between user and administrator login modes
    public function toggleAdmin($value)
    {
        $this->isAdmin = $value;
    }

    // Render the login form view
    public function render()
    {
        return view('livewire.login-form');
    }
}

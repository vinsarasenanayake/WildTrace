<?php

namespace App\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public $isAdmin = false;

    // Use Livewire's query string handling instead of x-init
    protected $queryString = ['admin' => ['except' => '']];

    public function mount()
    {
        $this->isAdmin = request()->has('admin');
    }

    public function toggleAdmin($value)
    {
        $this->isAdmin = $value;
        // Optionally update the URL query string if needed, 
        // but Livewire's $queryString should handle binding changes to URL automatically on next request?
        // Actually for real-time URL updates without refresh, we rely on Livewire 3 properties, 
        // but let's just keep local state for formatting.
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}

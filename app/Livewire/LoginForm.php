<?php

namespace App\Livewire;

use Livewire\Component;

class LoginForm extends Component
{
    public $isAdmin = false;

    protected $queryString = ['admin' => ['except' => '']];

    public function mount()
    {
        $this->isAdmin = request()->has('admin');
    }

    public function toggleAdmin($value)
    {
        $this->isAdmin = $value;
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}

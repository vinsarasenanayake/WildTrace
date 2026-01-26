<?php

namespace App\Livewire;

use Livewire\Component;

class RegisterForm extends Component
{
    public $showPassword = false;
    public $showConfirmPassword = false;

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function toggleConfirmPassword()
    {
        $this->showConfirmPassword = !$this->showConfirmPassword;
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}

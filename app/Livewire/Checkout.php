<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
        public $cart = [];
        public $full_name;
        public $email;
        public $address;
        public $city;
        public $country;
        public $contact_number;
        public $postal_code;

        public function mount()
        {
                $this->cart = session()->get('cart', []);
                $this->country = 'Sri Lanka';

                if (Auth::check()) {
                        $user = Auth::user();
                        $this->full_name = ucwords(strtolower($user->name));
                        $this->email = $user->email;
                        $this->address = $user->address;
                        $this->city = ucwords(strtolower($user->city));
                        $this->contact_number = $user->contact_number;
                        $this->postal_code = $user->postal_code;
                }

                if (count($this->cart) == 0) {
                        return redirect()->route('cart.index');
                }
        }

        public function process()
        {
                $this->validate([
                        'full_name' => 'required',
                        'email' => 'required|email',
                        'address' => 'required',
                        'city' => 'required',
                        'country' => 'required',
                ]);

        }

        #[Layout('layouts.checkout')]
        public function render()
        {
                return view('livewire.checkout');
        }
}
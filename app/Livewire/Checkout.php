<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

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

        // Initialize checkout page with cart data and user bio if logged in
        public function mount()
        {
                $this->cart = session()->get('cart', []);
                $this->country = 'SL';

                // Autofill for logged in user
                if (auth()->check()) {
                        $user = auth()->user();
                        $this->full_name = ucwords(strtolower($user->name));
                        $this->email = $user->email;
                        $this->address = $user->address;
                        $this->city = ucwords(strtolower($user->city));
                        $this->contact_number = $user->contact_number;
                        $this->postal_code = $user->postal_code;
                }

                // Redirect if cart empty
                if (count($this->cart) == 0) {
                        return redirect()->route('cart.index');
                }
        }

        // Placeholder for form processing logic - handled via controller POST for security
        public function process()
        {
                $this->validate([
                        'full_name' => 'required',
                        'email' => 'required|email',
                        'address' => 'required',
                        'city' => 'required',
                        'country' => 'required',
                ]);

                // Form processing is handled via standard POST to CartController for security and redirection handling.
        }

        // Render the checkout view with a specific guest layout
        #[Layout('layouts.guest', ['title' => 'Checkout', 'hasFooter' => false, 'fullWidth' => true])]
        public function render()
        {
                return view('livewire.checkout');
        }
}
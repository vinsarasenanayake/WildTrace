<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    // Validate and create a newly registered user
    public function create(array $input): User
    {
        // Validate user registration data with dynamic support for international contact formats
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_number' => ['required', 'string', 'min:7', 'max:15'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'postal_code' => ['required', 'string', 'max:10'],
            'country' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Persist new user with dynamic location and contact data
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'contact_number' => $input['contact_number'],
            'address' => $input['address'],
            'city' => $input['city'],
            'postal_code' => $input['postal_code'],
            'country' => $input['country'],
        ]);
    }
}

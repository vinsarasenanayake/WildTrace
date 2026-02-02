<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        // Validate profile updates with global support for address and contact fields
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'min:7', 'max:15'],
            'postal_code' => ['required', 'string', 'max:10'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Handle email verification logic if the email address changes
        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            // Force fill user data with dynamic location data
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'address' => $input['address'] ?? null,
                'contact_number' => $input['contact_number'] ?? null,
                'postal_code' => $input['postal_code'] ?? null,
                'country' => $input['country'] ?? null,
                'city' => $input['city'] ?? null,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        // Update user data while resetting email verification status
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'address' => $input['address'] ?? null,
            'contact_number' => $input['contact_number'] ?? null,
            'postal_code' => $input['postal_code'] ?? null,
            'country' => $input['country'] ?? null,
            'city' => $input['city'] ?? null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}

<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    // Delete the given user and handle associated data
    public function delete(User $user): void
    {
        // Nullify user_id in orders to keep order history while allowing user deletion
        $user->orders()->update(['user_id' => null]);

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}

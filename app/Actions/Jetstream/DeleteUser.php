<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    public function delete(User $user): void
    {
        $hasActiveOrders = $user->orders()
            ->whereIn('status', ['confirmed', 'paid', 'delivered'])
            ->where('created_at', '>', now()->subDays(5))
            ->exists();

        if ($hasActiveOrders) {
            throw new \Exception('Account cannot be deleted while orders are still within the estimated delivery window.');
        }

        $user->orders()->update(['user_id' => null]);

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}

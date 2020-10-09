<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function ticketEdit(User $currentUser, User $user){
        return $currentUser->is($user) || $currentUser->role=='admin';
    }
}

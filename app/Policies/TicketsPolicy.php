<?php

namespace App\Policies;

use App\User;
use App\Tickets;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the tickets.
     *
     * @param  \App\User  $user
     * @param  \App\Tickets  $tickets
     * @return mixed
     */
    public function update(User $user, Tickets $ticket)
    {
        return $ticket->author->is($user) || $user->role == 'admin';
    }
}

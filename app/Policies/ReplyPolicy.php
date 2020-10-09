<?php

namespace App\Policies;

use App\Tickets;
use App\User;
use App\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     * Проверка на администратора
     */
//    public function before(User $user){
//        if($user->role === 'admin'){
//            return true;
//        }
//    }
    /**
     * Determine whether the user can delete the reply.
     *
     * @param \App\User $user
     * @param Tickets $ticket
     * @return mixed
     */
    public function delete(User $user, Reply $reply){
        return $reply->tickets->author->is($user);
//        return $reply->tickets->author->is($user) || $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function restore(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function forceDelete(User $user, Reply $reply)
    {
        //
    }
}

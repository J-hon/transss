<?php

namespace App\Observers;

use App\User;
use App\Wallet;

class UserTableObserver
{

    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */

    public function created(User $user)
    {
        $wallet = new Wallet;
        $wallet->balance = 0;
        $wallet->user_id = $user->id;
        $wallet->save();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

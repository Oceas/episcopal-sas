<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateLastLoggedIn
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_logged_in = now();
        $event->user->save();
    }
}

<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\WelcomeMail;

class SendWelcomeMail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered $event
     *
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        Mail::to($event->User->email)->send( new WelcomeMail($event->User));
    }
}

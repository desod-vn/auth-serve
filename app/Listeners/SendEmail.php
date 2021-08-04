<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Register;
use App\Jobs\RegisterEmail;

class SendEmail
{
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
     * @param  RegisterUser  $event
     * @return void
     */
    public function handle(RegisterUser $event)
    {
        $sendEmail = new Register($event->user);
        $sendJob = new RegisterEmail($sendEmail, $event->user);

        dispatch($sendJob);
    }
}

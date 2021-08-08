<?php

namespace App\Listeners;

use App\Events\ForgotUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Forgot;
use App\Jobs\ForgotEmail;

class ForgotSendEmail
{
    public function __construct()
    {
        //
    }

    public function handle(ForgotUser $event)
    {
        $sendEmail = new Forgot($event->link);
        $sendJob = new ForgotEmail($sendEmail, $event->address);

        dispatch($sendJob);

    }
}

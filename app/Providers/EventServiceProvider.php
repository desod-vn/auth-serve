<?php

namespace App\Providers;

use App\Events\RegisterUser;
use App\Listeners\RegisterSendEmail;
use App\Events\ForgotUser;
use App\Listeners\ForgotSendEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        RegisterUser::class => [
            RegisterSendEmail::class,
        ],
        ForgotUser::class => [
            ForgotSendEmail::class,
        ],

    ];

    public function boot()
    {
        //
    }
}

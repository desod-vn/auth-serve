<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForgotUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $address;

    public $link;

    public function __construct($address, $link)
    {
        $this->address = $address;

        $this->link = $link;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

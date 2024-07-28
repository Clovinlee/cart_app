<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $msg;

    /**
     * Create a new event instance.
     */
    public function __construct($msg)
    {
        //
        $this->msg = $msg;
    }

    public function broadcastWith(): array
    {
        return [
            "msg" => $this->msg
        ];
    }

    public function broadcastOn(): array
    {
        return [
            // new PrivateChannel('channel-name'),
            new Channel('TestChannel'),
        ];
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestPrivateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private $data;
    private $userId;

    public function __construct($data, $userId)
    {
        //
        $this->data = $data;
        $this->userId = $userId;
    }

    public function broadcastWith(): array
    {
        return [
            'msg' => $this->data,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // /PrivateChannel is laravel built in private channel 
            // when accessed, it send request to broadcasting/auth
            // and check if user is auth or not
            new PrivateChannel('TestChannelPrivate.user.' . $this->userId),
        ];
    }
}

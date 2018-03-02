<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestEvent implements ShouldBroadcast
{

    use SerializesModels;
    public $update;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {

//        $data = [
//            'event' => 'Lover',
//            'data' => [
//                'username' => 'Lover'
//            ]
//        ];
        \Redis::publish('test-channel',json_encode($this->data));

        //return new PrivateChannel('test');
    }
}
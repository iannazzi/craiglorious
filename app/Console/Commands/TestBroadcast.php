<?php namespace App\Console\Commands;

use App\Events\TestEvent;
use Illuminate\Console\Command;
use App\Models\Craiglorious\System;

class TestBroadcast extends Command
{
    protected $signature = 'zz:testBroadcast';

    protected $description = 'Test Broadcast';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {


        $options = array(
            'cluster' => env('PUSHER_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new \Pusher\Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['message'] = 'hello world';
//        $pusher->trigger('global', 'my-event', $data);


//
//        $data = [
//            'event' => 'Lover',
//            'data' => [
//                'username' => 'Lover'
//            ]
//        ];
//
//        event(new TestEvent($data));


        echo 'done';


    }
}

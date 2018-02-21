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



        $data = [
            'event' => 'Lover',
            'data' => [
                'username' => 'Lover'
            ]
        ];

        event(new TestEvent($data));


        echo 'done';


    }
}

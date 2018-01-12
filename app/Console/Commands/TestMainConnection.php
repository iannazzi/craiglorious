<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Craiglorious\System;
use Artisan;


class TestMainConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:TestMainConnection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Selects Systems and Dumps outputs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $systems = System::All();
        foreach ($systems as $system)
        {
            echo 'I see a System named ' . $system->name . PHP_EOL;
        }


    }
}

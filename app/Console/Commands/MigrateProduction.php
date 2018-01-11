<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Craiglorious\System;
use Artisan;


class MigrateProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:MigrateProduction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RUNS Migration of All Databases';

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
        echo 'Migrating Craiglorious...';
        Artisan::call('migrate', [
            '--path' => "database/migrations/craiglorious",
            '--database' => 'main',
            '--force' => '',
            
        ]);

        $systems = System::All();
        foreach ($systems as $system){
           echo 'need to code migration of system named ' . $system->name .PHP_EOL;
    }


    }
}

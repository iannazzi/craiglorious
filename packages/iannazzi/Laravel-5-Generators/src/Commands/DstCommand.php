<?php

namespace Iannazzi\Generators\Commands;

use Artisan;
use Illuminate\Console\Command;
use App\Classes\Seeder\EmbrasseMoi\EmbrasseMoiDatabaseSeeder;
use App\Classes\Seeder\Demo\DemoDatabaseSeeder;


class DstCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:dst';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will create test, Demo and Em systems';

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


        DemoDatabaseSeeder::run();
        EmbrasseMoiDatabaseSeeder::run();

    }
}

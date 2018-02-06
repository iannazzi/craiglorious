<?php

namespace Iannazzi\Generators\Commands;

use App\Classes\Seeder\Craiglorious\CraigloriousDatabaseSeeder;
use Artisan;
use Illuminate\Console\Command;

class SeedCraigloriousCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:SeedCraiglorious';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dangerous command to seed craiglorious';

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
        CraigloriousDatabaseSeeder::run();
    }
}

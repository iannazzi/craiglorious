<?php

namespace Iannazzi\Generators\Commands;

use Artisan;
use Illuminate\Console\Command;

class DeleteMigrateSeedTenantDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zz:DeleteMigrateSeedTenantDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to delete tenant databases migrate tenant databases and seed tenant databases';

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

        Artisan::call('zz:DeleteAllSystems', [

        ]);
        Artisan::call('zz:MigrateCraiglorious', [

        ]);
        Artisan::call('zz:SeedCraiglorious', [

        ]);
        Artisan::call('zz:DestroySeedTenantDatabases', [

        ]);

    }
}

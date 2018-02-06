<?php

namespace Iannazzi\Generators\Commands;

use Artisan;
use Illuminate\Console\Command;

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
    protected $description = 'Alias for zz:DestroyCreateTenantDatabasesWithFakeDataSeeder';

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

        Artisan::call('db:seed', [
            '--class' => "DemoDatabaseSeeder",
            '--force' => 1
        ]);
        Artisan::call('db:seed', [
            '--class' => "EmbrasseMoiDatabaseSeeder",
            '--force' => 1

        ]);

    }
}

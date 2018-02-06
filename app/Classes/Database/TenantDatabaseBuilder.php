<?php namespace App\Classes\Database;

use App\Classes\Seeder\SystemInit\TenantStartupDatabaseSeeder;
use DB;
use File;
use Log;
use Artisan;
use App\Models\Craiglorious\System;
use App\Classes\File\CIFile;
Use App\Classes\Database\DatabaseManagerTrait;

class TenantDatabaseBuilder
{
    use DatabaseManagerTrait;

    private $system;
    private $dbc;
    private $database;
    private $connector;

    public function __construct(System $system)
    {
        $this->system = $system;
        $this->database = $system->dbc();
        $this->dbc = $system->dbc();
        $this->connector = new TenantDatabaseConnector($system);
    }

    public function createTenantDatabase()
    {
        if (TenantDatabaseConnector::checkDB($this->dbc))
        {
            trigger_error('CreateTenantDatabase: that database exists ' . $this->database);
        }
        $this->console('Creating ' . $this->database);
        $sql = "CREATE DATABASE " . $this->database;
        DB::connection('main')->statement($sql);
    }

    public function migrateTenantDatabase()
    {
        $this->console('Migrating ' . $this->database);
        Artisan::call('migrate', [
            '--path' => "database/migrations/tenant",
            '--database' => $this->dbc,
            '--force' => '1'
        ]);

    }

    public function startupSeedTenantDatabase()
    {
        $this->console('Seeding ' . $this->database);
        TenantStartupDatabaseSeeder::run();
    }

//unused
    public function manualMigration()
    {
        //might need this later???
        $migrator = app('migrator');
        $db = $migrator->resolveConnection($this->dbc);
        $migrator->setConnection($this->dbc);
        $migrator->run('database/migrations_tenant');

        return;
        $migrations = $migrator->getMigrationFiles('database/migrations/tenant');
        $queries = [];

        foreach ($migrations as $migration)
        {
            $migration_name = $migration;
            $migration = $migrator->resolve($migration);

            $queries[] = [
                'name' => $migration_name,
                'queries' => array_column($db->pretend(function () use ($migration)
                {
                    $migration->up();
                }), 'query'),
            ];
        }

        dd($queries);

    }


}
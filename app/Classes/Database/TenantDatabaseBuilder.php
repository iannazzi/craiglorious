<?php namespace App\Classes\Database;

use DB;
use File;
use Log;
use Artisan;
use App\Models\Craiglorious\System;
use App\Classes\Database\CsvImporter;
use App\Classes\File\CIFile;
Use App\Classes\Database\DatabaseManagerTrait;

class TenantDatabaseBuilder {
	use DatabaseManagerTrait;

	private $system;
	private $dbc;
	private $database;
	public function __construct(System $system)
	{
			$this->system = $system;
			$this->database = $system->dbc();
			$this->dbc = $system->dbc();
			$this->connector = new TenantDatabaseConnector($system);
			
	}
	 
	public function createTenantDatabase()
    {
    	if(TenantDatabaseConnector::checkDB($this->dbc))
    	{
    		trigger_error('CreateTenantDatabase: that database exists ' . $this->database);
    	}
    	$sql = "CREATE DATABASE " . $this->database;
     	DB::connection('main')->statement($sql);
     	$msg =  'Created ' . 	$this->database  . PHP_EOL;
     	Log::info($msg );
     	$this->console($msg);

    }

    public function migrateTenantDatabase()
	{
		$msg = 'Migrating ' . 	$this->database  . PHP_EOL;
		$this->console($msg);
		 Artisan::call('migrate', [
	        '--path'     => "database/migrations/tenant",
	        '--database' => $this->dbc,
             '--force' => '1'
        ]);
		$msg = 'Migrated ' . 	$this->database  . PHP_EOL;
		$this->console($msg);

	}
	public function startupSeedTenantDatabase(){
        $msg = 'Seeding ' . 	$this->database  . PHP_EOL;
        $this->console($msg);
        Artisan::call('db:seed', [
            '--class' => "TenantStartupDatabaseSeeder",
        ]);
        $msg = 'Seeded ' . 	$this->database  . PHP_EOL;
        $this->console($msg);
    }

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

		foreach($migrations as $migration) {
		    $migration_name = $migration;
		    $migration = $migrator->resolve($migration);

		    $queries[] = [
		        'name' => $migration_name,
		        'queries' => array_column($db->pretend(function() use ($migration) { $migration->up(); }), 'query'),
		    ];
		}

		dd($queries);

    }	
		
	
}
<?php

namespace App\Classes\TenantSystem;


use App\Classes\Database\DatabaseCsvLoader;
use App\Classes\Database\DatabaseManagerTrait;
use Filesystem;

use App\Classes\Database\TenantDatabaseBuilder;
use App\Classes\Database\TenantDatabaseModifier;
use App\Classes\Database\TenantDatabaseConnector;

use Symfony\Component\Console\Output\ConsoleOutput;

use App\Models\Craiglorious\System;
use App\Models\Tenant\User;


Class TenantSystemBuilder {
    use DatabaseManagerTrait;
	protected $system;
    protected $dbc;

	public function __construct(System $system)
	{
		$this->system = $system;
        $this->dbc = $system->dbc();
        $this->output = new ConsoleOutput();
	}
    function tenant_csv_seed_path()
    {
        return database_path("seeds/tenant/systemInit/csvStartupData/");
    }
	public function setupTenantSystem() //sytem is the model from craigland.....  
	{ 
     	//there is no fall back - I could manually delete or even re-install...
       	$tenantDatabaseBuilder = new TenantDatabaseBuilder($this->system);
        
        $tenantDatabaseBuilder->createTenantDatabase();
        TenantDatabaseConnector::createTenantConnection($this->system);
        $tenantDatabaseBuilder->migrateTenantDatabase();
        $this->console('Migration Complete');

        /*
         * load csv -- due to foreign key restraints  may have have to move some imports to migrations
         */

        //csv is easier than building arrays up...
        //csv is the first filling of databases
        DatabaseCsvLoader::loadCSVStartupData($this->dbc, $this->tenant_csv_seed_path());
        $this->console('Csv Data Skipped');

        $this->createTenantSystemAdminAccount();
        $this->console('Admin Account Complete');

        $tenantDatabaseBuilder->startupSeedTenantDatabase();
        $this->console('Seeding Complete');

        //views come from the system this is pretty weird so far
//        $this->createAdminRoleViews();
//        $this->console('Views Added to Admin Role');





        //create a store... nope
        //create filesystem... yup


	}
    public function createUniquePasscode()
    {

    }
	
	public function createTenantSystemAdminAccount()
	{
		$this->console( 'Creating Admin account...for ' .$this->system->dbc() . PHP_EOL);
		$posUserData = [
            
            'username'=> 'admin',
//            'first_name' => $this->system->name,
            'password'=> $this->system->password,
//            'email' => $this->system->email,
            'role_id' => 1,
            'active' => 1,

            ];

        $posUser = User::create($posUserData);
        $this->console( 'Created Admin account...for ' .$this->system->dbc() . PHP_EOL);

    }
    public function createAdminRoleViews()
    {
        $this->console( 'Adding views to admin role ' .$this->system->dbc() . PHP_EOL);

        $views = $this->system->views();

        $role = \App\Models\Tenant\Role::find(1);

        foreach($views as $view){
            \DB::insert('insert into role_view (role_id, view_id, access) values (?, ?, ?)', [$role->id, $view->id, 'write']);

            //what about the other views?
        }
    }
	public function deleteSystem()
	{
		//say something fails in the install, this will remove it
		//ssssssuuuuuuuppppppperrrrrrrrr dangerous
		//$connection = $system->createConnection(); // ??? huh I need this often....
     	//there is no fall back
     	$tenantDatabaseBuilder = new TenantDatabaseModifier($this->system);
        $tenantDatabaseBuilder->deleteDatabase();
	}

	




}


?>
<?php

use App\Classes\TenantSystem\TenantSystemBuilder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Craiglorious\System;

class DestroyCreateTenantDatabasesWithFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //issue this commnad:
    // php artisan db:seed --class=localDatabaseSeeder
    public function run()
    {
        echo 'running DestroyCreateTenantDatabasesWithFakeDataSeeder seeder ';
		Model::unguard();

    	//$this->call('CraigloriousFakeDataDatabaseSeeder');

        $systems = System::all();
        $system = System::find(1);
//        foreach ($systems as $system)
//        {

            echo 'LocalDatabase Seeder: Create Database called ' .$system->dbc() . ' using connection default' . PHP_EOL;
            echo $system->company .PHP_EOL;

            $tenantSystemBuilder = new TenantSystemBuilder($system);
            $tenantSystemBuilder->deleteSystem();
            $tenantSystemBuilder->setupTenantSystem();
            $system->createTenantConnection();
            $this->call('TenantFakeDataDatabaseSeeder');
//        }


        Model::reguard();



    }
}

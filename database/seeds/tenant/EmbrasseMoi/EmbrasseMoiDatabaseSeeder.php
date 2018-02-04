<?php

use App\Classes\TenantSystem\TenantSystemBuilder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Craiglorious\System;

class EmbrasseMoiDatabaseSeeder extends Seeder
{

    public function run()
    {
        echo 'running  EmbrasseMoiDatabaseSeeder';
		Model::unguard();


        $system = System::where('company', 'Embrasse-moi')->first();


            echo 'Embrasse-Moi Database Seeder: Create Database called ' .$system->dbc() . ' using connection default' . PHP_EOL;
            echo $system->company .PHP_EOL;

            $tenantSystemBuilder = new TenantSystemBuilder($system);
            $tenantSystemBuilder->deleteSystem();
            $tenantSystemBuilder->setupTenantSystem();
            $system->createTenantConnection();


            // now do stuff like seed employees....






        Model::reguard();



    }
}

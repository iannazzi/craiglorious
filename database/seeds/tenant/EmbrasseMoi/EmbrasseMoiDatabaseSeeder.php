<?php

use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Tenant\Employee;
use App\Models\Craiglorious\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Craiglorious\System;
use App\Classes\File\CIFile;
use Symfony\Component\Console\Output\ConsoleOutput;


class EmbrasseMoiDatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->console('running EmbrasseMoiDatabaseSeeder');
		//Model::unguard();


        $system = System::where('company', 'Embrasse-moi')->first();

        $this->console('Embrasse-Moi Database Seeder: Create Database called ' .$system->dbc() . ' using connection default');

            $tenantSystemBuilder = new TenantSystemBuilder($system);
            $tenantSystemBuilder->deleteSystem();
            $tenantSystemBuilder->setupTenantSystem();
            $system->createTenantConnection();




        $this->call('EmEmployeesSeeder');
        $this->call('EmUsersSeeder');


         //Model::reguard();



    }
    public function console($msg)
    {
        $out = new ConsoleOutput();
        $out->writeln($msg);
    }
}

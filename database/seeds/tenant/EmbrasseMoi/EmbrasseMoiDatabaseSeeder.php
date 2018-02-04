<?php

use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Tenant\Employee;
use App\Models\Craiglorious\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Craiglorious\System;
use App\Classes\File\CIFile;

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


        //Add employees
        $file= database_path("seeds/tenant/EmbrasseMoi/DataGitIgnore/employees.csv");
        $cifile = new CIFile();

        $employees = $cifile->csvToArray($file);
        $new_emp = [];
        foreach ($employees as $employee)
        {
            $employee['state_id'] = State::where('short_name',$employee['state'])->first()->id;
            $employee['ss'] = Employee::removeDashes($employee['ss']);
            unset($employee['state']);
            $new_emp[] = $employee;
        }
        Employee::insert($new_emp);









        Model::reguard();



    }
}

<?php

use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Tenant\Employee;
use App\Models\Craiglorious\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Craiglorious\System;
use App\Classes\File\CIFile;

class EmEmployeesSeeder extends Seeder
{

    public function run()
    {
        //Add employees
        $file = em_data_seed_path() . '/employees.csv';
dd($file);

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


    }
}

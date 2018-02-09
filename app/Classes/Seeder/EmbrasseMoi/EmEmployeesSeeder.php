<?php
namespace App\Classes\Seeder\EmbrasseMoi;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\Employee;
use App\Models\Craiglorious\State;
use App\Classes\File\CIFile;
use App\Models\Tenant\User;

class EmEmployeesSeeder extends BaseSeeder
{

    public static function run()
    {
        //Add employees
        $file = em_data_seed_path() . '/employees.csv';

        $cifile = new CIFile();

        $employees = $cifile->csvToArray($file, ';');
        $new_emp = [];
        foreach ($employees as $employee)
        {
            $employee['state_id'] = State::where('short_name',$employee['state'])->first()->id;
            unset($employee['state']);
            $employee['user_id'] = User::where('username',$employee['user'])->first()->id;
            unset($employee['user']);




           // $employee['ss'] = Employee::removeDashes($employee['ss']);

            $new_emp[] = $employee;
        }
        Employee::insert($new_emp);


    }
}

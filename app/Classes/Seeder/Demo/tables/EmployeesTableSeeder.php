<?php
namespace App\Classes\Seeder\Demo\tables;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\User;
use App\Models\Tenant\Employee;

class EmployeesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        self::console('EmployeesTableSeeder');

        Factory('App\Models\Tenant\Employee', 30)->create();

        $users = User::all();
        $employees = Employee::all();

        for($i = 0;$i<5;$i++){
            $employees[$i]->user_id = $users[$i]->id;
            //dd($employees[$i]);
            $employees[$i]->save();
        }

    }
}

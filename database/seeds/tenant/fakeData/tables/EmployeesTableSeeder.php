<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'EmployeesTableSeeder' . PHP_EOL;

        Factory('App\Models\Tenant\Employee', 30)->create();
        $users = App\Models\Tenant\User::all();
        $employees = App\Models\Tenant\Employee::all();
        for($i = 0;$i<5;$i++){
            $employees[$i]->user_id = $users[$i]->id;
        }
        //can assign user id to first five employees....




        echo 'EmployeesTableSeeder' . PHP_EOL;
    }
}

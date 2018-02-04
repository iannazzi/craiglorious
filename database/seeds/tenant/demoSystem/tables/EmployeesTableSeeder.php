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

        foreach( $employees as $employee){

        }
        for($i = 0;$i<5;$i++){
            $employees[$i]->user_id = $users[$i]->id;
            //dd($employees[$i]);
            $employees[$i]->save();
        }

        //$employees->save();
        //can assign user id to first five employees....




        echo 'Seeded EmployeesTableSeeder' . PHP_EOL;
    }
}

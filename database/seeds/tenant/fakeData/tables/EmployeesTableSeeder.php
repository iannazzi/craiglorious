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
        echo 'EmployeesTableSeeder' . PHP_EOL;
    }
}

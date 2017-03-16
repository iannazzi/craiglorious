<?php

use Illuminate\Database\Seeder;

class TenantFakeDataDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        echo 'running TenantFakeDataDatabaseSeeder' . PHP_EOL;
        $this->call('VendorsTableSeeder');
        $this->call('CalendarEntriesTableSeeder');
        $this->call('EmployeesTableSeeder');
//        $this->call('CalendarEntriesTableSeeder');

    }
}

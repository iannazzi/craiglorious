<?php
namespace App\Classes\Seeder\Demo;

use App\Classes\Seeder\BaseSeeder;
use App\Classes\Seeder\Demo\tables\CalendarEntriesTableSeeder;
use App\Classes\Seeder\Demo\tables\CustomersTableSeeder;
use App\Classes\Seeder\Demo\tables\EmployeesTableSeeder;
use App\Classes\Seeder\Demo\tables\UsersTableSeeder;
use App\Classes\Seeder\Demo\tables\VendorsTableSeeder;
use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;

class DemoDatabaseSeeder extends BaseSeeder
{
    public static function run()
    {
        $system = System::where('company', 'demo')->firstOrFail();
        self::console($system->company . ' Database Seeder: Create Database called ' . $system->dbc() . ' using connection default' );

        $tenantSystemBuilder = new TenantSystemBuilder($system);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
//        $system->createTenantConnection();

        UsersTableSeeder::run();
        VendorsTableSeeder::run();
        CalendarEntriesTableSeeder::run();
        EmployeesTableSeeder::run();
        CustomersTableSeeder::run();

    }
}

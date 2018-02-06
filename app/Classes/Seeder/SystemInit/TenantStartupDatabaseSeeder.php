<?php
namespace App\Classes\Seeder\SystemInit;

use App\Classes\Seeder\BaseSeeder;
use App\Classes\Seeder\SystemInit\tables\AccountsTableSeeder;
use App\Classes\Seeder\SystemInit\tables\LocationsTableSeeder;
use App\Classes\Seeder\SystemInit\tables\RolesTableSeeder;

class TenantStartupDatabaseSeeder extends BaseSeeder
{
    public static function run()
    {
        RolesTableSeeder::run();
        AccountsTableSeeder::run();
        LocationsTableSeeder::run();
    }
}

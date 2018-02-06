<?php
namespace App\Classes\Seeder\EmbrasseMoi;


use App\Classes\Seeder\BaseSeeder;
use App\Classes\Seeder\EmbrasseMoi\EmEmployeesSeeder;
use App\Classes\Seeder\EmbrasseMoi\EmUsersSeeder;
use App\Classes\TenantSystem\TenantSystemBuilder;


use App\Models\Craiglorious\System;
use App\Classes\File\CIFile;


class EmbrasseMoiDatabaseSeeder extends BaseSeeder
{

    public static function run()
    {
        self::console('running EmbrasseMoiDatabaseSeeder');

        $system = System::where('company', 'Embrasse-moi')->first();

        self::console('Embrasse-Moi Database Seeder: Create Database called ' . $system->dbc() . ' using connection default');

        $tenantSystemBuilder = new TenantSystemBuilder($system);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        //$system->createTenantConnection();

        EmEmployeesSeeder::run();
        EmUsersSeeder::run();

    }

}

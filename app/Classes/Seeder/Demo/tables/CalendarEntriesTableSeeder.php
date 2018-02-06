<?php
namespace App\Classes\Seeder\Demo\tables;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Craiglorious\System;

class CalendarEntriesTableSeeder extends BaseSeeder
{
    public static function run()
    {
        $system = System::find(1);
        $system->createTenantConnection();

        self::console('CalendarEntriesTableSeeder');
        Factory('App\Models\Tenant\CalendarEntry', 200)->create();
    }
}

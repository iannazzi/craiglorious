<?php

use App\Models\Craiglorious\System;
use Illuminate\Database\Seeder;

class CalendarEntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $system = System::find(1);
        $system->createTenantConnection();


        echo 'CalendarEntriesTableSeeder' . PHP_EOL;
        Factory('App\Models\Tenant\CalendarEntry', 200)->create();
        echo 'Seeded CalendarEntriesTableSeeder' . PHP_EOL;
    }
}

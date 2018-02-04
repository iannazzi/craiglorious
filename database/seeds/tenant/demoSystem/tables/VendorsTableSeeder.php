<?php

use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'VendorsTableSeeder' . PHP_EOL;
        Factory('App\Models\Tenant\Vendor', 200)->create();
        echo 'Seeded Vendor Table' . PHP_EOL;
    }
}

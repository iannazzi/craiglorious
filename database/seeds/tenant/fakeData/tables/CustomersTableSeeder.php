<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'CustomersTableSeeder' . PHP_EOL;

        Factory('App\Models\Tenant\Customer', 300)->create();



        echo 'Seeded CustomersTableSeeder' . PHP_EOL;
    }
}

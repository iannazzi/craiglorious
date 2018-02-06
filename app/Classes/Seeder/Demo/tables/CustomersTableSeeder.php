<?php
namespace App\Classes\Seeder\Demo\tables;

use App\Classes\Seeder\BaseSeeder;

class CustomersTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('CustomersTableSeeder');
        Factory('App\Models\Tenant\Customer', 300)->create();
    }
}

<?php
namespace App\Classes\Seeder\Demo\tables;


use App\Classes\Seeder\BaseSeeder;

class VendorsTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('VendorsTableSeeder');
        Factory('App\Models\Tenant\Vendor', 200)->create();
    }
}

<?php
namespace App\Classes\Seeder\Demo\tables;

use App\Classes\Seeder\BaseSeeder;
use \App\Models\Tenant\Terminal;

class TerminalsTableSeeder extends BaseSeeder
{
    public static function run()
    {

        $insert = [
            [
                'name' => 'macbook',
                'description' => 'Newer I-mac in office',
                'active' => 1,
            ],
            [
                'name' => 'windows',
                'description' => 'old crappy windows computer',
                'active' => 1,
            ],
            [
                'name' => 'iphone',
                'description' => '',

                'active' => 1,
            ],
            [
                'name' => 'chromebook',
                'description' => 'customer counter',
                'active' => 1,
            ],
        ];

        Terminal::insert($insert);

    }
}

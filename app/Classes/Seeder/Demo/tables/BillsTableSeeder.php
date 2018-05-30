<?php
namespace App\Classes\Seeder\Demo\tables;


use App\Classes\Seeder\BaseSeeder;

class BillsTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('BillsTableSeeder');
        $insert = [
            [
                'name' => 'Main Location',
                'parent_id'=>0,
                'comments' => 'Pittsford',
                'active' => 1,
            ],
            [
                'name' => 'Offsite Storage Container',
                'parent_id'=>0,
                'comments' => 'Rochester',
                'active' => 1,
            ],
        ];
        Bills::insert($insert);



    }
}

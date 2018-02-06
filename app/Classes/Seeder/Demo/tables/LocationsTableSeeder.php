<?php
namespace App\Classes\Seeder\Demo\tables;
use App\Classes\Seeder\BaseSeeder;
use App\Models\Tenant\Location;

class LocationsTableSeeder extends BaseSeeder
{
    public static function run()
    {
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
        Location::insert($insert);

        $insert = [
            [
                'name' => 'Shelf 01',
                'parent_id'=>Location::where('name','Main Location')->first()->id,
                'comments' => '',
                'active' => 1,
            ],
            ];
        Location::insert($insert);

        $insert = [
            [
                'name' => 'A1',
                'parent_id'=>Location::where('name','Shelf 01')->first()->id,
                'comments' => '',
                'active' => 1,
            ],
            [
                'name' => 'A2',
                'parent_id'=>Location::where('name','Shelf 01')->first()->id,
                'comments' => '',
                'active' => 1,
            ],
        ];
        Location::insert($insert);

    }
}

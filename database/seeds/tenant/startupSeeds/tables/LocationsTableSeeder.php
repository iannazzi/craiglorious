<?php
use App\Models\Tenant\Location;
use Illuminate\Database\Seeder;
use \App\Models\Tenant\Printer;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        //this is here for testing
//        $system = App\Models\Craiglorious\System::first();
//        $system->createTenantConnection();

        echo 'LocationsTableSeeder' . PHP_EOL;
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



        echo 'Seeded Locations Table' . PHP_EOL;
    }
}

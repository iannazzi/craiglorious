<?php
use Illuminate\Database\Seeder;
use \App\Models\Tenant\Terminal;

class TerminalsTableSeeder extends Seeder
{
    public function run()
    {
        //this is here for testing
//        $system = App\Models\Craiglorious\System::first();
//        $system->createTenantConnection();

        echo 'TerminalsTableSeeder' . PHP_EOL;
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


        echo 'Seeded Terminal Table' . PHP_EOL;
    }
}

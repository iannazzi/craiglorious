<?php
use App\Models\Craiglorious\System;
use Illuminate\Database\Seeder;
	
class SystemsTableSeeder extends Seeder 
{


    public function run()
	{
        echo 'running SystemsTableSeeder' . PHP_EOL;
        echo 'Tuncating Systems Table - works fine' . PHP_EOL;
        System::truncate();
       ;
       echo 'Newing up a system then filling it works fine' . PHP_EOL;
        $system = new System();
        $system->fill([
            'name' => 'Peter Iannazzi',
            'company' => 'Embrasse-Moi',
            'email' => 'ci@embrasse-moi.com',
            'password' => bcrypt('secret'),
            'phone' => '585-383-1170',
            'address' => '1 N Main Street, Pittsford NY, 14534',
        ]);
        $system->save();
        echo 'create is not working fine: returning message killed after stalling for some time' . PHP_EOL;
         System::create( [
            'name' => 'Peter',
            'company' => 'cf, LLC',
            'email' => 'vf@vd.com',
            'password' => bcrypt('secret'),
            'phone' => '585-484-1170',
            'address' => 'abc street',
        ]);

//        echo 'Adding IE Destinations' . PHP_EOL;
//        System::create([
//            'name' => 'Patrisha Iannazzi',
//            'company' => 'Iannazzi Enterprises',
//            'email' => 'travel@iedestinations.com',
//            'password' => bcrypt('secret'),
//            'phone' => '585-624-1285',
//            'address' => '450 Smith Road, Pittsford, NY 14534',
//        ]);




        //echo 'Seeding Systems Table' . PHP_EOL;
//        Factory('App\Models\Craiglorious\System', 5)->create();
//        echo 'Seeded Systems Table' . PHP_EOL;
	}
}
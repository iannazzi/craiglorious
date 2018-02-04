<?php
use App\Models\Craiglorious\System;
use Illuminate\Database\Seeder;
	
class SystemsTableSeeder extends Seeder 
{


    public function run()
	{
        echo 'running SystemsTableSeeder' . PHP_EOL;
        //1 is demo, 2 is embrasse-moi
        System::truncate();
        System::create( [
            'name' => 'Craig',
            'company' => 'demo',
            'email' => 'craig.iannazzi@gmail.com',
            'password' => bcrypt('secret'),
            'phone' => '585-484-1170',
            'address' => 'abc street',
        ]);
       echo 'Creating Embrasse Moi' . PHP_EOL;
        $system = new System();
        $system->fill([
            'name' => 'Craig Iannazzi',
            'company' => 'Embrasse-Moi',
            'email' => 'craig.iannazzi@embrasse-moi.com',
            'password' => bcrypt('secret'),
            'phone' => '585-383-1170',
            'address' => '1 N Main Street, Pittsford NY, 14534',
        ]);
        $system->save();

        // add other accounts here



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
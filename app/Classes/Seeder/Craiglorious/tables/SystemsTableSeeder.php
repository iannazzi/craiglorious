<?php
namespace App\Classes\Seeder\Craiglorious\tables;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Craiglorious\System;

class SystemsTableSeeder extends BaseSeeder
{
    public static function run()
	{
	    self::console('SystemsTableSeeder');
        //1 is test, 2 is demo, 3 is embrasse-moi!!
        System::truncate();
        System::create( [
            'name' => 'Craig Patrick',
            'company' => 'test',
            'email' => 'cowchickencatdog@gmail.com',
            'password' => bcrypt('secret'),
            'phone' => '585-484-1171',
            'address' => 'abc street',
        ]);
        System::create( [
            'name' => 'Craig',
            'company' => 'demo',
            'email' => 'craig.iannazzi@gmail.com',
            'password' => bcrypt('secret'),
            'phone' => '585-484-1170',
            'address' => 'abc street',
        ]);

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
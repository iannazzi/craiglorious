<?php
namespace App\Classes\Seeder\Craiglorious;

use App\Classes\Seeder\BaseSeeder;
use App\Classes\Seeder\Craiglorious\tables\SystemsTableSeeder;
use App\Classes\Seeder\Craiglorious\tables\ViewsTableSeeder;


class CraigloriousDatabaseSeeder extends BaseSeeder {
 	public static function run()
    {
		self::console('running CraigloriousDatabaseSeeder');
		SystemsTableSeeder::run();
		ViewsTableSeeder::run();
	}
}
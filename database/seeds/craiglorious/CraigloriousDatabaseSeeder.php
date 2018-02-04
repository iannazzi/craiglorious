<?php

use Illuminate\Database\Seeder;


class CraigloriousDatabaseSeeder extends Seeder {
 	public function run()
    {
		echo 'running CraigloriousDatabaseSeeder' . PHP_EOL;
        $this->call('SystemsTableSeeder');
        // this is done on the migration $this->call('ViewsTableSeeder');
	}
}
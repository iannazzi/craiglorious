<?php

use Illuminate\Database\Seeder;


class CraigloriousFakeDataDatabaseSeeder extends Seeder {
 	public function run()
    {
		echo 'running CraigloriousFakeDataDatabaseSeeder' . PHP_EOL;
        $this->call('SystemsTableSeeder');
	}
}
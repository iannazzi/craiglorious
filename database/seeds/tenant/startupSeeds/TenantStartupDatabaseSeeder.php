<?php
//namespace Database\Seeds\Tenant\StartupSeeds;

use Illuminate\Database\Seeder;

class TenantStartupDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        echo 'running TenantDatabaseSeeder' . PHP_EOL;

        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('LocationsTableSeeder');
        $this->call('TerminalsTableSeeder');
        $this->call('PrintersTableSeeder');


    }
}

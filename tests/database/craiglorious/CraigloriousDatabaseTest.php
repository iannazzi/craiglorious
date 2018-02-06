<?php

use App\Models\Craiglorious\View;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Tests\ApiTester;
use App\Models\Craiglorious\System;

class CraigloriousDatabaseTest extends ApiTester
{

    /** @test */
    function init_craiglorious()
    {
        //some debugging stuff to help get started
        //var_dump(Config::get('database'));

        DatabaseDestroyer::dropAllTables('main');

        $this->console('Running Craiglorious Migrations On Connection main');
        Artisan::call('migrate', [
            '--path' => "database/migrations/craiglorious",
            '--database' => 'main',
            '--force' => '1'
        ]);
        $this->console('migrations complete');

        Artisan::call('zz:SeedCraiglorious');
        $this->assertNotNull(System::all());
        $this->assertNotNull(View::all());

    }

    /** @test */
    function craiglorious_has_systems()
    {
        $this->assertNotNull(System::all());
    }
    /** @test */
    function craiglorious_has_views()
    {
        $this->assertNotNull(View::all());
    }


}
<?php


use App\Models\Tenant\Employee;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;

class emDatabaseTest extends ApiTester
{

    /** @test */
    function system_init()
    {
        //assume em system is already made

        Artisan::call('db:seed', [
            '--class' => "EmbrasseMoiDatabaseSeeder",
        ]);
        $this->assertNotCount(0, Employee::all());

    }

}
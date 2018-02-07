<?php


use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Tests\ApiTester;

class TenantDatabaseTest extends ApiTester
{

    /** @test */
    function system_init()
    {
        DatabaseDestroyer::deleteAllTenantDatabases();
    }

}


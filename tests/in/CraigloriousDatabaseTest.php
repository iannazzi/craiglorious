<?php

use App\Classes\Database\MainDatabaseConnector;
use App\Classes\Database\DatabaseCsvLoader;
use App\Models\Tenant\Address;
use App\Models\Tenant\Company;
use App\Models\Tenant\Store;
use Iannazzi\Generators\DatabaseImporter\DatabaseCSVCreator;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;

class CraigloriousDatabaseTest extends ApiTester
{

    /** @test */
    function init_craiglorious()
    {
       //DatabaseCSVCreator::createStartupSCVFile('POS', 'pos_tax_jurisdictions');
        $this->writeMethod(__METHOD__);
        self::loadCraiglorious();
    }

    /*
     * do not add any more tests here as phpunit calls them randomly...
     * and then you will not have a system....
     */


    public static function loadCraiglorious()
    {
        //MainDatabaseConnector::createMainConnection();
        DatabaseDestroyer::dropAllTables('main');
        echo 'Running Craiglorious Migrations On Connection main'  .PHP_EOL;
        Artisan::call('migrate', [
            '--path' => "database/migrations/craiglorious",
            '--database' => 'main',
        ]);
        echo 'Migrations Complete' .PHP_EOL;
    }
}
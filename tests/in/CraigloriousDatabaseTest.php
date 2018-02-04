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
        //some debugging stuff to help get started
        //var_dump(Config::get('database'));

        // we do not use the main connection code - gets specified in .env and phpunit.xml
        // MainDatabaseConnector::createMainConnection();
        //var_dump(Config::get('database'));

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
            '--force' => '1'
        ]);
        echo 'Migrations Complete' .PHP_EOL;
        //this is done on the migration
//        Artisan::call('db:seed', [
//            '--class' => "CraigloriousDatabaseSeeder",
//        ]);
    }
}
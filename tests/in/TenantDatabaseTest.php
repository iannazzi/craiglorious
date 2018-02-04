<?php


use App\Models\Tenant\Employee;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Tests\ApiTester;
use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;

class TenantDatabaseTest extends ApiTester
{

    /** @test */
    function system_init()
    {
        echo 'System setup All Tenant Databases' .PHP_EOL;
        //DatabaseCSVCreator::createStartupSCVFile('POS', 'pos_tax_jurisdictions');
        $this->writeMethod(__METHOD__);
        System::truncate();
        self::systemReset();
        self::createDemo();
        $this->assertNotCount(0, Employee::all());
        self::createEM();
        $this->assertCount(0, Employee::all());
        self::createNew();
        $this->assertCount(0, Employee::all());

    }



    /*
     * do not add any more tests here as phpunit calls them randomly...
     * and then you will not have a system....
     */

    public static function createDemo()
    {
        echo 'Creating Demo tenant' .PHP_EOL;

        $demo = factory(System::class,'demo')->create();
//        $tenantSystemBuilder = new TenantSystemBuilder($demo);
//        $tenantSystemBuilder->deleteSystem();
//        $tenantSystemBuilder->setupTenantSystem();
//        $demo->createTenantConnection();
        //now seed it
        Artisan::call('db:seed', [
            '--class' => "DemoDatabaseSeeder",
        ]);

    }


    public static function createEM()
    {
        echo 'Creating Embrasse-Moi tenant' .PHP_EOL;
        $embrasse = factory(System::class,'embrasse-moi')->create();
//        $tenantSystemBuilder = new TenantSystemBuilder($embrasse);
//        $tenantSystemBuilder->deleteSystem();
//        $tenantSystemBuilder->setupTenantSystem();
//        $embrasse->createTenantConnection();
        Artisan::call('db:seed', [
            '--class' => "EmbrasseMoiDatabaseSeeder",
        ]);
    }

    public static function createNew()
    {
        echo 'Creating Test tenant' .PHP_EOL;
        $new = factory(System::class, 'test')->create();
        $tenantSystemBuilder = new TenantSystemBuilder($new);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $new->createTenantConnection();




    }
    public static function systemReset()
    {
        //delete all tenant systems
        echo 'Deleting All Tenant Databases' .PHP_EOL;
        DatabaseDestroyer::deleteAllTenantDatabases();
    }
}
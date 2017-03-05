<?php



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
        self::createEM();

    }



    /*
     * do not add any more tests here as phpunit calls them randomly...
     * and then you will not have a system....
     */




    public static function createEM()
    {
        self::systemReset();
        System::truncate();
        $embrasse = factory(System::class,'embrasse-moi')->create();
        $tenantSystemBuilder = new TenantSystemBuilder($embrasse);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $embrasse->createTenantConnection();
    }
    public static function systemReset()
    {

//        $csv_path = database_path("seeds/csv_startup_data/craiglorious");
//        DatabaseCsvLoader::loadCSVStartupData('main', $csv_path);


        //delete all tenant systems
        echo 'Deleting All Tenant Databases' .PHP_EOL;
        DatabaseDestroyer::deleteAllTenantDatabases();
    }
}
<?php


use Iannazzi\Generators\DatabaseImporter\DatabaseConnector;
use Iannazzi\Generators\DatabaseImporter\DatabaseCSVCreator;
use Iannazzi\Generators\DatabaseImporter\DatabaseMigrationMap;
use IannazziTestLibrary\Tests\ApiTester;

class ProductImportTest extends ApiTester
{

    /** @test
     */

    function a_product_can_be_imported_from_production()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        DatabaseConnector::addConnections();
        $dbc = 'POS';
        //$dbc = 'POS_PRODUCTION'; getting a timeout on this one....
        $data = DB::connection($dbc)->Select("SELECT * FROM pos_products LIMIT 100");
        //drop them through the map?

        $data = DatabaseMigrationMap::mapData('pos_products',$data);
        //dd($data);

    }
}
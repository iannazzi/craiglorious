<?php


use IannazziTestLibrary\Tests\ApiTester;
use Iannazzi\Generators\DatabaseImporter\DatabaseCSVCreator;
class CSVStartUpDataTest extends ApiTester
{

    /** @test */
    function product_options_can_be_exported()
    {
        //create exporter class
        DatabaseCSVCreator::createStartupSCVFile('POS','pos_product_attributes');
        dd('check it out');

    }

}
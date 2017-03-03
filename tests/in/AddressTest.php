<?php

use App\Models\Craiglorious\State;
use App\Models\Craiglorious\ZipCode;
use App\Models\Tenant\Address;
use Iannazzi\Generators\DatabaseImporter\DatabaseCSVCreator;
use IannazziTestLibrary\Tests\ApiTester;

class AddressTest extends ApiTester
{
    /** @test */
    function states_are_loaded()
    {
        $this->writeMethod(__METHOD__);
        $system = $this->getSystem();
        $new_york = State::where('name', 'New York')->first();
        $this->assertEquals('NY', $new_york['short_name']);

        $tn =  State::where('short_name', 'TN')->first();
        $this->assertEquals('Tennessee', $tn['name']);


    }
    /** @test */
    function zip_codes_are_loaded()
    {

        $zip_codes = ZipCode::where('zip_code','14534')->first();

        $this->assertEquals('Monroe', $zip_codes->county);
        $this->assertEquals('NY', $zip_codes->state);
        $this->assertEquals('Pittsford', $zip_codes->primary_city);
    }

    /** @test */
    function an_address_can_be_created()
    {
        $this->writeMethod(__METHOD__);
        $system = $this->getSystem();
        $address = factory(Address::class,75)->create();
        $this->assertEquals(75, $address->count());
        //$address->toArray();

    }
}
<?php

use App\Models\Tenant\Manufacturer;
use IannazziTestLibrary\Tests\ApiTester;

class ManufacturerTest extends ApiTester
{
    /** @test */
    function a_manufacturer_can_be_created()
    {
        $this->writeMethod(__METHOD__);
        $system = $this->getSystem();
        $mfg = factory(Manufacturer::class,3)->create();
        $mfg = Manufacturer::all();
        //$this->
        //dd($mfg->toArray());

    }
}
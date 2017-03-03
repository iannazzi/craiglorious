<?php

use App\Models\Tenant\Brand;
use IannazziTestLibrary\Tests\ApiTester;

class BrandTest extends ApiTester
{
    /** @test */
    function a_brand_can_be_created()
    {
        $this->writeMethod(__METHOD__);
        $system = $this->getSystem();
        $brand = factory(Brand::class,3)->create();
        $brands = Brand::all();
        //dd($brands->toArray());

    }
}
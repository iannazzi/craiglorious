<?php

use App\Classes\TenantSystem\TenantSystemBuilder;
use App\Models\Craiglorious\System;
use Tests\ApiTester;

class SystemTest extends ApiTester
{


    /** @test */
    function a_system_can_be_set_up()
    {
        $this->systemReset();
    }
    /** @test */
    function a_system_has_a_name()
    {
        $embrasse = factory(System::class,'embrasse-moi')->create();

        factory(System::class, 3)->create();

        $this->assertEquals('Embrasse-Moi', $embrasse->company);

    }
    /** @test */
    function a_system_can_be_migrated()
    {
        $systems = System::all();
        foreach ($systems as $system)
        {
            echo 'Create Database called ' .$system->dbc() . ' using connection ' . $system->dbc() . PHP_EOL;
            echo $system->company .PHP_EOL;

            $tenantSystemBuilder = new TenantSystemBuilder($system);
            //echo 'Deleting System in case it is there....' .PHP_EOL;
            //$tenantSystemBuilder->deleteSystem();
            $tenantSystemBuilder->setupTenantSystem();
        }
    }
    /** @test */
    function a_product_can_be_made_on_more_than_one_system()
    {
        $this->systemReset();
        $system1 = factory(System::class)->create();
        $tenantSystemBuilder = new TenantSystemBuilder($system1);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $system1->createTenantConnection();
        factory(Product::class, 3)->create();

        $system2 = factory(System::class)->create();
        $tenantSystemBuilder = new TenantSystemBuilder($system2);
        $tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $system2->createTenantConnection();
        factory(Product::class, 3)->create();


        $system1->setDBC();
        factory(Product::class, 6)->create();

        $this->assertEquals(Product::count(), '9');

        $system2->setDBC();
        $this->assertEquals(Product::count(), '3');


    }
    /** @test */
    function a_system_is_created_without_factory()
    {
        $new_system = [
            'company' => $this->fake->company,
//            'name' => $request->name,
            'email' => $this->fake->email,
            'password' => bcrypt('iluv2tow'),
        ];
        $system = System::create($new_system);

        dd($system->id);

        $tenantSystemBuilder = new TenantSystemBuilder($system);
        //$tenantSystemBuilder->deleteSystem();
        $tenantSystemBuilder->setupTenantSystem();
        $system->createTenantConnection();

    }
}
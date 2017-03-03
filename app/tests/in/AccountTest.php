<?php


use App\Models\Tenant\Account;
use App\Models\Tenant\Address;
use App\Models\Tenant\ChartOfAccount;
use App\Models\Tenant\Company;
use App\Models\Tenant\Store;
use App\Models\Tenant\Vendor;
use Iannazzi\Generators\DatabaseImporter\DatabaseCSVCreator;
use Iannazzi\Generators\DatabaseImporter\DatabaseDataImporter;
use IannazziTestLibrary\Tests\ApiTester;


class AccountTest extends ApiTester
{


    /** @test */
    function a_company_is_added()
    {

        $system = $this->getSystem();
        $company = factory(Company::class,'embrasse-moi')->create();
        $em =  Company::find(1);
        $this->assertEquals('Embrasse-Moi', $em->name);
    }
    /** @test */
    function a_store_is_added()
    {
        $system = $this->getSystem();
        $store = factory(Store::class,'embrasse-moi')->create();

        $store =  Store::find(1);
        $this->assertEquals('Pittsford', $store->name);

    }

    /** @test */
    function accounts_are_loaded()
    {
        $system = $this->getSystem();
        $cash = factory(Account::class, 'bank',1)->create();
        $cash = factory(Account::class, 'cash',1)->create();
        $ccs = factory(Account::class,'credit cards', 1)->create();


        $this->assertNotNull(Account::all());

    }
    /** @test */
    function vendors_are_loaded()
    {
        $system = $this->getSystem();
        factory(Vendor::class,'inventory', 1)->create();
        factory(Vendor::class,'expense', 1)->create();
        $this->assertNotNull(Vendor::all());
    }
    /** @test */
    function inventory_vendors_are_imported_from_pos()
    {
        $system = $this->getSystem();

        //DatabaseDataImporter::importVendors('POS');
    }


}
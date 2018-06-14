<?php


use App\Models\Tenant\Account;
use App\Models\Tenant\PayrollPeriod;
use Tests\ApiTester;


class PayrollTest extends ApiTester
{
    //account has initialized data
    //this test would truncate account and load the inital data?
    protected $route = 'payroll';

    /** @test */
    function loaded()
    {
        $system = $this->getSystem('demo');
        $this->assertNotNull(PayrollPeriod::all());
    }
    /** @test */
    function index()
    {
        $this->indexSuccess($this->route);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $rawContent = '{"search_fields":{"accounts_coa_number":"1","accounts_name":"","accounts_type":"Cash","accounts_parent_id":"","accounts_comments":"","accounts_active":"1"},"table_name":"accounts"}';
        $result = $this->searchSuccess($this->route, $rawContent);
        //$result->dump();

    }
    /** @test */
    function can_be_created()
    {
        $rawContent = '{"data":[{"id":"","name":"'. $this->faker->name . '","coa_number":"13388","type":"Expense","parent_id":"","active":1,"comments":""}],"_method":"put"}';


        $this->createSuccess($this->route, $rawContent);
    }
    /** @test */
    function can_be_shown()
    {
        $system = $this->getSystem();
        $id = Account::first()->id;
        $this->showSuccess($this->route, $id);

    }
    /** @test */
    function can_be_updated()
    {

        $rawContent = '{"data":[{"id":"6","name":"'. $this->faker->name . '","coa_number":"13388","type":"Expense","parent_id":"","active":1,"comments":""}],"_method":"put"}';
        $this->updateSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_not_delete_required_account()
    {
        $rawContent = '{"_method":"delete","data":{"id":1}}';
        $this->deleteSuccess($this->route, $rawContent, false);


    }
    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"_method":"delete","data":{"id":45}}';
        $this->deleteSuccess($this->route, $rawContent);


    }



}
<?php


use App\Models\Tenant\Account;
use Tests\ApiTester;


class AccountTest extends ApiTester
{

    protected $route = 'accounts';

    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(Account::all());
    }
    /** @test */
    function index()
    {
        $this->indexSuccess($this->route);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $rawContent = '{"search_fields":{"accounts_id":"1","accounts_parent_id":"null","accounts_name":"","accounts_active":"null","accounts_comments":""},"table_name":"accounts"}';

        $this->searchSuccess($this->route, $rawContent);

    }
//    /** @test */
//    function can_be_created()
//    {
//
//        $rawContent = '{"data":[{"id":"","parent_id":"1","name":"'. $this->faker->name . '","barcode":"1234","active":1,"comments":"asdf"}],"_method":"put"}';
//
//        $this->createSuccess($this->route, $rawContent);
//
//    }
//    /** @test */
//    function can_be_updated()
//    {
//
//        $rawContent = '{"data":[{"id":6,"parent_id":"1","name":"a98","barcode":"1234","active":1,"comments":"asdf"}],"_method":"put"}';
//
//        $this->updateSuccess($this->route, $rawContent);
//
//    }
//    /** @test */
//    function can_be_destroyed()
//    {
//        $rawContent = '{"_method":"delete","data":{"id":1}}';
//
//        $this->deleteSuccess($this->route, $rawContent);
//
//
//    }












}
<?php
use App\Models\Tenant\Employee;
use Tests\ApiTester;
use App\Models\Tenant\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;


class EmployeeTest extends ApiTester
{
    protected $route = '/api/employees';
    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(Employee::all());
    }
    /** @test */
    function index()
    {
        $system = $this->getSystem();
        $user = User::find(1);

        $this->be($user);
        $this->withoutMiddleware();
        $this->get($this->route, $this->headers($user))->assertStatus(200);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"search_fields":{"roles_id":"","roles_name":"","roles_parent_id":"1"},"table_name":"roles"}';

        $this->json('POST', $this->route . 'search', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);


    }
    /** @test */
    function can_be_created()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"","parent_id":"1","name":"'.$this->faker->firstName.'","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"put"}';

        $this->json('put', $this->route, json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);

    }
    /** @test */
    function can_be_updated()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"3","parent_id":"1", "name":"samm","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"patch"}';

        $this->json('put', $this->route, json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);

//        $this->json('put', '/roles', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
    }
    /** @test */
    function can_be_destroyed()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $rawContent = '{"_method":"delete","data":{"id":3}}';
        $this->json('delete', $this->route, json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);
    }



}
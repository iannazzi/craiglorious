<?php
use App\Models\Tenant\Role;
use Tests\ApiTester;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class RoleTest extends ApiTester
{

    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(Role::all());
    }
    /** @test */
    function index()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $this->get('/roles')->assertStatus(200);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"search_fields":{"table_id":"2","table_name":"","table_comments":""},"table_name":"table"}';

        $this->json('POST', '/roles/search', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);


    }
    /** @test */
    function can_be_created()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"","parent_id":"1","name":"'.$this->faker->firstName.'","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"put"}';

        $this->json('put', '/roles', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);

    }
    /** @test */
    function can_be_updated()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"3","parent_id":"1", "name":"samm","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"patch"}';

        $this->json('put', '/roles', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);

//        $this->json('put', '/roles', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
    }
    /** @test */
    function parent_id_same_as_id()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"1","parent_id":"1", "name":"samm","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"patch"}';

        $this->json('put', '/roles', json_decode($rawContent, true))
            ->assertJson(["success"=>'false']);

//        $this->json('put', '/roles', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
    }
    /** @test */
    function can_be_destroyed()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $rawContent = '{"_method":"delete","data":{"id":3}}';
        $this->json('delete', '/roles', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);
    }
    /** @test */
    function parent_id_updated()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"2","parent_id":"3", "name":"samm","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"patch"}';

        $this->json('put', '/roles', json_decode($rawContent, true))
            ->assertJson(["success"=>false]);

//        $this->json('put', '/roles', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
    }



}
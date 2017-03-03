<?php
use App\Models\Tenant\Role;
use IannazziTestLibrary\Tests\ApiTester;
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
        $this->get('/roles');
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"search_fields":{"table_id":"2","table_name":"","table_comments":""},"table_name":"table"}';

        $this->json('POST', '/roles/search', json_decode($rawContent, true))
            ->see('"success":true');
//            ->seeJson([
//                'id' => 2,
//            ]);

    }
    /** @test */
    function can_be_created()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"","name":"sg","timeout_minutes":"120","ip_address_restrictions":"Add ip addresses separated by ,","max_connections":"1","relogin_on_browser_change":1,"relogin_on_ip_address_change":1,"restrict_to_terminal_access":0,"allow_edit_invoice_details":1,"allow_edit_closed_invoice":0,"allow_voids":0,"allow_refunds":1,"max_discount_percent":"10","edit_closed_contents":0,"edit_closed_payments":1,"edit_closed_customer":0,"allow_other_payment":0,"allow_cc_return":0,"allow_advanced_return":0,"open_close_terminal":0,"po_max_open_past_cancel":"10","po_max_received_not_invoiced":"10","active":1,"comments":""}],"_method":"put"}';

        $this->json('put', '/roles', json_decode($rawContent, true))
            ->see('"success":true');

    }
    /** @test */
    function vendor_can_be_updated()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":123,"name":"Craig Iannazzi","check_name":"Craig Iannazzi","account_number":"go man go","main_email":"craig.blanda@gmail.com","cc_email":"craig.ambrose@wyman.com","main_phone":"123-123-9128 x757","work_phone":"123.123.3615","mobile":"+1-123-912-1728","fax":"","active":0,"billing_address":"123 Davis Orchard Suite 077\nEverettestad, KY 25917-5824","shipping_address":"123 Renner Flat Suite 886\nMariannatown, HI 03571","comments":"yup yup yup"}],"_method":"patch"}';

        $this->json('put', '/vendors', json_decode($rawContent, true))
            ->see('"success":true');

        $this->json('put', '/vendors', json_decode($rawContent, true))
            ->see('"success":true');
    }
    /** @test */
    function a_vendor_can_be_destroyed()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $rawContent = '{"_method":"delete","data":{"id":7}}';
        $this->json('delete', '/vendors', json_decode($rawContent, true))
            ->see('"success":true');
    }

}
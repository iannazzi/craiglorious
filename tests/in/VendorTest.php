<?php
use App\Models\Tenant\Vendor;
use Tests\ApiTester;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class VendorTest extends ApiTester
{
    protected $route = 'vendors';
    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(Vendor::all());
    }

    /** @test */
    function index()
    {
        $this->signIn();
        $this->get($this->route);
    }

    /** @test */
    function can_be_searched()
    {
        $rawContent = '{"search_fields":{"vendor_table_id":"123","vendor_table_name":"","vendor_table_account_number":"","vendor_table_active":"null"},"table_name":"vendor_table"}';

        $this->searchSuccess($this->route, $rawContent);
    }



//    /** @test */
//    function are_loaded()
//    {
//        $system = $this->getSystem();
//        //DatabaseDestroyer::emptyTable($system->dbc(), 'vendors');
//        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        \DB::table('vendors')->truncate();
//        \DB::statement('SET FOREIGN_KEY_CHECKS=1    ;');
//        factory(Vendor::class, 200)->create();
//        $this->assertNotNull(Vendor::all());
//    }
//    /** @test */
//    function get_index()
//    {
//        $system = $this->getSystem();
//        $this->withoutMiddleware();
//
//        //$this->get('/vendors')->assertStatus(200);
//
//
//    }
//    /** @test */
//    function can_be_searched()
//    {
//        $system = $this->getSystem();
//        $this->withoutMiddleware();
//
//        $rawContent = '{"search_fields":{"vendor_table_id":"123","vendor_table_name":"","vendor_table_account_number":"","vendor_table_active":"null"},"table_name":"vendor_table"}';
//
//        $this->json('POST', '/vendors/search', json_decode($rawContent, true))
//            ->assertJsonFragment([
//                'id' => 123,
//            ]);
//
//    }
//    /** @test */
//    function can_be_created()
//    {
//        $system = $this->getSystem();
//        $this->withoutMiddleware();
//
//        $rawContent = '{"data":[{"id":"","name":"new","check_name":"New","account_number":"new","main_email":"craig.201@gmail.com","cc_email":"201.ambrose@wyman.com","main_phone":"201-123-9128 x757","work_phone":"201.123.3615","mobile":"+1-201-201-1728","fax":"","active":1,"billing_address":"201 Davis Orchard Suite 077\nEverettestad, KY 25917-201","shipping_address":"201 Renner Flat Suite 886\nMariannatown, HI 201","comments":"nan nan yup yup"}],"_method":"patch"}';
//
//        $this->json('put', '/vendors', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
//
//    }
//    /** @test */
//    function can_be_updated()
//    {
//        $system = $this->getSystem();
//        $this->withoutMiddleware();
//
//        $rawContent = '{"data":[{"id":123,"name":"Craig Iannazzi","check_name":"Craig Iannazzi","account_number":"go man go","main_email":"craig.blanda@gmail.com","cc_email":"craig.ambrose@wyman.com","main_phone":"123-123-9128 x757","work_phone":"123.123.3615","mobile":"+1-123-912-1728","fax":"","active":0,"billing_address":"123 Davis Orchard Suite 077\nEverettestad, KY 25917-5824","shipping_address":"123 Renner Flat Suite 886\nMariannatown, HI 03571","comments":"yup yup yup"}],"_method":"patch"}';
//
//        $this->json('put', '/vendors', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
//
//        $this->json('put', '/vendors', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
//    }
//    /** @test */
//    function can_be_destroyed()
//    {
//        $system = $this->getSystem();
//        $this->withoutMiddleware();
//        $rawContent = '{"_method":"delete","data":{"id":7}}';
//        $this->json('delete', '/vendors', json_decode($rawContent, true))
//            ->assertJson(["success"=>'true']);
//    }

}
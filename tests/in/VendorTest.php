<?php
use App\Models\Tenant\Vendor;
use Tests\ApiTester;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class VendorTest extends ApiTester
{
    protected $route = 'vendors';


    /** @test */
    function index()
    {
        $this->indexSuccess($this->route);
    }

    /** @test */
    function can_be_searched()
    {
        $rawContent = '{"search_fields":{"vendor_table_name":"","vendor_table_account_number":"","vendor_table_active":"null"},"table_name":"vendor_table"}';

        $this->searchSuccess($this->route, $rawContent);
    }
    /** @test */



    function are_loaded()
    {
        $system = $this->getSystem();
        //DatabaseDestroyer::emptyTable($system->dbc(), 'vendors');
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('vendors')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1    ;');
        factory(Vendor::class, 200)->create();
        $this->assertNotNull(Vendor::all());
    }


    /** @test */
    function can_be_created()
    {

        $rawContent = '{"data":[{"id":"","name":"new","check_name":"New","account_number":"","main_email":"craig.201@gmail.com","cc_email":"201.ambrose@wyman.com","main_phone":"201-123-9128 x757","work_phone":"201.123.3615","mobile":"+1-201-201-1728","fax":"","active":1,"comments":"nan nan yup yup"}],"_method":"patch"}';

        $this->createSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_updated()
    {

        $rawContent = '{"data":[{"id":123,"name":"Craig Iannazzi","check_name":"Craig Iannazzi","account_number":"go man go","main_email":"craig.blanda@gmail.com","cc_email":"craig.ambrose@wyman.com","main_phone":"123-123-9128 x757","work_phone":"123.123.3615","mobile":"+1-123-912-1728","fax":"","active":0,"address1":"123 Davis Orchard Suite","comments":"yup yup yup"}],"_method":"patch"}';

        $this->updateSuccess($this->route, $rawContent);
        $this->updateSuccess($this->route, $rawContent);
    }
    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"_method":"delete","data":{"id":7}}';
        $this->deleteSuccess($this->route, $rawContent);
    }

}
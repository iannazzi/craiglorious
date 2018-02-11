<?php
use App\Classes\Seeder\Demo\tables\CustomersTableSeeder;
use App\Models\Tenant\Customer;
use Tests\ApiTester;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class CustomerTest extends ApiTester
{
    protected $route = 'customers';



    /** @test */
    function factory()
    {
        $system = $this->getSystem();
        $fac = Factory('App\Models\Tenant\Customer', 30)->create();
        $this->assertNotNull($fac);
    }
    /** @test */
    function it_can_seed()
    {
        $system = $this->getSystem('test');
        \DB::table('customers')->truncate();
        CustomersTableSeeder::run();
        $this->assertEquals(1,1);
    }

    /** @test */
    function loaded()
    {
        $system = $this->getSystem();

        $emp = Customer::all();
//        dd($emp[3]);
        $this->assertNotNull($emp);
        $this->assertDatabaseHas('customers', [
            'id' => 7
        ]);

    }
    /** @test */
    function index()
    {
        $this->indexSuccess($this->route);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $rawContent = '{"search_fields":{"customers_first_name":"","customers_last_name":"","customers_comments":"","customers_active":"1","customers_phone":"","customers_email":""},"table_name":"customers"}';
        $this->searchSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_created()
    {
        $rawContent = '{"data":[{"id":"","first_name":"'. $this->faker->name . '","last_name":"'. $this->faker->name . '","active":1,"comments":""}],"_method":"put"}';


        $this->createSuccess($this->route, $rawContent);
    }
    /** @test */
    function can_be_shown()
    {
        $system = $this->getSystem();
        $this->showSuccess($this->route, 2);

    }
    /** @test */
    function can_be_updated()
    {
        $rawContent = '{"data":[{"id":19,"first_name":"Delaney","last_name":"Koch","phone":"885-349-9918 x7584","email":"delfina.gutmann@gmail.com","address1":"1140 McClure Mission","address2":"Apt. 425","address3":"","city":"Juanitaville","state_id":"4","zip":"98063","comments":"","active":0}],"_method":"put"}';
        $this->updateSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"_method":"delete","data":{"id":4}}';
        $this->deleteSuccess($this->route, $rawContent);

    }
}
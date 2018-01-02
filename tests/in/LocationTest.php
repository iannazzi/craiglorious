<?php
use App\Models\Tenant\Location;
use Tests\ApiTester;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class LocationTest extends ApiTester

{
    protected $route = 'locations';

    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(Location::all());
    }
    /** @test */
    function index()
    {
        $this->signIn();
        $this->get($this->route);
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $rawContent = '{"search_fields":{"locations_table_id":"","locations_table_parent_id":"null","locations_table_name":"","locations_table_barcode":"","locations_table_active":"null","locations_table_comments":""},"table_name":"locations_table"}';

        $this->searchSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_created()
    {

        $rawContent = '{"data":[{"id":"","parent_id":"1","name":"'. $this->faker->name . '","barcode":"1234","active":1,"comments":"asdf"}],"_method":"put"}';

        $this->createSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_updated()
    {

        $rawContent = '{"data":[{"id":6,"parent_id":"1","name":"a98","barcode":"1234","active":1,"comments":"asdf"}],"_method":"put"}';

        $this->updateSuccess($this->route, $rawContent);

    }
    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"_method":"delete","data":{"id":1}}';

        $this->deleteSuccess($this->route, $rawContent);


    }

}
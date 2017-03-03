<?php
use App\Models\Tenant\Location;
use IannazziTestLibrary\Tests\ApiTester;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class LocationTest extends ApiTester
{
    /** @test */
    function loaded()
    {
        $system = $this->getSystem();
        $this->assertNotNull(Location::all());
    }
    /** @test */
    function index()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $this->get('/locations');
    }
    /** @test */
    function can_be_searched_raw_json()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $rawContent = '{"search_fields":{"locations_table_id":"","locations_table_parent_id":"null","locations_table_name":"","locations_table_barcode":"","locations_table_active":"null","locations_table_comments":""},"table_name":"locations_table"}';


        $this->json('POST', '/locations/search', json_decode($rawContent, true))
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

        $rawContent = '{"data":[{"id":"","parent_id":"1","name":"locker","barcode":"1234","active":1,"comments":"asdf"}],"_method":"put"}';

        $this->json('put', '/locations', json_decode($rawContent, true))
            ->see('"success":true');

    }
    /** @test */
    function can_be_updated()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":6,"parent_id":"1","name":"a98","barcode":"1234","active":1,"comments":"asdf"}],"_method":"put"}';

        $this->json('put', '/locations', json_decode($rawContent, true))
            ->see('"success":true');
    }
    /** @test */
    function can_be_destroyed()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $rawContent = '{"_method":"delete","data":{"id":1}}';
        $this->json('delete', '/locations', json_decode($rawContent, true))
            ->see('"success":true');
    }

}
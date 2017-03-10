<?php
use App\Models\Tenant\CalendarEntry;
use Tests\ApiTester;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class CalendarEntryTest extends ApiTester
{
    /** @test */
    function are_emptied()
    {
        $system = $this->getSystem();
        //DatabaseDestroyer::emptyTable($system->dbc(), 'vendors');
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('calendar_entries')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1    ;');
        $this->assertEmpty(CalendarEntry::all());
    }
    /** @test */
    function are_loaded()
    {
        $system = $this->getSystem();
        factory(CalendarEntry::class, 200)->create();
        $this->assertNotNull(CalendarEntry::all());
    }
    /** @test */
    function can_be_searched()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"search_fields":{"id":"123","title":""},"table_name":"vendor_table"}';

        $this->json('POST', '/calendar/search', json_decode($rawContent, true))
            ->assertJsonFragment([
                'id' => 123,
            ]);

    }
    /** @test */
    function can_be_created()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":"","title":"new","start":"2017-03-10 10:00:00", "end":"2017-03-10 11:00:00"}],"_method":"patch"}';

        $this->json('put', '/calendar', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);

    }
    /** @test */
    function can_be_updated()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();

        $rawContent = '{"data":[{"id":123,"title":"Craig Iannazzi"}],"_method":"patch"}';

        $this->json('put', '/calendar', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);
    }
    /** @test */
    function can_be_destroyed()
    {
        $system = $this->getSystem();
        $this->withoutMiddleware();
        $rawContent = '{"_method":"delete","data":{"id":7}}';
        $this->json('delete', '/calendar', json_decode($rawContent, true))
            ->assertJson(["success"=>'true']);
    }

}
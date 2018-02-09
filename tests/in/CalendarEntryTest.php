<?php
use App\Models\Tenant\CalendarEntry;
use Tests\ApiTester;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class CalendarEntryTest extends ApiTester
{
   // these tests can be run individually, so we need to build it up from scratch each time
    // for this reason use the test system
    // the demo system would only test the seeder then


    protected $route = 'calendar';
    /** @test */
    function are_emptied()
    {
        $system = $this->getSystem('test');
        \DB::table('calendar_entries')->truncate();
        $this->assertEmpty(CalendarEntry::all());
    }
    /** @test */
    function are_loaded()
    {
        $system = $this->getSystem('test');
        factory(CalendarEntry::class, 200)->create();
        $this->assertNotNull(CalendarEntry::all());
    }

    /** @test */
    function can_get_them()
    {
        $this->signInToTest();
        $rawContent = '{}';
        $this->json('Get', $this->api($this->route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);
    }
    /** @test */
    function employees_sent_down_to_calendar()
    {
        $this->signInToDemo();
        $rawContent = '{}';
        $data = $this->json('Get', $this->api($this->route), json_decode($rawContent, true),$this->headers());
        dd($data->getContent());
    }

    /** @test */
    function can_be_created()
    {
        $this->signInToTest();

        $rawContent = '{"data":{"id":"","title":"hello","comments":"","start":"2018-02-09 09:30:00","end":"2018-02-09 10:30:00","all_day":false,"class_name":"scheduled_shift","editable":1,"start_editable":1,"duration_editable":1,"resource_editable":1},"_method":"put"}';

        $this->json('PUT', $this->api($this->route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);

    }
    /** @test */
    function can_be_updated()
    {
        $this->signInToTest();
        $rawContent = '{"data":{"id":"123","title":"hello","comments":"","start":"2018-02-09 09:30:00","end":"2018-02-09 10:30:00","all_day":false,"class_name":"scheduled_shift","editable":1,"start_editable":1,"duration_editable":1,"resource_editable":1},"_method":"put"}';
        $this->json('PUT', $this->api($this->route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);


    }
    /** @test */
    function can_be_destroyed()
    {
        $this->signInToTest();
        $rawContent = '{"data":{"id":1},"_method":"delete"}';

        $this->json('delete', $this->api($this->route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);
    }






}
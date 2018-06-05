<?php
use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Employee;
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
    function user_has_access_to_employees()
    {
        //if you get the name wrong then for some reason
        $this->signIn('demo', 'owner','secret');
        $rawContent = '{}';
        $response = $this->json('get', $this->api($this->route), json_decode($rawContent, true),$this->headers());
        $data= json_decode($response->getContent());
        $this->assertTrue($data->data->schedule_access);
        $this->assertEquals($data->data->event_types[1]->text,'Scheduled Shift');
    }
    /** @test */
    function user_does_not_have_access_to_employees()
    {
        //if you get the name wrong then for some reason
        $this->signIn('demo', 'Manager','secret');
        $rawContent = '{}';
        $response = $this->json('get', $this->api($this->route), json_decode($rawContent, true),$this->headers());
        $data= json_decode($response->getContent());
        $this->assertFalse($data->data->schedule_access);
        $this->assertEquals($data->data->event_types[1]->text,'Appointment');
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
        $response = $this->json('Get', $this->api($this->route), json_decode($rawContent, true),$this->headers());
        $data= json_decode($response->getContent());
        $employees = $data->data->employees;
        $this->assertNotNull($employees);
    }

    /** @test */
    function can_be_created()
    {
        $this->signInToDemo();

        $rawContent = '{"data":{"id":"","title":"Shift: Craig Iannazzi","comments":"","start":"2018-02-09 10:00:00","end":"2018-02-09 11:00:00","all_day":false,"class_name":"scheduled_shift","employee_id":1,"editable":1,"start_editable":1,"duration_editable":1,"resource_editable":1},"_method":"put"}';

        $this->json('PUT', $this->api($this->route), json_decode($rawContent, true),$this->headers())
            ->assertJson(["success"=>'true']);

    }


    /** @test */
    function null_employee_value()
    {
        $this->signInToTest();
        $rawContent = '{"data":{"id":"","title":"test","comments":"","start":"2018-02-09 08:00:00","end":"2018-02-09 09:00:00","all_day":false,"class_name":"scheduled_shift","employee_id":null,"editable":1,"start_editable":1,"duration_editable":1,"resource_editable":1},"_method":"put"}';
        $response = $this->json('PUT', $this->api($this->route), json_decode($rawContent, true),$this->headers());
        $data= json_decode($response->getContent());
        $employee_id = CalendarEntry::where('id',$data->id)->value('employee_id');
        $this->assertNull($employee_id);

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
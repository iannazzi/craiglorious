<?php
use App\Classes\Accounting\Payroll\Payroll;
use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Employee;
use Tests\ApiTester;
use Iannazzi\Generators\DatabaseImporter\DatabaseDestroyer;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class ScheduleTest extends ApiTester
{

    protected $route = 'schedules';

    /** @test */
    function schedule_needs_employees()
    {
        $system = $this->getSystem('demo');
        $emp = Employee::random();
        $this->assertNotNull($emp->id);
    }

    /** @test */
    function are_emptied()
    {
        $system = $this->getSystem('demo');
        \DB::table('calendar_entries')->truncate();
        $this->assertEmpty(CalendarEntry::all());
    }

    /** @test */
    function schedules_are_loaded()
    {
        $system = $this->getSystem('demo');
        factory(CalendarEntry::class, 'scheduled_shift', 100)->create();
        $this->assertNotNull(CalendarEntry::all());
    }

    /** @test */
    function can_get_them()
    {
        $this->signInToDemo();
        $rawContent = '{"number_of_records":"200"}';
        $response = $this->json('Get', $this->api($this->route), json_decode($rawContent, true), $this->headers());
        $response->assertJson(["success" => 'true']);
        //$this->dump($response);

    }

    /** @test */
    function sales_can_not_get_schedules()
    {
        $this->signInToDemo('sales');
        $rawContent = '{}';
        $response = $this->json('Get', $this->api($this->route), json_decode($rawContent, true), $this->headers());
        $status = $response->getStatusCode();
        $this->assertEquals(401, $status);

    }

    /** @test */
    function can_be_created()
    {
        $rawContent = '{"data":{"id":"","title":"Shift: Craig Iannazzi","comments":"","start":"2018-02-09 10:00:00","end":"2018-02-09 11:00:00","all_day":false,"class_name":"scheduled_shift","employee_id":1,"editable":1,"start_editable":1,"duration_editable":1,"resource_editable":1},"_method":"put"}';

        $this->createSuccess($this->route, $rawContent);

    }

    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"data":{"id":1},"_method":"delete"}';
        $this->deleteSuccess($this->route, $rawContent);

    }

    /** @test */
    function summate_hours()
    {
        //make several entries
        $this->signInToDemo();
        \DB::table('calendar_entries')->truncate();
        $this->assertEmpty(CalendarEntry::all());
        $event1 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-09 10:00:00",
            "end" => "2018-02-09 18:15:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        //how long is it?
        $from = '2018-02-09 00:00:00';
        $to = '2018-02-09 23:59:59';
        $this->assertEquals($event1->hours($from,$to), 8.25);

        $event2 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-09 22:00:00",
            "end" => "2018-02-10 02:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        $from = '2018-02-09 00:00:00';
        $to = '2018-02-09 23:59:59';
        $this->assertEquals($event2->hours($from,$to), 4.5);

        $event3 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-07 22:00:00",
            "end" => "2018-02-08 04:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        $event4 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-08 12:00:00",
            "end" => "2018-02-08 14:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);


        //now we want to get events within a date range
        //only schedule shifts for a single day...
        $from = "2018-02-08 00:00:00";
        $to  = "2018-02-10 23:59:59";
        //2-7: 2
        //2-8 : 4.5+ 4.5 = 9
        //2-9 : 2 + 8.25 = 10.25
        //2-10 : 2.5


       Payroll::calculateHours($from, $to);








    }

    //employee cannot have hours on top of hours...


}
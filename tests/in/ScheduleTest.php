<?php
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
        factory(CalendarEntry::class, 'scheduled_shift', 1000)->create();
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

        $this->assertEquals($event1->hours(), 8.25);

        $event2 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-09 22:00:00",
            "end" => "2018-02-10 02:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        $this->assertEquals($event2->hours(), 4.5);

        //now we want to get events within a date range
        //only schedule shifts for a single day...
        $from = "2018-02-09";
        $to  = "2018-02-19";

        $entries = CalendarEntry::whereBetween('start', [$from, $to])->get();
        $entries2 = CalendarEntry::where('start', '>=', $from)
            ->where('start', '<=', $to)
            ->get();
        dd($entries2->hours());

        dd($entries2);
            $date1 = Carbon::today()->toDateString();
            $date2 = Carbon::today()->toDateString();






    }

    /** @test */
    function summate_hours_across_midnight()
    {

        $return = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-09 22:00:00",
            "end" => "2018-02-10 02:00:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);


    }


}
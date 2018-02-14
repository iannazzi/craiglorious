<?php
use App\Classes\Accounting\Payroll\Payroll;
use App\Classes\Seeder\Demo\tables\ScheduleEntriesTableSeeder;
use App\Classes\Seeder\Demo\tables\ShiftEntriesTableSeeder;
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
    function employees_sent_down()
    {
        $this->signInToDemo();
        $rawContent = '{}';
        $response = $this->json('Get', $this->api($this->route), json_decode($rawContent, true), $this->headers());
        $data = json_decode($response->getContent());
        $employees = $data->data->employees;
        $this->assertNotNull($employees);
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
        $rawContent = '{"data":[{"id":"","employee_id":"1","title":"Shift: Kody Brown","start":"2018-01-31 12:30","end":"2018-01-31 18:30","comments":"yes"}],"_method":"put"}';

        $response = $this->createSuccess($this->route, $rawContent);
        $data = json_decode($response->getContent());

        // $rawContent = '{"data":{"id":'.$data->id.'},"_method":"delete"}';
        // $this->deleteSuccess($this->route, $rawContent);
        //$entry = CalendarEntry::where('id',$data->id)->get();

        //dd($entry);


    }

    /** @test */
    function can_be_destroyed()
    {
        $rawContent = '{"data":{"id":1},"_method":"delete"}';
        $this->deleteSuccess($this->route, $rawContent);
        //test soft delete
        $entries = CalendarEntry::onlyTrashed()
            ->get()->toArray();
        $this->assertNotNull($entries);


    }

    /** @test */
    function summate_hours_one_employee()
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
        $to = '2018-02-10 00:00:00';
        $this->assertEquals($event1->hours($from, $to), 8.25);

        $event2 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-09 22:00:00",
            "end" => "2018-02-10 02:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        $from = '2018-02-09 00:00:00';
        $to = '2018-02-11 00:00:00';
        $this->assertEquals($event2->hours($from, $to), 4.5);

        $from = '2018-02-09 00:00:00';
        $to = '2018-02-10 00:00:00';
        $this->assertEquals($event2->hours($from, $to), 2);


        $event3 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-07 22:00:00",
            "end" => "2018-02-08 04:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        $from = '2018-02-07 00:00:00';
        $to = '2018-02-08 00:00:00';
        $this->assertEquals($event3->hours($from, $to), 2);

        $event4 = CalendarEntry::create([
            'title' => 'Shift: Craig Patrick',
            "start" => "2018-02-08 12:00:00",
            "end" => "2018-02-08 14:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 1
        ]);
        $event5 = CalendarEntry::create([
            'title' => 'Shift: someone else',
            "start" => "2018-02-08 12:00:00",
            "end" => "2018-02-08 14:30:00",
            "class_name" => "scheduled_shift",
            "employee_id" => 2
        ]);


        //now we want to get events within a date range
        //only schedule shifts for a single day...
        $from = "2018-02-07 00:00:00";
        $to = "2018-02-11 00:00:00";
        //2-7: 2
        //2-8 : 4.5+ 2.5 = 7
        //2-9 : 2 + 8.25 = 10.25
        //2-10 : 2.5
        //23.75
        $total = 21.75;

        $hours = Payroll::calculateHours(1, $from, $to);
        $this->assertEquals($hours, $total);
        $hours = Payroll::calculateHours(2, $from, $to);
        $this->assertEquals($hours, 2.5);

        $hours = Payroll::totalHours($from, $to);
        $this->assertEquals($hours, 24.25);

        //calculate hours for an employee date range
        //calculate hours for all employees date range


    }
    /** @test */
    function shift_seeder()
    {
        $system = $this->getSystem('demo');
        \DB::table('calendar_entries')->truncate();
        ScheduleEntriesTableSeeder::run();
        $entries = CalendarEntry::all()->toArray();
        $this->assertCount(300,$entries);

    }

    /** @test */
    function can_be_searched()
    {
        $rawContent = '{"search_fields":{"schedules_employee_id":"null","schedules_title":"","schedules_comments":"","schedules_start_date_start":"2018-02-07","schedules_start_date_end":"2018-02-11"},"table_name":"schedules"}
';
        $results = $this->searchSuccess($this->route, $rawContent);
        //dd($this->dump($results));
    }











    //employee cannot have hours on top of hours...


}
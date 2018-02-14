<?php
namespace App\Classes\Seeder\Demo\tables;

use App\Classes\Seeder\BaseSeeder;
use App\Models\Craiglorious\System;
use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Employee;
use Carbon\Carbon;

class ScheduleEntriesTableSeeder extends BaseSeeder
{
    public static function run()
    {
        self::console('ShiftEntriesTableSeeder');

        $now = Carbon::now();
        $start1 = Carbon::create($now->year, $now->month, $now->day, 10, 00, 00);
        $end1 = Carbon::create($now->year, $now->month, $now->day, 18, 00, 00);

        $start2 = Carbon::create($now->year, $now->month, $now->day, 14, 00, 00);
        $end2 = Carbon::create($now->year, $now->month, $now->day, 18, 00, 00);


        $start3 = Carbon::create($now->year, $now->month, $now->day, 10, 00, 00);
        $end3 = Carbon::create($now->year, $now->month, $now->day, 14, 00, 00);


        $start1->subDays(30);
        $end1->subDays(30);
        $start2->subDays(30);
        $end2->subDays(30);
        $start3->subDays(30);
        $end3->subDays(30);

        for ($i=0;$i<100;$i++){
            $emp = Employee::random();
            $entry = CalendarEntry::create(
                [
                    'title' => 'Shift: ' . $emp->fullname(),
                    'all_day' => 0,
                    'start' => $start1,
                    'end' => $end1,
                    'editable' => 1,
                    'class_name'=> 'scheduled_shift',
                    'employee_id' => $emp->id,
                    'duration_editable' => 1,
                    'resource_editable' => 1,
                    'start_editable' => 1,
                ]
            );
            $start1->addDays(1);
            $end1->addDays(1);


            $emp = Employee::random();
            $entry = CalendarEntry::create(
                [
                    'title' => 'Shift: ' . $emp->fullname(),
                    'all_day' => 0,
                    'start' => $start2,
                    'end' => $end2,
                    'editable' => 1,
                    'class_name'=> 'scheduled_shift',
                    'employee_id' => $emp->id,
                    'duration_editable' => 1,
                    'resource_editable' => 1,
                    'start_editable' => 1,
                ]
            );
            $start2->addDays(1);
            $end2->addDays(1);


            $emp = Employee::random();
            $entry = CalendarEntry::create(
                [
                    'title' => 'Shift: ' . $emp->fullname(),
                    'all_day' => 0,
                    'start' => $start3,
                    'end' => $end3,
                    'editable' => 1,
                    'class_name'=> 'scheduled_shift',
                    'employee_id' => $emp->id,
                    'duration_editable' => 1,
                    'resource_editable' => 1,
                    'start_editable' => 1,
                ]
            );
            $start3->addDays(1);
            $end3->addDays(1);




        }

    }
}

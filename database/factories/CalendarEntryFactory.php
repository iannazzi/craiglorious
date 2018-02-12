<?php

use App\Models\Tenant\Address;
use App\Models\Tenant\CalendarEntry;
use App\Models\Tenant\Contact;
use App\Models\Tenant\Employee;
use Carbon\Carbon;

$factory->define(App\Models\Tenant\CalendarEntry::class,  function (Faker\Generator $faker)
{
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', '+90 days')->getTimestamp());
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addHours(random_int(1,4));


$classname = $faker->randomElement([
            'scheduled_shift',
            'customer_appointment',
            'personal_appointment',
            'internal_meeting',
            'external_event'

        ]);

    $return = [
        'title' =>  $faker->word,
        'all_day' => 0,
        'start' => $startDate,
        'end' => $endDate,
        'editable' => 1,
        'class_name'=> $classname,
        'duration_editable' => 1,
        'resource_editable' => 1,
        'start_editable' => 1,

    ];
    return $return;
});

$factory->defineAs(App\Models\Tenant\CalendarEntry::class, 'scheduled_shift', function (Faker\Generator $faker)
{
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', '+90 days')->getTimestamp());
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addHours(random_int(4,12));

    $return = [
        'title' =>  $faker->word,
        'all_day' => 0,
        'start' => $startDate,
        'end' => $endDate,
        'editable' => 1,
        'class_name'=> 'scheduled_shift',
        'employee_id' => Employee::random()->id,
        'duration_editable' => 1,
        'resource_editable' => 1,
        'start_editable' => 1,

    ];
    return $return;
});

$factory->defineAs(App\Models\Tenant\CalendarEntry::class, 'shift1', function (Faker\Generator $faker)
{
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', '+90 days')->getTimestamp());
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addHours(random_int(4,12));

    $return = [
        'title' => 'Shift: emp 1',
        'all_day' => 0,
        'start' => $startDate,
        'end' => $endDate,
        'editable' => 1,
        'class_name'=> 'scheduled_shift',
        'employee_id' => 1,
        'duration_editable' => 1,
        'resource_editable' => 1,
        'start_editable' => 1,

    ];
    return $return;
});




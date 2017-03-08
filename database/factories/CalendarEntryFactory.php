<?php

use App\Models\Tenant\Address;
use App\Models\Tenant\Contact;
use Carbon\Carbon;

$factory->define(App\Models\Tenant\CalendarEntry::class,  function (Faker\Generator $faker)
{
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', '+90 days')->getTimestamp());
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addHour();

    $return = [
        'title' =>  $faker->title,
        'allDay' => false,
        'start' => $startDate,
        'end' => $endDate,
        'editable' => true,
    ];
    dd($return);
    return $return;
});


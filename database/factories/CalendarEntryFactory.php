<?php

use App\Models\Tenant\Address;
use App\Models\Tenant\Contact;
use Carbon\Carbon;

$factory->define(App\Models\Tenant\CalendarEntry::class,  function (Faker\Generator $faker)
{
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', '+90 days')->getTimestamp());
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addHours(random_int(1,4));

    $return = [
        'title' =>  $faker->word,
        'all_day' => 0,
        'start' => $startDate,
        'end' => $endDate,
        'editable' => 1,
        'duration_editable' => 1,
        'resource_editable' => 1,
        'start_editable' => 1,

    ];
    return $return;
});


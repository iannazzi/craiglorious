<?php

$factory->define(App\Models\Tenant\JournalToCoaLink::class, function (Faker\Generator $faker) {
    return [
        'Journal' => $faker->name,
		'link_name' => $faker->name,
		'comments' => $faker->name,
		'chart_of_accounts_id' => $faker->name
    ];
});
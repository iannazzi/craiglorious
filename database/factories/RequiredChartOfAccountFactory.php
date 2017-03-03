<?php

$factory->define(App\Models\Tenant\RequiredChartOfAccount::class, function (Faker\Generator $faker) {
    return [
        'chart_of_account_type_id' => $faker->name,
		'required_account_name' => $faker->name,
		'required_account_code' => $faker->name,
		'priority' => $faker->name,
		'comments' => $faker->name
    ];
});
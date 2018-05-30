<?php

$factory->define(App\Models\Tenant\PoCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});
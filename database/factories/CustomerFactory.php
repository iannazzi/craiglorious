<?php

$factory->define(App\Models\Tenant\Customer::class, function (Faker\Generator $faker) {
    return [
        'address1' => $faker->streetAddress,
        'address2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'state_id' => $faker->numberBetween(1, 50),
        'active' =>rand ( 0 , 1 ),
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
    ];

});
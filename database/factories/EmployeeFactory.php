<?php

$factory->define(App\Models\Tenant\Employee::class,  function (Faker\Generator $faker)
{
    return [
        'address' => $faker->address,
        'ss' => $faker->randomDigit . $faker->randomDigit . $faker->randomDigit . '-'.$faker->randomDigit.$faker->randomDigit.'-'.$faker->randomDigit.$faker->randomDigit.$faker->randomDigit.$faker->randomDigit,
        'active' => 1,
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->email(),
        'phone' => $faker->phoneNumber(),
        'pay_rate' => $faker->numberBetween(12,20),
        'withholding_allowance'=> $faker->numberBetween(0,4),
        'emergency_phone' => $faker->phoneNumber(),
        'emergency_contact' => $faker->name(),
    ];
});


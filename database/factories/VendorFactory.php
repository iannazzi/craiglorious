<?php

use App\Models\Tenant\Address;
use App\Models\Tenant\Contact;

$factory->define(App\Models\Tenant\Vendor::class,  function (Faker\Generator $faker)
{
    return [
        'type' => 'Expense',
        'address1' => $faker->streetAddress,
        'address2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'state_id' => $faker->numberBetween(1, 50),
        'name' => $faker->unique()->company,
        'account_number' => $faker->creditCardNumber(),
        'active' => rand ( 0 , 1 ),
        //'check_name' => $faker->address(),
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'main_email' => $faker->email(),
        'cc_email' => $faker->email(),
        'main_phone' => $faker->phoneNumber(),
        'work_phone' => $faker->phoneNumber(),
        'mobile' => $faker->phoneNumber(),
        'website_url' => $faker->url(),

    ];
});
$factory->defineAs(App\Models\Tenant\Vendor::class, 'inventory', function (Faker\Generator $faker)
{
    return [

        'type' => 'Expense',
        'billing_address' => $faker->address,
        'shipping_address' => $faker->address,
        'name' => $faker->company,
        'account_number' => $faker->creditCardNumber(),
        'active' => 1,
        //'check_name' => $faker->address(),
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'main_email' => $faker->email(),
        'cc_email' => $faker->email(),
        'main_phone' => $faker->phoneNumber(),
        'work_phone' => $faker->phoneNumber(),
        'mobile' => $faker->phoneNumber(),
        'website_url' => $faker->url(),
    ];
});


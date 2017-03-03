<?php

use App\Models\Craiglorious\County;
use App\Models\Craiglorious\State;
use App\Models\Craiglorious\ZipCode;
use App\Models\Tenant\Address;

$factory->define(App\Models\Tenant\Company::class, function (Faker\Generator $faker) {
	return  [
		'name' => $faker->company,
		'phone' => $faker->phoneNumber,
		'address' => $faker->address,
		'email' => $faker->email,
		'website' => $faker->domainName,
		'physical_address_id' => factory(Address::class)->create()->id,
		'billing_address_id' => factory(Address::class)->create()->id,


	];
});
$factory->defineAs(App\Models\Tenant\Company::class, 'embrasse-moi', function ($faker) {
	return [
		'name' => 'Embrasse-Moi',
		'email' => 'ci@embrasse-moi.com',
		'phone' => '585-383-1170',
		'website' => 'embrasse-moi.com',
		'physical_address_id' => factory(Address::class, 'main')->create()->id,
		'billing_address_id' => factory(Address::class, 'adams')->create()->id,

	];
});
$factory->defineAs(App\Models\Tenant\Company::class, 'craiglorious', function ($faker) {
	return [
		'name' => 'Craiglorious, LLC',
		'email' => 'craig@craiglorious.com',
		'website' => 'craiglorious.com',
		'phone' => '585-484-0019',
		'physical_address_id' => factory(Address::class, 'adams')->create()->id,
		'billing_address_id' => factory(Address::class, 'adams')->create()->id,

	];
});
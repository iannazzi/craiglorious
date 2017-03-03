<?php


use App\Models\Craiglorious\State;
use App\Models\Craiglorious\ZipCode;

$factory->define(App\Models\Tenant\Address::class, function (Faker\Generator $faker) {
    $zip = ZipCode::all()->random(1);
	$state = $zip->state();
	return [
        'address1' => $faker->streetAddress,
		'address2' => '',
		'city' => $faker->city,
		'state' => $zip->state,
		'zip' => $zip->zip_code,
		'country' => $zip->country,
		'state_id' => $state->id,
		'phone' => $faker->phoneNumber,
		'fax' => $faker->phoneNumber,
		'comments' => $faker->sentence(),
		'active' => 1
    ];
});
$factory->defineAs(App\Models\Tenant\Address::class,'main', function (Faker\Generator $faker) {

	$zip = ZipCode::where('zip_code', '14534')->firstOrFail();
	$state = $zip->state();
	return [
		'address1' => '1 N. Main Street',
		'address2' => '',
		'city' => $zip->primary_city,
		'zip' => $zip->zip_code,
		'country' => $zip->country,
		'state' => $state->name,
		'state_id' => $state->id,
		'phone' => '585-383-1170',
		'fax' => '585-383-1170',
		//'active' => 1
	];
});
$factory->defineAs(App\Models\Tenant\Address::class,'monroe', function (Faker\Generator $faker) {
	$zip = ZipCode::where('zip_code', '14534')->firstOrFail();
	$state = $zip->state();
	$county = $zip->county();
	return [
		'address1' => '2 Monroe Avenue',
		'address2' => '',
		'city' => $zip->primary_city,
		'zip' => $zip->zip_code,
		'country' => $zip->country,
		'state' => $state->name,
		'state_id' => $state->id,
		'phone' => '585-383-1170',
		'fax' => '585-383-1170',
		//'active' => 1
	];
});
$factory->defineAs(App\Models\Tenant\Address::class,'adams', function (Faker\Generator $faker) {
	$zip = ZipCode::where('zip_code', '14608')->firstOrFail();
	$state = State::where('name', 'New York')->firstOrFail();
	return [
		'address1' => '111 Adams Street',
		'address2' => '',
		'city' => $zip->primary_city,
		'zip' => $zip->zip_code,
		'country' => $zip->country,
		'state' => $state->name,
		'state_id' => $state->id,
		'phone' => '585-484-0019',
		'fax' => '585-484-0019',
		//'active' => 1
	];
});
<?php


use App\Models\Craiglorious\TaxJurisdiction;
use App\Models\Craiglorious\ZipCode;
use App\Models\Tenant\Address;

$factory->define(App\Models\Tenant\Store::class, function (Faker\Generator $faker) {
    return [
        'state_id' => $faker->name,
		'tax_jurisdiction_id' => $faker->name,
		'active' => 1,
		'name' => $faker->name,
		'shipping_address_id' => factory(Address::class)->create()->id,
		'billing_address_id' => factory(Address::class)->create()->id,
		'comments' => $faker->name
    ];
});
$factory->defineAs(App\Models\Tenant\Store::class, 'embrasse-moi', function (Faker\Generator $faker) {

	$zip = ZipCode::where('zip_code', '14534')->firstOrFail();
	$state = $zip->state();
	$county = $zip->county();


	return [
		'state_id' => $state->id,
		'tax_jurisdiction_id' => $zip->taxJurisdiction()->id,
		'active' => 1,
		'name' => 'Pittsford',
		'shipping_address_id' => factory(Address::class, 'main')->create()->id,
		'billing_address_id' => factory(Address::class, 'monroe')->create()->id,
		'comments' => 'Our favorite store!!'
	];
});
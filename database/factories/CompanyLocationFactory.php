<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CompanyLocation;
use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(CompanyLocation::class, function (Faker $faker) {
    return [
        'address'=>$faker->address,
        'phone'=>$faker->phoneNumber,
        'lat'=>$faker->latitude,
        'lat'=>$faker->longitude,
        'company_id'=>factory(Company::class)
    ];
});

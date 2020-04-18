<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'=>$faker->numberBetween(15, 77),
        'name'=>$faker->word,
        'brand_id'=>factory(Brand::class),
        'presentation'=>$faker->word,
        'price'=>$faker->randomFloat,
        'description'=>$faker->sentence,
        'ingredients'=>$faker->sentence
    ];
});

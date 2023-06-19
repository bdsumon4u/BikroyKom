<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $price = mt_rand(123, 321);

    return [
        'name' => $faker->name,
        'slug' => $faker->unique()->slug,
        'description' => $faker->paragraph,
        'brand_id' => mt_rand(1, 20),
        'price' => $price,
        'selling_price' => $price - mt_rand(10, 40),
        'sku' => $faker->unique()->word,
        'should_track' => $faker->boolean,
        'stock_count' => mt_rand(1, 5),
        'is_active' => $faker->boolean(90),
    ];
});

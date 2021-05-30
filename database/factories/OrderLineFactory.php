<?php

/** @var Factory $factory */

use App\Models\OrderLine;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(OrderLine::class, function (Faker $faker) {
    return [
        'id' => $faker->randomKey(),
        'order_id' => $faker->randomKey(),
        'product_id' => $faker->randomKey(),
        'description' => $faker->text,
        'amount_each' => $faker->randomDigit,
        'amount_total' => $faker->randomDigit,
        'quantity' => $faker->randomDigit,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

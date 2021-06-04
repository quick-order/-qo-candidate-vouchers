<?php

/** @var Factory $factory */

use App\Models\Voucher;
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

$factory->define(Voucher::class, function (Faker $faker) {
    return [
        'id' => $faker->randomKey(),
        'order_id' => $faker->randomKey(),
        'amount_original' => $faker->randomDigit,
        'amount_remaining' => $faker->randomDigit,
        'created_at' => now(),
    ];
});

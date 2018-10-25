<?php

use Faker\Generator as Faker;

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


$factory->define(App\Holiday::class, function (Faker $faker) {
    return array(
        'title' => $faker->text(10),
        'description' => $faker->paragraph,
        'start_date' => today()->addDay(rand(1, 10))->toDateString(),
        'end_date' => today()->addDay(rand(11, 20))->toDateString(),
        'start_date_partial_hours' => $faker->numberBetween($min = 0, $max = 4),
        'end_date_partial_hours' => $faker->numberBetween($min = 0, $max = 4)
    );
});

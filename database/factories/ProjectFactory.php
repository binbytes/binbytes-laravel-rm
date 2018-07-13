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

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->sentence,
        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
        'started_at' => $faker->date(),
        'is_completed' => false,
        'remarks' => $faker->paragraph
    ];
});

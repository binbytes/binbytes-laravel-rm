<?php

use Faker\Generator as Faker;

$factory->define(App\UserAttendance::class, function (Faker $faker) {
    return [
        'date' => today(),
    ];
});

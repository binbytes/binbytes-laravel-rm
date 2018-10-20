<?php

use Faker\Generator as Faker;

$factory->define(App\AttendanceSession::class, function (Faker $faker) {
    return [
        'start_time' => now()->subMinute(5),
        'end_time' => now()->subMinute(5),
    ];
});

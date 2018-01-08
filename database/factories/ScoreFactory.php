<?php

use Faker\Generator as Faker;

$factory->define(App\Score::class, function (Faker $faker) {
    return [
        'user_id' => function () {
        	return factory(App\User::class)->create()->id;
        },
        'score' => rand(1, 1000),
        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
    ];
});

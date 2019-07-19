<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Departure;
use Faker\Generator as Faker;

$factory->define(Departure::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'datetime' => \Carbon\Carbon::now()->addMinutes($faker->numberBetween(5,500))
    ];
});


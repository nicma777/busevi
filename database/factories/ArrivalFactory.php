<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Arrival;
use Faker\Generator as Faker;

$factory->define(Arrival::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'datetime' => \Carbon\Carbon::now()->addMinutes($faker->numberBetween(5,500))

    ];
});

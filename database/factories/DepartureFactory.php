<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Departure;
use Faker\Generator as Faker;

$factory->define(Departure::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'carrier' => $faker->randomElement(['Autotrans d.d.', 'Arriva', 'Croatia Bus d.o.o.', 'Črnja tours', ' Transturist', 'Brioni'], 'Transturist d.d.'),
        'datetime' => \Carbon\Carbon::now()->addMinutes($faker->numberBetween(5,500))
    ];
});


<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Arrival;
use Faker\Generator as Faker;

$factory->define(Arrival::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'carrier' => $faker->randomElement(['Autotrans d.d.', 'Arriva', 'Croatia Bus d.o.o.', 'Črnja tours', ' Transturist', 'Brioni'], 'Transturist d.d.'),
        'datetime' => \Carbon\Carbon::now()->addMinutes($faker->numberBetween(5,500))

    ];
});

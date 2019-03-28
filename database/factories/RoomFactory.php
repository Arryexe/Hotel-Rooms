<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->numberBetween(101, 110),
        'category_id' => 1,
        'status' => 'Available',
        'customer_name' => null,
        'checkin_time' => null,
        'checkout_time' => null,
        'booking_time' => null,
        'notes' => $faker->sentence,
    ];
});

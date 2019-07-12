<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'image' => $faker->imageUrl(),
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,

    ];
});

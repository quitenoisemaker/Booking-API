<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\bookable;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$suffix = [
    'Villa',
    'House',
    'Cottage',
    'Luxury Villas',
    'Cheap House',
    'Rooms',
    'Cheap Rooms',
    'Luxury Rooms',
    'Fancy Rooms'
];

$factory->define(bookable::class, function (Faker $faker) use ($suffix) {
    return [
        'title' => $faker->city . '' . Arr::random($suffix),
        'description' => $faker->text()
    ];
});
